@extends('layouts.dashboard')
@section('title', 'Crear datos de Empresa')

@section('content')
<div class="w-full px-2 sm:px-4 py-6 overflow-x-hidden">
    <div class="w-full flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-100" 
                style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                <i class="fa fa-industry text-white text-2xl"></i>
            </div>

            <div>
                <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-2 py-1 rounded-lg border border-blue-100 uppercase tracking-widest">
                    <i class="fas fa-plus-circle mr-1"></i> Ficha de Registro
                </span>
                <h1 class="text-3xl font-extrabold text-slate-800 mt-1 tracking-tight">Nuevos datos de la Empresa</h1>
            </div>
        </div>

        {{-- BOTÓN VOLVER --}}
        <a href="{{ route('admin.Empresa.index') }}" 
        class="flex items-center gap-2 px-6 py-3 rounded-xl font-black text-[11px] text-white uppercase tracking-widest shadow-xl shadow-blue-100 transition-all active:scale-95 hover:opacity-90"
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Volver</span>
        </a>
    </div>
    <div class="space-y-6">
        
        {{-- STEPPER DE NAVEGACIÓN --}}
        <div class="w-full bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 mb-8">
            <nav class="relative flex flex-row justify-between items-center max-w-3xl mx-auto">
                <div class="absolute top-[1.25rem] left-0 w-full h-0.5 bg-slate-100 z-0"></div>

                <!-- PASO 1: LEGAL -->
                <button type="button"
                    onclick="switchTab(event, 'legal')"
                    id="tab-btn-legal"
                    class="nav-btn group flex flex-col items-center relative z-10">

                    <div class="step-icon w-10 h-10 flex items-center justify-center rounded-full text-white shadow-lg ring-4 ring-sky-50 transition-all duration-300"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-balance-scale text-[12px]"></i>
                    </div>

                    <span class="mt-3 text-[10px] font-black uppercase tracking-widest text-sky-600 transition-colors">
                        Información Legal
                    </span>
                </button>

                <!-- PASO 2: FISCAL -->
                <button type="button"
                    onclick="switchTab(event, 'fiscal')"
                    id="tab-btn-fiscal"
                    class="nav-btn group flex flex-col items-center relative z-10">

                    <div class="step-icon w-10 h-10 flex items-center justify-center rounded-full text-white shadow-lg ring-4 ring-sky-50 transition-all duration-300"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-key text-[12px] group-hover:text-sky-500"></i>
                    </div>

                    <span class="mt-3 text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-sky-500 transition-colors">
                        Credenciales SOL
                    </span>
                </button>

                <!-- PASO 3: UBICACIÓN -->
                <button type="button"
                    onclick="switchTab(event, 'ubicacion')"
                    id="tab-btn-ubicacion"
                    class="nav-btn group flex flex-col items-center relative z-10">

                    <div class="step-icon w-10 h-10 flex items-center justify-center rounded-full text-white shadow-lg ring-4 ring-sky-50 transition-all duration-300"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-map-marker-alt text-[12px] group-hover:text-sky-500"></i>
                    </div>

                    <span class="mt-3 text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-sky-500 transition-colors">
                        Ubicación
                    </span>
                </button>

            </nav>
            @if(isset($empresa))
            <form action="{{ route('admin.Empresa.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            @else
            <form action="{{ route('admin.Empresa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            @endif
        </div>
            <div id="tab-legal" class="tab-content bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
               <div class="p-8 flex items-center gap-4 border-b border-slate-50">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-100"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    <i class="fa fa-info-circle text-white text-xl"></i>
                </div>
                
                <div>
                    <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Información General</h2>
                    <p class="text-slate-400 text-sm font-medium">Identificación básica y registro legal ante SUNAT.</p>
                </div>
            </div>
            {{-- Tabla 1--}}
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                        <div class="md:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-8">
                            {{-- RUC --}}
                            <div class="space-y-3">
                                    <div class="flex items-center gap-3 ml-1">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-fingerprint text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">RUC <span class="text-rose-500">*</span></label>
                                    </div>
                                    <div class="relative group">
                                        <input type="text" name="ruc" value="{{ $empresa->ruc ?? '' }}" required 
                                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-50 transition-all outline-none">
                                    </div>
                                </div>
                                
                                <div class="space-y-3">                                     
                                    <div class="flex items-center gap-3 ml-1">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-building text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Razón Social <span class="text-rose-500">*</span></label>
                                    </div>
                                    <div class="relative group">
                                        <input type="text" name="razon_social" value="{{ $empresa->razon_social ?? '' }}" required 
                                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-50 transition-all outline-none">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="space-y-8">
                                {{-- NOMBRE COMERCIAL --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 ml-1">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                            style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                            <i class="fa fa-store text-white text-[10px]"></i>
                                        </div>
                                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Nombre Comercial</label>
                                    </div>

                                    <div class="relative group">
                                        <input type="text" name="nombre_comercial" value="{{ $empresa->nombre_comercial ?? '' }}" 
                                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-50 transition-all outline-none">
                                    </div>
                                </div>

                                {{-- DIRECCIÓN FISCAL --}}
                                <div class="flex gap-4">
                                    <div class="space-y-3 w-1/2">
                                        <div class="flex items-center gap-3 ml-1">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                                style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                                <i class="fa fa-map-marker-alt text-white text-[10px]"></i>
                                            </div>
                                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Dirección Fiscal</label>
                                        </div>

                                        <div class="relative group">
                                            <input type="text" name="direccion_fiscal" value="{{ $empresa->direccion_fiscal ?? '' }}" 
                                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-50 transition-all outline-none">
                                        </div>
                                    </div>

                                    <div class="space-y-3 w-1/2">
                                        <div class="flex items-center gap-3 ml-1">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                                 style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                                <i class="fa fa-city text-white text-[10px]"></i>
                                            </div>
                                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Direccion Comercial</label>
                                        </div>

                                        <div class="relative group">
                                            <input type="text" name="direccion_comercial" value="{{ $empresa->direccion_comercial	?? '' }}" 
                                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-50 transition-all outline-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- IMAGEN --}}
                        <div class="md:col-span-4 flex flex-col justify-start pt-1">
                            <div class="flex items-center gap-3 mb-4 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-image text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Imagen Representativa</label>
                            </div>

                            <label for="logo-input" class="relative group cursor-pointer">
                                <div class="w-full h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center transition-all duration-300 group-hover:bg-white group-hover:border-sky-400 group-hover:shadow-md">
                                    
                                  <img 
                                    id="logo-preview" 
                                    src="{{ $empresa && $empresa->logo ? asset('storage/' . $empresa->logo) : '' }}"
                                    class="{{ $empresa && $empresa->logo ? '' : 'hidden' }} absolute inset-0 w-full h-full object-contain p-4 z-10">
                                    
                                    <div id="logo-placeholder" class="flex flex-col items-center gap-2">
                                        <div class="w-12 h-12 rounded-full bg-sky-50 flex items-center justify-center group-hover:bg-sky-100 transition-colors">
                                            <i class="fa fa-cloud-upload-alt text-sky-400 text-xl"></i>
                                        </div>
                                        <span class="text-[10px] font-black text-sky-600/60 uppercase tracking-widest group-hover:text-sky-500">Subir Imagen</span>
                                    </div>
                                </div>

                                <input type="file" id="logo-input" name="logo" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            {{-- TAB 2: CREDENCIALES SOL --}}
            <div id="tab-fiscal" class="tab-content hidden bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                
                {{-- ENCABEZADO --}}
                <div class="p-8 flex items-center gap-4 border-b border-slate-50">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-key text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Credenciales SOL e Interfaz</h2>
                        <p class="text-slate-400 text-sm font-medium">Configuración de facturación y modo de entorno.</p>
                    </div>
                </div>

                <div class="p-8">
                    {{-- GRID DE 4 COLUMNAS (TODO EN UNA FILA) --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        {{-- MODO SISTEMA --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-server text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Modo Sistema</label>
                            </div>
                            <select name="modo" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all cursor-pointer">
                                <option value="beta" {{ ($empresa->modo ?? '') == 'beta' ? 'selected' : '' }}>BETA</option>
                                <option value="production" {{ ($empresa->modo ?? '') == 'production' ? 'selected' : '' }}>PRODUCCIÓN</option>
                            </select>
                        </div>

                        {{-- USUARIO SOL --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-user-shield text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Usuario SOL</label>
                            </div>
                            <input type="text" name="usuariosol" value="{{ $empresa->usuariosol ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        {{-- CLAVE SOL --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-lock text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Clave SOL</label>
                            </div>
                            <input type="password" name="clave_sol" value="{{ $empresa->clave_sol ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        {{-- CLAVE CERTIFICADO --}}
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-certificate text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Certificado</label>
                            </div>
                            <input type="password" name="clavecertificado" value="{{ $empresa->clavecertificado ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                    </div>
                </div>
            </div>

            {{-- TAB 3: UBICACIÓN Y CONTACTO --}}
            <div id="tab-ubicacion" class="tab-content hidden bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-8 flex items-center gap-4 border-b border-slate-50">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                        <i class="fa fa-map-marked-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Ubicación y Contacto</h2>
                        <p class="text-slate-400 text-sm font-medium">Datos geográficos y medios de comunicación corporativa.</p>
                    </div>
                </div>

                <div class="p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-fingerprint text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Ubigeo</label>
                            </div>
                            <input type="text" name="ubigeo" value="{{ $empresa->ubigeo ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-map text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Departamento</label>
                            </div>
                            <input type="text" name="departamento" value="{{ $empresa->departamento ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-city text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Provincia</label>
                            </div>
                            <input type="text" name="provincia" value="{{ $empresa->provincia ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-map-pin text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Distrito</label>
                            </div>
                            <input type="text" name="distrito" value="{{ $empresa->distrito ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-phone text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Celular corporativo</label>
                            </div>
                            <input type="text" name="celular" value="{{ $empresa->celular ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 ml-1">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm"
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                                    <i class="fa fa-envelope text-white text-[10px]"></i>
                                </div>
                                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Email de contacto</label>
                            </div>
                            <input type="email" name="email" value="{{ $empresa->email ?? '' }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTÓN GUARDAR --}}
            <div class="mt-8 flex justify-end">
                <button type="submit" 
                    class="px-8 py-3 rounded-xl font-black text-[11px] text-white uppercase tracking-wider shadow-lg shadow-blue-100 transition-all flex items-center gap-2 active:scale-95 hover:shadow-sky-200 hover:-translate-y-0.5" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
                    
                    <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center">
                        <i class="fa fa-save text-[12px]"></i>
                    </div>
                    
                    <span>Guardar Configuración</span>
                </button>
            </div>
        </form >
        @endsection
        
    
    </div>
</div>

