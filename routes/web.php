<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;

Route::post('/registrar', [AuthController::class, 'registrarCliente'])->name('registrar.cliente');
Route::get('/registrar', function () {
    return view('registrar_cliente');
})->name('registrar.formulario');
Route::get('/menu', [PlatilloController::class, 'index']);
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.cliente');
Route::post('/orden', [OrdenController::class, 'enviar'])->name('orden.enviar');
Route::post('/orden/{id}/nota', [OrdenController::class, 'guardarNota'])->name('orden.guardarNota');
Route::get('/orden/{id}/descargar', [OrdenController::class, 'descargarPDF'])->name('orden.descargarPDF');
Route::get('/logout', function () {
    session()->forget('cliente_id');
    return redirect('/login');
})->name('logout');

// Rutas del negocio
Route::get('/negocio/login', function () {
    return view('negocio.login');
})->name('negocio.login.formulario');
Route::post('/negocio/login', [AuthController::class, 'loginUsuarioNegocio'])->name('negocio.login.submit');

Route::get('/negocio/registrar', function () {
    return view('negocio.registrar_usuario');
})->name('negocio.registrar.formulario');
Route::post('/negocio/registrar', [AuthController::class, 'registrarUsuarioNegocio'])->name('negocio.registrarUsuario.submit');

Route::get('/negocio/admin/dashboard', function () {
    return view('negocio.dashboard_admin');
})->name('negocio.admin.dashboard');

Route::get('/negocio/admin/gestion/menu', [App\Http\Controllers\Negocio\MenuController::class, 'obtenerPlatillos'
])->name('negocio.admin.gestion_menu');

Route::post('/negocio/admin/gestion/menu/agregar', [App\Http\Controllers\Negocio\MenuController::class, 'guardarNuevoPlatillo'
])->name('negocio.admin.agregar_platillo');

Route::delete('/negocio/admin/gestion/menu/eliminar', [App\Http\Controllers\Negocio\MenuController::class, 'eliminarPlatillo'
])->name('negocio.admin.eliminar_platillo');