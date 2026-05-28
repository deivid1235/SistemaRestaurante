@extends('layouts.dashboard')
@section('title', 'Apertura de Caja')

@section('content')
<div class="max-w-8xl mx-auto space-y-6 animate-fade-in text-gray-800">
    
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-cash-register text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Apertura de Caja</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Gestione la apertura de caja, registre los montos iniciales y mantenga un control preciso de las transacciones diarias.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('admin.AperturaCaja.create') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-xl text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-xl border border-white/10 uppercase tracking-widest"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-key text-[9px]"></i>
                    NUEVA APERTURA
                </a>
            </div>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $totalAperturas = $aperturas->count();
            $activas = $aperturas->filter(function($item) {
                return $item->estado == 'a' || $item->estado == 'Activo';
            })->count();
            $cerradas = $aperturas->filter(function($item) {
                return $item->estado == 'c' || $item->estado == 'Cerrado';
            })->count();
            
            $divisor = $totalAperturas > 0 ? $totalAperturas : 1;
            $porcActivo = round(($activas / $divisor) * 100);
            $porcCerrado = round(($cerradas / $divisor) * 100);
        @endphp

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%); color: white;">
                <i class="fas fa-cash-register"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ $totalAperturas }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Registros</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-[#0096D9] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-lock-open"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $activas }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Turnos Activos</p>
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

        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $cerradas }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Turnos Cerrados</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 transition-colors group-hover:bg-red-500 group-hover:text-white">
                    {{ $porcCerrado }}%
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcCerrado }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
        </div>
    </div>

    {{-- Buscador y Filtros Segmentados para Aperturas de Caja --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscadorApertura" type="text" placeholder="Buscar impresora por nombre..." 
                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-50 outline-none transition-all shadow-sm">
        </div>

        <div class="w-full md:w-auto md:min-w-[350px]">
            <div class="flex bg-white p-1 rounded-2xl border border-slate-100 shadow-sm">
                <button id="btnTodosApertura" class="flex-1 py-2.5 text-white rounded-xl text-[11px] font-black uppercase tracking-wider transition-all shadow-md shadow-blue-200"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    Todos
                </button>
                <button id="btnActivosApertura" class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Activos
                </button>
                <button id="btnInactivosApertura" class="flex-1 py-2.5 text-slate-400 hover:text-slate-600 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all">
                    Inactivos
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($aperturas as $apertura)
            @php
                $isActivo = ($apertura->estado == 'a' || $apertura->estado == 'Activo');
            @endphp
            
            <div class="card-apertura group  bg-white rounded-2xl border flex flex-col relative overflow-hidden transition-all duration-300 hover:shadow-lg
                {{ $isActivo 
                    ? 'border-emerald-200/80 shadow-sm shadow-emerald-500/[0.03] hover:border-emerald-400/80' 
                    : 'border-rose-200/80 shadow-sm shadow-rose-500/[0.03] hover:border-rose-400/80' }}"
                    data-estado="{{ $isActivo ? 'activo' : 'cerrado' }}">
                
                <div class="absolute left-0 top-0 bottom-0 w-[5px] 
                    {{ $isActivo ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>

                <div class="pt-4 pb-3 px-4 pl-5 flex items-center justify-between border-b border-dashed relative z-10 
                    {{ $isActivo ? 'border-emerald-100 bg-emerald-50/20' : 'border-rose-100 bg-rose-50/20' }}">
                    
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-base shadow-sm border bg-white
                            {{ $isActivo ? 'border-emerald-100 text-emerald-600' : 'border-rose-100 text-rose-600' }}">
                            <i class="fa fa-cash-register"></i>
                        </div>
                        <div class="space-y-0.5">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-black text-slate-800 tracking-tight">ID: {{ $apertura->id }}</span>
                                <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded uppercase tracking-wider
                                    {{ $isActivo ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $apertura->turno->nombre ?? 'Turno: '.$apertura->turno_id }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if($isActivo)
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm shadow-emerald-500/10">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-rose-500 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm shadow-rose-500/10">
                                <i class="fa fa-times-circle text-[11px]"></i>
                                Cerrado
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4 pl-5 flex-1 flex flex-col justify-between space-y-4 relative z-10 bg-white">
                    
                    <div class="flex items-start justify-between gap-2">
                        <div class="space-y-0.5 truncate">
                            <p class="text-[12px] font-bold text-slate-400 uppercase tracking-wider leading-none">Cajero</p>
                            <h2 class="text-sm font-extrabold text-slate-800 uppercase tracking-tight truncate">
                                {{ $apertura->usuario->nombres ?? 'ID: '.$apertura->usuario_id }}
                            </h2>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl text-[11px] font-bold border
                                {{ $isActivo ? 'bg-emerald-50/40 border-emerald-100/60 text-emerald-700' : 'bg-rose-50/40 border-rose-100/60 text-rose-700' }}">
                                <i class="fa fa-desktop text-[10px]"></i>
                                {{ $apertura->caja->nombre ?? 'Caja ID: '.$apertura->caja_id }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-1 text-center border border-slate-100 rounded-xl p-2.5 text-[11px]
                        {{ $isActivo ? 'bg-emerald-50/10 border-emerald-100/60' : 'bg-rose-50/10 border-rose-100/60' }}">
                        <div class="border-r {{ $isActivo ? 'border-emerald-100/60' : 'border-rose-100/60' }}">
                            <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-tight">Aper.</span>
                            <span class="font-extrabold text-slate-700">S/{{ number_format($apertura->monto_apertura, 2) }}</span>
                        </div>
                        <div class="border-r {{ $isActivo ? 'border-emerald-100/60' : 'border-rose-100/60' }}">
                            <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-tight">Sist.</span>
                            <span class="font-bold text-slate-600">S/{{ number_format($apertura->monto_sistema ?? 0, 2) }}</span>
                        </div>
                        <div class="border-r {{ $isActivo ? 'border-emerald-100/60' : 'border-rose-100/60' }}">
                            <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-tight">Cier.</span>
                            <span class="font-bold text-slate-600">S/{{ number_format($apertura->monto_cierre ?? 0, 2) }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-tight">Dif.</span>
                            @if(($apertura->diferencia ?? 0) < 0)
                                <span class="font-black text-rose-600 bg-rose-50 px-1 rounded">
                                    S/{{ number_format($apertura->diferencia ?? 0, 2) }}
                                </span>
                            @elseif(($apertura->diferencia ?? 0) > 0)
                                <span class="font-black text-emerald-600 bg-emerald-50 px-1 rounded">
                                    S/{{ number_format($apertura->diferencia ?? 0, 2) }}
                                </span>
                            @else
                                <span class="font-semibold text-slate-500">0.00</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-[10px] text-slate-400 p-2 rounded-xl border border-slate-100/60
                        {{ $isActivo ? 'bg-emerald-50/10' : 'bg-rose-50/10' }}">
                        <div>
                            <span class="font-medium text-gray-500">Apertura:</span> 
                            <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($apertura->fecha_apertura)->format('d/m/y h:i A') }}</span>
                        </div>
                        @if($apertura->fecha_cierre)
                            <div>
                                <span class="font-medium text-gray-500">Cierre:</span> 
                                <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($apertura->fecha_cierre)->format('d/m/y h:i A') }}</span>
                            </div>
                        @endif
                    </div>

                    @if($apertura->observacion)
                        <div class="text-[10px] text-slate-500 px-2.5 py-1.5 rounded-lg border flex gap-1.5 items-center
                            {{ $isActivo ? 'bg-emerald-50/20 border-emerald-100/60 text-emerald-700' : 'bg-rose-50/20 border-rose-100/60 text-rose-700' }}">
                            <span class="font-bold text-gray-600 flex-shrink-0">Obs:</span>
                            <p class="italic truncate text-slate-600">"{{ $apertura->observacion }}"</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-end pt-3 border-t border-slate-100 gap-2">
                        <a href="{{ route('admin.AperturaCaja.edit', $apertura->id) }}" 
                            class="flex items-center gap-1.5 px-4 py-2 bg-slate-800 text-white font-bold text-xs rounded-lg shadow-sm transition-all hover:bg-slate-900 active:scale-95 uppercase tracking-wide">
                            <i class="fa fa-edit text-[10px]"></i> Editar 
                        </a>
                        <form action="{{ route('admin.AperturaCaja.destroy', $apertura->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button 
                                type="button"
                                class="btn-eliminar w-8 h-8 flex items-center justify-center bg-rose-50 text-rose-500 border border-rose-100 rounded-lg transition-all hover:bg-red-500 hover:text-white active:scale-95 shadow-sm"
                                data-id="{{ $apertura->id }}"
                                data-nombre="{{ $apertura->usuario->nombres ?? 'Registro' }}"
                            >
                                <i class="fa fa-trash text-sm"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-span-full relative overflow-hidden bg-gradient-to-br from-red-50/50 to-white rounded-2xl border border-red-100 p-8 text-center shadow-sm transition-all hover:shadow-md">
                <div class="absolute top-0 left-0 right-0 h-[3px]" style="background: linear-gradient(90deg, #ef4444 0%, #f87171 100%);"></div>
                <div class="relative z-10 max-w-md mx-auto space-y-4">
                    <div class="w-16 h-16 bg-red-50/80 rounded-2xl flex items-center justify-center mx-auto text-red-500 ring-4 ring-red-50/30 border border-red-100 shadow-sm">
                        <div class="w-10 h-10 bg-red-100/70 rounded-xl flex items-center justify-center animate-pulse">
                            <i class="fas fa-cash-register text-lg"></i>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <h3 class="text-base font-black text-slate-800 tracking-tight">
                            Control de Caja Inactivo
                        </h3>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest text-red-500/90">
                            ¡Atención Requerida!
                        </p>
                        <p class="text-xs font-medium text-slate-500 pt-1 leading-relaxed">
                            No se ha detectado ninguna apertura de caja activa para este turno. Debe inicializar el flujo financiero antes de procesar ventas o movimientos.
                        </p>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('admin.AperturaCaja.create') }}" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 border border-red-200/60 rounded-xl text-red-700 text-xs font-bold uppercase tracking-wider transition-all active:scale-95 shadow-sm">
                            <i class="fas fa-plus text-[10px]"></i> Abrir Caja Ahora
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div id="modalEliminarAperturaCaja"
     class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm transition-all">

        <div class="bg-white rounded-2xl w-full max-w-sm overflow-hidden shadow-2xl p-8 text-center border border-gray-100">

            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                <i class="fa fa-trash"></i>
            </div>

            <h3 class="text-lg font-bold text-gray-800">
                ¿Eliminar Apertura de Caja?
            </h3>

            <p class="text-gray-500 mt-2 mb-6 text-xs leading-relaxed">
                Esta acción eliminará
                <span id="delete_nombre" class="font-bold text-red-600"></span>
                y no se puede deshacer.
            </p>

            <form id="formEliminar" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex gap-3">

                    <button type="button"
                            onclick="cerrarModalEliminar()"
                            class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 text-xs transition-all">
                        No, volver
                    </button>

                    <button type="submit"
                            class="flex-1 px-4 py-3 bg-[#e74c3c] text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-100 text-xs transition-all">
                        Sí, eliminar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection