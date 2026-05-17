<?php

use App\Models\Receta;

Route::get('/', function () {
    $recetas = Receta::orderBy('fecha_creacion', 'desc')
        ->take(4)
        ->get();

    return view('inicio', compact('recetas'));
});