@extends('layouts.dashboard')
@section('title', 'Configuración Visual')

@section('content')
<div class="max-w-8xl mx-auto space-y-5 animate-fade-in text-gray-800">
    <div class="relative overflow-hidden rounded-2xl p-7 text-white shadow-md"
         style="background: linear-gradient(135deg, var(--primary) 0%, #4fc3f7 100%);">
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] uppercase tracking-wider font-bold">
                    SYSTEM CONTROL
                </span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight">Configuraciones</h1>
            <p class="text-base font-light opacity-90 max-w-md">Personaliza la identidad visual y los parámetros globales de tu plataforma.</p>
        </div>
        <div class="absolute top-[-30%] right-[-5%] w-56 h-56 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-100 rounded-2xl p-4 sticky top-6 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 mb-4 tracking-widest uppercase px-1 text-center">Navegación</p>
                <nav class="space-y-1.5">
                    <div onclick="showTab('login')" data-tab="login"
                         class="tab-button group flex items-center gap-3 p-3.5 rounded-xl cursor-pointer transition-all bg-[var(--primary)] text-white shadow-md shadow-primary/20">
                        <div class="w-6 h-6 flex items-center justify-center rounded bg-white/20">
                            <i class="fa fa-right-to-bracket text-xs"></i>
                        </div>
                        <span class="text-sm font-bold">Configuración del Login</span>
                    </div>

                    <div onclick="showTab('empresa')" data-tab="empresa"
                         class="tab-button group flex items-center gap-3 p-3.5 rounded-xl cursor-pointer transition-all hover:bg-gray-50 text-gray-600 hover:text-[var(--primary)]">
                        <div class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 group-hover:bg-primary/10 transition-colors">
                            <i class="fa fa-user text-xs"></i>
                        </div>
                        <span class="text-sm font-semibold">Perfil de Usuario</span>
                    </div>

                    <div onclick="showTab('apariencia')" data-tab="apariencia"
                         class="tab-button group flex items-center gap-3 p-3.5 rounded-xl cursor-pointer transition-all hover:bg-gray-50 text-gray-600 hover:text-[var(--primary)]">
                        <div class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 group-hover:bg-primary/10 transition-colors">
                            <i class="fa fa-palette text-xs"></i>
                        </div>
                        <span class="text-sm font-semibold">Tema Visual</span>
                    </div>
                </nav>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-5">
            
            <div id="tab-login" class="tab-content bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Galería del Carrusel</h3>
                    <p class="text-sm text-gray-500">Optimiza la primera impresión visual de tus usuarios.</p>
                </div>
                
                <div class="p-6 grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <form action="{{ route('config.visual.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="group relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50/50 hover:bg-blue-50/50 hover:border-blue-300 transition-all">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <i class="fa fa-cloud-arrow-up text-2xl text-blue-500 mb-3 group-hover:scale-110 transition-transform"></i>
                                    <p class="text-sm text-gray-700 font-bold">Haz clic para subir</p>
                                    <p class="text-[10px] text-gray-400 mt-1 uppercase">PNG, JPG o WEBP (Máx. 2MB)</p>
                                </div>
                                <input type="file" name="imagen" class="hidden" accept="image/*" onchange="previewImage(event)" required />
                            </label>

                            <button type="submit" class="mt-4 w-full py-3.5 bg-[#1e293b] text-white rounded-xl font-bold shadow-lg hover:bg-black transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-wide">
                                <i class="fa fa-plus-circle"></i> Confirmar Subida
                            </button>
                        </form>
                    </div>

                    <div class="bg-gray-50/80 rounded-2xl p-5 border border-gray-100">
                        <div class="flex items-center justify-between mb-6 px-1">
                            <span class="text-sm font-bold text-gray-700 flex items-center gap-2">
                                <i class="fa fa-images text-blue-500"></i> Biblioteca Actual
                            </span>
                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Recientes primero</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 max-h-[350px] overflow-y-auto pr-2 custom-scrollbar">
                            {{-- Se usa reverse() para que la última subida esté al inicio --}}
                            @forelse(collect($imagenes ?? [])->reverse() as $img)
                                <div class="relative bg-white rounded-2xl border border-gray-100 p-2 shadow-sm flex flex-col group animate-scale-up">
                                    <div class="flex items-center justify-between mb-2 px-1">
                                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-tighter">Imagen</span>
                                        <form action="{{ route('config.visual.delete') }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <input type="hidden" name="imagen" value="{{ $img }}">
                                            <button type="submit" class="w-6 h-6 rounded-full bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                                <i class="fa fa-times text-[10px] font-black"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="rounded-xl overflow-hidden aspect-video border border-gray-50 shadow-inner">
                                        <img src="{{ asset('carrusel/' . $img) }}" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 py-12 text-center text-gray-400 italic text-xs bg-white rounded-2xl border border-dashed">
                                    No hay imágenes registradas.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-empresa" class="tab-content hidden animate-fade-in bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col items-center">
                <h3 class="text-xl font-bold text-gray-800 mb-8 self-start">Ajustes del Perfil</h3>
                <div class="relative group">
                    <div class="w-40 h-40 rounded-full ring-4 ring-gray-50 overflow-hidden shadow-2xl transition-transform group-hover:scale-105 duration-500">
                        <img id="companyLogoPreview" 
                             src="{{ $logo ? asset($logo) : asset('perfil/default.png') }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <button onclick="document.getElementById('companyLogo').click()" 
                            class="absolute bottom-2 right-2 w-10 h-10 bg-white text-gray-700 rounded-full shadow-lg border border-gray-100 flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                        <i class="fa fa-camera text-sm"></i>
                    </button>
                </div>
                
                <form action="{{ route('config.perfil.logo') }}" method="POST" enctype="multipart/form-data" class="mt-10 w-full max-w-xs">
                    @csrf
                    <input type="file" name="logo" id="companyLogo" class="hidden" onchange="previewCompanyLogo(event)">
                    <button type="submit" class="w-full py-4 bg-[#0a4d8c] text-white rounded-xl font-bold shadow-md hover:brightness-110 transition-all text-sm uppercase tracking-widest">
                        Actualizar Foto
                    </button>
                </form>
            </div>

            <div id="tab-apariencia" class="tab-content hidden animate-fade-in bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Paleta de Colores</h3>
                <div class="bg-gray-50 rounded-3xl p-8 flex items-center gap-10 border border-gray-100">
                    <input type="color" id="accentColor" value="{{ $accent ?? '#040710' }}" 
                           class="w-28 h-28 rounded-3xl border-0 cursor-pointer shadow-xl bg-transparent"
                           oninput="applyColor(this.value)">

                    <div class="flex-1 space-y-5">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Color Seleccionado</label>
                            <input type="text" id="hexValue" value="{{ $accent ?? '#040710' }}" 
                                   class="text-3xl font-mono font-bold bg-transparent border-none focus:ring-0 p-0 text-gray-800 uppercase"
                                   oninput="applyColor(this.value)">
                        </div>
                        
                        <button onclick="guardarColorActual('{{ route('config.visual.color') }}', '{{ csrf_token() }}')"
                                class="px-8 py-3 bg-[#111827] text-white rounded-xl font-bold text-sm flex items-center gap-3 hover:bg-black transition-all shadow-lg">
                            Guardar Configuración <i class="fa fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-10 px-2">
                    <p class="text-[11px] font-bold text-gray-400 uppercase mb-5 tracking-widest">Historial de Temas</p>
                    <div class="flex flex-wrap gap-4">
                        @foreach($savedColors ?? [] as $color)
                            <div class="w-12 h-12 rounded-xl cursor-pointer shadow-md hover:scale-110 transition-all border-2 border-white ring-1 ring-gray-100"
                                 style="background: {{ $color }}"
                                 onclick="applyColor('{{ $color }}')"></div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection