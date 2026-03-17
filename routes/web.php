<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\GestanteController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\Admin\MapaController;

// Redirección inicial
Route::get('/', function () {
    return redirect('/login');
});

// Rutas protegidas por auth
Route::middleware(['auth'])->group(function () {

    // ----------------- DASHBOARD SUPERADMIN -----------------
    Route::get('/super/dashboard', function () {
        return view('super.dashboard');
    })->middleware('role:3')->name('super.dashboard');

    // ----------------- DASHBOARD PERSONAL DE SALUD -----------------
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return redirect()->route('admin.gestantes.index');
        })->middleware('role:2')->name('dashboard');

        Route::resource('gestantes', GestanteController::class)->middleware('role:2');
    });

    // ----------------- DASHBOARD CLIENTE / USUARIO -----------------
    Route::get('/cliente/dashboard', function () {
        $pacienteRegistrado = \App\Models\Paciente::where('Id_paciente', Auth::id())->exists();
        return view('cliente.dashboard', compact('pacienteRegistrado'));
    })->middleware('role:1')->name('cliente.dashboard');

    Route::get('/cliente/cuestionario', function () {
        return view('cliente.cuestionario');
    })->middleware('role:1')->name('cliente.cuestionario');

    Route::post('/cliente/cuestionario/evaluar', function (\Illuminate\Http\Request $request) {

        $indicador = "normal";

        $sintomasGraves = ['perdida_liquido','perdida_sangre','bebe_no_se_mueve'];
        $sintomasLeves  = ['dolor_cabeza_frecuente','edemas','dolor_orinar','dolor_cabeza_leve','nauseas','cansancio'];

        $graves = 0;
        $leves = 0;

        foreach($sintomasGraves as $s){
            if($request->$s == 'si') $graves++;
        }

        foreach($sintomasLeves as $s){
            if($request->$s == 'si') $leves++;
        }

        if($graves >= 1) $indicador = "grave";
        elseif($leves >= 2) $indicador = "leve";

        return view('cliente.resultado', compact('indicador'));

    })->middleware('role:1')->name('cuestionario.evaluar');

    Route::get('/cliente/resultado', function () {
        return view('cliente.resultado');
    })->middleware('role:1')->name('cliente.resultado');

    Route::post('/paciente/guardar', [PacienteController::class, 'guardar'])
        ->middleware('role:1')
        ->name('paciente.guardar');
});

// ----------------- REDIRECCIÓN POST LOGIN -----------------
Route::get('/redirect', function () {
    $user = Auth::user();

    if ($user->Id_rol === 3) return redirect()->route('super.dashboard'); // superadmin
    if ($user->Id_rol === 2) return redirect()->route('admin.dashboard'); // personal de salud
    return redirect()->route('cliente.dashboard'); // usuario común
})->middleware('auth')->name('redirect');

// ----------------- MAPA GESTANTES -----------------
Route::get('/mapa-gestantes', [MapaController::class, 'index'])
    ->name('mapa.gestantes');

// Rutas de Breeze (auth)
require __DIR__.'/auth.php';