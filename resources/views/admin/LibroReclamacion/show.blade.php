@extends('layouts.dashboard')
@section('title', 'Libro de Reclamos')

@section('content')

<div class="p-4 md:p-8 bg-gray-100 min-h-full overflow-hidden">
    
    <div class="rounded-t-3xl p-6 text-white shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4" 
        style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30">
                <i class="fa fa-book-open text-2xl md:text-3xl"></i>
            </div>
            <div>
                <span class="px-2 py-0.5 bg-white/20 rounded-md text-[10px] font-black uppercase tracking-widest border border-white/10">Gestión de Reclamaciones</span>
                <h1 class="text-xl md:text-2xl font-black tracking-tight uppercase">DETALLE DEL RECLAMO #{{ $libroReclamacion->id }}</h1>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.LibroReclamacion.index') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-xs font-bold border border-white/30 flex items-center gap-2 transition-all">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
            
            <button class="px-4 py-2 bg-gray-900 hover:bg-black text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-md transition-all border border-gray-700">
                <i class="fa fa-check-circle text-green-400"></i> Atendido
            </button>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $libroReclamacion->correo }}&su=Respuesta a Reclamo #{{ $libroReclamacion->id }}" 
               target="_blank"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-md transition-all">
                <i class="fa fa-envelope"></i> Gmail
            </a>

            <a href="https://wa.me/51{{ preg_replace('/\s+/', '', $libroReclamacion->telefono) }}" 
               target="_blank"
               class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-md transition-all">
                <i class="fab fa-whatsapp text-lg"></i> WhatsApp
            </a>
        </div>
    </div>

    <div class="bg-white rounded-b-3xl shadow-2xl p-6 md:p-10 border border-gray-100 mb-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 mb-12">
            
            <div class="space-y-6">
                <h2 class="text-sm font-black uppercase tracking-[0.2em] border-b-2 pb-2" style="color: var(--primary); border-color: var(--primary);">
                    1. Datos del Usuario
                </h2>
                <div class="grid grid-cols-2 gap-x-6 gap-y-5 text-[14px]">
                    <div>
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">Documento</span>
                        <span class="text-gray-700 font-semibold italic">{{ $libroReclamacion->tipo_documento }}: {{ $libroReclamacion->numero_documento }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">Teléfono</span>
                        <span class="font-bold text-lg" style="color: var(--primary);">{{ $libroReclamacion->telefono }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">Nombres y Apellidos</span>
                        <span class="text-gray-900 font-black text-base">{{ $libroReclamacion->primer_nombre }} {{ $libroReclamacion->primer_apellido }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">Correo Electrónico</span>
                        <span class="text-gray-700 font-medium break-all underline decoration-sky-200">{{ $libroReclamacion->correo }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-sm font-black uppercase tracking-[0.2em] border-b-2 pb-2" style="color: var(--primary); border-color: var(--primary);">
                    2. Datos del Servicio
                </h2>
                <div class="grid grid-cols-2 gap-x-6 gap-y-5 text-[14px]">
                    <div class="col-span-2">
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">Bien / Servicio Contratado</span>
                        <span class="text-gray-700 font-bold text-base">{{ $libroReclamacion->servicio_contratado }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-tight">N° de Orden</span>
                        <span class="text-gray-600 font-mono font-bold bg-gray-100 px-2 py-1 rounded">{{ $libroReclamacion->numero_orden ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] text-gray-400 font-bold uppercase text-right tracking-tight">Monto Total</span>
                        <span class="block text-green-600 font-black text-right text-2xl">S/ {{ number_format($libroReclamacion->monto_reclamado, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 pt-8 border-t-2 border-gray-50">
            
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b-2 pb-2" style="border-color: var(--primary);">
                    <h2 class="text-sm font-black uppercase tracking-[0.2em]" style="color: var(--primary);">3. Detalle del Reclamo</h2>
                    <span class="text-[10px] px-3 py-1 rounded-full bg-orange-500 text-white font-black uppercase">Reclamo</span>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl min-h-[180px] border border-gray-100 shadow-inner shadow-gray-200/50">
                    <span class="block text-[11px] text-gray-400 font-bold uppercase mb-3 italic">Motivo y Detalle de Solicitud</span>
                    <p class="text-[14px] text-gray-700 leading-relaxed italic font-medium">"{{ $libroReclamacion->detalle_solicitud }}"</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between border-b-2 pb-2" style="border-color: var(--primary);">
                    <h2 class="text-sm font-black uppercase tracking-[0.2em]" style="color: var(--primary);">4. Pedido del Cliente</h2>
                    <span class="text-[10px] text-blue-500 font-black uppercase italic tracking-tighter">Acción Solicitada</span>
                </div>
                <div class="bg-blue-50/50 p-6 rounded-2xl border-2 border-blue-100 min-h-[180px] shadow-inner shadow-blue-100/50">
                    <p class="text-[14px] text-blue-900 font-bold leading-relaxed">{{ $libroReclamacion->pedido_concreto }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection