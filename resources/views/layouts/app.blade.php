<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'CorporationAOSC - Experiencia Gourmet Minimalista')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('iconos/logotipo.svg') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/styles.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        .font-brand { font-family: 'Montserrat', sans-serif; }
        
        #mobile-menu-Celular {
            transition: all 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
        }
        #mobile-menu-Celular.open {
            max-height: 500px;
            padding-bottom: 1.5rem;
        }

        .hover-lift { transition: transform 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-sky-100 shadow-sm">
    <nav class="container mx-auto px-6 h-20 flex items-center justify-between">
        
        <div class="hover:scale-105 transition-transform duration-300">
            <a href="{{ url('/inicio') }}" class="flex flex-col leading-none">
                <span class="text-2xl md:text-3xl font-black tracking-tighter text-sky-600 font-brand">
                    <span class="text-slate-900">Corporation</span>AOSC
                </span>
                <span class="text-[10px] uppercase tracking-[0.3em] font-bold text-sky-400 mt-1">Gourmet Experience</span>
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-1">
            @php 
                $menuItems = [
                    'INICIO' => [
                        'url' => url('/inicio'),
                        'icon' => 'fa-solid fa-house'
                    ],
                    'NOSOTROS' => [
                        'url' => route('inicio').'#filosofia',
                        'icon' => 'fa-solid fa-users'
                    ],
                    'CARTA' => [
                        'url' => route('inicio').'#productos',
                        'icon' => 'fa-solid fa-utensils'
                    ],
                    'PROMOCIONES' => [
                        'url' => route('inicio').'#comboss',
                        'icon' => 'fa-solid fa-fire'
                    ]
                ]; 
            @endphp

            @foreach($menuItems as $nombre => $data)
                <a href="{{ $data['url'] }}" 
                class="group px-4 py-2 text-sm font-extrabold text-slate-600 rounded-full hover:text-sky-600 hover:bg-sky-50 transition-all duration-300 uppercase tracking-wide flex items-center gap-2 hover:scale-105 transform">
                    <i class="{{ $data['icon'] }} text-xs opacity-70 group-hover:opacity-100 transition-opacity"></i>
                    {{ $nombre }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center space-x-4">
            <a href="#" id="open-login-modal"
            class="hidden md:inline-flex px-6 py-2.5 bg-sky-600 text-white text-xs font-black rounded-full shadow-lg shadow-sky-200 hover:bg-sky-700 hover:-translate-y-0.5 transition-all uppercase tracking-widest">
                Iniciar Sesión
            </a>

            <button id="mobile-menu-button" class="md:hidden p-2 text-sky-600 hover:bg-sky-50 rounded-xl transition-colors">
                <i class="bi bi-grid-3x3-gap-fill text-2xl"></i>
            </button>
        </div>
    </nav>

    <div id="mobile-menu-Celular" class="md:hidden bg-white px-6">
        <div class="flex flex-col space-y-2 border-t border-sky-50 pt-4">
            @foreach($menuItems as $nombre => $data)
                <a href="{{ $data['url'] }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition">
                    <i class="{{ $data['icon'] }} text-sky-500"></i>
                    {{ $nombre }}
                </a>
            @endforeach
            <a href="#" id="open-login-modal-Celular" class="block w-full py-4 text-center bg-sky-600 text-white rounded-2xl font-black mt-4 shadow-md">
                INICIAR SESIÓN
            </a>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer id="contacto" class="bg-slate-900 pt-16 pb-8 text-slate-400">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <div class="space-y-6">
                <h4 class="text-2xl font-black text-white font-brand">
                    <span class="text-sky-500">Corporation</span>AOSC
                </h4>
                <div class="space-y-3 text-sm font-medium">
                    <p class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-sky-500"></i> Perú - Piura - Talara</p>
                    <p class="flex items-center gap-3"><i class="fas fa-phone-alt text-sky-500"></i> +51 952 167 090</p>
                    <p class="flex items-center gap-3"><i class="fas fa-envelope text-sky-500"></i> grupoaosc@gmail.com</p>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest">Descubrir</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#inicio" class="hover:text-sky-400 transition-colors">Inicio</a></li>
                    <li><a href="#productos" class="hover:text-sky-400 transition-colors">Nuestra Carta</a></li>
                    <li><a href="#filosofia" class="hover:text-sky-400 transition-colors">Nuestra Historia</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest">Ayuda</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#" class="hover:text-sky-400 transition-colors">Términos y Condiciones</a></li>
                    <li>
                        <a href="{{ route('libro.reclamacion') }}" class="inline-flex items-center gap-3 p-3 bg-white/5 rounded-2xl hover:bg-white/10 transition-all border border-white/5 group">
                            <img src="{{ asset('imagen/libroReclamaciones.png') }}" alt="Libro" class="w-8 h-8 object-contain">
                            <span class="text-[10px] font-black text-white group-hover:text-sky-400 uppercase tracking-tighter">Libro de Reclamaciones</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest">Síguenos</h4>
                <div class="flex gap-3">
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/5 hover:bg-sky-600 hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/5 hover:bg-gradient-to-tr hover:from-pink-500 hover:to-yellow-500 hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/5 hover:bg-black hover:-translate-y-1 transition-all duration-300 border border-white/10">
                        <i class="fab fa-tiktok text-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 text-center">
            <p class="text-[10px] font-bold tracking-[0.4em] uppercase text-slate-500">© 2026 CorporationAOSC. Excellence in fine dining.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<div class="fixed top-4 inset-x-0 flex justify-center z-50 pointer-events-none animate-fade-in-down">
    <div class="
        bg-green-50 text-green-700 
        border border-green-200
        px-4 py-2 
        rounded-2xl
        text-sm font-bold
        flex items-center gap-3
        shadow-xl shadow-green-900/5
        backdrop-blur-sm
        pointer-events-auto
    ">
        <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center text-white shadow-sm">
            <i class="fa fa-check text-xs"></i>
        </div>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif


</body>
</html>