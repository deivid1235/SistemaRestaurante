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
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700;900&family=Barlow+Condensed:wght@700;900&display=swap" rel="stylesheet">
    
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
                    'url' => url('/'),
                    'icon' => 'fa-solid fa-house'
                ],
                'NOSOTROS' => [
                    'url' => url('/#filosofia'),
                    'icon' => 'fa-solid fa-users'
                ],
                'CARTA' => [
                    'url' => url('/#productos'),
                    'icon' => 'fa-solid fa-utensils'
                ],
                'PROMOCIONES' => [
                    'url' => url('/#comboss'),
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
            @auth('cliente')
                <div class="hidden md:flex items-center gap-4 bg-white border border-slate-200/80 p-1.5 pr-3.5 rounded-2xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-300 group/card">
                    
                    <div class="flex items-center gap-3">
                        <div class="relative w-9 h-9 rounded-xl text-white flex items-center justify-center shadow-sm select-none group-hover/card:scale-105 transition-transform duration-300"
                            style="background: linear-gradient(135deg, #00629b 0%, #004d7c 100%);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                        </div>
                        
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black uppercase tracking-widest leading-none" style="color: #00629b;">
                                Panel Cliente
                            </span>
                            <span class="text-xs font-bold text-slate-700 tracking-tight mt-1 max-w-[150px] truncate group-hover/card:text-slate-900 transition-colors">
                                {{ Auth::guard('cliente')->user()->nombres }}
                            </span>
                        </div>
                    </div>

                    <div class="h-6 w-[1px] bg-slate-200"></div>

                    <form action="{{ route('cliente.logout') }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center gap-2 px-3 py-1.5 bg-slate-50 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xl text-[11px] font-bold transition-all duration-300 active:scale-95 group/btn border border-slate-100 hover:border-rose-100"
                            title="Cerrar sesión">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform group-hover/btn:translate-x-0.5 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-bold tracking-wide">Salir</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('inicio') }}"
                    class="hidden md:inline-flex items-center gap-2 px-6 py-3 text-white text-xs font-bold rounded-2xl shadow-lg transition-all duration-300 uppercase tracking-widest border hover:-translate-y-0.5 active:translate-y-0"
                    style="background: linear-gradient(135deg, #00629b 0%, #004d7c 100%); border-color: #005587; box-shadow: 0 10px 15px -3px rgba(0, 98, 155, 0.25);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Iniciar Sesión
                </a>
            @endauth

            <button id="mobile-menu-button" 
                class="md:hidden w-11 h-11 flex flex-col items-center justify-center gap-1 bg-slate-50 text-slate-700 active:scale-95 rounded-2xl border border-slate-200 transition-all duration-300 shadow-sm group"
                onmouseover="this.style.color='#00629b'; this.style.backgroundColor='#f0f7ff'; this.style.borderColor='#bee0ff';"
                onmouseout="this.style.color=''; this.style.backgroundColor=''; this.style.borderColor='';">
                <span class="w-5 h-0.5 bg-current rounded-full transition-all group-hover:w-4"></span>
                <span class="w-5 h-0.5 bg-current rounded-full transition-all"></span>
                <span class="w-5 h-0.5 bg-current rounded-full transition-all group-hover:w-3"></span>
            </button>
        </div>

    </nav>

    <div id="mobile-menu-Celular" class="md:hidden bg-white px-6 pb-6 border-b border-slate-100 shadow-sm animate-fade-in">
        <div class="flex flex-col space-y-1.5 border-t border-slate-100 pt-4">
            
            @foreach($menuItems as $nombre => $data)
                <a href="{{ $data['url'] }}" 
                class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-bold text-slate-600 hover:bg-sky-50/60 hover:text-sky-600 transition-all active:scale-[0.99]">
                    <div class="w-8 h-8 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500 transition-colors">
                        <i class="{{ $data['icon'] }} text-base"></i>
                    </div>
                    <span class="text-sm tracking-tight">{{ $nombre }}</span>
                </a>
            @endforeach

            @if(session('cliente_logueado'))
                <div class="mt-4 p-4 bg-slate-50 border border-slate-100 rounded-2xl flex flex-col items-center text-center gap-3.5">
                    
                    <div class="flex items-center gap-3 w-full border-b border-slate-200/60 pb-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-sky-500 to-blue-600 text-white flex items-center justify-center shadow-md shadow-sky-100 shrink-0">
                            <i class="fa fa-user text-sm"></i>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider leading-none">Sesión Activa</p>
                            <p class="text-sm font-extrabold text-slate-700 truncate tracking-tight mt-1">
                               {{ session('cliente_nombre') }}
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('cliente.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                            <i class="fa fa-sign-out-alt text-sm"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-2">
                    <a href="{{ route('inicio') }}" id="open-login-modal-Celular"
                        class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-sky-100 hover:opacity-95 active:scale-[0.98] transition-all">
                        <i class="fa fa-user-circle text-sm"></i> INICIAR SESIÓN
                    </a>
                </div>
            @endauth

        </div>
    </div>

</header>

<main>
    @yield('content')
</main>

<footer id="contacto" class="bg-[#01579B] pt-16 pb-8 text-white/80" style="font-family: 'Montserrat', sans-serif;">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <div class="space-y-6">
                <h4 class="text-2xl font-black text-white font-brand">
                    <span class="text-sky-300">Corporation</span>AOSC
                </h4>
                <div class="space-y-3 text-lg font-medium">
                    <p class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-sky-300"></i> Perú - Piura - Talara</p>
                    <p class="flex items-center gap-3"><i class="fas fa-phone-alt text-sky-300"></i> +51 952 167 090</p>
                    <p class="flex items-center gap-3"><i class="fas fa-envelope text-sky-300"></i> grupoaosc@gmail.com</p>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest" style="font-family: 'Montserrat', sans-serif;">Descubrir</h4>
                <ul class="space-y-4 text-lg">
                    <li><a href="#inicio" class="hover:text-sky-200 transition-colors">Inicio</a></li>
                    <li><a href="#productos" class="hover:text-sky-200 transition-colors">Nuestra Carta</a></li>
                    <li><a href="#filosofia" class="hover:text-sky-200 transition-colors">Nuestra Historia</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest" style="font-family: 'Montserrat', sans-serif;">Ayuda</h4>
                <ul class="space-y-4 text-lg">
                    <li><a href="#" class="hover:text-sky-200 transition-colors">Términos y Condiciones</a></li>
                    <li>
                        <a href="{{ route('libro.reclamacion') }}" 
                        class="inline-flex items-center gap-4 p-3 rounded-2xl transition-all hover:bg-white/10 group">
                            
                            <div class="w-16 h-12 flex items-center justify-center">
                                <img src="{{ asset('imagen/libroReclamaciones.png') }}" 
                                    alt="Libro de Reclamaciones" 
                                    class="w-full h-full object-contain transition-transform group-hover:scale-110">
                            </div>

                            <div class="flex flex-col leading-[0.3]">
                                <span class="text-lg font-black text-white uppercase tracking-tighter">
                                    Libro de
                                </span>
                                <span class="text-sm font-black text-white uppercase tracking-tighter group-hover:text-slate-300 transition-colors">
                                    Reclamaciones
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-widest" style="font-family: 'Montserrat', sans-serif;">Síguenos</h4>
                <div class="flex gap-3">
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/10 hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300 border border-white/5">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/10 hover:bg-gradient-to-tr hover:from-pink-500 hover:to-yellow-500 hover:-translate-y-1 transition-all duration-300 border border-white/5">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/10 hover:bg-black hover:-translate-y-1 transition-all duration-300 border border-white/5">
                        <i class="fab fa-tiktok text-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 text-center">
            <p class="text-[10px] font-bold tracking-[0.4em] uppercase text-white/50">© 2026 CorporationAOSC. Excellence in fine dining.</p>
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