<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'CorporationAOSC')</title>

<link rel="icon" href="{{ asset('iconos/logotipo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

@vite(['resources/css/styles.css', 'resources/js/app.js'])

<style>
    :root {
        --primary: {{ DB::table('settings')->where('key','accent_color')->value('value') ?? '#dc2626' }};
        --bg:        #f0f4f8;
        --text:      #1a2332;
        --sidebar-w: 248px;
    }

    * { box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--text);
        display: flex;
        height: 100vh;
        overflow: hidden;
        margin: 0;
    }

    .bg-primary   { background-color: var(--primary) !important; }
    .text-primary { color: var(--primary) !important; }

    /* ══════════════════════════════
       OVERLAY MÓVIL
    ══════════════════════════════ */
    #overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 40;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    #overlay.active {
        opacity: 1;
        pointer-events: all;
    }

    /* ══════════════════════════════
       SIDEBAR BASE (móvil primero)
    ══════════════════════════════ */
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 50;
        width: var(--sidebar-w);
        height: 100vh;
        background: var(--primary);
        background-image: radial-gradient(circle, rgba(255,255,255,0.07) 1px, transparent 1px);
        background-size: 22px 22px;
        display: flex;
        flex-direction: column;
        border-right: 1px solid rgba(255,255,255,0.12);
        /* OCULTO por defecto en móvil */
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(.4,0,.2,1),
                    width    0.3s cubic-bezier(.4,0,.2,1);
    }

    /* Abierto en móvil */
    #sidebar.sidebar-open {
        transform: translateX(0);
    }

    /* En escritorio: siempre visible y estático */
    @media (min-width: 1024px) {
        #sidebar {
            position: static;
            transform: none !important;
        }
    }

    /* MINI SIDEBAR (escritorio) */
    .sidebar-mini {
        width: 68px !important;
    }
    .sidebar-mini .sidebar-section,
    .sidebar-mini .nav-text,
    .sidebar-mini .chevron,
    .sidebar-mini .user-info,
    .sidebar-mini .logo-text {
        display: none !important;
    }
    .sidebar-mini nav a,
    .sidebar-mini .submenu-trigger {
        justify-content: center;
        padding-left: 0 !important;
    }
    .sidebar-mini #submenu-ajustes {
        display: none !important;
    }

    /* ── LOGO ── */
    .logo-area {
        padding: 16px 14px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .logo-area img {
        max-height: 52px;
        width: auto;
        object-fit: contain;
    }

    /* ── USER CARD ── */
    .user-card {
        margin: 12px 10px;
        padding: 10px 12px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        border: 1.5px solid rgba(255,255,255,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #fff;
        font-weight: 600;
        flex-shrink: 0;
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-info { flex: 1; min-width: 0; }

    .user-info .name {
        color: #fff;
        font-size: 12.5px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-info .role {
        color: rgba(255,255,255,0.5);
        font-size: 10.5px;
    }

    /* ── NAV ── */
    nav.nav-primary {
        flex: 1;
        padding: 4px 10px;
        overflow-y: auto;
        scrollbar-width: none;
    }
    nav.nav-primary::-webkit-scrollbar { display: none; }

    .sidebar-section {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.35);
        padding: 14px 8px 4px;
        margin: 0;
        user-select: none;
    }

    /* ── ITEMS NAV ── */
    nav.nav-primary a {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        margin-bottom: 2px;
        border-radius: 10px;
        color: rgba(255,255,255,0.72);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        overflow: hidden;
        transition:
            background 0.18s ease,
            color      0.18s ease,
            transform  0.16s cubic-bezier(.34,1.56,.64,1),
            padding-left 0.18s ease;
    }

    nav.nav-primary a::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0);
        border-radius: inherit;
        transition: background 0.18s ease;
    }

    nav.nav-primary a:hover {
        color: #fff;
        transform: translateX(3px);
        padding-left: 14px;
    }

    nav.nav-primary a:hover::before {
        background: rgba(255,255,255,0.14);
    }

    nav.nav-primary a::after {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%) scaleY(0);
        width: 3px;
        height: 55%;
        background: #fff;
        border-radius: 0 3px 3px 0;
        transition: transform 0.2s cubic-bezier(.34,1.56,.64,1);
    }

    nav.nav-primary a:hover::after,
    nav.nav-primary a.active-link::after {
        transform: translateY(-50%) scaleY(1);
    }

    .nav-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(255,255,255,0.1);
        flex-shrink: 0;
        font-size: 13px;
        transition: background 0.18s ease, transform 0.2s cubic-bezier(.34,1.56,.64,1);
    }

    nav.nav-primary a:hover .nav-icon {
        background: rgba(255,255,255,0.22);
        transform: scale(1.1);
    }

    nav.nav-primary a.active-link {
        color: #fff;
        background: rgba(255,255,255,0.18);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.15),
                    0 2px 8px rgba(0,0,0,0.12);
    }

    nav.nav-primary a.active-link .nav-icon {
        background: rgba(255,255,255,0.25);
    }

    .chevron {
        margin-left: auto;
        font-size: 10px;
        color: rgba(255,255,255,0.4);
        transition: transform 0.3s ease, color 0.2s;
        flex-shrink: 0;
    }

    nav.nav-primary a:hover .chevron { color: rgba(255,255,255,0.8); }

    /* ── SUBMENÚ ── */
    #submenu-ajustes {
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(.4,0,.2,1), opacity 0.3s ease;
        max-height: 500px;
        opacity: 1;
        margin: 2px 0 4px 14px;
        padding-left: 12px;
        border-left: 1.5px solid rgba(255,255,255,0.18);
    }

    #submenu-ajustes.hidden {
        max-height: 0 !important;
        opacity: 0;
        display: flex !important;
        flex-direction: column;
    }

    #submenu-ajustes a {
        font-size: 12px !important;
        font-weight: 400 !important;
        color: rgba(255,255,255,0.62) !important;
        padding: 7px 10px !important;
        border-radius: 8px !important;
        margin-bottom: 1px !important;
    }

    #submenu-ajustes a:hover  { color: #fff !important; }
    #submenu-ajustes a.active-link { color: #fff !important; }

    /* ── FOOTER LOGOUT ── */
    .sidebar-footer {
        padding: 10px 12px 14px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .btn-logout {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        border-radius: 10px;
        color: rgba(255,255,255,0.6);
        font-size: 12.5px;
        font-weight: 500;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        background: none;
        border: none;
        transition: background 0.18s ease, color 0.18s ease, transform 0.16s ease;
    }

    .btn-logout:hover {
        background: rgba(255,80,80,0.2);
        color: #fca5a5;
        transform: translateX(3px);
    }

    .btn-logout .nav-icon {
        background: rgba(255,255,255,0.08);
        transition: background 0.18s ease;
    }

    .btn-logout:hover .nav-icon {
        background: rgba(255,80,80,0.25);
    }

    /* ══════════════════════════════
       HEADER
    ══════════════════════════════ */
    .top-header {
        height: 56px;
        background: #fff;
        border-bottom: 1px solid #e8edf3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        flex-shrink: 0;
    }

    .header-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #e8edf3;
        background: #fff;
        color: #64748b;
        cursor: pointer;
        font-size: 15px;
        transition: background 0.15s, color 0.15s, border-color 0.15s;
    }

    .header-btn:hover {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }

    .header-user-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 12px 5px 6px;
        border: 1px solid #e8edf3;
        border-radius: 999px;
        background: #f8fafc;
        font-size: 12px;
        color: #475569;
        font-weight: 500;
        transition: border-color 0.15s, background 0.15s;
    }

    .header-user-chip:hover {
        border-color: var(--primary);
        background: #fff;
    }

    .header-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #fff;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ══════════════════════════════
       CONTENIDO PRINCIPAL
    ══════════════════════════════ */
    #main-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
    }

    main {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        background: var(--bg);
    }

    /* botón hamburguesa: visible solo en móvil */
    .btn-mobile-menu  { display: flex; }
    .btn-desktop-menu { display: none; }

    @media (min-width: 1024px) {
        .btn-mobile-menu  { display: none; }
        .btn-desktop-menu { display: flex; }
    }
