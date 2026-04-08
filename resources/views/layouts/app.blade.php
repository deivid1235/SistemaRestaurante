<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'CorporationAOSC - Experiencia Gourmet Minimalista')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('iconos/logotipo.png') }}">
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
</head>

<body class="bg-light text-dark">

<header class="sticky top-0 z-50 backdrop-blur-md shadow-lg border-b border-gray-100 bg-white/95">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20">
        <!-- LOGO -->
        <div>
            <a href="{{ url('/inicio') }}" class="text-3xl font-extrabold">
                <span class="text-red-600">Corporation</span>AOSC
            </a>
        </div>

        <!-- MENU DESKTOP -->
        <div class="hidden md:flex space-x-6 font-medium">
            <a href="#inicio" class="hover:text-red-600">Inicio</a>
            <a href="#filosofia" class="hover:text-red-600">Misión</a>
            <a href="#productos" class="hover:text-red-600">Categorías</a>
            <a href="#comboss" class="hover:text-red-600">Combos</a>
        </div>

        <!-- BOTONES -->
        <div class="flex items-center space-x-4">

            <!-- LOGIN -->
            <a href="#login-modal"
               class="hidden md:inline-flex px-4 py-2 border border-red-600 text-red-600 font-semibold rounded-lg hover:bg-red-50 transition">
                Iniciar Sesión
            </a>

            <!-- BOTON MOBILE -->
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="bi bi-list text-xl"></i>
            </button>

        </div>
    </nav>

    <!--  MENU MOBILE -->
    <div id="mobile-menu" class="hidden md:hidden px-3 pb-3 space-y-1 bg-white shadow-lg border-t">

        <a href="#inicio" class="block px-3 py-2 rounded-md hover:bg-red-100">Inicio</a>
        <a href="#filosofia" class="block px-3 py-2 rounded-md hover:bg-red-100">Misión</a>
        <a href="#productos" class="block px-3 py-2 rounded-md hover:bg-red-100">Menú</a>
        <a href="#comboss" class="block px-3 py-2 rounded-md hover:bg-red-100">Combos</a>

        <a href="#login-modal"
           class="block px-3 py-2 rounded-md text-red-600 hover:bg-red-100">
            Iniciar Sesión
        </a>

    </div>
</header>


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>    
    @stack('scripts')
</body>
</html>