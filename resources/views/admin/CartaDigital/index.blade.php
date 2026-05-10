@extends('layouts.dashboard')

@section('title', 'Carta Digital')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-qrcode text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight">Carta Digital</h1>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione el enlace público de su menú digital
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}"
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

   
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-check-circle text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-times-circle text-red-500"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-4">

       
        <div class="flex-1 space-y-4">
            <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 overflow-hidden">

                <div class="px-6 py-4 border-b border-slate-50 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                         style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-th-large text-white text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800 leading-none">Carta Virtual & QR</h2>
                        <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-1">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-500 mr-1"></span>
                            Gestione el enlace público de su menú digital
                        </p>
                    </div>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Enlace directo --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-[11px] font-black uppercase text-slate-600 tracking-widest">
                            Enlace Directo (URL)
                        </label>

                        <form action="{{ route('admin.CartaDigital.guardarUrl') }}" method="POST" id="formUrl">
                            @csrf

                            <div class="flex gap-0 rounded-xl overflow-hidden border border-slate-200 focus-within:border-blue-400 focus-within:ring-1 focus-within:ring-blue-300 transition-all">
                                <div class="flex items-center justify-center px-4 bg-slate-50 border-r border-slate-200">
                                    <i class="fa fa-link text-slate-400 text-sm"></i>
                                </div>
                                <input type="url"
                                       name="url"
                                       id="inputUrl"
                                       value="{{ $url }}"
                                       placeholder="https://tu-restaurante.com/menu"
                                       class="flex-1 px-4 py-3.5 text-sm font-bold text-blue-600 bg-white outline-none placeholder:text-slate-300 placeholder:font-normal">
                                <button type="button"
                                        onclick="copiarUrl()"
                                        class="flex items-center gap-2 px-4 py-3 bg-white border-l border-slate-200 text-slate-500 hover:bg-slate-50 font-bold text-[11px] transition-all">
                                    <i class="fa fa-copy text-xs"></i> Copiar
                                </button>
                                <a href="{{ $url }}" target="_blank"
                                   id="btnAbrir"
                                   class="flex items-center gap-2 px-4 py-3 bg-white border-l border-slate-200 text-blue-500 hover:bg-blue-50 font-bold text-[11px] transition-all {{ !$url ? 'pointer-events-none opacity-40' : '' }}">
                                    <i class="fa fa-external-link-alt text-xs"></i> Abrir
                                </a>
                            </div>

                            <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1.5">
                                <i class="fa fa-info-circle"></i>
                                Este es el enlace que sus clientes abrirán al escanear el QR.
                            </p>

                            <button type="submit"
                                    class="mt-4 flex items-center gap-2 px-5 py-2.5 rounded-xl text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                <i class="fa fa-save text-xs"></i>
                                GUARDAR URL
                            </button>
                        </form>
                    </div>

                    <hr class="border-slate-100">

                    {{-- Código QR --}}
                    <div class="flex flex-col sm:flex-row gap-6 items-start">

                        <div class="flex-1 space-y-2">
                            <h3 class="font-bold text-slate-800 text-sm">Código QR del Restaurante</h3>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Genere un nuevo código QR basado en la URL actual. Puede descargar
                                esta imagen para imprimirla en sus mesas o ponerla en acrílicos.
                            </p>

                            <form action="{{ route('admin.CartaDigital.generarQr') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-[11px] transition-all active:scale-95 shadow-sm shadow-emerald-100">
                                    <i class="fa fa-sync-alt text-xs"></i>
                                    Generar / Actualizar QR
                                </button>
                            </form>
                        </div>

                        {{-- Imagen QR --}}
                        <div class="flex flex-col items-center gap-2 flex-shrink-0">
                            @if($qrExists)
                                <div class="w-36 h-36 rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                                    <img src="{{ Storage::url($qrPath) }}?v={{ time() }}"
                                         alt="QR Carta Digital"
                                         class="w-full h-full object-contain">
                                </div>
                                <a href="{{ route('admin.CartaDigital.descargarQr') }}"
                                   class="flex items-center gap-1.5 text-[10px] font-bold text-slate-500 hover:text-blue-500 transition-colors">
                                    <i class="fa fa-download text-[9px]"></i>
                                    Click para descargar
                                </a>
                            @else
                                <div class="w-36 h-36 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center gap-2 bg-slate-50">
                                    <i class="fa fa-image text-slate-300 text-3xl"></i>
                                    <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest text-center">
                                        Imagen no<br>disponible
                                    </p>
                                </div>
                                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                                    Click para descargar
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- PANEL DERECHO - INFO --}}
        <div class="lg:w-72 rounded-[1.5rem] p-6 text-white shadow-sm self-start border border-white/10"
             style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">

            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center shadow-sm">
                    <i class="fa fa-lightbulb text-yellow-400 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-tight leading-none">¿Qué es la Carta Virtual?</h3>
                </div>
            </div>

            <p class="text-white/80 text-[11px] leading-relaxed mb-5 border-b border-white/10 pb-5 font-medium">
                Es su menú diseñado en formato digital para facilitar su
                consulta desde todo tipo de dispositivos (móviles, tablets).
            </p>

            <p class="font-black text-[9px] uppercase tracking-widest text-white/50 mb-4">Beneficios:</p>

            <ul class="space-y-3">
                <li class="flex items-start gap-2.5">
                    <div class="mt-0.5 w-4 h-4 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-[7px] text-emerald-400"></i>
                    </div>
                    <span class="text-white/80 text-[10.5px] leading-tight">
                        <strong class="text-white">Higiene y Seguridad:</strong> Evita el contacto físico con cartas tradicionales.
                    </span>
                </li>
                <li class="flex items-start gap-2.5">
                    <div class="mt-0.5 w-4 h-4 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-[7px] text-emerald-400"></i>
                    </div>
                    <span class="text-white/80 text-[10.5px] leading-tight">
                        <strong class="text-white">Interactividad:</strong> Es más atractiva y rápida de actualizar.
                    </span>
                </li>
                <li class="flex items-start gap-2.5">
                    <div class="mt-0.5 w-4 h-4 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-[7px] text-emerald-400"></i>
                    </div>
                    <span class="text-white/80 text-[10.5px] leading-tight">
                        <strong class="text-white">Acceso Rápido:</strong> El cliente solo necesita su cámara para escanear el QR.
                    </span>
                </li>
            </ul>

            {{-- Vista previa QR en panel --}}
            @if($qrExists)
            <div class="mt-6 pt-5 border-t border-white/10 flex flex-col items-center gap-3">
                <p class="text-[9px] font-black uppercase tracking-widest text-white/40">Vista previa QR</p>
                <div class="w-24 h-24 bg-white rounded-xl overflow-hidden p-1 shadow-lg">
                    <img src="{{ Storage::url($qrPath) }}?v={{ time() }}"
                         alt="QR Preview"
                         class="w-full h-full object-contain">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
