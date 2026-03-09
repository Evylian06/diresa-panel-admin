<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            Mi Panel - {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-pink-600 font-bold text-lg mb-2">Bienvenida</h3>
                <p class="text-gray-600">Aquí puedes consultar tu información y tu progreso de gestación.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-amber-50 p-5 rounded-xl shadow-sm">
                    <h4 class="text-pink-500 font-semibold">Próxima consulta</h4>
                    <p class="text-gray-700 text-xl mt-2">10 Febrero 2026</p>
                </div>
                <div class="bg-amber-50 p-5 rounded-xl shadow-sm">
                    <h4 class="text-pink-500 font-semibold">Peso recomendado</h4>
                    <p class="text-gray-700 text-xl mt-2">65 kg</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
