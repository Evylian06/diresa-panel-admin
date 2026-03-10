<x-app-layout>

{{-- Leaflet CSS/JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    #map {
        width: 100%;
        height: 500px;
        border-radius: 12px;
        border: 1px solid #D6E1EF;
        box-shadow: 0 4px 18px rgba(26,92,186,.12);
    }

    .map-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
    }

    .map-header h2 {
        font-weight: 600;
        color: #1A2A3A;
    }

    .map-header a {
        background:#1A5CBA;
        color:white;
        padding:8px 18px;
        border-radius:6px;
        text-decoration:none;
        font-weight:500;
    }

    .map-header a:hover {
        background:#2B7DE9;
    }
</style>

<div class="map-stats-grid">

    <div class="map-stat-card">
        <span class="stat-number">{{ $totalGestantes }}</span>
        <span class="stat-label">Total Gestantes</span>
    </div>

    <div class="map-stat-card">
        <span class="stat-number">{{ $totalNormal }}</span>
        <span class="stat-label">Normal</span>
    </div>

    <div class="map-stat-card">
        <span class="stat-number">{{ $totalLeve }}</span>
        <span class="stat-label">Leve</span>
    </div>

    <div class="map-stat-card">
        <span class="stat-number">{{ $totalGrave }}</span>
        <span class="stat-label">Grave</span>
    </div>

    <div class="map-stat-card">
        <span class="stat-number">{{ $totalPuerperio }}</span>
        <span class="stat-label">Puerperio</span>
    </div>

</div>
<div style="margin-top:10px;font-size:14px">
    <span style="color:#27AE60">●</span> Normal
    &nbsp;&nbsp;
    <span style="color:#F1C40F">●</span> Leve
    &nbsp;&nbsp;
    <span style="color:#E74C3C">●</span> Grave
    &nbsp;&nbsp;
    <span style="color:#3498DB">●</span> Puerperio
</div>

<div style="padding:20px 40px;">

    {{-- HEADER MAPA --}}
    <div class="map-header">
        <h2>Mapa General de Gestantes</h2>
        <a href="{{ route('admin.gestantes.index') }}">← Volver al Panel</a>
    </div>

    <div style="margin-bottom:15px; display:flex; gap:10px; align-items:center;">

    <input 
        type="text" 
        id="buscarDNI"
        placeholder="Buscar gestante por DNI..."
        style="padding:8px 12px; border:1px solid #D6E1EF; border-radius:6px; width:220px;"
    >

    <button onclick="buscarGestante()" 
        style="background:#1A5CBA;color:white;padding:8px 16px;border:none;border-radius:6px;">
        Buscar
    </button>

</div>

    {{-- MAPA --}}
    <div id="map"></div>
</div>


<script>
    // Crear mapa centrado en Ucayali
    const map = L.map('map').setView([-8.3791, -74.5539], 7);

    // Capa OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Datos de gestantes
    const gestantes = @json($gestantes);
    const marcadores = {};
    gestantes.forEach(g => {
        if (g.latitud && g.longitud) {

            // Color según estado/gravedad
            let color = "#27AE60"; // Normal

if (g.estado === "Leve") {
    color = "#F1C40F"; // Amarillo
}
else if (g.estado === "Grave") {
    color = "#E74C3C"; // Rojo
}
else if (g.estado === "Puerperio") {
    color = "#3498DB"; // Azul
}
            const marker = L.circleMarker(
                [parseFloat(g.latitud), parseFloat(g.longitud)],
                {
                    radius: 8,
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.9
                }
            ).addTo(map);
            marcadores[g.dni] = marker;

            
            // Popup con info
           marker.bindPopup(`
    <strong>${g.nombre} ${g.apellido_paterno}</strong><br>
    DNI: ${g.dni}<br>
    Estado: ${g.estado}<br>
    Gravedad: ${g.nivel_gravedad}<br>
    <a href="https://www.google.com/maps?q=${g.latitud},${g.longitud}" target="_blank">
        Ver en Google Maps
    </a>
`);
        }
    });

    function buscarGestante() {

    const dni = document.getElementById("buscarDNI").value.trim();

    const marker = marcadores[dni];

    if(marker){

        const latlng = marker.getLatLng();

       map.flyTo(latlng, 14);

        marker.openPopup();

    }else{
        alert("Gestante no encontrada");
    }

}
</script>


</x-app-layout>