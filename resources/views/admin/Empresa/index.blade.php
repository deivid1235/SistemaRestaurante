@extends('layouts.dashboard')
@section('title', 'Configuración de Empresa')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">
    
    <div class="relative w-full rounded-[2rem] p-6 md:p-8 mb-8 overflow-hidden shadow-lg flex flex-wrap lg:flex-nowrap justify-between items-center gap-6" 
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        
        <div class="z-10 min-w-[250px]">
            <span class="bg-white/10 text-white/90 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/10">Control de Sistema</span>
            <h1 class="text-2xl md:text-3xl font-black text-white mt-3 tracking-tight">Configuración General</h1>
        </div>

        <div class="flex flex-wrap sm:flex-row gap-4 z-10 w-full lg:w-auto">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-4 flex-1 min-w-[200px]">
                <div class="text-left">
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Conectar con Sunat</p>
                    <p class="text-white font-bold text-[11px]">Activar envío de comprobantes</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer ml-auto">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-10 h-5 bg-white/30 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-400"></div>
                </label>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex items-center gap-4 flex-1 min-w-[200px]">
                <div class="text-left">
                    <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">Ambiente de Trabajo</p>
                    <p id="modo-label" class="text-white font-black text-[11px] uppercase">
                        {{ $empresa->modo == 'produccion' ? 'Modo Producción' : 'Modo Beta (Pruebas)' }}
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer ml-auto">
                    <input type="checkbox" name="modo" value="produccion" onchange="toggleModo(this)" {{ $empresa->modo == 'produccion' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-10 h-5 bg-white/30 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-400"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <aside class="lg:col-span-3 space-y-6">
           <div class="group bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 flex flex-col items-center transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
        <div class="relative w-40 h-40 bg-slate-50 border border-slate-100 rounded-3xl flex items-center justify-center overflow-hidden transition-all duration-500 group-hover:bg-white group-hover:border-blue-100">
            
            <img id="preview-logo"
            src="{{ ($empresa && $empresa->logo) ? asset('storage/empresas/'.$empresa->logo) : asset('img/no-image.png') }}"
            class="max-w-full max-h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
                    
            <label class="absolute bottom-2 right-2 bg-blue-600 w-9 h-9 rounded-xl text-white cursor-pointer flex items-center justify-center shadow-lg hover:bg-blue-700 hover:scale-110 active:scale-95 transition-all duration-300">
                <i class="fa fa-camera text-xs"></i>
                <input type="file" name="logo" class="hidden">
            </label>
        </div>
        <p class="mt-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] transition-colors duration-300 group-hover:text-blue-500">
            Logotipo Empresa
        </p>
    </div>
        <nav class="bg-white p-3 rounded-[1.5rem] shadow-sm border border-slate-200 space-y-4">
            <div class="flex flex-col gap-2 w-full">
                <button type="button" onclick="switchTab(event, 'legal')" 
                    class="nav-btn active-tab group w-full flex items-center gap-3 px-4 py-3 rounded-xl font-black text-sm transition-all duration-300 border border-transparent hover:translate-x-2 active:scale-95">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-500 text-white shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fa fa-id-card"></i>
                    </div>
                    <span class="tracking-wide text-blue-600">Datos Legales</span>
                </button>

                <button type="button" onclick="switchTab(event, 'fiscal')" 
                    class="nav-btn group w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-amber-50 hover:text-amber-600 font-bold text-sm transition-all duration-300 border border-transparent hover:border-amber-100 hover:translate-x-2 active:scale-95">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <i class="fa fa-key group-hover:rotate-12 transition-transform"></i>
                    </div>
                    <span class="tracking-wide">Claves SOL</span>
                </button>

                <button type="button" onclick="switchTab(event, 'ubicacion')" 
                    class="nav-btn group w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 font-bold text-sm transition-all duration-300 border border-transparent hover:border-indigo-100 hover:translate-x-2 active:scale-95">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300">
                        <i class="fa fa-map-pin group-hover:bounce transition-transform"></i>
                    </div>
                    <span class="tracking-wide">Ubicación</span>
                </button>
            </div>

            <div class="border-t border-slate-100 mx-2"></div>

            <button type="button" 
                onclick="window.location.href='{{ route('admin.AdministracionGeneral.index') }}'" 
                class="group w-full flex items-center gap-3 px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-50 font-black text-sm transition-all duration-300 border border-transparent hover:border-rose-100 hover:-translate-x-1">
                
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-rose-100 text-rose-600 group-hover:bg-rose-500 group-hover:text-white transition-all">
                    <i class="fa fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                </div>
                
                <span class="tracking-wide">Volver al Menú</span>
            </button>
        </nav>
        </aside>

        <main class="lg:col-span-9 overflow-hidden">
            <form action="{{ route('admin.Empresa.update', $empresa->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf @method('PUT')

                <div id="tab-legal" class="tab-content bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Información de Identidad</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                        <div class="group bg-blue-50/50 p-4 rounded-2xl border border-blue-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-blue-500 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-blue-600">
                                <i class="fa fa-fingerprint text-[11px]"></i> RUC (Número único)
                            </label>
                            <input type="text" name="ruc" value="{{ $empresa->ruc }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base tracking-wider">
                        </div>

                        <div class="group bg-violet-50/50 p-4 rounded-2xl border border-violet-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-violet-500 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-violet-600">
                                <i class="fa fa-building text-[11px]"></i> Razón Social
                            </label>
                            <input type="text" name="razon_social" value="{{ $empresa->razon_social }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base uppercase">
                        </div>

                        <div class="md:col-span-2 group bg-slate-50 p-4 rounded-2xl border border-slate-200 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-slate-600">
                                <i class="fa fa-store text-[11px]"></i> Nombre Comercial
                            </label>
                            <input type="text" name="nombre_comercial" value="{{ $empresa->nombre_comercial }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base uppercase">
                        </div>

                        <div class="group bg-rose-50/50 p-4 rounded-2xl border border-rose-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-rose-500 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-rose-600">
                                <i class="fa fa-map-marker-alt text-[11px]"></i> Dirección Comercial
                            </label>
                            <input type="text" name="direccion_comercial" value="{{ $empresa->direccion_comercial }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm">
                        </div>

                        <div class="group bg-amber-50/50 p-4 rounded-2xl border border-amber-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-amber-600 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-amber-700">
                                <i class="fa fa-file-invoice text-[11px]"></i> Dirección Fiscal
                            </label>
                            <input type="text" name="direccion_fiscal" value="{{ $empresa->direccion_fiscal }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm">
                        </div>
                    </div>

                </div>

                <div id="tab-fiscal" class="tab-content hidden bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Credenciales SOL / Sunat</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                        <div class="group bg-amber-50/40 p-4 rounded-2xl border border-amber-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-amber-600 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-amber-700">
                                <i class="fa fa-user-shield text-[11px]"></i> Usuario SOL
                            </label>
                            <input type="text" name="usuariosol" value="{{ $empresa->usuariosol }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base">
                        </div>

                        <div class="group bg-amber-50/40 p-4 rounded-2xl border border-amber-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-amber-600 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-amber-700">
                                <i class="fa fa-key text-[11px]"></i> Clave SOL
                            </label>
                            <input type="password" name="clave_sol" value="{{ $empresa->clave_sol }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base">
                        </div>

                        <div class="group bg-amber-50/40 p-4 rounded-2xl border border-amber-200/60 overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:shadow-md">
                            <label class="flex items-center gap-2 text-[10px] font-black text-amber-600 uppercase mb-2 tracking-widest transition-colors group-focus-within:text-amber-700">
                                <i class="fa fa-certificate text-[11px]"></i> Clave Certificado
                            </label>
                            <input type="password" name="clavecertificado" value="{{ $empresa->clavecertificado }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base">
                        </div>
                    </div>
                </div>

                <div id="tab-ubicacion" class="tab-content hidden bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-200">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                        <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Geolocalización y Contacto</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 w-full">
                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:border-blue-200">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-1 tracking-wider group-focus-within:text-blue-500">
                                <i class="fa fa-map-signs text-[9px]"></i> Ubigeo
                            </label>
                            <input type="text" name="ubigeo" value="{{ $empresa->ubigeo }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-sm">
                        </div>

                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:border-blue-200">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-1 tracking-wider group-focus-within:text-blue-500">
                                <i class="fa fa-map text-[9px]"></i> Departamento
                            </label>
                            <input type="text" name="departamento" value="{{ $empresa->departamento }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm">
                        </div>

                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:border-blue-200">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-1 tracking-wider group-focus-within:text-blue-500">
                                <i class="fa fa-city text-[9px]"></i> Provincia
                            </label>
                            <input type="text" name="provincia" value="{{ $empresa->provincia }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm">
                        </div>

                        <div class="group bg-slate-50 p-4 rounded-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md focus-within:border-blue-200">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase mb-1 tracking-wider group-focus-within:text-blue-500">
                                <i class="fa fa-location-dot text-[9px]"></i> Distrito
                            </label>
                            <input type="text" name="distrito" value="{{ $empresa->distrito }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-semibold text-slate-600 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-50 pt-8 w-full">
                        <div class="group flex items-center gap-4 bg-blue-50/40 p-4 rounded-2xl border border-blue-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <div class="w-12 h-12 bg-blue-500/10 text-blue-600 rounded-xl flex items-center justify-center text-lg transition-transform group-hover:scale-110">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="w-full">
                                <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest group-focus-within:text-blue-600">Celular</label>
                                <input type="text" name="celular" value="{{ $empresa->celular }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base">
                            </div>
                        </div>

                        <div class="group flex items-center gap-4 bg-indigo-50/40 p-4 rounded-2xl border border-indigo-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 focus-within:-translate-y-1 hover:shadow-md">
                            <div class="w-12 h-12 bg-indigo-500/10 text-indigo-600 rounded-xl flex items-center justify-center text-lg transition-transform group-hover:scale-110">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="w-full">
                                <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest group-focus-within:text-indigo-600">Email Corporativo</label>
                                <input type="email" name="email" value="{{ $empresa->email }}" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-slate-700 text-base">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                   <button type="submit" 
                        class="px-10 py-4 rounded-2xl font-black text-xs text-white uppercase tracking-widest shadow-xl shadow-blue-200 transition-all flex items-center gap-3 active:scale-95 hover:opacity-90"
                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                        <i class="fa fa-save text-sm"></i> 
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

@endsection