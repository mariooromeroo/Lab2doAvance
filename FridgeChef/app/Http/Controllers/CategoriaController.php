<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Mostrar listado de categorías
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulario para crear nueva categoría
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guardar nueva categoría en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre_categoria' => 'required|max:100|unique:categorias,nombre_categoria',
            'descripcion' => 'nullable|string',
        ]);

        // Crear la categoría
        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', '¡Categoría creada exitosamente!');
    }

    /**
     * Mostrar detalles de una categoría específica con sus recetas
     */
    public function show(Categoria $categoria)
    {
        // Carga las recetas relacionadas con esta categoría
        $recetas = $categoria->recetas()->get();
        
        return view('categorias.show', compact('categoria', 'recetas'));
    }

    /**
     * Mostrar formulario para editar categoría
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría en la base de datos
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validar los datos
        $request->validate([
            'nombre_categoria' => 'required|max:100|unique:categorias,nombre_categoria,' . $categoria->id_categoria,
            'descripcion' => 'nullable|string',
        ]);

        // Actualizar la categoría
        $categoria->update([
            'nombre_categoria' => $request->nombre_categoria,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', '¡Categoría actualizada exitosamente!');
    }

    /**
     * Eliminar categoría
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', '¡Categoría eliminada exitosamente!');
    }
}