@extends('layouts.dashboard')
@section('title', 'Ajustes')
@section('content')

<div class="w-full md:p-8 bg-gray-100 min-h-full transition-all duration-500">
    
    <div class="rounded-t-3xl p-6 text-white shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-4 relative overflow-hidden" 
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        <div class="flex items-center gap-4 z-10">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 transition-transform hover:rotate-6">
                <i class="fa fa-cog text-2xl md:text-3xl text-white"></i>
            </div>
            <div>
                <p class="text-sm opacity-80 font-medium">Ajustes</p>
                <h1 class="text-xl md:text-2xl font-black tracking-tight uppercase">Panel de opciones</h1>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-b-3xl shadow-lg border-t border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-cogs text-orange-500"></i> Sistema
                </div>
                
                <div class="flex flex-col gap-3">
                    <a href="{{ url('/configuracion-inicial') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-400 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-sliders-h"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Configuración inicial</h4>
                            <p class="text-[11px] text-gray-500">Características, opciones, otros.</p>
                        </div>
                    </a>

                    <a href="{{ url('/optimizacion') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-rocket"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Optimización</h4>
                            <p class="text-[11px] text-gray-500">Reducir tiempos y recursos.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.Inpresora.index') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-400 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-print"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Impresoras</h4>
                            <p class="text-[11px] text-gray-500">Creación y modificación.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-building text-blue-600"></i> Empresa
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('admin.Empresa.index') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-hotel"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Datos de empresa</h4>
                            <p class="text-[11px] text-gray-500">Modificar información fiscal.</p>
                        </div>
                    </a>

                    <a href="{{ url('/usuarios-roles') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-user-friends"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Usuarios / Roles</h4>
                            <p class="text-[11px] text-gray-500">Gestión de accesos.</p>
                        </div>
                    </a>

                    <a href="{{ url('/admin/TipoDocumento') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-file-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Tipos de documentos</h4>
                            <p class="text-[11px] text-gray-500">Facturas, boletas, etc.</p>
                        </div>
                    </a>

                    <a id="btnAbrirModal" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Tipos de pago</h4>
                            <p class="text-[11px] text-gray-500">Efectivo, tarjeta, etc.</p>
                        </div>
                    </a>

                    <a href="{{ url('/admin/MetodoPago') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Métodos de pago</h4>
                            <p class="text-[11px] text-gray-500">Gestiona las formas de pago disponibles.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-utensils text-emerald-600"></i> Restaurante
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ url('/cajas') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Cajas</h4>
                            <p class="text-[11px] text-gray-500">Puntos de cobro.</p>
                        </div>
                    </a>

                    <a href="{{ url('/areas-produccion') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-utensils"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Áreas de Producción</h4>
                            <p class="text-[11px] text-gray-500">Cocina, barra, etc.</p>
                        </div>
                    </a>

                    <a href="{{ url('/admin/Salon') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-chair"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Salones y mesas</h4>
                            <p class="text-[11px] text-gray-500">Gestión de espacios.</p>
                        </div>
                    </a>

                    <a href="{{ url('/productos') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-box"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Productos</h4>
                            <p class="text-[11px] text-gray-500">Catálogo de venta.</p>
                        </div>
                    </a>

                    <a href="{{ url('/carta-digital') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-book"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Carta Digital</h4>
                            <p class="text-[11px] text-gray-500">Organización del menú.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="modalPago" class="fixed inset-0 hidden items-center justify-center z-50 transition-all duration-300">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden transform transition-all">
        
        <div class="p-6 text-white flex justify-between items-center" 
             style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/30">
                    <i class="fa fa-credit-card text-lg"></i>
                </div>
                <h2 class="text-xl font-black tracking-tight uppercase">Tipos de Pago</h2>
            </div>
            <button id="btnCerrarModal" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <div class="p-6 bg-gray-50">
            <form id="formTipoPago" action="{{ route('admin.TipoPago.store') }}" method="POST" class="mb-6 group">
                @csrf
                <input type="hidden" name="id" id="tipoPagoId">
                
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1 ml-1">Nuevo Método</label>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <i class="fa fa-edit absolute left-3 top-3.5 text-gray-300 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="text" name="descripcion" id="descripcion"
                            placeholder="Ej: YAPE, PLIN, EFECTIVO"
                            class="w-full pl-10 pr-4 py-3 rounded-2xl border-none ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 bg-white shadow-sm transition-all outline-none text-gray-700"
                            required>
                    </div>
                    <button type="submit" id="btnGuardar"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all active:scale-95 flex items-center gap-2"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-save"></i>
                        <span>Guardar</span>
                    </button>
                </div>
            </form>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="max-h-72 overflow-y-auto custom-scrollbar">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center italic w-16">ID</th>
                                <th class="px-4 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">Descripción</th>
                                <th class="px-4 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($TipoPagos ?? [] as $tipoPago)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-4 py-3 text-xs font-bold text-gray-400 text-center">{{ $tipoPago->id }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-gray-700 uppercase">{{ $tipoPago->descripcion }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <button 
                                            class="btnEditar w-8 h-8 flex items-center justify-center rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-500 hover:text-white transition-all shadow-sm"
                                            data-id="{{ $tipoPago->id }}"
                                            data-descripcion="{{ $tipoPago->descripcion }}">
                                            <i class="fa fa-pen text-xs"></i>
                                        </button>

                                        <button class="btnEliminarTipoPago"
                                            data-id="{{ $tipoPago->id }}"
                                            data-nombre="{{ $tipoPago->descripcion }}">
                                            <i class="fa fa-trash text-red-500"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center">
                                    <i class="fa fa-folder-open text-gray-200 text-3xl mb-2 block"></i>
                                    <span class="text-xs text-gray-400 font-medium">No hay métodos registrados</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalEliminar"  class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Tipo de Pago?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs">Esta acción eliminará el tipo de pago <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
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