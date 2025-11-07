<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClienteAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('cliente_id')) {
            return redirect()->to('/login')->with('error', 'Inicia sesión para continuar.');
        }
        return $next($request);
    }
}
