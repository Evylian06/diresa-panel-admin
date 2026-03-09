<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Gestante;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalGestantes = Gestante::count();

        return view('admin.dashboard', compact('totalGestantes'));
    }

    public function gestantes()
    {
    $gestantes = Gestante::latest()->get();

    return view('admin.gestantes.index', compact('gestantes'));
    }
}
