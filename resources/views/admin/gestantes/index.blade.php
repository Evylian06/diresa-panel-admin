<x-app-layout>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
/* ══════════════════════════════════════════
   TOKENS — Paleta Institucional MINSA/Salud
   Azul medianoche + Teal sanitario + Blanco
   ══════════════════════════════════════════ */
:root {
    --brand-dark:   #0A1628;   /* azul medianoche – sidebar/header */
    --brand-mid:    #0D2137;   /* variante un poco más clara */
    --brand:        #0E6BA8;   /* azul institucional principal */
    --brand-lt:     #1A8FD1;   /* azul claro / hover */
    --teal:         #0B7B6B;   /* teal salud – acento secundario */
    --teal-lt:      #13A898;

    --surface:      #F0F4F8;   /* fondo general */
    --card:         #FFFFFF;
    --border:       #D9E3ED;
    --border-lt:    #EBF1F7;

    --text:         #0F2137;
    --text-mid:     #3D5166;
    --muted:        #7A90A4;

    --danger:       #C0392B;
    --warn:         #D97706;
    --ok:           #0B7B6B;

    --sidebar-w:    240px;
    --header-h:     64px;
    --radius:       10px;
    --radius-lg:    14px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--surface);
    color: var(--text);
    height: 100%;
}

/* ══ SIDEBAR ══════════════════════════════ */
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: var(--sidebar-w);
    height: 100vh;
    background: var(--brand-dark);
    display: flex;
    flex-direction: column;
    z-index: 100;
    border-right: 1px solid rgba(255,255,255,.04);
}

.sidebar-logo {
    padding: 20px 20px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid rgba(255,255,255,.07);
}

.sidebar-logo img {
    height: 40px;
    width: auto;
    flex-shrink: 0;
}

.sidebar-logo .logo-text {
    flex: 1;
    min-width: 0;
}

.sidebar-logo .logo-text h2 {
    font-family: 'Fraunces', serif;
    font-size: .82rem;
    font-weight: 600;
    color: #fff;
    line-height: 1.3;
}

.sidebar-logo .logo-text span {
    font-size: .65rem;
    color: var(--teal-lt);
    letter-spacing: 1.2px;
    text-transform: uppercase;
    font-weight: 500;
}

.sidebar-nav {
    padding: 16px 12px;
    flex: 1;
    overflow-y: auto;
}

.nav-label {
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.28);
    padding: 10px 8px 6px;
    margin-top: 8px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    color: rgba(255,255,255,.58);
    font-size: .82rem;
    font-weight: 500;
    text-decoration: none;
    transition: background .15s, color .15s;
    margin-bottom: 2px;
    cursor: pointer;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
}

.nav-item:hover {
    background: rgba(255,255,255,.06);
    color: rgba(255,255,255,.9);
}

.nav-item.active {
    background: rgba(14,107,168,.35);
    color: #fff;
    border-left: 3px solid var(--brand-lt);
    padding-left: 9px;
}

.nav-item .nav-icon {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    opacity: .7;
}

.nav-item.active .nav-icon { opacity: 1; }

.sidebar-footer {
    padding: 16px 12px;
    border-top: 1px solid rgba(255,255,255,.07);
}

.user-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 8px;
    background: rgba(255,255,255,.05);
}

.user-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--brand), var(--teal));
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; font-weight: 700; color: #fff;
    flex-shrink: 0;
}

.user-info .user-name {
    font-size: .78rem;
    font-weight: 600;
    color: rgba(255,255,255,.88);
}

.user-info .user-role {
    font-size: .65rem;
    color: rgba(255,255,255,.38);
    text-transform: uppercase;
    letter-spacing: .8px;
}

