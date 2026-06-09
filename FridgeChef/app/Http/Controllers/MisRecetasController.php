<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisRecetasController extends Controller
{
    public function index()
    {
        $misRecetas = Receta::where('id_usuario', Auth::id())
         ->orderBy('fecha_creacion', 'desc')
         ->get();
        $categorias = Categoria::all();

        return view('mis-recetas', compact('misRecetas', 'categorias'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'required',
            'preparacion' => 'required',
            'tiempo_preparacion' => 'required',
            'id_categoria' => 'required',
        ]);

        // Crear la receta
        $receta = Receta::create([
            'id_usuario' => Auth::id(),
            'id_categoria' => $request->id_categoria,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'preparacion' => $request->preparacion,
            'tiempo_preparacion' => $request->tiempo_preparacion,
            'porciones' => $request->porciones,
            'fecha_creacion' => now(),
        ]);

        // Guardar ingredientes si existen
        if ($request->has('ingredientes')) {
            foreach ($request->ingredientes as $ingrediente) {
                if (!empty($ingrediente['nombre'])) {
                    // Buscar o crear el ingrediente
                    $ing = Ingrediente::firstOrCreate(
                        ['nombre_ingrediente' => $ingrediente['nombre']]
                    );
                    // Relacionar ingrediente con la receta
                    $receta->ingredientes()->attach($ing->id_ingrediente, [
                        'cantidad' => $ingrediente['cantidad'] ?? '',
                        'unidad_medida' => $ingrediente['unidad'] ?? ''
                    ]);
                }
            }
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('mis-recetas')->with('success', '¡Receta creada exitosamente!');
    }
    
}