</style>
</head>

<body>

<!-- OVERLAY -->
<div id="overlay" onclick="closeSidebar()"></div>

<!-- ═══ SIDEBAR ═══ -->
<aside id="sidebar">

    <!-- LOGO -->
    <div class="logo-area">
        <img src="{{ asset('iconos/logotipo.png') }}" alt="Logo AOSC"
            onerror="this.style.display='none'; document.getElementById('logo-fallback').style.display='flex'">
        <div id="logo-fallback"
            style="display:none; align-items:center; gap:8px;">
            <div style="width:36px;height:36px;background:rgba(255,255,255,0.15);border-radius:10px;
                        display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);">
                <i class="fa fa-building" style="color:#fff;font-size:15px;"></i>
            </div>
            <div class="logo-text" style="display:flex;flex-direction:column;line-height:1.2;">
                <strong style="color:#fff;font-size:13.5px;font-weight:700;letter-spacing:0.04em;">GRUPO AOSC</strong>
                <small style="color:rgba(255,255,255,0.5);font-size:10px;text-transform:uppercase;letter-spacing:0.06em;">Sistema de gestión</small>
            </div>
        </div>
    </div>

    <!-- USUARIO -->
    <div class="user-card">

        <div class="user-avatar">

           <img src="{{ isset($logo) && $logo 
            ? asset($logo) 
            : asset('perfil/default.png') }}"
            alt="user">
            
        </div>

        <div class="user-info">
            <div class="name">{{ auth()->user()->name ?? 'Administrador' }}</div>
            <div class="role">{{ auth()->user()->email ?? 'admin@aosc.com' }}</div>
        </div>
    </div>

    <!-- MENÚ -->
    <nav class="nav-primary">

        <p class="sidebar-section">Principal</p>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.pos.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-store"></i></span>
            <span class="nav-text">Punto de Venta</span>
        </a>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.caja.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-desktop"></i></span>
            <span class="nav-text">Caja</span>
        </a>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.clientes.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-users"></i></span>
            <span class="nav-text">Cliente</span>
        </a>

        <p class="sidebar-section">Operaciones</p>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.compras.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-shopping-cart"></i></span>
            <span class="nav-text">Compras</span>
        </a>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.creditos.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-credit-card"></i></span>
            <span class="nav-text">Créditos</span>
        </a>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.inventario.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-box"></i></span>
            <span class="nav-text">Inventario</span>
        </a>

        <p class="sidebar-section">Análisis</p>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.informes.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-chart-bar"></i></span>
            <span class="nav-text">Informes</span>
        </a>

        <a href="#" class="flex items-center {{ request()->routeIs('admin.tablero.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-th-large"></i></span>
            <span class="nav-text">Tablero</span>
        </a>

        <p class="sidebar-section">Configuración</p>

        <a href="#" onclick="toggleAjustes()" class="submenu-trigger flex items-center
            {{ request()->routeIs('admin.ConfiguracionVisual.*', 'admin.LibroReclamacion.*', 'admin.AdministracionGeneral.*') ? 'active-link' : '' }}">
            <span class="nav-icon"><i class="fa fa-cog"></i></span>
            <span class="nav-text">Ajustes</span>
            <i class="fa fa-chevron-right chevron
                {{ request()->routeIs('admin.ConfiguracionVisual.*', 'admin.LibroReclamacion.*', 'admin.AdministracionGeneral.*') ? 'rotate-90' : '' }}"></i>
        </a>

        <div id="submenu-ajustes"
            class="{{ request()->routeIs('admin.ConfiguracionVisual.*', 'admin.LibroReclamacion.*', 'admin.AdministracionGeneral.*') ? '' : 'hidden' }}">

            <a href="{{ route('admin.AdministracionGeneral.index') }}" class="flex items-center {{ request()->routeIs('admin.AdministracionGeneral.*') ? 'active-link' : '' }}">
                <span class="nav-icon"><i class="fa fa-user-cog"></i></span>
                <span class="nav-text">Administración General</span>
            </a>


            <a href="{{ route('admin.LibroReclamacion.index') }}" 
                class="flex items-center {{ request()->routeIs('admin.LibroReclamacion.*') ? 'active-link' : '' }}">
                <span class="nav-icon">
                    <i class="fa fa-book"></i>
                </span>
                <span class="nav-text">Libro de Reclamaciones</span>
            </a>

            <a href="{{ route('admin.ConfiguracionVisual.index') }}"
                class="flex items-center {{ request()->routeIs('admin.ConfiguracionVisual.*') ? 'active-link' : '' }}">
                <span class="nav-icon"><i class="fa fa-palette"></i></span>
                <span class="nav-text">Config. Visual</span>
            </a>

        </div>

    </nav>

    <!-- LOGOUT -->
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="nav-icon"><i class="fa fa-power-off"></i></span>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>

