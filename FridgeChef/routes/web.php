<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriaController;

Route::get('/', [InicioController::class, 'index']);
Route::get('/receta/{id}', [InicioController::class, 'show'])
    ->name('receta.detalle');

Route::resource('categorias', CategoriaController::class);