@extends('layouts.dashboard')

@section('title', 'Configuración Inicial')

@section('content')

<div class="relative space-y-6">

    {{-- ══════════════════════════════════════════
         HEADER BANNER
    ══════════════════════════════════════════ --}}
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

    {{-- ══════════════════════════════════════════
         ALERTA
    ══════════════════════════════════════════ --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-check-circle text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ══════════════════════════════════════════
         PANEL PRINCIPAL CON TABS
    ══════════════════════════════════════════ --}}
    <form action="{{ route('admin.ConfiguracionInicial.update') }}" method="POST" id="formConfig">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 overflow-hidden">

            {{-- Encabezado del panel --}}
            <div class="px-8 pt-7 pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <i class="fa fa-cogs text-red-400 text-xl"></i>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Configuración del Sistema</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Gestiona los atributos principales, moneda, impuestos y dispositivos.</p>
                    </div>
                </div>
            </div>

            {{-- Layout: sidebar tabs + contenido --}}
            <div class="flex min-h-[400px]">

                {{-- ── SIDEBAR TABS ────────────────────────── --}}
                <div class="w-56 border-r border-slate-100 py-4 flex-shrink-0">
                    <nav class="space-y-1 px-3">

                        <button type="button" onclick="cambiarTab('zona-horaria')"
                                id="tab-btn-zona-horaria"
                                class="config-tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left active-tab">
                            <i class="fa fa-map-marker-alt w-4 text-center"></i>
                            Zona Horaria
                        </button>

                        <button type="button" onclick="cambiarTab('identificacion')"
                                id="tab-btn-identificacion"
                                class="config-tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left inactive-tab">
                            <i class="fa fa-id-card w-4 text-center"></i>
                            Identificación
                        </button>

                        <button type="button" onclick="cambiarTab('impuesto')"
                                id="tab-btn-impuesto"
                                class="config-tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left inactive-tab">
                            <i class="fa fa-dollar-sign w-4 text-center"></i>
                            Impuesto/Moneda
                        </button>

                        <button type="button" onclick="cambiarTab('ordenador')"
                                id="tab-btn-ordenador"
                                class="config-tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left inactive-tab">
                            <i class="fa fa-desktop w-4 text-center"></i>
                            Ordenador (PC)
                        </button>

                        <button type="button" onclick="cambiarTab('impresion')"
                                id="tab-btn-impresion"
                                class="config-tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all text-left inactive-tab">
                            <i class="fa fa-print w-4 text-center"></i>
                            Impresión
                        </button>

                    </nav>
                </div>

                {{-- ── CONTENIDO TABS ──────────────────────── --}}
                <div class="flex-1 px-8 py-6">

                    {{-- TAB 1: ZONA HORARIA --}}
                    <div id="tab-zona-horaria" class="config-tab-content space-y-6">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Configuración Regional
                            </h3>
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
                    <div id="tab-identificacion" class="config-tab-content hidden space-y-6">

                        {{-- Tributaria --}}
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Identificación Tributaria
                            </h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nomenclatura (Ej: RUC, NIT)
                                    </label>
                                    <input type="text"
                                           name="id_tributaria_nombre"
                                           value="{{ $settings['id_tributaria_nombre'] }}"
                                           placeholder="RUC"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300 uppercase">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nº Caracteres
                                    </label>
                                    <input type="number"
                                           name="id_tributaria_caracteres"
                                           value="{{ $settings['id_tributaria_caracteres'] }}"
                                           placeholder="11"
                                           min="1" max="30"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                        {{-- Personal --}}
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Documento de Identidad Personal
                            </h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nomenclatura (Ej: DNI, CI)
                                    </label>
                                    <input type="text"
                                           name="id_personal_nombre"
                                           value="{{ $settings['id_personal_nombre'] }}"
                                           placeholder="DNI"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300 uppercase">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nº Caracteres
                                    </label>
                                    <input type="number"
                                           name="id_personal_caracteres"
                                           value="{{ $settings['id_personal_caracteres'] }}"
                                           placeholder="8"
                                           min="1" max="20"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TAB 3: IMPUESTO / MONEDA --}}
                    <div id="tab-impuesto" class="config-tab-content hidden space-y-6">

                        {{-- Impuesto --}}
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Impuestos
                            </h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nombre del Impuesto (Ej: IGV, IVA)
                                    </label>
                                    <input type="text"
                                           name="impuesto_nombre"
                                           value="{{ $settings['impuesto_nombre'] }}"
                                           placeholder="IGV"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300 uppercase">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Valor Porcentual (%)
                                    </label>
                                    <input type="number"
                                           name="impuesto_porcentaje"
                                           value="{{ $settings['impuesto_porcentaje'] }}"
                                           placeholder="18.00"
                                           min="0" max="100" step="0.01"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                        {{-- Moneda --}}
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Moneda Local
                            </h3>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nombre Moneda (Ej: SOLES, PESOS)
                                    </label>
                                    <input type="text"
                                           name="moneda_nombre"
                                           value="{{ $settings['moneda_nombre'] }}"
                                           placeholder="Soles"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Símbolo (Ej: S/, $)
                                    </label>
                                    <input type="text"
                                           name="moneda_simbolo"
                                           value="{{ $settings['moneda_simbolo'] }}"
                                           placeholder="S/"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-700 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TAB 4: ORDENADOR --}}
                    <div id="tab-ordenador" class="config-tab-content hidden space-y-6">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Datos del Equipo (PC Principal)
                            </h3>

                            <div class="flex items-start gap-2.5 bg-yellow-50 border border-yellow-100 rounded-xl px-4 py-3 mb-5">
                                <i class="fa fa-exclamation-triangle text-yellow-500 mt-0.5 text-sm flex-shrink-0"></i>
                                <p class="text-[11px] text-yellow-700 font-medium">
                                    Estos datos identifican la caja principal o servidor local.
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Nombre del Equipo
                                    </label>
                                    <input type="text"
                                           name="pc_nombre"
                                           value="{{ $settings['pc_nombre'] }}"
                                           placeholder="DESKTOP-XXXXXX"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-600 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">
                                        Dirección IP
                                    </label>
                                    <input type="text"
                                           name="pc_ip"
                                           value="{{ $settings['pc_ip'] }}"
                                           placeholder="192.168.1.1"
                                           class="w-full border-b border-slate-200 focus:border-blue-500 outline-none py-2.5 text-sm font-medium text-slate-600 bg-transparent transition-colors placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 5: IMPRESIÓN --}}
                    <div id="tab-impresion" class="config-tab-content hidden space-y-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                                Opciones de Impresión
                            </h3>

                            {{-- Toggle: Comandas --}}
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors mb-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-orange-400 flex items-center justify-center text-white shadow-sm">
                                        <i class="fa fa-receipt"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Comandas de Cocina/Bar</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Envía pedidos automáticamente a las áreas de producción.</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="imp_comandas" id="toggle_comandas"
                                           class="sr-only peer"
                                           {{ $settings['imp_comandas'] === '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>

                            {{-- Toggle: Pre-Cuenta --}}
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors mb-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-purple-500 flex items-center justify-center text-white shadow-sm">
                                        <i class="fa fa-file-invoice"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Pre-Cuenta (Estado de Mesa)</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Impresión física del consumo antes del pago.</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="imp_precuenta" id="toggle_precuenta"
                                           class="sr-only peer"
                                           {{ $settings['imp_precuenta'] === '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>

                            {{-- Toggle: Comprobantes --}}
                            <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-500 flex items-center justify-center text-white shadow-sm">
                                        <i class="fa fa-file-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Comprobantes Electrónicos</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Impresión directa de Boletas y Facturas.</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="imp_comprobantes" id="toggle_comprobantes"
                                           class="sr-only peer"
                                           {{ $settings['imp_comprobantes'] === '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>

                        </div>
                    </div>

                </div>{{-- /contenido --}}
            </div>{{-- /layout --}}

            {{-- ── FOOTER CON BOTONES ──────────────────────── --}}
            <div class="px-8 py-4 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/30">
                <a href="{{ route('admin.AdministracionGeneral.index') }}"
                   class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-500 font-bold text-[11px] uppercase tracking-widest hover:bg-slate-100 transition-all">
                    Cancelar
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 rounded-xl text-white font-bold text-[11px] uppercase tracking-widest shadow-sm transition-all active:scale-95 hover:opacity-90"
                        style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="fa fa-save text-xs"></i>
                    Guardar Cambios
                </button>
            </div>

        </div>{{-- /panel --}}
    </form>

</div>

<style>
    .active-tab {
        background: #2563EB;
        color: white;
    }
    .inactive-tab {
        color: #2563EB;
        background: transparent;
    }
    .inactive-tab:hover {
        background: #EFF6FF;
    }
</style>

@endsection
