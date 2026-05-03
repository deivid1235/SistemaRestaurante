@extends('layouts.dashboard')
@section('title', 'Editar Categoría')

@section('content')
<div class="relative space-y-6 ml-4">
    <!-- Encabezado Estilo Vibrante -->
    <div class="group relative overflow-hidden rounded-3xl p-6 text-white shadow-lg transition-all duration-500 mb-8 max-w-4xl"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/30 scale-125 animate-[spin_6s_linear_infinite]"></div>
                    <div class="relative w-14 h-14 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                        <i class="fas fa-edit text-2xl animate-[pulse_2s_infinite]"></i>
                    </div>
                </div>

                <div>
                    <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20 inline-flex items-center">
                        <i class="fas fa-pen-fancy mr-1.5"></i> Editor de Registro
                    </span>
                    <h1 class="text-2xl font-black mt-1 tracking-tight">Editar: {{ $categoria->descripcion }}</h1>
                </div>
            </div>
            
            <a href="{{ route('admin.Categoria.index') }}" 
                class="group/btn flex items-center justify-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl font-bold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-[10px] transition-transform group-hover/btn:-translate-x-1"></i> Volver al Menu
            </a>
        </div>
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Formulario -->
    <div class="max-w-4xl bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.Categoria.update', $categoria->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">  
                <!-- Nombre -->
                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Descripción / Nombre completo <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-tag text-xs"></i>
                        </span>
                        <input type="text" name="descripcion" value="{{ old('descripcion', $categoria->descripcion) }}" placeholder="Ej: Bebidas" 
                            class="block w-full pl-10 py-3 bg-[#f1f5f9]/60 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-[#0ea5e9] outline-none transition-all" required>
                    </div>
                </div>

                <!-- Orden -->
                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Prioridad (Orden)</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-sort-numeric-down text-xs"></i>
                        </span>
                        <input type="number" name="orden" value="{{ old('orden', $categoria->orden) }}" 
                            class="block w-full pl-10 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:border-[#0ea5e9] outline-none transition-all">
                    </div>
                </div>

                <!-- Estado -->
                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Estado del Registro</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-toggle-on text-xs"></i>
                        </span>
                        <select name="estado" class="block w-full pl-10 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm appearance-none focus:border-[#0ea5e9] outline-none transition-all cursor-pointer">
                            <option value="a" {{ $categoria->estado == 'a' ? 'selected' : '' }}>Habilitado / Activo</option>
                            <option value="i" {{ $categoria->estado == 'i' ? 'selected' : '' }}>Deshabilitado / Inactivo</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-4 top-4 text-slate-400 text-[10px] pointer-events-none"></i>
                    </div>
                </div>

                <!-- Configuración Delivery -->
                <div class="md:col-span-1">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 ml-1 italic">Configuración</label>
                    <div class="flex items-center justify-between py-2 px-4 bg-[#f0f9ff] border border-[#bae6fd] rounded-xl h-[46px]">
                        <div class="flex items-center">
                            <i class="fas fa-motorcycle text-[#0369a1] mr-3"></i>
                            <span class="text-sm font-bold text-[#0369a1]">Delivery</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="delivery" value="1" class="sr-only peer" {{ $categoria->delivery ? 'checked' : '' }}>
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#0ea5e9]"></div>
                        </label>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="md:col-span-2 mt-4">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2 italic">Imagen Representativa</label>
                    <div class="flex items-center gap-6">
                        <div class="relative flex flex-col items-center justify-center w-64 h-32 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:border-[#0ea5e9] transition-all group cursor-pointer">
                            <div class="text-center p-4">
                                <i class="fas fa-cloud-upload-alt text-slate-300 text-2xl mb-2 group-hover:text-[#0ea5e9]"></i>
                                <p class="text-[10px] text-slate-400 font-bold uppercase">Cambiar Imagen</p>
                            </div>
                            <input type="file" name="imagen" id="imagenInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)">
                        </div>
                        
                        <!-- Contenedor de Vista Previa (Muestra la imagen actual si existe) -->
                        <div id="previewContainer" class="flex w-32 h-32 rounded-2xl border-2 border-slate-100 overflow-hidden bg-slate-50 shadow-inner items-center justify-center">
                            @if($categoria->imagen)
                                <img id="imagePreview" src="{{ asset('storage/'.$categoria->imagen) }}" alt="Vista previa" class="w-full h-full object-cover">
                            @else
                                <img id="imagePreview" src="#" alt="Vista previa" class="w-full h-full object-cover hidden">
                                <i id="placeholderIcon" class="fas fa-image text-slate-200 text-3xl"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón Guardar -->
            <div class="flex mt-10">
                <button type="submit" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);"
                    class="group px-12 py-3.5 rounded-xl text-white font-bold text-sm shadow-lg shadow-blue-100 hover:opacity-90 transition-all flex items-center active:scale-95">
                    Actualizar Cambios <i class="fas fa-sync-alt ml-3 group-hover:rotate-180 transition-transform duration-500"></i>
                </button>
            </div>
        </form>
    </div>
</div>


@endsection