@extends('layouts.dashboard')
@section('title', 'Orden de venta')

@section('content')

<div class="flex flex-col md:flex-row h-auto md:h-[calc(95vh-90px)] w-full md:overflow-hidden">
    
    <div class="w-full md:w-[60%] lg:w-[70%] flex flex-col p-4 md:overflow-y-auto border-r border-slate-100">
        
        <div class="mb-6 relative group">
            <div class="relative group">  
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa fa-search text-slate-400 transition-colors group-focus-within:text-orange-500"></i>
                </div>

                <input type="text"
                    id="buscarProducto"
                    placeholder="Buscar productos..."
                    class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 placeholder-slate-400 
                    focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-300"
                    onkeyup="buscarProductos()">
            </div>
        </div>

        <div class="relative flex items-center mb-6">
            <button onclick="document.getElementById('cat-scroll').scrollBy(-200,0)" 
                class="absolute -left-2 z-10 bg-white p-2 rounded-full shadow border hover:bg-orange-50">
                <i class="fa fa-chevron-left text-xs"></i>
            </button>
            <div id="cat-scroll" class="flex gap-3 overflow-x-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden w-full scroll-smooth px-4">
                <button onclick="filtrarCategoria('todos')" 
                    class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 text-white border border-transparent rounded-2xl flex flex-col items-center justify-center gap-1 transition-all hover:opacity-90 shadow-md"
                    style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white flex items-center justify-center">
                        <i class="fa fa-th text-[11px]" style="color: #007bb5;"></i>
                    </div>
                    <span class="text-[8px] md:text-[9px] font-black uppercase">TODOS</span>
                </button>
                @foreach($categorias as $cat)
                <button onclick="filtrarCategoria({{ $cat->id }})" 
                    class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 bg-white border border-slate-200 rounded-2xl flex flex-col items-center justify-center gap-1 hover:border-orange-400 transition-all">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                        <i class="fa fa-utensils text-slate-400 text-xs"></i>
                    </div>
                    <span class="text-[8px] md:text-[9px] font-black uppercase text-slate-600">{{ $cat->descripcion }}</span>
                </button>
                @endforeach
            </div>
            <button onclick="document.getElementById('cat-scroll').scrollBy(200,0)" 
                class="absolute -right-2 z-10 bg-white p-2 rounded-full shadow border hover:bg-orange-50">
                <i class="fa fa-chevron-right text-xs"></i>
            </button>
        </div>

        <div id="productosContainer" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 overflow-y-auto">  
            @foreach($categorias as $cat)
                @foreach($cat->productos as $prod)
                    @php $pres = $prod->presentaciones->first(); @endphp
                    @if($pres) 
                    <div class="categoria-block group bg-white border border-slate-300 shadow-sm transition-all duration-300 ease-out cursor-pointer flex flex-col hover:border-blue-500 hover:shadow-lg hover:-translate-y-1 hover:z-10"
                        data-cat="{{ $cat->id }}" data-id="{{ $prod->id }}" onclick="agregarProducto(this)">
                        <div class="relative h-28 w-full bg-slate-100 overflow-hidden border-b border-slate-200">
                            <img src="{{ $prod->imagen ? asset('storage/' . $prod->imagen) : asset('venta/image.png') }}" 
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 onerror="this.onerror=null;this.src='{{ asset('venta/image.png') }}';">
                            <div class="absolute top-1 right-1 flex flex-col items-end gap-1">
                                <span class="bg-emerald-500 text-white text-[10px] font-bold px-1.5 py-0.5 leading-none transition-colors group-hover:bg-emerald-600">S/ {{ number_format($pres->precio, 2) }}</span>
                                <span class="bg-indigo-500 text-white text-[9px] font-bold px-1.5 py-0.5 leading-none uppercase transition-colors group-hover:bg-indigo-600">{{ $pres->presentacion }}</span>
                            </div>
                        </div>
                        <div class="p-1.5 h-10 flex items-center">
                            <h3 class="text-[10px] font-bold text-slate-500 uppercase leading-none transition-colors group-hover:text-blue-600">{{ $prod->nombre }}</h3>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
    
    <div class="w-full md:w-[50%] lg:w-[30%] bg-white flex flex-col h-[calc(95vh-90px)] border-t-4 border-slate-100 md:border-t-0 md:border-l border-slate-100 shadow-xl">
        <div class="p-6 border-b border-slate-100 bg-white shrink-0">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-base font-black text-slate-800 uppercase tracking-tight">{{ $salon->nombre ?? 'SALÓN 01' }}</h2>
                    <p class="font-bold text-xs uppercase mt-0.5" style="color: #0096D9;">Mesa: {{ $mesa->numero ?? 'M01' }}</p>
                </div>
                <i class="fa fa-utensils text-lg" style="color: #0096D9;"></i>
            </div>
            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.Venta.pago') }}" class="flex-1 py-3 text-white font-black text-[11px] rounded-lg flex items-center justify-center transition-all hover:opacity-90 shadow-lg" style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">CONFIRMAR PEDIDO</a>
                <a href="{{ route('admin.Venta.index') }}" class="w-20 bg-slate-100 text-slate-600 py-3 rounded-lg flex items-center justify-center hover:bg-slate-200 transition-all"><i class="fa fa-tv text-sm"></i></a>
            </div>
        </div>

        @if(empty($carrito))
            <div class="flex-1 flex flex-col items-center justify-center text-slate-300 p-8">
                <i class="fa fa-shopping-basket text-5xl mb-4 opacity-20 text-slate-200"></i>
                <p class="font-black text-slate-400 text-sm">Carrito vacío</p>
            </div>
        @else
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @foreach($carrito as $item)
                    <div class="flex items-center gap-3 bg-white border border-slate-100 p-3 rounded-xl shadow-sm hover:border-blue-100 transition">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('admin.Venta.carrito-accion', ['sumar', $item['id']]) }}" class="text-white px-2 rounded font-black text-[10px] hover:opacity-90 py-0.5 text-center transition-all" style="background: linear-gradient(135deg, var(--primary, #0096D9) 0%, #007bb5 100%);">+</a>
                            <a href="{{ route('admin.Venta.carrito-accion', ['restar', $item['id']]) }}" class="bg-slate-100 text-slate-500 px-2 rounded font-black text-[10px] hover:bg-slate-200 py-0.5 text-center"> - </a>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-xs font-black text-slate-700 uppercase truncate">{{ $item['nombre'] }}</p>
                            <p class="text-[11px] font-bold" style="color: #007bb5;">S/ {{ number_format($item['precio'], 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-slate-700">x{{ $item['cantidad'] }}</p>
                            <a href="{{ route('admin.Venta.carrito-accion', ['eliminar', $item['id']]) }}"><i class="fa fa-trash text-xs text-slate-300 hover:text-red-500 transition"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="border-t border-slate-100 bg-slate-50 shrink-0">
                <div class="p-5 flex justify-between items-center">
                    <span class="font-black text-xs uppercase text-slate-950">Total:</span>
                    <span class="text-xl font-black text-slate-950">S/ {{ number_format($total ?? 0, 2) }}</span>
                </div>
                <a href="{{ route('admin.Venta.carrito-accion', ['vaciar']) }}" onclick="return confirm('¿Vaciar todo el carrito?')" class="w-full text-white py-4 font-black text-center block text-[10px] uppercase" style="background-color: #D50000;">
                    <i class="fa fa-times-circle mr-1"></i> Cancelar Pedido
                </a>
            </div>
        @endif
    </div>

</div>

<script>
    function filtrarCategoria(catId) {
        document.querySelectorAll('.categoria-block').forEach(el => {
            el.style.display = (catId === 'todos' || el.dataset.cat == catId) ? 'block' : 'none';
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        filtrarCategoria('todos');
    });

    function agregarProducto(el) {
        let id = el.dataset.id;
        fetch("/admin/Venta/agregar-carrito/" + id).then(() => { location.reload(); });
    }
    function buscarProductos() {
        let input = document.getElementById("buscarProducto").value.toLowerCase();
        let productos = document.querySelectorAll(".categoria-block");

        productos.forEach(prod => {
            let nombre = prod.querySelector("h3").innerText.toLowerCase();

            if (nombre.includes(input)) {
                prod.style.display = "";
            } else {
                prod.style.display = "none";
            }
        });
    }
</script>

@endsection