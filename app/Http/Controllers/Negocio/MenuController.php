<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use App\Models\Platillo;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function obtenerPlatillos(Request $request)
    {
        $platillos = Platillo::all();
        return view('negocio.gestion_menu', ['platillos' => $platillos]);
    }

    public function guardarNuevoPlatillo(Request $request)
    {
        $platillo = new Platillo();
        $platillo->nombre = $request->nombrePlatillo;
        $platillo->precio = $request->precioPlatillo;
        $platillo->cantidad = $request->cantidadPlatillo;
        $platillo->disponible = $request->disponible ? 1 : 0;
        $platillo->descripcion = $request->descripcionPlatillo;

        if($platillo->save())
            return redirect('/negocio/admin/gestion/menu')->with('success', 'Platillo agregado correctamente.');
        else
            return redirect()->back()->with('error', 'Error al agregar el platillo. Intente nuevamente.');
    }

    public function eliminarPlatillo(Request $request)
    {
        $platillo = Platillo::find($request->platillo_id);
        if ($platillo) {
            $platillo->delete();
            return redirect()->back()->with('success', 'Platillo eliminado correctamente.');
        }
        return redirect()->back()->with('error', 'Platillo no encontrado.');
    }
}