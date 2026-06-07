@extends('layouts.dashboard')
@section('title', 'Nuevo Producto')

@section('content')

<div class="w-full px-0 sm:px-6 animate-fade-in text-slate-700 space-y-6">
    {{-- CABECERA --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 rounded-2xl text-white flex items-center justify-center text-2xl shadow-sm border border-sky-100/50 flex-shrink-0" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Nuevo Producto</h2>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Complete los datos para registrar un nuevo producto</p>
            </div>
        </div>
    </div>

    {{-- FORMULARIO --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-4 sm:p-6 shadow-sm">
        <form action="{{ route('admin.producto.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- GRID SUPERIOR --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Nombre --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nombre <span class="text-red-500">*</span></label>
                    <div class="flex h-[42px] rounded-xl border border-slate-200 overflow-hidden focus-within:ring-2 focus-within:ring-sky-500/20 transition-all bg-white">
                        <div class="w-12 flex items-center justify-center bg-slate-50 border-r border-slate-200">
                            <i class="fas fa-tag text-slate-400"></i>
                        </div>
                        <input type="text" name="nombre" class="w-full bg-transparent px-3 outline-none text-sm text-slate-700" placeholder="Nombre del producto" required>
                    </div>
                </div>

                {{-- Categoría --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Categoría <span class="text-red-500">*</span></label>
                    <div class="flex h-[42px] rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <div class="w-12 flex items-center justify-center bg-slate-50 border-r border-slate-200">
                            <i class="fas fa-th-large text-slate-400"></i>
                        </div>
                        <select name="id_catg" class="w-full bg-transparent px-3 outline-none text-sm text-slate-700" required>
                            <option value="" disabled selected>Seleccione</option>
                            @foreach($categorias as $cat)<option value="{{ $cat->id }}">{{ $cat->descripcion }}</option>@endforeach
                        </select>
                    </div>
                </div>

                {{-- Área --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Área <span class="text-red-500">*</span></label>
                    <div class="flex h-[42px] rounded-xl border border-slate-200 overflow-hidden bg-white">
                        <div class="w-12 flex items-center justify-center bg-slate-50 border-r border-slate-200">
                            <i class="fas fa-industry text-slate-400"></i>
                        </div>
                        <select name="id_areap" class="w-full bg-transparent px-3 outline-none text-sm text-slate-700" required>
                            <option value="" disabled selected>Seleccione</option>
                            @foreach($areas as $area)<option value="{{ $area->id }}">{{ $area->nombre }}</option>@endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- BLOQUE MEDIO: Imagen a la izquierda, Estado/Orden y Editores a la derecha --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-4 border-t border-slate-100">
                <div class="space-y-6 lg:col-span-1">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="hidden" onchange="document.getElementById('file-text').textContent = this.files[0].name">
                        <label for="imagen" class="flex flex-col items-center justify-center w-full h-[190px] border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer bg-slate-50/50 hover:bg-white hover:border-sky-400 transition-all text-center p-3">
                            <i class="fas fa-cloud-upload-alt text-4xl" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider" id="file-text">Seleccionar Archivo</p>
                        </label>
                    </div>
                    
                    {{-- Botones Estado y Orden debajo de la imagen --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Estado del Producto
                        </label>

                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">                               
                                <input type="checkbox" name="estado" value="a" class="sr-only peer">

                                <div class="relative w-14 h-7 bg-slate-300 rounded-full transition-all duration-300
                                            peer-checked:bg-green-600
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                            after:bg-white after:rounded-full after:h-6 after:w-6 
                                            after:transition-all
                                            peer-checked:after:translate-x-full">
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700">
                                    <span class="hidden peer-checked:inline text-green-600">Activo</span>
                                    <span class="peer-checked:hidden">Inactivo</span>
                                </span>
                            </label>
                        </div>
                    </div>
                        
                </div>

                {{-- Columna Editores --}}
                <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Notas
                        </label>
                        <div class="rounded-xl border border-slate-200 overflow-hidden h-40">
                            <textarea name="notas" id="editor-notas" rows="7"
                                class="w-full h-full p-3 outline-none resize-none">
                            </textarea>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Descripción
                        </label>
                        <div class="rounded-xl border border-slate-200 overflow-hidden h-40">
                            <textarea name="descripcion" id="editor-descripcion" rows="7"
                                class="w-full h-full p-3 outline-none resize-none">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTONES ACCIÓN --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.producto.index') }}" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs uppercase hover:bg-slate-50 transition-all">Cancelar</a>
                <button type="submit" class="text-white px-8 py-3 rounded-xl font-bold text-xs uppercase shadow-lg transition-all" style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>


@endsection