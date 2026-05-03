@extends('layouts.dashboard')
@section('title', 'Nueva Categoría')

@section('content')
<div class="relative space-y-6 ml-4">
    <div class="max-w-4xl flex justify-between items-center mb-6">
        <div>
            <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded border border-blue-100 uppercase tracking-tight">
                <i class="fas fa-plus-circle mr-1"></i> Ficha de Registro
            </span>
            <h1 class="text-2xl font-extrabold text-slate-800 mt-2 tracking-tight">Nueva Categoría</h1>
        </div>
        <a href="{{ route('admin.Categoria.index') }}" class="text-xs font-bold text-slate-500 bg-white border border-slate-200 px-4 py-2 rounded-lg hover:bg-slate-50 transition shadow-sm">
            <i class="fas fa-chevron-left mr-1"></i> Volver
        </a>
    </div>

    <div class="max-w-4xl bg-white rounded-xl border-t-4 border-t-[#0ea5e9] border-x border-b border-slate-200 shadow-sm">
        <form action="{{ route('admin.Categoria.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">  
                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Descripción / Nombre completo <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-tag text-xs"></i>
                        </span>
                        <input type="text" name="descripcion" placeholder="Ej: Bebidas" 
                            class="block w-full pl-10 py-3 bg-[#f1f5f9]/60 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-[#0ea5e9] outline-none transition-all" required>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Prioridad (Orden)</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-sort-numeric-down text-xs"></i>
                        </span>
                        <input type="number" name="orden" value="1" 
                            class="block w-full pl-10 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-[#0ea5e9] outline-none transition-all">
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Estado del Registro</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-toggle-on text-xs"></i>
                        </span>
                        <select name="estado" class="block w-full pl-10 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm appearance-none focus:border-[#0ea5e9] outline-none transition-all cursor-pointer">
                            <option value="a">Habilitado / Activo</option>
                            <option value="i">Deshabilitado / Inactivo</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-[10px] pointer-events-none"></i>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Configuración</label>
                    <div class="flex items-center justify-between py-2 px-4 bg-[#f0f9ff] border border-[#bae6fd] rounded-xl h-[46px]">
                        <div class="flex items-center">
                            <i class="fas fa-motorcycle text-[#0369a1] mr-3"></i>
                            <span class="text-sm font-bold text-[#0369a1]">Delivery</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="delivery" value="1" class="sr-only peer">
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#0ea5e9]"></div>
                        </label>
                    </div>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 italic">Imagen Representativa</label>
                    <div class="flex items-center gap-6">
                        <div class="relative flex flex-col items-center justify-center w-64 h-32 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:border-[#0ea5e9] transition-all group cursor-pointer">
                            <div class="text-center p-4">
                                <i class="fas fa-cloud-upload-alt text-slate-300 text-2xl mb-2 group-hover:text-[#0ea5e9]"></i>
                                <p class="text-[10px] text-slate-400 font-bold uppercase">Subir Imagen</p>
                            </div>
                            <input type="file" name="imagen" id="imagenInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)">
                        </div>
                        
                        <div id="previewContainer" class="hidden w-32 h-32 rounded-2xl border-2 border-slate-100 overflow-hidden bg-slate-50 shadow-inner items-center justify-center">
                            <img id="imagePreview" src="#" alt="Vista previa" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mt-10">
                <button type="submit" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);"
                    class="px-16 py-3.5 rounded-xl text-white font-bold text-sm shadow-lg shadow-blue-100 hover:opacity-90 transition-all flex items-center">
                    Guardar Categoría <i class="fas fa-save ml-3"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection