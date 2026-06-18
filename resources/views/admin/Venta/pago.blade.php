@extends('layouts.dashboard')

@section('title', 'Pago de productos')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 h-full">
    <div class="flex flex-col bg-white border-r border-slate-200">
        <div class="px-5 py-3 font-black uppercase text-sm tracking-widest text-white" 
         style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">
            Detalle del pedido
        </div>
        <div class="grid px-5 py-2 bg-slate-100 border-b border-slate-200 text-xs font-black uppercase text-slate-500 tracking-wider" style="grid-template-columns:60px 1fr 100px">
            <div>Cant.</div>
            <div>Producto</div>
            <div class="text-right">Total</div>
        </div>
        @php $subtotal = 0; @endphp
        @forelse($carrito as $item)
            @php
                $totalItem = $item['precio'] * $item['cantidad'];
                $subtotal += $totalItem;
            @endphp
            <div class="grid items-center px-5 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors" style="grid-template-columns:60px 1fr 100px">
                <div class="w-9 h-7 rounded-md flex items-center justify-center text-xs font-black bg-slate-100 text-slate-700">{{ $item['cantidad'] }}x</div>
                <div class="uppercase text-sm font-semibold text-slate-800 truncate pr-3">{{ $item['nombre'] }}</div>
                <div class="text-right text-sm font-black text-slate-900">S/ {{ number_format($totalItem, 2) }}</div>
            </div>
        @empty
            <div class="p-8 text-center text-slate-400 text-sm font-semibold">
                <div class="text-3xl mb-2">🛒</div>
                El carrito está vacío
            </div>
        @endforelse
        <div class="flex-1"></div>

        <div class="border-t border-slate-200 px-5 py-4 space-y-2" style="background:#fefce8">
            <div class="flex justify-between text-sm text-slate-600 font-medium">
                <span>Sub Total</span>
                <span>S/ {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-sm text-slate-500 font-medium">
                <span>Cortesía / Descuento</span>
                <span id="descuentoValor">S/ 0.00</span>
            </div>
            <div class="flex justify-between text-base font-black text-slate-900 border-t border-slate-300 pt-2 mt-1">
                <span>TOTAL</span>
                <span>S/ <span id="totalFinal">{{ number_format($subtotal, 2) }}</span></span>
            </div>
        </div>
       <div class="px-5 py-3 border-t border-slate-200 bg-white">
            <a href="{{ route('admin.Venta.orden', $pedidos->first()->id_mesa ?? 1) }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-slate-300 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-colors">
                
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver
            </a>
        </div>

    </div>
    <div class="flex flex-col bg-white">

        <form method="POST" action="{{ route('admin.Venta.store') }}" class="flex flex-col flex-1">
            @csrf
            <input type="hidden" name="id_tipo_pedido" value="1">
            <input type="hidden" name="total" value="{{ $subtotal }}">

            @if(session('error'))
                <div class="mx-5 mt-4 bg-red-50 text-red-700 p-3 rounded-lg border border-red-100 text-xs font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mx-5 mt-4 bg-emerald-50 text-emerald-700 p-3 rounded-lg border border-emerald-100 text-xs font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

           <div class="flex items-center gap-4 px-5 py-3 border-b border-slate-200" style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">
                <span class="text-xs font-black uppercase text-white tracking-wider whitespace-nowrap">Tipo de Documento</span>
                
                <div class="flex flex-1 rounded-lg border border-white/30 overflow-hidden text-xs font-black bg-white shadow-sm">
                    @foreach($tipos_doc as $doc)
                        <label class="flex-1 text-center cursor-pointer transition-all duration-200
                            bg-white text-black hover:bg-slate-100
                            has-[:checked]:bg-slate-800 has-[:checked]:text-white">
                            
                            <input type="radio" name="id_tipo_doc" value="{{ $doc->id }}" class="sr-only" {{ $loop->first ? 'checked' : '' }} required>
                            
                            <span class="block py-2 px-3 uppercase tracking-wide font-black">
                                {{ $doc->descripcion }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="px-5 py-3 border-b border-slate-100">
                <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-1.5">Pedido / Mesa</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18"/></svg>
                    </span>
                    <select name="id_pedido_mesa" class="w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm text-slate-700 font-semibold focus:outline-none focus:border-[#0096D9] focus:ring-2 focus:ring-[#0096D9]/20" required>
                        <option value="">-- Seleccione pedido --</option>
                        @foreach($pedidos as $p)
                            <option value="{{ $p->id }}">Mesa {{ $p->id_mesa }} - {{ $p->nombre_cliente ?? 'Sin cliente' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="px-5 py-3 border-b border-slate-100">
                <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-1.5">Buscar Cliente</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <select name="id_cliente" class="w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm text-slate-700 font-semibold focus:outline-none focus:border-[#0096D9] focus:ring-2 focus:ring-[#0096D9]/20">
                        <option value="">DNI: 00000000 | PUBLICO EN GENERAL</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombres }} - {{ $cliente->numero_documento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between px-5 py-2.5 border-b border-slate-200" 
             style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">
                <span class="text-xs font-black uppercase text-white tracking-widest">Formas de Pago</span>
                <div class="relative">
                    <select name="id_tipo_pago" class="appearance-none pl-3 pr-7 py-1.5 rounded-lg border border-white/30 bg-white/20 text-white text-xs font-black uppercase tracking-wide focus:outline-none" required>
                        @foreach($tipos_pago as $pago)
                            <option value="{{ $pago->id }}" class="text-slate-800 bg-white">{{ $pago->descripcion }}</option>
                        @endforeach
                    </select>
                    <span class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-white">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </div>
            </div>

            <div class="px-5 py-3 border-b border-slate-100">
                <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-2">Ingrese Monto</label>
                <div class="grid grid-cols-3 gap-3">
                    <div class="border border-slate-200 rounded-lg p-3 bg-slate-50">
                        <div class="text-xs font-black text-slate-400 uppercase mb-1">EFE</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-sm font-black text-slate-500">S/</span>
                            <input type="number" step="0.01" name="pago_efe" value="{{ $subtotal }}" class="w-full bg-transparent text-lg font-black text-slate-800 focus:outline-none">
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded-lg p-3 bg-slate-50">
                        <div class="text-xs font-black text-slate-400 uppercase mb-1">Monto Total</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-sm font-black text-slate-500">S/</span>
                            <span class="text-lg font-black text-slate-800">{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                    <div class="border border-emerald-200 rounded-lg p-3 bg-emerald-50">
                        <div class="text-xs font-black text-emerald-500 uppercase mb-1">Vuelto</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-sm font-black text-emerald-500">S/</span>
                            <span class="text-lg font-black text-emerald-600">0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5 py-3 border-b border-slate-100">
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-1.5">Serie</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="text" name="serie_doc" maxlength="4" placeholder="B001" class="w-full pl-8 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm font-bold uppercase text-slate-700 placeholder:text-slate-300 focus:outline-none focus:border-[#0096D9] focus:ring-2 focus:ring-[#0096D9]/20" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-1.5">Número</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="text" name="nro_doc" maxlength="8" placeholder="00000001" class="w-full pl-8 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:border-[#0096D9] focus:ring-2 focus:ring-[#0096D9]/20" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-slate-400 tracking-wider mb-1.5">Descuento</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-xs font-black text-slate-400 pointer-events-none">S/</span>
                            <input type="number" step="0.01" id="descuentoInput"  name="descuento" value="0" class="w-full pl-8 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-sm font-bold text-red-500 focus:outline-none focus:border-[#0096D9] focus:ring-2 focus:ring-[#0096D9]/20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1"></div>
            <div class="flex gap-3 px-5 py-4 border-t border-slate-200">
                <button type="submit" name="_action" value="sin_imprimir" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-[#0096D9] text-[#0096D9] text-sm font-black uppercase tracking-wide hover:bg-[#0096D9]/5 active:scale-[.99] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Registrar sin Imprimir
                </button>
                <button type="submit" name="_action" value="previsualizar" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl text-white text-sm font-black uppercase tracking-wide active:scale-[.99] transition-all" style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%); box-shadow: 0 4px 14px rgba(0, 150, 217, 0.3)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Previsualizar y Registrar
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    const inputDescuento = document.getElementById("descuentoInput");
    const mostrarDescuento = document.getElementById("descuentoValor");
    const totalSpan = document.getElementById("totalFinal");
    const vueltoSpan = document.getElementById("vueltoValor");
    let subtotal = {{ $subtotal ?? 0 }};
    let pagoCliente = 0;
    inputDescuento.addEventListener("input", calcularTodo);
    function calcularTodo() {
        let descuento = parseFloat(inputDescuento.value) || 0;
        mostrarDescuento.textContent = descuento.toFixed(2);
        let total = subtotal - descuento;
        if (total < 0) total = 0;
        totalSpan.textContent = total.toFixed(2);
        let vuelto = pagoCliente - total;
        if (vuelto < 0) vuelto = 0;
        vueltoSpan.textContent = vuelto.toFixed(2);
    }
</script>

@endsection