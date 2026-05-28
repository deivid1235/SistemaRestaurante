@extends('layouts.dashboard')
@section('title', 'Usuarios')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-users text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Usuarios</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione el personal, sus roles y permisos de acceso al sistema
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('admin.Usuarios.create') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-xl text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-xl border border-white/10 uppercase tracking-widest"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-user-plus text-[9px]"></i>
                    NUEVO USUARIO
                </a>
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
            $totalUsuarios = $usuarios->count();
            $activosUser = $usuarios->where('estado', 1)->count();
            $inactivosUser = $usuarios->where('estado', 0)->count();

            $divisor = $totalUsuarios > 0 ? $totalUsuarios : 1;
            $porcActivo = round(($activosUser / $divisor) * 100);
            $porcInactivo = round(($inactivosUser / $divisor) * 100);
        @endphp

        {{-- Total Usuarios --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #00B5E2 0%, #0082a3 100%); color: white;">
                <i class="fa fa-users"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalUsuarios }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Usuarios</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        {{-- Usuarios Activos --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activosUser }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Usuarios Activos</p>
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

        {{-- Usuarios Inactivos --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-user-slash"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivosUser }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Usuarios Inactivos</p>
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
    {{-- ── CARD TABLA ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($usuarios as $usuario)
        <div class="area-card group bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-300 overflow-hidden flex flex-col sm:flex-row h-auto sm:h-48"
            data-estado="{{ $usuario->estado }}">
            <div class="relative w-full sm:w-32 h-36 sm:h-full flex-shrink-0 bg-slate-50 flex items-center justify-center border-b sm:border-b-0 sm:border-r border-slate-100">
                <!-- Badge Estado -->
                <div class="absolute top-3 left-3 z-10">
                    <span class="px-2.5 py-1 rounded-full text-[9px] font-black tracking-wider text-white shadow-sm flex items-center gap-1 {{ $usuario->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                        <span class="w-1 h-1 rounded-full bg-white animate-pulse"></span>
                        {{ $usuario->estado ? 'ACTIVO' : 'INACTIVO' }}
                    </span>
                </div>

                <!-- Contenedor Foto de Perfil -->
                <div class="w-20 h-20 rounded-2xl bg-white shadow-sm flex items-center justify-center border border-slate-100 overflow-hidden group-hover:scale-105 transition-transform duration-300">
                    @if($usuario->foto)
                        <img src="{{ asset('storage/'.$usuario->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <i class="fa fa-user text-2xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Badge ID -->
                <div class="absolute bottom-3 right-3">
                    <span class="bg-slate-800/90 backdrop-blur-xs text-white text-[9px] font-mono font-bold px-2 py-0.5 rounded-md tracking-tight">
                        #{{ $usuario->id }}
                    </span>
                </div>
            </div>

            <!-- SECCIÓN DE INFORMACIÓN -->
            <div class="flex-1 p-4 flex flex-col justify-between min-w-0 bg-white">
                <div>
                    <!-- Nombre y DNI -->
                    <div class="flex justify-between items-start gap-2">
                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-slate-800 tracking-tight truncate uppercase leading-tight">
                                {{ $usuario->nombres }}
                            </h3>
                            <p class="text-xs text-slate-400 font-medium truncate uppercase mt-0.5">
                                {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno ?? '' }}
                            </p>
                        </div>
                        <span class="text-[10px] font-mono font-bold text-slate-500 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-200/60 shrink-0">
                            {{ $usuario->dni }}
                        </span>
                    </div>

                    <!-- Detalles del Usuario (Email & Rol) -->
                    <div class="space-y-1.5 mt-3">
                        <div class="flex items-center gap-2 min-w-0 text-slate-500">
                            <div class="w-4 h-4 rounded-md bg-sky-50 flex items-center justify-center shrink-0">
                                <i class="fa fa-envelope text-[10px] text-sky-500"></i>
                            </div>
                            <span class="text-xs truncate text-slate-600">{{ $usuario->email }}</span>
                        </div>
                        
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-4 h-4 rounded-md bg-indigo-50 flex items-center justify-center shrink-0">
                                <i class="fa fa-shield-halved text-[10px] text-indigo-500"></i>
                            </div>
                            <span class="text-xs font-bold text-indigo-600 uppercase truncate">
                                {{ $usuario->rol->nombre }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ACCIONES Y FECHA DE CREACIÓN -->
                <div class="flex justify-between items-center mt-4 pt-3 border-t border-slate-100">
                    <div class="flex flex-col">
                        <span class="text-[9px] text-slate-300 font-bold uppercase tracking-wider">Registro</span>
                        <span class="text-[11px] text-slate-500 font-semibold">
                            {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <!-- Botón Perfil (Editar) -->
                        <a href="{{ route('admin.Usuarios.edit', $usuario->id) }}"
                        class="h-8 px-3.5 flex items-center gap-1.5 text-white bg-gradient-to-br from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 rounded-xl transition-all active:scale-95 shadow-xs shadow-sky-200">
                            <i class="fas fa-edit text-[10px]"></i>
                            <span class="text-xs font-bold tracking-tight">Perfil</span>
                        </a>

                        <!-- Botón Eliminar -->
                        <button class="btnEliminarUsuario w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-200 text-slate-400 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all active:scale-95 shrink-0"
                                data-id="{{ $usuario->id }}" 
                                data-nombre="{{ $usuario->nombres }}">
                            <i class="fa-regular fa-trash-can text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

{{-- ── MODAL ELIMINAR ── --}}
<div id="modalEliminarUsuario" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Usuario?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">Esta acción eliminará <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminarUsuario" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEliminarUsuario').classList.add('hidden')" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-3 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

@endsection
