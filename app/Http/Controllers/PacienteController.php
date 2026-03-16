<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class PacienteController extends Controller
{
 public function guardar(Request $request)
{
    $paciente = Paciente::where('user_id', Auth::id())->first();

    if(!$paciente){

        Paciente::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nro_documento' => $request->nro_documento,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'id_establecimiento' => $request->id_establecimiento,
            'id_tipo_documento' => $request->id_tipo_documento,
        ]);
    }

    return redirect()->route('cliente.cuestionario');
}
}