@extends('layouts.dashboard')
@section('title', 'Punto de Venta')

@section('content')

@if(empty($cajaAbierta))
    <div class="bg-gradient-to-r from-red-500 to-rose-600 text-white p-5 rounded-2xl flex flex-col sm:flex-row justify-between items-center shadow-lg animate-pulse m-4 gap-4">
        <div class="flex items-center gap-3"> 
            <i class="fa fa-exclamation-triangle text-xl"></i>
            <span class="font-medium">No hay una caja abierta en este turno. Debe aperturar una caja para procesar comandas.</span>
        </div>
        <a href="{{ route('admin.AperturaCaja.index') }}" 
           class="bg-white text-rose-600 px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-rose-50 transition-all flex-shrink-0">
            Abrir Caja Activa
        </a>
    </div>
@else

<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800 px-2 sm:px-4">

    {{-- HEADER --}}
    <div class="group relative overflow-hidden rounded-2xl p-5 sm:p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg flex-shrink-0"
        style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">          
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-14 h-14 sm:w-16 sm:h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-calculator text-2xl sm:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Punto de Ventas</h1>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wide uppercase bg-emerald-500 text-white animate-pulse shadow-sm self-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                            {{ $cajaAbierta->estado == 'a' ? 'Caja Abierta' : 'Caja Cerrada' }}
                        </span>
                    </div>
                    <p class="text-sm sm:text-base font-light opacity-90 mt-1">
                        Registro y procesamiento de ventas en tiempo real
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4">
                <div class="flex flex-wrap items-center justify-center gap-3 bg-white/10 backdrop-blur-md p-2.5 rounded-xl border border-white/10">            
                    <div class="text-left pr-3 border-r border-white/20 text-xs">
                        <span class="block text-[9px] font-medium opacity-70 uppercase tracking-wider">Caja Activa</span>
                        <span class="font-bold flex items-center gap-1"><i class="fa fa-cash-register opacity-80"></i> #{{ $cajaAbierta->caja_id }}</span>
                    </div>
                    <div class="text-left pr-3 border-r border-white/20 text-xs">
                        <span class="block text-[9px] font-medium opacity-70 uppercase tracking-wider">Cajero</span>
                        <span class="font-bold flex items-center gap-1"><i class="fa fa-user opacity-80"></i> {{ Str::words(auth()->user()->name, 1, '') }}</span>
                    </div>
                    <div class="text-left text-xs">
                        <span class="block text-[9px] font-medium opacity-70 uppercase tracking-wider">Monto Inicial</span>
                        <span class="font-bold">S/ {{ number_format($cajaAbierta->monto_apertura, 2) }}</span>
                    </div>
                </div>
                <div class="flex-shrink-0 w-full sm:w-auto">
                    <form action="" method="POST" class="w-full">
                        @csrf
                        <button type="submit" 
                            class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-white font-bold text-[11px] transition-all hover:opacity-90 active:scale-95 shadow-xl border border-white/10 uppercase tracking-widest bg-rose-500 hover:bg-rose-600">
                            <i class="fa fa-lock text-[9px]"></i>
                            Cerrar Caja
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>
    {{-- Badges de estado: siempre arriba en móvil --}}
    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
        <div class="inline-flex items-center justify-between min-w-[130px] gap-4 px-4 py-1.5 bg-emerald-600 text-white text-[11px] font-bold rounded shadow-sm border border-emerald-700">
            <span>Disponibles</span>
            <span class="bg-black/20 text-white text-[11px] px-2 py-0.5 rounded-sm font-black">{{ $mesasDisponibles }}</span>
        </div>
        <div class="inline-flex items-center justify-between min-w-[130px] gap-4 px-4 py-1.5 bg-rose-600 text-white text-[11px] font-bold rounded shadow-sm border border-rose-700">
            <span>Ocupadas</span>
            <span class="bg-black/20 text-white text-[11px] px-2 py-0.5 rounded-sm font-black">{{ $mesasOcupadas }}</span>
        </div>
        <div class="inline-flex items-center justify-between min-w-[130px] gap-4 px-4 py-1.5 bg-blue-600 text-white text-[11px] font-bold rounded shadow-sm border border-blue-700">
            <span>Reservado</span>
            <span class="bg-black/20 text-white text-[11px] px-2 py-0.5 rounded-sm font-black">{{ $mesasReservadas ?? 0 }}</span>
        </div>
    </div>

    {{-- Salones: horizontal wrap en móvil --}}
    <div class="flex flex-row flex-wrap gap-1.5
                pb-2 lg:pb-0
                border-b lg:border-b-0
                border-slate-100
                w-full">
        @foreach($salones as $salon)
            @php
                $nameLower = Str::lower($salon->nombre);
                $icono = match(true) {
                    Str::contains($nameLower, ['principal', 'general', 'salon']) => 'fa-chair',
                    Str::contains($nameLower, ['vip', 'privado', 'piso 2', 'segundo']) => 'fa-crown',
                    Str::contains($nameLower, ['terraza', 'patio', 'afuera', 'calle']) => 'fa-cloud-sun',
                    Str::contains($nameLower, ['bar', 'barra', 'bebidas', 'licor']) => 'fa-glass-martini-alt',
                    default => 'fa-utensils',
                };
            @endphp

            <a href="?salon_id={{ $salon->id }}"
                class="group flex items-center gap-2 text-[10px] sm:text-[11px] font-black tracking-wider uppercase transition-all duration-200 py-2 px-2.5 rounded-xl border relative overflow-hidden min-h-[38px] antialiased whitespace-nowrap flex-shrink-0
                {{ $salonId == $salon->id 
                    ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white border-orange-400 shadow-md shadow-orange-100' 
                    : 'text-slate-500 bg-white border-transparent hover:bg-slate-50 hover:text-orange-600' }}">
                
                @if($salonId == $salon->id)
                    <div class="absolute -right-1 -bottom-1 text-white/[0.08] pointer-events-none transform rotate-12 scale-110">
                        <i class="fa {{ $icono }} text-xl"></i>
                    </div>
                @endif

                <div class="w-5 h-5 flex items-center justify-center rounded-lg text-[10px] transition-all duration-200 flex-shrink-0
                    {{ $salonId == $salon->id 
                        ? 'bg-white/20 text-white border border-white/10 shadow-inner' 
                        : 'bg-slate-100 text-slate-400 group-hover:bg-orange-50 group-hover:text-orange-500' }}">
                    <i class="fa {{ $icono }}"></i>
                </div>

                <span class="truncate flex-1 font-extrabold tracking-wide text-left">
                    {{ $salon->nombre }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- Mesas: grid responsive con scroll horizontal en móvil --}}
    <div class="lg:max-h-[75vh] lg:overflow-y-auto pr-3 pb-6 style-scrollbar">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($mesas as $mesa)
                @php
                    if ($mesa->estado === 'disponible') {
                        $estadoTexto = 'LIBRE';
                        $colorBorder = 'border-emerald-500';
                        $colorBadge  = 'bg-emerald-500';
                        $colorBar    = 'bg-emerald-500';
                    } elseif ($mesa->estado === 'ocupado') {
                        $estadoTexto = 'OCUPADA';
                        $colorBorder = 'border-rose-500';
                        $colorBadge  = 'bg-rose-500';
                        $colorBar    = 'bg-rose-500';
                    } else {
                        $estadoTexto = 'RESERVADO';
                        $colorBorder = 'border-blue-500';
                        $colorBadge  = 'bg-blue-500';
                        $colorBar    = 'bg-blue-500';
                    }
                @endphp

                <div onclick='abrirModal(
                        {{ $mesa->id }},
                        "{{ $mesa->nombre }}",
                        "{{ $salon->nombre }}",
                        @json($mesa->pedidoMesa)
                    )'
                    class="group relative rounded-xl cursor-pointer bg-white border-2 {{ $colorBorder }} flex flex-col overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
                    style="min-height: 280px;">

                    {{-- Barra animada top al hacer hover --}}
                    <div class="absolute top-0 left-0 w-full h-1.5 {{ $colorBar }} transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center z-20"></div>

                    {{-- Imagen con badge encima --}}
                    <div class="relative flex-grow w-full flex items-center justify-center px-4 pt-10 pb-2">

                        {{-- Badge LIBRE / OCUPADA en esquina superior derecha --}}
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center text-[11px] font-black uppercase px-3 py-1 rounded-md {{ $colorBadge }} text-white tracking-wide shadow">
                                {{ $estadoTexto }}
                            </span>
                        </div>

                        <img
                            src="{{ asset($mesa->estado === 'ocupado' ? 'mesas/ocupado.png' : 'mesas/disponible.png') }}"
                            alt="Mesa {{ $mesa->nombre }}"
                            class="h-64 sm:h-72 w-auto object-contain transition-transform duration-500 group-hover:scale-105"
                        />
                    </div>

                    {{-- Footer: nombre + hora --}}
                    <div class="flex-none w-full flex flex-col items-center pb-4 pt-3 px-2 border-t border-slate-100">
                        <span class="text-base font-black text-slate-800 uppercase tracking-tight">
                            {{ $mesa->nombre }}
                        </span>
                        <span class="text-xs text-slate-400 flex items-center gap-1.5 mt-1">
                            <i class="fa fa-clock text-slate-300"></i>
                            @if($mesa->estado === 'ocupado' && !empty($mesa->hora_inicio))
                                Tiempo: {{ \Carbon\Carbon::parse($mesa->hora_inicio)->diffForHumans(null, true) }}
                            @else
                                Tiempo: --:--
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<div id="modalMesa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-gray-100 mx-4">
        
        <!-- HEADER -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100"
                    style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%);">
                    <i class="fa fa-utensils text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight leading-none">Pedido de Mesa</h2>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Gestión de Comandas</p>
                </div>
            </div>
            <button type="button" id="btnCerrarX" 
                class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <!-- BODY & FORMULARIO -->
        <form action="{{ route('admin.Venta.guardar') }}" method="POST" class="p-8 space-y-5">
            @csrf
            
            @php
                $pedidoActual = $pedido ?? null;
            @endphp

            <input type="hidden" name="id_mesa" id="inputMesaId">

            <!-- INFORMACIÓN DE LA MESA Y SALÓN -->
            <div class="bg-blue-50/50 rounded-2xl p-4 border border-blue-100/60 flex justify-between items-center">
                <div>
                    <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest">Mesa Seleccionada</p>
                    <p id="nombreMesa" class="text-lg font-black text-blue-600">--</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Salón</p>
                    <p id="nombreSalon" class="text-sm font-semibold text-slate-600">--</p>
                </div>
            </div>

            <!-- MOZO -->
            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-user text-[#00B5E2]"></i> Mozo Responsable
                </label>
                <div class="relative">
                    <select name="id_mozo" class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all appearance-none bg-white font-medium text-gray-700" required>
                        <option value="">Seleccione mozo</option>
                        @foreach($mozos as $mozo)
                            <option value="{{ $mozo->id }}"
                                {{ isset($pedidoActual) && $pedidoActual->id_mozo == $mozo->id ? 'selected' : '' }}>
                                {{ $mozo->nombres }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fa fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                    <i class="fa fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none text-xs"></i>
                </div>
            </div>

            <!-- CLIENTE -->
            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-search text-[#00B5E2]"></i> Cliente
                </label>
                <div class="relative">
                    <input type="text"
                        name="nombre_cliente"
                        id="clienteInput"
                        list="listaClientes"
                        class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all font-medium text-gray-700 placeholder:text-gray-300"
                        placeholder="Buscar cliente..."
                        value="{{ $pedidoActual->nombre_cliente ?? '' }}">
                    <i class="fa fa-user-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                </div>

                <datalist id="listaClientes">
                    @foreach($clientes as $cliente)
                        @if($cliente->tipo_cliente == 1)
                            <!-- Persona -->
                            <option value="{{ $cliente->nombres }}">{{ $cliente->numero_documento }}</option>
                        @else
                            <!-- Empresa -->
                            <option value="{{ $cliente->razon_social }}">{{ $cliente->numero_documento }}</option>
                        @endif
                    @endforeach
                </datalist>
                <p class="text-[10px] text-gray-400 italic ml-1">Dejar vacío para "Cliente General"</p>
            </div>

            <!-- PERSONAS -->
            <div class="group space-y-2">
                <label class="flex items-center gap-2 text-[11px] font-bold text-gray-500 uppercase tracking-wider ml-1">
                    <i class="fa fa-users text-[#00B5E2]"></i> Número de Personas
                </label>
                <div class="relative">
                    <input type="number"
                           name="nro_personas"
                           class="w-full border-2 border-gray-100 rounded-2xl p-3.5 pl-11 focus:ring-4 focus:ring-blue-50 focus:border-[#00B5E2] outline-none transition-all font-medium text-gray-700"
                           value="{{ $pedidoActual->nro_personas ?? 1 }}"
                           min="1">
                    <i class="fa fa-users-class absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#00B5E2] transition-colors"></i>
                </div>
            </div>

            <!-- BOTONES ACCIONES -->
            <div class="flex items-center gap-3 pt-4">
                <a href="#"
                   id="btnCancelarPedido"
                   class="flex-1 px-4 py-3.5 bg-red-50 text-red-600 font-bold hover:bg-red-100 rounded-2xl transition-all active:scale-95 text-xs text-center uppercase tracking-wider">
                     Cancelar Pedido
                </a>

                <button type="submit" 
                        class="flex-[1.5] text-white px-5 py-3.5 text-xs rounded-2xl font-bold shadow-xl shadow-blue-200 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2 uppercase tracking-wider"
                        style="background: linear-gradient(135deg, var(--primary, #00B5E2) 0%, #0096D9 100%);">
                    <i class="fa fa-save"></i> Guardar Mesa
                </button>
            </div>

        </form>
    </div>
</div>

@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('modalMesa');
        const contenido = modal.querySelector('.bg-white');
        const btnCerrarX = document.getElementById('btnCerrarX');

        const inputMesaId = document.getElementById('inputMesaId');
        const txtMesa = document.getElementById('nombreMesa');
        const txtSalon = document.getElementById('nombreSalon');

        const selectMozo = document.querySelector('[name="id_mozo"]');
        const inputCliente = document.querySelector('[name="nombre_cliente"]');
        const inputPersonas = document.querySelector('[name="nro_personas"]');

        const btnCancelar = document.getElementById('btnCancelarPedido');

        window.abrirModal = function (
            idMesa,
            nombreMesa,
            nombreSalon,
            pedido = null
        ) {

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            txtMesa.innerText = nombreMesa;
            txtSalon.innerText = nombreSalon;
            inputMesaId.value = idMesa;

            
            selectMozo.value = '';
            inputCliente.value = 'Cliente General';
            inputPersonas.value = 1;

            
            if (pedido) {
                selectMozo.value = pedido.id_mozo ?? '';
                inputCliente.value = pedido.nombre_cliente ?? 'Cliente General';
                inputPersonas.value = pedido.nro_personas ?? 1;
            }

            // botón cancelar
            btnCancelar.href = `/venta/cancelar/${idMesa}`;
        };

        function cerrarModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        btnCerrarX.addEventListener('click', cerrarModal);

        modal.addEventListener('click', function (e) {
            if (!contenido.contains(e.target)) {
                cerrarModal();
            }
        });

    });
</script>

@endsection