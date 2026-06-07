@extends('layouts.dashboard')
@section('title', 'Productos')

@section('content')
<div class="relative space-y-6 px-2 md:px-6">
    {{-- Header Principal --}}
    <div class="group relative overflow-hidden rounded-3xl p-8 text-white shadow-lg transition-all duration-500 mb-8"
        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/30 scale-125 animate-[spin_6s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                        <i class="fas fa-hamburger text-3xl animate-[pulse_2s_infinite]"></i>
                    </div>
                </div>

                <div>
                    <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20 inline-flex items-center">
                        <i class="fas fa-box mr-1.5"></i> Gestión de Inventario
                    </span>
                    <h1 class="text-3xl font-black mt-2 tracking-tight">Catálogo de Productos</h1>
                    <p class="text-white/80 text-sm font-medium mt-1">
                        Gestiona los platos, bebidas y productos de tu menú.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-wrap items-center justify-center lg:justify-end gap-4">
                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="group/btn flex items-center justify-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl font-bold text-sm transition-all hover:bg-white/20 hover:border-white/40 active:scale-95 shadow-sm">
                    <i class="fa fa-arrow-left text-xs transition-transform group-hover/btn:-translate-x-1"></i> 
                    Volver al Menú
                </a>

                <a href="{{ route('admin.producto.create') }}" 
                class="flex items-center justify-center gap-3 px-8 py-3 bg-white text-[#0096D9] rounded-2xl font-extrabold text-sm shadow-xl hover:shadow-2xl hover:scale-105 transition-all active:scale-95">
                    <i class="fas fa-plus animate-bounce"></i> 
                    Nuevo Producto
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-black/5 rounded-full blur-2xl"></div>
    </div>

    {{-- Tarjetas de Estadísticas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $total = $productos->count();
            $activos = $productos->where('estado', 'a')->count();
            $inactivos = $productos->where('estado', 'i')->count();

            $divisor = $total > 0 ? $total : 1;
            $porcActivos = round(($activos / $divisor) * 100);
            $porcInactivos = round(($inactivos / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%); color: white;">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $total }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Productos</p>
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
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Habilitados</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                    {{ $porcActivos }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivos }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
        </div>

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Inactivos</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 transition-colors group-hover:bg-red-500 group-hover:text-white">
                    {{ $porcInactivos }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivos }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($productos as $prod)
        <div class="producto group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col"
            data-estado="{{ $prod->estado }}"
            data-nombre="{{ strtolower($prod->nombre ?? '') }}">
            
            {{-- CABECERA DE IMAGEN --}}
            <div class="relative h-44 overflow-hidden bg-slate-100">
                <div class="absolute top-3 left-3 right-3 z-10 flex justify-between items-center">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $prod->estado == 'a' ? '#10b981' : '#ef4444' }} 0%, {{ $prod->estado == 'a' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $prod->estado == 'a' ? 'Activo' : 'Inactivo' }}
                    </span>
                    <span class="bg-black/40 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg">
                        Orden: {{ $prod->orden }}
                    </span>
                </div>

                @php $tieneImagen = !empty($prod->imagen); @endphp
                @if($tieneImagen)
                    <img src="{{ asset('storage/'.$prod->imagen) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50">
                        <i class="fas fa-box-open text-slate-200 text-3xl"></i>
                    </div>
                @endif
            </div>

            <div class="p-4 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate flex-1 tracking-tight">
                        {{ $prod->nombre }}
                    </h3>
                    <span class="text-[9px] font-mono font-bold text-slate-400 ml-2 bg-slate-50 px-1.5 py-0.5 rounded">ID: {{ $prod->id }}</span>
                </div>
                
                <div class="flex flex-wrap gap-2 mb-3">
                    <p class="text-[9px] text-slate-500 font-bold uppercase">
                        <i class="fas fa-tag mr-1" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i> 
                        Cat: {{ $prod->categoria->descripcion ?? 'Sin categoría' }}
                    </p>
                    <p class="text-[9px] text-slate-500 font-bold uppercase">
                        <i class="fas fa-industry mr-1" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i> 
                        Área: {{ $prod->areaProduccion->nombre ?? 'Sin área' }}
                    </p>
                </div>
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.producto.edit', $prod->id) }}" 
                    class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </a>
                    <a href="{{ route('admin.producto_temp.form', $prod->id) }}"
                        class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl"
                        style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                        
                        <i class="fas fa-box-open text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">
                            Presentación
                        </span>
                    </a>

                    
                    <button type="button"
                        onclick="abrirEliminarProducto('{{ $prod->id }}', '{{ addslashes($prod->nombre) }}')"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Eliminar --}}
<div id="modalEliminar"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">

    <div class="bg-white rounded-2xl w-full max-w-sm shadow-2xl p-8 text-center">

        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>

        <h3 class="text-lg font-bold text-gray-800">
            ¿Eliminar Producto?
        </h3>

        <p class="text-gray-500 mt-2 mb-6 text-xs">
            Estás a punto de eliminar:
            <span id="delete_nombre" class="font-bold text-red-600"></span>
        </p>

        <form id="formEliminarProducto" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex gap-3">

                <!-- CANCELAR -->
                <button type="button"
                    onclick="cerrarEliminarProducto()"
                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs">
                    Cancelar
                </button>

                <!-- ELIMINAR -->
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 text-xs">
                    Sí, eliminar
                </button>

            </div>
        </form>

    </div>
</div>



@endsection