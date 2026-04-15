@extends('layouts.app')

@section('content')

@if(session('success'))
<div id="flash-success-message" data-message="{{ session('success') }}"></div>
@endif
<section class="max-w-6xl mx-auto px-6 py-6">
    
    <h2 class="text-3xl md:text-4xl font-bold text-red-500 uppercase tracking-wider">
        Libro de Reclamaciones 
    </h2>

    <p class="text-gray-500 mt-2">
        Conforme a lo establecido en el Código de Protección y Defensa del Consumidor
    </p>

</section>

<!-- FORMULARIO PRINCIPAL -->
<section class="bg-gray-50 py-4">
    <div class="max-w-6xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Barra superior decorativa -->
            <div class="h-2 bg-gradient-to-r from-red-500 to-red-700"></div>

            <div class="p-6 md:p-8 lg:p-10">

                <form method="POST" action="{{ route('libro.reclamacion.store') }}" class="space-y-8">
                    @csrf
                   
                    <!-- DATOS DEL CLIENTE -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">1</div>
                            <h3 class="text-xl font-semibold text-gray-800">Datos del cliente</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Doc *</label>
                                <select id="tipo_documento" name="tipo_documento"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                                    <option disabled selected>Seleccione</option>
                                    <option value="DNI">DNI</option>
                                    <option value="CE">CE</option>
                                    <option value="RUC">RUC</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">N° Documento *</label>
                                <input id="numero_documento" type="text" name="numero_documento"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Primer Nombre *</label>
                                <input id="primer_nombre" type="text" name="primer_nombre"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Segundo Nombre</label>
                                <input id="segundo_nombre" type="text" name="segundo_nombre"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Primer Apellido *</label>
                                <input id="primer_apellido" type="text" name="primer_apellido"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Segundo Apellido</label>
                                <input id="segundo_apellido" type="text" name="segundo_apellido"  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico *</label>
                                <input type="email" name="correo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar correo</label>
                                <input type="email" name="confirmar_correo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" >
                            </div>

                           <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" maxlength="9" inputmode="numeric" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                            </div>
                            <div class="w-full col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección *</label>
                                <input type="text" name="direccion" class="w-full px-4 py-2.5 border border-gray-500 rounded-lg  focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition"
                                    placeholder="Av....">
                            </div>
                        </div>
                    </div>

                    <!-- ================= SECCIÓN 2: UBICACIÓN GEOGRÁFICA ================= -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">2</div>
                            <h3 class="text-xl font-semibold text-gray-800">Ubicación geográfica</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                                <select id="departamento" name="departamento" class="form-select input-reclamaciones" required>
                                    <option value="" selected disabled>Seleccione un departamento...</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                                <select id="provincia" name="provincia"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-white"
                                    disabled>
                                    <option selected disabled>Seleccione una provincia...</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                                <select id="distrito" name="distrito"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-white"
                                    disabled>
                                    <option selected disabled>Seleccione un distrito...</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- ================= SECCIÓN 3: INFORMACIÓN DEL SERVICIO ================= -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">3</div>
                            <h3 class="text-xl font-semibold text-gray-800">Información del servicio</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Servicio contratado</label>
                                <input type="text" name="servicio_contratado" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Ej: Delivery, Comedor, Reserva">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">N° Orden / Ticket</label>
                                <input type="text" name="numero_orden" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Ej: ORD-12345 (opcional)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Identificación del servicio</label>
                                <input type="text" name="identificacion_servicio" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Ej: Mesa 5, Pedido #123 (opcional)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Monto reclamado (S/.)</label>
                                <input type="number" step="0.01" name="monto_reclamado" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Ej: 150.00 (opcional)">
                            </div>
                        </div>
                    </div>

                    <!-- ================= SECCIÓN 4: TIPO DE RECLAMO ================= -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">4</div>
                            <h3 class="text-xl font-semibold text-gray-800">Tipo de reclamo</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Seleccione el tipo *</label>
                                <select name="tipo_reclamo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition bg-white" required>
                                    <option disabled selected>Seleccione</option>
                                    <option>Reclamo</option>
                                    <option>Queja</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Motivo</label>
                                <input type="text" name="motivo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Ej: Producto defectuoso, Demora, etc.">
                            </div>
                        </div>
                    </div>

                    <!-- ================= SECCIÓN 5: DETALLE DEL RECLAMO ================= -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold">5</div>
                            <h3 class="text-xl font-semibold text-gray-800">Detalle del reclamo</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción del reclamo *</label>
                                <textarea name="detalle_solicitud" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition resize-none" placeholder="Describa detalladamente el motivo de su reclamo o queja..." required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pedido concreto / Solución esperada *</label>
                                <textarea name="pedido_concreto" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition resize-none" placeholder="¿Qué solución solicita? (Ej: devolución del dinero, reposición del producto, descuento, etc.)" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ================= CHECKBOX Y BOTÓN ================= -->
                    <div class="space-y-6">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="acepto_politicas" class="w-5 h-5 text-red-600 rounded border-gray-300 focus:ring-red-500" value="1" required>
                            <span class="text-gray-700">
                                He leído y acepto la
                                <a href="#" class="text-red-600 hover:underline">Política de Privacidad</a>
                                y el tratamiento de mis datos personales.
                            </span>
                        </label>

                        <div class="text-center pt-4">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Enviar Reclamo
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- TEXTO LEGAL -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-gray-200 shadow-sm">
            <div class="flex flex-col md:flex-row gap-4 text-sm text-gray-600 leading-relaxed">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        GRUPO AOSC
                    </h4>
                    <p>RUC: 20601234567<br>
                    Domicilio: Perú - Piura - Talara<br>
                    Teléfono: +51 952 167 090</p>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Protección de Datos
                    </h4>
                    <p>Correo: grupoaosc@gmail.com<br>
                    Plazo de respuesta: 15 días hábiles<br>
                    Derechos ARCO: acceso, rectificación y eliminación</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 text-xs text-gray-500 text-center">
                La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante INDECOPI.
            </div>
        </div>

    </div>
</section>

@endsection