/* ══ TOPBAR ═══════════════════════════════ */
.topbar {
    position: fixed;
    top: 0;
    left: var(--sidebar-w);
    right: 0;
    height: var(--header-h);
    background: var(--card);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 28px;
    z-index: 90;
    box-shadow: 0 1px 4px rgba(10,22,40,.06);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.topbar-title {
    font-size: .9rem;
    font-weight: 700;
    color: var(--text);
}

.topbar-sub {
    font-size: .72rem;
    color: var(--muted);
    font-weight: 400;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: .72rem;
    color: var(--muted);
}

.breadcrumb a { color: var(--brand); text-decoration: none; }
.breadcrumb a:hover { text-decoration: underline; }
.breadcrumb .sep { color: var(--border); }

.topbar-right {
    display: flex;
    align-items: center;
    gap: 14px;
}

.live-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(11,123,107,.08);
    border: 1px solid rgba(11,123,107,.25);
    border-radius: 20px;
    padding: 5px 12px;
    font-size: .68rem;
    color: var(--teal);
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.live-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--teal-lt);
    animation: blink 1.2s ease-in-out infinite;
}

.clock-badge {
    font-size: .75rem;
    font-weight: 600;
    color: var(--text-mid);
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 6px 12px;
    font-variant-numeric: tabular-nums;
}

/* ══ MAIN CONTENT ══════════════════════════ */
.main-layout {
    margin-left: var(--sidebar-w);
    padding-top: var(--header-h);
    min-height: 100vh;
}

.content-wrap {
    padding: 28px 32px 48px;
}

/* ══ STATS ROW ════════════════════════════ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: box-shadow .2s;
    box-shadow: 0 1px 3px rgba(10,22,40,.04);
}

.stat-card:hover { box-shadow: 0 4px 16px rgba(10,22,40,.08); }

.stat-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.stat-icon.blue  { background: rgba(14,107,168,.1); }
.stat-icon.teal  { background: rgba(11,123,107,.1); }
.stat-icon.warn  { background: rgba(217,119,6,.1);  }
.stat-icon.danger{ background: rgba(192,57,43,.1);  }

.stat-body .stat-value {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1;
    font-variant-numeric: tabular-nums;
}

.stat-body .stat-label {
    font-size: .72rem;
    color: var(--muted);
    font-weight: 500;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: .6px;
}

/* ══ ALERTA EMERGENCIA ════════════════════ */
.alert-emergency {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #FEF2F2;
    border: 1px solid #FECACA;
    border-left: 4px solid var(--danger);
    border-radius: var(--radius);
    padding: 14px 20px;
    margin-bottom: 20px;
    font-weight: 600;
    color: var(--danger);
    font-size: .85rem;
    animation: pulse-alert 2.5s ease-in-out infinite;
}

@keyframes pulse-alert {
    0%,100% { border-left-color: var(--danger); }
    50%      { border-left-color: #EF4444; }
}

.alert-icon {
    font-size: 1.3rem;
    animation: shake 2s ease-in-out infinite;
    flex-shrink: 0;
}

@keyframes shake {
    0%,100% { transform: rotate(0); }
    15%     { transform: rotate(-8deg); }
    30%     { transform: rotate(8deg); }
    45%     { transform: rotate(-4deg); }
    60%     { transform: rotate(4deg); }
}

/* ══ SECTION HEADER ════════════════════════ */
.section-hdr {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}

.section-hdr .title-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-hdr .accent-bar {
    width: 3px; height: 22px;
    background: linear-gradient(180deg, var(--brand), var(--teal));
    border-radius: 3px;
}

.section-hdr h2 {
    font-family: 'Fraunces', serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text);
}

.auto-refresh-tag {
    font-size: .68rem;
    color: var(--teal);
    background: rgba(11,123,107,.08);
    border: 1px solid rgba(11,123,107,.2);
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
    letter-spacing: .5px;
}

/* ══ MAP CARD ══════════════════════════════ */
.map-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(10,22,40,.04);
}

.map-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-lt);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.map-card-header .map-title {
    font-size: .88rem;
    font-weight: 700;
    color: var(--text);
}

.map-card-header .map-sub {
    font-size: .72rem;
    color: var(--muted);
    margin-top: 1px;
}

#map {
    height: 340px;
    width: 100%;
}

