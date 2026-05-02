@extends('layouts.dashboard')

@section('title', 'Cajas')

@section('content')

<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">

    {{-- Header --}}
    <div class="relative w-full rounded-[2rem] p-6 md:p-8 mb-2 overflow-hidden shadow-lg flex flex-wrap lg:flex-nowrap justify-between items-center gap-4"
         style="background: linear-gradient(135deg, #1e3a5f 0%, #0ea5e9 100%);">
        <div class="z-10 min-w-[250px]">
            <span class="bg-white/10 text-white/90 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">
                Restaurante
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-white mt-3 tracking-tight">Cajas</h1>
            <p class="text-white/70 text-xs mt-1">Gestione las cajas físicas y sus permisos de usuario.</p>
        </div>

        <div class="flex flex-wrap sm:flex-row gap-4 z-10 w-full lg:w-auto">
            {{-- Botón volver --}}
            <a href="{{ route('admin.AdministracionGeneral.index') }}"
               class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-3 transition-all duration-300 hover:scale-105">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fa fa-arrow-left text-white text-base"></i>
                </div>
                <div>
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Regresar</p>
                    <p class="text-white font-black text-sm">Volver al Menú</p>
                </div>
            </a>

            {{-- Stat total --}}
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-4 flex-1 min-w-[160px]">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fa fa-cash-register text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Total</p>
                    <p class="text-white font-black text-xl leading-none">{{ $total }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Alertas --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
            <i class="fa fa-check-circle text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl flex items-center gap-2">
            <i class="fa fa-exclamation-circle text-red-500"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Contenido principal + Info --}}
    <div class="flex flex-col lg:flex-row gap-5">

        {{-- Tabla principal --}}
        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Cabecera --}}
            <div class="p-6 border-b border-gray-100 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Puntos de Venta (Cajas)</h2>
                    <p class="text-gray-400 text-sm">Gestione las cajas físicas y sus permisos de usuario.</p>
                </div>
                <button onclick="abrirModalCrear()"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold px-5 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fa fa-plus text-sm"></i>
                    Nueva Caja
                </button>
            </div>

            {{-- Buscador --}}
            <div class="px-6 py-4 border-b border-gray-50">
                <form method="GET" action="{{ route('cajas.index') }}">
                    <div class="relative">
                        <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" name="buscar" value="{{ request('buscar') }}"
                               placeholder="Buscar caja..."
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all">
                    </div>
                </form>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-widest">
                            <th class="px-6 py-3 text-left font-semibold">Nombre
                                <i class="fa fa-sort ml-1 text-gray-300"></i>
                            </th>
                            <th class="px-6 py-3 text-left font-semibold">Estado
                                <i class="fa fa-sort ml-1 text-gray-300"></i>
                            </th>
                            <th class="px-6 py-3 text-right font-semibold">Acciones
                                <i class="fa fa-sort ml-1 text-gray-300"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($cajas as $caja)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $caja->nombre }}</td>
                            <td class="px-6 py-4">
                                @if($caja->estado === 'activo')
                                    <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                        Activo
                                    </span>
                                @else
                                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Btn Usuarios --}}
                                    <button onclick="abrirModalUsuarios({{ $caja->id }}, '{{ $caja->nombre }}')"
                                            class="text-teal-500 hover:text-teal-700 transition-colors p-1.5 hover:bg-teal-50 rounded-lg"
                                            title="Asignar Usuarios">
                                        <i class="fa fa-user text-base"></i>
                                    </button>
                                    {{-- Btn Editar --}}
                                    <button onclick="abrirModalEditar({{ $caja->id }}, '{{ $caja->nombre }}', '{{ $caja->estado }}')"
                                            class="text-blue-500 hover:text-blue-700 transition-colors p-1.5 hover:bg-blue-50 rounded-lg"
                                            title="Editar">
                                        <i class="fa fa-edit text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa fa-cash-register text-4xl mb-3 block text-gray-200"></i>
                                No se encontraron cajas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm text-gray-500">
                    Mostrando {{ $cajas->firstItem() ?? 0 }} a {{ $cajas->lastItem() ?? 0 }}
                    de {{ $cajas->total() }} elementos
                </p>
                <div class="flex items-center gap-1">
                    @if($cajas->onFirstPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                            <i class="fa fa-chevron-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $cajas->previousPageUrl() }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                            <i class="fa fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    @foreach($cajas->getUrlRange(1, $cajas->lastPage()) as $page => $url)
                        @if($page == $cajas->currentPage())
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-500 text-white text-sm font-bold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors text-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($cajas->hasMorePages())
                        <a href="{{ $cajas->nextPageUrl() }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                            <i class="fa fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                            <i class="fa fa-chevron-right text-xs"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Panel Información --}}
        <div class="lg:w-80 bg-cyan-500 rounded-2xl p-6 text-white shadow-sm self-start">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fa fa-info text-white text-xs"></i>
                </div>
                <h3 class="font-bold text-lg">Información</h3>
            </div>
            <p class="text-white/90 text-sm leading-relaxed mb-5 border-b border-white/20 pb-4">
                Permite trabajar con distintos 'Arqueos de Caja' de manera simultánea e independiente.
            </p>
            <p class="font-bold text-white mb-3">Recomendaciones:</p>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start gap-2">
                    <i class="fa fa-chevron-right text-white/70 mt-0.5 text-xs flex-shrink-0"></i>
                    <span class="text-white/90">
                        Cree una caja por cada punto físico de cobro (Ej: Barra, Salón Principal, Terraza).
                    </span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fa fa-user text-white/70 mt-0.5 text-xs flex-shrink-0"></i>
                    <span class="text-white/90">
                        <strong class="text-white">Permisos:</strong>
                        Recuerde asignar usuarios a cada caja usando el botón de "Usuarios" en la tabla.
                    </span>
                </li>
            </ul>
        </div>

    </div>
