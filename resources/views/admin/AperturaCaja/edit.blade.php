@extends('layouts.dashboard')
@section('title', 'Editar Apertura de Caja')

@section('content')

<div class="w-full px-0 sm:px-6 animate-fade-in text-slate-700 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shadow-sm border border-sky-100/50 flex-shrink-0">
                <i class="fas fa-edit"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">
                    Editar Apertura de Caja
                </h2>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Modifique los parámetros o complete los datos de cierre del registro seleccionado
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-4 sm:p-6 shadow-sm transition-all hover:shadow-md">

        <form action="{{ route('admin.AperturaCaja.update', $apertura->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-user text-slate-400"></i> Usuario <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="usuario_id" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm" required>
                            <option value="" disabled>Seleccione usuario</option>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->id }}" {{ $apertura->usuario_id == $u->id ? 'selected' : '' }}>
                                    {{ $u->nombres }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-box text-slate-400"></i> Caja <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="caja_id" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm" required>
                            <option value="" disabled>Seleccione caja</option>
                            @foreach($cajas as $c)
                                <option value="{{ $c->id }}" {{ $apertura->caja_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-clock text-slate-400"></i> Turno <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="turno_id" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm" required>
                            <option value="" disabled>Seleccione turno</option>
                            @foreach($turnos as $t)
                                <option value="{{ $t->id }}" {{ $apertura->turno_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-calendar-alt text-slate-400"></i> Fecha Apertura <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" name="fecha_apertura"
                        value="{{ $apertura->fecha_apertura ? date('Y-m-d\TH:i', strtotime($apertura->fecha_apertura)) : '' }}"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm" required>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-money-bill-wave text-slate-400"></i> Monto Apertura <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-sm font-semibold text-slate-400">S/</span>
                        <input type="number" step="0.01" name="monto_apertura" placeholder="0.00"
                            value="{{ $apertura->monto_apertura }}"
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 pl-9 pr-3 p-2.5 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-calendar-check text-slate-400"></i> Fecha Cierre (Opcional)
                    </label>
                    <input type="datetime-local" name="fecha_cierre"
                        value="{{ $apertura->fecha_cierre ? date('Y-m-d\TH:i', strtotime($apertura->fecha_cierre)) : '' }}"
                        class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-coins text-slate-400"></i> Monto Cierre (Opcional)
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-sm font-semibold text-slate-400">S/</span>
                        <input type="number" step="0.01" name="monto_cierre" placeholder="0.00"
                            value="{{ $apertura->monto_cierre }}"
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 pl-9 pr-3 p-2.5 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-laptop-code text-slate-400"></i> Monto Sistema (Opcional)
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-sm font-semibold text-slate-400">S/</span>
                        <input type="number" step="0.01" name="monto_sistema" placeholder="0.00"
                            value="{{ $apertura->monto_sistema }}"
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 pl-9 pr-3 p-2.5 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-toggle-on text-slate-400"></i> Estado
                    </label>
                    <div class="relative">
                        <select name="estado" 
                            class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 p-2.5 px-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all appearance-none outline-none font-medium text-sm">
                            <option value="a" {{ $apertura->estado == 'a' || $apertura->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="c" {{ $apertura->estado == 'c' || $apertura->estado == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fas fa-comment-alt text-slate-400"></i> Observación
                </label>
                <textarea name="observacion" rows="3" placeholder="Ingrese alguna anotación u observación si es necesario..."
                    class="w-full bg-slate-50/60 border border-slate-200 text-slate-700 px-4 py-3 rounded-xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none font-medium text-sm resize-none">{{ $apertura->observacion }}</textarea>
            </div>

            <div class="mt-8 pt-5 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('admin.AperturaCaja.index') }}"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-colors text-center">
                    Cancelar
                </a>
                
                <button type="submit"
                    class="w-full sm:w-auto text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-[0_4px_12px_rgba(14,165,233,0.2)] hover:shadow-[0_6px_20px_rgba(14,165,233,0.3)] transition-all flex items-center justify-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                    <i class="fas fa-sync text-[11px]"></i> Actualizar Apertura
                </button>
            </div>

        </form>
    </div>
</div>

@endsection