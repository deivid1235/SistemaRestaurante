@extends('layouts.dashboard')
@section('title', 'Configuración Visual')

@section('content')
<div class="bg-white p-4 rounded-2xl shadow-md">

    {{-- TÍTULO --}}
    <h2 class="text-base font-medium mb-4 flex items-center gap-2">
        <i class="fa fa-palette text-blue-600 text-sm"></i>
        Configuración de apariencia
    </h2>

    {{-- MENSAJE DE ÉXITO --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-3 py-2 rounded-lg mb-4 text-xs">
            {{ session('success') }}
        </div>
    @endif

    {{-- GRID 2 COLUMNAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">

        {{-- COLUMNA IZQUIERDA --}}
        <div class="border border-gray-200 rounded-xl p-4">

            <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-100">
                <i class="fa fa-images text-blue-600 text-xs"></i>
                <h3 class="text-xs font-medium text-gray-700">Configuración visual</h3>
            </div>

            <p class="text-xs text-gray-400 mb-1">Subir imagen</p>

            <div id="dropZone"
                 class="border border-dashed border-gray-300 rounded-lg bg-gray-50 py-3
                        text-center cursor-pointer hover:border-blue-400 transition"
                 onclick="document.getElementById('fileInput').click()">
                <i class="fa fa-upload text-gray-300 text-base mb-1 block"></i>
                <p class="text-xs text-gray-400">Clic para seleccionar</p>
                <p class="text-xs text-gray-300 mt-0.5">JPG, PNG o SVG · 747 × 547 px</p>
            </div>

            <form action="{{ route('config.visual.upload') }}" method="POST"
                  enctype="multipart/form-data" id="uploadForm">
                @csrf
                <input type="file" id="fileInput" name="imagen"
                       accept="image/png,image/jpeg,image/jpg,image/svg+xml"
                       class="hidden" onchange="handlePreview(this)">
            </form>

            <div id="previewSection" class="hidden mt-2">
                <p class="text-xs text-gray-400 mb-1">Vista previa</p>
                <img id="previewImg" src="" alt="preview"
                     class="w-full max-w-sm mx-auto h-28 object-cover rounded-lg mb-2 block">
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="cancelUpload()"
                            class="text-xs text-red-400 border border-red-200 rounded-md
                                   px-2 py-1 hover:bg-red-50 transition">
                        <i class="fa fa-xmark"></i> Cancelar
                    </button>
                    <button type="button"
                            onclick="document.getElementById('uploadForm').submit()"
                            class="text-xs text-white bg-blue-600 rounded-md px-2 py-1
                                   hover:bg-blue-700 transition flex items-center gap-1">
                        <i class="fa fa-check"></i> Guardar
                    </button>
                </div>
            </div>

            {{-- Galería --}}
            <div class="mt-3 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-400 mb-2">Imágenes del carrusel</p>

                @php
                $imgs = collect($imagenes)->values();
                @endphp

                @if($imgs->count() > 0)

                    {{-- Preview principal con flechas superpuestas --}}
                    <div class="relative w-full max-w-sm mx-auto mb-1">

                        <img id="activeImg"
                             src="{{ asset('carrusel/' . $imgs[0]) }}"
                             class="w-full h-32 object-cover rounded-lg block">

                        <button type="button" id="btnPrev" onclick="navigate(-1)"
                                class="absolute left-1.5 top-1/2 -translate-y-1/2
                                       w-6 h-6 bg-white border border-gray-200 rounded-full
                                       flex items-center justify-center shadow-sm
                                       hover:bg-gray-50 disabled:opacity-30
                                       disabled:cursor-not-allowed transition">
                            <i class="fa fa-chevron-left text-gray-500" style="font-size:9px"></i>
                        </button>

                        <button type="button" id="btnNext" onclick="navigate(1)"
                                class="absolute right-1.5 top-1/2 -translate-y-1/2
                                       w-6 h-6 bg-white border border-gray-200 rounded-full
                                       flex items-center justify-center shadow-sm
                                       hover:bg-gray-50 disabled:opacity-30
                                       disabled:cursor-not-allowed transition">
                            <i class="fa fa-chevron-right text-gray-500" style="font-size:9px"></i>
                        </button>

                    </div>

                    {{-- Contador --}}
                    <p class="text-xs text-gray-400 text-center mb-2 max-w-sm mx-auto"
                       id="counterText">
                        1 / {{ $imgs->count() }}
                    </p>

                    {{-- Eliminar --}}
                    <div class="flex justify-end max-w-sm mx-auto mb-2">
                        <form id="deleteForm" action="{{ route('config.visual.delete') }}"
                              method="POST" onsubmit="return confirm('¿Eliminar imagen?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="imagen" id="deleteInput"
                                   value="{{ $imgs[0] }}">
                            <button type="submit"
                                    class="text-xs text-red-400 border border-red-200 rounded-md
                                           px-2 py-1 hover:bg-red-50 transition">
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>

                    {{-- Miniaturas --}}
                    <div class="flex gap-1.5 flex-wrap max-w-sm mx-auto" id="thumbRow">
                        @foreach($imgs as $i => $img)
                            <div class="thumb-item cursor-pointer rounded-md overflow-hidden
                                        border-2 transition shrink-0
                                        {{ $i === 0 ? 'border-blue-500' : 'border-transparent' }}"
                                 onclick="selectThumb({{ $i }})">
                                <img src="{{ asset('carrusel/' . $img) }}"
                                     class="w-12 h-9 object-cover block">
                            </div>
                        @endforeach
                    </div>

                @else
                    <p class="text-xs text-gray-300 italic">No hay imágenes en el carrusel.</p>
                @endif

                <button type="button"
                        onclick="document.getElementById('fileInput').click()"
                        class="mt-2 w-full max-w-sm mx-auto flex items-center justify-center
                               gap-1 text-xs border border-gray-200 rounded-md py-1.5
                               hover:bg-gray-50 transition text-gray-500">
                    <i class="fa fa-plus text-xs"></i> Agregar imagen
                </button>
            </div>

        </div>

        {{-- COLUMNA DERECHA: Modo de Color --}}
        <div class="border border-gray-200 rounded-xl p-4">
            <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-100">
                <i class="fa fa-circle-half-stroke text-purple-600 text-xs"></i>
                <h3 class="text-xs font-medium text-gray-700">Modo de color</h3>
            </div>

            <p class="text-xs text-gray-400 mb-2">Tema de la interfaz</p>

            <form action="{{ route('config.visual.tema') }}" method="POST">
                @csrf

                {{-- COLOR PICKER --}}
                <div class="pt-3 border-t border-gray-100 mb-3">
                    <p class="text-xs text-gray-400 mb-2">Color de acento</p>

                    {{-- PICKER + LABEL en una fila --}}
                    <div class="flex items-center gap-3">
                        <input type="color"
                            name="accent_color"
                            id="colorPicker"
                            value="{{ session('accent_color', '#1e88b6') }}"
                            class="w-10 h-10 cursor-pointer rounded-lg border border-gray-300 p-0.5">

                        <span class="text-xs text-gray-500">Elige el color del menú</span>
                    </div>
                </div>

                {{-- BOTÓN PEQUEÑO Y A LA DERECHA --}}
                <div class="flex justify-end">
                    <button type="submit"
                            class="mt-2 w-full max-w-sm mx-auto flex items-center justify-center
                               gap-1 text-xs border border-gray-200 rounded-md py-1.5
                               hover:bg-gray-50 transition text-gray-500">
                        Guardar
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@push('scripts')
<script>
    window.carruselImages = @json(
        collect($imagenes)->values()->map(function ($img) {
            return [
                'src' => asset('carrusel/' . $img),
                'name' => $img
            ];
        })
    );
</script>
@endpush
@endsection