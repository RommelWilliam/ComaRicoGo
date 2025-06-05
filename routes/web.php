<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;


Route::get('/menu', [PlatilloController::class, 'index']);
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.cliente');
Route::post('/orden', [OrdenController::class, 'enviar'])->name('orden.enviar');
Route::post('/orden/{id}/nota', [OrdenController::class, 'guardarNota'])->name('orden.guardarNota');
Route::get('/orden/{id}/descargar', [OrdenController::class, 'descargarPDF'])->name('orden.descargarPDF');
