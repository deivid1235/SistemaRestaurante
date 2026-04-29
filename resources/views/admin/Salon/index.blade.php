@extends('layouts.dashboard')
@section('title', 'Salones - Administración General')

@section('content')
 {{-- 1. ENCABEZADO PRINCIPAL --}}
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold tracking-tight">
                        Gestión de Salones y mesas  
                    </h1>
                    <i class="fa fa-print text-3xl opacity-50 transition-all duration-500 group-hover:opacity-100 group-hover:rotate-12 group-hover:scale-110"></i>
                </div>
                <p class="text-base font-light opacity-90 mt-1">
                    Áreas del restaurante
                </p>
            </div>

            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150 group-hover:-translate-x-5"></div>
    </div>



@endsection