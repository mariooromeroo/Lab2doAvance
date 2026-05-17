<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $table = 'ingredientes';
    protected $primaryKey = 'id_ingrediente';
    public $timestamps = false;

    protected $fillable = [
        'nombre_ingrediente'
    ];

    public function recetas()
    {
        return $this->belongsToMany(
            Receta::class,
            'receta_ingredientes',
            'id_ingrediente',
            'id_receta'
        )->withPivot('cantidad', 'unidad_medida');
    }
}