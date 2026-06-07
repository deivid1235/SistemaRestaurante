@extends('layouts.dashboard')

@section('title', isset($productoPres) ? 'Editar Presentación' : 'Nueva Presentación')

@section('content')

<div class="w-full px-0 sm:px-6 animate-fade-in text-slate-700 space-y-6">
    
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shadow-sm border border-sky-100/50 flex-shrink-0">
                <i class="fas fa-tags"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-800 tracking-tight">
                    {{ isset($productoPres) ? 'Editar Presentación' : 'Nueva Presentación' }}
                </h2>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Producto: {{ $producto->nombre }} (ID: {{ $producto->id }})
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-4 sm:p-6 shadow-sm transition-all hover:shadow-md">

        @if(isset($productoPres))
            <form action="{{ route('admin.producto_temp.update', $productoPres->id) }}" method="POST" class="space-y-6">
            @method('PUT')
        @else
            <form action="{{ route('admin.producto_pres.store') }}" method="POST" class="space-y-6">
        @endif
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">

            {{-- GRID DE 4 COLUMNAS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-barcode"></i> Código</label>
                    <input type="text" name="codigo" value="{{ $productoPres->codigo ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-box"></i> Presentación *</label>
                    <input type="text" name="presentacion" value="{{ $productoPres->presentacion ?? '' }}" required class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-dollar-sign"></i> Precio *</label>
                    <input type="number" step="0.01" id="precio" name="precio" value="{{ $productoPres->precio ?? '' }}" required class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-truck"></i> P. Delivery</label>
                    <input type="number" step="0.01" name="precio_delivery" value="{{ $productoPres->precio_delivery ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-hand-holding-usd"></i> Costo</label>
                    <input type="number" step="0.01" name="costo" value="{{ $productoPres->costo ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-layer-group"></i> Stock *</label>
                    <input type="number" name="stock" value="{{ $productoPres->stock ?? '' }}" required class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-minus-square"></i> Stock Mínimo</label>
                    <input type="number" name="stock_min" value="{{ $productoPres->stock_min ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-percentage"></i> IGV</label>
                    <input type="number" step="0.01" name="igv" value="{{ $productoPres->igv ?? 0.18 }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-receipt"></i> Receta</label>
                    <input type="text" name="receta" value="{{ $productoPres->receta ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-motorcycle"></i> Delivery</label>
                    <select name="delivery" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                        <option value="1" {{ (isset($productoPres) && $productoPres->delivery == 1) ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ (isset($productoPres) && $productoPres->delivery == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-toggle-on"></i> Estado</label>
                    <select name="estado" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                        <option value="1" {{ (isset($productoPres) && $productoPres->estado == 1) ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ (isset($productoPres) && $productoPres->estado == 0) ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="space-y-1.5 lg:col-span-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5"><i class="fas fa-align-left"></i> Descripción</label>
                    <input type="text" name="descripcion" value="{{ $productoPres->descripcion ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200 p-2.5 rounded-xl focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm">
                </div>
            </div>

            {{-- SECCIÓN QR / BARRA --}}
            <div class="mt-6 pt-5 border-t border-slate-100 grid md:grid-cols-2 gap-6">
                @if(!isset($productoPres))
                    <div class="flex gap-3">
                        <button type="button" onclick="generarQR()" class="bg-slate-100 hover:bg-sky-100 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold uppercase transition-all">Generar QR</button>
                        <button type="button" onclick="generarBarra()" class="bg-slate-100 hover:bg-sky-100 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold uppercase transition-all">Generar Barra</button>
                    </div>
                @endif
                <div class="flex gap-4 justify-end">
                    <img id="qrPreview" src="{{ isset($productoPres) ? 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data='.urlencode($producto->nombre.' - S/ '.$productoPres->precio) : '' }}" class="{{ !isset($productoPres) ? 'hidden' : '' }} w-20">
                    <img id="barraPreview" src="{{ isset($productoPres) ? 'https://barcode.tec-it.com/barcode.ashx?data='.$productoPres->codigo.'&code=Code128' : '' }}" class="{{ !isset($productoPres) ? 'hidden' : '' }} w-28">
                </div>
            </div>

            {{-- BOTONES --}}
            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.producto.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-500 font-bold text-xs uppercase hover:bg-slate-50 transition-all">Cancelar</a>
                <button type="submit" class="text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase shadow-lg shadow-sky-500/20 hover:shadow-sky-500/40 transition-all flex items-center gap-2"
                    style="background: linear-gradient(135deg, var(--primary, #0ea5e9) 0%, #0096D9 100%);">
                    <i class="fas fa-save"></i> {{ isset($productoPres) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>

@if(!isset($productoPres))
<script>
function generarQR() {
    let nombre = "{{ $producto->nombre }}";
    let precio = document.getElementById('precio').value;
    if (!precio) return alert("Ingresa el precio primero");
    let img = document.getElementById('qrPreview');
    img.src = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" + encodeURIComponent(nombre + " - S/ " + precio);
    img.classList.remove('hidden');
}
function generarBarra() {
    let codigo = document.getElementsByName('codigo')[0].value;
    if (!codigo) return alert("Ingresa el código primero");
    let img = document.getElementById('barraPreview');
    img.src = "https://barcode.tec-it.com/barcode.ashx?data=" + encodeURIComponent(codigo) + "&code=Code128";
    img.classList.remove('hidden');
}
</script>
@endif
@endsection