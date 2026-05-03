@extends('layouts.dashboard')

@section('title', 'Áreas de Producción')

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
                        <i class="fa fa-utensils text-3xl"></i>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Áreas de Producción
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione los destinos de comanda (Cocina, Barra, etc.)
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
         TARJETAS ESTADÍSTICAS
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @php
            $divisor     = $total > 0 ? $total : 1;
            $porcActivo  = round(($activos  / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        {{-- Total --}}
        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center transition-colors duration-300 group-hover:bg-[#00B5E2]">
                <i class="fa fa-utensils text-[#00B5E2] text-xl transition-colors duration-300 group-hover:text-white"></i>
            </div>
            <div class="text-center">
                <p class="text-2xl font-black text-gray-800 leading-none">{{ $total }}</p>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Total Áreas</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        {{-- Activos --}}
        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-500 transition-colors duration-300 group-hover:bg-green-500 group-hover:text-white">
                    <i class="fa fa-check-circle text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-black text-gray-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Habilitadas</p>
                </div>
                <span class="ml-auto text-[10px] font-bold bg-green-50 text-green-600 px-2 py-0.5 rounded border border-green-100">{{ $porcActivo }}%</span>
            </div>
            <div class="w-full bg-gray-100 h-1 rounded-full overflow-hidden">
                <div class="bg-green-500 h-full transition-all duration-1000" style="width: {{ $porcActivo }}%"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-green-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>

        {{-- Inactivos --}}
        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center text-red-500 transition-colors duration-300 group-hover:bg-red-500 group-hover:text-white">
                    <i class="fa fa-times-circle text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-black text-gray-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Inhabilitadas</p>
                </div>
                <span class="ml-auto text-[10px] font-bold bg-red-50 text-red-600 px-2 py-0.5 rounded border border-red-100">{{ $porcInactivo }}%</span>
            </div>
            <div class="w-full bg-gray-100 h-1 rounded-full overflow-hidden">
                <div class="bg-red-500 h-full transition-all duration-1000" style="width: {{ $porcInactivo }}%"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         TABLA + PANEL INFO
    ══════════════════════════════════════════ --}}
    <div class="flex flex-col lg:flex-row gap-4">

        {{-- TABLA PRINCIPAL --}}
        <div class="flex-1 bg-white rounded-[1.5rem] shadow-sm border border-slate-100 overflow-hidden">

            {{-- Cabecera tabla --}}
            <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                         style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-utensils text-white text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800 leading-none">Áreas de Producción</h2>
                        <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-1">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-500 mr-1"></span>
                            Destinos de comanda
                        </p>
                    </div>
                </div>

                <button onclick="abrirModalCrearArea()"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-sm"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus text-[9px]"></i>
                    NUEVA ÁREA
                </button>
            </div>

            {{-- Buscador --}}
            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm ml-auto">
                    <input type="text" id="buscadorArea" placeholder="Buscar área..."
                           class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto px-6 pb-4">
                <table class="w-full">
                    <thead>
                        <tr class="text-slate-400 text-[9px] uppercase font-black tracking-widest border-b border-slate-50">
                            <th class="px-4 py-3 text-left font-black">Nombre Área</th>
                            <th class="px-4 py-3 text-left font-black">Impresora Asignada</th>
                            <th class="px-4 py-3 text-center font-black">Estado</th>
                            <th class="px-4 py-3 text-right font-black">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAreas" class="text-xs">
                        @forelse($areas as $area)
                        <tr class="group border-b border-slate-50/50 hover:bg-slate-50/50 transition-colors">

                            {{-- Nombre --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 font-bold text-[10px]">
                                        {{ substr($area->nombre, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-700 uppercase tracking-tight">{{ $area->nombre }}</span>
                                </div>
                            </td>

                            {{-- Impresora --}}
                            <td class="px-4 py-3">
                                @if($area->impresora)
                                    <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-blue-100">
                                        <i class="fa fa-print text-[8px]"></i>
                                        {{ $area->impresora->nombre }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-400 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-slate-200">
                                        <i class="fa fa-ban text-[8px]"></i>
                                        NINGUNO
                                    </span>
                                @endif
                            </td>

                            {{-- Estado --}}
                            <td class="px-4 py-3 text-center">
                                @if($area->estado === 'activo')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-emerald-100">
                                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-slate-200">
                                        <span class="w-1 h-1 rounded-full bg-slate-400"></span>
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            {{-- Acciones --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="abrirModalEditarArea(
                                                {{ $area->id }},
                                                '{{ $area->nombre }}',
                                                '{{ $area->inpresora_id ?? '' }}',
                                                '{{ $area->estado }}'
                                            )"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                        <i class="fa fa-edit text-[10px]"></i>
                                    </button>

                                    <button onclick="abrirModalEliminarArea({{ $area->id }}, '{{ $area->nombre }}')"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                        <i class="fa fa-trash text-[10px]"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-300 font-bold uppercase text-[10px] tracking-widest">
                                No se encontraron áreas de producción
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-3 bg-slate-50/30 border-t border-slate-50 flex items-center justify-between">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                    Total: <span class="text-slate-700">{{ $areas->total() }}</span> registros
                </p>
                <div class="pagination-compact">
                    {{ $areas->links() }}
                </div>
            </div>
        </div>

        {{-- PANEL INFORMACIÓN --}}
        <div class="lg:w-72 rounded-[1.5rem] p-6 text-white shadow-sm self-start border border-white/10"
             style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">

            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center shadow-sm">
                    <i class="fa fa-lightbulb text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-tight leading-none">Información</h3>
                    <p class="text-[8px] uppercase tracking-widest text-white/70 font-bold mt-1">Ayuda rápida</p>
                </div>
            </div>

            <p class="text-white/80 text-[11px] leading-relaxed mb-5 border-b border-white/10 pb-5 font-medium">
                Las áreas de producción definen a dónde se envían los
                <strong class="text-white">pedidos para ser preparados.</strong>
            </p>

            <p class="font-black text-[9px] uppercase tracking-widest text-white/60 mb-4">Configuración:</p>

            <ul class="space-y-3">
                <li class="flex items-start gap-2.5">
                    <div class="mt-1 w-3.5 h-3.5 rounded bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-chevron-right text-[7px] text-white"></i>
                    </div>
                    <span class="text-white/90 text-[10.5px] leading-tight">
                        <strong class="text-white">Asignación:</strong> Debe seleccionar la impresora física
                        (configurada previamente en Sistema &rsaquo; Impresoras) que imprimirá los tickets de esta área.
                    </span>
                </li>
                <li class="flex items-start gap-2.5">
                    <div class="mt-1 w-3.5 h-3.5 rounded bg-yellow-400/40 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-exclamation text-[7px] text-yellow-200"></i>
                    </div>
                    <span class="text-white/90 text-[10.5px] leading-tight">
                        Si selecciona <strong class="text-white">'NINGUNO'</strong>, los pedidos llegarán al sistema
                        (KDS) pero no se imprimirá ticket físico.
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     MODAL CREAR
══════════════════════════════════════════════════════════════ --}}
<div id="modalCrearArea" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[400px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">

        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-utensils text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nueva Área</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Destino de Comanda</p>
                </div>
            </div>
            <button onclick="cerrarModalCrearArea()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form action="{{ route('admin.AreaProduccion.store') }}" method="POST" class="p-6 pt-4 space-y-5">
            @csrf

            {{-- Nombre --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre del Área
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" required placeholder="EJ: COCINA FRÍA"
                           class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            {{-- Impresora --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-print text-blue-400 text-[7px]"></i> Impresora de Comanda
                </label>
                <div class="relative group">
                    <select name="inpresora_id"
                            class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="">NINGUNO</option>
                        @foreach($impresoras as $imp)
                            <option value="{{ $imp->id }}">{{ strtoupper($imp->nombre) }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Estado --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado
                </label>
                <div class="relative group">
                    <select name="estado"
                            class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalCrearArea()"
                        class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                <button type="submit"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-save text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     MODAL EDITAR
══════════════════════════════════════════════════════════════ --}}
<div id="modalEditarArea" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[400px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">

        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-edit text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Editar Área</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Modificar Destino de Comanda</p>
                </div>
            </div>
            <button onclick="cerrarModalEditarArea()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form id="formEditarArea" action="" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre del Área
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" id="editArea_nombre" required
                           class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            {{-- Impresora --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-print text-blue-400 text-[7px]"></i> Impresora de Comanda
                </label>
                <div class="relative group">
                    <select name="inpresora_id" id="editArea_inpresora"
                            class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="">NINGUNO</option>
                        @foreach($impresoras as $imp)
                            <option value="{{ $imp->id }}">{{ strtoupper($imp->nombre) }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Estado --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado
                </label>
                <div class="relative group">
                    <select name="estado" id="editArea_estado"
                            class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalEditarArea()"
                        class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                <button type="submit"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-sync-alt text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Actualizar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     MODAL ELIMINAR
══════════════════════════════════════════════════════════════ --}}
<div id="modalEliminarArea" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[360px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20">

        <div class="p-6 flex flex-col items-center text-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center">
                <i class="fa fa-trash text-red-500 text-2xl"></i>
            </div>
            <div>
                <h3 class="text-[#1E293B] font-bold text-lg tracking-tight">¿Eliminar área?</h3>
                <p class="text-slate-400 text-xs mt-1">
                    Esta acción no se puede deshacer. Se eliminará el área
                    <strong id="deleteArea_nombre" class="text-slate-700"></strong>.
                </p>
            </div>
        </div>

        <form id="formEliminarArea" action="" method="POST" class="px-6 pb-6 flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="cerrarModalEliminarArea()"
                    class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-500 font-bold text-[11px] uppercase tracking-widest hover:bg-slate-50 transition-all">
                Cancelar
            </button>
            <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-red-500 text-white font-bold text-[11px] uppercase tracking-widest hover:bg-red-600 active:scale-95 transition-all shadow-lg shadow-red-100">
                Sí, eliminar
            </button>
        </form>
    </div>
</div>

@endsection
