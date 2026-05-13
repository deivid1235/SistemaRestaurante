@extends('layouts.dashboard')

@section('title', 'Combos')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-hamburger text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Combos y Menús</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Configura paquetes, promociones y ofertas especiales de platillos para tus comensales.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button id="btnNuevoCombo"
                    class="flex items-center justify-center gap-3 px-8 py-3 text-white font-black uppercase tracking-wide rounded-2xl shadow-lg shadow-sky-100 hover:shadow-sky-200 transition-all active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fas fa-plus text-sm"></i>
                    Nuevo Combo
                </button>

                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                    <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
                </a>
            </div>
        </div>

        <!-- Círculo de luz decorativo -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>
  
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar combo por nombre..." 
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $totalCombos = $combos->count();
            $activos = $combos->where('estado', 'activo')->count();
            $inactivos = $combos->where('estado', 'inactivo')->count();
            
            $divisor = $totalCombos > 0 ? $totalCombos : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <!-- Total Combos (Estilo Ticket) -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white;">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalCombos }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Combos Creados</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-amber-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Activos (Vigentes) -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-fire"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">En Menú (Activos)</p>
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

        <!-- Inactivos (Color Rojo) -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Combos Inactivos</p>
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @foreach($combos as $combo)
        <div class="combo-card flex h-44 bg-white rounded-[2rem] shadow-md border border-gray-100 overflow-hidden group transition-all hover:shadow-lg"
            data-nombre="{{ strtolower($combo->nombre) }}"
            data-estado="{{ $combo->estado }}">            
            <!-- PARTE IZQUIERDA: IMAGEN -->
            <div class="w-2/5 h-full relative overflow-hidden">
                @if($combo->imagen)
                    <img src="{{ asset($combo->imagen) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-200">
                        <i class="fa fa-utensils text-3xl"></i>
                    </div>
                @endif

                <!-- ESTADO CON PALABRA Y FONDO (Sustituye al punto verde) -->
                <div class="absolute top-3 left-3">
                    <span class="px-2 py-0.5 rounded-lg text-[8px] font-black uppercase tracking-tighter shadow-sm border border-white
                        {{ $combo->estado == 'activo' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $combo->estado }}
                    </span>
                </div>
            </div>

            <!-- CUERPO CENTRAL: INFO -->
            <div class="flex-1 p-4 pl-8 flex flex-col justify-center relative">
                <p class="text-[8px] font-black text-[#00B5E2] uppercase tracking-widest mb-1">Promo Especial</p>
                <h2 class="text-[13px] font-black text-gray-800 uppercase leading-tight mb-2 line-clamp-2">{{ $combo->nombre }}</h2>
                
                <div class="grid grid-cols-2 gap-2 border-t border-gray-50 pt-2">
                    <div>
                        <p class="text-[7px] font-bold text-gray-400 uppercase">Área</p>
                        <p class="text-[9px] font-bold text-gray-600 truncate">{{ $combo->area->nombre ?? 'BAR' }}</p>
                    </div>
                    <div>
                        <p class="text-[7px] font-bold text-gray-400 uppercase">Servicio</p>
                        <p class="text-[9px] font-bold text-gray-600">
                            <i class="fa {{ $combo->delivery ? 'fa-motorcycle text-green-500' : 'fa-store text-orange-400' }} mr-1 text-[8px]"></i>
                            {{ $combo->delivery ? 'DELIVERY' : 'LOCAL' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- LÍNEA DIVISORA -->
            <div class="relative w-px border-l border-dashed border-gray-200 my-4">
                <div class="absolute -top-6 -left-[11px] w-5 h-5 bg-gray-50 rounded-full border border-gray-100 shadow-inner"></div>
                <div class="absolute -bottom-6 -left-[11px] w-5 h-5 bg-gray-50 rounded-full border border-gray-100 shadow-inner"></div>
            </div>

            <!-- PARTE DERECHA: ACCIONES -->
            <div class="w-28 bg-gray-50/30 p-3 flex flex-col justify-center gap-2">
                <div class="text-center mb-1">
                    <p class="text-[7px] font-black text-gray-300 uppercase tracking-tighter">ACCIONES</p>
                    <div class="mt-1 flex justify-center opacity-20">
                        <i class="fa fa-barcode text-xl text-gray-800"></i>
                    </div>
                </div>
                
                <!-- Botones con Efecto Hover Sólido (Azul y Rojo) -->
            <div class="flex gap-2 mt-auto">
                    <button data-combo='@json($combo)'
                            class="btnEditarCombo flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">

                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold uppercase">Editar</span>
                    </button>
                   <button class="btnEliminarCombos w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50"
                        data-id="{{ $combo->id }}" data-nombre="{{ $combo->nombre }}">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <!-- MODAL COMBO -->
    <div id="modalCombo" class="fixed inset-0 z-[9999] hidden transition-all duration-300">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px]" onclick="closeComboModal()"></div>
        
        <div class="fixed inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="relative w-full max-w-2xl transform overflow-hidden rounded-[2.5rem] bg-white text-left shadow-2xl transition-all border border-slate-50 pointer-events-auto">
                
                <div class="px-8 pt-8 pb-6 border-b border-slate-50 flex items-center justify-between bg-white">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            <i class="fa fa-box-open text-xl"></i>
                        </div>
                        <div>
                            <h3 id="modalTitle" class="text-xl font-bold text-slate-800 leading-tight">Nuevo Combo</h3>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Gestión de Menú</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeComboModal()" class="text-slate-300 hover:text-slate-500 transition-colors">
                        <i class="fa fa-times text-lg"></i>
                    </button>
                </div>

                <form id="comboForm" method="POST" enctype="multipart/form-data" 
                    data-store="{{ route('admin.Combos.store') }}"
                    class="p-8 space-y-5 max-h-[90vh] overflow-y-auto bg-white">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    {{-- Nombre --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                            <i class="fa fa-tag text-[#0096D9]"></i> Nombre del Combo
                        </label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                                <i class="fa fa-keyboard text-slate-300 group-focus-within:text-[#0096D9] transition-colors"></i>
                            </div>
                            <input type="text" name="nombre" id="nombre" required 
                                placeholder="EJ: COMBO CEVICHERO" 
                                class="w-full pl-12 pr-5 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 placeholder:text-slate-300 transition-all uppercase text-sm">
                        </div>
                    </div>

                    {{-- Descripción + Nota --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 text-xs transition-all"
                                placeholder="¿Qué incluye?"></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Nota</label>
                            <textarea name="nota" id="nota" rows="3"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 text-xs transition-all"
                                placeholder="Nota interna..."></textarea>
                        </div>
                    </div>

                    {{-- Imagen --}}
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Imagen del Combo</label>
                        <div class="relative border-2 border-dashed border-slate-100 rounded-2xl p-4 bg-slate-50/30 group-hover:border-[#0096D9] transition-all">
                            <input type="file" name="imagen" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-[#0096D9] cursor-pointer">
                        </div>
                    </div>

                    {{-- Área + Estado + Delivery en 3 columnas --}}
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Área</label>
                            <div class="relative group">
                                <select name="id_area" id="id_area" required class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-bold text-slate-600 appearance-none transition-all text-xs cursor-pointer">
                                    <option value="">ELEGIR...</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Estado</label>
                            <div class="relative group">
                                <select name="estado" id="estado" required class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-bold text-slate-600 appearance-none transition-all text-xs cursor-pointer">
                                    <option value="activo">ACTIVO</option>
                                    <option value="inactivo">INACTIVO</option>
                                </select>
                                <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">Servicio Delivery</label>
                            <div class="relative group">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-[#0096D9]">
                                    <i class="fa fa-motorcycle"></i>
                                </div>
                                <select name="delivery" id="delivery" required class="w-full pl-12 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-bold text-slate-600 appearance-none transition-all text-xs cursor-pointer">
                                    <option value="1">SÍ, DISPONIBLE</option>
                                    <option value="0">NO, SOLO LOCAL</option>
                                </select>
                                <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-end gap-6 pt-4 sticky bottom-0 bg-white">
                        <button type="button" onclick="closeComboModal()" 
                            class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors tracking-tight">
                            CANCELAR
                        </button>
                        <button type="submit" 
                            class="flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl font-semibold text-xs text-white shadow-md transition-all hover:shadow-lg active:scale-95"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            <i class="fa fa-save text-xs"></i> 
                            GUARDAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Combo?</h3>
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