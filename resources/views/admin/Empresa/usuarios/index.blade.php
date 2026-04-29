@extends('layouts.dashboard')
@section('title', 'Usuarios')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">

    {{-- ── HEADER GRADIENTE ── --}}
    <div class="relative w-full rounded-[2rem] p-6 md:p-8 mb-2 overflow-hidden shadow-lg flex flex-wrap lg:flex-nowrap justify-between items-center gap-6"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">

        <div class="z-10 min-w-[250px]">
            <span class="bg-white/10 text-white/90 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/10">
                Control de Sistema
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-white mt-3 tracking-tight">Gestión de Personal</h1>
            <p class="text-white/70 text-xs mt-1">Administre los usuarios y sus roles de acceso.</p>
        </div>

        <div class="flex flex-wrap sm:flex-row gap-4 z-10 w-full lg:w-auto">
            {{-- Stat: total usuarios --}}
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-4 flex-1 min-w-[160px]">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fa fa-users text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Total</p>
                    <p class="text-white font-black text-xl leading-none">{{ $usuarios->total() }}</p>
                </div>
            </div>

            {{-- Botón nuevo usuario --}}
            <a href="{{ route('usuarios.create') }}"
               class="bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-3 transition-all duration-300 hover:-translate-y-1 active:scale-95 min-w-[160px]">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fa fa-user-plus text-white text-base"></i>
                </div>
                <div>
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Agregar</p>
                    <p class="text-white font-black text-sm">Nuevo Usuario</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ── FLASH ── --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-5 py-3 rounded-2xl shadow-sm">
            <i class="fa fa-check-circle text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── CARD TABLA ── --}}
    <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">

        {{-- Buscador --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Listado de Usuarios</h2>
            </div>

            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                    <i class="fa fa-search text-xs"></i>
                </span>
                <input
                    type="text"
                    value="{{ $search }}"
                    placeholder="Buscar por nombre, apellido o cargo..."
                    onkeyup="liveSearch(this.value)"
                    class="w-full pl-9 pr-4 py-2.5 text-sm border border-slate-200 rounded-2xl bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:bg-white transition-all"
                />
            </div>
        </div>

        {{-- Tabla --}}
        <div class="overflow-x-auto rounded-2xl border border-slate-100">
            <table class="w-full text-sm text-left" id="usuariosTable">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Nombres
                            <button onclick="sortTable(0)" class="ml-1 text-slate-300 hover:text-slate-500 transition-colors"><i class="fa fa-sort"></i></button>
                        </th>
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Ape. Paterno
                            <button onclick="sortTable(1)" class="ml-1 text-slate-300 hover:text-slate-500 transition-colors"><i class="fa fa-sort"></i></button>
                        </th>
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Ape. Materno
                            <button onclick="sortTable(2)" class="ml-1 text-slate-300 hover:text-slate-500 transition-colors"><i class="fa fa-sort"></i></button>
                        </th>
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Cargo
                            <button onclick="sortTable(3)" class="ml-1 text-slate-300 hover:text-slate-500 transition-colors"><i class="fa fa-sort"></i></button>
                        </th>
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Estado
                        </th>
                        <th class="px-5 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($usuarios as $usuario)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-200 group">
                            <td class="px-5 py-4 font-bold text-slate-800 uppercase">{{ $usuario->nombres }}</td>
                            <td class="px-5 py-4 text-slate-600 uppercase">{{ $usuario->apellido_paterno }}</td>
                            <td class="px-5 py-4 text-slate-600 uppercase">{{ $usuario->apellido_materno }}</td>
                            <td class="px-5 py-4">
                                @php
                                    $rolClasses = match($usuario->rol) {
                                        'ADMINISTRADOR' => 'bg-blue-100 text-blue-700',
                                        'CAJERO'        => 'bg-amber-100 text-amber-700',
                                        'PRODUCCION'    => 'bg-violet-100 text-violet-700',
                                        'MOZO'          => 'bg-emerald-100 text-emerald-700',
                                        'REPARTIDOR'    => 'bg-orange-100 text-orange-700',
                                        default         => 'bg-slate-100 text-slate-500',
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $rolClasses }}">
                                    {{ $usuario->rol }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if($usuario->estado)
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black bg-emerald-500 text-white uppercase tracking-wider">ACTIVO</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black bg-rose-400 text-white uppercase tracking-wider">INACTIVO</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                       class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 hover:scale-110 active:scale-95"
                                       title="Editar">
                                        <i class="fa fa-edit text-xs"></i>
                                    </a>
                                    <button
                                        onclick="confirmarEliminar({{ $usuario->id }}, '{{ $usuario->nombres }}')"
                                        class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 text-rose-400 hover:bg-rose-500 hover:text-white transition-all duration-300 hover:scale-110 active:scale-95"
                                        title="Eliminar">
                                        <i class="fa fa-trash text-xs"></i>
                                    </button>
                                    <form id="form-delete-{{ $usuario->id }}"
                                          action="{{ route('usuarios.destroy', $usuario->id) }}"
                                          method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa fa-users text-5xl"></i>
                                    <p class="text-sm font-bold text-slate-400">No se encontraron usuarios</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400 font-semibold">
            <span>
                Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }}
                de {{ $usuarios->total() }} elementos
            </span>

            <div class="flex items-center gap-1.5">
                @if($usuarios->onFirstPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-xl border border-slate-100 text-slate-200 cursor-not-allowed">
                        <i class="fa fa-chevron-left text-[10px]"></i>
                    </span>
                @else
                    <a href="{{ $usuarios->previousPageUrl() }}"
                       class="w-8 h-8 flex items-center justify-center rounded-xl border border-slate-200 hover:bg-slate-100 transition-colors">
                        <i class="fa fa-chevron-left text-[10px]"></i>
                    </a>
                @endif

                @foreach($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                    @if($page == $usuarios->currentPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-xl text-white font-black text-[11px]"
                              style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="w-8 h-8 flex items-center justify-center rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-500 transition-colors text-[11px]">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($usuarios->hasMorePages())
                    <a href="{{ $usuarios->nextPageUrl() }}"
                       class="w-8 h-8 flex items-center justify-center rounded-xl border border-slate-200 hover:bg-slate-100 transition-colors">
                        <i class="fa fa-chevron-right text-[10px]"></i>
                    </a>
                @else
                    <span class="w-8 h-8 flex items-center justify-center rounded-xl border border-slate-100 text-slate-200 cursor-not-allowed">
                        <i class="fa fa-chevron-right text-[10px]"></i>
                    </span>
                @endif
            </div>
        </div>
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
