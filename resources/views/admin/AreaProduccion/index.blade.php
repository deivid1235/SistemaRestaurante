@extends('layouts.dashboard')

@section('title', 'Áreas de Producción')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_8s_linear_infinite]"></div>
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

            <div class="flex flex-wrap items-center gap-3">
                <button onclick="abrirModalCrearArea()" 
                    class="flex items-center gap-3 px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/20 text-white border border-white/10"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center shadow-inner">
                        <i class="fa fa-plus text-sm text-white"></i>
                    </div>

                    <span>Nueva Área</span>
                </button>

                <a href="{{ route('admin.AdministracionGeneral.index') }}"
                    class="flex items-center justify-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl font-bold text-xs uppercase tracking-widest transition-all hover:bg-white/20 active:scale-95">
                    <i class="fa fa-arrow-left text-xs"></i> 
                    Volver
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
        <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-black/10 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @php
            $divisorArea    = $total > 0 ? $total : 1;
            $porcActivoArea = round(($activos / $divisorArea) * 100);
            $porcInactivoArea = round(($inactivos / $divisorArea) * 100);
        @endphp

        {{-- Total Áreas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #00B5E2 0%, #0082a3 100%); color: white;">
                <i class="fa fa-utensils"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $total }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Áreas</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        {{-- Áreas Activas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Áreas Habilitadas</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                    {{ $porcActivoArea }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivoArea }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
        </div>

        {{-- Áreas Inactivas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Áreas Inactivas</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 transition-colors group-hover:bg-red-500 group-hover:text-white">
                    {{ $porcInactivoArea }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivoArea }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
        </div>
    </div>

    {{-- Buscador y Filtros Segmentados para AreaProducion --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar Area de Producuccion por nombre..." 
                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-50 outline-none transition-all shadow-sm">
        </div>

        <div class="w-full md:w-auto md:min-w-[350px]">
            <div class="flex bg-white p-1 rounded-2xl border border-slate-100 shadow-sm">
                <button id="btnTodos" class="flex-1 py-2.5 text-white rounded-xl text-[11px] font-black uppercase tracking-wider transition-all shadow-md shadow-blue-200"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    Todos
                </button>
                <button id="btnActivos" class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Activos
                </button>
                <button id="btnInactivos" class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Inactivos
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
        @foreach($areas as $area)
        <div class="area-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full"
            data-estado="{{ $area->estado }}"
            data-nombre="{{ strtolower($area->nombre ?? '') }}">
            
            <div class="relative h-40 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $area->estado == 'activo' ? '#10b981' : '#ef4444' }} 0%, {{ $area->estado == 'activo' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $area->estado }}
                    </span>
                </div>

                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
                    <div class="relative">
                        <i class="fa fa-utensils text-slate-200 text-7xl transition-all duration-500 group-hover:scale-110 group-hover:text-[#00B5E2]/20"></i>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-4xl font-black text-slate-300 group-hover:text-[#00B5E2] transition-colors uppercase">
                                {{ substr($area->nombre, 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ID Badge --}}
                <div class="absolute bottom-3 left-3">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg border border-white/20">
                        ID: #{{ $area->id }}
                    </span>
                </div>
            </div>

            {{-- Contenido de la Card --}}
            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate tracking-tight">
                        {{ $area->nombre }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                        <i class="fas fa-map-marker-alt mr-1 text-blue-400/60"></i> Destino de Comanda
                    </p>
                </div>
                
                {{-- Información de Impresora Asignada --}}
                <div class="grid grid-cols-1 gap-2 mb-4 bg-slate-50 p-2 rounded-xl border border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-print text-[10px] {{ $area->impresora ? 'text-blue-500' : 'text-slate-400' }}"></i>
                        <span class="text-[9px] font-bold text-slate-600 uppercase truncate">
                            {{ $area->impresora ? $area->impresora->nombre : 'Sin Impresora' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 {{ $area->impresora ? 'text-emerald-500' : 'text-amber-500' }}">
                        <i class="fas fa-info-circle text-[10px]"></i>
                        <span class="text-[9px] font-bold uppercase tracking-tighter">
                            {{ $area->impresora ? 'Vinculación Activa' : 'Solo Digital (KDS)' }}
                        </span>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="flex gap-2 mt-auto">
                    <button onclick="abrirModalEditarArea({{ $area->id }}, '{{ $area->nombre }}', '{{ $area->impresora_id }}', '{{ $area->estado }}')"
                        class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </button>

                    <button onclick="abrirModalEliminarArea({{ $area->id }}, '{{ $area->nombre }}')"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

{{-- Modal Crear/Editar Área de Producción --}}
<div id="modalCrearArea" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[400px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">

        {{-- Cabecera del Modal --}}
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-utensils text-white text-lg"></i>
                </div>
                <div>
                    <h3 id="modalAreaTitle" class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nueva Área</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Destino de Comanda</p>
                </div>
            </div>
            <button type="button" onclick="cerrarModalCrearArea()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form action="{{ route('admin.AreaProduccion.store') }}" method="POST" id="formArea" class="p-6 pt-4 space-y-5">
            @csrf
            <div id="methodArea"></div>

            {{-- Input: Nombre del Área --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre del Área
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" id="area_nombre" required placeholder="EJ: COCINA CALIENTE"
                           class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            {{-- Select: Impresora de Comanda --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-print text-blue-400 text-[7px]"></i> Impresora Asignada
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-desktop text-xs"></i>
                    </div>
                    <select name="inpresora_id" id="area_impresora_id"
                            class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="">NINGUNA (SOLO DIGITAL)</option>
                        @foreach($impresoras as $imp)
                            <option value="{{ $imp->id }}">{{ strtoupper($imp->nombre) }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Select: Estado --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado Operativo
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-shield-halved text-xs"></i>
                    </div>
                    <select name="estado" id="area_estado"
                            class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalCrearArea()"
                        class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                <button type="submit"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-save text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Área</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Editar Área de Producción --}}
<div id="modalEditarArea" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[400px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">

        {{-- Cabecera del Modal --}}
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-edit text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Editar Área</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Modificar Destino de Comanda</p>
                </div>
            </div>
            <button type="button" onclick="cerrarModalEditarArea()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form id="formEditarArea" action="" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            @method('PUT')

            {{-- Input: Nombre del Área --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre del Área
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" id="editArea_nombre" required placeholder="EJ: BARRA PRINCIPAL"
                           class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            {{-- Select: Impresora de Comanda --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-print text-blue-400 text-[7px]"></i> Impresora Asignada
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-desktop text-xs"></i>
                    </div>
                    <select name="inpresora_id" id="editArea_inpresora"
                            class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="">NINGUNA (SOLO DIGITAL)</option>
                        @foreach($impresoras as $imp)
                            <option value="{{ $imp->id }}">{{ strtoupper($imp->nombre) }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Select: Estado --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado Operativo
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-shield-halved text-xs"></i>
                    </div>
                    <select name="estado" id="editArea_estado"
                            class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalEditarArea()"
                        class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                <button type="submit"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-sync-alt text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Actualizar Área</span>
                </button>
            </div>
        </form>
    </div>
</div>

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
