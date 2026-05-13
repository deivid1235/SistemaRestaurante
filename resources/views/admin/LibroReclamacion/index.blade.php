@extends('layouts.dashboard')
@section('title', 'Libro de Reclamos')

@section('content')

<div class="group relative overflow-hidden rounded-xl sm:rounded-[2rem] p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default mb-8"
    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
    
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-inner">
                <i class="fa fa-book-open text-4xl animate-pulse"></i>
            </div>
            
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2 py-0.5 bg-white/20 rounded-md text-[9px] font-black uppercase tracking-widest border border-white/10">
                        Atención al Cliente
                    </span>
                </div>
                
                <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                    Libro de Reclamaciones
                </h1>
                
                <p class="text-white font-medium opacity-90 mt-1 flex items-center gap-2 text-xs sm:text-sm">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-ping"></span>
                    <i class="fa fa-layer-group text-[10px]"></i> 
                    Registro y clasificación de incidencias de usuarios
                </p>
            </div>
        </div>

        <a href="{{ route('admin.AdministracionGeneral.index') }}" 
            class="flex items-center justify-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/40 rounded-xl font-bold text-xs uppercase tracking-widest transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit shadow-lg">
            <i class="fa fa-arrow-left"></i>
            Volver al Menú
        </a>
    </div>
</div>

{{-- ── ESTADÍSTICAS LIBRO DE RECLAMOS ── --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    @php
        $totalLibrosReclamaciones = $libroReclamaciones->count();
        $pendientes = $libroReclamaciones->where('estado', 'pendiente')->count();
        $resueltos = $libroReclamaciones->where('estado', 'resuelto')->count();

        $divisor = $totalLibrosReclamaciones > 0 ? $totalLibrosReclamaciones : 1;

        $porcPendiente = round(($pendientes / $divisor) * 100);
        $porcResuelto = round(($resueltos / $divisor) * 100);
    @endphp

    <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
            style="background: linear-gradient(135deg, #64748b 0%, #334155 100%); color: white;">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <div>
            <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalLibrosReclamaciones }}</p>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Registros</p>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-slate-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
    </div>

    <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
        <div class="flex items-center gap-4 mb-3">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white;">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $pendientes }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Por Atender</p>
            </div>
            <span class="ml-auto text-[9px] font-black bg-amber-50 text-amber-600 px-2 py-0.5 rounded-md border border-amber-100">
                {{ $porcPendiente }}%
            </span>
        </div>
        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
            <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                style="width: {{ $porcPendiente }}%; background: linear-gradient(90deg, #F59E0B, #D97706);"></div>
        </div>
    </div>

    <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
        <div class="flex items-center gap-4 mb-3">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                <i class="fas fa-check-double"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $resueltos }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Finalizados</p>
            </div>
            <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                {{ $porcResuelto }}%
            </span>
        </div>
        
        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
            <div class="h-full rounded-full transition-all duration-1000" 
                style="width: {{ $porcResuelto }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
        </div>
    </div>
</div>


{{-- Buscador y Filtros Segmentados --}}
<div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
    <div class="flex-1 relative group">
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
        <input id="buscador" type="text" placeholder="Buscar producto por nombre, categoría o precio..." 
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

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($libroReclamaciones as $reclamo)
        <div class="reclamo-card relative bg-white rounded-3xl p-4 shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-xl hover:scale-[1.01] group mb-4"
            data-estado="activo">        
            <div class="flex flex-col md:flex-row items-center gap-6">
                    
            <div class="relative flex flex-col items-center gap-2 min-w-[120px]">
                <span class="absolute -top-2 -left-2 px-2 py-0.5 bg-[#10b981] text-white text-[8px] font-black uppercase rounded-md shadow-sm z-10">
                    ACTIVO
                </span>
                
                <div class="w-20 h-20 rounded-full bg-slate-50 border-4 border-white shadow-md flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($reclamo->primer_nombre) }}&background=f8fafc&color=cbd5e1" 
                         alt="Avatar" class="w-full h-full object-cover">
                </div>
                
                <div class="px-3 py-0.5 bg-slate-900 text-white text-[9px] font-black rounded-lg">
                    ID: #{{ $reclamo->id }}
                </div>
            </div>

            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8">
                <div>
                    <h3 class="text-lg font-black text-slate-800 uppercase leading-none mb-1">
                        {{ $reclamo->primer_nombre }} {{ $reclamo->primer_apellido }}
                    </h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mb-3">
                        {{ $reclamo->tipo_reclamo }}
                    </p>
                    
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-slate-500">
                            <i class="fa fa-envelope text-[10px] text-sky-500"></i>
                            <span class="text-[11px] font-bold">{{ $reclamo->correo }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-500">
                            <i class="fa fa-briefcase text-[10px] text-sky-500"></i>
                            <span class="text-[10px] font-black uppercase">INCIDENCIA REGISTRADA</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-between items-end md:items-start">
                    <div class="bg-slate-100 px-3 py-1 rounded-lg text-[10px] font-bold text-slate-400 mb-4">
                        {{ $reclamo->created_at->format('d/m/Y') }}
                    </div>

                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="fa fa-shield-alt text-[10px] text-sky-500"></i>
                        <span class="text-[10px] font-black uppercase text-sky-600">ÁREA DE ATENCIÓN</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.LibroReclamacion.show', $reclamo->id) }}" 
                   class="flex items-center gap-2 px-6 py-2.5 bg-[#0096D9] text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-[#007bb1] hover:shadow-lg active:scale-95">
                    <i class="fa fa-edit text-xs"></i>
                    Perfil
                </a>
                
                <button class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 border border-red-100 rounded-xl transition-all hover:bg-red-500 hover:text-white group/del">
                    <i class="fa fa-trash-alt text-xs transition-transform group-hover/del:scale-110"></i>
                </button>
            </div>

        </div>
    </div>
@empty
    <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100 shadow-inner">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa fa-folder-open text-slate-200 text-2xl"></i>
        </div>
        <p class="text-xs font-black text-gray-300 uppercase tracking-widest">
            No hay registros encontrados
        </p>
    </div>
@endforelse

</div>
@endsection