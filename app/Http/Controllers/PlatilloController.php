<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Platillo;

class PlatilloController extends Controller
{
    public function index()
    {
        if (!session()->has('cliente_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para ver el menú.');
        }

        $platillos = Platillo::where('disponible', true)->get();
        $categorias = Platillo::where('disponible', true)->pluck('categoria')->unique();
        $maxPrecio = Platillo::where('disponible', true)->max('precio');
        $minPrecio = Platillo::where('disponible', true)->min('precio');
        return view('menu', compact('platillos', 'categorias', 'maxPrecio', 'minPrecio'));
    }

    public function filtrarPorCategoriaPrecio(Request $request)
    {
        $categoriaSelecc = $request->input('categoria');
        if (empty($categoriaSelecc)) {
            $platillos = Platillo::where('disponible', true)
            ->whereBetween('precio', [$request->input('minPrecio'), $request->input('rangoPrecio')])
            ->get();
        }
        else{
            $platillos = Platillo::where('disponible', true)
            ->whereIn('categoria', $categoriaSelecc)
            ->whereBetween('precio', [$request->input('minPrecio'), $request->input('rangoPrecio')])
            ->get();
        }
        

        $categorias = Platillo::where('disponible', true)->pluck('categoria')->unique();
        $maxPrecio = Platillo::where('disponible', true)->max('precio');
        $minPrecio = Platillo::where('disponible', true)->min('precio');
        return view('menu', compact('platillos', 'categorias', 'categoriaSelecc', 'maxPrecio', 'minPrecio'));
    }
}
