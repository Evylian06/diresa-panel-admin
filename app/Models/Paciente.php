<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $primaryKey = 'id_paciente';

    public $timestamps = false; // porque tu tabla no tiene created_at ni updated_at

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nro_documento',
        'fecha_nacimiento',
        'direccion',
        'celular',
        'id_establecimiento',
        'id_tipo_documento',
    ];
}