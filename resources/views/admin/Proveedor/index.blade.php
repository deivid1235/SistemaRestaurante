@extends('layouts.dashboard')
@section('title', 'Proveedores')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5">
            <div class="flex items-center gap-4 w-full">
                
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                </div>
                <div class="text-left">
                    <h1 class="text-xl sm:text-2xl font-extrabold leading-tight">
                        Proveedores
                    </h1>
                    <p class="text-sm opacity-90">
                        Gestiona tus proveedores y contactos.
                    </p>
                </div>

            </div>
            <div class="w-full sm:w-auto">
                <a href="{{ route('admin.Proveedor.create') }}"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-white font-bold text-xs transition-all hover:opacity-90 active:scale-95 shadow-lg border border-white/10 uppercase tracking-wider"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    
                    <i class="fa fa-user-plus text-[10px]"></i>
                    Nuevo
                </a>
            </div>

        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @php
            $totalProveedores = $proveedores->count();
            $activos = $proveedores->where('estado', 'a')->count();
            $inactivos = $proveedores->where('estado', 'i')->count();
            $nuevosMes = $proveedores->where('created_at', '>=', now()->startOfMonth())->count();

            $divisor = $totalProveedores > 0 ? $totalProveedores : 1;
            $porcActivo = round(($activos / $divisor) * 100);
            $porcInactivo = round(($inactivos / $divisor) * 100);
        @endphp

        {{-- Widget: Total Proveedores --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%); color: white;">
                <i class="fa fa-truck"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalProveedores }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Proveedores</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-slate-800 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        {{-- Widget: Proveedores Activos --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Proveedores Activos</p>
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

        {{-- Widget: Proveedores Inactivos --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-ban"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $inactivos }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Proveedores Inactivos</p>
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

        {{-- Widget: Nuevos este Mes --}}
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-sm transition-transform duration-500 group-hover:scale-110"
                style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); color: white;">
                <i class="fa fa-boxes"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $nuevosMes }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Nuevos (Mes)</p>
            </div>
            <div class="absolute top-2 right-2">
                <div class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input id="buscador" type="text" placeholder="Buscar cliente por nombre..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-50 outline-none transition-all shadow-sm">
                </div>

                <div class="w-full md:w-auto md:min-w-[350px]">
            <div class="flex bg-white p-1 rounded-2xl border border-slate-100 shadow-sm">

                <button id="btnTodosClientes"
                    class="flex-1 py-2.5 text-white rounded-xl text-[11px] font-black uppercase tracking-wider transition-all shadow-md shadow-blue-200"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    Todos
                </button>

                <button id="btnActivosClientes"
                    class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Activos
                </button>

                <button id="btnInactivosClientes"
                    class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Inactivos
                </button>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($proveedores as $proveedor)
        <div class="area-card group bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col sm:flex-row h-auto sm:h-48"
            data-estado="{{ $proveedor->estado }}">
            
            <div class="relative w-full sm:w-32 flex-shrink-0 bg-slate-50 flex items-center justify-center border-b sm:border-b-0 sm:border-r border-slate-100 py-6 sm:py-0">
                <div class="absolute top-2 left-2 z-10">
                    <span class="px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-wider text-white shadow-sm {{ $proveedor->estado == 'a' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                        {{ $proveedor->estado == 'a' ? 'ACTIVO' : 'INACTIVO' }}
                    </span>
                </div>

                <div class="w-20 h-20 rounded-2xl {{ $proveedor->tipo_documento == 'RUC' ? 'bg-sky-600' : 'bg-slate-800' }} shadow-md flex items-center justify-center border-2 border-white overflow-hidden group-hover:scale-105 transition-transform duration-500">
                    <span class="text-4xl font-black text-white uppercase">
                        {{ substr($proveedor->razon_social, 0, 1) }}
                    </span>
                </div>

                <div class="absolute bottom-2 right-2 left-2 text-center hidden sm:block">
                    <span class="bg-slate-900 text-white text-[9px] font-black px-2 py-1 rounded-md shadow-sm block truncate">
                        {{ $proveedor->tipo_documento }}: {{ $proveedor->numero }}
                    </span>
                </div>
            </div>

            <div class="flex-1 p-4 flex flex-col justify-between min-w-0 gap-3 sm:gap-0">
                <div>
                    <div class="flex justify-between items-start gap-2">
                        <div class="min-w-0">
                            <h3 class="text-[13px] font-black text-slate-800 uppercase leading-tight truncate">
                                {{ $proveedor->razon_social }}
                            </h3>
                            <span class="inline-block sm:hidden bg-slate-900 text-white text-[9px] font-black px-1.5 py-0.5 rounded mt-1">
                                {{ $proveedor->tipo_documento }}: {{ $proveedor->numero }}
                            </span>
                            
                            @if($proveedor->contacto)
                            <p class="text-[10px] text-sky-600 font-black uppercase mt-1 truncate">
                                <i class="fas fa-user-tie mr-1"></i>Contacto: {{ $proveedor->contacto }}
                            </p>
                            @else
                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">
                                Sin Asesor Comercial
                            </p>
                            @endif
                        </div>
                        <span class="text-[9px] font-black {{ $proveedor->tipo_documento == 'RUC' ? 'text-amber-600 bg-amber-50 border-amber-100' : 'text-purple-600 bg-purple-50 border-purple-100' }} px-2 py-0.5 rounded-lg border shrink-0">
                            {{ $proveedor->tipo_documento == 'RUC' ? 'EMPRESA' : 'NATURAL' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-1.5 mt-3">
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="fa fa-phone text-[10px] text-emerald-500 w-3 text-center"></i>
                            <span class="text-[10px] text-slate-700 font-bold">{{ $proveedor->telefono ?? 'Sin Teléfono' }}</span>
                        </div>
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="fa fa-envelope text-[10px] text-sky-500 w-3 text-center"></i>
                            <span class="text-[10px] text-slate-600 font-medium truncate">{{ $proveedor->email ?? 'Sin Correo' }}</span>
                        </div>
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="fa fa-map-marker-alt text-[10px] text-rose-500 w-3 text-center"></i>
                            <span class="text-[10px] text-slate-500 truncate italic">{{ $proveedor->direccion ?? 'Sin Dirección Fiscal' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-2 pt-2 border-t border-slate-100">
                    <p class="text-[9px] text-slate-400 font-black tracking-tighter">
                        ID PROVEEDOR: #{{ str_pad($proveedor->id, 4, '0', STR_PAD_LEFT) }}
                    </p>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.Proveedor.edit', $proveedor->id) }}"
                            class="h-7 px-3 flex items-center gap-1.5 text-white rounded-xl transition-all active:scale-95 shadow-md shadow-blue-100"
                            style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%);">
                            <i class="fas fa-edit text-[9px]"></i>
                            <span class="text-[9px] font-black uppercase">Gestionar</span>
                        </a>

                        <button class="btnEliminarProveedor w-7 h-7 flex items-center justify-center rounded-xl bg-slate-50 text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-50 flex-shrink-0"
                            data-id="{{ $proveedor->id }}" 
                            data-nombre="{{ $proveedor->nombre }}">
                            <i class="fa fa-trash text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

{{--Modal de elimiar--}}
<div id="modalEliminarProveedor" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">
    <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
            <i class="fa fa-trash"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">¿Eliminar Proveedor?</h3>
        <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">Esta acción eliminará <span id="delete_nombre" class="font-bold text-red-600"></span> y no se puede deshacer.</p>
        <form id="formEliminarProveedor" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEliminarProveedor').classList.add('hidden')" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">No, volver</button>
                <button type="submit" class="flex-1 px-4 py-3 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>



@endsection