</div>

{{-- ===================== MODAL CREAR ===================== --}}
<div id="modalCrear"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
        <div class="bg-green-500 px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg">Nuevo</h3>
            <button onclick="cerrarModalCrear()" class="text-white/80 hover:text-white transition-colors">
                <i class="fa fa-times text-lg"></i>
            </button>
        </div>
        <form action="{{ route('cajas.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm text-gray-500 mb-1">Nombre (Ej: Caja Principal)</label>
                <input type="text" name="nombre" required
                       class="w-full border-b border-gray-300 focus:border-green-500 outline-none py-2 text-gray-700 text-sm transition-colors"
                       placeholder="">
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-1">Estado</label>
                <div class="relative">
                    <select name="estado"
                            class="w-full border-b border-gray-300 focus:border-green-500 outline-none py-2 text-gray-700 text-sm appearance-none bg-transparent transition-colors">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <i class="fa fa-chevron-down absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <button type="button" onclick="cerrarModalCrear()"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL EDITAR ===================== --}}
<div id="modalEditar"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
        <div class="bg-blue-500 px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg">Editar Caja</h3>
            <button onclick="cerrarModalEditar()" class="text-white/80 hover:text-white transition-colors">
                <i class="fa fa-times text-lg"></i>
            </button>
        </div>
        <form id="formEditar" action="" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm text-gray-500 mb-1">Nombre (Ej: Caja Principal)</label>
                <input type="text" name="nombre" id="edit_nombre" required
                       class="w-full border-b border-gray-300 focus:border-blue-500 outline-none py-2 text-gray-700 text-sm transition-colors">
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-1">Estado</label>
                <div class="relative">
                    <select name="estado" id="edit_estado"
                            class="w-full border-b border-gray-300 focus:border-blue-500 outline-none py-2 text-gray-700 text-sm appearance-none bg-transparent transition-colors">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <i class="fa fa-chevron-down absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <button type="button" onclick="cerrarModalEditar()"
                        class="px-6 py-2 border border-gray-300 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL USUARIOS ===================== --}}