/* ══ MAP SEARCH DNI ═══════════════════════ */
.map-tools{
    display:flex;
    align-items:center;
    gap:10px;
}

.dni-map-search{
    display:flex;
    align-items:center;
    gap:6px;
}

.dni-map-search input{
    height:34px;
    border:1.5px solid var(--border);
    border-radius:7px;
    padding:0 10px;
    font-size:.75rem;
    font-family:'Plus Jakarta Sans', sans-serif;
    width:130px;
    background:var(--surface);
    outline:none;
}

.dni-map-search input:focus{
    border-color:var(--brand);
    box-shadow:0 0 0 2px rgba(14,107,168,.12);
}

.dni-map-search button{
    height:34px;
    width:34px;
    border:none;
    border-radius:7px;
    background:var(--brand);
    color:white;
    font-size:.8rem;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
}

.dni-map-search button:hover{
    background:var(--brand-lt);
}

.btn-clear{
    background:#e5e7eb;
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
    text-decoration:none;
    color:#374151;
    display:inline-flex;
    align-items:center;
    height:34px;
}

.btn-clear:hover{
    background:#d1d5db;
}

/* ══ FILTER CARD ═══════════════════════════ */
.filter-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px 20px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(10,22,40,.04);
}

.filter-card form {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 12px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.filter-group label {
    font-size: .65rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--muted);
}

.filter-group input,
.filter-group select {
    height: 38px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 0 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .82rem;
    color: var(--text);
    background: var(--surface);
    min-width: 200px;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}

.filter-group input:focus,
.filter-group select:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(14,107,168,.12);
    background: #fff;
}

.btn-primary {
    height: 38px;
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0 20px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, transform .1s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    white-space: nowrap;
}

.btn-primary:hover { background: var(--brand-lt); transform: translateY(-1px); }
.btn-primary:active { transform: translateY(0); }

