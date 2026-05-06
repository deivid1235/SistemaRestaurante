@extends('layouts.dashboard')
@section('title', 'Gestión de Impresoras')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner animate-[spin_5s_linear_infinite]">
                        <i class="fa fa-print text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Gestión de Impresoras
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Administre los puntos de impresión del restaurante
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button id="btnNueva" data-url="{{ route('admin.Inpresora.store') }}" 
                    class="flex-1 md:flex-none text-white px-8 py-3 rounded-full font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-lg active:scale-95 border border-white/20 hover:brightness-110" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Nueva Impresora
                </button>
                <button id="btnNueva" 
                    onclick="document.getElementById('modalTicketera').classList.remove('hidden')"
                    class="flex-1 md:flex-none text-white px-8 py-3 rounded-full font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-lg active:scale-95 border border-white/20 hover:brightness-110" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Tiketera 
                </button>

                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-md border border-white/30 rounded-full font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                    <i class="fa fa-arrow-left text-xs"></i> Volver
                </a>
            </div>

        </div>
        <!-- Decoración de fondo -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $totalImp = $impresoras->count();
            $activos = $impresoras->where('estado', 'activo')->count();
            $inactivos = $impresoras->where('estado', 'inactivo')->count();
            
            $divisor = $totalImp > 0 ? $totalImp : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <!-- Total Impresoras -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%); color: white;">
                <i class="fas fa-print"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalImp }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Impresoras</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Habilitadas (Estilo Productos) -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Habilitadas</p>
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

        <!-- Inactivas (Estilo Productos) -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Inactivas</p>
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

    {{-- Buscador y Filtros Segmentados para Impresoras --}}
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

    {{-- Grid de Cards de Impresoras --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($impresoras as $imp)
        <div class="impresora group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col"
            data-estado="{{ $imp->estado }}"
            data-nombre="{{ strtolower($imp->nombre ?? '') }}">
            
            <div class="relative h-40 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $imp->estado == 'activo' ? '#10b981' : '#ef4444' }} 0%, {{ $imp->estado == 'activo' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $imp->estado }}
                    </span>
                </div>

               <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 overflow-hidden">
                    <img src="{{ asset('imagen/Impresora.png') }}" 
                        alt="Impresora"
                        class="w-56 h-56 object-contain mx-auto drop-shadow-2xl transition-all duration-500 group-hover:scale-125 group-hover:-translate-y-2">
                </div>

                <div class="absolute bottom-3 left-3">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg border border-white/20">
                        ID: #{{ $imp->id }}
                    </span>
                </div>
            </div>

            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate tracking-tight">
                        {{ $imp->nombre }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                        <i class="fas fa-microchip mr-1 text-blue-400/60"></i> Hardware Térmico
                    </p>
                </div>
                
                <div class="grid grid-cols-1 gap-2 mb-4 bg-slate-50 p-2 rounded-xl border border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-network-wired text-[10px] text-slate-400"></i>
                        <span class="text-[9px] font-bold text-slate-600 uppercase">Puerto: Local / USB</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-blue-500">
                        <i class="fas fa-file-invoice text-[10px]"></i>
                        <span class="text-[9px] font-bold uppercase tracking-tighter">Tipo: Ticketera</span>
                    </div>
                </div>

                <div class="flex gap-2 mt-auto">
                    <button class="btnEditar flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                        data-id="{{ $imp->id }}" data-nombre="{{ $imp->nombre }}" data-estado="{{ $imp->estado }}"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </button>

                    <button class="btnEliminarImpresora w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50"
                        data-id="{{ $imp->id }}" data-nombre="{{ $imp->nombre }}">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Opciones de Ticket - Diseño Premium Compacto -->
<div id="modalTicketera" class="fixed inset-0 z-[100] flex items-center justify-center hidden bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] overflow-hidden shadow-2xl transform transition-all border border-white/20">
        <div class="px-6 py-4 flex items-center gap-4" 
             style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%);">
            <div class="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center border border-white/30 flex-shrink-0 shadow-sm">
                <i class="fa fa-info text-white text-lg"></i>
            </div>
            
            <div>
                <h3 class="text-white font-black text-base leading-tight tracking-tight">Información</h3>
                <p class="text-white/80 text-[9px] font-bold uppercase tracking-[0.1em]">Configuración de Hardware Windows</p>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-4 ml-1">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                    <i class="fa fa-cog text-[#00B5E2]"></i> Opciones de Ticket
                </label>
                <p class="text-[9px] text-slate-300 font-bold mt-0.5 uppercase">Active solo los formatos que utiliza</p>
            </div>

            <div class="divide-y divide-slate-50 border border-slate-100 rounded-[1.5rem] overflow-hidden bg-slate-50/20">
                @php
                    $formatos = [
                        ['id' => 't80', 'n' => 'Ticket 80mm', 'd' => 'Estándar térmico', 'checked' => true],
                        ['id' => 't58', 'n' => 'Ticket 58mm', 'd' => 'Térmico pequeño', 'checked' => false],
                        ['id' => 't57', 'n' => 'Ticket 57mm', 'd' => 'Térmico estándar', 'checked' => false],
                        ['id' => 't50', 'n' => 'Ticket 50mm', 'd' => 'Formato reducido', 'checked' => false],
                        ['id' => 'pdf', 'n' => 'PDF / A4', 'd' => 'Documento digital', 'checked' => false],
                    ];
                @endphp

                @foreach($formatos as $f)
                <div class="flex items-center justify-between px-5 py-2.5 hover:bg-white transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-1 rounded-full bg-slate-200 group-hover:bg-[#00B5E2]"></div>
                        <div>
                            <p class="text-xs font-black text-slate-600 leading-none group-hover:text-[#00B5E2] transition-colors">{{ $f['n'] }}</p>
                            <p class="text-[9px] text-slate-400 font-bold mt-1 uppercase tracking-tight">{{ $f['d'] }}</p>
                        </div>
                    </div>
                    
                    <label class="relative inline-flex items-center cursor-pointer scale-[0.8]">
                        <input type="checkbox" id="{{ $f['id'] }}" class="sr-only peer" {{ $f['checked'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2ECC71]"></div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="px-8 pb-8 flex items-center justify-between">
            <button type="button" onclick="document.getElementById('modalTicketera').classList.add('hidden')" 
                class="text-slate-400 hover:text-slate-600 font-black text-[10px] uppercase tracking-widest transition-colors">
                CANCELAR
            </button>
            
            <button type="submit" class="flex items-center gap-2 px-6 py-3 text-white rounded-xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg shadow-blue-100 active:scale-95 hover:brightness-110"
                style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%); border: 1px solid rgba(255,255,255,0.1);">
                <i class="fa fa-save text-xs"></i>
                GUARDAR CAMBIOS
            </button>
        </div>
    </div>
</div>

<div id="modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100 mx-4">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#00B5E2] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-print text-lg"></i>
                </div>
                <div>
                    <h2 id="modalTitle" class="text-xl font-bold text-gray-800 tracking-tight leading-none"></h2>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Configuración de hardware</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" 
                class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <form id="form" method="POST" class="p-8 space-y-6">
            @csrf
            <div id="method"></div>
            
            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-tag text-[#00B5E2]"></i> Nombre de la Impresora
                </label>
                <div class="relative">
                    <input type="text" name="nombre" id="nombre" 
                        class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none uppercase transition-all font-medium text-gray-700 placeholder:text-gray-300" 
                        placeholder="Ej: CAJA_PRINCIPAL" required>
                    <i class="fa fa-keyboard absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                </div>
            </div>

            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-toggle-on text-[#00B5E2]"></i> Estado del Dispositivo
                </label>
                <div class="relative">
                    <select name="estado" id="estado" 
                        class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all appearance-none bg-white font-medium text-gray-700">
                        <option value="activo"> ACTIVO (En línea)</option>
                        <option value="inactivo"> INACTIVO (Deshabilitado)</option>
                    </select>
                    <i class="fa fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                    <i class="fa fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" 
                    class="flex-1 px-6 py-3.5 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all active:scale-95 text-sm">
                    CANCELAR
                </button>
                <button type="submit" class="flex-[1.5] text-white px-5 py-2 text-sm rounded-2xl font-bold shadow-xl shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> GUARDAR CAMBIOS
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Impresora?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">Esta acción eliminará <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminar" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEliminar').classList.add('hidden')" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-3 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>


@endsection