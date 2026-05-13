@extends('layouts.app')

@section('title', 'CorporationAOSC - Experiencia Gourmet Minimalista')

@section('content')
    <main id="inicio" class="relative w-full h-screen overflow-hidden">

        <div class="absolute inset-0 z-0">
            <div id="slider" class="w-full h-full relative">

                @forelse($imagenesCombos as $img)
                    <img src="{{ asset($img) }}"
                        class="slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000">
                @empty
                    <img src="{{ asset('img/default.jpg') }}"
                        class="absolute inset-0 w-full h-full object-cover">
                @endforelse

            </div>
        </div>

        <div class="absolute inset-0 bg-black/40 z-10"></div>

        <div class="relative z-20 text-center flex flex-col items-center justify-center h-full px-6 max-w-5xl mx-auto">

            <p class="text-xl tracking-widest text-sky-400 mb-3 uppercase font-light animate-bounce">
                Corporación de Alta Gastronomía
            </p>

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 tracking-tight leading-tight">
                <span class="text-white">Corporation</span>
                <span class="text-sky-500">AOSC</span>
            </h1>

            <p class="text-2xl text-gray-100 mb-10 font-extralight max-w-3xl mx-auto">
                Llevamos la excelencia culinaria al siguiente nivel.
            </p>

            <a href="#productos"
            class="inline-block px-10 py-4 bg-sky-500 text-white text-xl font-semibold rounded-xl shadow-lg hover:bg-sky-600 transition duration-300 transform hover:scale-110 uppercase tracking-wider">
                Explorar el Menú
            </a>

        </div>
    </main>

    <section id="productos" class="py-24 bg-slate-50"> 
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <h2 class="text-5xl font-extrabold text-center mb-16 text-gray-900 transition-all hover:tracking-wide duration-500">
                Categorías <span class="text-sky-600">Disponibles</span>
            </h2>

            <!-- CARRUSEL CON BOTONES -->
            <div class="relative">

                <!-- BOTÓN IZQUIERDA -->
                <button onclick="scrollCategories(-300)"
                    class="absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow-md p-3 rounded-full z-10 hover:bg-sky-100 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- CARRUSEL -->
                <div id="categories-carousel"
                    class="product-carousel flex space-x-4 pb-4 overflow-x-auto scrollbar-hide scroll-smooth px-10">

                    @forelse($categorias as $cat)
                        <div class="min-w-[150px] bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-4 flex flex-col items-center text-center cursor-pointer group"
                            onclick="loadProducts({{ $cat->id }})">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-sky-200 group-hover:scale-105 transition">

                                @if($cat->imagen)
                                    <img src="{{ asset('storage/' . $cat->imagen) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                        <i class="fa fa-utensils"></i>
                                    </div>
                                @endif

                            </div>

                            <h4 class="mt-3 text-sm font-bold text-gray-800 uppercase">
                                {{ $cat->descripcion }}
                            </h4>

                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">No hay categorías disponibles</p>
                    @endforelse

                </div>

            
                <button onclick="scrollCategories(300)"
                    class="absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow-md p-3 rounded-full z-10 hover:bg-sky-100 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>

            </div>

            
            <div id="product-loading-indicator" class="hidden flex justify-center items-center py-16">
                <div class="spinner border-sky-500"></div>
                <p class="text-lg text-sky-600 ml-4 animate-pulse">Cargando la carta...</p>
            </div>

        
            <div id="product-listing-content"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            </div>

        </div>
    </section>

    <div class="max-w-[1400px] mx-auto px-6 py-8">
    
    <div class="mb-10 text-center lg:text-left lg:px-3">
        
        <div class="relative mb-10 overflow-hidden">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold mb-4 text-gray-900 italic tracking-tight">
                    Menú <span class="text-sky-500">Especial</span>
                </h2>
                <p class="text-xl text-gray-500 font-medium">
                    Descubre nuestros platos seleccionados por el chef, preparados con ingredientes frescos y de calidad.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-[#00629b] via-slate-200 to-transparent mt-4"></div>
        </div>

        <div id="menu-productos"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            
            @foreach($productos as $prod)
            <div class="producto group bg-white rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col h-full"
                data-estado="{{ $prod->estado }}"
                data-nombre="{{ strtolower($prod->nombre ?? '') }}">
                
                <div class="relative h-44 m-2 overflow-hidden rounded-[1.2rem]">
                    <div class="absolute top-2 right-2 z-10">
                        <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider text-white shadow-lg {{ $prod->estado == 'a' ? 'bg-emerald-500' : 'bg-red-500' }}">
                            {{ $prod->estado == 'a' ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>

                    @if($prod->destacado)
                    <div class="absolute top-2 left-2 z-10">
                        <span class="bg-amber-400 text-white p-1.5 rounded-lg shadow-lg flex items-center justify-center">
                            <i class="fas fa-star text-[8px]"></i>
                        </span>
                    </div>
                    @endif

                    @if($prod->imagen && $prod->imagen != 'NULL')
                        <img src="{{ asset('storage/'.$prod->imagen) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-100">
                            <i class="fas fa-utensils text-slate-300 text-3xl"></i>
                        </div>
                    @endif

                    <div class="absolute bottom-2 left-2 right-2 flex justify-between items-center">
                        <span class="bg-black/70 backdrop-blur-md text-white text-xs font-black px-3 py-1 rounded-xl border border-white/10">
                            S/ {{ number_format($prod->precio, 2) }}
                        </span>
                        <span class="bg-sky-500/90 backdrop-blur-md text-white text-[9px] font-black px-2 py-1 rounded-lg">
                            Stock: {{ $prod->stock }}
                        </span>
                    </div>
                </div>

                <div class="px-4 pb-4 pt-1 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-base font-black text-slate-800 uppercase leading-tight truncate mr-2">
                            {{ $prod->nombre }}
                        </h3>
                        <span class="text-[9px] font-bold text-slate-300 bg-slate-50 px-1.5 py-0.5 rounded-md">#{{ $prod->id }}</span>
                    </div>
                    
                    <div class="space-y-0.5 mb-3">
                        <p class="text-[10px] text-slate-400 font-bold uppercase flex items-center gap-1.5">
                            <i class="fas fa-tag text-sky-400/50"></i> {{ $prod->categoria->descripcion ?? 'General' }}
                        </p>
                        <p class="text-[10px] text-emerald-500 font-extrabold uppercase flex items-center gap-1.5">
                            <i class="fas fa-wallet opacity-50"></i> COSTO: S/{{ number_format($prod->costo, 2) }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mb-4 bg-slate-50 p-2.5 rounded-[1rem] border border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-clock text-[10px] text-slate-400"></i>
                            <span class="text-[9px] font-bold text-slate-600">{{ $prod->tiempo_preparacion }} min</span>
                        </div>
                        <div class="flex items-center gap-1.5 {{ $prod->delivery ? 'text-orange-500' : 'text-slate-400' }}">
                            <i class="fas fa-motorcycle text-[10px]"></i>
                            <span class="text-[9px] font-black uppercase">{{ $prod->delivery ? 'Si' : 'No' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-slate-500">
                            <i class="fas fa-sort-numeric-down text-[10px]"></i>
                            <span class="text-[9px] font-bold uppercase">ORD: {{ $prod->orden }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-sky-500">
                            <i class="fas fa-utensils text-[10px]"></i>
                            <span class="text-[9px] font-black uppercase truncate">{{ $prod->preparacion }}</span>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-auto">
                        <a href="" 
                        class="flex-1 h-10 flex items-center justify-center gap-2 bg-[#0081C9] text-white rounded-xl shadow-md hover:bg-[#0071b3] transition-all active:scale-95">
                            <i class="fas fa-shopping-cart text-xs"></i>
                            <span class="text-[10px] font-black uppercase tracking-wider">Agregar al carrito</span>
                        </a>
                        <a href="{{ route('home.producto.show', $prod->id) }}"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-blue-400 hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-50">
                            <i class="fa fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <section id="comboss" class="py-24 bg-slate-50/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold mb-4 text-gray-900 italic tracking-tight">
                    Combos <span class="text-sky-500">Especiales</span>
                </h2>
                <p class="text-xl text-gray-500 font-medium">
                    Nuestros combos preparados por el chef. Se actualizan automáticamente.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-8">
                @foreach($combos as $combo)
                <div class="relative flex bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden h-44 group hover:shadow-xl transition-all duration-500">
                    
                    <div class="relative w-2/5 overflow-hidden">
                        @if($combo->imagen)
                            <img src="{{ asset($combo->imagen) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                <i class="fas fa-utensils text-slate-300 text-4xl"></i>
                            </div>
                        @endif

                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest text-white shadow-lg {{ $combo->estado == 'activo' ? 'bg-emerald-500' : 'bg-red-500' }}">
                                {{ $combo->estado }}
                            </span>
                        </div>
                    </div>

                    <div class="relative flex flex-col justify-between py-3">
                        <div class="w-6 h-6 bg-slate-50/50 border border-slate-100 rounded-full -mt-6 -ml-3 shadow-inner"></div>
                        <div class="h-full border-r-2 border-dashed border-slate-100 ml-[1px]"></div>
                        <div class="w-6 h-6 bg-slate-50/50 border border-slate-100 rounded-full -mb-6 -ml-3 shadow-inner"></div>
                    </div>

                    <div class="flex-1 p-6 flex flex-col justify-center">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-sky-500 uppercase tracking-[0.2em]">
                                PROMO ESPECIAL
                            </p>
                            <h3 class="text-xl font-black text-slate-800 uppercase leading-tight italic">
                                {{ $combo->nombre }}
                            </h3>
                        </div>

                        <div class="mt-4 flex items-center gap-6">
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Área</p>
                                <p class="text-xs font-black text-slate-700 uppercase">{{ $combo->area->nombre ?? 'BAR' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Servicio</p>
                                <p class="text-xs font-black text-slate-700 uppercase flex items-center gap-1.5">
                                    <i class="fas {{ $combo->delivery ? 'fa-motorcycle text-emerald-500' : 'fa-store text-orange-500' }}"></i>
                                    {{ $combo->delivery ? 'DELIVERY' : 'LOCAL' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-[0.05] pointer-events-none group-hover:opacity-10 transition-opacity">
                        <i class="fas fa-barcode text-6xl"></i>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section id="filosofia" class="py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;margin-bottom:56px;flex-wrap:wrap">
                <div>
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                        <span style="width:8px;height:8px;border-radius:50%;background:#01579B;display:inline-block"></span>
                        <span style="font-size:11px;letter-spacing:.18em;text-transform:uppercase;color:#01579B;font-weight:600">Filosofía</span>
                    </div>
                    <h2 style="font-size:52px;font-weight:900;color:#0d1117;line-height:.95;margin:0">Nuestra<br><em style="font-style:italic;color:#01579B;font-weight:300">Misión</em></h2>
                </div>
                <p style="max-width:220px;font-size:13px;color:#888;line-height:1.6;text-align:right;margin:0">Los pilares que guían cada decisión que tomamos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="filo-card" style="background:#f0f7ff; border:0.5px solid #cde0f5; border-radius:24px; padding:32px 24px; transition:all .4s ease; cursor:pointer; position:relative; overflow:hidden;"
                    onmouseover="this.style.background='#01579B'; this.style.transform='translateY(-6px)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#fff'); this.querySelectorAll('.line-target').forEach(e => e.style.background='rgba(255,255,255,.4)'); this.querySelector('.icon-bg').style.background='rgba(255,255,255,.15)';"
                    onmouseout="this.style.background='#f0f7ff'; this.style.transform='translateY(0)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#0d1117'); this.querySelector('.num-target').style.color='#01579B'; this.querySelector('.desc-target').style.color='#555'; this.querySelectorAll('.line-target').forEach(e => e.style.background='#01579B'); this.querySelector('.icon-bg').style.background='#daeeff';">
                    
                    <p class="txt-target num-target" style="font-size:11px; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#01579B; opacity:.5; margin-bottom:32px; transition:color .4s">01</p>
                    <div class="icon-bg" style="width:52px; height:52px; border-radius:14px; background:#daeeff; display:flex; align-items:center; justify-content:center; margin-bottom:20px; transition:background .4s">
                        <img src="{{ asset('iconos/Materia_prima.gif') }}" style="width:28px; height:28px">
                    </div>
                    <h3 class="txt-target" style="font-size:20px; font-weight:900; color:#0d1117; margin-bottom:10px; line-height:1.1; transition:color .4s">Materia Prima</h3>
                    <div class="line-target" style="width:28px; height:2px; border-radius:2px; background:#01579B; margin-bottom:14px; transition:background .4s"></div>
                    <p class="txt-target desc-target" style="font-size:13px; color:#555; line-height:1.65; margin:0; transition:color .4s">Solo trabajamos con ingredientes frescos, orgánicos y de origen local.</p>
                </div>

                <div class="filo-card" style="background:#f0f7ff; border:0.5px solid #cde0f5; border-radius:24px; padding:32px 24px; transition:all .4s ease; cursor:pointer; position:relative; overflow:hidden;"
                    onmouseover="this.style.background='#01579B'; this.style.transform='translateY(-6px)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#fff'); this.querySelectorAll('.line-target').forEach(e => e.style.background='rgba(255,255,255,.4)'); this.querySelector('.icon-bg').style.background='rgba(255,255,255,.15)';"
                    onmouseout="this.style.background='#f0f7ff'; this.style.transform='translateY(0)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#0d1117'); this.querySelector('.num-target').style.color='#01579B'; this.querySelector('.desc-target').style.color='#555'; this.querySelectorAll('.line-target').forEach(e => e.style.background='#01579B'); this.querySelector('.icon-bg').style.background='#daeeff';">
                    
                    <p class="txt-target num-target" style="font-size:11px; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#01579B; opacity:.5; margin-bottom:32px; transition:color .4s">02</p>
                    <div class="icon-bg" style="width:52px; height:52px; border-radius:14px; background:#daeeff; display:flex; align-items:center; justify-content:center; margin-bottom:20px; transition:background .4s">
                        <img src="{{ asset('iconos/Innovacion_culinaria.gif') }}" style="width:28px; height:28px">
                    </div>
                    <h3 class="txt-target" style="font-size:20px; font-weight:900; color:#0d1117; margin-bottom:10px; line-height:1.1; transition:color .4s">Innovación</h3>
                    <div class="line-target" style="width:28px; height:2px; border-radius:2px; background:#01579B; margin-bottom:14px; transition:background .4s"></div>
                    <p class="txt-target desc-target" style="font-size:13px; color:#555; line-height:1.65; margin:0; transition:color .4s">Fusionamos técnicas ancestrales con tecnología moderna.</p>
                </div>

                <div class="filo-card" style="background:#f0f7ff; border:0.5px solid #cde0f5; border-radius:24px; padding:32px 24px; transition:all .4s ease; cursor:pointer; position:relative; overflow:hidden;"
                    onmouseover="this.style.background='#01579B'; this.style.transform='translateY(-6px)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#fff'); this.querySelectorAll('.line-target').forEach(e => e.style.background='rgba(255,255,255,.4)'); this.querySelector('.icon-bg').style.background='rgba(255,255,255,.15)';"
                    onmouseout="this.style.background='#f0f7ff'; this.style.transform='translateY(0)'; this.querySelectorAll('.txt-target').forEach(e => e.style.color='#0d1117'); this.querySelector('.num-target').style.color='#01579B'; this.querySelector('.desc-target').style.color='#555'; this.querySelectorAll('.line-target').forEach(e => e.style.background='#01579B'); this.querySelector('.icon-bg').style.background='#daeeff';">
                    
                    <p class="txt-target num-target" style="font-size:11px; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#01579B; opacity:.5; margin-bottom:32px; transition:color .4s">03</p>
                    <div class="icon-bg" style="width:52px; height:52px; border-radius:14px; background:#daeeff; display:flex; align-items:center; justify-content:center; margin-bottom:20px; transition:background .4s">
                        <img src="{{ asset('iconos/Atencion_personalizada.gif') }}" style="width:28px; height:28px">
                    </div>
                    <h3 class="txt-target" style="font-size:20px; font-weight:900; color:#0d1117; margin-bottom:10px; line-height:1.1; transition:color .4s">Atención</h3>
                    <div class="line-target" style="width:28px; height:2px; border-radius:2px; background:#01579B; margin-bottom:14px; transition:background .4s"></div>
                    <p class="txt-target desc-target" style="font-size:13px; color:#555; line-height:1.65; margin:0; transition:color .4s">Brindamos una experiencia única, cuidando cada detalle.</p>
                </div>

            </div>
        </div>
    </section>

    <section id="seccion-contacto" class="py-20">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="mb-12">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px">
                    <span style="width:24px;height:1px;background:#01579B;display:inline-block"></span>
                    <span style="font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:#01579B">Contacto</span>
                    <span style="width:24px;height:1px;background:#01579B;display:inline-block"></span>
                </div>
                <h2 style="font-family:inherit;font-size:42px;font-weight:900;color:#01579B;line-height:1;margin:0">Hablemos</h2>
                <p style="font-size:36px;font-weight:300;font-style:italic;color:#01579B;margin:0;line-height:1.2"> de tu pedido o reserva</p>
            </div>

            <div class="grid lg:grid-cols-[1fr_300px] grid-cols-1 gap-5">

                <!-- FORMULARIO -->
                <div style="background:#fff;border-radius:20px;padding:28px">

                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4" style="margin-bottom:16px">
                        <div>
                            <label style="display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin-bottom:6px">Nombre</label>
                            <input type="text" placeholder="Tu nombre"
                                style="width:100%;background:#f5f3ef;border:none;border-radius:10px;padding:11px 14px;font-size:14px;color:#222;outline:none;font-family:inherit"
                                onfocus="this.style.outline='2px solid #01579B'"
                                onblur="this.style.outline='none'">
                        </div>
                        <div>
                            <label style="display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin-bottom:6px">Apellido</label>
                            <input type="text" placeholder="Tu apellido"
                                style="width:100%;background:#f5f3ef;border:none;border-radius:10px;padding:11px 14px;font-size:14px;color:#222;outline:none;font-family:inherit"
                                onfocus="this.style.outline='2px solid #01579B'"
                                onblur="this.style.outline='none'">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4" style="margin-bottom:16px">
                        <div>
                            <label style="display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin-bottom:6px">Teléfono</label>
                            <input type="tel" placeholder="+51 000 000 000"
                                style="width:100%;background:#f5f3ef;border:none;border-radius:10px;padding:11px 14px;font-size:14px;color:#222;outline:none;font-family:inherit"
                                onfocus="this.style.outline='2px solid #01579B'"
                                onblur="this.style.outline='none'">
                        </div>
                        <div>
                            <label style="display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin-bottom:6px">Email</label>
                            <input type="email" placeholder="correo@ejemplo.com"
                                style="width:100%;background:#f5f3ef;border:none;border-radius:10px;padding:11px 14px;font-size:14px;color:#222;outline:none;font-family:inherit"
                                onfocus="this.style.outline='2px solid #01579B'"
                                onblur="this.style.outline='none'">
                        </div>
                    </div>

                    <div style="margin-bottom:20px">
                        <label style="display:block;font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin-bottom:6px">Mensaje</label>
                        <textarea placeholder="Cuéntanos en qué podemos ayudarte..." rows="4"
                            style="width:100%;background:#f5f3ef;border:none;border-radius:10px;padding:11px 14px;font-size:14px;color:#222;outline:none;resize:none;font-family:inherit;line-height:1.5"
                            onfocus="this.style.outline='2px solid #01579B'"
                            onblur="this.style.outline='none'"></textarea>
                    </div>

                    <div style="display:flex;justify-content:flex-end">
                    <button style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:#01579B;border:none;border-radius:10px;font-size:11px;letter-spacing:.12em;text-transform:uppercase;font-weight:700;color:#fff;cursor:pointer;font-family:inherit;transition:background .2s"
                        onmouseover="this.style.background='#014170'"
                        onmouseout="this.style.background='#01579B'">

                        <i class="fa-solid fa-paper-plane" style="font-size:13px"></i>
                        Enviar Solicitud
                    </button>
                </div>

                </div>

                <!-- LADO DERECHO -->
                <div style="display:flex;flex-direction:column;gap:16px">

                    <!-- INFO CONTACTO -->
                    <div style="background:#fff;border-radius:20px;padding:24px">
                        <div style="margin-bottom:20px">
                            <p style="font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin:0 0 4px">Teléfono</p>
                            <p style="font-size:15px;font-weight:700;color:#111;margin:0">+51 952 167 090</p>
                        </div>
                        <div>
                            <p style="font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:#888;margin:0 0 4px">Email</p>
                            <p style="font-size:13px;font-weight:700;color:#111;margin:0">gerencia@groupaosc.com</p>
                        </div>
                    </div>

                    <!-- MAPA -->
                    <div style="background:#fff;border-radius:20px;overflow:hidden">
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:16px 20px">
                            <span style="font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#222">Sede Central</span>
                            <a href="#" style="font-size:11px;color:#555;text-decoration:none;display:inline-flex;align-items:center;gap:4px"
                                onmouseover="this.style.color='#01579B'"
                                onmouseout="this.style.color='#555'">
                                Ver mapa <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:10px"></i>
                            </a>
                        </div>
                        <div style="height:148px;overflow:hidden;filter:grayscale(1);transition:filter .5s"
                            onmouseover="this.style.filter='grayscale(0)'"
                            onmouseout="this.style.filter='grayscale(1)'">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15891.139682548817!2d-80.628!3d-5.19!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2spe!4v1710000000000!5m2!1ses!2spe"
                                style="width:100%;height:100%;border:none;display:block"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    
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
        
        function scrollCategories(value) {
            const container = document.getElementById('categories-carousel');
            container.scrollBy({
                left: value,
                behavior: 'smooth'
            });
        }

        function loadProducts(id_catg) {
            const container = document.getElementById('menu-productos');
            const loading = document.getElementById('product-loading-indicator');

            loading.classList.remove('hidden');
            container.innerHTML = '';

            fetch(`/productos/categoria/${id_catg}`)
                .then(response => response.json())
                .then(data => {

                    loading.classList.add('hidden');

                    if (data.length === 0) {
                        container.innerHTML = `
                            <p class="text-center text-gray-400 col-span-full">
                                No hay productos en esta categoría
                            </p>`;
                        return;
                    }

                    data.forEach(prod => {

                        container.innerHTML += `
                        <div class="producto group bg-white rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col h-full">

                            <!-- IMAGEN -->
                            <div class="relative h-44 m-2 overflow-hidden rounded-[1.2rem]">

                                <!-- ESTADO -->
                                <div class="absolute top-2 right-2 z-10">
                                    <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider text-white shadow-lg ${
                                        prod.estado === 'a' ? 'bg-emerald-500' : 'bg-red-500'
                                    }">
                                        ${prod.estado === 'a' ? 'ACTIVO' : 'INACTIVO'}
                                    </span>
                                </div>

                                <!-- DESTACADO -->
                                ${prod.destacado == 1 ? `
                                    <div class="absolute top-2 left-2 z-10">
                                        <span class="bg-amber-400 text-white p-1.5 rounded-lg shadow-lg flex items-center justify-center">
                                            <i class="fas fa-star text-[8px]"></i>
                                        </span>
                                    </div>
                                ` : ''}

                                <!-- IMAGEN -->
                                ${
                                    prod.imagen && prod.imagen !== 'NULL'
                                    ? `<img src="/storage/${prod.imagen}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">`
                                    : `<div class="w-full h-full flex items-center justify-center bg-slate-100">
                                            <i class="fas fa-utensils text-slate-300 text-3xl"></i>
                                    </div>`
                                }

                                <!-- PRECIO Y STOCK -->
                                <div class="absolute bottom-2 left-2 right-2 flex justify-between items-center">

                                    <span class="bg-black/70 text-white text-xs font-black px-3 py-1 rounded-xl">
                                        S/ ${parseFloat(prod.precio).toFixed(2)}
                                    </span>

                                    <span class="bg-sky-500/90 text-white text-[9px] font-black px-2 py-1 rounded-lg">
                                        Stock: ${prod.stock}
                                    </span>

                                </div>
                            </div>

                            <!-- CONTENIDO -->
                            <div class="px-4 pb-4 pt-1 flex-1 flex flex-col">

                                <!-- TITULO -->
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-base font-black text-slate-800 uppercase leading-tight truncate mr-2">
                                        ${prod.nombre}
                                    </h3>
                                    <span class="text-[9px] font-bold text-slate-300 bg-slate-50 px-1.5 py-0.5 rounded-md">
                                        #${prod.id}
                                    </span>
                                </div>

                                <!-- CATEGORIA / COSTO -->
                                <div class="space-y-1 mb-3">

                                    <p class="text-[10px] text-slate-400 font-bold uppercase flex items-center gap-1.5">
                                        <i class="fas fa-tag text-sky-400/50"></i>
                                        ${prod.categoria ?? 'GENERAL'}
                                    </p>

                                    <p class="text-[10px] text-emerald-500 font-extrabold uppercase flex items-center gap-1.5">
                                        <i class="fas fa-wallet opacity-50"></i>
                                        COSTO: S/ ${prod.costo ?? '0.00'}
                                    </p>

                                </div>

                                <!-- INFO EXTRA -->
                                <div class="grid grid-cols-2 gap-2 mb-4 bg-slate-50 p-2.5 rounded-[1rem] border border-slate-100">

                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-clock text-[10px] text-slate-400"></i>
                                        <span class="text-[9px] font-bold text-slate-600">${prod.tiempo_preparacion ?? 0} min</span>
                                    </div>

                                    <div class="flex items-center gap-1.5 ${prod.delivery ? 'text-orange-500' : 'text-slate-400'}">
                                        <i class="fas fa-motorcycle text-[10px]"></i>
                                        <span class="text-[9px] font-black uppercase">${prod.delivery ? 'SI' : 'NO'}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5 text-slate-500">
                                        <i class="fas fa-sort-numeric-down text-[10px]"></i>
                                        <span class="text-[9px] font-bold uppercase">ORD: ${prod.orden ?? 0}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5 text-sky-500">
                                        <i class="fas fa-utensils text-[10px]"></i>
                                        <span class="text-[9px] font-black uppercase truncate">${prod.preparacion ?? 'COCINA'}</span>
                                    </div>

                                </div>

                                <!-- BOTONES -->
                                <div class="flex gap-2 mt-auto">

                                    <a href="#"
                                    class="flex-1 h-10 flex items-center justify-center gap-2 bg-[#0081C9] text-white rounded-xl shadow-md hover:bg-[#0071b3] transition-all">

                                        <i class="fas fa-shopping-cart text-xs"></i>
                                        <span class="text-[10px] font-black uppercase">Agregar</span>

                                    </a>

                                    <a href="/producto/${prod.id}"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-blue-400 hover:bg-blue-600 hover:text-white transition-all">

                                        <i class="fa fa-eye text-sm"></i>

                                    </a>

                                </div>

                            </div>
                        </div>
                        `;
                    });

                });
        }

        document.addEventListener("DOMContentLoaded", function () {
            let images = document.querySelectorAll("#slider img");
            let index = 0;

            function showSlide() {
                images.forEach(img => img.style.opacity = "0");
                images[index].style.opacity = "1";
            }

            function nextSlide() {
                index = (index + 1) % images.length;
                showSlide();
            }

            showSlide();
            setInterval(nextSlide, 3000);
        });

    </script>

@endsection