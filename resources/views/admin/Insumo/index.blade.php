@extends('layouts.dashboard')
@section('title', 'Insumos')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner animate-[spin_5s_linear_infinite]">
                        <i class="fa fa-boxes text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Insumos 
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Administre el inventario y stock de insumos
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.Insumo.create') }}"
                class="flex-1 md:flex-none text-white px-8 py-3 rounded-full font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-lg active:scale-95 border border-white/20 hover:brightness-110" 
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Nuevo Insumo 
                </a>

                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-md border border-white/30 rounded-full font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                    <i class="fa fa-arrow-left text-xs"></i> Volver
                </a>
            </div>

        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $totalIns = $insumos->count();
            // Contamos 'a' para activos (Disponibles) e 'i' para inactivos (Agotados) según tu formulario anterior
            $activos = $insumos->where('estado', 'a')->count();
            $inactivos = $insumos->where('estado', 'i')->count();
            
            $divisor = $totalIns > 0 ? $totalIns : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%); color: white;">
                <i class="fas fa-box"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalIns }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Insumos</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Disponibles</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                    {{ $porcActivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivo }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
        </div>

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Agotados</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 transition-colors group-hover:bg-red-500 group-hover:text-white">
                    {{ $porcInactivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivo }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
        </div>
    </div>

    {{-- Buscador y Filtros Segmentados para Insumo--}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar insumo por nombre..." 
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($insumos as $ins)
        <div class="insumo group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col"
            data-estado="{{ $ins->estado }}"
            data-nombre="{{ strtolower($ins->nombre ?? '') }}"
            data-categoria="{{ $ins->insumo_catg_id }}">
            
            <div class="relative h-40 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $ins->estado == 'a' ? '#10b981' : '#ef4444' }} 0%, {{ $ins->estado == 'a' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $ins->estado == 'a' ? 'Disponible' : 'Agotado' }}
                    </span>
                </div>

                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
                    <div class="w-20 h-20 rounded-2xl bg-slate-200/50 flex items-center justify-center text-slate-400 text-3xl shadow-inner transition-all duration-500 group-hover:scale-110 group-hover:bg-amber-50 group-hover:text-amber-500">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>

                <div class="absolute bottom-3 left-3">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg border border-white/20">
                        {{ $ins->codigo ?? 'SIN CÓDIGO' }}
                    </span>
                </div>
            </div>

            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate tracking-tight">
                        {{ $ins->nombre }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                        <i class="fas fa-tags mr-1 text-blue-400/60"></i> 
                        {{ $ins->categoria->descripcion ?? 'Sin Categoría' }}
                    </p>
                </div>
                
                <div class="grid grid-cols-1 gap-2 mb-4 bg-slate-50 p-2 rounded-xl border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-cubes text-[10px] text-slate-400"></i>
                            <span class="text-[9px] font-bold text-slate-600 uppercase">Stock actual:</span>
                        </div>
                        <span class="text-[10px] font-black {{ $ins->stock > 0 ? 'text-slate-800' : 'text-red-500' }}">
                            {{ number_format($ins->stock, 2) }} {{ $ins->tipoMedida->descripcion ?? '' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-slate-200/60 pt-1.5 text-blue-600">
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-dollar-sign text-[10px]"></i>
                            <span class="text-[9px] font-bold uppercase tracking-tighter">Costo Unitario:</span>
                        </div>
                        <span class="text-[10px] font-black">
                            S/. {{ number_format($ins->costo, 2) }}
                        </span>
                    </div>
                </div>

                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.Insumo.edit', $ins->id) }}"
                    class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </a>
                    <button class="btnEliminarInsumo w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50"
                        data-id="{{ $ins->id }}" 
                        data-nombre="{{ $ins->nombre }}">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{--Modal de elimiar--}}
    <div id="modalEliminarInsumo" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
        <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                <i class="fa fa-trash"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">¿Eliminar Insumo?</h3>
            <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">Esta acción eliminará <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
            <form id="formEliminarInsumo" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('modalEliminarInsumo').classList.add('hidden')" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection