<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <!-- Icono -->
    <link rel="icon" type="image/png" href="{{ asset('images/dire.jpeg') }}">

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-pink-200">

<div class="flex w-full max-w-6xl mx-auto items-center justify-between mt-10">

    <!-- IMAGEN IZQUIERDA -->
    <div class="w-1/2 flex justify-center">
        <img src="{{ asset('images/logo.PNG') }}"
             alt="Logo"
             class="w-[500px] object-contain">
    </div>

    <!-- CARD REGISTER DERECHA -->
    <div class="w-1/2 flex justify-center">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10">

            <h2 class="text-3xl font-bold text-pink-500 text-center mb-8">
                Crear Cuenta 🌸
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" name="name" required
                        class="w-full mt-1 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                </div>

                <div>
                    <label class="block text-gray-700">Correo electrónico</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                </div>

                <div>
                    <label class="block text-gray-700">Contraseña</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                </div>

                <div>
                    <label class="block text-gray-700">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full mt-1 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                </div>

                <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold">
                    Registrarse
                </button>

                <a href="{{ route('login') }}"
                   class="block text-center w-full border border-pink-500 text-pink-500 py-3 rounded-xl font-semibold hover:bg-pink-500 hover:text-white transition">
                    Iniciar sesión
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>