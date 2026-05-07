@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-white shadow-2xl rounded-2xl border border-gray-100 my-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-[#00629b] rounded-xl shadow-lg text-white">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $producto->nombre }}</h1>
                <p class="text-slate-500 font-medium tracking-wide">ID de Categoría: {{ $producto->id_catg }} | Área: {{ $producto->id_areap }}</p>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <span class="px-4 py-1.5 rounded-full text-sm font-bold bg-slate-100 text-slate-700 border border-slate-200 shadow-sm">
                ID: {{ $producto->id }}
            </span>
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black border shadow-sm uppercase tracking-wider transition-all duration-300
                {{ $producto->stock <= 0 
                    ? 'bg-red-50 text-red-700 border-red-200 shadow-red-100' 
                    : ($producto->stock <= $producto->stock_minimo 
                        ? 'bg-orange-50 text-orange-700 border-orange-200 shadow-orange-100' 
                        : 'bg-blue-50 text-[#00629b] border-[#00629b]/30 shadow-blue-100') 
                }}">
                
                <span class="mr-2 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full opacity-75 
                        {{ $producto->stock <= 0 ? 'bg-red-400' : ($producto->stock <= $producto->stock_minimo ? 'bg-orange-400' : 'bg-sky-400') }}">
                    </span>
                    <span class="relative inline-flex rounded-full h-2 w-2 
                        {{ $producto->stock <= 0 ? 'bg-red-600' : ($producto->stock <= $producto->stock_minimo ? 'bg-orange-600' : 'bg-[#00629b]') }}">
                    </span>
                </span>

                {{ $producto->stock <= 0 ? 'Sin Stock' : ($producto->stock <= $producto->stock_minimo ? 'Stock Crítico' : 'Disponible') }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-1 space-y-6">
            <div class="aspect-square rounded-2xl overflow-hidden border-4 border-slate-50 shadow-md bg-slate-100 relative group">
                @if($producto->imagen)
                    <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Sin imagen</span>
                    </div>
                @endif
                @if($producto->destacado)
                    <div class="absolute top-4 right-4 bg-[#00629b] text-white px-3 py-1 rounded-lg text-xs font-bold shadow-lg">DESTACADO</div>
                @endif
            </div>
            <div class="bg-slate-30 p-5 rounded-2xl border border-slate-200">
                <div class="flex flex-col items-center">
                    <p class="text-[10px] font-black text-[#00629b] uppercase mb-3 tracking-widest text-center">
                        Código de Barras
                    </p>
                    
                    <div class="w-full bg-white p-4 rounded-xl border border-slate-200 flex justify-center items-center overflow-hidden shadow-sm">
                        <div class="max-w-full overflow-x-auto scrollbar-hide flex justify-center">
                            {!! DNS1D::getBarcodeHTML($producto->codigo_barra ?? '0000', 'C128', 1.5, 33) !!}
                        </div>
                    </div>
                    
                    <p class="text-[11px] font-mono mt-2 text-slate-500 font-bold tracking-[0.3em]">
                        {{ $producto->codigo_barra ?? '0000000000' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            <div>
                <div class="flex items-center gap-2 mb-4 text-[#00629b] font-black uppercase text-xs tracking-[0.3em]">
                    <div class="w-2 h-6 bg-[#00629b] rounded-full"></div>
                    Descripción Funcional
                </div>
                <p class="text-slate-600 text-lg leading-relaxed italic font-light">
                    {{ $producto->descripcion ?? 'Este producto no cuenta con una descripción detallada registrada.' }}
                </p>
            </div>

            <div>
                <div class="flex items-center gap-2 mb-4 text-[#00629b] font-black uppercase text-xs tracking-[0.3em]">
                    <div class="w-2 h-6 bg-[#00629b] rounded-full"></div>
                    Especificaciones y Costos
                </div>
                
                <div class="bg-[#00629b]/5 border-l-4 border-[#00629b] rounded-r-2xl p-8 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-10">
                    <div class="flex items-center gap-4">
                        <span class="bg-[#00629b] text-white rounded-full p-1.5 shadow-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <span class="block text-[10px] text-slate-400 uppercase font-bold">Precio de Venta</span>
                            <span class="text-xl font-bold text-slate-800">S/ {{ number_format($producto->precio, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 opacity-75">
                        <span class="bg-slate-400 text-white rounded-full p-1.5 shadow-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <span class="block text-[10px] text-slate-400 uppercase font-bold">Costo Interno</span>
                            <span class="text-lg font-semibold text-slate-600 font-mono">S/ {{ number_format($producto->costo, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="bg-[#00629b] text-white rounded-full p-1.5 shadow-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <span class="block text-[10px] text-slate-400 uppercase font-bold">Inventario</span>
                            <span class="text-lg font-bold text-slate-800">{{ $producto->stock }} <small class="text-slate-400 text-xs font-normal">Unid.</small></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="bg-[#00629b] text-white rounded-full p-1.5 shadow-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <span class="block text-[10px] text-slate-400 uppercase font-bold">Prep. en {{ ucfirst($producto->preparacion) }}</span>
                            <span class="text-lg font-bold text-slate-800">{{ $producto->tiempo_preparacion }} <small class="text-slate-400 text-xs font-normal">Min.</small></span>
                        </div>
                    </div>
                    
                    @if($producto->notas)
                    <div class="col-span-1 md:col-span-2 mt-2 pt-5 border-t border-slate-200/60">
                         <span class="block text-[10px] text-[#00629b] uppercase font-black mb-2">Notas Adicionales:</span>
                         <p class="italic text-slate-500 text-sm leading-relaxed">"{{ $producto->notas }}"</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4 bg-slate-50 rounded-xl border-b-2 border-slate-200 flex items-center gap-3">
                    <div class="text-[#00629b]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-widest">Delivery</p>
                        <p class="font-bold text-sm {{ $producto->delivery ? 'text-[#00629b]' : 'text-slate-400' }}">
                            {{ $producto->delivery ? 'HABILITADO' : 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border-b-2 border-slate-200 flex items-center gap-3">
                    <div class="text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-widest">Orden Menú</p>
                        <p class="font-bold text-sm text-slate-700">Posición {{ $producto->orden }}</p>
                    </div>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border-b-2 border-[#00629b] flex items-center gap-3">
                    <div class="{{ $producto->estado == 'a' ? 'text-emerald-500' : 'text-red-500' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-widest">Estado</p>
                        <p class="font-bold text-sm text-slate-800">{{ $producto->estado == 'a' ? 'ACTIVO' : 'BAJA' }}</p>
                    </div>
                </div>

                <div class="p-4 bg-slate-50 rounded-xl border-b-2 border-slate-200 flex items-center gap-3">
                    <div class="text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-widest">Mínimo Stock</p>
                        <p class="font-bold text-red-600 font-mono text-sm leading-none">{{ $producto->stock_minimo }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center pt-6 text-[10px] text-slate-400 font-medium border-t border-slate-100">
                <span>RUC SISTEMA: {{ date('Y') }}</span>
                <span>ÚLTIMA ACTUALIZACIÓN: {{ $producto->updated_at->format('d/m/Y | H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection