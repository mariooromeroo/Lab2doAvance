<?php

namespace App\Http\Controllers;

use App\Models\Receta;

class InicioController extends Controller
{
    public function index()
    {
        $recetas = Receta::with(['categoria', 'usuario'])
            ->orderBy('fecha_creacion', 'desc')
            ->take(4)
            ->get();

        return view('inicio', compact('recetas'));
    }
}