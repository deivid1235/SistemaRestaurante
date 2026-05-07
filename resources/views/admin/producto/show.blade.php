@extends('layouts.dashboard')
@section('title', 'Ficha de Producto')

@section('content')
<div class="relative space-y-6 px-2 md:px-6">
    <div class="w-full rounded-[1.5rem] bg-white rounded-none overflow-hidden">
        
        <div class="py-3 px-4 md:px-6 text-white" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 w-full overflow-hidden">
                
                {{-- Información del Producto --}}
                <div class="space-y-0.5">
                    <div class="flex gap-2">
                        {{-- Cambiado a rounded-none para eliminar esquinas curvas --}}
                        <span class="bg-white/20 px-2 py-0.5 rounded-none text-[10px] font-bold uppercase">ID: #{{ $producto->id }}</span>
                        <span class="bg-white/20 px-2 py-0.5 rounded-none text-[10px] font-bold uppercase">ORDEN: {{ $producto->orden }}</span>
                    </div>
                    
                   <h1 class="text-xl font-black uppercase tracking-tight leading-tight truncate max-w-full">
                        {{ $producto->nombre }}
                    </h1>
                    
                    <div class="flex gap-3 mt-0.5">
                        <span class="text-[9px] font-bold uppercase flex items-center gap-1">
                            <i class="fas fa-circle text-[7px] {{ $producto->estado == 'a' ? 'text-emerald-400' : 'text-red-400' }}"></i> 
                            {{ $producto->estado == 'a' ? 'Activo' : 'Inactivo' }}
                        </span>
                        
                        @if($producto->destacado) 
                            <span class="text-amber-300 text-[9px] font-bold uppercase">
                                <i class="fas fa-star"></i> Destacado
                            </span> 
                        @endif
                        
                        @if($producto->delivery) 
                            <span class="text-blue-100 text-[9px] font-bold uppercase">
                                <i class="fas fa-motorcycle"></i> Delivery
                            </span> 
                        @endif
                    </div>
                </div>

                {{-- Precio de Venta Compacto --}}
                <div class="bg-black/10 py-1.5 px-4 border border-white/10 text-center w-full md:w-auto">
                    <p class="text-[9px] font-bold uppercase opacity-80 leading-none mb-1">Precio Venta</p>
                    <p class="text-xl font-black leading-none">S/ {{ number_format($producto->precio, 2) }}</p>
                </div>

            </div>
        </div>
        <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 max-w-full overflow-hidden">
            
            {{-- Columna Lateral: Imagen y códigos controlados --}}
            <div class="lg:col-span-3 space-y-4">
                <div class="max-w-[280px] mx-auto lg:mx-0">
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/'.$producto->imagen) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Códigos más compactos --}}
                <div class="bg-white p-4 rounded-2xl border border-slate-100 space-y-4">
                    <div class="text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase mb-2">Código QR</p>
                        <div class="inline-block p-2 bg-white rounded-lg shadow-sm border border-slate-200">
                            {!! QrCode::size(80)->generate($producto->codigo_qr ?? $producto->id) !!}
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase mb-2">Barras</p>
                        <div class="flex justify-center bg-white p-2 rounded-lg border border-slate-200">
                            {!! DNS1D::getBarcodeHTML($producto->codigo_barra ?? '0000', 'C128', 0.8, 20) !!}
                        </div>
                        <p class="text-[9px] font-mono mt-1 text-slate-500">{{ $producto->codigo_barra }}</p>
                    </div>
                </div>
            </div>

            {{-- Información Central --}}
            <div class="lg:col-span-9 space-y-6">
                
                {{-- Inventario --}}
               <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white border border-slate-200 p-4 rounded-xl text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Costo</p>
                        <p class="text-xl font-bold text-slate-700">S/ {{ number_format($producto->costo, 2) }}</p>
                    </div>
                    <div class="bg-white border border-slate-200 p-4 rounded-xl text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Stock</p>
                        <p class="text-xl font-bold {{ $producto->stock <= $producto->stock_minimo ? 'text-red-500' : 'text-slate-700' }}">{{ $producto->stock }}</p>
                    </div>
                    <div class="bg-white border border-slate-200 p-4 rounded-xl text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Mínimo</p>
                        <p class="text-xl font-bold text-slate-700">{{ $producto->stock_minimo }}</p>
                    </div>
                </div>

                {{-- Detalles en una sola línea para ahorrar espacio --}}
                <div class="bg-white p-4 rounded-xl grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500 text-xs"></i>
                        <div>
                            <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Categoría</p>
                            <p class="text-[11px] font-bold text-slate-700">{{ $producto->categoria->descripcion ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-utensils text-orange-500 text-xs"></i>
                        <div>
                            <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Preparación</p>
                            <p class="text-[11px] font-bold text-slate-700 uppercase">{{ $producto->preparacion }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-print text-purple-500 text-xs"></i>
                        <div>
                            <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Área</p>
                            <p class="text-[11px] font-bold text-slate-700">{{ $producto->areaProduccion->nombre ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-clock text-emerald-500 text-xs"></i>
                        <div>
                            <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Tiempo</p>
                            <p class="text-[11px] font-bold text-slate-700">{{ $producto->tiempo_preparacion }} Min.</p>
                        </div>
                    </div>
                </div>

                {{-- Textos con fuente regular --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase ml-1">Descripción</p>
                        <div class="p-4 bg-white border border-slate-200 rounded-xl text-[12px] text-slate-600 leading-snug">
                            {{ $producto->descripcion ?? 'Sin descripción registrada.' }}
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase ml-1">Notas Internas</p>
                        <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl text-[12px] text-slate-600">
                            {{ $producto->notas ?? 'Sin notas adicionales.' }}
                        </div>
                    </div>
                </div>

                <div class="flex justify-between text-[9px] font-bold text-slate-400 uppercase pt-4 border-t border-slate-100">
                    <span>Creado: {{ $producto->created_at->format('d/m/Y H:i') }}</span>
                    <span>Actualizado: {{ $producto->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Acciones compactas --}}
       <div class="bg-white p-4 flex flex-col md:flex-row justify-between items-center gap-2 border-t border-slate-200">
            <a href="{{ route('admin.Producto.index') }}" class="text-slate-500 text-xs font-bold uppercase hover:text-blue-600 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <div class="flex gap-2">
                <a href="{{ route('admin.Producto.print', $producto->id) }}" target="_blank"
                class="bg-white border border-slate-300 px-4 py-2 rounded-lg text-xs font-bold uppercase">
                    Imprimir / PDF
                </a>
                <a href="{{ route('admin.Producto.edit', $producto->id) }}" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);" class="text-white px-6 py-2 rounded-lg text-xs font-bold uppercase shadow-md hover:opacity-90">
                    Editar Producto
                </a>
            </div>
        </div>

    </div>
</div>
@endsection