.btn-ghost {
    height: 38px;
    background: transparent;
    color: var(--muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 0 16px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .82rem;
    font-weight: 500;
    cursor: pointer;
    transition: border-color .2s, color .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.btn-ghost:hover { border-color: var(--brand); color: var(--brand); }

.btn-teal {
    height: 38px;
    background: var(--teal);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0 18px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.btn-teal:hover { background: var(--teal-lt); }

/* ══ TABLE CARD ════════════════════════════ */
.table-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 1px 6px rgba(10,22,40,.05);
}

.table-scroll { overflow-x: auto; }

table {
    width: 100%;
    border-collapse: collapse;
    font-size: .8rem;
}

thead {
    background: var(--brand-dark);
    position: sticky;
    top: 0;
    z-index: 10;
}

thead th {
    padding: 12px 14px;
    text-align: left;
    color: rgba(255,255,255,.6);
    font-size: .65rem;
    font-weight: 700;
    letter-spacing: 1.1px;
    text-transform: uppercase;
    white-space: nowrap;
    border-right: 1px solid rgba(255,255,255,.04);
}

thead th:first-child { border-left: 3px solid var(--teal); }
thead th:last-child  { border-right: none; }

tbody tr {
    border-bottom: 1px solid var(--border-lt);
    transition: background .12s;
}

tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: #F6FAFF; }

tbody tr.row-emergency {
    background: #FEF9F9;
    border-left: 3px solid var(--danger);
}
tbody tr.row-emergency:hover { background: #FEF2F2; }

td {
    padding: 11px 14px;
    color: var(--text-mid);
    white-space: nowrap;
    vertical-align: middle;
}

td.name-cell {
    font-weight: 600;
    color: var(--text);
    white-space: normal;
    min-width: 160px;
}

td.doc-cell {
    font-size: .77rem;
    color: var(--muted);
    font-variant-numeric: tabular-nums;
}

td.id-cell {
    font-weight: 700;
    font-variant-numeric: tabular-nums;
    letter-spacing: .3px;
}

td.date-cell {
    font-size: .74rem;
    color: var(--muted);
    font-variant-numeric: tabular-nums;
}

/* ══ BADGES ════════════════════════════════ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 9px;
    border-radius: 5px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .5px;
    text-transform: uppercase;
    white-space: nowrap;
}

.badge-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* Estado */
.badge-emergencia { background: #FEE2E2; color: var(--danger); }
.badge-emergencia .badge-dot { background: var(--danger); animation: blink 1s infinite; }
.badge-pendiente  { background: #FEF3C7; color: #92400E; }
.badge-pendiente  .badge-dot { background: var(--warn); }
.badge-atendida   { background: #D1FAE5; color: #065F46; }
.badge-atendida   .badge-dot { background: var(--ok); }
.badge-default    { background: #F1F5F9; color: var(--muted); }

/* Gravedad */
.badge-alto  { background: #FEE2E2; color: var(--danger); }
.badge-medio { background: #FEF3C7; color: #92400E; }
.badge-bajo  { background: #D1FAE5; color: #065F46; }

/* Tiempo */
.badge-expirado   { background: #FEE2E2; color: var(--danger); }
.badge-por-vencer { background: #FEF3C7; color: #92400E; }
.badge-en-espera  { background: #DBEAFE; color: #1E40AF; }

@keyframes blink {
    0%,100% { opacity: 1; }
    50%     { opacity: .3; }
}

/* ══ MAP LINK ══════════════════════════════ */
.map-link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    color: var(--brand);
    font-weight: 600;
    font-size: .75rem;
    text-decoration: none;
    padding: 4px 10px;
    border: 1.5px solid rgba(14,107,168,.25);
    border-radius: 6px;
    background: rgba(14,107,168,.06);
    transition: background .2s, border-color .2s;
}
.map-link:hover { background: rgba(14,107,168,.12); border-color: var(--brand); }

/* ══ EMPTY STATE ═══════════════════════════ */
.empty-state {
    text-align: center;
    padding: 56px 24px;
    color: var(--muted);
}
.empty-state .es-icon { font-size: 2.5rem; margin-bottom: 12px; opacity: .4; }
.empty-state p { font-size: .88rem; font-weight: 500; }

/* ══ PAGINATION ════════════════════════════ */
.pagination-wrap {
    padding: 16px 20px;
    border-top: 1px solid var(--border-lt);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--surface);
}

.pagination-info {
    font-size: .74rem;
    color: var(--muted);
    font-weight: 500;
}

/* ══ FOOTER ════════════════════════════════ */
.footer-bar {
    text-align: center;
    padding: 18px;
    font-size: .68rem;
    color: var(--muted);
    letter-spacing: .5px;
    border-top: 1px solid var(--border-lt);
    background: var(--card);
    margin-top: 32px;
}

/* ══ RESPONSIVE ════════════════════════════ */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .sidebar { display: none; }
    .main-layout { margin-left: 0; }
    .topbar { left: 0; }
    .content-wrap { padding: 16px; }
    .stats-grid { grid-template-columns: 1fr 1fr; }
}
</style>

{{-- ══════════════════════════════════════════
     SIDEBAR
     ══════════════════════════════════════════ --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo-diresa.png') }}" alt="DIRESA Ucayali">
        <div class="logo-text">
            <h2>DIRESA Ucayali</h2>
            <span>Alerta Gestante</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Principal</div>
        <a href="{{ route('admin.gestantes.index') }}" class="nav-item active">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"/>
            </svg>
            Gestantes
        </a>
        <a href="{{ route('mapa.gestantes') }}" class="nav-item">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/>
            </svg>
            Mapa General
        </a>

        <div class="nav-label" style="margin-top:16px;">Sistema</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                </svg>
                Cerrar sesión
            </button>
        </form>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name ?? 'Administrador' }}</div>
                <div class="user-role">{{ Auth::user()->role ?? 'admin' }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ══════════════════════════════════════════
     TOPBAR
     ══════════════════════════════════════════ --}}
<div class="topbar">
    <div class="topbar-left">
        <div>
            <div class="topbar-title">Seguimiento de Gestantes</div>
            <div class="breadcrumb">
                <span>Panel</span>
                <span class="sep">/</span>
                <a href="#">Gestantes</a>
                <span class="sep">/</span>
                <span>Listado</span>
            </div>
        </div>
    </div>
    <div class="topbar-right">
        <div class="live-pill">
            <span class="live-dot"></span>
            Tiempo Real
        </div>
        <div class="clock-badge" id="clock">—</div>
    </div>
</div>

{{-- ══════════════════════════════════════════
     MAIN CONTENT
     ══════════════════════════════════════════ --}}
<div class="main-layout">
<div class="content-wrap">

    {{-- ── STATS CARDS ─── --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">🤰</div>
            <div class="stat-body">
                <div class="stat-value">{{ $totalGestantes }}</div>
                <div class="stat-label">Total Gestantes</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon teal">✅</div>
            <div class="stat-body">
                <div class="stat-value">{{ $totalGestantes - $pendientes - $emergencias }}</div>
                <div class="stat-label">Atendidas</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warn">⏳</div>
            <div class="stat-body">
                <div class="stat-value">{{ $pendientes }}</div>
                <div class="stat-label">Pendientes</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon danger">🚨</div>
            <div class="stat-body">
                <div class="stat-value">{{ $emergencias }}</div>
                <div class="stat-label">Emergencias</div>
            </div>
        </div>
    </div>

    {{-- ── ALERTA EMERGENCIA ─── --}}
    @if($emergencias > 0)
    <div class="alert-emergency">
        <span class="alert-icon">🚨</span>
        <span>
            Hay <strong>{{ $emergencias }} gestante{{ $emergencias > 1 ? 's' : '' }}</strong>
            en estado de <strong>EMERGENCIA</strong> que requieren atención inmediata.
        </span>
    </div>
    @endif

    {{-- ── MAPA ─── --}}
    <div class="map-card">
    <div class="map-card-header">
        <div>
            <div class="map-title">📍 Mapa de Ubicación</div>
            <div class="map-sub">Ubicación en tiempo real de gestantes registradas</div>
        </div>

        <div class="map-tools">

    <form method="GET" action="{{ route('admin.gestantes.index') }}" class="dni-map-search">
        <label>Buscar</label>
        <input type="text"
               name="dni_mapa"
               placeholder="Buscar DNI..."
               maxlength="8"
               value="{{ request('dni_mapa') }}">
        <button type="submit">🔍</button>
    </form>



    
      <div class="filter-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="Pendiente"  {{ request('estado')=='Pendiente'  ? 'selected':'' }}>Pendiente</option>
                    <option value="Atendida"   {{ request('estado')=='Atendida'   ? 'selected':'' }}>Atendida</option>
                    <option value="Emergencia" {{ request('estado')=='Emergencia' ? 'selected':'' }}>Emergencia</option>
                </select>
            </div>

    <a href="{{ route('admin.gestantes.index') }}" class="btn-clear">
        Limpiar
    </a>

    <a href="{{ route('mapa.gestantes') }}" class="btn-teal">
        Ver mapa completo
    </a>
        </div>
    </div>
    <div id="map"></div>  <!-- ESTA LÍNEA FALTABA -->
</div>

    {{-- ── SECCIÓN TABLA ─── --}}
    <div class="section-hdr">
        <div class="title-group">
            <div class="accent-bar"></div>
            <h2>Registro de Gestantes</h2>
        </div>
        <span class="auto-refresh-tag">↻ Actualización cada 60s</span>
    </div>

    {{-- ── FILTROS ─── --}}
    <div class="filter-card">
        <form method="GET">
            <div class="filter-group">
                <label>Buscar</label>
                <input type="text" name="buscar"
                    placeholder="DNI, nombre o apellido..."
                    value="{{ request('buscar') }}">
            </div>
            <div class="filter-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="">Todos los estados</option>
                    <option value="Pendiente"  {{ request('estado')=='Pendiente'  ? 'selected':'' }}>Pendiente</option>
                    <option value="Atendida"   {{ request('estado')=='Atendida'   ? 'selected':'' }}>Atendida</option>
                    <option value="Emergencia" {{ request('estado')=='Emergencia' ? 'selected':'' }}>Emergencia</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">
                🔍 Filtrar
            </button>
            @if(request('buscar') || request('estado'))
                <a href="{{ request()->url() }}" class="btn-ghost">✕ Limpiar</a>
            @endif
        </form>
    </div>

    {{-- ── TABLA ─── --}}
    <div class="table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tipo Doc.</th>
                        <th>N° Documento</th>
                        <th>Teléfono</th>
                        <th>Nombre Completo</th>
                        <th>F. Nacimiento</th>
                        <th>Gravedad</th>
                        <th>Tiempo Espera</th>
                        <th>Estado</th>
                        <th>Ubigeo</th>
                        <th>Ubicación</th>
                        <th>F. Registro</th>
                        <th>F. Atendido</th>
                        <th>F. Finalizado</th>
                        <th>Reporte</th>
                        <th>Información</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($gestantes as $g)
                    @php $esEmergencia = $g->estado === 'Emergencia'; @endphp
                    <tr class="{{ $esEmergencia ? 'row-emergency' : '' }}">

                        <td class="doc-cell">{{ $g->tipo_documento }}</td>
                        <td class="id-cell">{{ $g->numero_documento }}</td>
                        <td>{{ $g->telefono ?? '—' }}</td>

                        <td class="name-cell">
                            {{ $g->nombre }} {{ $g->apellido_paterno }} {{ $g->apellido_materno }}
                        </td>

                        <td class="date-cell">{{ $g->fecha_nacimiento ?? '—' }}</td>

                        <td>
                            @php $claseGrav = match($g->nivel_gravedad) {
                                'Grave'  => 'badge-alto',
                                'Normal' => 'badge-medio',
                                default => 'badge-bajo',
                            }; @endphp
                            <span class="badge {{ $claseGrav }}">{{ $g->nivel_gravedad }}</span>
                        </td>

                        <td>
                            @php
                                $claseTiempo = 'badge-en-espera';
                                $textoTiempo = 'En espera';
                                if ($g->fecha_registro) {
                                    $min = now()->diffInMinutes($g->fecha_registro);
                                    if ($min > 60)      { $claseTiempo = 'badge-expirado';   $textoTiempo = 'Expirado'; }
                                    elseif ($min > 30)  { $claseTiempo = 'badge-por-vencer'; $textoTiempo = 'Por vencer'; }
                                }
                            @endphp
                            <span class="badge {{ $claseTiempo }}">{{ $textoTiempo }}</span>
                        </td>

                        <td>
                            @php $claseEst = match($g->estado) {
                                'Emergencia' => 'badge-emergencia',
                                'Pendiente'  => 'badge-pendiente',
                                'Atendida'   => 'badge-atendida',
                                default      => 'badge-default',
                            }; @endphp
                            <span class="badge {{ $claseEst }}">
                                <span class="badge-dot"></span>
                                {{ $g->estado }}
                            </span>
                        </td>

                        {{-- Ubigeo (texto) --}}
                        <td style="font-size:.74rem; min-width:130px; white-space:normal; color:var(--text-mid);">
                            @if($g->distrito || $g->provincia || $g->region)
                                {{ $g->distrito ?? '' }}{{ $g->provincia ? ', '.$g->provincia : '' }}{{ $g->region ? ', '.$g->region : '' }}
                            @else
                                <span style="color:var(--muted);">—</span>
                            @endif
                        </td>

                        {{-- Ubicación GPS --}}
                        <td>
                            @if($g->latitud && $g->longitud)
                                <a class="map-link"
                                   href="https://www.google.com/maps?q={{ $g->latitud }},{{ $g->longitud }}"
                                   target="_blank">📍 Ver mapa</a>
                            @else
                                <span style="color:var(--muted); font-size:.74rem;">Sin GPS</span>
                            @endif
                        </td>

                        <td class="date-cell">{{ $g->fecha_registro   ?? '—' }}</td>
                        <td class="date-cell">{{ $g->fecha_atendido   ?? '—' }}</td>
                        <td class="date-cell">{{ $g->fecha_finalizado ?? '—' }}</td>
                        <td style="max-width:150px; white-space:normal; font-size:.75rem; color:var(--text-mid);">{{ $g->reporte ?? '—' }}</td>
                        <td style="max-width:170px; white-space:normal; font-size:.75rem; color:var(--text-mid);">{{ $g->informacion_declarada ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15">
                            <div class="empty-state">
                                <div class="es-icon">🤰</div>
                                <p>No se encontraron gestantes registradas.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <span class="pagination-info">
                Mostrando {{ $gestantes->firstItem() ?? 0 }}–{{ $gestantes->lastItem() ?? 0 }}
                de {{ $gestantes->total() }} registros
            </span>
            <div>{{ $gestantes->withQueryString()->links() }}</div>
        </div>
    </div>

</div>

{{-- ── FOOTER ─── --}}
<div class="footer-bar">
    DIRESA Ucayali &nbsp;·&nbsp; Sistema de Alerta Gestante &nbsp;·&nbsp;
    Panel Administrativo &nbsp;·&nbsp; © {{ date('Y') }}
</div>
</div>

{{-- ══════════════════════════════════════════
     SCRIPTS
     ══════════════════════════════════════════ --}}
<script>
// ── Reloj ──────────────────────────────────
function updateClock() {
    document.getElementById('clock').textContent =
        new Date().toLocaleString('es-PE', {
            day:'2-digit', month:'2-digit', year:'numeric',
            hour:'2-digit', minute:'2-digit', second:'2-digit'
        });
}
updateClock();
setInterval(updateClock, 1000);

// ── Auto refresh ───────────────────────────
setTimeout(() => window.location.reload(), 60000);

// ── Mapa Leaflet ───────────────────────────
const map = L.map('map').setView([-8.3791, -74.5539], 7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

function getIcon(estado) {
    const urls = {
        'Emergencia': 'https://cdn-icons-png.flaticon.com/512/564/564619.png',
        'Pendiente':  'https://cdn-icons-png.flaticon.com/512/3177/3177361.png',
    };
    return L.icon({
        iconUrl: urls[estado] ?? 'https://cdn-icons-png.flaticon.com/512/3177/3177367.png',
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -32],
    });
}

const gestantes = @json($gestantes);
const group = L.featureGroup();

gestantes.forEach(g => {
    if (!g.latitud || !g.longitud) return;
    const marker = L.marker([parseFloat(g.latitud), parseFloat(g.longitud)], {
        icon: getIcon(g.estado)
    }).addTo(map);
    group.addLayer(marker);
    marker.bindPopup(`
        <div style="font-family:'Plus Jakarta Sans',sans-serif; min-width:180px;">
            <strong style="font-size:.9rem;">${g.nombre} ${g.apellido_paterno ?? ''}</strong><br>
            <span style="font-size:.75rem; color:#6B7280;">DNI: ${g.numero_documento}</span><br>
            <hr style="margin:6px 0; border-color:#E5E7EB;">
            <span style="font-size:.78rem;">Estado: <b>${g.estado}</b></span><br>
            <span style="font-size:.78rem;">Gravedad: <b>${g.nivel_gravedad ?? '—'}</b></span>
            ${(g.distrito||g.provincia) ? `<br><span style="font-size:.74rem; color:#6B7280;">${g.distrito ?? ''}${g.provincia ? ', '+g.provincia : ''}</span>` : ''}
        </div>
    `);
});

if (group.getLayers().length > 0) {
    map.fitBounds(group.getBounds().pad(0.15));
} else {
    map.setView([-8.3791, -74.5539], 7);
}
</script>

</x-app-layout>