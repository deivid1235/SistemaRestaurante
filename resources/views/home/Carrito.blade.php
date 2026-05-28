@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container mx-auto py-6 px-4 bg-gray-30">
    <div class="flex items-center gap-3 mb-6">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-9 md:w-9 text-gray-900 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2 3h3l2.5 11h11.5l2-8H6.5" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 10h11.5" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M11 6v8M15 6v8" />
        <circle cx="8.5" cy="19.5" r="1.5" fill="currentColor" />
        <circle cx="17.5" cy="19.5" r="1.5" fill="currentColor" />
    </svg>
    
    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">Carrito</h1>
</div>
    @if(isset($carrito) && (is_array($carrito) ? count($carrito) > 0 : !$carrito->isEmpty()))
        @php $total = 0; @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="lg:col-span-2 space-y-4">
            <div class="hidden sm:block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/70 text-gray-500 uppercase text-xs font-bold tracking-wider border-b border-gray-100">
                                <th class="p-4 text-center w-16">Item</th>
                                <th class="p-4 w-24">Artículo</th>
                                <th class="p-4">Descripción</th>
                                <th class="p-4 text-right w-24">Precio</th>
                                <th class="p-4 text-center w-32">Cantidad</th>
                                <th class="p-4 text-right w-24">Total</th>
                                <th class="p-4 text-center w-16">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($carrito as $id => $item)
                                @php 
                                    $subtotal = $item['precio'] * $item['cantidad']; 
                                    $total += $subtotal;
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="p-4 text-center text-gray-400 font-medium text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    
                                    <td class="p-4">
                                        <div class="w-16 h-16 flex items-center justify-center border border-gray-100 rounded-xl bg-gray-50 overflow-hidden shadow-sm">
                                            @if(isset($item['imagen']) && Storage::disk('public')->exists($item['imagen']))
                                                <img src="{{ asset('storage/'.$item['imagen']) }}" alt="{{ $item['nombre'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-orange-50 text-orange-400">
                                                    <i class="fas fa-utensils text-xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="p-4">
                                        <h2 class="font-semibold text-gray-800 text-sm mb-0.5">{{ $item['nombre'] }}</h2>
                                        <p class="text-xs text-gray-400 line-clamp-1 max-w-xs">{{ $item['descripcion'] ?? 'Sin descripción.' }}</p>
                                    </td>
                                    
                                    <td class="p-4 text-right font-medium text-gray-600 text-sm whitespace-nowrap">
                                        S/ {{ number_format($item['precio'], 2) }}
                                    </td>
                                    
                                    <td class="p-4 text-center">
                                        <div class="inline-flex items-center border border-gray-200 rounded-lg bg-white overflow-hidden p-0.5 shadow-sm">
                                            <button class="w-7 h-7 flex items-center justify-center hover:bg-gray-100 text-gray-500 font-bold text-sm rounded transition-colors">-</button>
                                            <input type="number" value="{{ $item['cantidad'] }}" class="w-9 text-center border-0 p-0 text-sm font-bold text-gray-700 focus:ring-0" readonly>
                                            <button class="w-7 h-7 flex items-center justify-center hover:bg-gray-100 text-gray-500 font-bold text-sm rounded transition-colors">+</button>
                                        </div>
                                    </td>
                                    
                                    <td class="p-4 text-right font-bold text-gray-800 text-sm whitespace-nowrap">
                                        S/ {{ number_format($subtotal, 2) }}
                                    </td>
                                    
                                    <td class="p-4 text-center">
                                        <a href="{{ route('carrito.remove', $id) }}" class="p-2 inline-flex rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="block sm:hidden space-y-3">
                @foreach($carrito as $id => $item)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm relative flex gap-3">
                        <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center border border-gray-200 rounded-xl bg-gray-50 overflow-hidden">
                            @if(isset($item['imagen']) && Storage::disk('public')->exists($item['imagen']))
                                <img src="{{ asset('storage/'.$item['imagen']) }}" alt="{{ $item['nombre'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-orange-50 text-orange-400">
                                    <i class="fas fa-utensils text-xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0 flex flex-col justify-between">
                            <div>
                                <h2 class="font-bold text-gray-800 text-sm truncate pr-6">{{ $item['nombre'] }}</h2>
                                <p class="text-xs font-semibold text-gray-400 mt-0.5">S/ {{ number_format($item['precio'], 2) }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between mt-2">
                                <div class="inline-flex items-center border border-gray-200 rounded-lg bg-white overflow-hidden p-0.5 shadow-sm">
                                    <button class="w-6 h-6 flex items-center justify-center hover:bg-gray-100 text-gray-500 font-bold text-xs rounded transition-colors">-</button>
                                    <input type="number" value="{{ $item['cantidad'] }}" class="w-8 text-center border-0 p-0 text-xs font-bold text-gray-700 focus:ring-0" readonly>
                                    <button class="w-6 h-6 flex items-center justify-center hover:bg-gray-100 text-gray-500 font-bold text-xs rounded transition-colors">+</button>
                                </div>
                                <span class="font-bold text-gray-800 text-sm">S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('carrito.remove', $id) }}" class="absolute top-3 right-3 text-gray-300 hover:text-red-500 p-1 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>

            @if($carrito->hasPages())
                <div class="mt-6 bg-white border border-gray-100 p-3 rounded-xl shadow-sm flex justify-center sm:justify-end">
                    <div class="text-sm text-gray-600">
                        {{ $carrito->links() }}
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:sticky lg:top-6">
            <h3 class="text-lg font-bold text-gray-800 mb-5 pb-3 border-b border-gray-100 flex items-center justify-between">
                <span>Resumen de Pedido</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </h3>
            
            <div class="space-y-3.5">
                <div class="flex items-center justify-between text-sm">
                    <span class="font-medium text-gray-500">Total a Pagar</span>
                    <span class="font-semibold text-gray-800">S/ {{ number_format($totalGeneral, 2) }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="font-medium text-gray-500">Precio Envío</span>
                    <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md text-xs">Gratis</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="font-medium text-gray-500">Descuento</span>
                    <span class="font-semibold text-gray-800">- S/ 0.00</span>
                </div>
                <div class="py-2">
                    <hr class="border-dashed border-gray-200">
                </div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-base font-bold text-gray-800">Total a Pagar</span>
                    <span class="text-2xl font-black text-gray-900 tracking-tight">S/ {{ number_format($totalGeneral, 2) }}</span>
                </div>
            </div>

            <div class="mt-6 space-y-3">
                <div id="paypal-button-container"></div>
            </div>
        </div>

        </div>
    @else
        <div class="max-w-md mx-auto my-12 bg-white rounded-2xl border border-gray-100 p-8 text-center shadow-sm">
            <div class="w-20 h-20 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-8 ring-orange-50/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tu carrito está vacío</h3>
            <p class="text-sm text-gray-400 max-w-sm mx-auto mb-6 leading-relaxed">
                Explora nuestro menú para añadir tus productos favoritos.
            </p>
            <a href="/" class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-xl shadow-md shadow-orange-200 transition-all uppercase tracking-wider text-xs">
                Volver al menú
            </a>
        </div>
    @endif
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AXNwNfD6cfT9YLh6qz4lVKLuB0agin5ShHn0hwQ9fVJ2XYOJLmdDJmwI-WD0PRD-f8kJRTqHFP26FJ35&currency=MXN"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },

        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "{{ number_format($totalGeneral, 2, '.', '') }}"
                    }
                }]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function () {
                alert("Pago exitoso");
                window.location.href = "/pago-completado";
            });
        },

        onCancel: function() {
            alert("Pago cancelado");
        }

    }).render("#paypal-button-container");

});
</script>

@endsection