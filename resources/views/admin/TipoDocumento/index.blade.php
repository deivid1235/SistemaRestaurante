@extends('layouts.dashboard')
@section('title', 'Documentos Fiscales')

@section('content')
<div class="p-2 sm:p-6 space-y-4 sm:space-y-6">
    
    <div class="relative overflow-hidden rounded-xl sm:rounded-2xl p-5 sm:p-8 text-white shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Documentos Fiscales</h1>
                <p class="text-white/90 mt-1 text-sm sm:text-base font-medium">Configure series y numeración de facturación.</p>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                <i class="fas fa-undo-alt text-sm"></i>
                Volver al Menú
            </a>
        </div>
        <div class="absolute top-[-20%] right-[-10%] w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
        
        <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="p-4 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                
                <div class="flex-1 max-w-2xl">
                    <form method="GET" action="{{ route('admin.TipoDocumento.index') }}" class="flex gap-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </span>
                            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar documento..."
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl bg-white text-sm focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 rounded-xl font-bold shadow-sm transition-all active:scale-95 sm:hidden">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <button id="btnNuevo" class="bg-[#4ade80] hover:bg-[#22c55e] text-white px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 transition-all font-bold shadow-sm active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Nuevo Tipo</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-[10px] sm:text-[11px] text-gray-400 uppercase bg-gray-50/50 font-bold border-b">
                        <tr>
                            <th class="px-4 sm:px-6 py-4">Descripción</th>
                            <th class="px-2 py-4 text-center">Serie</th>
                            <th class="px-2 py-4 text-center">Nº Actual</th>
                            <th class="px-2 py-4 text-center">Estado</th>
                            <th class="px-4 py-4 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($tipos as $item)
                        <tr class="hover:bg-gray-50 transition-colors uppercase">
                            <td class="px-4 sm:px-6 py-4 font-bold text-gray-700 text-xs sm:text-sm">{{ $item->descripcion }}</td>
                            <td class="px-2 py-4 text-center text-gray-600 font-medium">{{ $item->serie }}</td>
                            <td class="px-2 py-4 text-center font-mono text-gray-400">{{ str_pad($item->numero, 8, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-2 py-4 text-center">
                                <span class="px-2 py-1 rounded-md text-[9px] font-black text-white {{ strtolower($item->estado) == 'activo' ? 'bg-[#4ade80]' : 'bg-[#f87171]' }}">
                                    {{ $item->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <button onclick="editarDocumento({{ json_encode($item) }})" class="text-blue-500 hover:text-blue-700 p-2 transition-colors">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
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

<div id="modalDocumento" class="fixed inset-0 z-50 hidden items-center justify-center p-2 sm:p-4 transition-all duration-300">
    <div id="modalOverlay" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
    
    <div id="modalContent" class="bg-white rounded-[2rem] sm:rounded-[2.5rem] shadow-2xl w-full max-w-md relative z-10 overflow-hidden scale-90 opacity-0 transition-all duration-300">
        <div class="p-6 text-white flex justify-between items-center" style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
            <h2 id="modalTitle" class="text-xl font-bold">Nuevo Documento</h2>
            <button id="btnCerrar" class="p-2 hover:bg-white/20 rounded-full transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="formDocumento" method="POST" class="p-6 sm:p-8 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            
            <div class="group">
                <label class="text-[11px] font-bold text-gray-500 uppercase ml-1 mb-1 block">Descripción</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-gray-400 group-focus-within:text-blue-500">
                        <i class="fas fa-file-alt text-lg"></i>
                    </div>
                    <input type="text" name="descripcion" id="inputDesc" required 
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-4 outline-none font-semibold text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
                        placeholder="Ej: Factura Electrónica">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="group">
                    <label class="text-[11px] font-bold text-gray-500 uppercase ml-1 mb-1 block">Serie</label>
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-gray-400 group-focus-within:text-blue-500">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <input type="text" name="serie" id="inputSerie" required 
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-4 outline-none font-semibold text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
                            placeholder="F001">
                    </div>
                </div>
                <div class="group">
                    <label class="text-[11px] font-bold text-gray-500 uppercase ml-1 mb-1 block">Nº Actual</label>
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-gray-400 group-focus-within:text-blue-500">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input type="number" name="numero" id="inputNum" required 
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-4 outline-none font-semibold text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
                            placeholder="0">
                    </div>
                </div>
            </div>

            <div class="group">
                <label class="text-[11px] font-bold text-gray-500 uppercase ml-1 mb-1 block">Estado</label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-gray-400 pointer-events-none">
                        <i class="fas fa-toggle-on text-lg"></i>
                    </div>
                    <select name="estado" id="inputEstado" 
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-10 outline-none font-semibold text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all appearance-none cursor-pointer">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select>
                    <div class="absolute right-4 text-gray-400 pointer-events-none">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 text-white rounded-2xl py-4 font-bold shadow-lg active:scale-95 transition-all flex items-center justify-center gap-2" style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fas fa-save text-lg"></i> Guardar
                </button>
                <button type="button" id="btnCancelar" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 rounded-2xl py-4 font-bold transition-all text-center">
                    Salir
                </button>
            </div>
        </form>
    </div>
</div>
@endsection