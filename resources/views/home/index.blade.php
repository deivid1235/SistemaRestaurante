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

        <div class="absolute inset-0 bg-black/40 z-10"></div> {{-- Un poco más oscuro para resaltar el blanco --}}

        <div class="relative z-20 text-center flex flex-col items-center justify-center h-full px-6 max-w-5xl mx-auto">
            {{-- Movimiento de entrada suave: animate-fade-down --}}
            <p class="text-xl tracking-widest text-sky-400 mb-3 uppercase font-light animate-bounce">
                Corporación de Alta Gastronomía
            </p>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 tracking-tight leading-tight transition-all duration-700">
                <span class="text-white">Corporation</span>
                <span class="text-sky-500">AOSC</span>
            </h1>
            <p class="text-2xl text-gray-100 mb-10 font-extralight max-w-3xl mx-auto">
                Llevamos la excelencia culinaria al siguiente nivel. Claridad en el diseño, pureza en el sabor.
            </p>
            {{-- Botón Celeste con efecto de escala --}}
            <a href="#productos"
            class="inline-block px-10 py-4 bg-sky-500 text-white text-xl font-semibold rounded-xl shadow-lg
                    hover:bg-sky-600 transition duration-300 transform hover:scale-110 uppercase tracking-wider">
                Explorar el Menú
            </a>
        </div>
    </main>

    {{-- SECCIÓN: CATEGORÍAS Y PRODUCTOS--}}
    <section id="productos" class="py-24 bg-slate-50"> {{-- Fondo blanco humo --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900 transition-all hover:tracking-wide duration-500">
                Categorías <span class="text-sky-600">Disponibles</span>
            </h2>

            {{-- Carrusel de categorías --}}
            <div class="mb-16 relative">
                <h3 class="text-3xl font-bold mb-6 text-gray-800 border-l-4 border-sky-500 pl-4">Explora por Categoría</h3>

                <div class="relative">
                    <button id="categories-prev" aria-label="Anterior"
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-white shadow-lg hover:bg-sky-500 hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <div id="categories-carousel" class="product-carousel flex space-x-4 pb-4 overflow-x-auto scrollbar-hide"></div>

                    <button id="categories-next" aria-label="Siguiente"
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-30 p-2 rounded-full bg-white shadow-lg hover:bg-sky-500 hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Listado de productos --}}
            <h3 id="product-listing-title" class="text-3xl font-bold mb-8 text-gray-900">Menú General</h3>

            <div id="product-loading-indicator" class="hidden flex justify-center items-center py-16">
                <div class="spinner border-sky-500"></div>
                <p class="text-lg text-sky-600 ml-4 animate-pulse">Cargando la carta...</p>
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
                Combos <span class="text-sky-500">Especiales</span>
            </h2>
            <p class="text-xl text-gray-600 text-center mb-16">
                Nuestros combos preparados por el chef. Se actualizan automáticamente.
            </p>
            <div id="combo-listing-content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
        </div>
    </section>

    {{-- SECCIÓN: MISIÓN / FILOSOFÍA --}}
    <section id="filosofia" class="py-24 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);">
    
        {{-- Decoración de fondo Celeste --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="pointer-events: none;">
            <div class="position-absolute" style="top: -20%; right: -10%; width: 60%; height: 80%; background: radial-gradient(circle, rgba(14,165,233,0.1) 0%, transparent 70%);"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl position-relative z-1">
            <h2 class="text-5xl md:text-6xl font-extrabold text-center mb-4" 
                style="background: linear-gradient(135deg, #0ea5e9, #0369a1, #0ea5e9); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent;">
                Nuestra <span class="border-b-4 border-sky-500 pb-2">Misión</span>
            </h2>

            <div class="row g-4 mt-5">
                {{-- Card 1 - Materia Prima --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden bg-white">
                        <div class="card-body p-4 p-xl-5 text-center">
                            <div class="mb-4 d-inline-block p-3 rounded-full bg-sky-50">
                                <img src="{{ asset('iconos/Materia_prima.gif') }}" alt="Materia Prima" class="w-16 h-16 mx-auto">
                            </div>
                            <h3 class="h3 fw-bold mb-3 text-gray-800">Materia Prima</h3>
                            <div class="w-12 h-1 bg-sky-500 mx-auto my-3 rounded"></div>
                            <p class="text-gray-600 mb-0">Solo trabajamos con ingredientes frescos, orgánicos y de origen local.</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2 - Innovación --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden bg-white">
                        <div class="card-body p-4 p-xl-5 text-center">
                            <div class="mb-4 d-inline-block p-3 rounded-full bg-sky-50">
                                <img src="{{ asset('iconos/Innovacion_culinaria.gif') }}" alt="Innovación" class="w-16 h-16 mx-auto">
                            </div>
                            <h3 class="h3 fw-bold mb-3 text-gray-800">Innovación</h3>
                            <div class="w-12 h-1 bg-sky-500 mx-auto my-3 rounded"></div>
                            <p class="text-gray-600 mb-0">Fusionamos técnicas ancestrales con tecnología moderna.</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3 - Atención --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden bg-white">
                        <div class="card-body p-4 p-xl-5 text-center">
                            <div class="mb-4 d-inline-block p-3 rounded-full bg-sky-50">
                                <img src="{{ asset('iconos/Atencion_personalizada.gif') }}" alt="Atención" class="w-16 h-16 mx-auto">
                            </div>
                            <h3 class="h3 fw-bold mb-3 text-gray-800">Atención</h3>
                            <div class="w-12 h-1 bg-sky-500 mx-auto my-3 rounded"></div>
                            <p class="text-gray-600 mb-0">Brindamos una experiencia única, cuidando cada detalle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="seccion-contacto" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tighter transition-all hover:scale-105 duration-500">Contáctanos</h2>
                <div class="w-12 h-1 bg-sky-500 mx-auto mt-2 rounded-full animate-pulse"></div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-xl shadow-slate-100 border border-slate-50">
                    <div class="flex items-center gap-2 mb-8 text-sky-600 font-bold uppercase text-xs tracking-widest">
                        <i class="fa-solid fa-paper-plane animate-bounce"></i>
                        <span>Envíanos un mensaje</span>
                    </div>
                    <form action="#" class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre</label>
                            <div class="relative group">
                                <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors"></i>
                                <input type="text" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-sky-400 focus:bg-white outline-none transition-all font-semibold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Apellido</label>
                            <div class="relative group">
                                <i class="fa-solid fa-signature absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors"></i>
                                <input type="text" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-sky-400 focus:bg-white outline-none transition-all font-semibold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Teléfono</label>
                            <div class="relative group">
                                <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors"></i>
                                <input type="tel" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-sky-400 focus:bg-white outline-none transition-all font-semibold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                            <div class="relative group">
                                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors"></i>
                                <input type="email" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-sky-400 focus:bg-white outline-none transition-all font-semibold">
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mensaje</label>
                            <textarea rows="4" class="w-full p-4 bg-slate-50 border-2 border-transparent rounded-3xl focus:border-sky-400 focus:bg-white outline-none transition-all resize-none font-semibold"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button class="group px-10 py-3.5 bg-sky-600 text-white font-black uppercase text-xs tracking-widest rounded-2xl shadow-lg shadow-sky-100 hover:bg-sky-700 hover:scale-105 transition-all flex items-center gap-2">
                                Enviar Solicitud
                                <i class="fa-solid fa-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 hover-lift">
                        <h4 class="text-xs font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                            <span class="w-2 h-2 bg-sky-500 rounded-full"></span>
                            Contacto Directo
                        </h4>
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 group">
                                <div class="w-10 h-10 bg-sky-50 text-sky-600 flex items-center justify-center rounded-xl group-hover:bg-sky-600 group-hover:text-white transition-all"><i class="fa-solid fa-phone"></i></div>
                                <div><p class="text-[9px] text-slate-400 font-bold uppercase">Teléfono</p><p class="font-black text-slate-800">+51 952167090</p></div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div class="w-10 h-10 bg-sky-50 text-sky-600 flex items-center justify-center rounded-xl group-hover:bg-sky-600 group-hover:text-white transition-all"><i class="fa-solid fa-envelope"></i></div>
                                <div><p class="text-[9px] text-slate-400 font-bold uppercase">E-mail</p><p class="font-black text-slate-800 text-[11px]">gerencia@groupaosc.com</p></div>
                            </div>
                        </div>
                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <p class="text-[9px] font-black uppercase text-slate-400 mb-4 tracking-widest">Aceptamos</p>
                            <div class="flex gap-4 text-2xl text-slate-300">
                                <i class="fa-brands fa-cc-visa hover:text-[#1A1F71] transition-colors cursor-help"></i>
                                <i class="fa-brands fa-cc-amex hover:text-[#006FCF] transition-colors cursor-help"></i>
                                <i class="fa-brands fa-cc-mastercard hover:text-[#EB001B] transition-colors cursor-help"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-3 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 group">
                        <div class="flex justify-between p-3 items-center">
                            <span class="text-[10px] font-black uppercase"><i class="fa-solid fa-location-dot text-sky-500 mr-1"></i> Sede Central</span>
                            <a href="#" class="text-[9px] font-black text-sky-600 uppercase hover:underline">Ver Mapa</a>
                        </div>
                        <div class="h-40 bg-slate-100 rounded-2xl overflow-hidden relative grayscale group-hover:grayscale-0 transition-all duration-700">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15891.139682548817!2d-80.628!3d-5.19!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2spe!4v1710000000000!5m2!1ses!2spe" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Login Modal --}}
    <div id="login-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/20">
        <div class="w-full max-w-sm rounded-2xl shadow-2xl p-8 relative border bg-white transform transition-all duration-300 scale-100">
            <button id="close-login-modal" class="absolute top-4 right-4 text-gray-400 hover:text-sky-500 transition">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="flex justify-center mb-4">
                <img src="{{ asset('perfil/logoprint.jpg') }}" alt="Logo" class="w-16 h-16">
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">¡BIENVENIDO!</h2>
            <p class="text-center text-sm text-gray-500 mb-8">Ingresa tus credenciales</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-bold text-sky-600 mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-sky-500 outline-none transition">
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-sky-600 mb-1 uppercase tracking-wider">Contraseña</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-sky-500 outline-none transition">
                </div>

                <button type="submit" class="w-full py-3 bg-sky-500 text-white font-bold rounded-lg hover:bg-sky-600 shadow-md transition-all transform hover:scale-105">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const slides = document.querySelectorAll(".slide");
        let current = 0;

        setInterval(() => {
            slides[current].classList.replace("opacity-100", "opacity-0");
            current = (current + 1) % slides.length;
            slides[current].classList.replace("opacity-0", "opacity-100");
        }, 4000); 
    });
    </script>
@endsection