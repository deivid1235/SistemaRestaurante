@extends('layouts.dashboard')

@section('title', 'Monitor de Ventas')

@section('content')

<div class="relative space-y-6">
    {{-- BANNER PRINCIPAL: MONITOR DE VENTAS --}}
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                {{-- Ícono animado con radar / monitor --}}
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_4s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-desktop text-2xl animate-pulse"></i>
                    </div>
                </div>

                {{-- Textos informativos --}}
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Monitor de Ventas</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Seguimiento y control analítico de las operaciones comerciales en tiempo real
                    </p>
                </div>
            </div>
        </div>

        {{-- Esfera de fondo decorativa --}}
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            // Cálculos basados en la estructura de tu tabla 'ventas'
            $totalVentas = collect($ventas)->where('estado', 'emitido')->sum('total');
            $totalIgv = collect($ventas)->where('estado', 'emitido')->sum('igv');
            $cantidadVentasTotal = collect($ventas)->count();
            
            $ventasEmitidasCount = collect($ventas)->where('estado', 'emitido')->count();
            $divisor = $cantidadVentasTotal > 0 ? $cantidadVentasTotal : 1;
            
            // Ratio de transacciones confirmadas/emitidas frente al total general
            $porcEmitido = round(($ventasEmitidasCount / $divisor) * 100);
        @endphp

        <!-- Card 1: Total Ventas Recaudadas -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%); color: white;">
                <i class="fas fa-cash-register"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">S/ {{ number_format($totalVentas, 2) }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total Ventas ({{ $ventasEmitidasCount }} comprobantes)</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Card 2: Ratio de Comprobantes Emitidos -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $porcEmitido }}%</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Efectividad de Emisión</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                    Emitidos
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcEmitido }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
        </div>

        <!-- Card 3: Impuesto (IGV 18%) Recaudado -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                    <i class="fas fa-percent"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">S/ {{ number_format($totalIgv, 2) }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Total IGV Protegido</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-amber-50 text-amber-600 px-2 py-0.5 rounded-md border border-amber-100 transition-colors group-hover:bg-amber-500 group-hover:text-white">
                    Impuestos
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                @php
                    // Cálculo de porcentaje de carga de IGV proporcional sobre el total acumulado
                    $porcIgv = $totalVentas > 0 ? round(($totalIgv / $totalVentas) * 100) : 0;
                @endphp
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcIgv > 0 ? $porcIgv : 18 }}%; background: linear-gradient(90deg, #f59e0b, #d97706);"></div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
        <div class="flex-1 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            <input id="buscador" type="text" placeholder="Buscar impresora por nombre..." 
                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-50 outline-none transition-all shadow-sm">
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-3xl shadow-sm border border-gray-100">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-600 uppercase tracking-wider">
                    <th class="py-4 px-6">F. Emisión</th>
                    <th class="py-4 px-5">Documento</th>
                    <th class="py-4 px-5">Cliente</th>
                    <th class="py-4 px-5 text-right">Op. Gravada</th>
                    <th class="py-4 px-5 text-right">IGV (18%)</th>
                    <th class="py-4 px-5 text-right">Total</th>
                    <th class="py-4 px-6 text-center">Estado SUNAT</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-xs font-medium text-gray-700">
                @forelse($ventas as $venta)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        {{-- FECHA EMISIÓN --}}
                        <td class="py-3.5 px-6 font-semibold text-gray-500">
                            {{ \Carbon\Carbon::parse($venta->fecha_emision)->format('Y-m-d H:i') }}
                        </td>
                        
                        {{-- COMPROBANTE (SERIE - CORRELATIVO) --}}
                        <td class="py-3.5 px-5 font-bold text-[#0096D9]">
                            {{ $venta->serie_doc }}-{{ $venta->nro_doc }}
                        </td>

                        {{-- CLIENTE (Con iniciales dinámicas) --}}
                        <td class="py-3.5 px-5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center text-[9px] text-gray-500 font-bold">
                                    {{-- Si tienes la relación cargada usa el nombre, sino por defecto muestra CL --}}
                                    {{ isset($venta->cliente) ? strtoupper(substr($venta->cliente->nombres, 0, 2)) : 'CL' }}
                                </div>
                                <span class="font-semibold text-gray-700">
                                    {{ $venta->cliente->nombres ?? 'Cliente General (ID: '.$venta->id_cliente.')' }}
                                </span>
                            </div>
                        </td>

                        {{-- OP. GRAVADAS --}}
                        <td class="py-3.5 px-5 text-right text-gray-500">
                            S/ {{ number_format($venta->op_gravadas, 2) }}
                        </td>

                        {{-- IGV --}}
                        <td class="py-3.5 px-5 text-right text-gray-500 font-normal">
                            S/ {{ number_format($venta->igv, 2) }}
                        </td>

                        {{-- TOTAL GENERAL --}}
                        <td class="py-3.5 px-5 text-right font-black text-gray-900 text-sm">
                            S/ {{ number_format($venta->total, 2) }}
                        </td>

                        {{-- ESTADO SUNAT --}}
                        <td class="py-3.5 px-6 text-center">
                            @if($venta->estado_sunat === 'aceptado')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Aceptado
                                </span>
                            @elseif($venta->estado_sunat === 'pendiente')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Pendiente
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-600 border border-red-100 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Rechazado
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    {{-- ESTADO VACÍO (Estilo image_dc9848.png) --}}
                    <tr>
                        <td colspan="7" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i class="fa fa-exclamation text-base"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-400">No se encontraron datos</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection