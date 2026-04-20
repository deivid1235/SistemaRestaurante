@extends('layouts.dashboard')
@section('title', 'Libro de Reclamos')

@section('content')

<div class="relative overflow-hidden rounded-[2rem] p-8 text-white shadow-lg mb-8 animate-fade-in-down"
    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-inner animate-pulse">
                <i class="fa fa-book-open text-2xl"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-white/20 rounded-md text-[9px] font-black uppercase tracking-widest border border-white/10">Configuración</span>
                </div>
                <h1 class="text-3xl font-black tracking-tight">Libro de Reclamos</h1>
                <p class="text-xs font-bold text-blue-50 opacity-80 flex items-center gap-2">
                    <i class="fa fa-layer-group"></i> Registro y clasificación de incidencias de usuarios
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-[1.8rem] shadow-sm border border-gray-100 flex items-center gap-4 hover:scale-105 transition-transform duration-300">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
            <i class="fa fa-list-check text-lg"></i>
        </div>
        <div>
            <div class="text-2xl font-black text-gray-800">{{ $libroReclamaciones->count() }}</div>
            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Registros</div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-[1.8rem] shadow-sm border border-gray-100 flex items-center justify-between hover:scale-105 transition-transform duration-300">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-500 flex items-center justify-center">
                <i class="fa fa-check-circle text-lg"></i>
            </div>
            <div>
                <div class="text-2xl font-black text-gray-800">{{ $libroReclamaciones->where('tipo_reclamo', 'Queja')->count() }}</div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Quejas</div>
            </div>
        </div>
        <span class="text-[10px] font-black text-green-500 bg-green-50 px-2 py-1 rounded-lg">100%</span>
    </div>

    <div class="bg-white p-6 rounded-[1.8rem] shadow-sm border border-gray-100 flex items-center justify-between hover:scale-105 transition-transform duration-300">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                <i class="fa fa-circle-xmark text-lg"></i>
            </div>
            <div>
                <div class="text-2xl font-black text-gray-800">{{ $libroReclamaciones->where('tipo_reclamo', 'Reclamo')->count() }}</div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Reclamos</div>
            </div>
        </div>
        <span class="text-[10px] font-black text-red-500 bg-red-50 px-2 py-1 rounded-lg">0%</span>
    </div>
</div>

<div class="flex flex-col md:flex-row gap-4 mb-8 items-center">
    <div class="relative flex-1 w-full flex gap-2">
        <div class="relative flex-1">
            <i class="fa fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-300"></i>
            <input type="text" placeholder="Buscar por nombre o descripción..." 
                class="w-full pl-12 pr-6 py-3 bg-white border border-gray-100 rounded-2xl text-sm font-medium text-gray-500 shadow-sm focus:ring-2 focus:ring-blue-500/10 transition-all outline-none">
        </div>
        
        <button class="text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-md transition-all flex items-center gap-2 border-none outline-none"
                style="background: linear-gradient(135deg, var(--primary), var(--primary));"
                onmouseover="this.style.opacity='0.9'"
                onmouseout="this.style.opacity='1'">
            <i class="fa fa-magnifying-glass"></i> 
            <span class="hidden md:inline">Buscar</span>
        </button>
    </div>
    
    <div class="flex items-center gap-2 p-1 bg-white border border-gray-50 rounded-2xl shadow-sm w-full md:w-auto">
        <button class="px-6 py-3 text-white text-[11px] font-black uppercase rounded-xl shadow-md transition-all"
                style="background: linear-gradient(135deg, var(--primary) ">
            Todos
        </button>

        <button class="px-6 py-3 text-gray-400 text-[11px] font-black uppercase rounded-xl transition-all group"
                onmouseover="this.style.background='linear-gradient(135deg, var(--primary) '; this.style.color='white'"
                onmouseout="this.style.background='transparent'; this.style.color='#9ca3af'">
            Quejas
        </button>

        <button class="px-6 py-3 text-gray-400 text-[11px] font-black uppercase rounded-xl transition-all group"
                onmouseover="this.style.background='linear-gradient(135deg, var(--primary) '; this.style.color='white'"
                onmouseout="this.style.background='transparent'; this.style.color='#9ca3af'">
            Reclamos
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($libroReclamaciones as $reclamo)

<div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col h-full 
            hover:border-[var(--primary)] transition-colors duration-200">

    <div class="flex justify-between items-start mb-6">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center" 
             style="color: var(--primary);">
            <i class="fa fa-envelope-open-text text-lg"></i>
        </div>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-500 text-[10px] font-black uppercase rounded-full border border-green-100">
            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Activo
        </span>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-black text-gray-800 tracking-tight leading-tight mb-1">
            {{ $reclamo->primer_nombre }} {{ $reclamo->primer_apellido }}
        </h3>
        <p class="text-xs font-bold text-gray-400 leading-relaxed truncate">
            {{ $reclamo->tipo_reclamo }}: {{ $reclamo->correo }}
        </p>
    </div>

    <div class="pt-6 border-t border-gray-50 flex items-center justify-between mb-6">
        <div class="flex items-center gap-2 text-gray-400">
            <i class="fa fa-calendar-alt text-xs"></i>
            <span class="text-[11px] font-bold">{{ $reclamo->created_at->format('d/m/Y') }}</span>
        </div>
    </div>

    <a href="{{ route('admin.LibroReclamacion.show', $reclamo->id) }}">
        <div class="grid grid-cols-4 gap-2">
            <button class="col-span-3 py-3 px-4 bg-white border border-gray-100 rounded-xl font-black text-[11px] text-gray-700 
                        transition-all duration-300 flex items-center justify-center gap-2 group/btn shadow-sm
                        hover:text-white hover:border-transparent"
                    onmouseover="this.style.background='linear-gradient(135deg, var(--primary)'"
                    onmouseout="this.style.background='white'">
                
                <i class="fa fa-edit transition-colors duration-200 group-hover/btn:text-white" 
                style="color: var(--primary);"></i>
                
                <span class="group-hover/btn:text-white">Detalles</span>
            </button>

            <button class="col-span-1 py-3 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-red-500 
                        hover:!bg-red-500 hover:!text-white hover:border-red-500 transition-colors duration-200 shadow-sm group/off">
                <i class="fa fa-power-off group-hover/off:text-white"></i>
            </button>
        </div>
    </a>
</div>
@empty

<div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100">
    <p class="text-xs font-black text-gray-300 uppercase tracking-widest">
        No hay registros encontrados
    </p>
</div>

@endforelse

</div>
@endsection