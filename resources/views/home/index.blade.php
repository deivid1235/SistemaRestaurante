@extends('layouts.app')

@section('title', 'CorporationAOSC - Experiencia Gourmet Minimalista')

@section('content')

    {{-- HERO --}}
    <main id="inicio" class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 hero-slider z-0">
            @foreach($images as $index => $img)
                <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 {{ $index == 0 ? 'opacity-100' : 'opacity-0' }}" 
                    style="background-image: url('{{ $img }}')">
                </div>
            @endforeach
        </div>

        <div class="absolute inset-0 bg-black/30 z-10"></div>

        <div class="relative z-20 text-center flex flex-col items-center justify-center h-full px-6 max-w-5xl mx-auto">
            <p class="text-xl tracking-widest text-red-600 mb-3 uppercase font-light">
                Corporación de Alta Gastronomía
            </p>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 tracking-tight leading-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700">Corporation</span>
                <span class="text-red-600">AOSC</span>
            </h1>
            <p class="text-2xl text-gray-100 mb-10 font-extralight max-w-3xl mx-auto">
                Llevamos la excelencia culinaria al siguiente nivel. Claridad en el diseño, pureza en el sabor.
            </p>
            <a href="#productos"
            class="inline-block px-10 py-4 bg-red-600 text-white text-xl font-semibold rounded-xl shadow-lg
                    hover:bg-red-700 transition duration-300 transform hover:scale-105 uppercase tracking-wider animate-pulse">
                Explorar el Menú
            </a>
        </div>

    </main>


    {{-- SECCIÓN: CATEGORÍAS Y PRODUCTOS--}}
    <section id="productos" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900">
                Categorías <span class="text-red-600">Disponibles</span>
            </h2>

            {{-- Carrusel de categorías --}}
            <div class="mb-16 relative">
                <h3 class="text-3xl font-bold mb-6 text-gray-900">Explora por Categoría</h3>

                <div class="relative">
                    <button id="categories-prev" aria-label="Anterior"
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-white/90 shadow-lg hover:bg-white transition">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <div id="categories-carousel" class="product-carousel flex space-x-4 pb-4 overflow-x-auto scrollbar-hide"></div>

                    <button id="categories-next" aria-label="Siguiente"
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-white/90 shadow-lg hover:bg-white transition">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Listado de productos --}}
            <h3 id="product-listing-title" class="text-3xl font-bold mb-8 text-gray-900">Menú General</h3>

            <div id="product-loading-indicator" class="hidden flex justify-center items-center py-16">
                <div class="spinner"></div>
                <p class="text-lg text-red-600 ml-4">Cargando la carta...</p>
            </div>

            <div id="product-listing-content"
                 class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            </div>

        </div>
    </section>


    {{-- SECCIÓN: COMBOS ESPECIALES --}}
    <section id="comboss" class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <h2 class="text-5xl font-extrabold text-center mb-4 text-gray-900">
                Combos <span class="text-red-600">Especiales</span>
            </h2>
            <p class="text-xl text-gray-600 text-center mb-16">
                Nuestros combos preparados por el chef. Se actualizan automáticamente.
            </p>

            <div id="combo-loading-indicator" class="hidden flex justify-center items-center py-8">
                <div class="spinner"></div>
                <p class="text-lg text-red-600 ml-4">Cargando combos...</p>
            </div>

            <div id="combo-listing-content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>

        </div>
    </section>


    {{-- ECCIÓN: MISIÓN / FILOSOFÍA --}}
    <section id="filosofia" class="py-24 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8f9fa 0%, #f3f4f6 100%);">
    
        {{-- Decoración de fondo --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="pointer-events: none;">
            <div class="position-absolute" style="top: -20%; right: -10%; width: 60%; height: 80%; background: radial-gradient(circle, rgba(220,38,38,0.05) 0%, transparent 70%);"></div>
            <div class="position-absolute" style="bottom: -20%; left: -10%; width: 50%; height: 70%; background: radial-gradient(circle, rgba(220,38,38,0.03) 0%, transparent 70%);"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl position-relative z-1">

            <h2 class="text-5xl md:text-6xl font-extrabold text-center mb-4" 
                style="background: linear-gradient(135deg, #dc2626, #991b1b, #dc2626); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent;">
                Nuestra <span class="border-b-4 border-red-600 pb-2">Misión</span>
            </h2>

            <p class="text-xl text-gray-600 text-center mb-16 max-w-3xl mx-auto position-relative">
                Detrás de cada plato hay una historia de pasión y excelencia, respaldada por la Corporación.
            </p>

            <div class="row g-4">

                {{-- Card 1 - Materia Prima --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover-card overflow-hidden position-relative">
                        
                        {{-- Efecto de fondo gradiente --}}
                        <div class="card-gradient position-absolute top-0 start-0 w-100 h-100 opacity-0 transition" style="background: linear-gradient(135deg, rgba(220,38,38,0.05), rgba(153,27,27,0.02));"></div>
                        
                        <div class="card-body p-4 p-xl-5 text-center position-relative z-1">
                            
                            {{-- Icono  --}}
                            <div class="icon-wrapper mb-4 d-inline-block position-relative">
                                <div class="icon-ring position-absolute top-50 start-50 translate-middle rounded-circle bg-red-100" >
                                </div>
                                <div class="position-relative z-1 transition-icon text-center">
                                    
                                    <img src="{{ asset('iconos/Materia_prima.gif') }}" 
                                        alt="Materia Prima"
                                        class="w-50 h-50 mx-auto object-contain transition-transform duration-300 hover:scale-110">

                                </div>
                            </div>

                            {{-- Número decorativo --}}
                            <div class="text-8xl font-black text-gray-100 position-absolute" style="top: 10px; right: 15px; font-family: monospace;">01</div>

                            <h3 class="h3 fw-bold mb-3">Materia Prima</h3>
                            
                            <div class="w-12 h-1 bg-red-600 mx-auto my-3 rounded"></div>
                            
                            <p class="text-gray-600 mb-0">
                                Solo trabajamos con ingredientes frescos, orgánicos y de origen local, seleccionados diariamente por nuestros chefs.
                            </p>
                            
                            {{-- Enlace decorativo --}}
                            <div class="mt-4 opacity-0 transition-link">
                                <span class="text-red-600 text-sm font-semibold">Descubrir más →</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2 - Innovación Culinaria --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover-card overflow-hidden position-relative">
                        
                        <div class="card-gradient position-absolute top-0 start-0 w-100 h-100 opacity-0 transition" style="background: linear-gradient(135deg, rgba(220,38,38,0.05), rgba(153,27,27,0.02));"></div>
                        
                        <div class="card-body p-4 p-xl-5 text-center position-relative z-1">
                            
                            {{-- Icono  --}}
                            <div class="icon-wrapper mb-4 d-inline-block position-relative">
                                <div class="icon-ring position-absolute top-50 start-50 translate-middle rounded-circle bg-red-100" >
                                </div>
                                <div class="position-relative z-1 transition-icon text-center">
                                    
                                    <img src="{{ asset('iconos/Innovacion_culinaria.gif') }}" 
                                        alt="Innovación Culinaria"
                                        class="w-50 h-50 mx-auto object-contain transition-transform duration-300 hover:scale-110">

                                </div>
                            </div>

                            <div class="text-8xl font-black text-gray-100 position-absolute" style="top: 10px; right: 15px; font-family: monospace;">02</div>

                            <h3 class="h3 fw-bold mb-3">Innovación Culinaria</h3>
                            
                            <div class="w-12 h-1 bg-red-600 mx-auto my-3 rounded"></div>
                            
                            <p class="text-gray-600 mb-0">
                                Fusionamos técnicas ancestrales con tecnología moderna para crear experiencias únicas en cada plato.
                            </p>
                            
                            <div class="mt-4 opacity-0 transition-link">
                                <span class="text-red-600 text-sm font-semibold">Descubrir más →</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3 - Atención Personalizada --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover-card overflow-hidden position-relative">
                        
                        <div class="card-gradient position-absolute top-0 start-0 w-100 h-100 opacity-0 transition" style="background: linear-gradient(135deg, rgba(220,38,38,0.05), rgba(153,27,27,0.02));"></div>
                        
                        <div class="card-body p-4 p-xl-5 text-center position-relative z-1">
                            
                            {{-- Icono  --}}
                            <div class="icon-wrapper mb-4 d-inline-block position-relative">
                                <div class="icon-ring position-absolute top-50 start-50 translate-middle rounded-circle bg-red-100" >
                                </div>
                                <div class="position-relative z-1 transition-icon text-center">
                                    
                                    <img src="{{ asset('iconos/Atencion_personalizada.gif') }}" 
                                        alt="Atención Personalizada"
                                        class="w-50 h-50 mx-auto object-contain transition-transform duration-300 hover:scale-110">

                                </div>
                            </div>

                            <div class="text-8xl font-black text-gray-100 position-absolute" style="top: 10px; right: 15px; font-family: monospace;">03</div>

                            <h3 class="h3 fw-bold mb-3">Atención Personalizada</h3>
                            
                            <div class="w-12 h-1 bg-red-600 mx-auto my-3 rounded"></div>
                            
                            <p class="text-gray-600 mb-0">
                                Brindamos una experiencia única, cuidando cada detalle para superar las expectativas de nuestros clientes.
                            </p>
                            
                            <div class="mt-4 opacity-0 transition-link">
                                <span class="text-red-600 text-sm font-semibold">Descubrir más →</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer id="contacto" class="py-12 border-t" style="background-color:#1f2937; color:#d1d5db;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <div class="grid md:grid-cols-4 gap-8 mb-10">

                <div>
                    <h4 class="text-2xl font-bold text-white mb-4">
                        <span class="text-red-500">Corporation</span>AOSC
                    </h4>
                    <p class="mb-2">Perú - Piura - Talara.</p>
                    <p class="mb-2">Reservas: +51 952 167 090</p>
                    <p class="mb-2">Email: grupoaosc@gmail.com</p>
                </div>

                {{-- Mapa del sitio --}}
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Mapa del Sitio</h4>
                    <ul class="space-y-2">
                        <li><a href="#inicio"    class="hover:text-red-500 transition">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-red-500 transition">Menú Completo</a></li>
                        <li><a href="#filosofia" class="hover:text-red-500 transition">Nuestra Misión</a></li>
                        <li><a href="#contacto"  class="hover:text-red-500 transition">Ubicación</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-red-500 transition">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">Política de Privacidad</a></li>
                        <li>
                            <button id="open-reclamaciones-modal" class="hover:text-red-500 transition text-left">
                                Libro de Reclamaciones
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- Redes sociales --}}
                <div>
                    <h4 class="text-xl font-semibold text-white mb-4">Síguenos</h4>
                    <div class="flex space-x-4 text-white">
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-red-600 transition shadow-md">FB</a>
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-red-600 transition shadow-md">IG</a>
                        <a href="#" class="p-2 bg-gray-700 rounded-full hover:bg-red-600 transition shadow-md">TW</a>
                    </div>
                </div>

            </div>

            <div class="text-center pt-8 border-t border-gray-700">
                <p>&copy; 2025 CorporationAOSC. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
   
    {{-- Debug panel --}}
    

    {{--Login Modal--}}
    <div id="login-modal" class="hidden fixed inset-0 z-[110] flex items-center justify-center modal-overlay">
        <div class="w-full max-w-sm rounded-2xl shadow-2xl p-6 relative border backdrop-blur-md bg-white">

            <!-- CERRAR -->
            <button id="close-login-modal"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition">
                <i class="bi bi-x-lg"></i>
            </button>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
                ¡BIENVENIDO!
            </h2>

            <p class="text-center text-sm text-gray-500 mb-6">
                Ingresa tus credenciales
            </p>

            <!-- FORM REAL -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Email
                    </label>

                    <div class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                        
                        <div class="px-3 bg-gray-100 border-r">
                            <i class="bi bi-google text-red-500"></i>
                        </div>

                        <input type="email" name="email" required
                            placeholder="correo@gmail.com"
                            class="w-full px-3 py-2 text-sm outline-none">
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Contraseña
                    </label>

                    <div class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                        
                        <div class="px-3 bg-gray-100 border-r">
                            <i class="bi bi-lock-fill text-gray-600"></i>
                        </div>

                        <input type="password" name="password" required
                            placeholder="********"
                            class="w-full px-3 py-2 text-sm outline-none">
                    </div>
                </div>

                <!-- BOTON -->
                <button type="submit"
                    class="w-full py-2.5 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                    Iniciar Sesión
                </button>

                <!-- ERROR -->
                @if ($errors->any())
                    <p class="text-red-500 text-sm mt-3 text-center">
                        {{ $errors->first() }}
                    </p>
                @endif

                <!-- REGRESAR -->
                <p class="mt-4 text-xs text-center text-gray-500">
                    <a href="{{ url('') }}" class="text-red-600 hover:underline">
                        Regresar al inicio
                    </a>
                </p>

            </form>
        </div>
    </div>

@endsection