<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\FavoritoPlatillo;
use App\Models\Orden;
use App\Models\Platillo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class FavoritoController extends Controller
{
    /**
     * Obtiene el ID del cliente autenticado.
     * Soporta tanto auth estándar como sesión manual 'cliente'.
     */
    private function currentClienteId(Request $request)
    {
            return $request->session()->get('cliente_id');
    }

    /**
     * Listar favoritos del cliente.
     */
    public function index(Request $request)
    {
        $clienteId = $this->currentClienteId($request);
        abort_unless($clienteId, 401, 'No autenticado');

        $favoritos = Favorito::with(['items.platillo'])
            ->where('cliente_id', $clienteId)
            ->orderByDesc('created_at')
            ->paginate(10);

        // Si prefieres JSON para AJAX:
        if ($request->wantsJson()) {
            return response()->json($favoritos);
        }

        // Renderiza una vista (crearemos la vista luego)
        return view('perfil.favoritos.index', compact('favoritos'));
    }

    /**
     * Crear un favorito desde una orden finalizada del historial.
     */
public function storeFromOrder(Request $request, $ordenId)
{
    $clienteId = $this->currentClienteId($request);
    abort_unless($clienteId, 401, 'No autenticado');

    $request->validate([
        'nombre' => ['nullable', 'string', 'max:100'],
    ]);

    // Carga la orden del cliente con sus platillos
    $orden = Orden::with(['platillos'])
        ->where('id', $ordenId)
        ->where('cliente_id', $clienteId)
        ->firstOrFail();

    // Solo desde órdenes FINALIZADAS (coherente con el botón en la vista)
    if ($orden->estado !== 'finalizada') {
        throw ValidationException::withMessages([
            'orden' => 'Solo puedes guardar como favorito un pedido finalizado.',
        ]);
    }

    // Si la orden proviene de un favorito, no permitir guardarla de nuevo
    if (!empty($orden->favorito_origen_id)) {
        return redirect()->back()->with('error', 'Este pedido ya fue guardado en favoritos.');
    }

    // Evitar duplicados por cliente + orden origen
    $yaExiste = Favorito::where('cliente_id', $clienteId)
        ->where('source_order_id', $orden->id)
        ->exists();

    if ($yaExiste) {
        return redirect()->back()->with('error', 'Este pedido ya fue guardado en favoritos.');
    }

    DB::beginTransaction();
    try {
        // Crear el favorito
        $favorito = Favorito::create([
            'cliente_id'      => $clienteId,
            'nombre'          => $request->input('nombre'),
            'source_order_id' => $orden->id,
        ]);

        // Copiar items (snapshot de platillos + cantidad)
        foreach ($orden->platillos as $platillo) {
            FavoritoPlatillo::create([
                'favorito_id' => $favorito->id,
                'platillo_id' => $platillo->id,
                'cantidad'    => (int) ($platillo->pivot->cantidad ?? 1),
                'nota'        => null,
            ]);
        }

        DB::commit();

        if ($request->wantsJson()) {
            return response()->json([
                'message'  => 'Pedido guardado como favorito.',
                'favorito' => $favorito->load('items.platillo'),
            ], 201);
        }

        return redirect()->back()->with('success', 'Pedido guardado como favorito.');
    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Error al guardar favorito desde orden', [
            'orden_id' => $ordenId,
            'error'    => $e->getMessage(),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'No se pudo guardar el favorito.'], 500);
        }

        return redirect()->back()->with('error', 'No se pudo guardar el favorito.');
    }
}


    /**
     * Repetir un favorito: crea una nueva orden con precios ACTUALES.
     */
    public function repeat(Request $request, $favoritoId)
{
    $clienteId = $this->currentClienteId($request);
    abort_unless($clienteId, 401, 'No autenticado');

    $favorito = Favorito::with(['items.platillo' => function($q){
        $q->select('id','precio','nombre'); // solo lo necesario
    }])
    ->where('id', $favoritoId)
    ->where('cliente_id', $clienteId)
    ->firstOrFail();

    DB::beginTransaction();
    try {
        //Creamos nueva orden
        $orden = new Orden();
        $orden->cliente_id  = $clienteId;
        $orden->cocinero_id = null;
        $orden->nota        = null;
        $orden->estado      = 'pendiente';
        $orden->total       = 0;
        $orden->favorito_origen_id = $favorito->id;
        $orden->save();

        $total = 0;
        $lineasInsert = [];

        foreach ($favorito->items as $item) {
            $platillo = $item->platillo; // ya viene cargado
            if (!$platillo) {
                // platillo eliminado o no disponible → lo saltamos
                continue;
            }

            $cantidad = max(1, (int) $item->cantidad);
            $precio   = (float) $platillo->precio; // PRECIO ACTUAL

            // Insert pivot SIN timestamps 
            $lineasInsert[] = [
                'orden_id'    => $orden->id,
                'platillo_id' => $platillo->id,
                'cantidad'    => $cantidad,
            ];

            $total += ($precio * $cantidad);
        }

        // Si no hay líneas válidas, abortamos
        if (empty($lineasInsert)) {
            // revertimos la orden creada
            $orden->delete();
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'No se pudo repetir: los platillos de este favorito ya no están disponibles.');
        }

        //Insert masivo en la pivot
        DB::table('orden_platillo')->insert($lineasInsert);

        // 4) Actualizamos total y confirmamos
        $orden->total = $total;
        $orden->save();
        DB::commit();

        // Redirección segura
        // Si tienes una ruta de detalle, cámbiala aquí:
        // return redirect()->route('orden.detalle', ['orden' => $orden->id])
        //     ->with('success', 'Se creó un nuevo pedido a partir del favorito.');
        return redirect()
            ->route('cliente.ordenes') // historial/listado del cliente
            ->with('success', 'Se creó un nuevo pedido a partir del favorito.');
    } catch (\Throwable $e) {
        DB::rollBack();
        \Log::error('Error al repetir favorito', [
            'favorito_id' => $favoritoId,
            'error'       => $e->getMessage(),
        ]);

        return redirect()
            ->back()
            ->with('error', 'No se pudo repetir el pedido.');
    }
}


    /**
     * Eliminar un favorito del cliente.
     */
    public function destroy(Request $request, $favoritoId)
    {
        $clienteId = $this->currentClienteId($request);
        abort_unless($clienteId, 401, 'No autenticado');

        $favorito = Favorito::where('id', $favoritoId)
            ->where('cliente_id', $clienteId)
            ->firstOrFail();

        try {
            $favorito->delete();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Favorito eliminado.']);
            }

            return redirect()
                ->back()
                ->with('success', 'Favorito eliminado.');
        } catch (\Throwable $e) {
            Log::error('Error al eliminar favorito', [
                'favorito_id' => $favoritoId,
                'error'       => $e->getMessage(),
            ]);

            if ($request->wantsJson()) {
                return response()->json(['message' => 'No se pudo eliminar el favorito.'], 500);
            }

            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar el favorito.');
        }
    }
}
