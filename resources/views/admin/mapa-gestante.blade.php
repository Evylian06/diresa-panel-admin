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

<div style="padding:20px 40px;">

    {{-- HEADER MAPA --}}
    <div class="map-header">
        <h2>Mapa General de Gestantes</h2>
        <a href="{{ route('admin.gestantes.index') }}">← Volver al Panel</a>
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

    gestantes.forEach(g => {
        if (g.latitud && g.longitud) {

            // Color según estado/gravedad
            let color = "#1A7A4A"; // verde normal
            if (g.estado === "Emergencia") color = "#C0392B"; // rojo
            else if (g.nivel_gravedad === "Medio") color = "#E67E22"; // naranja

            const marker = L.circleMarker(
                [parseFloat(g.latitud), parseFloat(g.longitud)],
                {
                    radius: 8,
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.9
                }
            ).addTo(map);

            // Popup con info
            marker.bindPopup(`
                <strong>${g.nombre} ${g.apellido_paterno}</strong><br>
                Estado: ${g.estado}<br>
                Gravedad: ${g.nivel_gravedad}<br>
                <a href="https://www.google.com/maps?q=${g.latitud},${g.longitud}" target="_blank">
                    Ver en Google Maps
                </a>
            `);
        }
    });
</script>

</x-app-layout>