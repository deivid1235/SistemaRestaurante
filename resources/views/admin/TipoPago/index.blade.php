@extends('layouts.dashboard')
@section('title', 'Ajustes')

@section('content')

<!-- BOTÓN PARA ABRIR MODAL -->
<button href="{{ route('Metodopago.index') }}"
    class="bg-blue-600 text-white px-4 py-2 rounded-lg">
    Métodos de Pago
</button>

<!-- MODAL -->
<div id="modalPago" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-lg p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-gray-800">Métodos de Pago</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-500">✖</button>
        </div>

        <!-- FORM AGREGAR -->
        <form action="{{ route('MetodoPago.store') }}" method="POST" class="flex gap-2 mb-4">
            @csrf
            <input type="text" name="descripcion" placeholder="Nuevo método (Ej: YAPE)"
                class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <button type="submit" 
                class="bg-green-600 text-white px-4 py-2 rounded-lg">
                Agregar
            </button>
        </form>

        <!-- LISTA -->
        <div class="max-h-60 overflow-y-auto">
            <table class="w-full text-sm text-gray-700">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">#</th>
                        <th class="text-left py-2">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($metodos as $metodo)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $metodo->id }}</td>
                        <td class="py-2">{{ $metodo->descripcion }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>


@endsection