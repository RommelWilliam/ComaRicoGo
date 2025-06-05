<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

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
}
