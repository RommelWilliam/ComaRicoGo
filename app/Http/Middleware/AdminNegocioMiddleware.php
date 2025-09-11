<?php

namespace App\Http\Middleware;

use App\Models\UsuarioNegocio;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;

class AdminNegocioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('usuarioNegocio_id')){
            //dd(session()->all());
            $user = UsuarioNegocio::find(session('usuarioNegocio_id'));
            $rol = Rol::find($user->rol_id);
            // Asegúrate de que el usuario esté autenticado y tenga relación con rol
            if($rol->nivel_permisos == 1) {
                return $next($request);
            }
            else
            {
                // Redirige o responde con 403 si no tiene permiso
                abort(403, 'No tienes permiso para acceder a esta sección.');
            }
        }
        else{
            return redirect('/negocio/login');
        }
    }
}
