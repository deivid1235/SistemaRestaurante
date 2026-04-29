@extends('layouts.dashboard')
@section('title', 'Documentos Fiscales')

@section('content')
<div class="p-2 sm:p-6 space-y-4 sm:space-y-6">
    
   <div class="relative overflow-hidden rounded-xl sm:rounded-2xl p-5 sm:p-8 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 group">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Documentos Fiscales</h1>
                    <i class="fas fa-file-invoice text-2xl sm:text-3xl text-white/80 transition-transform duration-500 group-hover:rotate-12 group-hover:scale-110"></i>
                </div>
                <p class="text-white/90 mt-1 text-sm sm:text-base font-medium">Configure series y numeración de facturación.</p>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                <i class="fas fa-undo-alt text-sm"></i>
                Volver al Menú
            </a>
        </div>

        <div class="absolute top-[-20%] right-[-10%] w-64 h-64 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-110"></div>
    </div>
    <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
        
        <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="p-4 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                
                <div class="flex-1 max-w-2xl">
                    <form method="GET" action="{{ route('admin.TipoDocumento.index') }}" class="flex gap-2">
                        <div class="relative flex-1">

                        </div>
                    </form>
                </div>

                <button id="btnNuevo" class="bg-[#4ade80] hover:bg-[#22c55e] text-white px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 transition-all font-bold shadow-sm active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Tipo</span>
                </button>
            </div>
            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm ml-auto">
                   <input type="text" id="buscador" placeholder="Buscar Tipo de Documento..." class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-[10px] sm:text-[11px] text-gray-400 uppercase bg-gray-50/50 font-bold border-b">
                        <tr>
                            <th class="px-4 sm:px-6 py-4">Descripción</th>
                            <th class="px-2 py-4 text-center">Serie</th>
                            <th class="px-2 py-4 text-center">Nº Actual</th>
                            <th class="px-2 py-4 text-center">Estado</th>
                            <th class="px-4 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaTipos" class="divide-y divide-gray-100">
                        @foreach($tipos as $item)
                        <tr class="hover:bg-gray-50 transition-colors uppercase">
                            <td class="px-4 sm:px-6 py-4 font-bold text-gray-700 text-xs sm:text-sm">
                                {{ $item->descripcion }}
                            </td>
                            <td class="px-2 py-4 text-center text-gray-600 font-medium">
                                {{ $item->serie }}
                            </td>
                            <td class="px-2 py-4 text-center font-mono text-gray-400">
                                {{ str_pad($item->numero, 8, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-2 py-4 text-center">
                                <span class="px-2 py-1 rounded-md text-[9px] font-black text-white {{ strtolower($item->estado) == 'activo' ? 'bg-[#4ade80]' : 'bg-[#f87171]' }}">
                                    {{ $item->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="editarDocumento({{ json_encode($item) }})" 
                                        class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Editar">
                                        <i class="fas fa-edit text-lg"></i>
                                    </button>
                                    
                                    <button class="btnEliminarDocumento"
                                        data-id="{{ $item->id }}"
                                        data-nombre="{{ $item->descripcion }}">
                                        <i class="fa fa-trash text-red-500"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <aside class="w-full lg:w-80">
            <div class="p-6 rounded-xl text-white shadow-lg h-fit" style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <i class="fa fa-info-circle"></i> Guía Rápida
                </h3>
                <div class="space-y-4 text-xs leading-relaxed text-white/90">
                    <p>Defina las series y correlativos para sus comprobantes de pago.</p>
                    <div class="border-t border-white/20 pt-4">
                        <p class="font-bold uppercase mb-2">Importante:</p>
                        <p>• <b>Correlativo:</b> Punto de partida para la numeración.</p>
                        <p>• <b>Estado:</b> Solo los activos aparecen en el POS.</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<div id="modalDocumento" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div id="modalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
    
    <div class="flex min-h-screen items-center justify-center p-4">
        <div id="modalContent" class="relative transform overflow-visible rounded-[2.5rem] bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-8 pt-12">
            
            <button type="button" id="btnCerrar" class="absolute right-7 top-7 text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-lg"></i>
            </button>

            <div class="flex items-center gap-4 mb-8">
                <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-[#00A3E0] flex items-center justify-center text-white shadow-lg shadow-blue-100"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-file-invoice text-2xl"></i>
                </div>
                
                <div class="pt-1">
                    <h3 id="modalTitle" class="text-xl font-extrabold text-slate-800 leading-none tracking-tight">Nuevo Documento</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1.5">Configuración de Comprobante</p>
                </div>
            </div>

            <form id="formDocumento" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-[10px] font-black text-[#0096D9] uppercase tracking-widest ml-1">
                        <i class="fa fa-file-alt text-[8px]"></i> Descripción del Documento
                    </label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-slate-50 rounded-lg group-focus-within:bg-blue-50 transition-colors">
                            <i class="fa fa-keyboard text-[12px] text-slate-400 group-focus-within:text-[#0096D9]"></i>
                        </div>
                        <input type="text" name="descripcion" id="inputDesc" required 
                            placeholder="EJ: FACTURA ELECTRÓNICA" 
                            class="w-full pl-14 pr-5 py-4 bg-white border-2 border-slate-50 rounded-2xl outline-none focus:border-[#0096D9] font-bold text-slate-700 placeholder:text-slate-200 text-xs transition-all uppercase">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-2 text-[10px] font-black text-[#0096D9] uppercase tracking-widest ml-1">
                            <i class="fa fa-barcode text-[8px]"></i> Serie
                        </label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-slate-50 rounded-lg group-focus-within:bg-blue-50 transition-colors">
                                <i class="fa fa-tag text-[12px] text-slate-400 group-focus-within:text-[#0096D9]"></i>
                            </div>
                            <input type="text" name="serie" id="inputSerie" required placeholder="F001" 
                                class="w-full pl-14 pr-4 py-4 bg-white border-2 border-slate-50 rounded-2xl outline-none focus:border-[#0096D9] font-bold text-slate-700 placeholder:text-slate-200 text-xs transition-all uppercase">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="flex items-center gap-2 text-[10px] font-black text-[#0096D9] uppercase tracking-widest ml-1">
                            <i class="fa fa-list-ol text-[8px]"></i> Nº Actual
                        </label>
                        <div class="relative group">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-slate-50 rounded-lg group-focus-within:bg-blue-50 transition-colors">
                                <i class="fa fa-hashtag text-[12px] text-slate-400 group-focus-within:text-[#0096D9]"></i>
                            </div>
                            <input type="number" name="numero" id="inputNum" required placeholder="0" 
                                class="w-full pl-14 pr-4 py-4 bg-white border-2 border-slate-50 rounded-2xl outline-none focus:border-[#0096D9] font-bold text-slate-700 placeholder:text-slate-200 text-xs transition-all uppercase">
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-[10px] font-black text-[#0096D9] uppercase tracking-widest ml-1">
                        <i class="fa fa-toggle-on text-[8px]"></i> Estado del Documento
                    </label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-slate-50 rounded-lg group-focus-within:bg-blue-50 transition-colors">
                            <i class="fa fa-power-off text-[12px] text-slate-400 group-focus-within:text-[#0096D9]"></i>
                        </div>
                        <select name="estado" id="inputEstado" required 
                            class="w-full pl-14 pr-10 py-4 bg-white border-2 border-slate-50 rounded-2xl outline-none focus:border-[#0096D9] font-bold text-slate-700 appearance-none transition-all uppercase text-xs cursor-pointer">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                        <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-[10px]"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 pt-4">
                    <button type="button" id="btnCancelar" onclick="closeModal()" 
                        class="px-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">
                        SALIR
                    </button>

                    <button type="submit" 
                        class="flex-1 flex items-center justify-center gap-3 py-4 rounded-2xl font-black text-[11px] text-white uppercase tracking-widest shadow-xl shadow-blue-900/20 transition-all active:scale-95 bg-gradient-to-r from-[#001D3D] to-[#003459] hover:brightness-110"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-save text-sm"></i> 
                        GUARDAR DOCUMENTO
                    </button>
                </div>
            </form>
        </div>
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