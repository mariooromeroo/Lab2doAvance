<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::get('/', [InicioController::class, 'index']);
Route::get('/receta/{id}', [InicioController::class, 'show'])
    ->name('receta.detalle');