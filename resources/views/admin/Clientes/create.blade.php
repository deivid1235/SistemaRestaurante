@extends('layouts.dashboard')
@section('title', 'Crear Cliente')

@section('content')
<div class="w-full px-0 sm:px-0 lg:px-0 mt-10">
    <div class="flex items-center gap-2 mb-6">
        <div class="w-1 bg-blue-600 h-6 rounded-full"
            style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Registrar Cliente</h2>
    </div>

    <form method="POST" action="{{ route('admin.Clientes.store') }}" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        @csrf

        <div class="flex items-start gap-4 mb-8">
           <div class="flex items-center justify-center w-12 h-12 rounded-2xl shadow-md text-white" 
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Datos Principales</h3>
                <p class="text-sm text-gray-400">Información fundamental del cliente para el sistema.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
            
            <div class="flex flex-col items-center justify-start space-y-6">
                <div class="w-32 h-32 bg-gray-100 rounded-3xl flex items-center justify-center border-2 border-dashed border-gray-200">
                    <span class="text-5xl font-light text-gray-300">C</span>
                </div>
                
                <div class="w-full bg-slate-50 p-4 rounded-2xl flex items-center justify-between border border-gray-100">
                    <span class="text-[10px] font-bold text-blue-900 uppercase tracking-wider">¿Cliente Activo?</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="estado" value="a" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500"></div>
                    </label>
                </div>
            </div>

            <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-5">
                
                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Tipo Documento</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6h4M10 10h4M10 14h2m4 4h.01M9 21h6a2 2 0 002-2V5a2 2 0 00-2-2H9a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <select name="tipo_documento" id="tipo" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-10 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none text-slate-600 outline-none">
                            <option value="DNI">DNI</option>
                            <option value="RUC">RUC</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Número Documento</label>
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01" /></svg>
                        </div>
                        <input type="text" name="numero_documento" id="numero" placeholder="EJ: 72654321" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-12 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                        <button type="button"
                            id="btnBuscar"
                            class="absolute right-2 bg-slate-800 text-white p-1.5 rounded-xl hover:bg-slate-700 transition-colors shadow-sm">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    @error('numero_documento')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Tipo Cliente</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <select name="tipo_cliente" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-10 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none text-slate-600 outline-none">
                            <option value="1">Natural</option>
                            <option value="2">Empresa</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Nombres</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" name="nombres" id="nombres" placeholder="EJ: JUAN CARLOS" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                    </div>
                    @error('nombres')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Razón Social</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" /></svg>
                        </div>
                        <input type="text" name="razon_social" id="razon_social" placeholder="EJ: EMPRESA SAC" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring=2 focus:ring-blue-50０/２０ focus:bg-white transition-all outline-none">
                    </div>
                    @error('razon_social')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Teléfono</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <input type="text" name="telefono" id="telefono" placeholder="EJ: 987654321" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                    </div>
                    @error('telefono')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Correo Electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" name="correo" id="correo" placeholder="usuario@empresa.com" required
                            class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                    </div>
                    @error('correo')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

               <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="relative group">
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Contraseña</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" placeholder="••••••••" required
                                class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                        </div>
                        @error('password')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="relative group">
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Referencia</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="text" name="referencia" id="referencia" placeholder="Ej. Frente al parque central"
                                class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none">
                        </div>
                        @error('referencia')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1">Fecha Nacimiento</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="date" name="fecha_nac" id="fecha_nac" class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-slate-600">
                    </div>
                    @error('fecha_nac')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="md:col-span-2 relative group">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1.5 ml-1 tracking-wide">Dirección Completa</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" name="direccion" id="direccion" placeholder="Calle, Av, Jr..." class="w-full min-w-0 bg-[#f8fafc] border-none rounded-2xl py-3.5 pl-11 pr-4 text-sm text-slate-600 placeholder:text-slate-300 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all outline-none shadow-sm">
                    </div>
                    @error('direccion')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <a href="{{ route('admin.Clientes.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                ← Cancelar registro
            </a>
            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-8 rounded-2xl flex items-center gap-2 shadow-lg shadow-sky-200 transition-all transform hover:scale-[1.02]"
                    style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);">
                Guardar Cliente
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </form>
</div>

@endsection