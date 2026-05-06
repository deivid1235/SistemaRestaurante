@extends('layouts.dashboard')

@section('title', 'Configuración Inicial')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-cogs text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight">Configuración Inicial</h1>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestiona los atributos principales, moneda, impuestos y dispositivos
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @php
            $totalConfig = count($settings);

            $configurados = collect($settings)->filter(fn($v) => !empty($v))->count();

            $faltantes = $totalConfig - $configurados;

            $divisor = $totalConfig > 0 ? $totalConfig : 1;
            $porcConfigurado = round(($configurados / $divisor) * 100);
            $porcFaltante = 100 - $porcConfigurado;
        @endphp

        <!-- Total Configuraciones -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); color: white;">
                <i class="fa fa-cog"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-blue-600 transition-colors">{{ $totalConfig }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Configuraciones</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Configurados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:rotate-12 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fa fa-check-double"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-emerald-600 transition-colors">{{ $configurados }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Configurados</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-1 rounded-md border border-emerald-100 transition-all duration-300 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-emerald-500">
                    {{ $porcConfigurado }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcConfigurado }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>

        <!-- Faltantes -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:-rotate-6"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fa fa-exclamation-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-red-600 transition-colors">{{ $faltantes }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Faltantes</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-1 rounded-md border border-red-100 transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:border-red-500">
                    {{ $porcFaltante }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcFaltante }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>
    </div>

    <form action="{{ route('admin.ConfiguracionInicial.update') }}" method="POST" id="formConfig">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 pt-7 pb-4 border-b border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-2xl shadow-lg shadow-blue-200/50" 
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-cogs text-white text-xl"></i>
                    </div>
                    
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Configuración del Sistema</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Gestiona los atributos principales, moneda, impuestos y dispositivos.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row h-auto">
            
                {{-- ── SIDEBAR TABS ────────────────────────── --}}
                <div class="w-full md:w-64 border-r border-slate-100 py-6 flex-shrink-0 bg-slate-50/50">
                    <nav class="space-y-3 px-4">

                        <button type="button" onclick="cambiarTab('zona-horaria')" id="tab-btn-zona-horaria"
                            class="config-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all text-left text-slate-500 hover:bg-slate-100">
                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-transparent transition-colors">
                                <i class="fa fa-map-marker-alt"></i>
                            </div>
                            <span>Zona Horaria</span>
                        </button>

                        <button type="button" onclick="cambiarTab('identificacion')" id="tab-btn-identificacion"
                            class="config-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all text-left bg-white shadow-md shadow-slate-200/50 text-sky-600 border border-slate-50">
                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-sky-50 text-sky-500 transition-colors">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <span>Identificación</span>
                        </button>

                        <button type="button" onclick="cambiarTab('impuesto')" id="tab-btn-impuesto"
                            class="config-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all text-left text-slate-500 hover:bg-slate-100">
                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-transparent transition-colors">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                            <span>Impuesto/Moneda</span>
                        </button>

                        <button type="button" onclick="cambiarTab('ordenador')" id="tab-btn-ordenador"
                            class="config-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all text-left text-slate-500 hover:bg-slate-100">
                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-transparent transition-colors">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <span>Ordenador (PC)</span>
                        </button>

                        <button type="button" onclick="cambiarTab('impresion')" id="tab-btn-impresion"
                            class="config-tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all text-left text-slate-500 hover:bg-slate-100">
                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-transparent transition-colors">
                                <i class="fa fa-print"></i>
                            </div>
                            <span>Impresión</span>
                        </button>

                    </nav>
                </div>
                {{-- ── CONTENIDO TABS ──────────────────────── --}}
                <div class="flex-1 px-8 py-6">

                    {{-- TAB 1: ZONA HORARIA --}}
                    <div id="tab-zona-horaria" class="config-tab-content space-y-6">
                        <div>
                            <!-- Título con Icono y Degradado -->
                            <div class="flex items-center gap-3 mb-4 pb-2 border-b border-slate-100">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg shadow-sm" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-globe-americas text-white text-xs"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">
                                    Configuración Regional
                                </h3>
                            </div>

                            <div class="space-y-4">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Zona Horaria (Ej: America/Lima)
                                    </label>
                                    <input type="text"
                                        name="zona_horaria"
                                        value="{{ $settings['zona_horaria'] }}"
                                        placeholder="America/Lima"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>

                                <div class="flex items-start gap-2.5 bg-cyan-50 border border-cyan-100 rounded-xl px-4 py-3">
                                    <i class="fa fa-info-circle text-cyan-500 mt-0.5 text-sm flex-shrink-0"></i>
                                    <p class="text-[11px] text-cyan-700 font-medium">
                                        Asegúrese de ingresar una zona horaria válida soportada por PHP.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 2: IDENTIFICACIÓN --}}
                    <div id="tab-identificacion" class="config-tab-content hidden space-y-10">

                        {{-- Tributaria --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-2 pb-2 border-b border-slate-100">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg shadow-sm" 
                                     style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-id-badge text-white text-xs"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">Identificación Tributaria</h3>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                {{-- Campo: Nomenclatura Tributaria --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-font text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nomenclatura (Ej: RUC, NIT)
                                        </label>
                                    </div>
                                    <input type="text" name="id_tributaria_nombre" value="{{ $settings['id_tributaria_nombre'] }}" placeholder="RUC"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors uppercase">
                                </div>

                                {{-- Campo: Caracteres Tributaria --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-list-ol text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nº Caracteres
                                        </label>
                                    </div>
                                    <input type="number" name="id_tributaria_caracteres" value="{{ $settings['id_tributaria_caracteres'] }}" placeholder="11"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                        {{-- Personal --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-2 pb-2 border-b border-slate-100">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg shadow-sm" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-user-tag text-white text-xs"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">Documento de Identidad Personal</h3>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                {{-- Campo: Nomenclatura Personal --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-address-card text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nomenclatura (Ej: DNI, CI)
                                        </label>
                                    </div>
                                    <input type="text" name="id_personal_nombre" value="{{ $settings['id_personal_nombre'] }}" placeholder="DNI"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors uppercase">
                                </div>

                                {{-- Campo: Caracteres Personal --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-fingerprint text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nº Caracteres
                                        </label>
                                    </div>
                                    <input type="number" name="id_personal_caracteres" value="{{ $settings['id_personal_caracteres'] }}" placeholder="8"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TAB 3: IMPUESTO / MONEDA --}}
                    <div id="tab-impuesto" class="config-tab-content hidden space-y-10">

                        <div class="space-y-6">
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Impuestos
                            </h3>
                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-file-invoice-dollar text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nombre del Impuesto (Ej: IGV, IVA)
                                        </label>
                                    </div>
                                    <input type="text" name="impuesto_nombre" value="{{ $settings['impuesto_nombre'] }}" placeholder="IGV"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300 uppercase">
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                           style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-percentage text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Valor Porcentual (%)
                                        </label>
                                    </div>
                                    <input type="number" name="impuesto_porcentaje" value="{{ $settings['impuesto_porcentaje'] }}" placeholder="18.00" min="0" max="100" step="0.01"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                        {{-- Moneda --}}
                        <div class="space-y-6">
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Moneda Local
                            </h3>
                            <div class="grid grid-cols-2 gap-8">
                            
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-coins text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nombre Moneda (Ej: SOLES, PESOS)
                                        </label>
                                    </div>
                                    <input type="text" name="moneda_nombre" value="{{ $settings['moneda_nombre'] }}" placeholder="Soles"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-dollar-sign text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Símbolo (Ej: S/, $)
                                        </label>
                                    </div>
                                    <input type="text" name="moneda_simbolo" value="{{ $settings['moneda_simbolo'] }}" placeholder="S/"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TAB 4: ORDENADOR --}}
                    <div id="tab-ordenador" class="config-tab-content hidden space-y-10">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Datos del Equipo (PC Principal)
                            </h3>

                            <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-100 rounded-xl px-4 py-3 mb-8">
                                <i class="fa fa-exclamation-triangle text-yellow-500 mt-0.5 text-sm flex-shrink-0"></i>
                                <p class="text-[11px] text-yellow-700 font-medium leading-relaxed">
                                    Estos datos identifican la caja principal o servidor local para la gestión del sistema.
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                {{-- Campo: Nombre del Equipo --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-desktop text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Nombre del Equipo
                                        </label>
                                    </div>
                                    <input type="text" name="pc_nombre" value="{{ $settings['pc_nombre'] }}" placeholder="DESKTOP-XXXXXX"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-600 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>

                                {{-- Campo: Dirección IP --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 flex items-center justify-center rounded-lg shadow-sm" 
                                             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-network-wired text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            Dirección IP
                                        </label>
                                    </div>
                                    <input type="text" name="pc_ip" value="{{ $settings['pc_ip'] }}" placeholder="192.168.1.1"
                                        class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2 text-sm font-medium text-slate-600 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TAB 5: IMPRESIÓN --}}
                    <div id="tab-impresion" class="config-tab-content hidden space-y-8">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-6 pb-2 border-b border-slate-100">
                                Opciones de Impresión
                            </h3>

                            {{-- CAMBIO AQUÍ: De space-y-4 a grid --}}
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                
                                {{-- Toggle: Comandas --}}
                                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-all bg-white/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center text-white shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-receipt text-base"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-[13px] leading-tight">Comandas</p>
                                            <p class="text-[10px] text-slate-400 mt-0.5 font-medium">Cocina/Bar</p>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="imp_comandas" id="toggle_comandas" class="sr-only peer" {{ $settings['imp_comandas'] === '1' ? 'checked' : '' }}>
                                        <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                                    </label>
                                </div>

                                {{-- Toggle: Pre-Cuenta --}}
                                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-all bg-white/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center text-white shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-file-invoice text-base"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-[13px] leading-tight">Pre-Cuenta</p>
                                            <p class="text-[10px] text-slate-400 mt-0.5 font-medium">Estado Mesa</p>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="imp_precuenta" id="toggle_precuenta" class="sr-only peer" {{ $settings['imp_precuenta'] === '1' ? 'checked' : '' }}>
                                        <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                                    </label>
                                </div>

                                {{-- Toggle: Comprobantes --}}
                                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-all bg-white/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center text-white shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-file-alt text-base"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-[13px] leading-tight">Facturación</p>
                                            <p class="text-[10px] text-slate-400 mt-0.5 font-medium">Comprobantes</p>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="imp_comprobantes" id="toggle_comprobantes" class="sr-only peer" {{ $settings['imp_comprobantes'] === '1' ? 'checked' : '' }}>
                                        <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
           <div class="px-8 py-3 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
                <a href="{{ route('admin.AdministracionGeneral.index') }}"
                class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-500 font-bold text-[11px] uppercase tracking-widest hover:bg-white hover:text-slate-600 hover:shadow-sm transition-all">
                    Cancelar
                </a>
                <button type="submit"
                        class="flex items-center gap-2.5 px-8 py-2.5 rounded-xl text-white font-bold text-[11px] uppercase tracking-widest shadow-md transition-all active:scale-95 hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">

                    <i class="fa fa-save text-xs"></i>
                    Guardar Cambios
                </button>
            </div>
        </div>
    </form>

</div>


@endsection
