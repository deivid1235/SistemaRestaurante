@extends('layouts.dashboard')

@section('title', 'Optimización de Procesos')

@section('content')

<div class="relative space-y-6">

    {{-- ══════════════════════════════════════════
         HEADER BANNER
    ══════════════════════════════════════════ --}}
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

    {{-- ══════════════════════════════════════════
         ALERTAS
    ══════════════════════════════════════════ --}}
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

    {{-- ══════════════════════════════════════════
         GRID DE TARJETAS
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- PEDIDOS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-receipt text-4xl text-blue-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Pedidos</h3>
                <p class="text-[11px] text-slate-400 mt-1">Eliminar recursos temporales</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'optimizar-pedidos',
                        'Para poder eliminar los datos, no deben existir pedidos aperturados en el sistema'
                    )"
                    class="w-full py-2.5 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-indigo-100 mt-auto">
                Optimizar
            </button>
        </div>

        {{-- VENTAS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-tag text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Ventas</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar datos de ventas</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-ventas',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- PRODUCTOS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-utensils text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Productos</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar catálogo de productos</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-productos',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- INSUMOS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-wine-bottle text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Insumos</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar inventario de insumos</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-insumos',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- CLIENTES --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-users text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Clientes</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar base de datos de clientes</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-clientes',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- PROVEEDORES --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-truck text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Proveedores</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar lista de proveedores</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-proveedores',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- SALONES Y MESAS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-folder-open text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Salones y mesas</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar configuración de áreas</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-salones',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

        {{-- NOTAS DE VENTAS --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-all">
            <div class="w-14 h-14 flex items-center justify-center">
                <i class="fa fa-bookmark text-4xl text-emerald-500"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Notas de Ventas</h3>
                <p class="text-[11px] text-slate-400 mt-1">Restaurar notas de ventas</p>
            </div>
            <button onclick="abrirModalOptimizacion(
                        'restaurar-notas-ventas',
                        'La eliminación de estos registros es útil cuando sólo han sido de prueba y se desea comenzar a operar con datos reales.'
                    )"
                    class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all active:scale-95 shadow-sm shadow-emerald-100 mt-auto">
                Restaurar
            </button>
        </div>

    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     MODAL DE CONFIRMACIÓN
══════════════════════════════════════════════════════════════ --}}
<div id="modalOptimizacion" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-[420px] rounded-2xl shadow-2xl overflow-hidden animate-in zoom-in duration-200">

        <div class="p-8 flex flex-col items-center text-center gap-4">

            {{-- Ícono de advertencia --}}
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
            {{-- Formulario oculto que se actualiza dinámicamente --}}
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
