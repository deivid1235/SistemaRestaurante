@extends('layouts.dashboard')

@section('title', 'Crear Nuevo Proveedor')

@section('content')

<div class="w-full px-0 sm:px-6 animate-fade-in text-slate-700 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shadow-sm border border-sky-100/50 flex-shrink-0">
                <i class="fas fa-truck-loading"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">
                    Registrar Nuevo Proveedor
                </h2>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Ingresa los datos del distribuidor o aliado comercial</p>
            </div>
        </div>
    </div>

    <!-- Contenedor con Fondo Blanco (Estilo Insumos - Adaptable) -->
    <div class="bg-white rounded-2xl border border-slate-100 p-4 sm:p-6 shadow-sm transition-all hover:shadow-md">

        <form action="{{ route('admin.Proveedor.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Grid Inteligente: 1 columna en móviles, 2 a partir de 'sm' (640px) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-id-card text-slate-400"></i> Tipo Documento
                    </label>
                    <div class="relative">
                        <select name="tipo_documento" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="DNI">DNI (Persona Natural)</option>
                            <option value="RUC">RUC (Persona Jurídica)</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-hashtag text-slate-400"></i> Número de Documento
                    </label>
                    <input type="text" name="numero" placeholder="Ej. 20123456789"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm" required>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-building text-slate-400"></i> Razón Social o Nombre Completo
                    </label>
                    <input type="text" name="razon_social" placeholder="Nombre de la empresa o proveedor"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm" required>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-map-marked-alt text-slate-400"></i> Dirección Fiscal
                    </label>
                    <input type="text" name="direccion" placeholder="Av. Principal Nro. 123 - Ciudad"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-phone-alt text-slate-400"></i> Teléfono / Celular
                    </label>
                    <input type="text" name="telefono" placeholder="Ej. 987654321"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-envelope text-slate-400"></i> Correo Electrónico
                    </label>
                    <input type="email" name="email" placeholder="proveedor@empresa.com"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-user-tie text-slate-400"></i> Persona de Contacto
                    </label>
                    <input type="text" name="contacto" placeholder="Nombre del asesor comercial"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-toggle-on text-slate-400"></i> Estado Inicial
                    </label>
                    <div class="relative">
                        <select name="estado" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm">
                            <option value="a" selected> Activo (Habilitado para operar)</option>
                            <option value="i"> Inactivo (Bloqueado temporalmente)</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Botones Adaptables (Columna en móviles, Fila a la derecha en escritorio) -->
            <div class="mt-8 pt-5 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('admin.Proveedor.index') }}"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-colors text-center">
                    Cancelar
                </a>
                
                <button type="submit"
                    class="w-full sm:w-auto text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-[0_4px_12px_rgba(14,165,233,0.2)] hover:shadow-[0_6px_20px_rgba(14,165,233,0.3)] transition-all flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fas fa-save text-[11px]"></i> Guardar Proveedor
                </button>
            </div>

        </form>
    </div>

</div>

@endsection