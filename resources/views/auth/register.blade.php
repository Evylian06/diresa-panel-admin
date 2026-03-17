<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link rel="shortcut icon" href="{{ asset('images/icono-diresa.png') }}">
@vite(['resources/css/app.css'])

<!-- Iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="min-h-screen bg-pink-200 flex items-center">

<div class="flex w-full max-w-6xl mx-auto items-center justify-between">

    <div class="w-1/2 flex justify-center">
        <img src="{{ asset('images/logo.png') }}" class="w-[500px] object-contain">
    </div>

    <div class="w-1/2 flex justify-center">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-12">

            <h2 class="text-4xl font-extrabold text-pink-500 text-center mb-10">
                Crear Cuenta 
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block font-semibold mb-2">Nombre completo</label>
                    <input type="text" name="nombre" required
                        class="w-full py-3 px-4 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400 shadow-sm">
                </div>
<div>
<label class="block font-semibold mb-2">
Usuario (DNI o Carnet de Extranjería)
</label>

<input type="text"
name="dni"
maxlength="10"
inputmode="numeric"
pattern="[0-9]{1,10}"
required
oninput="this.value=this.value.replace(/[^0-9]/g,'')"
title="Ingrese solo números. Use su DNI o Carnet de Extranjería."
class="w-full py-3 px-4 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400 shadow-sm">

<p class="text-sm text-gray-500 mt-1">
Solo ingrese su DNI o Carnet de Extranjería.
</p>
</div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="block font-semibold mb-2">Contraseña</label>
                    <input type="password" name="password" id="password" required
                        class="w-full py-3 px-4 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400 shadow-sm">

                    <i class="fa-solid fa-eye absolute right-4 top-11 cursor-pointer text-pink-500"
                       onclick="togglePassword('password', this)"></i>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="relative">
                    <label class="block font-semibold mb-2">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="confirm_password" required
                        class="w-full py-3 px-4 rounded-xl border-gray-300 focus:border-pink-400 focus:ring-pink-400 shadow-sm">

                    <i class="fa-solid fa-eye absolute right-4 top-11 cursor-pointer text-pink-500"
                       onclick="togglePassword('confirm_password', this)"></i>
                </div>

                <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-xl font-bold transition">
                    Registrarse
                </button>
                <p class="text-center mt-6 text-gray-600">
    ¿Ya tienes cuenta?
    <a href="{{ route('login') }}" class="text-pink-500 font-bold hover:underline">
        Iniciar sesión
    </a>
</p>

            </form>

        </div>
    </div>
</div>

<script>

function togglePassword(id, icon) {

    const input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }else{
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

}

</script>

</body>
</html>