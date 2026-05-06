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

                <a href="{{ route('admin.Producto.create') }}" 
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @php
            $total = $productos->count();
            $activos = $productos->where('estado', 'a')->count();
            $inactivos = $productos->where('estado', 'i')->count();
            $delivery = $productos->where('delivery', 1)->count();

            $divisor = $total > 0 ? $total : 1;
            $porcActivos = round(($activos / $divisor) * 100);
            $porcInactivos = round(($inactivos / $divisor) * 100);
            $porcDelivery = round(($delivery / $divisor) * 100);
        @endphp

        <!-- Total -->
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

        <!-- Habilitados -->
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

        <!-- Inactivos -->
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

        <!-- Delivery -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white;">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $delivery }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">En Delivery</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-amber-50 text-amber-600 px-2 py-0.5 rounded-md border border-amber-100 transition-colors group-hover:bg-amber-500 group-hover:text-white">
                    {{ $porcDelivery }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcDelivery }}%; background: linear-gradient(90deg, #F59E0B, #D97706);"></div>
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
            
            <div class="relative h-44 overflow-hidden bg-slate-100">
                <div class="absolute top-3 left-3 right-3 z-10 flex justify-between items-center">
                    @if($prod->destacado)
                        <span class="bg-amber-400 text-white p-1.5 rounded-lg shadow-lg animate-pulse" title="Producto Destacado">
                            <i class="fas fa-star text-[10px]"></i>
                        </span>
                    @else
                        <div></div>
                    @endif
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $prod->estado == 'a' ? '#10b981' : '#ef4444' }} 0%, {{ $prod->estado == 'a' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $prod->estado == 'a' ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                @if($prod->imagen && $prod->imagen != 'NULL')
                    <img src="{{ asset('storage/'.$prod->imagen) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50">
                        <i class="fas fa-utensils text-slate-200 text-3xl"></i>
                    </div>
                @endif

                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-4 backdrop-blur-[2px]">
                    @if($prod->codigo_qr)
                        <div class="bg-white p-1 rounded-lg shadow-xl translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <i class="fas fa-qrcode text-slate-800 text-xl"></i>
                        </div>
                    @endif
                    @if($prod->codigo_barra)
                        <div class="bg-white p-1 rounded-lg shadow-xl translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75 text-[10px] font-bold px-2">
                            <i class="fas fa-barcode mr-1"></i> {{ $prod->codigo_barra }}
                        </div>
                    @endif
                </div>

                {{-- Precio y Stock --}}
                <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                    <span class="bg-black/60 backdrop-blur-md text-white text-xs font-black px-2 py-1 rounded-lg border border-white/20">
                        S/ {{ number_format($prod->precio, 2) }}
                    </span>
                    <span class="{{ $prod->stock <= $prod->stock_minimo ? 'bg-red-500' : 'bg-blue-600' }} text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-lg border border-white/20">
                        Stock: {{ $prod->stock }}
                    </span>
                </div>
            </div>

            <!-- Información del Producto -->
            <div class="p-4 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-1">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate flex-1 tracking-tight">
                        {{ $prod->nombre }}
                    </h3>
                    <span class="text-[9px] font-mono font-bold text-slate-400 ml-2 bg-slate-50 px-1.5 py-0.5 rounded">#{{ $prod->id }}</span>
                </div>
                
                <div class="flex flex-wrap gap-x-3 gap-y-1 mb-3">
                    <p class="text-[9px] text-slate-400 font-bold uppercase">
                        <i class="fas fa-tag mr-1 text-blue-400/60"></i> {{ $prod->categoria->descripcion ?? 'Sin Cat.' }}
                    </p>
                    <p class="text-[9px] text-emerald-500 font-bold uppercase">
                        <i class="fas fa-wallet mr-1 text-emerald-400/60"></i> Costo: S/{{ number_format($prod->costo, 2) }}
                    </p>
                </div>

                {{-- Detalles Técnicos --}}
                <div class="grid grid-cols-2 gap-2 mb-4 bg-slate-50 p-2 rounded-xl border border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-clock text-[10px] text-slate-400"></i>
                        <span class="text-[9px] font-bold text-slate-600">{{ $prod->tiempo_preparacion }} min</span>
                    </div>
                    <div class="flex items-center gap-1.5 {{ $prod->delivery ? 'text-orange-500' : 'text-slate-400' }}">
                        <i class="fas fa-motorcycle text-[10px]"></i>
                        <span class="text-[9px] font-black uppercase tracking-tighter">{{ $prod->delivery ? 'Si' : 'No' }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-500">
                        <i class="fas fa-sort-numeric-down text-[10px]"></i>
                        <span class="text-[9px] font-bold uppercase">Ord: {{ $prod->orden }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-blue-500">
                        <i class="fas fa-fire text-[10px]"></i>
                        <span class="text-[9px] font-bold uppercase truncate">{{ $prod->preparacion }}</span>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.Producto.edit', $prod->id) }}" 
                    class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </a>
                   <button 
                        onclick="abrirModalQR(
                            '{{ asset('storage/' . $prod->codigo_qr) }}',
                            '{{ asset('storage/' . $prod->codigo_barra) }}',
                            '{{ $prod->nombre }}',
                            '{{ route('admin.Producto.ticket', $prod->id) }}'
                        )"
                        class="w-10 h-10 flex items-center justify-center bg-sky-50 text-sky-500 hover:bg-sky-100 rounded-xl">

                        <i class="fas fa-qrcode text-sm"></i>
                    </button>

                    <button onclick="abrirEliminar({{ $prod->id }}, '{{ $prod->nombre }}')"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Eliminar (Reutilizando el mismo estilo) --}}
<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Producto?</h3>

        <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">
            Esta acción eliminará el producto <span id="delete_nombre" class="font-bold text-red-600"></span> permanentemente.
        </p>

        <form id="formEliminarProducto" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModal('modalEliminar')"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">
                    No, volver
                </button>
                <button type="submit"
                        class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">
                    Sí, eliminar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal QR & Barcode -->

<div id="modalQR" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-[100] transition-all duration-300">

    <div class="bg-white rounded-[2.5rem] shadow-2xl w-[340px] overflow-hidden relative border border-slate-100 transform transition-all">
        
        {{-- Header con Gradiente --}}
        <div class="relative h-16 flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
            <h2 class="text-white font-black uppercase tracking-widest text-[10px] flex items-center gap-2">
                <i class="fas fa-qrcode text-sm"></i>
                Identificación
            </h2>
            <button onclick="cerrarModalQR()" 
                class="absolute top-4 right-4 w-7 h-7 flex items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/40 transition-all">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>

        <div class="p-6 space-y-5">
            
            {{-- Sección QR --}}
            <div class="flex flex-col items-center group">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-tight mb-3 border border-blue-100">
                    Código QR
                </span>
                <div class="relative p-3 bg-white rounded-2xl shadow-sm border border-slate-100 group-hover:scale-105 transition-transform duration-500">
                    <img id="qrImg" class="w-28 h-28 object-contain">
                </div>
            </div>

            {{-- Divisor --}}
            <div class="relative flex items-center justify-center">
                <div class="w-full h-px bg-slate-100"></div>
                <div class="absolute px-3 bg-white text-[8px] font-black text-slate-300 uppercase tracking-[2px]">Etiqueta</div>
            </div>

            {{-- Sección Barras --}}
            <div class="flex flex-col items-center">
                <div class="bg-[#f8fafc] p-4 rounded-xl border border-slate-200 w-full flex flex-col items-center">
                    <img id="barraImg" class="w-full h-12 object-contain">
                    <div class="mt-2">
                        <span id="barraTexto" class="text-[10px] font-mono font-bold text-slate-500 tracking-[3px]"></span>
                    </div>
                </div>
            </div>

            {{-- Grupo de Botones de Acción --}}
            <div class="grid grid-cols-1 gap-2 pt-2">
                {{-- Botón Imprimir --}}
                <button onclick="window.print()" 
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);"
                    class="w-full py-3.5 text-white rounded-xl text-[10px] font-black uppercase tracking-[2px] transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-100 hover:opacity-90 active:scale-95">
                    <i class="fas fa-print"></i>
                    Imprimir Etiqueta
                </button>

                {{-- Botón Descargar PDF --}}
                <a id="btnDownloadPDF"
                href="{{ route('admin.Producto.ticket', $prod->id) }}"
                target="_blank"
                class="w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 border border-slate-200 rounded-xl text-[9px] font-black uppercase tracking-[2px] transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-file-pdf text-red-500"></i>
                    Descargar en PDF
                </a>
            </div>
        </div>

        {{-- Footer Producto --}}
        <div class="bg-slate-50 px-6 py-3 border-t border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center">
                    <i class="fas fa-tag text-slate-400 text-[9px]"></i>
                </div>
                <div class="flex flex-col truncate">
                    <span class="text-[8px] font-bold text-slate-400 uppercase leading-none">Seleccionado</span>
                    <span id="modalNombreProducto" class="text-[10px] font-black text-slate-700 truncate">Nombre del Producto</span>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
  function abrirModalQR(qr, barra, nombre, pdfUrl) {

    document.getElementById('qrImg').src = qr;
    document.getElementById('barraImg').src = barra;
    document.getElementById('modalNombreProducto').innerText = nombre;

    // 🔥 PDF dinámico
    document.getElementById('btnDownloadPDF').href = pdfUrl;

    const modal = document.getElementById('modalQR');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function cerrarModalQR() {
    const modal = document.getElementById('modalQR');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection