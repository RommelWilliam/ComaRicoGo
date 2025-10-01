<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Platillo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UsuarioNegocio;
use App\Notifications\NuevaOrden;
use Illuminate\Support\Facades\Notification;


class OrdenController extends Controller
{
    public function descargarPDF($id)
{
    $orden = Orden::with('platillos')->findOrFail($id);

    $pdf = Pdf::loadView('orden_pdf', compact('orden'));

    return $pdf->download("orden_{$orden->id}.pdf");
}
    public function enviar(Request $request)
    {
        if (!session()->has('cliente_id')) {
            return redirect('/login');
        }

        $datos = $request->input('platillos');
        $total = 0;
        $items = [];

        foreach ($datos as $id => $cantidad) {
            if ($cantidad > 0) {
                $platillo = Platillo::find($id);
                $subtotal = $platillo->precio * $cantidad;
                $total += $subtotal;

                $items[] = [
                    'platillo_id' => $id,
                    'cantidad' => $cantidad
                ];
            }
        }

        if (count($items) == 0) {
            return back()->with('error', 'Debes seleccionar al menos un platillo.');
        }

       
        $orden = DB::transaction(function () use ($items, $total) {
            $orden = Orden::create([
                'cliente_id' => session('cliente_id'),
                'total' => $total,
            ]);

            foreach ($items as $item) {
                $orden->platillos()->attach($item['platillo_id'], ['cantidad' => $item['cantidad']]);
            }

            return $orden;
        });

        return view('resumen', ['orden' => $orden->load('platillos')]);
    }

    public function guardarNota(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);
    $orden->nota = $request->input('nota');
     $orden->contacto_nombre = $request->input('contacto_nombre');
    $orden->contacto_telefono = $request->input('contacto_telefono');
    $orden->save();

    return view('orden_completa', ['orden' => $orden]);
    }
}

