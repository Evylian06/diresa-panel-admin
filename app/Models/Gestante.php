<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestante extends Model
{
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'telefono',

        'ubigeo',
        'region',
        'provincia',
        'distrito',
        'direccion',

        'latitud',
        'longitud',

        'estado',
        'nivel_gravedad',
        'semanas_gestacion',

        'fecha_registro',
        'fecha_atendido',
        'fecha_finalizado',

        'reporte',
        'informacion_declarada',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_registro' => 'datetime',
        'fecha_atendido' => 'datetime',
        'fecha_finalizado' => 'datetime',
        'latitud' => 'float',
        'longitud' => 'float',
    ];
}