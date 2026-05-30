<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\BusquedaController;

Route::get('/', [InicioController::class, 'index']);
Route::get('/receta/{id}', [InicioController::class, 'show'])
    ->name('receta.detalle');

Route::resource('categorias', CategoriaController::class);
Route::get('/busqueda', [BusquedaController::class, 'index'])
    ->name('busqueda');