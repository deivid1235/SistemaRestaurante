@extends('layouts.dashboard')
@section('title', 'Ajustes')

@section('content')
<div class="p-4 md:p-8 bg-gray-100 min-h-full transition-all duration-500">
    
    <div class="rounded-t-3xl p-6 text-white shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-4 relative overflow-hidden" 
        style="background: linear-gradient(135deg, #1e4b7a 0%, #4fc3f7 100%);">
        <div class="flex items-center gap-4 z-10">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 transition-transform hover:rotate-6">
                <i class="fa fa-cog text-2xl md:text-3xl text-white"></i>
            </div>
            <div>
                <p class="text-sm opacity-80 font-medium">Ajustes</p>
                <h1 class="text-xl md:text-2xl font-black tracking-tight uppercase">Panel de opciones</h1>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-b-3xl shadow-lg border-t border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-cogs text-orange-500"></i> Sistema
                </div>
                
                <div class="flex flex-col gap-3">
                    <a href="{{ url('/configuracion-inicial') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-400 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-sliders-h"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Configuración inicial</h4>
                            <p class="text-[11px] text-gray-500">Características, opciones, otros.</p>
                        </div>
                    </a>

                    <a href="{{ url('/optimizacion') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-rocket"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Optimización</h4>
                            <p class="text-[11px] text-gray-500">Reducir tiempos y recursos.</p>
                        </div>
                    </a>

                    <a href="{{ url('/impresoras') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-orange-50 hover:shadow-md hover:-translate-y-1 hover:border-orange-200">
                        <div class="w-11 h-11 bg-orange-400 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-print"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-orange-600 transition-colors">Impresoras</h4>
                            <p class="text-[11px] text-gray-500">Creación y modificación.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-building text-blue-600"></i> Empresa
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ url('/empresa-datos') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-hotel"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Datos de empresa</h4>
                            <p class="text-[11px] text-gray-500">Modificar información fiscal.</p>
                        </div>
                    </a>

                    <a href="{{ url('/usuarios-roles') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-user-friends"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Usuarios / Roles</h4>
                            <p class="text-[11px] text-gray-500">Gestión de accesos.</p>
                        </div>
                    </a>

                    <a href="{{ url('/documentos-tipos') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-file-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Tipos de documentos</h4>
                            <p class="text-[11px] text-gray-500">Facturas, boletas, etc.</p>
                        </div>
                    </a>

                    <a href="{{ url('/pagos-tipos') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Tipos de pago</h4>
                            <p class="text-[11px] text-gray-500">Efectivo, tarjeta, etc.</p>
                        </div>
                    </a>

                    <a href="{{ url('/metodos-pago') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-blue-50 hover:shadow-md hover:-translate-y-1 hover:border-blue-200">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition-colors">Métodos de pago</h4>
                            <p class="text-[11px] text-gray-500">Gestiona las formas de pago disponibles.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-2 mb-4 text-gray-700 font-black border-b border-gray-100 pb-2 uppercase text-xs tracking-widest">
                    <i class="fa fa-utensils text-emerald-600"></i> Restaurante
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ url('/cajas') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Cajas</h4>
                            <p class="text-[11px] text-gray-500">Puntos de cobro.</p>
                        </div>
                    </a>

                    <a href="{{ url('/areas-produccion') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-utensils"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Áreas de Producción</h4>
                            <p class="text-[11px] text-gray-500">Cocina, barra, etc.</p>
                        </div>
                    </a>

                    <a href="{{ url('/mesas') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-chair"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Salones y mesas</h4>
                            <p class="text-[11px] text-gray-500">Gestión de espacios.</p>
                        </div>
                    </a>

                    <a href="{{ url('/productos') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-box"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Productos</h4>
                            <p class="text-[11px] text-gray-500">Catálogo de venta.</p>
                        </div>
                    </a>

                    <a href="{{ url('/carta-digital') }}" class="group flex items-center gap-4 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-300 hover:bg-emerald-50 hover:shadow-md hover:-translate-y-1 hover:border-emerald-200">
                        <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-inner group-hover:rotate-12 transition-transform">
                            <i class="fa fa-book"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors">Carta Digital</h4>
                            <p class="text-[11px] text-gray-500">Organización del menú.</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection