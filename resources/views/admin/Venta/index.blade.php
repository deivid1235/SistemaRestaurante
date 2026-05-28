@extends('layouts.dashboard')
@section('title', 'Punto de Venta')

@section('content')

@if(empty($cajaAbierta))
    <div class="bg-red-500 text-white p-4 rounded-lg flex justify-between items-center">
        <span>❌ No hay caja abierta. Debe abrir una caja para continuar.</span>
        <a href="{{ route('admin.AperturaCaja.index') }}" 
           class="bg-white text-red-500 px-4 py-2 rounded font-bold">
            Abrir Caja
        </a>
    </div>
@else

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">

            <!-- IZQUIERDA -->
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_4s_linear_infinite]"></div>
                    
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-calculator text-3xl"></i>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold tracking-tight">Punto de Ventas</h1>

                        <!-- ESTADO DINÁMICO -->
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $cajaAbierta->estado == 'a' ? 'bg-emerald-500' : 'bg-red-500' }} text-white animate-pulse shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-white"></span>
                            {{ $cajaAbierta->estado == 'a' ? 'Caja Abierta' : 'Caja Cerrada' }}
                        </span>
                    </div>

                    <p class="text-base font-light opacity-90 mt-1">
                        Registro y procesamiento de ventas en tiempo real
                    </p>
                </div>
            </div>

            <!-- DERECHA -->
            <div class="flex flex-wrap items-center gap-4 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10 lg:self-center">
                
                <!-- CAJA -->
                <div class="text-left pr-4 border-r border-white/20">
                    <span class="block text-xs font-medium text-white/70 uppercase tracking-wider">Caja Activa</span>
                    <span class="text-sm font-bold flex items-center gap-1.5 mt-0.5">
                        <i class="fa fa-cash-register text-white/80"></i> 
                        Caja #{{ $cajaAbierta->caja_id }}
                    </span>
                </div>

                <!-- USUARIO -->
                <div class="text-left pr-4 border-r border-white/20">
                    <span class="block text-xs font-medium text-white/70 uppercase tracking-wider">Cajero</span>
                    <span class="text-sm font-bold flex items-center gap-1.5 mt-0.5">
                        <i class="fa fa-user text-white/80"></i> 
                        {{ auth()->user()->name }}
                    </span>
                </div>

                <!-- MONTO APERTURA -->
                <div class="text-left pr-4 border-r border-white/20">
                    <span class="block text-xs font-medium text-white/70 uppercase tracking-wider">Monto Inicial</span>
                    <span class="text-sm font-bold mt-0.5">
                        S/ {{ number_format($cajaAbierta->monto_apertura, 2) }}
                    </span>
                </div>

                <!-- BOTÓN CERRAR -->
                <div>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" 
                            class="flex items-center gap-2 bg-rose-500 hover:bg-rose-600 active:scale-95 text-white text-xs font-bold px-4 py-2.5 rounded-lg shadow-sm transition-all duration-200">
                            <i class="fa fa-lock"></i>
                            Cerrar Caja
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- EFECTOS -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
        <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
    </div>

    <!-- CONTENIDO -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Aquí va tu sistema de ventas -->
    </div>
</div>

@endif

@endsection