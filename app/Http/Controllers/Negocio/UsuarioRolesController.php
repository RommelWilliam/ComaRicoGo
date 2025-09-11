<?php

namespace App\Http\Controllers\Negocio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\UsuarioNegocio;
use Illuminate\Support\Facades\DB;

class UsuarioRolesController extends Controller
{
    public function listarUsuariosRoles()
    {
        $roles = Rol::all();
        $usuarios = DB::table('usuarios_negocio')
        ->join('roles', 'usuarios_negocio.rol_id', '=', 'roles.id')
        ->select('usuarios_negocio.*', 'roles.nombre as rol_nombre')
        ->get();
        return view('negocio.gestion_usuarios', ['roles' => $roles, 'usuarios'=>$usuarios]);
    }

    public function getUsuario($id)
    {
        $usuario = UsuarioNegocio::find($id);
        if (!$usuario) {
            return redirect()->back()->with(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['usuario' => $usuario]);
    }

    public function crearUsuario(Request $request)
    {
        if(UsuarioNegocio::where('correo', $request->correo)->first()){
            return redirect()->back()->with('error', 'El usuario ya está registrado');
        }
        $usuario = new UsuarioNegocio();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->password = bcrypt($request->password);
        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario creado exitosamente');
    }

    public function actualizarUsuario(Request $request)
    {
        $usuario = UsuarioNegocio::find($request->usuario_id);
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->rol_id = $request->rol_id;
        $usuario->save();

        return redirect()->back()->with('success', 'Usuario actualizado exitosamente');
    }

    public function eliminarUsuario(Request $request){
        $usuario = UsuarioNegocio::find($request->usuario_id);
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado exitosamente');
    }

    public function getRol($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return redirect()->back()->with(['error' => 'Rol no encontrado'], 404);
        }
        return response()->json(['rol' => $rol]);
    }

    public function crearRol(Request $request)
    {
        if (Rol::where('nombre', $request->nombre)->first()) {
            return redirect()->back()->with('error', 'El rol ya existe');
        }
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->nivel_permisos = $request->nivelPermisos;
        $rol->save();

        return redirect()->back()->with('success', 'Rol creado exitosamente');
    }

    public function actualizarRol(Request $request)
    {
        $rol = Rol::find($request->id);
        if (!$rol) {
            return redirect()->back()->with('error', 'Rol no encontrado');
        }

        $rol->nombre = $request->nombre;
        $rol->nivel_permisos = $request->nivelPermisos;
        $rol->save();

        return redirect()->back()->with('success', 'Rol actualizado exitosamente');
    }

    public function eliminarRol(Request $request)
    {
        $rol = Rol::find($request->rol_id);
        if (!$rol) {
            return redirect()->back()->with('error', 'Rol no encontrado');
        }
        $rol->delete();
        return redirect()->back()->with('success', 'Rol eliminado exitosamente');
    }
}