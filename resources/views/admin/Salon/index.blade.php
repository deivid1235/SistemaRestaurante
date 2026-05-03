@extends('layouts.dashboard')
@section('title', 'Gestión de salones')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-inner">
                    <i class="fa fa-chair text-4xl animate-spin" style="animation-duration: 3s;"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                        Gestión de Salones
                    </h1>
                    <p class="text-white font-medium opacity-90 mt-1 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-ping"></span>
                        Administración central de áreas y mesas
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/40 rounded-xl font-semibold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left"></i>
                Volver al Menú
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-100"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                            <i class="fa fa-chair text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-800 leading-none">Salones</h2>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em] mt-1.5">Áreas del restaurante</p>
                        </div>
                    </div>

                    <button onclick="abrirCrearSalon()" class="flex items-center gap-2 px-6 py-2.5 text-white rounded-xl font-bold text-xs hover:scale-105 transition-all shadow-lg shadow-blue-100"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-plus"></i> NUEVO
                    </button>
                </div>

                <div class="overflow-x-auto overflow-y-auto max-h-[300px]">
                    <table class="w-full">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-widest border-b border-gray-100">
                                <th class="pb-4 text-left font-black pl-2">Nombre</th>
                                <th class="pb-4 text-center font-black">Mesas</th>
                                <th class="pb-4 text-center font-black">Estado</th>
                                <th class="pb-4 text-right font-black pr-2">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($salones as $salon)
                            <tr id="fila-salon-{{ $salon->id }}" 
                                onclick="seleccionarSalon({{ $salon->id }}, '{{ $salon->nombre }}')" 
                                class="group cursor-pointer hover:bg-blue-50/50 transition-all">
                                
                                <td class="py-4 pl-2 font-bold text-slate-700 uppercase text-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-1.5 h-1.5 bg-blue-400 rounded-full"></div>
                                        {{ $salon->nombre }}
                                    </div>
                                </td>
                                
                                <td class="py-4 text-center text-sm font-bold text-slate-500">
                                    {{ $salon->mesas_count ?? 0 }}
                                </td>
                                
                                <td class="py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $salon->estado == 'activo' ? 'bg-green-500' : 'bg-slate-400' }} text-white shadow-sm">
                                        {{ $salon->estado ?? 'ACTIVO' }}
                                    </span>
                                </td>
                                
                                <td class="py-4 text-right pr-2">
                                    <div class="flex justify-end gap-2">
                                        <button onclick="event.stopPropagation(); abrirEditarSalon({{ $salon->id }}, '{{ $salon->nombre }}', '{{ $salon->estado }}')" 
                                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fa fa-edit text-[10px]"></i>
                                        </button>
                                        <button onclick="event.stopPropagation(); abrirEliminar({{ $salon->id }}, '{{ $salon->nombre }}', 'salon')" 
                                                class="w-8 h-8 rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fa fa-trash text-[10px]"></i>
                                        </button>
                                    </div>
                                    <form id="form-eliminar-salon-{{ $salon->id }}" action="{{ route('admin.Salon.destroy', $salon->id) }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-100"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                            <i class="fa fa-utensils text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-800 leading-none">
                                Mesas: <span id="tituloMesas" class="text-blue-500 uppercase">Seleccione...</span>
                            </h2>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em] mt-1.5">Gestión de distribución</p>
                        </div>
                    </div>
                    
                    <button onclick="abrirCrearMesa()" class="w-11 h-11 text-white rounded-2xl flex items-center justify-center hover:scale-110 transition-all shadow-lg shadow-blue-100"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-plus text-lg"></i>
                    </button>
                </div>

               <div id="contenedorMesas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 overflow-y-auto max-h-[400px] pr-2">
                    @foreach($mesas as $mesa)
                    @php
                        $esOcupado = $mesa->estado == 'ocupado';
                        $esReservado = $mesa->estado == 'reservado';

                        $iconoRestaurante = $esOcupado ? 'fa-user-friends' : ($esReservado ? 'fa-concierge-bell' : 'fa-chair');
                        
                        $bgIcono = $esOcupado ? 'bg-red-50' : ($esReservado ? 'bg-blue-50' : 'bg-green-50');
                        $textIcono = $esOcupado ? 'text-red-500' : ($esReservado ? 'text-blue-500' : 'text-green-500');
                        $borderCard = $esOcupado ? 'border-t-red-500' : ($esReservado ? 'border-t-blue-500' : 'border-t-green-500');
                        $badge = $esOcupado ? 'bg-red-500' : ($esReservado ? 'bg-blue-500' : 'bg-green-500');

                        $imagenMesa = $esOcupado
                            ? asset('mesas/ocupado.png')
                            : ($esReservado
                                ? asset('mesas/reservado.png')
                                : asset('mesas/disponible.png'));
                    @endphp

                    <div data-salon="{{ $mesa->salon_id }}" 
                        class="mesa hidden group relative bg-white rounded-[2rem] border border-gray-100 border-t-4 {{ $borderCard }} shadow-sm hover:shadow-2xl transition-all duration-300">
                        
                        <div class="absolute top-4 right-4">
                            <span class="{{ $badge }} text-white text-[9px] font-black px-3 py-1 rounded-lg uppercase tracking-widest shadow-sm">
                                {{ $mesa->estado }}
                            </span>
                        </div>

                        <div class="p-6 flex flex-col items-center">
                            <div class="w-24 h-24 {{ $bgIcono }} rounded-full flex items-center justify-center mb-4 mt-2 group-hover:scale-110 transition-transform duration-500 border-4 border-white shadow-inner">
                               <img src="{{ $imagenMesa }}" 
                                    class="w-20 h-20 object-contain"
                                    alt="Estado de mesa">
                            </div>

                            <div class="text-center mb-6">
                                <h3 class="text-xl font-black text-slate-800 leading-tight uppercase">{{ $mesa->nombre }}</h3>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">{{ $mesa->salon->nombre ?? 'Sin Salón' }}</p>
                            </div>

                            <div class="flex gap-2 w-full">
                                <button onclick="abrirEditarMesa({{ $mesa->id }}, '{{ $mesa->nombre }}', '{{ $mesa->estado }}', '{{ $mesa->salon_id }}')" 
                                        class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl bg-slate-50 text-slate-600 font-bold text-xs hover:bg-blue-500 hover:text-white transition-all shadow-sm">
                                    <i class="fa fa-edit"></i>
                                    EDITAR
                                </button>
                                
                                <button onclick="abrirEliminar({{ $mesa->id }}, '{{ $mesa->nombre }}', 'mesa')" 
                                        class="w-11 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <form id="form-eliminar-mesa-{{ $mesa->id }}" action="{{ route('admin.mesa.destroy', $mesa->id) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>


<div id="modalSalon" class="fixed inset-0 hidden items-center justify-center bg-slate-800/40 backdrop-blur-[2px] z-[100] p-4">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-xl overflow-hidden animate-in zoom-in duration-200">
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fa fa-door-open text-white text-lg"></i>
                </div>
                <div>
                    <h3 id="modalSalonTitulo" class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nuevo Salón</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Configuración de Espacio</p>
                </div>
            </div>
            <button onclick="cerrarModal('modalSalon')" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form id="formSalon" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="methodSalon" value="POST">
            
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-[#4fc3f7] text-[7px]"></i> Nombre del Salón
                </label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs">
                        <i class="fa fa-keyboard"></i>
                    </div>
                    <input name="nombre" id="inputSalonNombre" required placeholder="EJ: SALÓN 01" 
                        class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-[#4fc3f7] outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-[#4fc3f7] text-[7px]"></i> Estado del área
                </label>
                <div class="relative">
                    <select name="estado" id="inputSalonEstado" 
                        class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-[#4fc3f7] outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO (En línea)</option>
                        <option value="inactivo">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModal('modalSalon')" 
                    class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                
                <button class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fa fa-save text-xs"></i>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>


<div id="modalMesa" class="fixed inset-0 hidden items-center justify-center bg-slate-800/40 backdrop-blur-[2px] z-[100] p-4 transition-all duration-200">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-xl overflow-hidden animate-in zoom-in duration-200">
    
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100"
                     style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fa fa-utensils text-white text-lg"></i>
                </div>
                <div>
                    <h3 id="modalMesaTitulo" class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nueva Mesa</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Configuración de Mesa</p>
                </div>
            </div>
            <button onclick="cerrarModal('modalMesa')" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form id="formMesa" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="methodMesa" value="POST">
            <input type="hidden" name="salon_id" id="mesa_salon_id">
           
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-[#4fc3f7] text-[7px]"></i> Nombre de la Mesa
                </label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs">
                        <i class="fa fa-keyboard"></i>
                    </div>
                    <input name="nombre" id="inputMesaNombre" required placeholder="EJ: MESA 01" 
                        class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-[#4fc3f7] outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

           
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-[#4fc3f7] text-[7px]"></i> Estado actual
                </label>
                <div class="relative">
                    <select name="estado" id="inputMesaEstado" 
                        class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-[#4fc3f7] outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="disponible">DISPONIBLE (Libre)</option>
                        <option value="ocupado">OCUPADO (En uso)</option>
                        <option value="reservado">RESERVADO</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            
            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModal('modalMesa')" 
                    class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                
                <button type="submit" class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fa fa-save text-xs"></i>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar registro?</h3>

        <p class="text-gray-500 mt-2 mb-6 text-xs">
            Esta acción eliminará <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.
        </p>

        <form id="formEliminar" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button"
                        onclick="cerrarModal('modalEliminar')"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">
                    No, volver
                </button>
                <button type="submit"
                        class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">
                    Sí, eliminar
                </button>
            </div>
        </form>

    </div>
</div>


@endsection