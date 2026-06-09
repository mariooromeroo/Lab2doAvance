<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;


class MisRecetasController extends Controller
{
    public function index()
    {
        $misRecetas = Receta::where('id_usuario', 1)
         ->orderBy('fecha_creacion', 'desc')
         ->get();
        $categorias = Categoria::all();

        return view('mis-recetas', compact('misRecetas', 'categorias'));
    }
}