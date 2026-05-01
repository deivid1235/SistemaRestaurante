@extends('layouts.dashboard')
@section('title', 'Método de Pago')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="flex items-center justify-center w-16 h-16 rounded-full border-2 border-dashed border-white/50 bg-white/10">
                    <i class="fa fa-credit-card text-2xl animate-spin" style="animation-duration: 4s;"></i>
                </div>

                <div>
                    <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                        Métodos de Pago
                    </h1>
                    <p class="text-sm font-light opacity-90 group-hover:translate-x-1 transition-transform duration-500 delay-75">
                        Gestione las formas de cobro (Efectivo, Tarjeta, Yape, Plin, etc).
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/40 rounded-xl font-semibold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left"></i>
                Volver al Menú
            </a>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @php
            $totalMetodoPago = $metodos->count();
            $activos = $metodos->where('estado', 1)->count();
            $inactivos = $metodos->where('estado', 0)->count();

            $divisor = $totalMetodoPago > 0 ? $totalMetodoPago : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center transition-colors duration-300 group-hover:bg-[#00B5E2]">
                <i class="fa fa-boxes text-[#00B5E2] text-xl transition-colors duration-300 group-hover:text-white"></i>
            </div>
            <div class="text-center">
                <p class="text-2xl font-black text-gray-800 leading-none">{{ $totalMetodoPago }}</p>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Total Métodos de Pago</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#00B5E2] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-500 transition-colors duration-300 group-hover:bg-green-500 group-hover:text-white">
                    <i class="fa fa-check-circle text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-black text-gray-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Habilitado</p>
                </div>
                <span class="ml-auto text-[10px] font-bold bg-green-50 text-green-600 px-2 py-0.5 rounded border border-green-100">{{ $porcActivo }}%</span>
            </div>
            <div class="w-full bg-gray-100 h-1 rounded-full overflow-hidden">
                <div class="bg-green-500 h-full transition-all duration-1000" style="width: {{ $porcActivo }}%"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-green-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>

        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center text-red-500 transition-colors duration-300 group-hover:bg-red-500 group-hover:text-white">
                    <i class="fa fa-times-circle text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-black text-gray-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Inhabilitado</p>
                </div>
                <span class="ml-auto text-[10px] font-bold bg-red-50 text-red-600 px-2 py-0.5 rounded border border-red-100">{{ $porcInactivo }}%</span>
            </div>
            <div class="w-full bg-gray-100 h-1 rounded-full overflow-hidden">
                <div class="bg-red-500 h-full transition-all duration-1000" style="width: {{ $porcInactivo }}%"></div>
            </div>
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        

        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden animate-in fade-in slide-in-from-left duration-700">
            <div class="p-5 border-b flex items-center justify-between bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                        <i class="fa fa-list text-[#0096D9]"></i>
                    </div>
                    <h2 class="font-bold text-slate-800 text-lg">Lista de Métodos</h2>
                </div>
                <button onclick="openModal('create')" class="group px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2 active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus-circle group-hover:rotate-90 transition-transform"></i>
                    Nuevo Método
                </button>
            </div>
            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm ml-auto">
                   <input type="text" id="buscador" placeholder="Buscar Metodo de Pago..." class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-[300px]">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[11px] font-black tracking-widest border-b">
                        <tr>
                            <th class="px-6 py-4">Descripción</th>
                            <th class="px-6 py-4">Categoría</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaMetodos" class="divide-y divide-slate-100">
                        @forelse($metodos as $metodo)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4 font-bold text-slate-700 uppercase tracking-tight">{{ $metodo->descripcion }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-slate-500 font-medium uppercase text-xs">
                                    <i class="fa fa-tag text-[10px] opacity-40"></i>
                                    {{ $metodo->tipoPago->descripcion ?? 'GENERAL' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-[10px] font-black rounded-lg uppercase {{ $metodo->estado == 1 ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }}">
                                    {{ $metodo->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-1">
                                    <button onclick='openModal("edit", @json($metodo))' class="p-2 text-blue-400 hover:bg-blue-50 rounded-lg transition-all hover:scale-110">
                                        <i class="fa fa-edit text-lg"></i>
                                    </button>
                                    <button class="btnEliminarMetodoPago"
                                        data-id="{{ $metodo->id }}"
                                        data-nombre="{{ $metodo->descripcion }}">
                                        <i class="fa fa-trash text-red-500"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="py-12 text-center text-slate-400 italic">No hay registros disponibles.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="lg:w-80 animate-in fade-in slide-in-from-right duration-700">
            <div class="bg-[#0096D9] rounded-2xl p-6 text-white shadow-lg sticky top-6 overflow-hidden" style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                <div class="absolute -right-4 -bottom-4 text-white/10 text-8xl -rotate-12">
                    <i class="fa fa-info-circle"></i>
                </div>
                <div class="flex items-center gap-3 mb-4 font-bold text-lg relative z-10">
                    <i class="fa fa-lightbulb"></i> 
                    <span>Información</span>
                </div>
                <p class="text-sm opacity-95 leading-relaxed mb-6 relative z-10">
                    Permite crear tipos de pago que a su vez se le debe asignar una categoría sobre la cual debería reflejarse en los reportes y arqueos de caja.
                </p>
                <div class="border-t border-white/20 pt-4 relative z-10">
                    <h4 class="font-black text-[11px] uppercase tracking-widest mb-3 text-blue-100">Consejos:</h4>
                    <div class="flex gap-2 group">
                        <i class="fa fa-chevron-right text-[10px] mt-1 text-blue-200 group-hover:translate-x-1 transition-transform"></i>
                        <p class="text-xs leading-relaxed">
                            <span class="font-bold text-white">Categorización:</span> Es importante asignar correctamente si es "Efectivo" o "Tarjeta" para que el cierre de caja cuadre.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="paymentModal" class="fixed inset-0 z-50 hidden transition-all duration-300">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px]" onclick="closeModal()"></div>
    
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative transform overflow-hidden rounded-[2.5rem] bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-md">
            
            <div class="px-8 pt-8 pb-6 border-b border-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div id="modalIconContainer" class="flex-shrink-0 w-12 h-12 rounded-2xl bg-[#0096D9] flex items-center justify-center text-white shadow-lg shadow-blue-100">
                        <i id="modalIcon" class="fa fa-credit-card text-xl"></i>
                    </div>
                    <div>
                        <h3 id="modalTitle" class="text-xl font-bold text-slate-800 leading-tight">Nuevo Método de Pago</h3>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Configuración de Cobro</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal()" class="text-slate-300 hover:text-slate-500 transition-colors">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <form id="paymentForm" method="POST" class="p-8 space-y-6">
                @csrf
                <div id="methodField"></div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-tag text-[#0096D9]"></i> Nombre del Método
                    </label>
                    <div class="relative group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <i class="fa fa-keyboard text-slate-300 group-focus-within:text-[#0096D9] transition-colors"></i>
                        </div>
                        <input type="text" name="descripcion" id="inputDescripcion" required 
                            placeholder="EJ: TARJETA CRÉDITO" 
                            class="w-full pl-12 pr-5 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 placeholder:text-slate-300 transition-all uppercase">
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-th-large text-[#0096D9]"></i> Categoría de Pago
                    </label>
                    <div class="relative group">
                        <select name="tipo_pago_id" id="inputTipo" required 
                            class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 appearance-none transition-all uppercase cursor-pointer">
                            <option value="" disabled selected>Seleccione opción</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                            @endforeach
                        </select>
                        <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-slate-500 uppercase tracking-tight ml-1">
                        <i class="fa fa-toggle-on text-[#0096D9]"></i> Estado del Método
                    </label>
                    <div class="relative group">
                        <select name="estado" id="inputEstado" required 
                            class="w-full pl-5 pr-10 py-3.5 bg-white border border-slate-200 rounded-2xl outline-none focus:border-[#0096D9] focus:ring-4 focus:ring-blue-50 font-medium text-slate-600 appearance-none transition-all uppercase cursor-pointer">
                            <option value="1">ACTIVO (En línea)</option>
                            <option value="0">INACTIVO</option>
                        </select>
                        <i class="fa fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-6 pt-4">
                    <button type="button" onclick="closeModal()" 
                        class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors tracking-tight">
                        CANCELAR
                    </button>

                    <button type="submit" 
                        class="flex items-center justify-center gap-3 px-8 py-4 rounded-2xl font-bold text-sm text-white shadow-lg shadow-blue-200 transition-all active:scale-95 bg-[#0096D9] hover:bg-[#0085C2]">
                        <i class="fa fa-save"></i> 
                        GUARDAR CAMBIOS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<button id="btnBackToTop" onclick="scrollToTop()" class="fixed bottom-6 right-6 w-12 h-12 bg-[#0096D9] text-white rounded-full shadow-2xl flex items-center justify-center opacity-0 invisible transition-all duration-300 hover:scale-110 active:scale-90 z-">
    <i class="fa fa-chevron-up"></i>
</button>

<div id="modalEliminar"  class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Método de Pago?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs">Esta acción eliminará el método de pago <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminar" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEliminar').classList.add('hidden')" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

@endsection