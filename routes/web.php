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
    session()->flush();
    return redirect('/login');
})->name('logout');

// Rutas del negocio
Route::get('/negocio/login', function () {
    return view('negocio.login');
})->name('negocio.login.formulario');

Route::post('/negocio/login', [AuthController::class, 'loginUsuarioNegocio'])->name('negocio.login.submit');

// Agrupar rutas de administración bajo el middleware admin.negocio
Route::middleware(['admin.negocio'])->group(function () {
    //Rutas para la gestión del menú
    Route::get('/negocio/admin/dashboard', function () {
        return view('negocio.dashboard_admin');
    })->name('negocio.admin.dashboard');

    Route::get('/negocio/admin/gestion/menu', [App\Http\Controllers\Negocio\MenuController::class, 'obtenerPlatillos'])
        ->name('negocio.admin.gestion_menu');

    Route::post('/negocio/admin/gestion/menu/agregar', [App\Http\Controllers\Negocio\MenuController::class, 'guardarNuevoPlatillo'])
        ->name('negocio.admin.agregar_platillo');

    Route::get('/negocio/admin/gestion/menu/editar/{id}', [App\Http\Controllers\Negocio\MenuController::class, 'editarPlatillo'])
        ->name('negocio.admin.editar_platillo');

    Route::put('/negocio/admin/gestion/menu/actualizar', [App\Http\Controllers\Negocio\MenuController::class, 'actualizarPlatillo'])
        ->name('negocio.admin.actualizar_platillo');

    Route::delete('/negocio/admin/gestion/menu/eliminar', [App\Http\Controllers\Negocio\MenuController::class, 'eliminarPlatillo'])
        ->name('negocio.admin.eliminar_platillo');

    // Rutas para la gestión de usuarios y roles
    Route::get('/negocio/admin/gestion/usuarios', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'listarUsuariosRoles'])
        ->name('negocio.admin.gestion_usuarios_roles');

    Route::get('/negocio/admin/gestion/usuarios/{id}', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'getUsuario'])
        ->name('negocio.admin.obtener_usuario');

    Route::post('/negocio/admin/gestion/usuarios/crear', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'crearUsuario'])
        ->name('negocio.admin.crear_usuario');

    Route::put('/negocio/admin/gestion/usuarios/actualizar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'actualizarUsuario'])
        ->name('negocio.admin.actualizar_usuario');

    Route::delete('/negocio/admin/gestion/usuarios/eliminar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'eliminarUsuario'])
        ->name('negocio.admin.eliminar_usuario');

    Route::get('/negocio/admin/gestion/rol/{id}', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'getRol'])
        ->name('negocio.admin.obtener_rol');

    Route::post('/negocio/admin/gestion/rol/crear', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'crearRol'])
        ->name('negocio.admin.crear_rol');

    Route::put('/negocio/admin/gestion/rol/actualizar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'actualizarRol'])
        ->name('negocio.admin.actualizar_rol');

    Route::delete('/negocio/admin/gestion/rol/eliminar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'eliminarRol'])
        ->name('negocio.admin.eliminar_rol');
});