@extends('layouts.dashboard')
@section('title', 'Gestión de Impresoras')

@section('content')
<div class="relative space-y-6">
    
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner animate-[spin_5s_linear_infinite]">
                        <i class="fa fa-print text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Gestión de Impresoras
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Administre los puntos de impresión del restaurante
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @php
            $totalImp = $impresoras->count();
            $activos = $impresoras->where('estado', 'activo')->count();
            $inactivos = $impresoras->where('estado', 'inactivo')->count();
            
            $divisor = $totalImp > 0 ? $totalImp : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center transition-colors duration-300 group-hover:bg-[#00B5E2]">
                <i class="fa fa-boxes text-[#00B5E2] text-xl transition-colors duration-300 group-hover:text-white"></i>
            </div>
            <div class="text-center">
                <p class="text-2xl font-black text-gray-800 leading-none">{{ $totalImp }}</p>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Total Impresoras</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
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
                <button id="btnNueva" data-url="{{ route('admin.Inpresora.store') }}" 
                    class="text-white px-6 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 transition-all shadow-md active:scale-95" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Nueva Impresora
                </button>
            </div>

            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm mx-auto md:ml-auto md:mr-0">
                   <input type="text" id="buscador" placeholder="Buscar impresora..." class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-[300px]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-y border-gray-100 sticky top-0 z-20">
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
                                    <button class="btnEliminarImpresora text-red-500 hover:text-red-700"
                                        data-id="{{ $imp->id }}"
                                        data-nombre="{{ $imp->nombre }}">
                                        <i class="fa fa-trash text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                            <i class="fa fa-cog text-[#00B5E2]"></i> Opciones de Ticket
                        </h4>
                        <p class="text-[10px] text-gray-400 mt-0.5">Formatos de hardware</p>
                    </div>
                </div>
                
                <div class="px-5 py-3 divide-y divide-gray-50">
                    @php
                        $formatos = [
                            ['id' => 't80', 'nombre' => 'Ticket 80mm', 'desc' => 'Estándar térmico industrial', 'icon' => 'fa-receipt', 'activo' => true],
                            ['id' => 't58', 'nombre' => 'Ticket 58mm', 'desc' => 'Térmico pequeño', 'icon' => 'fa-print', 'activo' => false],
                            ['id' => 'pdf', 'nombre' => 'PDF / A4', 'desc' => 'Documento digital', 'icon' => 'fa-file-pdf', 'activo' => false],
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
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2ECC71]"></div>
                        </label>
                    </div>
                    @endforeach

                    <div class="pt-4 pb-1">
                        <button class="w-full text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition-all shadow-md active:scale-[0.97] text-sm"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            <i class="fa fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100 mx-4">
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
                <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" 
                    class="flex-1 px-6 py-3.5 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all active:scale-95 text-sm">
                    CANCELAR
                </button>
                <button type="submit" class="flex-[1.5] text-white px-8 py-3.5 rounded-2xl font-bold shadow-xl shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> GUARDAR CAMBIOS
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEliminar" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Impresora?</h3>
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