@extends('layouts.dashboard')
@section('title', 'Editar Apertura de Caja')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">
    
    <div class="group relative overflow-hidden rounded-2xl p-6 text-white shadow-md transition-all duration-500"
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                    <i class="fa fa-edit text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Editar Apertura de Caja</h1>
                    <p class="text-xs font-light opacity-90 mt-0.5">Modifique los parámetros o complete los datos de cierre del registro seleccionado.</p>
                </div>
            </div>
            <a href="{{ route('admin.AperturaCaja.index') }}" 
                class="flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl font-semibold text-xs transition-all hover:bg-white hover:text-[#0096D9] active:scale-95">
                <i class="fa fa-arrow-left text-[10px]"></i> Volver al listado
            </a>
        </div>
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
        
        <div class="group relative flex flex-col items-center justify-center p-6 overflow-hidden text-center select-none min-h-[340px]">
            <div class="absolute w-72 h-72 rounded-full bg-sky-200/30 blur-3xl top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-700 group-hover:scale-125"></div>
            <div class="absolute w-56 h-56 rounded-full bg-blue-200/20 blur-3xl top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-700 group-hover:scale-95"></div>

            <div class="relative z-10 flex flex-col items-center gap-6">
                
                <div class="relative flex items-center justify-center w-48 h-48">
                    <div class="absolute inset-0 rounded-full bg-sky-400/10 scale-125 animate-ping duration-[3s]"></div>
                    <div class="absolute inset-6 rounded-full bg-blue-400/5 scale-110 animate-ping duration-[2s]"></div>
                    
                    <div class="transition-all duration-500 group-hover:scale-110 drop-shadow-[0_10px_20px_rgba(0,150,217,0.25)]">
                        <i class="fa fa-cash-register text-9xl transition-transform duration-500 group-hover:rotate-2"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        </i>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <h4 class="text-sm font-black text-gray-400 tracking-widest uppercase">
                        Modo Edición
                    </h4>
                    <div class="h-0.5 w-8 bg-sky-400 mx-auto rounded-full transition-all duration-500 group-hover:w-16"></div>
                    <p class="text-xs font-medium text-gray-500/90 max-w-[260px] mx-auto pt-1 leading-relaxed">
                        Está modificando la apertura activa de turno. Asegúrese de guardar los cambios para auditar las diferencias financieras correctamente.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 lg:col-span-2">
            <form action="{{ route('admin.AperturaCaja.update', $apertura->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa fa-info-circle text-xs"></i> Información General
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Usuario <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="usuario_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 appearance-none">
                                    <option value="">Seleccione usuario</option>
                                    @foreach($usuarios as $u)
                                        <option value="{{ $u->id }}" {{ $apertura->usuario_id == $u->id ? 'selected' : '' }}>
                                            {{ $u->nombres }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fa fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Caja <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="caja_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 appearance-none">
                                    <option value="">Seleccione caja</option>
                                    @foreach($cajas as $c)
                                        <option value="{{ $c->id }}" {{ $apertura->caja_id == $c->id ? 'selected' : '' }}>
                                            {{ $c->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fa fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Turno <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="turno_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 appearance-none">
                                    <option value="">Seleccione turno</option>
                                    @foreach($turnos as $t)
                                        <option value="{{ $t->id }}" {{ $apertura->turno_id == $t->id ? 'selected' : '' }}>
                                            {{ $t->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fa fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa fa-money-bill-wave text-xs"></i> Control de Apertura
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Fecha Apertura <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="fecha_apertura" required 
                                value="{{ $apertura->fecha_apertura ? date('Y-m-d\TH:i', strtotime($apertura->fecha_apertura)) : '' }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Monto Apertura <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3.5 text-sm font-semibold text-gray-400">S/</span>
                                <input type="number" step="0.01" name="monto_apertura" required placeholder="0.00"
                                    value="{{ $apertura->monto_apertura }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-3 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 font-medium">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa fa-history text-xs"></i> Datos de Cierre (Opcionales)
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Fecha Cierre</label>
                            <input type="datetime-local" name="fecha_cierre"
                                value="{{ $apertura->fecha_cierre ? date('Y-m-d\TH:i', strtotime($apertura->fecha_cierre)) : '' }}"
                                class="w-full bg-gray-50 border border-gray-100 rounded-xl px-3 py-2 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Monto Cierre</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-xs text-gray-400">S/</span>
                                <input type="number" step="0.01" name="monto_cierre" placeholder="0.00"
                                    value="{{ $apertura->monto_cierre }}"
                                    class="w-full bg-gray-50 border border-gray-100 rounded-xl pl-8 pr-3 py-2 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Monto Sistema</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-xs text-gray-400">S/</span>
                                <input type="number" step="0.01" name="monto_sistema" placeholder="0.00"
                                    value="{{ $apertura->monto_sistema }}"
                                    class="w-full bg-gray-50 border border-gray-100 rounded-xl pl-8 pr-3 py-2 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Estado</label>
                            <div class="relative">
                                <select name="estado" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-3 py-2 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 appearance-none">
                                    <option value="a" {{ $apertura->estado == 'a' || $apertura->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="c" {{ $apertura->estado == 'c' || $apertura->estado == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fa fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Observación</label>
                    <textarea name="observacion" rows="3" placeholder="Ingrese alguna anotación u observación si es necesario..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none transition-all focus:bg-white focus:border-[#0096D9] focus:ring-4 focus:ring-sky-100 resize-none">{{ $apertura->observacion }}</textarea>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3.5 text-white font-bold text-xs rounded-xl shadow-lg shadow-sky-100 transition-all hover:opacity-90 active:scale-95 uppercase tracking-widest"
                        style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                        <i class="fa fa-sync text-sm"></i> Actualizar Apertura
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection