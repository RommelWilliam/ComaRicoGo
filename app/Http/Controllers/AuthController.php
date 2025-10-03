<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use App\Models\UsuarioNegocio;
use App\Models\Sesion;
use App\Models\Orden;
use App\Models\Platillo;
use App\Models\PlatilloOrden;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('login');
    }

    /**
     * Login de Cliente
     */
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

    /**
     * Registro de Cliente
     */
    public function registrarCliente(Request $request)
    {
        $cliente = Cliente::where('correo', $request->correo)->first();
        if ($cliente) {
            return redirect()->back()->with('error', 'El correo ya está registrado');
        } else {
            $cliente = new Cliente();
            $cliente->nombre = $request->nombre;
            $cliente->correo = $request->correo;
            $cliente->password = Hash::make($request->password);
            $cliente->rol = 'cliente'; // Rol por defecto
            $cliente->save();

            session(['cliente_id' => $cliente->id]);
            return redirect('/menu');
        }
    }

    /**
     * Login de Usuarios del Negocio (Admin / Cocinero)
     */
    public function loginUsuarioNegocio(Request $request)
    {
        $usuario = UsuarioNegocio::where('correo', $request->correo)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            session([
                'usuarioNegocio_id' => $usuario->id,
                'rol_id' => $usuario->rol_id, // Guardamos el rol en sesión
            ]);

            // Registrar sesión
            $sesion = new Sesion();
            $sesion->usuario_id = $usuario->id;
            $sesion->inicio_sesion = now();
            $sesion->detalles = "Navegador: {$request->navegador}, Plataforma: {$request->plataforma}, Resolución: {$request->resolucion}, Idioma: {$request->idioma}, Zona Horaria: {$request->zona_horaria}";
            $sesion->save();

            $rol = Rol::find($usuario->rol_id);
            // Redirección según rol
            if ($rol->nivel_permisos == 1) {
                return redirect('/negocio/admin/dashboard');
            } elseif ($rol->nivel_permisos == 2) {
                return redirect()->route('cocinero.ordenesPendientes');
            } else {
                return redirect()->back()->with('error', 'Rol no autorizado.');
            }
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function mostrarPerfil()
    {
        if (!session()->has('cliente_id')) {
            return redirect('/login')->withErrors('Inicia sesión o para ver tu perfil');
        }

        $cliente = Cliente::find(session('cliente_id'));
        $ordenes = Orden::where('cliente_id', $cliente->id)->where('estado', 'finalizada')->get();
        foreach ($ordenes as $orden) {
            $ordenId = $orden->id;
            $platillos = DB::table('orden_platillo')
                ->join('platillos', 'orden_platillo.platillo_id', '=', 'platillos.id')
                ->where('orden_platillo.orden_id', $ordenId)
                ->select('platillos.nombre', 'orden_platillo.cantidad')
                ->get();
            $orden->platillosVista = $platillos;
        }

        return view('perfil', compact('cliente', 'ordenes'));
    }
}

