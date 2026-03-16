<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gestante;

class GestanteController extends Controller
{
    public function index(Request $request)
    {
        $query = Gestante::query();

        // 🔎 Buscador general
        if ($request->filled('buscar')) {
            $query->where(function($q) use ($request) {
                $q->where('numero_documento', 'like', '%' . $request->buscar . '%')
  ->orWhere('nombre', 'like', '%' . $request->buscar . '%')
  ->orWhere('apellido_paterno', 'like', '%' . $request->buscar . '%')
  ->orWhere('apellido_materno', 'like', '%' . $request->buscar . '%');
            });
        }

        // 📌 Filtro estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // 🔎 FILTRO DNI PARA EL MAPA
        if ($request->filled('dni_mapa')) {
            $query->where('numero_documento', $request->dni_mapa);
        }

        $gestantes = $query->latest()->paginate(10);

        // 📊 Estadísticas
        $totalGestantes = Gestante::count();
        $pendientes = Gestante::where('estado', 'Pendiente')->count();
        $emergencias = Gestante::where('estado', 'Emergencia')->count();

        return view('admin.gestantes.index', compact(
            'gestantes',
            'totalGestantes',
            'pendientes',
            'emergencias'
        ));
    }

    public function mapa()
    {
        $gestantes = Gestante::select(
        'nombre',
        'apellido_paterno',
        'estado',
        'nivel_gravedad',
        'latitud',
        'longitud'
    )
    ->whereNotNull('latitud')
    ->whereNotNull('longitud')
    ->get();

        return view('admin.mapa-gestante', compact('gestantes'));
    }
}