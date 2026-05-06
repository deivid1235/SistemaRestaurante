@extends('layouts.dashboard')
@section('title', 'Configuración de Empresa')

@section('content')
<div class="max-w-8xl mx-auto space-y-6 animate-fade-in text-gray-800 pb-10">
    {{-- Header Principal --}}
    <div class="group relative overflow-hidden rounded-[2.5rem] p-8 text-white shadow-2xl transition-all duration-500"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="relative w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center border border-white/30 shadow-xl transform transition-transform group-hover:scale-105">
                    <i class="fa fa-building text-4xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black tracking-tight leading-tight">Perfil Corporativo</h1>
                    <p class="text-sky-100 font-medium opacity-90">Gestión centralizada de identidad y fiscalidad</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.AdministracionGeneral.index') }}" class="px-6 py-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl font-bold text-sm transition-all hover:bg-white/20 active:scale-95">
                    <i class="fa fa-arrow-left mr-2"></i> Volver
                </a>
                <a href="{{ route('admin.Empresa.create') }}" class="px-6 py-3 bg-white text-sky-600 rounded-2xl font-bold text-sm shadow-xl transition-all hover:bg-sky-50 active:scale-95">
                    <i class="fa fa-edit mr-2"></i> Editar
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- PANEL IZQUIERDO: LOGO Y RUC --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 flex flex-col items-center text-center">
                
                {{-- Avatar con efecto --}}
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full border-2 border-slate-100 p-1 bg-white shadow-sm overflow-hidden transition-transform duration-500 group-hover:scale-105">
                        <img src="{{ $empresa && $empresa->logo ? asset('storage/' . $empresa->logo) : 'https://ui-avatars.com/api/?name=' . ($empresa->razon_social ?? 'E') . '&background=f1f5f9&color=64748b' }}" 
                            class="w-full h-full rounded-full object-cover">
                    </div>

                    {{-- Botón de Cámara --}}
                    <div class="absolute bottom-1 right-1 w-9 h-9 bg-white border border-slate-100 rounded-full flex items-center justify-center shadow-md text-slate-600 transition-all hover:scale-110 cursor-pointer">
                        <i class="fa fa-camera text-xs"></i>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-2xl font-bold text-slate-800 leading-tight">
                        {{ $empresa->razon_social ?? 'Admin' }}
                    </h2>
                    <div class="flex items-center justify-center gap-2 mt-2 text-slate-500">
                        <i class="fa fa-envelope text-xs"></i>
                        <span class="text-sm font-medium">{{ $empresa->email ?? 'admin@gmail.com' }}</span>
                    </div>
                </div>

                <span class="mt-6 px-4 py-1.5 rounded-full text-[9px] font-black tracking-widest uppercase bg-slate-100 text-slate-400 border border-slate-200">
                    System ID: #{{ str_pad($empresa->id, 4, '0', STR_PAD_LEFT) }}
                </span>

                <div class="w-full h-px bg-slate-100 my-8"></div>

                {{-- Detalles de RUC y Ambiente con Movimiento --}}
                <div class="w-full space-y-4">
                    {{-- Item: RUC --}}
                    <div class="flex items-center gap-3 p-3 rounded-[1.5rem] bg-slate-50/50 border border-slate-100 transition-all group/item hover:bg-white hover:shadow-md hover:translate-x-1">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm transition-transform group-hover/item:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            <i class="fa fa-id-card text-sm"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Identificación RUC</p>
                            <p class="text-sm font-bold text-slate-700">{{ $empresa->ruc }}</p>
                        </div>
                    </div>

                    {{-- Item: Modo --}}
                    <div class="flex items-center gap-3 p-3 rounded-[1.5rem] bg-slate-50/50 border border-slate-100 transition-all group/item hover:bg-white hover:shadow-md hover:translate-x-1">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm transition-transform group-hover/item:scale-110" 
                            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                            <i class="fa fa-server text-sm"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Ambiente Actual</p>
                            <p class="text-sm font-bold {{ $empresa->modo == 'produccion' ? 'text-emerald-600' : 'text-amber-500' }} uppercase">
                                {{ $empresa->modo }}
                            </p>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
        {{-- PANEL DERECHO: DETALLES --}}
        <div class="lg:col-span-9 space-y-6">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    {{-- Sección: Ubicación --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-sky-500"></span> Localización
                        </h3>
                        
                        <div class="space-y-5">
                            {{-- Dirección Fiscal --}}
                            <div class="flex items-center gap-4 group transition-transform hover:translate-x-1">
                                <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider block leading-tight">Dirección Fiscal</label>
                                    <p class="text-sm font-bold text-slate-700 leading-tight">{{ $empresa->direccion_fiscal }}</p>
                                </div>
                            </div>

                            {{-- Dirección Comercial --}}
                            <div class="flex gap-4 group transition-transform hover:translate-x-1 mt-6">
                                <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                    <i class="fa fa-store"></i>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider block leading-tight">Dirección Comercial</label>
                                    <p class="text-sm font-bold text-slate-700 leading-tight">{{ $empresa->direccion_comercial }}</p>
                                </div>
                            </div>
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-3">
                                <span class="w-8 h-[2px] bg-sky-500"></span> Datos de Contacto y Configuración Fiscal
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8 pt-6 border-t border-slate-50">
                            {{-- Contacto: Celular --}}
                            <div class="flex items-center gap-4 group transition-transform hover:translate-x-1">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                        <i class="fa fa-phone-alt text-sm"></i>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider leading-none mb-1">Central Telefónica</label>
                                        <p class="text-sm font-bold text-slate-700 leading-none">{{ $empresa->celular }}</p>
                                    </div>
                                </div>

                                {{-- Contacto: Email --}}
                                <div class="flex items-center gap-4 group transition-transform hover:translate-x-1">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                        <i class="fa fa-envelope text-sm"></i>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider leading-none mb-1">Correo Electrónico</label>
                                        <p class="text-sm font-bold text-slate-700 leading-none">{{ $empresa->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                {{-- Departamento --}}
                                <div class="flex items-center gap-3 group transition-transform hover:translate-x-1">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                        <i class="fa fa-map text-[11px]"></i>
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-black text-slate-400 uppercase italic leading-none mb-1 tracking-wider">Departamento</label>
                                        <p class="text-sm font-bold text-slate-600 leading-none">{{ $empresa->departamento }}</p>
                                    </div>
                                </div>

                                {{-- Provincia --}}
                                <div class="flex items-center gap-3 group transition-transform hover:translate-x-1">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                        <i class="fa fa-landmark text-[11px]"></i>
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-black text-slate-400 uppercase italic leading-none mb-1 tracking-wider">Provincia</label>
                                        <p class="text-sm font-bold text-slate-600 leading-none">{{ $empresa->provincia }}</p>
                                    </div>
                                </div>

                                {{-- Distrito --}}
                                <div class="flex items-center gap-3 group transition-transform hover:translate-x-1">
                                    <div class="w-10 h-10 flex-shrink-0 rounded-xl flex items-center justify-center text-white shadow-md transition-all group-hover:scale-110" 
                                        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                        <i class="fa fa-map-pin text-[11px]"></i>
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-black text-slate-400 uppercase italic leading-none mb-1 tracking-wider">Distrito</label>
                                        <p class="text-sm font-bold text-slate-600 leading-none">{{ $empresa->distrito }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sección: Credenciales --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-amber-500"></span> Seguridad SOL
                        </h3>
                        
                        <div class="bg-slate-50 rounded-[2rem] p-6 border border-slate-100 space-y-6 transition-all hover:shadow-inner">
                            
                            {{-- Item: Usuario SOL --}}
                            <div class="flex items-center gap-4 group transition-transform hover:translate-x-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white shadow-sm transition-all group-hover:scale-110" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                    <i class="fa fa-user-shield"></i>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-tighter leading-none mb-1">Usuario SOL</label>
                                    <p class="font-mono text-sm font-black text-slate-700 leading-none">{{ $empresa->usuariosol }}</p>
                                </div>
                            </div>

                            {{-- Item: Certificado Digital --}}
                            <div class="flex items-center gap-4 group transition-transform hover:translate-x-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white shadow-sm transition-all group-hover:scale-110" 
                                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-tighter leading-none mb-1">Certificado Digital</label>
                                    <p class="text-sm font-bold text-emerald-600 flex items-center gap-1 leading-none">
                                        <i class="fa fa-check-circle text-[10px]"></i> Configurado
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-6 mt-10">
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-3">
                                    <span class="w-8 h-[2px] bg-emerald-500"></span> Servicio Web
                                </h3>

                                <div class="bg-slate-50/50 rounded-[2.5rem] p-8 border border-slate-100 space-y-8 transition-all hover:shadow-inner">
                                    
                                    <div class="flex items-center gap-5 group transition-transform hover:translate-x-1">
                                        <div class="relative">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white shadow-lg transition-all group-hover:scale-110" 
                                                style="background: #10b981;">
                                                <i class="fa fa-cloud text-lg"></i>
                                            </div>
                                            <div class="absolute -top-1 -right-1 flex h-4 w-4">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1 leading-none">Estado del Servidor</label>
                                            <div class="flex items-center gap-3">
                                                <p class="text-base font-black text-slate-700 leading-none">Conectado a SUNAT</p>
                                                <span class="px-2 py-0.5 rounded-md text-[9px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-tighter">
                                                    En Línea
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                   
                </div>

                {{-- Pie de tarjeta --}}
                <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-between flex-wrap gap-4">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">
                        Última actualización: {{ \Carbon\Carbon::parse($empresa->updated_at)->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection