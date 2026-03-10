<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GestanteController;
use App\Http\Controllers\Admin\MapaController;

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
        return view('cliente.dashboard');
    })->name('cliente.dashboard');



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