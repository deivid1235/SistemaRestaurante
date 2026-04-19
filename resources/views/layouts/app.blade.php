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

    <style>
        /* Estilos del restaurante aplicados */
        .btn-order {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transition: all 0.3s ease;
        }
        .btn-order:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            transform: scale(1.05);
        }
        .section-title {
            position: relative;
            display: inline-block;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #dc2626;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

<header class="sticky top-0 z-50 shadow-lg border-b border-red-700 bg-red-600">
    <nav class="w-full px-6 flex items-center justify-between h-24">
        <div>
            <a href="{{ url('/inicio') }}" class="text-2xl md:text-3xl font-extrabold text-white">
                <span class="text-yellow-400">Corporation</span>AOSC
                <span class="text-xs block text-yellow-200 font-normal">Restaurante Gourmet</span>
            </a>
        </div>

        <div class="hidden md:flex space-x-3 font-medium">
            <a href="{{ url('/inicio') }}"
                class="px-5 py-2 text-center border-2 border-white text-white rounded-full hover:bg-[#E1A80B] hover:text-[#9B1111] transition-all duration-300  font-bold">
                    INICIO
            </a>
          <a href="{{ route('inicio') }}#filosofia"
               class="px-5 py-2 text-center border-2 border-white text-white rounded-full hover:bg-[#E1A80B] hover:text-[#9B1111] transition-all duration-300   font-bold">
                NOSOTROS
            </a>
            <a href="{{ route('inicio') }}#productos"
               class="px-5 py-2 text-center border-2 border-white text-white rounded-full hover:bg-[#E1A80B] hover:text-[#9B1111] transition-all duration-300 font-bold">
                CARTA
            </a>
            <a href="{{ route('inicio') }}#comboss"
               class="px-5 py-2 text-center border-2 border-white text-white rounded-full hover:bg-[#E1A80B] hover:text-[#9B1111] transition-all duration-300 font-bold">
                PROMOCIONES
            </a>
           
        </div>

        <div class="flex items-center space-x-4">

            <a href="{{ route('inicio') }}?login=true"
               class="hidden md:inline-flex px-5 py-2 min-w-[120px] justify-center border-2 border-white text-white font-semibold rounded-full hover:bg-[#E1A80B] hover:text-[#9B1111] transition-all duration-300">
                INICIAR SESIÓN
            </a>

            <button id="mobile-menu-button"
                    class="md:hidden p-2 rounded-lg text-white hover:bg-red-700">
                <i class="bi bi-list text-3xl"></i>
            </button>

        </div>

    </nav>

    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2 bg-red-600 shadow-lg border-t border-red-700">
        <a href="#inicio" class="block px-3 py-2 rounded-md text-white hover:bg-yellow-400 hover:text-red-700 transition">Inicio</a>
        <a href="#filosofia" class="block px-3 py-2 rounded-md text-white hover:bg-yellow-400 hover:text-red-700 transition">Nosotros</a>
        <a href="#productos" class="block px-3 py-2 rounded-md text-white hover:bg-yellow-400 hover:text-red-700 transition">Carta</a>
        <a href="#comboss" class="block px-3 py-2 rounded-md text-white hover:bg-yellow-400 hover:text-red-700 transition">Promociones</a>
        <a href="#login-modal" class="block px-3 py-2 rounded-md border border-white text-white text-center hover:bg-yellow-400 hover:text-red-700 transition">Iniciar Sesión</a>
    </div>

</header>

    @yield('content')
    <!-- ================= FOOTER  ================= -->
    <footer id="contacto" class="py-12 border-t" style="background-color:#1f2937; color:#d1d5db;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
            <div class="grid md:grid-cols-4 gap-8 mb-10">
                <!-- INFO -->
                <div>
                    <h4 class="text-2xl font-bold text-white mb-4">
                        <span class="text-yellow-500">Corporation</span>AOSC
                    </h4>
                    <p class="mb-2 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-yellow-500"></i>
                        Perú - Piura - Talara
                    </p>
                    <p class="mb-2 flex items-center gap-2">
                        <i class="fas fa-phone-alt text-yellow-500"></i>
                        Reservas: +51 952 167 090
                    </p>
                    <p class="mb-2 flex items-center gap-2">
                        <i class="fas fa-envelope text-yellow-500"></i>
                        grupoaosc@gmail.com
                    </p>
                    <p class="mb-2 flex items-center gap-2">
                        <i class="fas fa-clock text-yellow-500"></i>
                        Lun-Dom: 12pm - 11pm
                    </p>
                </div>
                <!-- MAPA -->
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Mapa del Sitio</h4>
                    <ul class="space-y-2">
                        <li><a href="#inicio" class="hover:text-yellow-500 transition">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-yellow-500 transition">Nuestra Carta</a></li>
                        <li><a href="#filosofia" class="hover:text-yellow-500 transition">Nuestra Historia</a></li>
                        <li><a href="#contacto" class="hover:text-yellow-500 transition">Ubicación</a></li>
                    </ul>
                </div>
                <!-- LEGAL -->
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-500 transition">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-yellow-500 transition">Política de Privacidad</a></li>
                        <li>
                            <a href="{{ route('libro.reclamacion') }}" 
                            class="hover:text-yellow-500 transition block">
                                📖 Libro de Reclamaciones
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- REDES -->
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Síguenos</h4>
                    <div class="flex space-x-4 text-white">
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-yellow-500 hover:text-gray-900 transition shadow-md">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-yellow-500 hover:text-gray-900 transition shadow-md">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-yellow-500 hover:text-gray-900 transition shadow-md">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-yellow-500 hover:text-gray-900 transition shadow-md">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center pt-8 border-t border-gray-700">
                <p>&copy; 2025 CorporationAOSC Restaurante. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>    
    @stack('scripts')
    <script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button')?.addEventListener('click', function () {
        document.getElementById('mobile-menu')?.classList.toggle('open');
    });
</script>
</body>
</html>