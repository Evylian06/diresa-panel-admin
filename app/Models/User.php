<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'Usuarios';

    protected $primaryKey = 'Id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'dni',
        'correo',
        'password_hash',
        'Id_rol'
    ];

       public function getAuthIdentifierName()
    {
        return 'dni';
    }

    protected $hidden = [
        'password_hash'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}