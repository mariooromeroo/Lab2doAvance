<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Receta extends Model
{
    protected $table = 'recetas';
    protected $primaryKey = 'id_receta';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_categoria',
        'titulo',
        'descripcion',
        'preparacion',
        'tiempo_preparacion',
        'porciones',
        'imagen',
        'fecha_creacion'
    ];

    public function usuario()
    {
    return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function ingredientes()
    {
        return $this->belongsToMany(
            Ingrediente::class,
            'receta_ingredientes',
            'id_receta',
            'id_ingrediente'
        )->withPivot('cantidad', 'unidad_medida');
    }
    
    public function comentarios()
    {
    return $this->hasMany(Comentario::class, 'id_receta', 'id_receta')
        ->orderBy('fecha_comentario', 'desc');
    }
}