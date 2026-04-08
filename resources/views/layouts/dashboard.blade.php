<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'CorporationAOSC')</title>

<link rel="icon" href="{{ asset('iconos/logotipo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

@vite(['resources/css/styles.css', 'resources/js/app.js'])

<style>
    /* ===== MINI SIDEBAR ===== */
    .sidebar-mini {
        width: 70px !important;
    }

    /* ocultar textos */
    .sidebar-mini span {
        display: none;
    }

    /* ocultar usuario */
    .sidebar-mini .user-name {
        display: none;
    }

    /* centrar iconos */
    .sidebar-mini nav a {
        justify-content: center;
    }

    /* LOGO CENTRADO */
    .sidebar-mini .logo-text {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 12px 0;
    }

    /* icono en mini */
    .sidebar-mini .logo-text::before {
        content: "\f015";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 18px;
    }
</style>
</head>

<body class="bg-[#f3f4f6] flex h-screen overflow-hidden">

<!-- OVERLAY MOBILE -->
<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden z-40 lg:hidden"></div>

<!-- SIDEBAR -->
<aside id="sidebar"
class="fixed lg:static z-50 w-[240px] h-full bg-[#f7f7f7] flex flex-col shadow-md 
transform -translate-x-full lg:translate-x-0 transition-all duration-300">

    <!-- LOGO -->
    <div class="bg-[#1e88b6] text-white font-bold px-4 py-3 text-lg logo-text text-center">
        <span>GRUPO AOSC</span>
    </div>

    <!-- USER -->
    <div class="bg-cover bg-center p-4 text-black font-bold user-name"
        style="background-image: url('{{ asset('imagen/user-info.jpg') }}')">
        {{ auth()->user()->name ?? 'TOMMY' }}
    </div>

    <!-- MENU -->
    <nav class="flex-1 p-3 text-gray-600 text-sm space-y-1">

        <a href="#" class="flex items-center gap-3 p-2 rounded hover:bg-gray-200">
            <i class="fa fa-store"></i> <span>Punto de Venta</span>
        </a>

        <a href="#" class="flex items-center justify-between p-2 rounded hover:bg-gray-200">
            <div class="flex gap-3">
                <i class="fa fa-desktop"></i> <span>Caja</span>
            </div>
            <i class="fa fa-chevron-right text-xs"></i>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded bg-[#1e88b6] text-white shadow">
            <i class="fa fa-user"></i> <span>Clientes</span>
        </a>

        <a href="#" class="flex items-center justify-between p-2 rounded hover:bg-gray-200">
            <div class="flex gap-3">
                <i class="fa fa-shopping-cart"></i> <span>Compras</span>
            </div>
            <i class="fa fa-chevron-right text-xs"></i>
        </a>

        <a href="#" class="flex items-center justify-between p-2 rounded hover:bg-gray-200">
            <div class="flex gap-3">
                <i class="fa fa-credit-card"></i> <span>Créditos</span>
            </div>
            <i class="fa fa-chevron-right text-xs"></i>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover:bg-gray-200">
            <i class="fa fa-box"></i> <span>Inventario</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover:bg-gray-200">
            <i class="fa fa-chart-bar"></i> <span>Informes</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover:bg-gray-200">
            <i class="fa fa-cog"></i> <span>Ajustes</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover:bg-gray-200">
            <i class="fa fa-th-large"></i> <span>Tablero</span>
        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="p-3 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 text-gray-500 hover:text-red-600">
                <i class="fa fa-power-off"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>

</aside>

<!-- CONTENIDO -->
<div class="flex-1 flex flex-col">
    <!-- HEADER -->
    <header class="bg-[#1e88b6] text-white h-14 flex items-center justify-between px-4 shadow">
        <div class="flex items-center gap-4">
            <!-- MOBILE -->
            <button onclick="toggleSidebar()" class="lg:hidden">
                <i class="fa fa-bars text-xl"></i>
            </button>
            <!-- DESKTOP MINI -->
            <button onclick="toggleMiniSidebar()" class="hidden lg:block">
                <i class="fa fa-bars text-xl"></i>
            </button>
            <i class="fa fa-desktop"></i>
        </div>

        <div class="flex items-center gap-4">
            <span class="text-xs">
                {{ auth()->user()->email ?? 'correo@demo.com' }}
            </span>
            <i class="fa fa-bell"></i>
            <!-- LOGOUT ICON -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button>
                    <i class="fa fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

    </header>
    <!-- MAIN -->
    <main class="flex-1 p-4 overflow-auto">
        @yield('content')
    </main>

</div>

<script>
    // MOBILE
    function toggleSidebar(){
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // MINI DESKTOP
    function toggleMiniSidebar(){
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-mini');
    }
</script>

</body>
</html>
