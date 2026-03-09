<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DIRESA Ucayali – Sistema de Alerta Gestante</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icono-diresa.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,300;0,600;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen" style="background:#F0F4F8;">
        @include('layouts.navigation')
        <main>{{ $slot }}</main>
    </div>
</body>
</html>