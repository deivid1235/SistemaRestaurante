@extends('layouts.dashboard')
@section('title', 'Gestión de Impresoras')

@section('content')
<div class="relative space-y-6">
    
    {{-- 1. ENCABEZADO PRINCIPAL --}}
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold tracking-tight">
                        Gestión de Impresoras
                    </h1>
                    <i class="fa fa-print text-3xl opacity-50 transition-all duration-500 group-hover:opacity-100 group-hover:rotate-12 group-hover:scale-110"></i>
                </div>
                <p class="text-base font-light opacity-90 mt-1">
                    Administre los puntos de impresión del restaurante
                </p>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150 group-hover:-translate-x-5"></div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <div class="lg:col-span-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-50">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <i class="fa fa-print text-[#00B5E2] text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-700 leading-tight">Listado de Dispositivos</h2>
                        <p class="text-xs text-gray-400">Estado actual de las ticketeras</p>
                    </div>
                </div>
                <button id="btnNueva" class="bg-[#00B5E2] hover:bg-[#0096D9] text-white px-6 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 transition-all shadow-md active:scale-95"  style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Nueva Impresora
                </button>
            </div>

            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm ml-auto">
                   <input type="text" id="buscador" placeholder="Buscar impresora..." class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-y border-gray-100">
                        <tr class="text-gray-400 text-[11px] uppercase tracking-wider">
                            <th class="px-6 py-3 font-bold">Nombre <i class="fa fa-sort opacity-30 ml-1"></i></th>
                            <th class="px-6 py-3 font-bold text-center">Estado</th>
                            <th class="px-6 py-3 font-bold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaImpresoras" class="divide-y divide-gray-100 text-sm">
                        @foreach($impresoras as $imp)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-600 uppercase tracking-tight">{{ $imp->nombre }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded text-[10px] font-bold uppercase {{ $imp->estado == 'activo' ? 'bg-[#2ECC71] text-white' : 'bg-red-500 text-white' }}">
                                    {{ $imp->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <button class="btnEditar text-[#00B5E2] hover:text-blue-700 transition-colors"
                                            data-id="{{ $imp->id }}" data-nombre="{{ $imp->nombre }}" data-estado="{{ $imp->estado }}">
                                        <i class="fa fa-edit text-lg"></i>
                                    </button>
                                    <form action="{{ route('admin.Inpresora.destroy',$imp->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="text-red-400 hover:text-red-600 transition-colors">
                                            <i class="fa fa-trash-alt text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-5 flex justify-between items-center text-[13px] text-gray-500 border-t border-gray-50 bg-gray-50/20">
                <p>Mostrando 1 a {{ count($impresoras) }} de {{ count($impresoras) }} elementos</p>
                <div class="flex gap-1">
                    <button class="px-2 py-1 text-gray-300 hover:text-gray-500"><i class="fa fa-chevron-left text-xs"></i></button>
                    <button class="w-8 h-8 bg-gray-600 text-white rounded flex items-center justify-center font-bold">1</button>
                    <button class="px-2 py-1 text-gray-300 hover:text-gray-500"><i class="fa fa-chevron-right text-xs"></i></button>
                </div>
            </div>
        </div>
            <div class="lg:col-span-4 space-y-4">
                <div class="bg-[#00B5E2] rounded-xl p-5 text-white flex gap-4 shadow-sm relative overflow-hidden"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <div class="w-10 h-10 border-2 border-white/50 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                        <i class="fa fa-info text-lg font-bold"></i>
                    </div>
                    <div class="z-10">
                        <h4 class="font-bold text-lg leading-tight">Información</h4>
                        <p class="text-xs opacity-90 leading-relaxed mt-1">Configure los nombres de impresora tal cual aparecen en Windows.</p>
                    </div>
                    <i class="fa fa-print absolute -right-4 -bottom-4 text-white/10 text-7xl rotate-12"></i>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-gray-700 flex items-center gap-2 text-sm">
                                <i class="fa fa-cog text-[#00B5E2] animate-spin-slow"></i> Opciones de Ticket
                            </h4>
                            <p class="text-[10px] text-gray-400 mt-0.5">Active solo los formatos que utiliza su hardware</p>
                        </div>
                        
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#00B5E2]"></div>
                        </label>
                    </div>
                    
                    <div class="px-5 py-3 divide-y divide-gray-50">
                        @php
                            $formatos = [
                                ['id' => 't80', 'nombre' => 'Ticket 80mm', 'desc' => 'Estándar térmico industrial', 'icon' => 'fa-receipt', 'activo' => true],
                                ['id' => 't58', 'nombre' => 'Ticket 58mm', 'desc' => 'Térmico pequeño / Portátil', 'icon' => 'fa-print', 'activo' => false],
                                ['id' => 't57', 'nombre' => 'Ticket 57mm', 'desc' => 'Térmico estándar', 'icon' => 'fa-file-invoice', 'activo' => false],
                                ['id' => 't50', 'nombre' => 'Ticket 50mm', 'desc' => 'Formato reducido', 'icon' => 'fa-sticky-note', 'activo' => false],
                                ['id' => 'pdf', 'nombre' => 'PDF / A4', 'desc' => 'Documento digital estándar', 'icon' => 'fa-file-pdf', 'activo' => false],
                            ];
                        @endphp

                        @foreach($formatos as $f)
                        <div class="flex items-center justify-between group py-3 transition-all hover:bg-gray-50/50 -mx-2 px-2 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                                    <i class="fa {{ $f['icon'] }} text-gray-400 group-hover:text-[#00B5E2] text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-[13px] font-bold text-gray-700 leading-none">{{ $f['nombre'] }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $f['desc'] }}</p>
                                </div>
                            </div>
                            
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="{{ $f['id'] }}" class="sr-only peer" {{ $f['activo'] ? 'checked' : '' }}>
                                <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2ECC71]">
                                </div>
                            </label>
                        </div>
                        @endforeach

                        <div class="pt-4 pb-1">
                            <button class="w-full bg-[#2ECC71] hover:bg-[#27AE60] text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition-all shadow-md active:scale-[0.97] text-sm"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                <i class="fa fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>

{{-- 3. MODAL DE GESTIÓN --}}
<div id="modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100">
        
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
                <button type="button" id="btnCerrar" 
                    class="flex-1 px-6 py-3.5 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all active:scale-95 text-sm">
                    CANCELAR
                </button>
                <button class="flex-[1.5] bg-[#00B5E2] text-white px-8 py-3.5 rounded-2xl font-bold shadow-xl shadow-blue-200 hover:bg-[#0096D9] hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> GUARDAR CAMBIOS
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modal');
    const form = document.getElementById('form');
    const method = document.getElementById('method');

    // ABRIR NUEVO
    document.getElementById('btnNueva').addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        form.action = "{{ route('admin.Inpresora.store') }}";
        method.innerHTML = "";
        form.reset();
        document.getElementById('modalTitle').innerText = "Nueva Impresora";
    });

    // CERRAR
    document.getElementById('btnCerrar').addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // EDITAR
    document.querySelectorAll('.btnEditar').forEach(btn => {
        btn.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            form.action = "/admin/Inpresora/" + this.dataset.id;
            method.innerHTML = '@method("PUT")';
            document.getElementById('nombre').value = this.dataset.nombre;
            document.getElementById('estado').value = this.dataset.estado;
            document.getElementById('modalTitle').innerText = "Editar Impresora";
        });
    });

    // 🔍 BUSCADOR (AQUÍ VA)
    const buscador = document.getElementById('buscador');

    buscador.addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaImpresoras tr');

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();

            if (texto.includes(filtro)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });

});
</script>
@endsection