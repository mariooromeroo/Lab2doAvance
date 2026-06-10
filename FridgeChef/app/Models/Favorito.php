<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';
    protected $primaryKey = 'id_favorito';
    public $timestamps = false;

    protected $fillable = ['id_usuario', 'id_receta', 'fecha_guardado'];

    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta', 'id_receta');
    }
}