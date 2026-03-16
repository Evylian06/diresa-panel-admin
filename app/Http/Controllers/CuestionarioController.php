<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
    public function evaluar(Request $request)
    {

        $graves = [
            'perdida_liquido',
            'perdida_sangre',
            'dolor_cabeza_frecuente',
            'edemas',
            'bebe_no_se_mueve',
            'dolor_orinar'
        ];

        $leves = [
            'dolor_cabeza_leve',
            'nauseas',
            'cansancio'
        ];

        $hayGrave = false;
        $hayLeve = false;

        // Verificar síntomas graves
        foreach ($graves as $campo) {
            if ($request->input($campo) == 'si') {
                $hayGrave = true;
            }
        }

        // Verificar síntomas leves
        foreach ($leves as $campo) {
            if ($request->input($campo) == 'si') {
                $hayLeve = true;
            }
        }

        // Determinar nivel
        if ($hayGrave) {
            $mensaje = "🚨 ESTADO GRAVE - ACUDA AL HOSPITAL INMEDIATAMENTE";
            $color = "red";
            $nivel = "grave";
        } elseif ($hayLeve) {
            $mensaje = "⚠ ESTADO LEVE - SE RECOMIENDA CONTROL MÉDICO";
            $color = "orange";
            $nivel = "leve";
        } else {
            $mensaje = "✅ ESTADO NORMAL - TODO ESTÁ BIEN";
            $color = "green";
            $nivel = "normal";
        }

        // Enviar datos a la vista
        return view('cliente.resultado', compact('mensaje','color','nivel'));
    }
}