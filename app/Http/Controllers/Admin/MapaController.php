<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gestante;

class MapaController extends Controller
{
    public function index()
    {
        $gestantes = Gestante::all();

        $totalGestantes = Gestante::count();
        $totalNormal = Gestante::where('estado','Normal')->count();
        $totalLeve = Gestante::where('estado','Leve')->count();
        $totalGrave = Gestante::where('estado','Grave')->count();
        $totalPuerperio = Gestante::where('estado','Puerperio')->count();

        return view('admin.mapa-gestante', compact(
            'gestantes',
            'totalGestantes',
            'totalNormal',
            'totalLeve',
            'totalGrave',
            'totalPuerperio'
        ));
    }
}