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

        // 🔎 Buscador
        if ($request->filled('buscar')) {
            $query->where(function($q) use ($request) {
                $q->where('numero_documento', 'like', '%' . $request->buscar . '%')
                  ->orWhere('nombre', 'like', '%' . $request->buscar . '%');
            });
        }

        // 📌 Filtro estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
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
    $gestantes = Gestante::whereNotNull('latitud')
        ->whereNotNull('longitud')
        ->get();

    return view('admin.mapa-gestante', compact('gestantes'));
}
}