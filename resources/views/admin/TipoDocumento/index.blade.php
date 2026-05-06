@extends('layouts.dashboard')
@section('title', 'Documentos Fiscales')

@section('content')
<div class="p-2 sm:p-6 space-y-4 sm:space-y-6">
    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_6s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fas fa-file-invoice text-3xl animate-[pulse_3s_ease-in-out_infinite]"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                            Documentos Fiscales
                        </h1>
                    </div>
                    <p class="text-white/90 mt-1 text-sm sm:text-base font-medium">
                        Configure series y numeración de facturación.
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <button id="btnNuevo" class="w-full sm:w-auto bg-[#4ade80] hover:bg-[#22c55e] text-white px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 transition-all font-bold shadow-sm active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Tipo</span>
                </button>

                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                    <i class="fas fa-undo-alt text-xs"></i> 
                    Volver al Menú
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @php
            $totalDocu = $tipos->count();
            $activos = $tipos->where('estado', 'activo')->count();
            $inactivos = $tipos->where('estado', 'inactivo')->count();

            $divisor = $totalDocu > 0 ? $totalDocu : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <!-- Total Documentos -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%); color: white;">
                <i class="fa fa-boxes"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-[#00B5E2] transition-colors">{{ $totalDocu }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Documentos</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Habilitados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:rotate-12 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-emerald-600 transition-colors">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Habilitado</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-1 rounded-md border border-emerald-100 transition-all duration-300 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-emerald-500">
                    {{ $porcActivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivo }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>

        <!-- Inhabilitados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-all duration-500 group-hover:scale-110 group-hover:-rotate-6"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none group-hover:text-red-600 transition-colors">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Inhabilitado</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-1 rounded-md border border-red-100 transition-all duration-300 group-hover:bg-red-500 group-hover:text-white group-hover:border-red-500">
                    {{ $porcInactivo }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivo }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>
    </div>
    {{-- Buscador  --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar impresora por nombre..." 
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($tipos as $item)
        <div class="documento-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col uppercase"
            data-estado="{{ $item->estado }}"
            data-nombre="{{ strtolower($item->descripcion ?? '') }}">
            
            <div class="relative h-32 overflow-hidden bg-slate-100">
                <div class="absolute top-3 right-3 z-10">
                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-md"
                        style="background: linear-gradient(135deg, {{ strtolower($item->estado) == 'activo' ? '#10b981' : '#ef4444' }} 0%, {{ strtolower($item->estado) == 'activo' ? '#059669' : '#b91c1c' }} 100%);">
                        {{ $item->estado }}
                    </span>
                </div>

                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('imagen/Documento.png') }}" 
                        alt="Documento"
                        class="w-56 h-56 object-contain mx-auto drop-shadow-2xl transition-all duration-500 group-hover:scale-125 group-hover:-translate-y-2">
                        <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-sm">
                            <i class="fas fa-check-circle text-[10px] text-[#00B5E2]"></i>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-3 left-3">
                    <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded-lg border border-white/20">
                        SERIE: {{ $item->serie }}
                    </span>
                </div>
            </div>

            
            <div class="p-4 flex-1 flex flex-col">
                <div class="mb-3">
                    <h3 class="text-sm font-black text-slate-800 truncate tracking-tight">
                        {{ $item->descripcion }}
                    </h3>
                    <p class="text-[9px] text-slate-400 font-bold mt-1">
                        <i class="fas fa-barcode mr-1 text-blue-400/60"></i> Correlativo Sunat/Interno
                    </p>
                </div>
                
                
                <div class="grid grid-cols-1 gap-2 mb-4 bg-slate-50 p-2 rounded-xl border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-hashtag text-[10px] text-slate-400"></i>
                            <span class="text-[9px] font-bold text-slate-600">Nº ACTUAL:</span>
                        </div>
                        <span class="text-[10px] font-mono font-black text-blue-600">
                            {{ str_pad($item->numero, 8, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

               
                <div class="flex gap-2 mt-auto">
                    <button onclick="editarDocumento({{ json_encode($item) }})" 
                        class="flex-1 h-10 flex items-center justify-center gap-2 text-white rounded-xl transition-all active:scale-95 shadow-md hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%);">
                        <i class="fas fa-edit text-xs"></i>
                        <span class="text-[10px] font-bold">EDITAR</span>
                    </button>

                    <button class="btnEliminarDocumento w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50"
                        data-id="{{ $item->id }}" 
                        data-nombre="{{ $item->descripcion }}">
                        <i class="fa fa-trash text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Documento con Estilo de Hardware -->
<div id="modalDocumento" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100 mx-4">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#00B5E2] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-file-invoice text-lg"></i>
                </div>
                <div>
                    <h2 id="modalTitle" class="text-xl font-bold text-gray-800 tracking-tight leading-none">Nuevo Documento</h2>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Configuración de comprobante</p>
                </div>
            </div>
            <button type="button" onclick="closeModal()" 
                class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <form id="formDocumento" method="POST" class="p-8 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            
            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-file-alt text-[#00B5E2]"></i> Descripción del Documento
                </label>
                <div class="relative">
                    <input type="text" name="descripcion" id="inputDesc" 
                        class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none uppercase transition-all font-medium text-gray-700 placeholder:text-gray-300 text-sm" 
                        placeholder="EJ: FACTURA ELECTRÓNICA" required>
                    <i class="fa fa-keyboard absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="group space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-barcode text-[#00B5E2]"></i> Serie
                    </label>
                    <div class="relative">
                        <input type="text" name="serie" id="inputSerie" 
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none uppercase transition-all font-medium text-gray-700 placeholder:text-gray-300 text-sm" 
                            placeholder="F001" required>
                        <i class="fa fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                    </div>
                </div>

                <div class="group space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-hashtag text-[#00B5E2]"></i> Nº Actual
                    </label>
                    <div class="relative">
                        <input type="number" name="numero" id="inputNum" 
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all font-medium text-gray-700 placeholder:text-gray-300 text-sm" 
                            placeholder="0" required>
                        <i class="fa fa-list-ol absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                    </div>
                </div>
            </div>

            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-toggle-on text-[#00B5E2]"></i> Estado del Documento
                </label>
                <div class="relative">
                    <select name="estado" id="inputEstado" 
                        class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all appearance-none bg-white font-medium text-gray-700 text-sm cursor-pointer uppercase">
                        <option value="ACTIVO">ACTIVO (Habilitado)</option>
                        <option value="INACTIVO">INACTIVO (Deshabilitado)</option>
                    </select>
                    <i class="fa fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                    <i class="fa fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="button" onclick="closeModal()" 
                    class="flex-1 px-6 py-3.5 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all active:scale-95 text-sm">
                    CANCELAR
                </button>
                <button type="submit" class="flex-[1.5] text-white px-5 py-2.5 text-sm rounded-2xl font-bold shadow-xl shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> GUARDAR DOCUMENTO
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEliminar"  class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Tipo de Documento?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs">Esta acción eliminará el tipo de documento <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminar" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModal('modalEliminar')" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>
@endsection