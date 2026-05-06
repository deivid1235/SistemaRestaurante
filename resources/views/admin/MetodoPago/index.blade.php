@extends('layouts.dashboard')
@section('title', 'Método de Pago')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="flex items-center justify-center w-16 h-16 rounded-full border-2 border-dashed border-white/50 bg-white/10">
                    <i class="fa fa-credit-card text-2xl animate-spin" style="animation-duration: 4s;"></i>
                </div>

                <div>
                    <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                        Métodos de Pago
                    </h1>
                    <p class="text-sm font-light opacity-90 group-hover:translate-x-1 transition-transform duration-500 delay-75">
                        Gestione las formas de cobro (Efectivo, Tarjeta, Yape, Plin, etc).
                    </p>
                </div>
            </div>

            <!-- Contenedor de botones ajustado para centrar el botón principal -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="openModal('create')" 
                    class="group px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2 active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus-circle group-hover:rotate-90 transition-transform"></i>
                    Nuevo Método
                </button>
                
                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/40 rounded-xl font-semibold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                    <i class="fa fa-arrow-left"></i>
                    Volver al Menú
                </a>
            </div>
        </div>
        
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @php
            $totalMetodoPago = $metodos->count();
            $activos = $metodos->where('estado', 1)->count();
            $inactivos = $metodos->where('estado', 0)->count();

            $divisor = $totalMetodoPago > 0 ? $totalMetodoPago : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <!-- Total Métodos de Pago -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%); color: white;">
                <i class="fa fa-wallet"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-[#00B5E2] transition-colors">{{ $totalMetodoPago }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Métodos de Pago</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Habilitados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:rotate-12 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-emerald-600 transition-colors">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Habilitado</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-1 rounded-md border border-emerald-100 transition-all duration-300 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-emerald-500">
                    {{ $porcActivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivo }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>

        <!-- Inhabilitados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:-rotate-6"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-red-600 transition-colors">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Inhabilitado</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-1 rounded-md border border-red-100 transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:border-red-500">
                    {{ $porcInactivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivo }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>
    </div>
    {{-- Buscador  --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar impresora por nombre..." 
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
        @foreach($metodos as $metodo)
        <div class="metodo-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col uppercase"
            data-estado="{{ $metodo->estado }}"
            data-nombre="{{ strtolower($metodo->descripcion ?? '') }}">
            
            <!-- Contenedor de Imagen más grande -->
            <div class="relative h-48 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $metodo->estado == 1 ? '#10b981' : '#ef4444' }} 0%, {{ $metodo->estado == 1 ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $metodo->estado == 1 ? 'ACTIVO' : 'INACTIVO' }}
                    </span>
                </div>

                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
                    <div class="relative w-full h-full">
                        <!-- Imagen expandida para ocupar todo el banner -->
                        <img src="{{ asset('imagen/MetodoPago.png') }}" 
                            alt="Metodo"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                        
                        <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-sm border border-slate-100 z-10">
                            <i class="fas fa-check-circle text-[10px] text-emerald-500"></i>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-3 left-3 z-10">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[9px] font-black px-2 py-1 rounded-lg border border-white/20 uppercase">
                        <i class="fa fa-tag mr-1 text-blue-300"></i> {{ $metodo->tipoPago->descripcion ?? 'GENERAL' }}
                    </span>
                </div>
            </div>

            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 truncate tracking-tight">
                        {{ $metodo->descripcion }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold mt-1">
                        ID SISTEMA: #{{ str_pad($metodo->id, 3, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
                
                <div class="bg-slate-50 p-2 rounded-xl border border-slate-100 mb-4 text-center">
                    <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Procedimiento Estándar</span>
                </div>

                <div class="flex gap-2 mt-auto">
                    <button onclick='openModal("edit", @json($metodo))'
                        class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold">EDITAR</span>
                    </button>

                    <button class="btnEliminarMetodoPago w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50"
                        data-id="{{ $metodo->id }}" 
                        data-nombre="{{ $metodo->descripcion }}">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

<div id="paymentModal" class="fixed inset-0 z-50 hidden transition-all duration-300">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px]" onclick="closeModal()"></div>
    
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative transform overflow-hidden rounded-[2.5rem] bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-md">
            
            <div class="px-8 pt-8 pb-6 border-b border-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div id="modalIconContainer" class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                       style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i id="modalIcon" class="fa fa-credit-card text-xl"></i>
                    </div>
                    <div>
                        <h3 id="modalTitle" class="text-xl font-bold text-slate-800 leading-tight">Nuevo Método de Pago</h3>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Configuración de Cobro</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal()" class="text-slate-300 hover:text-slate-500 transition-colors">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <form id="paymentForm" method="POST" class="p-8 space-y-6">
                @csrf
                <div id="methodField"></div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-tag text-[#0096D9]"></i> Nombre del Método
                    </label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <i class="fa fa-keyboard text-slate-300 group-focus-within:text-[#0096D9] transition-colors"></i>
                        </div>
                        <input type="text" name="descripcion" id="inputDescripcion" required 
                            placeholder="EJ: TARJETA CRÉDITO" 
                            class="w-full pl-12 pr-5 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 placeholder:text-slate-300 transition-all uppercase">
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-th-large text-[#0096D9]"></i> Categoría de Pago
                    </label>
                    <div class="relative group">
                        <select name="tipo_pago_id" id="inputTipo" required 
                            class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 appearance-none transition-all uppercase cursor-pointer">
                            <option value="" disabled selected>Seleccione opción</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                            @endforeach
                        </select>
                        <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-toggle-on text-[#0096D9]"></i> Estado del Método
                    </label>
                    <div class="relative group">
                        <select name="estado" id="inputEstado" required 
                            class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 appearance-none transition-all uppercase cursor-pointer">
                            <option value="1">ACTIVO (En línea)</option>
                            <option value="0">INACTIVO</option>
                        </select>
                        <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-6 pt-4">
                    <button type="button" onclick="closeModal()" 
                        class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors tracking-tight">
                        CANCELAR
                    </button>

                    <button type="submit" 
                        class="flex items-center justify-center gap-3 px-8 py-4 rounded-2xl font-bold text-sm text-white shadow-lg shadow-blue-200 transition-all active:scale-95 bg-[#0096D9] hover:bg-[#0085C2]"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-save"></i> 
                        GUARDAR CAMBIOS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEliminar"  class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Método de Pago?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs">Esta acción eliminará el método de pago <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminar" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEliminar').classList.add('hidden')" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

@endsection