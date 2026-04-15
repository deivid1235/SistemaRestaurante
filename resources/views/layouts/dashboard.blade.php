<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'CorporationAOSC')</title>

<link rel="icon" href="{{ asset('iconos/logotipo.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    @vite(['resources/css/styles.css', 'resources/js/app.js'])

<style>
    :root {
        --primary: {{ session('accent_color', '#1e88b6') }};
        --bg: #f3f4f6;
        --text: #1f2937;
    }

    .bg-primary { background-color: var(--primary) !important; }
    .text-primary { color: var(--primary) !important; }

    .hover-primary {
        transition: 0.2s;
    }
    .hover-primary:hover {
        background-color: var(--primary) !important;
        color: #fff !important;
    }

    /* MINI SIDEBAR */
    .sidebar-mini { width: 70px !important; }
    .sidebar-mini span { display: none; }
    .sidebar-mini nav a { justify-content: center; }

    .user-bg {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 120px;
}
</style>

</head>

<body class="flex h-screen overflow-hidden"
style="background: var(--bg); color: var(--text);">

<!-- OVERLAY -->
<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden z-40 lg:hidden"></div>

<!-- SIDEBAR -->
<aside id="sidebar"
class="fixed lg:static z-50 w-[240px] h-full bg-white flex flex-col shadow-md 
    transform -translate-x-full lg:translate-x-0 transition-all duration-300">

    <!-- LOGO -->
    <div class="bg-primary text-white font-bold px-4 py-3 text-lg logo-text text-center">
        <span>GRUPO AOSC</span>
    </div>

    <!-- USER -->
    <div class="user-bg"
        style="background-image: url('{{ asset('imagen/user-info.jpg') }}');">
    </div>

    <!-- MENU -->
    <nav class="flex-1 p-3 text-sm space-y-1">

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-store"></i> <span>Punto de Venta</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-desktop"></i> <span>Caja</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-users"></i> <span>Cliente</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-shopping-cart"></i> <span>Compras</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-credit-card"></i> <span>Créditos</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-box"></i> <span>Inventario</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-chart-bar"></i> <span>Informes</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-2 rounded hover-primary">
            <i class="fa fa-th-large"></i> <span>Tablero</span>
        </a>

        <!-- SUBMENÚ AJUSTES -->
        <div>
            <a href="#" onclick="toggleAjustes()" 
            class="flex items-center justify-between p-2 rounded hover-primary
            {{ request()->routeIs('admin.ConfiguracionVisual.*') ? 'bg-primary text-white font-semibold' : '' }}">

                <div class="flex gap-3">
                    <i class="fa fa-cog"></i> <span>Ajustes</span>
                </div>

                <!-- FLECHA -->
                <i class="fa fa-chevron-right text-xs transition-transform duration-300
                {{ request()->routeIs('admin.ConfiguracionVisual.*') ? 'rotate-90' : '' }}"></i>
            </a>

            <!-- SUBMENÚ -->
            <div id="submenu-ajustes" 
            class="ml-6 flex flex-col text-sm
            {{ request()->routeIs('admin.ConfiguracionVisual.*') ? '' : 'hidden' }}">

                <a href="#" class="flex items-center gap-2 p-2 rounded hover-primary">
                    <i class="fa fa-user-cog"></i> <span>Sistema</span>
                </a>

                <a href="#" class="flex items-center gap-2 p-2 rounded hover-primary">
                    <i class="fa fa-building"></i> <span>Empresa</span>
                </a>

                <a href="#" class="flex items-center gap-2 p-2 rounded hover-primary">
                    <i class="fa fa-print"></i> <span>Restaurante</span>
                </a>

                <a href="" 
                class="flex items-center gap-2 p-2 rounded hover-primary
                {{ request()->routeIs('') ? 'bg-primary text-white shadow' : '' }}">
                    
                    <i class="fa fa-palette"></i>
                    <span>Configuración Visual</span>
                </a>


                <!-- ACTIVO -->
                <a href="{{ route('admin.ConfiguracionVisual.index') }}" 
                class="flex items-center gap-2 p-2 rounded hover-primary
                {{ request()->routeIs('admin.ConfiguracionVisual.*') ? 'bg-primary text-white shadow' : '' }}">
                    
                    <i class="fa fa-palette"></i>
                    <span>Configuración Visual</span>
                </a>

            </div>
        </div>
    </nav>

    <!-- LOGOUT -->
    <div class="p-3 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 text-gray-500 hover-primary">
                <i class="fa fa-power-off"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>

</aside>

<!-- CONTENIDO -->
<div class="flex-1 flex flex-col">

<header class="bg-primary text-white h-14 flex items-center justify-between px-4 shadow">

    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" class="lg:hidden">
            <i class="fa fa-bars text-xl"></i>
        </button>

        <button onclick="toggleMiniSidebar()" class="hidden lg:block">
            <i class="fa fa-bars text-xl"></i>
        </button>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-xs">
            {{ auth()->user()->email ?? 'correo@demo.com' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button>
                <i class="fa fa-sign-out-alt"></i>
            </button>
        </form>
    </div>

</header>

<main class="flex-1 p-4 overflow-auto">
    @yield('content')
</main>

</div>

<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('overlay').classList.toggle('hidden');
    }

    function toggleMiniSidebar(){
        document.getElementById('sidebar').classList.toggle('sidebar-mini');
    }

    function toggleAjustes(){
        document.getElementById('submenu-ajustes').classList.toggle('hidden');
        document.getElementById('icon-ajustes').classList.toggle('rotate-90');
    }
</script>
@stack('scripts')
</body>
</html>