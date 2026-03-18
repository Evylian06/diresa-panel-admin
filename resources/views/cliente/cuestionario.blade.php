<!DOCTYPE html>
<html>
<head>
<title>Cuestionario</title>
<link rel="icon" type="image/png" href="{{ asset('images/icono.png') }}">

<style>

body{
font-family:Arial;
background:#f26f7a;
padding:20px;
}

.card{
background:#f5c1c8;
padding:25px;
border-radius:25px;
max-width:500px;
margin:auto;
}

h2{
text-align:center;
color:#d45a7c;
}

.pregunta{
display:flex;
justify-content:space-between;
align-items:center;
margin:15px 0;
}

.botones{
display:flex;
gap:10px;
}

.botones input{
display:none;
}

.opcion{
padding:8px 18px;
border-radius:20px;
background:#9e9e9e;
color:white;
cursor:pointer;
}

input:checked + .opcion{
background:#2ecc71;
}

.no:checked + .opcion{
background:#e74c3c;
}

button{
margin-top:20px;
padding:15px;
width:100%;
border:none;
border-radius:25px;
background:#bfa9e3;
color:white;
font-size:16px;
cursor:pointer;
}


/* ===== MODAL ATENCION ===== */

.modal{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
display:none;
justify-content:center;
align-items:center;
}

.modal-box{
background:#eee;
padding:30px;
border-radius:20px;
text-align:center;
width:350px;
}

.modal-box h2{
color:#7c6ae6;
}

.timer{
font-size:40px;
margin:20px 0;
font-weight:bold;
}

.btn-ok{
background:#f4a7b9;
border:none;
padding:12px 30px;
border-radius:20px;
cursor:pointer;
}

.btn-emergencia{
display:inline-block;
margin-top:10px;
background:#ff4d4d;
color:white;
padding:10px 25px;
border-radius:20px;
text-decoration:none;
}

</style>
</head>

<body>


</div>


<div class="card">

<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" style="background:#444;margin-bottom:15px;">
🔒 Cerrar sesión
</button>
</form>

<h2>MARQUE SUS SÍNTOMAS</h2>

<form method="POST" action="{{ route('cuestionario.evaluar') }}">
@csrf

@php
$preguntas = [
'perdida_liquido' => 'Pérdida de líquido',
'perdida_sangre' => 'Pérdida de sangre',
'dolor_cabeza_frecuente' => 'Dolor de cabeza frecuente',
'edemas' => 'Edemas o hinchazón',
'bebe_no_se_mueve' => 'El bebé no se mueve',
'dolor_orinar' => 'Dolor al orinar',
'dolor_cabeza_leve' => 'Dolor de cabeza leve',
'nauseas' => 'Náuseas y vómitos',
'cansancio' => 'Cansancio permanente'
];
@endphp

@foreach($preguntas as $name => $texto)

<div class="pregunta">

<span>{{ $texto }}</span>

<div class="botones">

<input type="radio" id="{{ $name }}_si" name="{{ $name }}" value="si">
<label for="{{ $name }}_si" class="opcion">Sí</label>

<input type="radio" id="{{ $name }}_no" name="{{ $name }}" value="no" class="no" checked>
<label for="{{ $name }}_no" class="opcion">No</label>

</div>

</div>

@endforeach

<button type="submit">ENVIAR CUESTIONARIO</button>

</form>
</div>


<script>

/* ===== CRONOMETRO ===== */

let segundos = 30;

function iniciarCronometro(){

let intervalo = setInterval(function(){

segundos--;

document.getElementById("seg").innerText =
segundos < 10 ? "0"+segundos : segundos;

if(segundos <= 0){
clearInterval(intervalo);
}

},1000);

}

/* ===== MOSTRAR MODAL ===== */

function mostrarDialogo(){
document.getElementById("modalAtencion").style.display="flex";
iniciarCronometro();
}

/* ===== CERRAR MODAL ===== */

function cerrarModal(){
document.getElementById("modalAtencion").style.display="none";
}


/* ===== NOTIFICACIONES POR HORA ===== */

function verificarHora(){

let ahora = new Date();

let horas = ahora.getHours();
let minutos = ahora.getMinutes();

if(horas === 10 && minutos === 0){
mostrarDialogo();
}

if(horas === 18 && minutos === 0){
mostrarDialogo();
}

}

setInterval(verificarHora,60000);


/* ===== MOSTRAR AL ENTRAR A LA PAGINA ===== */

window.onload = function(){
mostrarDialogo();
}

</script>

</body>
</html>