</aside>

<!-- ═══ CONTENIDO ═══ -->
<div id="main-wrapper">

    <header class="top-header">
        <div style="display:flex;align-items:center;gap:10px;">
            <!-- Botón móvil -->
            <button class="header-btn btn-mobile-menu" onclick="openSidebar()">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Botón escritorio (colapsar mini) -->
            <button class="header-btn btn-desktop-menu" onclick="toggleMiniSidebar()">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <div style="display:flex;align-items:center;gap:8px;">
            <div class="header-user-chip">
                <div class="header-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <span>{{ auth()->user()->email ?? 'admin@aosc.com' }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="header-btn" title="Cerrar sesión">
                    <i class="fa fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</div>

<script>
    /* ── Abrir sidebar en móvil ── */
    function openSidebar() {
        document.getElementById('sidebar').classList.add('sidebar-open');
        document.getElementById('overlay').classList.add('active');
    }

    /* ── Cerrar sidebar en móvil ── */
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('sidebar-open');
        document.getElementById('overlay').classList.remove('active');
    }

    /* ── Colapsar a mini en escritorio ── */
    function toggleMiniSidebar() {
        document.getElementById('sidebar').classList.toggle('sidebar-mini');
    }

    /* ── Submenú Ajustes ── */
    function toggleAjustes() {
        const sub  = document.getElementById('submenu-ajustes');
        const icon = document.querySelector('.submenu-trigger .chevron');
        sub.classList.toggle('hidden');
        if (icon) icon.classList.toggle('rotate-90');
    }
</script>
@stack('scripts')
</body>
</html>