@extends('layouts.dashboard')
@section('title', 'Salones - Administración General')

@section('content')
{{-- CONTENEDOR ÚNICO: Ajusta el alto exacto y quita el scroll --}}
<div class="p-6 bg-gray-50 h-[calc(100vh-64px)] overflow-hidden space-y-6">
    
    {{-- 1. ENCABEZADO PRINCIPAL --}}
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold tracking-tight">Gestión de Salones</h1>
                    <i class="fa fa-chair text-3xl opacity-50 transition-all duration-500 group-hover:opacity-100 group-hover:rotate-12 group-hover:scale-110"></i>
                </div>
                <p class="text-base font-light opacity-90 mt-1">Administre los salones del restaurante</p>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150 group-hover:-translate-x-5"></div>
    </div>

    {{-- 2. CUERPO: GRILLA DE 2 COLUMNAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start h-[calc(100%-160px)]">
        
        {{-- COLUMNA IZQUIERDA: TABLA SALONES --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full">
            <div class="p-5 flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Salones</h2>
                    <p class="text-sm text-gray-400 font-medium">Áreas del restaurante</p>
                </div>
                <button id="btnNuevoSalon" data-url="{{ route('admin.Salon.store') }}"
                    class="bg-[#2ecc71] hover:bg-[#27ae60] text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-bold transition-all shadow-sm active:scale-95">
                    <i class="fa fa-plus"></i> Nuevo
                </button>
            </div>

            <div class="px-5 mb-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fa fa-search text-sm"></i>
                    </span>
                    <input type="text" placeholder="Buscar salón..." 
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all text-sm">
                </div>
            </div>

            {{-- Contenedor con scroll interno solo para la tabla si hay muchos datos --}}
            <div class="overflow-y-auto flex-grow px-1 scroll-smooth">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-white z-10">
                        <tr class="border-y border-gray-100 text-[11px] uppercase text-gray-400 font-bold tracking-wider">
                            <th class="px-5 py-3">Nombre</th>
                            <th class="px-5 py-3 text-center">Mesas</th>
                            <th class="px-5 py-3">Estado</th>
                            <th class="px-5 py-3 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach($salones as $salon)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="px-5 py-4 font-bold text-gray-700 bg-gray-100/30 uppercase text-xs tracking-wide">{{ $salon->nombre }}</td>
                            <td class="px-5 py-4 text-center text-xs text-gray-500 font-medium">16</td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold text-white uppercase tracking-tighter {{ $salon->estado == 'activo' ? 'bg-[#2ecc71]' : 'bg-red-500' }}">
                                    {{ $salon->estado }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-3 text-base">
                                    <button class="text-[#2ecc71] hover:scale-110 transition-transform"><i class="fa fa-eye"></i></button>
                                    <button class="btnEditarSalon text-[#3498db] hover:scale-110 transition-transform" 
                                        data-id="{{ $salon->id_salon }}" 
                                        data-nombre="{{ $salon->nombre }}" 
                                        data-estado="{{ $salon->estado }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                   <form action="{{ route('admin.Salon.destroy', $salon->id) }}" method="POST" class="inline">
                                        @csrf 
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('¿Eliminar?')" class="text-[#e74c3c] hover:opacity-75">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-5 flex items-center justify-between text-xs text-gray-400 font-bold border-t border-gray-50 bg-white">
                <span>Total: {{ $salones->count() }} elementos</span>
                <div class="flex items-center gap-1">
                    <button class="p-2 border rounded-md disabled:opacity-30"><i class="fa fa-chevron-left text-[10px]"></i></button>
                    <button class="w-8 h-8 flex items-center justify-center bg-gray-600 text-white rounded-md shadow-sm">1</button>
                    <button class="p-2 border rounded-md"><i class="fa fa-chevron-right text-[10px]"></i></button>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: SECCIÓN VACÍA --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col h-full">
            <h2 class="text-xl font-bold text-gray-800">Mesas: <span class="text-blue-600 uppercase">Seleccione Salón</span></h2>
            <p class="text-sm text-gray-400 font-medium mb-8">Gestión de distribución</p>
            
            <div class="flex-grow border-2 border-dashed border-gray-100 rounded-2xl flex flex-col items-center justify-center text-gray-300 gap-3">
                <i class="fa fa-th text-4xl opacity-20"></i>
                <p class="italic font-medium">Aquí aparecerá el contenido seleccionado...</p>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="modalSalon" class="fixed inset-0 bg-slate-900/40 hidden items-center justify-center z- backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform transition-all scale-95">
        <div class="p-5 border-b bg-gray-50 flex justify-between items-center">
            <h2 id="tituloModal" class="text-lg font-bold text-gray-700 tracking-tight"></h2>
            <button class="closeModal text-gray-400 hover:text-gray-600"><i class="fa fa-times"></i></button>
        </div>
        <form id="formSalon" method="POST" class="p-8">
            @csrf
            <div id="methodSalon"></div>
            <div class="space-y-5">
                <div>
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Nombre del Salón</label>
                    <input type="text" name="nombre" id="nombreSalon" 
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all" 
                        placeholder="Ej. Salón Principal" required>
                </div>
                <div>
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Estado de Disponibilidad</label>
                    <select name="estado" id="estadoSalon" 
                        class="w-full border border-gray-200 p-3 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all appearance-none">
                        <option value="activo">ACTIVO</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-10">
                <button type="button" class="closeModal px-5 py-2.5 text-gray-500 font-bold hover:bg-gray-100 rounded-xl transition-all">Cancelar</button>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalSalon');
        const form = document.getElementById('formSalon');
        const method = document.getElementById('methodSalon');

        const openM = () => { modal.classList.remove('hidden'); modal.classList.add('flex'); };
        const closeM = () => { modal.classList.add('hidden'); };

        document.getElementById('btnNuevoSalon').addEventListener('click', function () {
            openM();
            form.action = this.dataset.url;
            method.innerHTML = "";
            form.reset();
            document.getElementById('tituloModal').innerText = "Crear Nuevo Salón";
        });

        document.querySelectorAll('.closeModal').forEach(el => el.addEventListener('click', closeM));

        document.querySelectorAll('.btnEditarSalon').forEach(btn => {
            btn.addEventListener('click', function () {
                openM();
                form.action = "/salones/" + this.dataset.id;
                method.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                document.getElementById('nombreSalon').value = this.dataset.nombre;
                document.getElementById('estadoSalon').value = this.dataset.estado;
                document.getElementById('tituloModal').innerText = "Actualizar Salón";
            });
        });
    });
</script>
@endsection