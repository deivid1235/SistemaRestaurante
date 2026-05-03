@extends('layouts.dashboard')

@section('title', 'Cajas')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-cash-register text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">
                            Cajas
                        </h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione las cajas físicas y sus permisos de usuario
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
            $totalCaja = $cajas->count();
            $activos = $cajas->where('estado', 'activo')->count();
            $inactivos = $cajas->where('estado', 'inactivo')->count();

            $divisor = $totalCaja > 0 ? $totalCaja : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center transition-colors duration-300 group-hover:bg-[#00B5E2]">
                <i class="fa fa-boxes text-[#00B5E2] text-xl transition-colors duration-300 group-hover:text-white"></i>
            </div>
            <div class="text-center">
                <p class="text-2xl font-black text-gray-800 leading-none">{{ $totalCaja }}</p>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mt-1">Total Cajas</p>
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

    <div class="flex flex-col lg:flex-row gap-4">
        <div class="flex-1 bg-white rounded-[1.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center shadow-sm"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-cash-register text-white text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800 leading-none">Puntos de Venta</h2>
                        <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider mt-1">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-500 mr-1"></span> Gestión de accesos
                        </p>
                    </div>
                </div>

                <button onclick="abrirModalCrear()"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-sm"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus text-[9px]"></i>
                    NUEVA CAJA
                </button>
            </div>

            <div class="px-5 py-4 bg-gray-50/30">
                <div class="relative flex max-w-sm ml-auto">
                   <input type="text" id="buscador" placeholder="Buscar Caja..." class="w-full border border-gray-200 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400">
                    <button class="bg-white border border-l-0 border-gray-200 rounded-r-md px-3 text-gray-400">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto px-6 pb-4">
                <table  class="w-full">
                    <thead>
                        <tr class="text-slate-400 text-[9px] uppercase font-black tracking-widest border-b border-slate-50">
                            <th class="px-4 py-3 text-left font-black">Información de Caja</th>
                            <th class="px-4 py-3 text-center font-black">Estado Operativo</th>
                            <th class="px-4 py-3 text-left font-black">Usuario</th>
                            <th class="px-4 py-3 text-right font-black">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCaja" class="text-xs">
                        @forelse($cajas as $caja)
                        <tr class="group border-b border-slate-50/50 hover:bg-slate-50/50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 font-bold text-[10px]">
                                        {{ substr($caja->nombre, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-700 uppercase tracking-tight">{{ $caja->nombre }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($caja->estado === 'activo')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-emerald-100">
                                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 text-[9px] font-bold px-2 py-1 rounded-md uppercase border border-slate-200">
                                        <span class="w-1 h-1 rounded-full bg-slate-400"></span>
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($caja->usuarios as $usuario)
                                        <span class="px-2 py-1 text-[10px] font-bold bg-blue-50 text-blue-600 rounded-md border border-blue-100">
                                            {{ $usuario->name ?? $usuario->nombre ?? $usuario->nombre_completo }}
                                        </span>
                                    @empty
                                        <span class="text-[10px] text-slate-400 font-bold uppercase">
                                            Sin usuarios
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="abrirModalUsuarios({{ $caja->id }}, '{{ $caja->nombre }}')"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-slate-900 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                        <i class="fa fa-users text-[10px]"></i>
                                    </button>
                                    <button onclick="abrirModalEditar({{ $caja->id }}, '{{ $caja->nombre }}', '{{ $caja->estado }}')"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all shadow-sm">
                                        <i class="fa fa-edit text-[10px]"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-10 text-center text-slate-300 font-bold uppercase text-[10px] tracking-widest">
                                No se encontraron registros
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 bg-slate-50/30 border-t border-slate-50 flex items-center justify-between">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                    Total: <span class="text-slate-700">{{ $cajas->total() }}</span> registros
                </p>
                <div class="pagination-compact">
                    {{ $cajas->links() }}
                </div>
            </div>
        </div>
        <div class="lg:w-72 rounded-[1.5rem] p-6 text-white shadow-sm self-start border border-white/10" 
            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
            
            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center shadow-sm">
                    <i class="fa fa-lightbulb text-white text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-tight leading-none">Información</h3>
                    <p class="text-[8px] uppercase tracking-widest text-white/70 font-bold mt-1">Ayuda rápida</p>
                </div>
            </div>

            <p class="text-white/80 text-[11px] leading-relaxed mb-5 border-b border-white/10 pb-5 font-medium">
                Gestione de manera independiente los <strong class="text-white">Arqueos de Caja</strong> por cada punto de venta cobro físico.
            </p>

            <p class="font-black text-[9px] uppercase tracking-widest text-white/60 mb-4">Tips:</p>
            
            <ul class="space-y-3">
                <li class="flex items-start gap-2.5">
                    <div class="mt-1 w-3.5 h-3.5 rounded bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-check text-[7px] text-white"></i>
                    </div>
                    <span class="text-white/90 text-[10.5px] leading-tight">Cree una caja por cada terminal físico (Barra, Salón).</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <div class="mt-1 w-3.5 h-3.5 rounded bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-user text-[7px] text-white"></i>
                    </div>
                    <span class="text-white/90 text-[10.5px] leading-tight">Limite el acceso de usuarios a cajas específicas.</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="modalCrear" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">
        
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100" 
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-cash-register text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Nueva Caja</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Configuración de Punto de Venta</p>
                </div>
            </div>
            <button onclick="cerrarModalCrear()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form action="{{ route('admin.Caja.store') }}" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre de la Caja
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" required placeholder="EJ: CAJA PRINCIPAL"
                        class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado de la Caja
                </label>
                <div class="relative group">
                    <select name="estado" 
                        class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO (En línea)</option>
                        <option value="inactivo">INACTIVO (Cerrada)</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalCrear()" 
                    class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                
                <button type="submit" 
                    class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-save text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Guardar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditar" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100" 
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-edit text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Editar Caja</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Modificar Punto de Venta</p>
                </div>
            </div>
            <button onclick="cerrarModalEditar()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <form id="formEditar" action="" method="POST" class="p-6 pt-4 space-y-5">
            @csrf
            @method('PUT')
            
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-tag text-blue-400 text-[7px]"></i> Nombre de la Caja
                </label>
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa fa-keyboard text-xs"></i>
                    </div>
                    <input type="text" name="nombre" id="edit_nombre" required placeholder="Nombre de la caja..."
                        class="w-full bg-white border border-slate-100 p-3.5 pl-11 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm transition-all placeholder:text-slate-200 uppercase">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-toggle-on text-blue-400 text-[7px]"></i> Estado actual
                </label>
                <div class="relative group">
                    <select name="estado" id="edit_estado"
                        class="w-full bg-white border border-slate-100 p-3.5 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-sm appearance-none cursor-pointer transition-all">
                        <option value="activo">ACTIVO (En línea)</option>
                        <option value="inactivo">INACTIVO (Cerrada)</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs">
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 gap-2">
                <button type="button" onclick="cerrarModalEditar()" 
                    class="px-4 py-2 text-slate-400 font-bold text-[10px] hover:text-slate-600 transition-colors uppercase tracking-[0.15em]">
                    Cancelar
                </button>
                
                <button type="submit" 
                    class="flex items-center gap-3 px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-100 text-white transition-all active:scale-95"
                   style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                        <i class="fa fa-sync-alt text-[10px] text-white"></i>
                    </div>
                    <span class="uppercase tracking-widest text-[11px]">Actualizar Cambios</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalUsuarios" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-all duration-300 p-4">
    <div class="bg-white w-full max-w-[380px] rounded-[2rem] shadow-2xl overflow-hidden border border-white/20 animate-in zoom-in duration-200">
        
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shadow-md shadow-blue-100" 
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-users text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-[#1E293B] font-bold text-lg tracking-tight leading-none">Usuarios</h3>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Accesos de Caja</p>
                </div>
            </div>
            <button onclick="cerrarModalUsuarios()" class="text-slate-300 hover:text-slate-500 transition-colors">
                <i class="fa fa-times text-sm"></i>
            </button>
        </div>

        <div class="p-6 pt-4 space-y-5">
            
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[9px] font-black uppercase text-slate-400 tracking-widest ml-1">
                    <i class="fa fa-user-plus text-blue-400 text-[7px]"></i> Asignar nuevo acceso
                </label>
                <div class="flex gap-2">
                    <div class="relative flex-1 group">
                        <select id="selectUsuarioAñadir" 
                            class="w-full bg-white border border-slate-100 p-3 rounded-xl focus:border-blue-400 outline-none font-bold text-slate-500 text-xs appearance-none cursor-pointer transition-all">
                            <option value="">Buscar usuario...</option>
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-[10px]">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <button onclick="añadirUsuario()" 
                        class="w-11 h-11 flex items-center justify-center bg-green-500 text-white rounded-xl shadow-lg shadow-green-100 hover:scale-105 active:scale-95 transition-all"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-plus text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="bg-slate-50/50 border border-slate-100 rounded-2xl overflow-hidden">
                <div class="max-h-[200px] overflow-y-auto">
                    <table class="w-full text-sm">
                        <tbody id="tablaUsuariosAsignados" class="divide-y divide-slate-100">
                            <tr>
                                <td class="px-4 py-6 text-center text-slate-400 font-bold text-[10px] uppercase tracking-widest">
                                    <i class="fa fa-spinner fa-spin mr-2"></i> Cargando...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <form id="formUsuarios" action="" method="POST" class="hidden">
                @csrf
                <div id="inputsUsuariosHidden"></div>
            </form>

            <button onclick="cerrarModalUsuarios()" 
                class="w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-white font-extrabold text-xs tracking-widest shadow-xl shadow-blue-200 hover:brightness-110 active:scale-[0.98] transition-all"
                style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center">
                    <i class="fa fa-check text-[10px] text-white"></i>
                </div>
                LISTO / CERRAR
            </button>
        </div>
    </div>
</div>



@endsection