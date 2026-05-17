<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    
    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
    ];

    
    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public $timestamps = false;
}