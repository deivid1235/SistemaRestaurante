@extends('layouts.dashboard')

@section('title', 'Cajas')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-cash-register text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Cajas</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione las cajas físicas y sus permisos de usuario
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="abrirCrear()"
                    class="flex items-center gap-2 px-6 py-3 rounded-xl text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-xl border border-white/10 uppercase tracking-widest"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-plus text-[9px]"></i>
                    NUEVA CAJA
                </button>

                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                    <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @php
            $totalCaja = $cajas->count();
            $activosCaja = $cajas->where('estado', 'activo')->count();
            $inactivosCaja = $cajas->where('estado', 'inactivo')->count();

            $divisor = $totalCaja > 0 ? $totalCaja : 1;
            $porcActivo = round(($activosCaja / $divisor) * 100);
            $porcInactivo = round(($inactivosCaja / $divisor) * 100);
        @endphp

        {{-- Total Cajas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #00B5E2 0%, #0082a3 100%); color: white;">
                <i class="fa fa-boxes"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalCaja }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Cajas</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        {{-- Cajas Activas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activosCaja }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Cajas Habilitadas</p>
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

        {{-- Cajas Inactivas --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivosCaja }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Cajas Inactivas</p>
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
    {{-- Buscador y Filtros Segmentados para caja --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar caja por nombre..." 
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
        @foreach($cajas as $caja)
        <div class="area-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full"
            data-estado="{{ $caja->estado }}"
            data-nombre="{{ strtolower($caja->nombre ?? '') }}">
            
            {{-- Header de la Card con Badge de Estado --}}
            <div class="relative h-40 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ $caja->estado == 'activo' ? '#10b981' : '#ef4444' }} 0%, {{ $caja->estado == 'activo' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $caja->estado }}
                    </span>
                </div>

                {{-- Icono Central y Letra --}}
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
                    <div class="relative">
                        <img src="{{ asset('imagen/caja.png') }}"
                        class="w-29 h-29 object-contain opacity-40 transition-all duration-500 group-hover:scale-110 group-hover:opacity-70">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-4xl font-black text-slate-300 group-hover:text-[#00B5E2] transition-colors uppercase">
                                {{ substr($caja->nombre, 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ID Badge --}}
                <div class="absolute bottom-3 left-3">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg border border-white/20">
                        ID: #{{ $caja->id }}
                    </span>
                </div>
            </div>

            {{-- Contenido de la Card --}}
            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 uppercase truncate tracking-tight">
                        {{ $caja->nombre }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                        <i class="fas fa-user-tag mr-1 text-blue-400/60"></i> Punto de Cobro
                    </p>
                </div>
               

                {{-- Usuarios Asignados --}}
                <div class="mb-4">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2">Operadores:</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($caja->usuarios as $usuario)
                            <span class="px-2 py-0.5 text-[9px] font-bold bg-blue-50 text-blue-600 rounded-md border border-blue-100">
                                {{ explode(' ', $usuario->name)[0] }}
                            </span>
                        @empty
                            <span class="text-[9px] text-slate-300 italic font-bold uppercase">Sin usuarios</span>
                        @endforelse
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="flex gap-2 mt-auto">

                    {{-- EDITAR --}}
                    <button 
                        onclick='abrirEditar(
                            {{ $caja->id }},
                            @json($caja->nombre),
                            @json($caja->estado),
                            @json($caja->fecha_apertura),
                            @json($caja->fecha_cierre)
                        )'
                        class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </button>

                    {{-- USUARIOS --}}
                    <button 
                        onclick='abrirModalUsuarios(
                            {{ $caja->id }},
                            @json($caja->nombre)
                        )'
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-slate-900 hover:text-white transition-all shadow-sm border border-slate-100">
                        
                        <i class="fa fa-users text-sm"></i>
                    </button>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<div id="modalCaja" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[400px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">

        {{-- CABECERA DEL MODAL --}}
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i id="iconModal" class="fa fa-cash-register text-white text-lg"></i>
                </div>
                <div>
                    <h3 id="tituloModal" class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nueva Caja</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Gestión de Punto de Venta</p>
                </div>
            </div>
            <button type="button" onclick="cerrarModalCaja()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        {{-- FORMULARIO --}}
        <form id="formCaja" method="POST" class="p-6 pt-4 space-y-4">
            @csrf
            <input type="hidden" id="methodCaja" name="_method" value="POST">

            {{-- INPUT: NOMBRE DE LA CAJA --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Identificador de Caja
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" id="nombre" required placeholder="EJ: CAJA PRINCIPAL"
                           class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>
            {{-- SELECT: ESTADO --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado Operativo
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-shield-halved text-xs"></i>
                    </div>
                    <select name="estado" id="estado"
                            class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalCaja()"
                        class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                <button type="submit" id="btnGuardar"
                        class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-save text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Caja</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalUsuarios" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">
        
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100" 
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-users text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Usuarios</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Accesos de Caja</p>
                </div>
            </div>
            <button onclick="cerrarModalUsuarios()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <div class="p-6 pt-4 space-y-5">
            
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-user-plus text-blue-400 text-[7px]"></i> Asignar nuevo acceso
                </label>
                <div class="flex gap-2">
                    <div class="relative flex-1 group">
                        <select id="selectUsuarioAñadir" 
                            class="w-full bg-white border border-slate-100 p-3 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-xs appearance-none cursor-pointer transition-all">
                            <option value="">Buscar usuario...</option>
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-[10px]">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <button onclick="añadirUsuario()" 
                        class="w-11 h-11 flex items-center justify-center bg-green-500 text-white rounded-xl shadow-lg shadow-green-100 hover:scale-105 active:scale-95 transition-all"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-plus text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="bg-slate-50/50 border border-slate-100 rounded-2xl overflow-hidden">
                <div class="max-h-[200px] overflow-y-auto">
                    <table class="w-full text-sm">
                        <tbody id="tablaUsuariosAsignados" class="divide-y divide-slate-100">
                            <tr>
                                <td class="px-4 py-6 text-center text-slate-400 font-bold text-[10px] uppercase tracking-widest">
                                    <i class="fa fa-spinner fa-spin mr-2"></i> Cargando...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <form id="formUsuarios" action="" method="POST" class="hidden">
                @csrf
                <div id="inputsUsuariosHidden"></div>
            </form>

            <button onclick="cerrarModalUsuarios()" 
                class="w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-white font-extrabold text-xs tracking-widest shadow-xl shadow-blue-200 hover:brightness-110 active:scale-[0.98] transition-all"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                    <i class="fa fa-check text-[10px] text-white"></i>
                </div>
                LISTO / CERRAR
            </button>
        </div>
    </div>
</div>

@endsection