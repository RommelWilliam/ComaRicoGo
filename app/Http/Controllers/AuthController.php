<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use App\Models\usuarioNegocioistrador;
use App\Models\Rol;
use App\Models\UsuarioNegocio;
use App\Models\Sesion;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $cliente = Cliente::where('correo', $request->correo)->first();

        if ($cliente && Hash::check($request->password, $cliente->password)) {
            session(['cliente_id' => $cliente->id]);
            return redirect('/menu');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function registrarCliente(Request $request)
    {
        $cliente = Cliente::where('correo', $request->correo)->first();
        if ($cliente) {
            return redirect()->back()->with('error', 'El correo ya está registrado');
        }
        else{
            $cliente = new Cliente();
            $cliente->nombre = $request->nombre;
            $cliente->correo = $request->correo;
            $cliente->password = Hash::make($request->password);
            $cliente->rol = 'cliente'; // Asignar rol por defecto
            $cliente->save();

            session(['cliente_id' => $cliente->id]);
            return redirect('/menu');
        }
    }

    public function loginUsuarioNegocio(Request $request)
    {
        $usuario = UsuarioNegocio::where('correo', $request->correo)->first();
        if($usuario && Hash::check($request->password, $usuario->password)) {
            session(['usuarioNegocio_id' => $usuario->id]);
            $sesion = new Sesion();
            $sesion->usuario_id = $usuario->id;
            $sesion->inicio_sesion = now();
            $sesion->detalles = "Navegador: {$request->navegador}, Plataforma: {$request->plataforma}, Resolución: {$request->resolucion}, Idioma: {$request->idioma}, Zona Horaria: {$request->zona_horaria}";
            $sesion->save();
            return redirect('/negocio/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }
}
