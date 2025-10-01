<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Rol;

class CocineroMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $usuarioId = session('usuarioNegocio_id');
        $rolId = session('rol_id');

        
        if (!$usuarioId) {
            return redirect()->route('negocio.login.formulario')
                ->with('error', 'Debes iniciar sesión como cocinero');
        }

       $rol = Rol::find($rolId);
        if ($rol->nivel_permisos != 2) {
            return redirect()->route('negocio.login.formulario')
                ->with('error', 'Acceso no autorizado');
        }

        return $next($request);
    }
}
