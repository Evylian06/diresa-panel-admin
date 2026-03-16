<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GestanteController;
use App\Http\Controllers\Admin\MapaController;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return redirect('/login');
});

// Rutas de dashboard por rol
Route::middleware(['auth'])->group(function () {

    Route::get('/super/dashboard', function () {
        if (Auth::user()->role !== 'superAdmin') abort(403);
        return view('super.dashboard');
    })->name('super.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return redirect()->route('admin.gestantes.index');
        })->name('dashboard');

        Route::resource('gestantes', GestanteController::class);
    });

    Route::get('/cliente/dashboard', function () {

    if (Auth::user()->role !== 'cliente') abort(403);

    $pacienteRegistrado = \App\Models\Paciente::where('user_id', Auth::id())->exists();

    return view('cliente.dashboard', compact('pacienteRegistrado'));

})->name('cliente.dashboard');

    Route::get('/cliente/cuestionario', function () {
    return view('cliente.cuestionario');
})->name('cliente.cuestionario')->middleware('auth');

Route::post('/cliente/cuestionario/evaluar', function (\Illuminate\Http\Request $request) {

    $indicador = "normal";

    $sintomasGraves = [
        'perdida_liquido',
        'perdida_sangre',
        'bebe_no_se_mueve'
    ];

    $sintomasLeves = [
        'dolor_cabeza_frecuente',
        'edemas',
        'dolor_orinar',
        'dolor_cabeza_leve',
        'nauseas',
        'cansancio'
    ];

    $graves = 0;
    $leves = 0;

    foreach($sintomasGraves as $s){
        if($request->$s == 'si'){
            $graves++;
        }
    }

    foreach($sintomasLeves as $s){
        if($request->$s == 'si'){
            $leves++;
        }
    }

    if($graves >= 1){
        $indicador = "grave";
    }
    elseif($leves >= 2){
        $indicador = "leve";
    }

    return view('cliente.resultado', compact('indicador'));

})->name('cuestionario.evaluar');

Route::get('/cliente/resultado', function () {
    return view('cliente.resultado');
})->name('cliente.resultado')->middleware('auth');

Route::post('/paciente/guardar', [PacienteController::class, 'guardar'])
    ->name('paciente.guardar');

});


// Redirección por rol después del login (opcional)
Route::get('/redirect', function () {
    $user = Auth::user();

    if ($user->role === 'superAdmin') return redirect()->route('super.dashboard');
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');

    return redirect()->route('cliente.dashboard');
})->middleware('auth')->name('redirect');

Route::get('/mapa-gestantes', [MapaController::class, 'index'])
    ->name('mapa.gestantes');

// Carga las rutas de Breeze
require __DIR__.'/auth.php';