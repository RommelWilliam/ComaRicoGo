<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    public function index()
    {
           if (!session()->has('cliente_id')) {
        return redirect('/login')->with('error', 'Debes iniciar sesión para ver el menú.');
    }

    
    $platillos = \App\Models\Platillo::where('disponible', true)->get();
    return view('menu', compact('platillos'));
    }
}