<div id="modalUsuarios"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">

        {{-- Header púrpura --}}
        <div style="background:#5b4fcf;" class="px-6 py-4 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg">Editar</h3>
            <button onclick="cerrarModalUsuarios()" class="text-white/80 hover:text-white transition-colors">
                <i class="fa fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-4">

            {{-- Selector de usuario --}}
            <div>
                <p class="text-sm font-semibold text-gray-700 mb-2">Seleccione un usuario para dar acceso:</p>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <select id="selectUsuarioAñadir"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-purple-400 bg-white">
                            <option value="">Buscar usuario...</option>
                        </select>
                        <i class="fa fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                    </div>
                    <button onclick="añadirUsuario()"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 text-sm transition-colors shadow-sm whitespace-nowrap">
                        <i class="fa fa-plus"></i> Añadir
                    </button>
                </div>
            </div>

            {{-- Tabla usuarios con acceso --}}
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Usuarios con acceso actual</p>
                </div>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-4 py-2 text-left text-xs text-gray-500 font-semibold">
                                Usuario <i class="fa fa-sort ml-1 text-gray-300"></i>
                            </th>
                            <th class="px-4 py-2 text-right text-xs text-gray-500 font-semibold">Quitar</th>
                        </tr>
                    </thead>
                    <tbody id="tablaUsuariosAsignados" class="divide-y divide-gray-50">
                        <tr>
                            <td colspan="2" class="px-4 py-6 text-center text-gray-400 text-xs">
                                <i class="fa fa-spinner fa-spin mr-2"></i>Cargando...
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="paginacionUsuarios" class="px-4 py-2 border-t border-gray-100 text-xs text-gray-500"></div>
            </div>

            {{-- Form oculto para enviar --}}
            <form id="formUsuarios" action="" method="POST" class="hidden">
                @csrf
                <div id="inputsUsuariosHidden"></div>
            </form>

            {{-- Botón Cerrar --}}
            <button onclick="cerrarModalUsuarios()"
                    class="w-full border border-gray-300 text-gray-600 rounded-xl py-2.5 text-sm font-medium hover:bg-gray-50 transition-colors">
                Cerrar Ventana
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ---- Modal Crear ----
    function abrirModalCrear() {
        const modal = document.getElementById('modalCrear');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function cerrarModalCrear() {
        const modal = document.getElementById('modalCrear');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ---- Modal Editar ----
    function abrirModalEditar(id, nombre, estado) {
        const modal = document.getElementById('modalEditar');
        document.getElementById('formEditar').action = `/cajas/${id}`;
        document.getElementById('edit_nombre').value  = nombre;
        document.getElementById('edit_estado').value  = estado;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function cerrarModalEditar() {
        const modal = document.getElementById('modalEditar');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ---- Modal Usuarios ----
    let cajaIdActual = null;
    let todosUsuarios = [];
    let usuariosAsignados = [];

    function abrirModalUsuarios(id, nombre) {
        cajaIdActual = id;
        const modal = document.getElementById('modalUsuarios');
        document.getElementById('formUsuarios').action = `/cajas/${id}/asignar-usuarios`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        cargarUsuarios(id);
    }

    function cargarUsuarios(id) {
        document.getElementById('tablaUsuariosAsignados').innerHTML = `
            <tr><td colspan="2" class="px-4 py-6 text-center text-gray-400 text-xs">
                <i class="fa fa-spinner fa-spin mr-2"></i>Cargando...
            </td></tr>`;

        fetch(`/cajas/${id}/usuarios`)
            .then(res => res.json())
            .then(data => {
                todosUsuarios    = data.usuarios;
                usuariosAsignados = data.asignados;

                // Poblar select
                const select = document.getElementById('selectUsuarioAñadir');
                select.innerHTML = '<option value="">Buscar usuario...</option>';
                todosUsuarios.forEach(u => {
                    if (!usuariosAsignados.includes(u.id)) {
                        select.innerHTML += `<option value="${u.id}">${u.nombre} ${u.apellido ?? ''}</option>`;
                    }
                });

                renderTablaAsignados();
            })
            .catch(() => {
                document.getElementById('tablaUsuariosAsignados').innerHTML =
                    '<tr><td colspan="2" class="px-4 py-6 text-center text-red-400 text-xs">Error al cargar usuarios.</td></tr>';
            });
    }

    function renderTablaAsignados() {
        const tbody = document.getElementById('tablaUsuariosAsignados');
        const paginacion = document.getElementById('paginacionUsuarios');

        const asignados = todosUsuarios.filter(u => usuariosAsignados.includes(u.id));

        if (asignados.length === 0) {
            tbody.innerHTML = `<tr><td colspan="2" class="px-4 py-6 text-center text-gray-400 text-xs">Sin usuarios asignados.</td></tr>`;
            paginacion.textContent = '';
            return;
        }

        tbody.innerHTML = '';
        asignados.forEach(u => {
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 text-sm font-medium text-gray-700">${u.nombre} ${u.apellido ?? ''}</td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" onclick="quitarUsuario(${u.id})"
                                class="text-red-400 hover:text-red-600 p-1.5 hover:bg-red-50 rounded-lg transition-colors">
                            <i class="fa fa-trash text-sm"></i>
                        </button>
                    </td>
                </tr>`;
        });

        paginacion.textContent = `Mostrando 1 a ${asignados.length} de ${asignados.length} elementos`;

        // Actualizar inputs ocultos
        const hiddenDiv = document.getElementById('inputsUsuariosHidden');
        hiddenDiv.innerHTML = '';
        usuariosAsignados.forEach(uid => {
            hiddenDiv.innerHTML += `<input type="hidden" name="usuarios[]" value="${uid}">`;
        });
    }

    function añadirUsuario() {
        const select = document.getElementById('selectUsuarioAñadir');
        const uid = parseInt(select.value);
        if (!uid) return;

        if (!usuariosAsignados.includes(uid)) {
            usuariosAsignados.push(uid);
        }

        // Enviar al servidor
        const form = document.getElementById('formUsuarios');
        const hiddenDiv = document.getElementById('inputsUsuariosHidden');
        hiddenDiv.innerHTML = '';
        usuariosAsignados.forEach(id => {
            hiddenDiv.innerHTML += `<input type="hidden" name="usuarios[]" value="${id}">`;
        });
        form.classList.remove('hidden');
        form.submit();
    }

    function quitarUsuario(uid) {
        usuariosAsignados = usuariosAsignados.filter(id => id !== uid);

        // Enviar al servidor
        const form = document.getElementById('formUsuarios');
        const hiddenDiv = document.getElementById('inputsUsuariosHidden');
        hiddenDiv.innerHTML = '';
        usuariosAsignados.forEach(id => {
            hiddenDiv.innerHTML += `<input type="hidden" name="usuarios[]" value="${id}">`;
        });
        form.classList.remove('hidden');
        form.submit();
    }

    function cerrarModalUsuarios() {
        const modal = document.getElementById('modalUsuarios');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Cerrar modales al hacer clic fuera
    ['modalCrear', 'modalEditar', 'modalUsuarios'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });
    });

    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModalCrear();
            cerrarModalEditar();
            cerrarModalUsuarios();
        }
    });
</script>
@endpush

@endsection
