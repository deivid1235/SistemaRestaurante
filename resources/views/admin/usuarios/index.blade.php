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
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6 mb-8">
        @foreach($usuarios as $usuario)
        <div class="area-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-row h-48 max-w-2xl">
            
            {{-- IZQUIERDA: FOTO Y ESTADO --}}
            <div class="relative w-40 flex-shrink-0 bg-slate-50 flex items-center justify-center border-r border-slate-100">
                <div class="absolute top-2 left-2 z-10">
                    <span class="px-2 py-0.5 rounded-lg text-[7px] font-black uppercase tracking-wider text-white shadow-sm {{ $usuario->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                        {{ $usuario->estado ? 'ACTIVO' : 'INACTIVO' }}
                    </span>
                </div>

                <div class="w-24 h-24 rounded-full bg-white shadow-md flex items-center justify-center border-2 border-white overflow-hidden group-hover:scale-105 transition-transform duration-500">
                    @if($usuario->foto)
                        <img src="{{ asset('storage/'.$usuario->foto) }}" class="w-full h-full object-cover">
                    @else
                        <i class="fa fa-user text-4xl text-slate-200"></i>
                    @endif
                </div>

                <div class="absolute bottom-2 right-2">
                    <span class="bg-slate-800 text-white text-[8px] font-black px-1.5 py-0.5 rounded-md">
                        ID: #{{ $usuario->id }}
                    </span>
                </div>
            </div>

            {{-- DERECHA: DATOS Y ACCIONES --}}
            <div class="flex-1 p-4 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-sm font-black text-slate-800 uppercase leading-none truncate">
                                {{ $usuario->nombres }}
                            </h3>
                            <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">
                                {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}
                            </p>
                        </div>
                        <span class="text-[9px] font-black text-slate-500 bg-slate-100 px-2 py-1 rounded-lg border border-slate-200">
                            {{ $usuario->dni }}
                        </span>
                    </div>

                    {{-- INFO GRID --}}
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div class="flex items-center gap-1.5 min-w-0">
                            <i class="fa fa-envelope text-[9px] text-sky-400"></i>
                            <span class="text-[9px] text-slate-500 truncate">{{ $usuario->email }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 min-w-0">
                            <i class="fa fa-at text-[9px] text-purple-400"></i>
                            <span class="text-[9px] text-slate-600 font-bold italic truncate">{{ $usuario->username }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 min-w-0">
                            <i class="fa fa-briefcase text-[9px] text-slate-400"></i>
                            <span class="text-[8px] font-black text-slate-500 uppercase truncate">{{ $usuario->cargo_rrhh ?? 'Sin cargo' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 min-w-0">
                            <i class="fa fa-shield-alt text-[9px] text-blue-400"></i>
                            <span class="text-[9px] font-black text-blue-600 uppercase truncate">{{ $usuario->rol }}</span>
                        </div>
                    </div>
                </div>

                {{-- FOOTER: FECHA Y BOTONES --}}
                <div class="flex justify-between items-center mt-3 pt-3 border-t border-slate-50">
                    <p class="text-[7px] text-slate-300 font-bold uppercase tracking-widest">
                        Desde: {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}
                    </p>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('admin.Usuarios.edit', $usuario->id) }}"
                            class="h-7 px-4 flex items-center gap-2 text-white rounded-lg transition-all active:scale-95 shadow-sm hover:shadow-sky-100"
                            style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%);">
                            <i class="fas fa-edit text-[8px]"></i>
                            <span class="text-[8px] font-black uppercase">Perfil</span>
                        </a>

                        <button onclick="confirmarEliminar({{ $usuario->id }}, '{{ $usuario->nombres }}')"
                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all border border-rose-100 shadow-sm">
                            <i class="fa fa-trash text-[9px]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ── MODAL ELIMINAR ── --}}
<div id="modalEliminar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-[2rem] shadow-2xl p-8 w-full max-w-sm mx-4">
        <div class="flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center">
                <i class="fa fa-trash text-rose-500 text-2xl"></i>
            </div>
            <div>
                <h3 class="font-black text-slate-800 text-lg">Eliminar usuario</h3>
                <p class="text-xs text-slate-400 mt-1">Esta acción no se puede deshacer.</p>
            </div>
            <p class="text-sm text-slate-600">
                ¿Eliminar a <strong id="nombreEliminar" class="text-slate-800"></strong>?
            </p>
            <div class="flex gap-3 w-full mt-2">
                <button onclick="cerrarModal()"
                        class="flex-1 py-3 rounded-2xl border border-slate-200 text-sm font-bold text-slate-500 hover:bg-slate-50 transition-colors active:scale-95">
                    Cancelar
                </button>
                <button onclick="ejecutarEliminar()"
                        class="flex-1 py-3 rounded-2xl bg-rose-500 hover:bg-rose-600 text-white text-sm font-black transition-colors active:scale-95">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let formIdPendiente = null;

    function confirmarEliminar(id, nombre) {
        formIdPendiente = id;
        document.getElementById('nombreEliminar').textContent = nombre;
        document.getElementById('modalEliminar').classList.remove('hidden');
    }
    function cerrarModal() {
        document.getElementById('modalEliminar').classList.add('hidden');
        formIdPendiente = null;
    }
    function ejecutarEliminar() {
        if (formIdPendiente) document.getElementById('form-delete-' + formIdPendiente).submit();
    }
    document.getElementById('modalEliminar').addEventListener('click', function(e) {
        if (e.target === this) cerrarModal();
    });

    let debounceTimer;
    function liveSearch(value) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            url.searchParams.set('search', value);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }, 400);
    }

    let sortDir = {};
    function sortTable(colIndex) {
        const tbody = document.querySelector('#usuariosTable tbody');
        const rows  = Array.from(tbody.querySelectorAll('tr'));
        sortDir[colIndex] = !sortDir[colIndex];
        rows.sort((a, b) => {
            const aT = a.cells[colIndex]?.innerText.trim().toLowerCase() ?? '';
            const bT = b.cells[colIndex]?.innerText.trim().toLowerCase() ?? '';
            return sortDir[colIndex] ? aT.localeCompare(bT) : bT.localeCompare(aT);
        });
        rows.forEach(r => tbody.appendChild(r));
    }
</script>
@endpush

@endsection
