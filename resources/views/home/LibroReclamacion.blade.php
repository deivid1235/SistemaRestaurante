@extends('layouts.app')

@section('content')

@if(session('success'))
<div id="flash-success-message" data-message="{{ session('success') }}"></div>
@endif

<section class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-3xl md:text-4xl font-extrabold text-sky-600 uppercase tracking-wider text-center md:text-left">
        Libro de Reclamaciones 
    </h2>
    <p class="text-gray-500 mt-2 text-center md:text-left text-sm md:text-base">
        Conforme a lo establecido en el Código de Protección y Defensa del Consumidor
    </p>
</section>

<section class="bg-slate-50 py-4">
    <div class="max-w-6xl mx-auto px-4">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-sky-100">

            <div class="h-2 bg-gradient-to-r from-sky-400 to-sky-600"></div>

            <div class="p-5 md:p-10">

                <form method="POST" action="{{ route('libro.reclamacion.store') }}" class="space-y-10">
                    @csrf
                   
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold shadow-md">1</div>
                            <h3 class="text-xl font-bold text-gray-800">Datos del cliente</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Tipo Doc *</label>
                                <select id="tipo_documento" name="tipo_documento" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition bg-white text-sm" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="DNI">DNI</option>
                                    <option value="CE">CE</option>
                                    <option value="RUC">RUC</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">N° Documento *</label>
                                <input id="numero_documento" type="text" name="numero_documento" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Primer Nombre *</label>
                                <input id="primer_nombre" type="text" name="primer_nombre" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Segundo Nombre</label>
                                <input id="segundo_nombre" type="text" name="segundo_nombre" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Primer Apellido *</label>
                                <input id="primer_apellido" type="text" name="primer_apellido" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Segundo Apellido</label>
                                <input id="segundo_apellido" type="text" name="segundo_apellido" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Correo *</label>
                                <input type="email" name="correo" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Teléfono *</label>
                                <input type="text" id="telefono" name="telefono" maxlength="9" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" required>
                            </div>

                            <div class="sm:col-span-2 lg:col-span-4">
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Dirección *</label>
                                <input type="text" name="direccion" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" placeholder="Av. Ejemplo 123..." required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold shadow-md">2</div>
                            <h3 class="text-xl font-bold text-gray-800">Ubicación geográfica</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Departamento *</label>
                                <select id="departamento" name="departamento" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none bg-white text-sm" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Provincia *</label>
                                <select id="provincia" name="provincia" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none bg-white text-sm" required disabled>
                                    <option value="" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Distrito *</label>
                                <select id="distrito" name="distrito" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none bg-white text-sm" required disabled>
                                    <option value="" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold shadow-md">3</div>
                            <h3 class="text-xl font-bold text-gray-800">Identificación del bien contratado</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Servicio Contratado</label>
                                <input type="text" name="servicio_contratado" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm" placeholder="Ej: Internet Hogar, Soporte...">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">N° Orden/Contrato</label>
                                <input type="text" name="numero_orden" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Monto Reclamado (S/)</label>
                                <input type="number" step="0.01" name="monto_reclamado" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold shadow-md">4</div>
                            <h3 class="text-xl font-bold text-gray-800">Detalle del reclamo</h3>
                        </div>

                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Tipo *</label>
                                    <select name="tipo_reclamo" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none bg-white text-sm" required>
                                        <option value="" disabled selected>Seleccione</option>
                                        <option value="Reclamo">Reclamo</option>
                                        <option value="Queja">Queja</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Motivo</label>
                                    <input type="text" name="motivo" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none text-sm" placeholder="Ej: Mala atención, Cobro indebido...">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Descripción del suceso *</label>
                                <textarea name="detalle_solicitud" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition resize-none text-sm" placeholder="Explique detalladamente lo sucedido..." required></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-sky-700 mb-1 uppercase">Pedido Concreto (Solución) *</label>
                                <textarea name="pedido_concreto" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 outline-none transition resize-none text-sm" placeholder="¿Qué acción espera de nuestra parte?" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" name="acepto_politicas" class="mt-1 w-5 h-5 text-sky-600 rounded border-gray-300 focus:ring-sky-500" required>
                            <span class="text-sm text-gray-600 leading-tight">
                                He leído y acepto la <a href="#" class="text-sky-600 font-bold hover:underline">Política de Privacidad</a> y el tratamiento de mis datos personales para la atención de este reclamo.
                            </span>
                        </label>

                        <div class="text-center">
                            <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-sky-500 to-sky-700 hover:from-sky-600 hover:to-sky-800 text-white font-bold px-12 py-4 rounded-2xl shadow-lg hover:shadow-sky-200 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 mx-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                ENVIAR RECLAMO
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="mt-8 bg-sky-50/50 rounded-2xl p-6 border border-sky-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-gray-600">
                <div class="space-y-2">
                    <h4 class="font-black text-sky-800 flex items-center gap-2 text-base uppercase">
                         IDENTIFICACIÓN DEL PROVEEDOR
                    </h4>
                    <p class="pl-0"><strong>GRUPO AOSC</strong><br>RUC: 20601234567<br>Domicilio: Talara, Piura, Perú<br>Central: +51 952 167 090</p>
                </div>
                <div class="space-y-2">
                    <h4 class="font-black text-sky-800 flex items-center gap-2 text-base uppercase">
                        ATENCIÓN AL CLIENTE
                    </h4>
                    <p class="pl-0">Plazo de atención: Máximo 15 días hábiles.<br>Correo de contacto: grupoaosc@gmail.com</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection