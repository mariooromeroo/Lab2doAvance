<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\LoginController;

Route::get('/', [InicioController::class, 'index']);
Route::get('/receta/{id}', [InicioController::class, 'show'])
    ->name('receta.detalle');

Route::resource('categorias', CategoriaController::class);
Route::get('/busqueda', [BusquedaController::class, 'index'])
    ->name('busqueda');

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [LoginController::class, 'register']);