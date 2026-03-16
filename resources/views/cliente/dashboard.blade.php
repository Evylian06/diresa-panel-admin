<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Alerta Gestante</title>
<link rel="icon" type="image/png" href="{{ asset('images/dire.jpeg') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(180deg,#e7a6d7,#c47bb9);
}

/* ===== INTRO ===== */
#intro{
    position:fixed;
    width:100%;
    height:100vh;
    background: linear-gradient(180deg,#e7a6d7,#c47bb9);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

#intro img{
    width:220px;
    animation: aparecer 1.5s ease-out forwards, flotar 3s ease-in-out infinite 1.5s;
    opacity:0;
}

@keyframes aparecer{
    from{transform:scale(0.5);opacity:0;}
    to{transform:scale(1);opacity:1;}
}

@keyframes flotar{
    0%{ transform:translateY(0px); }
    50%{ transform:translateY(-10px); }
    100%{ transform:translateY(0px); }
}

#intro h1{
    color:white;
    margin-top:25px;
    font-size:32px;
    letter-spacing:4px;
}

.btn-intro{
    margin-top:30px;
    padding:14px 30px;
    border:none;
    border-radius:30px;
    background:#a02c8f;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.btn-intro:hover{
    background:#861f77;
    transform:scale(1.05);
}

/* ===== CARD ===== */
.card{
    display:none;
    background:#f8f6f8;
    width:90%;
    max-width:450px;
    margin:120px auto;
    padding:30px;
    border-radius:30px;
    box-shadow:0 12px 25px rgba(0,0,0,0.25);
}

.titulo{
    background:#f2c7e9;
    padding:12px;
    border-radius:25px;
    text-align:center;
    font-weight:bold;
    margin-bottom:20px;
    color:#7b2c6f;
}

input, select{
    width:100%;
    padding:12px;
    margin-bottom:18px;
    border-radius:12px;
    border:1px solid #ccc;
}

.botones{
    display:flex;
    justify-content:space-between;
    gap:10px;
}

.btn{
    padding:14px;
    border:none;
    border-radius:30px;
    width:100%;
    font-size:15px;
    cursor:pointer;
}

.btn-crear{
    background:#a02c8f;
    color:white;
}

.btn-llamar{
    background:#ff4d4d;
    color:white;
    text-align:center;
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
}

.alert-error{
    background:#f8d7da;
    color:#721c24;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
}
</style>
</head>
<body>

<div id="intro">
    <img src="{{ asset('images/logo.png') }}">
    <h1 id="texto"></h1>

@if(isset($pacienteRegistrado) && $pacienteRegistrado)
    <a href="{{ route('cliente.cuestionario') }}">
        <button class="btn-intro">Ir al cuestionario</button>
    </a>
@else
    <button class="btn-intro" onclick="mostrarFormulario()">
        Registrar datos
    </button>
@endif

</div>

<!-- FORMULARIO -->
<div class="card" id="contenido" @if(isset($mostrarFormulario)) style="display:block" @endif>

    @if(session('success'))
        <div class="alert-success" id="mensajeExito">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            <ul style="padding-left:15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Cerrar sesión -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-crear" style="background:#444; margin-bottom:15px;">
            🔒 Cerrar Sesión
        </button>
    </form>

    <!-- Formulario principal -->
 
    <form method="POST" action="{{ route('paciente.guardar') }}">
    @csrf

        <!-- CAMPOS OCULTOS DE UBICACIÓN -->
        <input type="hidden" name="latitud" id="latitud">
        <input type="hidden" name="longitud" id="longitud">

        <div class="titulo">Datos del Paciente</div>

        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required>
        <input type="text" name="apellido_materno" placeholder="Apellido Materno" required>

        <select name="id_tipo_documento" required>
            <option value="">Tipo de Documento</option>
            <option value="1">DNI</option>
            <option value="2">Pasaporte</option>
        </select>

        <input type="text" name="nro_documento" placeholder="Número de Documento" required>
        <input type="date" name="fecha_nacimiento" required>
        <input type="text" name="direccion" placeholder="Dirección" required>
        <input type="text" name="celular" maxlength="9" placeholder="Celular (9 dígitos)" required>

        <div class="titulo">Establecimiento</div>

        <select name="id_establecimiento" required>
            <option value="">Seleccione Establecimiento</option>
            <option value="1">Hospital Regional</option>
            <option value="2">Centro de Salud</option>
        </select>

        <div class="botones">
            <button type="submit" class="btn btn-crear">Guardar</button>
            <a href="tel:+5161787927" class="btn btn-llamar">📞 Emergencia</a>
        </div>
    </form>

</div>

<script>
// Texto animado
let mensaje = "ALERTA GESTANTE";
let i = 0;

function escribir(){
    if(i < mensaje.length){
        document.getElementById("texto").innerHTML += mensaje.charAt(i);
        i++;
        setTimeout(escribir, 100);
    }
}
escribir();

function mostrarFormulario(){
    document.getElementById("intro").style.display="none";
    document.getElementById("contenido").style.display="block";
}

/* ===== OCULTAR MENSAJE EN 2 SEGUNDOS ===== */
setTimeout(function(){
    let mensaje = document.getElementById("mensajeExito");
    if(mensaje){
        mensaje.style.transition = "opacity 0.5s";
        mensaje.style.opacity = "0";
        setTimeout(()=> mensaje.remove(), 500);
    }
},2000);

/* ===== OBTENER UBICACIÓN ===== */
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById("latitud").value = position.coords.latitude;
        document.getElementById("longitud").value = position.coords.longitude;
    });
}
</script>

</body>
</html>