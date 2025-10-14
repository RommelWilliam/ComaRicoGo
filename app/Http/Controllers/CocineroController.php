<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\ReporteCocina;

use Illuminate\Support\Facades\DB;

class CocineroController extends Controller
{
    /**
     * Ver todas las órdenes (dashboard general).
     */
    public function index()
    {
        $ordenes = Orden::with('platillos')->get();
        return view('cocinero.ordenes', compact('ordenes'));
    }

    /**
     * Ver notificaciones del cocinero.
     */
    public function notificaciones()
    {
        $usuario = auth()->user(); 
        $notificaciones = $usuario->notifications;
        return view('cocinero.notificaciones', compact('notificaciones'));
    }

    /**
     * Ver las órdenes que el cocinero ya se asignó.
     */
    public function ordenesAsignadas()
    {
        $cocineroId = session('usuarioNegocio_id'); 
        
        $ordenes = Orden::where('cocinero_id', $cocineroId)
            ->where('estado', 'en_proceso')
            ->orderBy('created_at', 'asc')
            ->with('platillos')
            ->get();

        return view('cocinero.ordenes_asignadas', compact('ordenes'));
    }

    /**
     * Ver las órdenes pendientes (sin cocinero asignado).
     */
    public function pendientes()
    {
        $ordenes = Orden::whereNull('cocinero_id')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'asc')
            ->with('platillos')
            ->get();

        return view('cocinero.ordenes_pendientes', compact('ordenes'));
    }

    /**
     * Asignarse una orden.
     */
    public function asignarOrden($id)
    {
        $cocineroId = session('usuarioNegocio_id'); 

        DB::transaction(function () use ($id, $cocineroId) {
            $orden = Orden::lockForUpdate()->findOrFail($id);

            if ($orden->cocinero_id !== null) {
                throw new \Exception("Esta orden ya fue tomada por otro cocinero");
            }

            $orden->cocinero_id = $cocineroId;
            $orden->estado = 'en_proceso'; // ✅ Ahora pasa a "en preparación"
            $orden->save();
        });

        return redirect()->route('cocinero.ordenesAsignadas')
            ->with('success', '¡Orden asignada con éxito!');
    }

    /**
     * Finalizar una orden propia.
     */
    public function finalizarOrden($id)
    {
        $cocineroId = session('usuarioNegocio_id');

        $orden = Orden::where('id', $id)
            ->where('cocinero_id', $cocineroId)
            ->firstOrFail();

        $orden->estado = 'finalizada'; 
        $orden->save();

        return redirect()->route('cocinero.ordenesAsignadas')
            ->with('success', '¡Orden finalizada!');
    }

    /**
     * Ver las órdenes finalizadas del cocinero.
     */
    public function ordenesFinalizadas()
    {
        $cocineroId = session('usuarioNegocio_id');

        $ordenes = Orden::where('cocinero_id', $cocineroId)
            ->where('estado', 'finalizada')
            ->with('platillos')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('cocinero.ordenes_finalizadas', compact('ordenes'));
    }


    

public function verReportes()
{
    $reportes = ReporteCocina::where('cocinero_id', session('usuarioNegocio_id'))
        ->orderBy('fecha_reporte', 'desc')
        ->get();

    return view('cocinero.reportes', compact('reportes'));
}

public function registrarReporte(Request $request)
{
    $request->validate([
        'descripcion' => 'required|string|max:1000',
    ]);

    ReporteCocina::create([
        'cocinero_id' => session('usuarioNegocio_id'),
        'descripcion' => $request->descripcion,
    ]);

    return redirect()->route('cocinero.reportes')->with('success', 'Reporte enviado correctamente.');
}

}
