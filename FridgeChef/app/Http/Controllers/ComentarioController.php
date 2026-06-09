<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, $id_receta)
    {
        $request->validate([
            'comentario' => 'required|string|min:3|max:500',
        ]);

        Comentario::create([
            'id_receta' => $id_receta,
            'id_usuario' => Auth::id(),
            'comentario' => $request->comentario,
            'fecha_comentario' => now(),
        ]);

        return redirect()->back()->with('success', 'Comentario agregado.');
    }

    public function destroy($id_comentario)
    {
        $comentario = Comentario::findOrFail($id_comentario);

        if (Auth::id() !== $comentario->id_usuario) {
            return redirect()->back()->with('error', 'No puedes eliminar este comentario.');
        }

        $comentario->delete();
        return redirect()->back()->with('success', 'Comentario eliminado.');
    }
}