<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link rel="shortcut icon" href="{{ asset('images/icono-diresa.png') }}">

@vite(['resources/css/app.css'])

</head>

<body class="min-h-screen bg-gradient-to-r from-pink-100 to-pink-200 flex items-center">

<div class="flex w-full max-w-6xl mx-auto items-center justify-between gap-10">

<!-- IMAGEN -->
<div class="w-1/2 flex justify-center">
<img src="{{ asset('images/logo.png') }}"
alt="Logo"
class="w-[420px] object-contain drop-shadow-xl">
</div>

<!-- LOGIN -->
<div class="w-1/2 flex justify-center">

<div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-10">

<h2 class="text-3xl font-extrabold text-pink-600 text-center mb-8">
Sistema de Alertas
</h2>

<form method="POST" action="{{ route('login') }}" class="space-y-6">
@csrf

<!-- USUARIO -->
<div>

<label class="block text-gray-700 font-semibold mb-2">
Nombre de usuario
</label>

<div class="relative">

<span class="absolute left-3 top-3 text-gray-400">
👤
</span>

<input 
type="text"
name="dni"
maxlength="8"
pattern="[0-9]{8}"
inputmode="numeric"
placeholder="ingrese usuario"
required
class="w-full pl-10 py-3 rounded-xl border border-gray-300 focus:border-pink-400 focus:ring focus:ring-pink-200 outline-none">

</div>

</div>

<!-- CONTRASEÑA -->
<div>

<label class="block text-gray-700 font-semibold mb-2">
Contraseña
</label>

<div class="relative">

<span class="absolute left-3 top-3 text-gray-400">
🔒
</span>

<input
type="password"
name="password"
placeholder="Ingrese su contraseña"
required
class="w-full pl-10 py-3 rounded-xl border border-gray-300 focus:border-pink-400 focus:ring focus:ring-pink-200 outline-none">

</div>

</div>

<!-- RECORDAR -->
<div class="flex items-center justify-between text-sm">

<label class="flex items-center gap-2 text-gray-600">
<input type="checkbox" name="remember"
class="rounded text-pink-500 focus:ring-pink-400">
Recordarme
</label>

</div>

<!-- BOTÓN -->
<button
type="submit"
class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold shadow-md transition">

Iniciar sesión

</button>

<!-- REGISTRO -->
<p class="text-center text-sm text-gray-600 mt-6">
¿No tienes una cuenta?

<a href="{{ route('register') }}"
class="text-pink-500 font-semibold hover:underline">

Regístrate aquí

</a>

</p>

</form>

</div>

</div>

</div>

</body>
</html>