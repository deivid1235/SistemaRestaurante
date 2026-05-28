@extends('layouts.dashboard')
@section('title', 'Editar Insumos y Categorías')

@section('content')
<div class="relative space-y-6">

    <div class="flex items-center justify-between border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa fa-edit "style="color: var(--primary);"></i> Modificar Almacén Gastronómico
            </h1>
            <p class="text-sm text-gray-500 mt-1">Actualiza las propiedades de tus insumos o redefine sus categorías.</p>
        </div>
        <a href="{{ route('admin.Insumo.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-sm">
            <i class="fa fa-arrow-left text-xs"></i> Volver
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-inner"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-carrot text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-gray-800">Actualizar Ingrediente / Insumo</h2>
                    <p class="text-xs text-gray-400">Modifica los parámetros de este insumo de cocina</p>
                </div>
            </div>

            <form action="{{ route('admin.Insumo.update', $insumo->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Código / SKU</label>
                        <input type="text" name="codigo" value="{{ old('codigo', $insumo->codigo) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-gray-400 text-sm shadow-sm" 
                            placeholder="Ej. INS-001">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre del Insumo</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $insumo->nombre) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-gray-400 text-sm shadow-sm" 
                            placeholder="Ej. Arroz Extra, Filete de Pollo, Aceite" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Categoría de Almacén</label>
                        <select name="insumo_catg_id" 
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm shadow-sm" required>
                            <option value="" disabled>Seleccione una categoría gastronómica</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ $insumo->insumo_catg_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unidad de Medida</label>
                        <select name="tipomedida_id" 
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm shadow-sm" required>
                            <option value="" disabled>Seleccione medida (Kg, Litros, etc.)</option>
                            @foreach($tipomedidas as $medida)
                                <option value="{{ $medida->id }}" {{ $insumo->tipomedida_id == $medida->id ? 'selected' : '' }}>
                                    {{ $medida->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stock Actual</label>
                        <input type="number" name="stock" step="0.01" min="0" value="{{ old('stock', $insumo->stock) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-gray-400 text-sm shadow-sm" 
                            placeholder="0.00" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Costo Unitario</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-sm">S/.</span>
                            <input type="number" name="costo" step="0.01" min="0" value="{{ old('costo', $insumo->costo) }}"
                                class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all placeholder-gray-400 text-sm shadow-sm" 
                                placeholder="0.00" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Estado de Disponibilidad</label>
                        <select name="estado" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm shadow-sm">
                            <option value="a" {{ $insumo->estado == 'a' ? 'selected' : '' }}>Activo (Disponible)</option>
                            <option value="i" {{ $insumo->estado == 'i' ? 'selected' : '' }}>Inactivo (Agotado)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all active:scale-[0.98] text-sm flex items-center justify-center gap-2"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-refresh"></i> Actualizar Insumo
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-inner"
                     style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fa fa-folder-open text-xl"></i>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-gray-800">Modificar Categoría</h2>
                    <p class="text-xs text-gray-400">Edita el nombre o el estado de clasificación</p>
                </div>
            </div>

            {{-- Asegúrate de ajustar la ruta si usas un controlador diferente para categorías --}}
            <form action="{{ route('admin.Insumo.update', $insumo->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre de la Categoría</label>
                    <input type="text" name="descripcion"  value="{{ old('descripcion', $insumo->categoria->descripcion ?? '') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all placeholder-gray-400 text-sm shadow-sm" 
                           placeholder="Ej. Carnes, Verduras, Lácteos, Bebidas" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Estado de Categoría</label>
                    <select name="estado_catg" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm shadow-sm">
                        <option value="a" {{ $insumo->estado_catg == 'a' ? 'selected' : '' }}>Activo</option>
                        <option value="i" {{ $insumo->estado_catg == 'i' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="pt-2 lg:pt-14"> 
                    <button type="submit" 
                            class="w-full text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all active:scale-[0.98] text-sm flex items-center justify-center gap-2"
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-refresh"></i> Actualizar Categoría
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection