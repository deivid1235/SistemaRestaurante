@extends('layouts.dashboard')

@section('title', 'Optimización de Procesos')

@section('content')

<div class="relative space-y-6">
    <div class="group relative overflow-hidden rounded-2xl p-7 text-white shadow-md transition-all duration-500 hover:shadow-lg"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <div class="relative flex items-center justify-center flex-shrink-0">
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/40 scale-125 animate-[spin_3s_linear_infinite]"></div>
                    <div class="relative w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-inner">
                        <i class="fa fa-rocket text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight">Optimización de Procesos</h1>
                    <p class="text-base font-light opacity-90 mt-1">
                        Reducir tiempos y recursos del sistema
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.AdministracionGeneral.index') }}"
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-bold text-sm transition-all hover:bg-white hover:text-[#0096D9] active:scale-95 w-fit">
                <i class="fa fa-arrow-left text-xs"></i> Volver al Menú
            </a>
        </div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
    </div>

   
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-check-circle text-emerald-500"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 text-yellow-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-exclamation-triangle text-yellow-500"></i>
            {{ session('warning') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-xl text-sm font-bold shadow-sm">
            <i class="fa fa-times-circle text-red-500"></i>
            {{ session('error') }}
        </div>
    @endif

   
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- PEDIDOS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/50 blur-2xl rounded-full group-hover:bg-blue-200/50 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-receipt text-3xl transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Pedidos</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Elimina recursos temporales y libera espacio del sistema
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'optimizar-pedidos',
                        'Para poder eliminar los datos, no deben existir pedidos aperturados en el sistema'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Optimizar
            </button>
        </div>
        {{-- VENTAS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-tag text-3xl transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Ventas</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaura datos de ventas eliminando registros de prueba
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-ventas',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- PRODUCTOS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-utensils text-3xl transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Productos</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar catálogo de productos eliminando registros de prueba
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-productos',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- INSUMOS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-wine-bottle text-3xl transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-6"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Insumos</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar inventario de insumos y materia prima
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-insumos',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- CLIENTES --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-users text-3xl transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Clientes</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar base de datos de clientes eliminando registros de prueba
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-clientes',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- PROVEEDORES --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-truck text-3xl transition-transform duration-500 group-hover:scale-110 group-hover:translate-x-1"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Proveedores</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar lista de proveedores y contactos comerciales
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-proveedores',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- SALONES Y MESAS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-folder-open text-3xl transition-transform duration-500 group-hover:scale-110"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Salones y Mesas</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar configuración de áreas, sectores y distribución de mesas
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-salones',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- NOTAS DE VENTAS --}}
        <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-5 hover:shadow-xl hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-100/60 blur-2xl rounded-full group-hover:bg-blue-200/60 transition-colors"></div>
                <div class="relative w-16 h-16 flex items-center justify-center rounded-2xl bg-white border border-slate-50 shadow-sm">
                    <i class="fa fa-bookmark text-3xl transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-12"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    </i>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="font-black text-slate-800 text-lg tracking-tight">Notas de Ventas</h3>
                <p class="text-[11px] leading-relaxed text-slate-400 font-medium px-2">
                    Restaurar histórico de notas y apuntes de ventas realizadas
                </p>
            </div>

            <button onclick="abrirModalOptimizacion(
                        'restaurar-notas-ventas',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);"
                    class="w-full py-3 rounded-xl text-white font-bold text-xs uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-blue-200 hover:brightness-110 mt-auto">
                Restaurar
            </button>
        </div>

    </div>
</div>


<div id="modalOptimizacion" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-[420px] rounded-2xl shadow-2xl overflow-hidden animate-in zoom-in duration-200">
        <div class="p-8 flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 rounded-full border-2 border-orange-300 flex items-center justify-center">
                <span class="text-orange-400 text-3xl font-black">!</span>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-lg leading-tight">
                    Necesitamos de tu<br>Confirmación
                </h3>
                <p id="modalOptimizacion_mensaje" class="text-slate-500 text-sm mt-3 leading-relaxed"></p>
            </div>

            <p class="text-emerald-500 font-bold text-sm">¿Está Usted de Acuerdo?</p>
        </div>

        <div class="px-8 pb-7 flex gap-3">
            <form id="formOptimizacion" action="" method="POST" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100">
                    Si, Adelante!
                </button>
            </form>
            <button type="button"
                    onclick="cerrarModalOptimizacion()"
                    class="flex-1 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-600 font-bold text-sm transition-all active:scale-95">
                No!
            </button>
        </div>
    </div>
</div>

@endsection
