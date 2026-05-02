@extends('layouts.dashboard')
@section('title', 'Productos')

@section('content')
<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-xl sm:rounded-2xl p-4 sm:p-10 text-white shadow-lg transition-all duration-500 ease-out hover:scale-[1.01] hover:shadow-2xl cursor-default"
        style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <!-- Icono de Producto -->
                <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-inner">
                    <i class="fa fa-box-open text-4xl transition-transform duration-500 group-hover:rotate-12"></i>
                </div>
                
                <div>
                    <h1 class="text-3xl font-black tracking-tight group-hover:translate-x-1 transition-transform duration-300">
                        Catálogo de Productos
                    </h1>
                    <p class="text-white font-medium opacity-90 mt-1 flex items-center gap-2">
                        <span class="w-2 h-2 bg-yellow-300 rounded-full animate-pulse"></span>
                        Control de inventario, precios y categorías
                    </p>
                </div>
            </div>

            <!-- Botón Volver -->
            <a href="{{ route('admin.AdministracionGeneral.index') }}" 
                class="flex items-center justify-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/40 rounded-xl font-semibold text-xs transition-all hover:bg-white hover:text-[#6366f1] active:scale-95 w-fit">
                <i class="fa fa-arrow-left"></i>
                Volver al Menú
            </a>
        </div>
    </div> 

    <!-- Aquí iría el resto de tu contenido (filtros, tabla de productos, etc.) -->
      
</div>
@endsection