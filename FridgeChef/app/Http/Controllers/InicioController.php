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

    public function show($id)
    {
        $receta = Receta::with('ingredientes', 'comentarios.usuario')->findOrFail($id);

        return view('detalle', compact('receta'));
    }
}