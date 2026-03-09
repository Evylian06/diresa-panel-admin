<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Gestante extends Model
{
    protected $fillable = [
        'DNI',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'telefono',
        'nivel_gravedad',
        'estado',
        'latitud',
        'longitud',
    ];
}