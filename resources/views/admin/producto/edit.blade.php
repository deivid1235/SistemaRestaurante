@extends('layouts.dashboard')
@section('title', 'Editar Producto')

@section('content')
<div class="relative space-y-6 px-2 md:ml-4">
    <div class="w-full flex flex-col md:flex-row justify-between items-center mb-8 gap-4 pr-0 md:pr-4">
        <div class="flex items-center gap-4 text-center md:text-left">
            <div class="hidden md:flex items-center justify-center w-14 h-14 rounded-2xl shadow-lg shadow-orange-200 animate-bounce" 
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">

                <i class="fas fa-utensils text-white text-2xl"></i>
            </div>

            <div>
                <span class="inline-flex items-center bg-orange-50 text-orange-600 text-[10px] font-black px-3 py-1 rounded-full border border-orange-100 uppercase tracking-wider mb-1">
                    <i class="fas fa-hamburger mr-1.5 text-[9px]"></i> GESTIÓN DE MENÚ
                </span>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Editar Plato</h1>
            </div>
        </div>

        <!-- Botón Volver -->
        <a href="{{ route('admin.Producto.index') }}" 
        class="flex items-center gap-3 px-2 py-2 pr-6 bg-white border border-slate-200 rounded-2xl text-[11px] font-black text-slate-600 uppercase tracking-tight hover:bg-slate-50 hover:border-slate-300 hover:text-slate-800 transition-all duration-300 shadow-sm group w-full md:w-auto">  
            <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover:scale-110 group-hover:-rotate-12" 
               style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                <i class="fas fa-chevron-left text-[10px] transition-transform group-hover:-translate-x-0.5"></i>
            </div>

            <span>Volver a la lista</span>
        </a>
    </div>

    <div class="w-full bg-white rounded-xl border-t-4 border-t-[#0ea5e9] border-x border-b border-slate-200 shadow-sm">
        <form action="{{ route('admin.Producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-8">
            @csrf
            @method('PUT')

            {{-- Grid de 4 columnas en desktop --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-6">
                
                {{-- 1. Nombre --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Nombre del Plato <span class="text-red-500 font-bold"></span>
                    </label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                    
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                           style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-utensils text-xs"></i>
                        </div>

                    
                        <div class="relative flex-1">
                            <input type="text" 
                                name="nombre" 
                                value="{{ old('nombre', $producto->nombre) }}"
                                placeholder="Ej: Lomo Saltado, Ceviche..." 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 placeholder:text-slate-400 outline-none transition-all duration-300 
                                    focus:bg-white 
                                    focus:border-slate-400
                                    focus:ring-4 
                                    focus:ring-slate-200/50" 
                                required>
                        </div>
                    </div>
                </div>

                {{-- 2. Categoría --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Categoría <span class="text-red-500 font-bold"></span>
                    </label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                           style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-list-ul text-xs"></i>
                        </div>

                        <div class="relative flex-1">
                            <select name="id_catg" 
                                    class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none appearance-none cursor-pointer transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50" 
                                    required>
                                <option value="" disabled>Seleccione una categoría</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ old('id_catg', $producto->id_catg) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                {{-- 3. Área de Preparación --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Área de Preparación <span class="text-red-500 font-bold"></span>
                    </label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>

                        <div class="relative flex-1">
                            <select name="id_areap" 
                                    class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none appearance-none cursor-pointer transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50" 
                                    required>
                                <option value="" disabled>Seleccione área...</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('id_areap', $producto->id_areap) == $area->id ? 'selected' : '' }}>
                                        {{ $area->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                {{-- 4. Preparación --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Preparación
                    </label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                           style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-concierge-bell text-xs"></i>
                        </div>

                        <div class="relative flex-1">
                            <select name="preparacion" 
                                    class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none appearance-none cursor-pointer transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                                <option value="cocina" {{ old('preparacion', $producto->preparacion) == 'cocina' ? 'selected' : '' }}>Cocina</option>
                                <option value="bodega" {{ old('preparacion', $producto->preparacion) == 'bodega' ? 'selected' : '' }}>Bodega</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                {{-- 5. Precio Venta --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Precio Venta <span class="text-red-500 font-bold">*</span>
                    </label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <span class="text-[10px] font-black">S/</span>
                        </div>

                        <div class="relative flex-1">
                            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" placeholder="0.00" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm font-bold text-slate-700 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50" 
                                required>
                        </div>
                    </div>
                </div>

                {{-- 6. Costo --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Costo Ref.</label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-hand-holding-usd text-xs"></i>
                        </div>

                        <div class="relative flex-1">
                            <input type="number" step="0.01" name="costo" value="{{ old('costo', $producto->costo) }}" placeholder="0.00" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                        </div>
                    </div>
                </div>

                {{-- 7. Stock --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Stock Actual</label>
                    
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-boxes text-xs"></i>
                        </div>

                        <div class="relative flex-1">
                            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                        </div>
                    </div>
                </div>

                {{-- 8. Stock Mínimo --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Stock Mínimo</label>
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-exclamation-triangle text-xs"></i>
                        </div>
                        <div class="relative flex-1">
                            <input type="number" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                        </div>
                    </div>
                </div>

                {{-- 9. Tiempo (Min) --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Tiempo (Min)</label>
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-clock text-xs"></i>
                        </div>
                        <div class="relative flex-1">
                            <input type="number" name="tiempo_preparacion" value="{{ old('tiempo_preparacion', $producto->tiempo_preparacion) }}" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                        </div>
                    </div>
                </div>

                {{-- 10. Código de Barras --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">
                        Cod. Barras
                    </label>

                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md"
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-barcode text-xs"></i>
                        </div>

                        <div class="relative flex-1 flex gap-2">
                            <input id="codigo_barra" type="text" name="codigo_barra" value="{{ old('codigo_barra', $producto->codigo_barra) }}" placeholder="Opcional"
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none">

                            <button type="button" id="btnGenerarCodigo"
                                class="px-4 py-2 rounded-xl text-white text-xs font-bold shadow-md transition-all hover:scale-105"
                                style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                                Generar
                            </button>
                        </div>
                    </div>
                </div>

                {{-- 11. Estado --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Estado</label>
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-toggle-on text-xs"></i>
                        </div>
                        <div class="relative flex-1">
                            <select name="estado" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none appearance-none cursor-pointer transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                                <option value="a" {{ old('estado', $producto->estado) == 'a' ? 'selected' : '' }}>Habilitado</option>
                                <option value="i" {{ old('estado', $producto->estado) == 'i' ? 'selected' : '' }}>Inhabilitado</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                {{-- 12. Orden --}}
                <div class="col-span-1 group/field">
                    <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Orden</label>
                    <div class="flex items-center gap-4 transition-transform duration-300 hover:translate-x-1">
                        <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                            <i class="fas fa-sort-numeric-down text-xs"></i>
                        </div>
                        <div class="relative flex-1">
                            <input type="number" name="orden" value="{{ old('orden', $producto->orden) }}" 
                                class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50">
                        </div>
                    </div>
                </div>

                {{-- Switches --}}
                <div class="col-span-1 sm:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                    {{-- 1. Switch Delivery --}}
                    <div class="flex items-center justify-between py-2 px-4 bg-slate-50 border border-slate-200 rounded-2xl transition-all duration-300 hover:translate-x-1 group/sw h-[58px]">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white shadow-sm transition-transform group-hover/sw:scale-110" 
                                style="background: linear-gradient(135deg, #64748b 0%, #334155 100%);">
                                <i class="fas fa-motorcycle text-[10px]"></i>
                            </div>
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-tight">Delivery</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="delivery" value="1" {{ old('delivery', $producto->delivery) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>

                    {{-- 2. Switch Destacado --}}
                    <div class="flex items-center justify-between py-2 px-4 bg-slate-50 border border-slate-200 rounded-2xl transition-all duration-300 hover:translate-x-1 group/sw h-[58px]">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white shadow-sm transition-transform group-hover/sw:scale-110" 
                                style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                <i class="fas fa-star text-[10px]"></i>
                            </div>
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-tight">Destacado</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="destacado" value="1" {{ old('destacado', $producto->destacado) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>

                    {{-- 3. Carga de Imagen --}}
                    <div class="flex items-center gap-2 transition-transform duration-300 hover:translate-x-1 group/img h-[58px]">
                        <div class="relative flex flex-col items-center justify-center flex-1 h-full border-2 border-dashed border-slate-200 rounded-2xl bg-[#f8fafc] hover:bg-white hover:border-slate-400 transition-all cursor-pointer group/upload">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-cloud-upload-alt text-slate-400 text-xs group-hover/upload:text-slate-600 transition-all"></i>
                                <span class="text-[9px] font-black text-slate-400 uppercase group-hover/upload:text-slate-600">
                                    {{ $producto->imagen ? 'Cambiar Imagen' : 'Subir Imagen' }}
                                </span>
                            </div>
                            <input type="file" name="imagen" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)">
                        </div>

                        {{-- Preview Reducido con mejor acabado --}}
                        <div id="previewContainer" class="{{ $producto->imagen ? '' : 'hidden' }} w-[58px] h-[58px] rounded-2xl border-2 border-white shadow-sm overflow-hidden bg-slate-100 relative group/preview">
                            <img id="imagePreview" class="w-full h-full object-cover transition-transform duration-500 group-hover/preview:scale-110" 
                                src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}">
                            <div class="absolute inset-0 bg-emerald-500/10 flex items-center justify-center opacity-0 group-hover/preview:opacity-100 transition-opacity">
                                <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contenedor de Notas y Descripción en una sola fila --}}
                <div class="col-span-1 sm:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    
                    {{-- Notas Internas --}}
                    <div class="group/field">
                        <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Notas Internas</label>
                        <div class="flex items-start gap-4 transition-transform duration-300 hover:translate-x-1">
                            <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                                style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                                <i class="fas fa-sticky-note text-xs"></i>
                            </div>
                            <div class="relative flex-1">
                                <textarea name="notas" rows="2" placeholder="Escribe notas aquí..."
                                    class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50 resize-none">{{ old('notas', $producto->notas) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción Pública --}}
                    <div class="group/field">
                        <label class="block text-[11px] font-black text-slate-700 uppercase mb-2 ml-1 tracking-tight">Descripción Pública</label>
                        <div class="flex items-start gap-4 transition-transform duration-300 hover:translate-x-1">
                            <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all duration-300 group-hover/field:scale-110" 
                                style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                                <i class="fas fa-align-left text-xs"></i>
                            </div>
                            <div class="relative flex-1">
                                <textarea name="descripcion" rows="2" placeholder="Describe el plato..."
                                    class="block w-full px-4 py-3 bg-[#f8fafc] border border-slate-200 rounded-xl text-sm text-slate-600 outline-none transition-all duration-300 focus:bg-white focus:border-slate-400 focus:ring-4 focus:ring-slate-200/50 resize-none">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Botón Actualizar con degradado dinámico --}}
            <div class="flex justify-end mt-12 border-t border-slate-100 pt-8">
                <button type="submit" 
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);" 
                    class="w-full md:w-auto px-16 py-4 rounded-xl text-white font-[900] text-xs uppercase tracking-[2px] shadow-lg shadow-blue-100 hover:opacity-90 transition-all flex items-center justify-center group">
                    <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform text-base"></i> 
                    ACTUALIZAR PRODUCTO
                </button>
            </div>
        </form>
    </div>
</div>


@endsection