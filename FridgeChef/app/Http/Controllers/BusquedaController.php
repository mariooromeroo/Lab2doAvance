<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $recetas = Receta::where('titulo', 'LIKE', "%$buscar%")
            ->orWhere('descripcion', 'LIKE', "%$buscar%")
             ->orWhereHas('ingredientes', function ($query) use ($buscar) {
                $query->where(
                    'nombre_ingrediente',
                    'LIKE',
                    "%{$buscar}%"
                );
            })

            ->get();

        return view('busqueda', compact('recetas', 'buscar'));
    }
}
            