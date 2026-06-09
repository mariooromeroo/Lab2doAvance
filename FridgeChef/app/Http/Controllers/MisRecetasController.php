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
    $misRecetas = Receta::where('id_usuario', Auth::id())->get();
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
            'dificultad' => 'nullable|string|max:50',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Guardar imagen        
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img'), $nombre);
        $imagenPath = $nombre;
}
        // Crear la receta
        $receta = Receta::create([
            'id_usuario' => Auth::id(),
            'id_categoria' => $request->id_categoria,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'preparacion' => $request->preparacion,
            'tiempo_preparacion' => $request->tiempo_preparacion,
            'porciones' => $request->porciones,
            'dificultad' => $request->dificultad,
            'imagen' => $imagenPath,
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
    
    public function edit($id)
    {
    $receta = Receta::with('ingredientes')->where('id_usuario', Auth::id())->findOrFail($id);
    $categorias = Categoria::all();
    return view('editar-receta', compact('receta', 'categorias'));
    }

    public function update(Request $request, $id)
    {
    $receta = Receta::where('id_usuario', Auth::id())->findOrFail($id);

    $request->validate([
        'titulo' => 'required|max:150',
        'descripcion' => 'required',
        'preparacion' => 'required',
        'tiempo_preparacion' => 'required|integer',
        'porciones' => 'required|integer',
        'id_categoria' => 'required',
        'dificultad' => 'nullable|string|max:50',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Guardar nueva imagen si se sube
    $imagenPath = $receta->imagen;
    if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img'), $nombre);
        $imagenPath = $nombre;
    }

    // Actualizar receta
    $receta->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'preparacion' => $request->preparacion,
        'tiempo_preparacion' => $request->tiempo_preparacion,
        'porciones' => $request->porciones,
        'id_categoria' => $request->id_categoria,
        'imagen' => $imagenPath,
    ]);

    // Eliminar ingredientes antiguos y volver a agregar
    $receta->ingredientes()->detach();
    
    if ($request->has('ingredientes')) {
        foreach ($request->ingredientes as $ingrediente) {
            if (!empty($ingrediente['nombre'])) {
                $ing = Ingrediente::firstOrCreate(
                    ['nombre_ingrediente' => $ingrediente['nombre']]
                );
                $receta->ingredientes()->attach($ing->id_ingrediente, [
                    'cantidad' => $ingrediente['cantidad'] ?? '',
                    'unidad_medida' => $ingrediente['unidad'] ?? ''
                ]);
            }
        }
    }

    return redirect()->route('mis-recetas')->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy($id)
    {
    $receta = Receta::where('id_usuario', Auth::id())->findOrFail($id);
    
    // Eliminar ingredientes relacionados (tabla receta_ingredientes)
    $receta->ingredientes()->detach();
    
    // Eliminar comentarios relacionados
    $receta->comentarios()->delete();
    
    // Eliminar la imagen si existe
    if ($receta->imagen && file_exists(public_path('img/' . $receta->imagen))) {
        unlink(public_path('img/' . $receta->imagen));
    }
    
    // Eliminar la receta
    $receta->delete();

    return redirect()->route('mis-recetas')->with('success', 'Receta eliminada correctamente.');
    }
}