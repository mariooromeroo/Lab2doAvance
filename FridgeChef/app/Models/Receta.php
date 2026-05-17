<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
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
}