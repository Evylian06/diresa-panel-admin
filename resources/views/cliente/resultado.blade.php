<!DOCTYPE html>
<html>
<head>

<title>Resultado</title>
<link rel="icon" type="image/png" href="{{ asset('images/dire.jpeg') }}">



<style>

body{
font-family:Arial;
background:#4b004f;
text-align:center;
padding:30px;
color:white;
}

.btn-inicio{
display:inline-block;
padding:10px 25px;
border:2px solid #ffb3c6;
border-radius:25px;
color:#ffb3c6;
text-decoration:none;
margin-bottom:10px;
}

.btn-emergencia{
display:inline-block;
background:#8e6a7a;
padding:10px 25px;
border-radius:25px;
color:white;
text-decoration:none;
margin-bottom:30px;
}

.card{
background:#5d0062;
padding:40px;
border-radius:30px;
max-width:500px;
margin:auto;
}

h1{
font-size:30px;
margin-bottom:30px;
}

img{
width:150px;
margin-bottom:30px;
}

.cronometro{
display:flex;
justify-content:center;
gap:20px;
}

.tiempo{
background:#9e8aa5;
padding:20px;
border-radius:15px;
font-size:30px;
width:70px;
}

/* MODAL */

.modal{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.5);
display:flex;
justify-content:center;
align-items:center;
}

.modal-contenido{
background:#eee;
padding:30px;
border-radius:20px;
text-align:center;
width:350px;
color:black;
}

.modal-contenido h2{
color:#7b68ee;
}

.modal-contenido button{
margin-top:20px;
padding:12px 40px;
border:none;
border-radius:25px;
background:#e69aa7;
color:white;
font-size:16px;
cursor:pointer;
}

</style>

</head>

<body>
    @php
$indicador = $indicador ?? 'normal';
@endphp
    

<h1>RESULTADO DEL CUESTIONARIO</h1>

<h2>Indicador: {{ strtoupper($indicador) }}</h2>

@if($indicador == "grave")
<p style="color:red;font-size:20px;">
🚨 Riesgo grave. Acuda inmediatamente al establecimiento de salud.
</p>
@endif

@if($indicador == "leve")
<p style="color:orange;font-size:20px;">
⚠️ Presenta síntomas leves. Acuda a su centro de salud para evaluación.
</p>
@endif

@if($indicador == "normal")
<p style="color:green;font-size:20px;">
✅ No presenta signos de alarma.
</p>
@endif

<a href="{{ route('cliente.dashboard') }}" class="btn-inicio">
VOLVER AL INICIO
</a>

<br>

<a href="tel:+5161787927" class="btn-emergencia">
📞 Emergencia : +51 61 787927
</a>

<div class="card">

<h1>NIVEL DE GRAVEDAD: {{ strtoupper($indicador) }}</h1>

<img src="{{ asset('images/logo.jpeg') }}">

@if($indicador == "grave")

<div class="cronometro">

<div class="tiempo" id="min">30</div>
<div class="tiempo" id="seg">00</div>

</div>

@endif

</div>


@if($indicador == "grave")

<div id="modalAlerta" class="modal">

<div class="modal-contenido">

<h2>ATENCIÓN EN PROCESO</h2>

<p>
En breve, el personal de salud se comunicará con usted.
Guarde reposo hasta que el personal encargado la atienda.
</p>

<button onclick="cerrarModal()">OK</button>

</div>

</div>

@endif

<script>

@if($indicador == "grave")

let tiempo = 1800;

setInterval(function(){

let minutos = Math.floor(tiempo / 60);
let segundos = tiempo % 60;

document.getElementById("min").innerHTML = minutos;
document.getElementById("seg").innerHTML =
(segundos < 10 ? "0"+segundos : segundos);

tiempo--;

},1000);

@endif

function cerrarModal(){
document.getElementById("modalAlerta").style.display = "none";
}

</script>

</body>
</html>