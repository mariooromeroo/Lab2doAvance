<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    // Mostrar todos los favoritos del usuario
    public function index()
    {
        $favoritos = Favorito::with('receta.categoria')
            ->where('id_usuario', Auth::id())
            ->get();

        return view('favoritos', compact('favoritos'));
    }

    // Agregar o quitar favorito (toggle)
    public function toggle($id_receta)
    {
        $existente = Favorito::where('id_usuario', Auth::id())
            ->where('id_receta', $id_receta)
            ->first();

        if ($existente) {
            $existente->delete();
            return redirect()->back()->with('success', 'Receta quitada de favoritos.');
        }

        Favorito::create([
            'id_usuario'     => Auth::id(),
            'id_receta'      => $id_receta,
            'fecha_guardado' => now(),
        ]);

        return redirect()->back()->with('success', '¡Receta guardada en favoritos!');
    }
}