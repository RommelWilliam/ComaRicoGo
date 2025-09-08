<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function crearRol(Request $request)
    {
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();

        return redirect()->back()->with('success', 'Rol creado exitosamente');
    }
}