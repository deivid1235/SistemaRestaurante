@extends('layouts.dashboard')

@section('title', 'Ingresos')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-chart-line text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Ingresos</h1>
                    </div>
                    <p class="text-base font-light opacity-90 mt-1">
                        Visualice el flujo de ingresos económicos y las estadísticas del sistema
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <!-- Botón Nueva Inversión -->
                <button id="btnNuevoIngreso" data-url="{{ route('admin.Ingresos.store') }}" 
                    class="flex-1 md:flex-none text-white px-8 py-3 rounded-full font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-lg active:scale-95 border border-white/20 hover:brightness-110" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-plus"></i> Nuevo Ingreso
                </button>
                <!-- Botón Volver al Menú -->
                <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                    class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                    <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
                </a>
            </div>

        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @php
            $totalIngresos = collect($ingresos)->where('estado', 'A')->sum('importe');
            $ingresosAnulados = collect($ingresos)->where('estado', 'I')->sum('importe');
            $transaccionesTotal = collect($ingresos)->count();
            
            $montoBase = $totalIngresos + $ingresosAnulados;
            $divisor = $montoBase > 0 ? $montoBase : 1;
            
            $porcActivo = round(($totalIngresos / $divisor) * 100);
            $porcInactivo = round(($ingresosAnulados / $divisor) * 100);
        @endphp

        <!-- Card 1: Total Ingresos Efectivos -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0096D9 100%); color: white;">
                <i class="fas fa-wallet"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800 leading-none">S/ {{ number_format($totalIngresos, 2) }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Ingresos Efectivos ({{ collect($ingresos)->where('estado', 'A')->count() }} trans.)</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </div>

        <!-- Card 2: Ingresos Activos / Validados -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:rotate-12"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">{{ $porcActivo }}%</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Ratio de Efectividad</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md border border-emerald-100 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                    Activos
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcActivo }}%; background: linear-gradient(90deg, #10B981, #059669);"></div>
            </div>
        </div>

        <!-- Card 3: Ingresos Anulados / Inactivos -->
        <div class="group relative bg-white p-4 rounded-2xl shadow-sm border border-slate-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shadow-sm transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, #EF4444 0%, #B91C1C 100%); color: white;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800 leading-none">S/ {{ number_format($ingresosAnulados, 2) }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-1">Monto Anulado ({{ $porcInactivo }}%)</p>
                </div>
                <span class="ml-auto text-[9px] font-black bg-red-50 text-red-600 px-2 py-0.5 rounded-md border border-red-100 transition-colors group-hover:bg-red-500 group-hover:text-white">
                    Inactivos
                </span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-1000 group-hover:animate-pulse" 
                    style="width: {{ $porcInactivo }}%; background: linear-gradient(90deg, #EF4444, #B91C1C);"></div>
            </div>
        </div>
    </div>

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

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden w-full">
   
    {{-- Contenedor de la Tabla Responsiva --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-600 uppercase tracking-wider">
                    <th class="py-4 px-6">F. Reg.</th>
                    <th class="py-4 px-5">Responsable</th>
                    <th class="py-4 px-5">Motivo / Concepto</th>
                    <th class="py-4 px-5 text-right">Importe</th>
                    <th class="py-4 px-5 text-center">Estado</th>
                    <th class="py-4 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-xs font-medium text-gray-700">
                @forelse($ingresos as $ingreso)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        {{-- FECHA REGISTRO --}}
                        <td class="py-3.5 px-6 font-semibold text-gray-500">
                            {{ \Carbon\Carbon::parse($ingreso->fecha_reg)->format('Y-m-d H:i') }}
                        </td>
                        
                        {{-- RESPONSABLE --}}
                        <td class="py-3.5 px-5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-blue-50 rounded-full flex items-center justify-center text-[10px] text-[#0096D9] font-bold">
                                    {{ strtoupper(substr($ingreso->responsable, 0, 2)) }}
                                </div>
                                <span>{{ $ingreso->responsable }}</span>
                            </div>
                        </td>

                        {{-- MOTIVO --}}
                        <td class="py-3.5 px-5 max-w-xs truncate text-gray-600 font-normal">
                            {{ $ingreso->motivo }}
                        </td>

                        {{-- IMPORTE --}}
                        <td class="py-3.5 px-5 text-right font-bold text-gray-900">
                            S/ {{ number_format($ingreso->importe, 2) }}
                        </td>

                        {{-- ESTADO (Badge Minimalista) --}}
                        <td class="py-3.5 px-5 text-center">
                            @if($ingreso->estado === 'A')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Activo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-600 border border-red-100 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Anulado
                                </span>
                            @endif
                        </td>

                        {{-- ACCIONES --}}
                        <td class="py-3.5 px-6 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick="editarIngreso({{ $ingreso->id }})" title="Editar"
                                    class="text-white px-3 py-2 rounded-full flex items-center justify-center gap-1 text-xs font-bold shadow-md transition-all active:scale-95 hover:brightness-110 border border-white/20"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                    
                                    <i class="fa fa-pen text-[11px]"></i>
                                </button>
                                <button onclick="eliminarIngreso({{ $ingreso->id }})" title="Anular/Borrar"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all active:scale-90">
                                    <i class="fa fa-trash text-[11px]"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    {{-- ESTADO VACÍO (Copia fiel de la ilustración del usuario) --}}
                    <tr>
                        <td colspan="6" class="py-16 text-center">
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




<div id="modalIngreso" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xl overflow-hidden transform transition-all border border-gray-100 mx-4">
        
        {{-- CABECERA DEL MODAL --}}
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-wallet text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight leading-none">Nuevo Ingreso</h2>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Transacciones de caja</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('modalIngreso').classList.add('hidden')" 
                class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <i class="fa fa-times"></i>
            </button>
        </div>

        {{-- FORMULARIO CON FILAS DE 2 EN 2 --}}
        <form method="POST" action="{{ route('admin.Ingresos.store') }}" class="p-8 space-y-5">
            @csrf
            
            {{-- FILA 1: CAJA Y RESPONSABLE (Lectura) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-cash-register text-[#0096D9]"></i> Caja Afectada
                    </label>
                    <div class="relative">
                        <input type="text" value="{{ $apertura->caja->nombre ?? 'Sin caja' }}" readonly
                            class="w-full border-2 border-gray-100 bg-gray-50/70 rounded-2xl p-3.5 pl-11 outline-none transition-all font-medium text-gray-500 cursor-not-allowed">
                        <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    </div>
                </div>

                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-user text-[#0096D9]"></i> Responsable
                    </label>
                    <div class="relative">
                        <input type="text" value="{{ Auth::user()->nombres ?? Auth::user()->name }}" readonly
                            class="w-full border-2 border-gray-100 bg-gray-50/70 rounded-2xl p-3.5 pl-11 outline-none transition-all font-medium text-gray-500 cursor-not-allowed">
                        <i class="fa fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    </div>
                </div>
            </div>

            {{-- FILA 2: IMPORTE Y FECHA --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-money-bill-wave text-[#0096D9]"></i> Importe (S/)
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" name="importe" required
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#0096D9] outline-none transition-all font-semibold text-gray-700 placeholder:text-gray-300" 
                            placeholder="0.00">
                        <i class="fa fa-coins absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#0096D9] transition-colors"></i>
                    </div>
                </div>

                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-calendar text-[#0096D9]"></i> Fecha de Registro
                    </label>
                    <div class="relative">
                        <input type="datetime-local" name="fecha_reg" value="{{ now()->format('Y-m-d\TH:i') }}" required
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#0096D9] outline-none transition-all font-medium text-gray-700">
                        <i class="fa fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#0096D9] transition-colors"></i>
                    </div>
                </div>
            </div>

            {{-- FILA 3: MOTIVO Y ESTADO --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-comment-alt text-[#0096D9]"></i> Motivo / Concepto
                    </label>
                    <div class="relative">
                        <input type="text" name="motivo" required
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#0096D9] outline-none transition-all font-medium text-gray-700 placeholder:text-gray-300" 
                            placeholder="Ej: Aporte inicial">
                        <i class="fa fa-pen absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#0096D9] transition-colors"></i>
                    </div>
                </div>

                <div class="group space-y-1.5">
                    <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                        <i class="fa fa-toggle-on text-[#0096D9]"></i> Estado
                    </label>
                    <div class="relative">
                        <select name="estado" 
                            class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#0096D9] outline-none transition-all appearance-none bg-white font-medium text-gray-700">
                            <option value="A">ACTIVO (Válido)</option>
                            <option value="I">INACTIVO (Anulado)</option>
                        </select>
                        <i class="fa fa-check-circle absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#0096D9] transition-colors"></i>
                        <i class="fa fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none text-xs"></i>
                    </div>
                </div>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-50">
                <button type="button" onclick="document.getElementById('modalIngreso').classList.add('hidden')" 
                    class="px-6 py-3.5 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all active:scale-95 text-sm">
                    CANCELAR
                </button>
                <button type="submit" class="px-8 py-3.5 text-white text-sm rounded-2xl font-bold shadow-xl shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> GUARDAR INGRESO
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnAbrir = document.getElementById('btnNuevoIngreso');
    const modal = document.getElementById('modalIngreso');
    const btnCerrar = modal.querySelectorAll('button[type="button"]');
    // ABRIR MODAL
    btnAbrir.addEventListener('click', function () {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });
    // CERRAR MODAL (botones)
    btnCerrar.forEach(btn => {
        btn.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    });
    // CERRAR AL HACER CLICK FUERA DEL MODAL
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
});
</script>

@endsection