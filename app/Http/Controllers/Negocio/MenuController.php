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

    public function editarPlatillo(Request $request, $id)
    {
        $platillo = Platillo::find($id);
        if ($platillo) {
            return response()->json(['platillo_edit' => $platillo]);
        }
        return redirect()->back()->with('error', 'Platillo no encontrado');
    }

    public function actualizarPlatillo(Request $request)
    {
        $platillo = Platillo::find($request->platilloId);
        if ($platillo) {
            $platillo->nombre = $request->nombrePlatillo;
            $platillo->precio = $request->precioPlatillo;
            $platillo->cantidad = $request->cantidadPlatillo;
            if($request->cantidadPlatillo > 0){
                $platillo->disponible = $request->disponible ? 1 : 0;    
            }
            else{
                $platillo->disponible = 0;    
            }
            $platillo->descripcion = $request->descripcionPlatillo;

            if($platillo->save())
                return redirect('/negocio/admin/gestion/menu')->with('success', 'Platillo actualizado correctamente.');
            else
                return redirect()->back()->with('error', 'Error al actualizar el platillo. Intente nuevamente.');
        }
        return redirect()->back()->with('error', 'Platillo no encontrado.');
    }
}