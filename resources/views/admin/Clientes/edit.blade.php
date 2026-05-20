@extends('layouts.dashboard')
@section('title', 'Editar Cliente')

@section('content')
<div class="w-full px-0 sm:px-0 lg:px-0 mt-10">
    <div class="flex items-center gap-2 mb-6">
        <div class="w-1 bg-blue-600 h-6 rounded-full"
            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Editar Cliente: {{ $cliente->nombres }}</h2>
    </div>

    {{-- Formulario de Edición --}}
    <form method="POST" action="{{ route('admin.Clientes.update', $cliente->id) }}" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        @csrf
        @method('PUT')

        <div class="flex items-start gap-4 mb-8">
           <div class="flex items-center justify-center w-12 h-12 rounded-2xl shadow-md text-white" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Actualizar Información</h3>
                <p class="text-sm text-gray-400">Modifica los campos necesarios para actualizar el perfil del cliente.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
            
            {{-- Columna lateral: Avatar y Estado --}}
            <div class="flex flex-col items-center justify-start space-y-6">
                <div class="w-32 h-32 bg-slate-800 rounded-3xl flex items-center justify-center border-2 border-white shadow-xl">
                    <span class="text-5xl font-black text-white uppercase">{{ substr($cliente->nombres, 0, 1) }}</span>
                </div>
                
                <div class="w-full bg-slate-50 p-4 rounded-2xl flex items-center justify-between border border-gray-100">
                    <span class="text-[10px] font-bold text-blue-900 uppercase tracking-wider">
                        ¿Cliente Activo?
                    </span>
                    <input type="hidden" name="estado" value="i">

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="estado"
                            value="a"
                            class="sr-only peer"
                            {{ $cliente->estado == 'a' ? 'checked' : '' }}
                        >

                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>

                <div class="text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">ID Sistema: #{{ str_pad($cliente->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            {{-- Columna Principal: Inputs --}}
            <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-5">
                
                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Tipo Documento</label>
                    <div class="relative">
                        <select name="tipo_documento" id="tipo" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-4 pr-10 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none text-slate-600 outline-none">
                            <option value="DNI" {{ $cliente->tipo_documento == 'DNI' ? 'selected' : '' }}>DNI</option>
                            <option value="RUC" {{ $cliente->tipo_documento == 'RUC' ? 'selected' : '' }}>RUC</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Número Documento</label>
                    <div class="relative flex items-center">
                        <input type="text" name="numero_documento" id="numero" value="{{ $cliente->numero_documento }}" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                        <button type="button" id="btnBuscar" class="absolute right-2 bg-slate-800 text-white p-1.5 rounded-xl hover:bg-slate-700 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Tipo Cliente</label>
                    <div class="relative">
                        <select name="tipo_cliente" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-4 pr-10 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none text-slate-600 outline-none">
                            <option value="1" {{ $cliente->tipo_cliente == 1 ? 'selected' : '' }}>Natural</option>
                            <option value="2" {{ $cliente->tipo_cliente == 2 ? 'selected' : '' }}>Empresa</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Nombres / Apellidos</label>
                    <input type="text" name="nombres" id="nombres" value="{{ $cliente->nombres }}" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Razón Social</label>
                    <input type="text" name="razon_social" id="razon_social" value="{{ $cliente->razon_social }}" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                </div>

                <div class="relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="{{ $cliente->telefono }}" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" value="{{ $cliente->correo }}" 
                        class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Dejar en blanco para no cambiar" 
                        class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                </div>

                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">
                        Fecha Nacimiento
                    </label>

                    <input
                        type="date"
                        name="fecha_nac"
                        id="fecha_nac"
                        value="{{ $cliente->fecha_nac ? \Carbon\Carbon::parse($cliente->fecha_nac)->format('Y-m-d') : '' }}"
                        class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-slate-600"
                    >
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Dirección Completa</label>
                    <input type="text" name="direccion" id="direccion" value="{{ $cliente->direccion }}" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 px-4 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none shadow-sm">
                </div>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <a href="{{ route('admin.Clientes.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                ← Volver al listado
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-2xl flex items-center gap-2 shadow-lg shadow-blue-200 transition-all transform hover:scale-[1.02]"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                Actualizar Cliente
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
            </button>
        </div>
    </form>
</div>

@endsection