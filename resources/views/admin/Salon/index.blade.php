@extends('layouts.dashboard')
@section('title', 'Gestión de salones')

@section('content')
<div class="relative space-y-6">
    
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold tracking-tight">Gestión de salones</h1>
                    <i class="fa fa-chair text-3xl opacity-50 transition-all duration-500 group-hover:opacity-100 group-hover:rotate-12 group-hover:scale-110"></i>
                </div>
                <p class="text-base font-light opacity-90 mt-1">Administre las áreas y la distribución de mesas</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white/40 active:scale-95 w-fit">
                    <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
                </a>
            </div>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150 group-hover:-translate-x-5"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[500px] flex flex-col">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Salones</h2>
                        <p class="text-[11px] text-gray-400">Áreas del restaurante</p>
                    </div>
                    <button onclick="abrirCrear()" 
                        class="flex items-center gap-1.5 px-3 py-1.5 bg-[#2ecc71] hover:bg-[#27ae60] text-white rounded-lg font-bold text-[11px] transition-all shadow-sm active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-plus"></i> Nuevo
                    </button>
                </div>

                <div class="relative mb-6">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa fa-search text-xs"></i>
                    </span>
                    <input type="text" placeholder="Buscar salón..." class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg text-xs focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all">
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase tracking-wider border-b border-gray-50">
                                <th class="px-2 py-3 font-bold">Nombre</th>
                                <th class="px-2 py-3 font-bold text-center">Mesas</th>
                                <th class="px-2 py-3 font-bold text-center">Estado</th>
                                <th class="px-2 py-3 font-bold text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-[11px]">
                            @forelse($salones as $salon)
                            <tr class="hover:bg-blue-50/40 transition-colors group cursor-pointer">
                                <td class="px-2 py-4 font-bold text-gray-600 uppercase">{{ $salon->nombre }}</td>
                                <td class="px-2 py-4 text-center text-gray-500 font-bold">{{ $salon->mesas_count ?? 0 }}</td>
                                <td class="px-2 py-4 text-center">
                                    <span class="px-2 py-0.5 rounded-[4px] text-[9px] font-bold uppercase {{ $salon->estado == 'activo' ? 'bg-[#2ecc71] text-white' : 'bg-red-500 text-white' }}">
                                        {{ $salon->estado }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 text-right">
                                    <div class="flex justify-end gap-2 text-sm">
                                        <button class="text-[#2ecc71] hover:scale-110 transition-transform"><i class="fa fa-eye"></i></button>
                                        <button onclick="abrirEditar({{ $salon->id }}, '{{ $salon->nombre }}', '{{ $salon->estado }}')" class="text-[#3498db] hover:scale-110 transition-transform"><i class="fa fa-edit"></i></button>
                                        <button onclick="abrirEliminar({{ $salon->id }}, '{{ $salon->nombre }}')" class="text-[#e74c3c] hover:scale-110 transition-transform"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400 italic">No hay salones registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

           
            <div class="p-4 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                <span>Mostrando 1 a {{ count($salones) }} de {{ count($salones) }} elementos</span>
                <div class="flex gap-1 items-center">
                    <button class="w-6 h-6 flex items-center justify-center border rounded hover:bg-gray-50"><i class="fa fa-chevron-left text-[8px]"></i></button>
                    <button class="w-6 h-6 rounded bg-gray-600 text-white flex items-center justify-center font-bold">1</button>
                    <button class="w-6 h-6 flex items-center justify-center border rounded hover:bg-gray-50"><i class="fa fa-chevron-right text-[8px]"></i></button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[500px] flex flex-col">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Mesas: <span class="text-blue-500 uppercase">Seleccione</span></h2>
                        <p class="text-[11px] text-gray-400">Gestión de distribución</p>
                    </div>
                    <button class="w-9 h-9 bg-[#e74c3c] hover:bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center transition-transform active:scale-90">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>

                <div class="relative mb-6">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa fa-search text-xs"></i>
                    </span>
                    <input type="text" placeholder="Buscar mesa..." class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg text-xs focus:outline-none">
                </div>

                <div class="flex-grow flex flex-col items-center justify-center py-20 text-center">
                    <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mb-4 text-gray-200">
                        <i class="fa fa-border-all text-3xl"></i>
                    </div>
                    <p class="text-gray-400 text-[11px] italic">Haga clic en un salón para ver sus mesas</p>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modalCrear" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-[30px] w-full max-w-md overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-300 border border-gray-100">
        
        <div class="p-7 flex justify-between items-start">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-900 rounded-2xl flex items-center justify-center shadow-lg shadow-gray-200"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-door-open text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">Nuevo Salón</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Configuración de área</p>
                </div>
            </div>
            <button onclick="cerrarModal('modalCrear')" class="text-gray-300 hover:text-gray-500 transition-colors p-1">
                <i class="fa fa-times text-lg"></i>
            </button>
        </div>

        <form action="{{ route('admin.Salon.store') }}" method="POST" class="px-8 pb-8 space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-wider ml-1">
                    <i class="fa fa-tag text-cyan-500"></i> Nombre del Salón
                </label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <i class="fa fa-keyboard text-sm"></i>
                    </span>
                    <input type="text" name="nombre" required placeholder="EJ: TERRAZA PRINCIPAL" 
                        class="w-full pl-11 pr-4 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/5 outline-none transition-all text-sm font-bold text-gray-700 placeholder:text-gray-200 uppercase">
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-wider ml-1">
                    <i class="fa fa-toggle-on text-cyan-500"></i> Estado del Dispositivo
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <i class="fa fa-circle-dot text-sm"></i>
                    </span>
                    <select name="estado" class="w-full pl-11 pr-10 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/5 outline-none appearance-none transition-all text-sm font-bold text-gray-700 cursor-pointer">
                        <option value="activo">ACTIVO (En línea)</option>
                        <option value="inactivo">INACTIVO (Fuera de servicio)</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-300">
                        <i class="fa fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between gap-4 pt-4">
                <button type="button" onclick="cerrarModal('modalCrear')" 
                    class="px-6 py-4 text-sm font-extrabold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">
                    Cancelar
                </button>
                
                <button type="submit" 
                    class="flex-1 flex items-center justify-center gap-3 py-4 bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white rounded-[20px] font-bold text-sm shadow-xl shadow-gray-200 hover:scale-[1.02] active:scale-95 transition-all uppercase tracking-wider"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-save text-xs opacity-50"></i>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-[30px] w-full max-w-md overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-300 border border-gray-100">
        
        <div class="p-7 flex justify-between items-start">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-cyan-600 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-100"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-edit text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-gray-800 tracking-tight">Editar Salón</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Modificar registro</p>
                </div>
            </div>
            <button onclick="cerrarModal('modalEditar')" class="text-gray-300 hover:text-gray-500 transition-colors p-1">
                <i class="fa fa-times text-lg"></i>
            </button>
        </div>

        <form id="formEditar" method="POST" class="px-8 pb-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-wider ml-1">
                    <i class="fa fa-tag text-cyan-500"></i> Nombre del Salón
                </label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <i class="fa fa-keyboard text-sm"></i>
                    </span>
                    <input type="text" name="nombre" id="edit_nombre" required placeholder="EJ: TERRAZA PRINCIPAL" 
                        class="w-full pl-11 pr-4 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/5 outline-none transition-all text-sm font-bold text-gray-700 placeholder:text-gray-200 uppercase">
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-wider ml-1">
                    <i class="fa fa-toggle-on text-cyan-500"></i> Estado del Salón
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                        <i class="fa fa-circle-dot text-sm"></i>
                    </span>
                    <select name="estado" id="edit_estado" class="w-full pl-11 pr-10 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/5 outline-none appearance-none transition-all text-sm font-bold text-gray-700 cursor-pointer">
                        <option value="activo">ACTIVO (En línea)</option>
                        <option value="inactivo">INACTIVO (Fuera de servicio)</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-300">
                        <i class="fa fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between gap-4 pt-4">
                <button type="button" onclick="cerrarModal('modalEditar')" 
                    class="px-6 py-4 text-sm font-extrabold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">
                    Cancelar
                </button>
                
                <button type="submit" 
                    class="flex-1 flex items-center justify-center gap-3 py-4 bg-gradient-to-br from-[#0096D9] to-[#007bb1] text-white rounded-[20px] font-bold text-sm shadow-xl shadow-blue-100 hover:scale-[1.02] active:scale-95 transition-all uppercase tracking-wider"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-refresh text-xs opacity-50"></i>
                    Actualizar Datos
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL ELIMINAR --}}
<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar salón?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs">Esta acción eliminará el salón <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminar" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModal('modalEliminar')" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirCrear() {
        const m = document.getElementById('modalCrear');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }

    function abrirEditar(id, nombre, estado) {
        const m = document.getElementById('modalEditar');
        const f = document.getElementById('formEditar');
        f.action = `/admin/salones/${id}`; 
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_estado').value = estado;
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    
    function abrirEliminar(id, nombre) {
        const m = document.getElementById('modalEliminar');
        const f = document.getElementById('formEliminar');
        f.action = `/admin/salones/${id}`; 
        document.getElementById('delete_nombre').innerText = nombre;
        m.classList.remove('hidden');
        m.classList.add('flex');
    }

    function cerrarModal(id) {
        const m = document.getElementById(id);
        m.classList.add('hidden');
        m.classList.remove('flex');
    }

    // Cerrar al hacer click fuera del contenido blanco
    window.onclick = function(e) {
        if (e.target.id.startsWith('modal')) {
            cerrarModal(e.target.id);
        }
    }
</script>
@endsection