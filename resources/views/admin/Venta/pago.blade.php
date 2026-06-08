@extends('layouts.dashboard')
@section('title', 'Pago de productos')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">

    <!-- IZQUIERDA: DETALLE -->
    <div class="bg-white rounded-xl shadow border">

        <div class="p-4 border-b font-black uppercase text-slate-700">
            Detalle del pedido
        </div>

        <!-- HEADER -->
        <div class="grid grid-cols-3 bg-slate-100 p-3 text-xs font-bold uppercase">
            <div>Cant.</div>
            <div>Producto</div>
            <div class="text-right">Total</div>
        </div>

        @php $subtotal = 0; @endphp

        @foreach($carrito as $item)
            @php
                $totalItem = $item['precio'] * $item['cantidad'];
                $subtotal += $totalItem;
            @endphp

            <div class="grid grid-cols-3 p-3 border-b text-sm">
                <div>{{ $item['cantidad'] }}</div>
                <div class="uppercase">{{ $item['nombre'] }}</div>
                <div class="text-right font-bold">
                    S/ {{ number_format($totalItem,2) }}
                </div>
            </div>
        @endforeach

        <!-- RESUMEN -->
        <div class="p-4 bg-slate-50 text-sm">

            <div class="flex justify-between">
                <span>Sub Total</span>
                <span>S/ {{ number_format($subtotal,2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Cortesía / Descuento</span>
                <span>S/ 0.00</span>
            </div>

            <div class="flex justify-between">
                <span>Comisión delivery</span>
                <span>S/ 0.00</span>
            </div>

            <div class="flex justify-between font-black text-lg border-t mt-2 pt-2">
                <span>TOTAL</span>
                <span>S/ {{ number_format($subtotal,2) }}</span>
            </div>

        </div>
    </div>

    <!-- DERECHA: FORMULARIO BD -->
    <div class="bg-white rounded-xl shadow border p-4">

        <form method="POST" action="">
            @csrf

            <!-- TIPO DOC -->
           <div class="mb-3">
                <label class="font-bold text-sm">Tipo Documento</label>

                <select name="id_tipo_doc" class="w-full border p-2 rounded">
                    @foreach($tipos_doc as $doc)
                        <option value="{{ $doc->id }}">
                            {{ $doc->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- CLIENTE -->
            <div class="mb-3">
                <label class="font-bold text-sm">Cliente</label>

                <select name="id_cliente" class="w-full border p-2 rounded">
                    <option value="0">PUBLICO GENERAL</option>

                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nombres }} - {{ $cliente->numero_documento }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- TIPO PAGO -->
            <div class="mb-3">
                <label class="font-bold text-sm">Forma de Pago</label>

                <select name="id_tipo_pago" class="w-full border p-2 rounded">
                    @foreach($tipos_pago as $pago)
                        <option value="{{ $pago->id }}">
                            {{ $pago->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- PAGO EFECTIVO -->
            <div class="mb-3">
                <label class="font-bold text-sm">Monto recibido</label>
                <input type="number" name="pago_efe"
                       class="w-full border p-2 rounded"
                       value="{{ $subtotal }}">
            </div>

            <!-- DESCUENTO -->
            <div class="mb-3">
                <label class="font-bold text-sm">Descuento</label>
                <input type="number" name="descuento_monto"
                       class="w-full border p-2 rounded"
                       value="0">
            </div>

            <div class="mb-3">
                <label class="font-bold text-sm">Vuelto</label>
                <input type="number" name="vuelto"
                    class="w-full border p-2 rounded"
                    value="0" readonly>
            </div>

            <!-- TOTAL REAL -->
            <input type="hidden" name="total" value="{{ $subtotal }}">

            <!-- BOTÓN -->
            <button type="submit"
                    class="w-full bg-green-600 text-white font-black py-3 rounded mt-4">
                REGISTRAR VENTA
            </button>

        </form>

    </div>

</div>

@endsection