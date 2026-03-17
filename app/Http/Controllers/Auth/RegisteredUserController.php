<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
      $request->validate([
    'nombre' => ['required','string','max:50'],
    'dni' => ['required','string','max:12','unique:Usuarios,dni'],
    'password' => ['required','confirmed','min:6'],
]);

$user = User::create([
    'nombre' => $request->nombre,
    'dni' => $request->dni,
    'correo' => null, // no lo usarán
    'password_hash' => Hash::make($request->password),
    'Id_rol' => 1,
]);
     event(new Registered($user));

// iniciar sesión automáticamente
Auth::login($user);

// redirigir al dashboard para rellenar datos
return redirect()->route('cliente.dashboard');
    }
}
