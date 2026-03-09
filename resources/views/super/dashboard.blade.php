<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            Bienvenida, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tarjeta principal -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-pink-600 font-bold text-lg mb-2">Panel del Director DIRESA</h3>
                <p class="text-gray-600">Aquí puedes ver el resumen de todos los usuarios y gestantes registradas.</p>
            </div>

            <!-- Tarjeta de estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-amber-50 p-5 rounded-xl shadow-sm">
                    <h4 class="text-pink-500 font-semibold">Total Gestantes</h4>
                    <p class="text-gray-700 text-2xl mt-2">25</p>
                </div>
                <div class="bg-amber-50 p-5 rounded-xl shadow-sm">
                    <h4 class="text-pink-500 font-semibold">Enfermeros</h4>
                    <p class="text-gray-700 text-2xl mt-2">5</p>
                </div>
                <div class="bg-amber-50 p-5 rounded-xl shadow-sm">
                    <h4 class="text-pink-500 font-semibold">SuperAdmins</h4>
                    <p class="text-gray-700 text-2xl mt-2">1</p>
                </div>
            </div>

            <!-- Formulario de ejemplo -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h4 class="text-pink-600 font-bold mb-4">Registrar nueva gestante</h4>
                <form class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nombre completo</label>
                        <input type="text" placeholder="Ej: María Pérez" class="border border-pink-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none w-full">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Correo electrónico</label>
                        <input type="email" placeholder="ejemplo@correo.com" class="border border-pink-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:outline-none w-full">
                    </div>
                    <button class="bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                        Registrar
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
