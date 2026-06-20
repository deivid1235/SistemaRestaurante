<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<div style="width: 210mm; max-width: 100%; margin: 0 auto; padding: 20px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333; background-color: #fff; line-height: 1.5; box-sizing: border-box;">

    {{-- CABECERA (Logo / Datos Empresa vs Recuadro Fiscal RUC) --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
        <tr>
            <td style="vertical-align: top; width: 60%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        @php
                            $empresa = $venta->empresa ?? null;
                        @endphp
                        <td style="vertical-align: top; width: 75px; padding-right: 15px;">
                            <div style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; border: 2px solid #e5e7eb; background-color: #f9fafb;">
                                <img 
                                    src="{{ $empresa && $empresa->logo 
                                        ? asset('storage/' . $empresa->logo) 
                                        : asset('iconos/Empresa.jpg') }}"
                                    style="width: 70px; height: 70px; object-fit: cover;"
                                >
                            </div>
                        </td>
                        <td style="vertical-align: top;">
                            <div style="font-weight: bold; font-size: 24px; color: #1f2937; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px;">
                                {{ $venta->empresa->nombre ?? 'GRUPOAOSC' }}
                            </div>
                            <div style="font-size: 13px; color: #4b5563; text-transform: uppercase; font-weight: bold; margin-bottom: 8px;">
                                {{ $venta->empresa->razon_social ?? 'SANCHEZ CASTILLO ALEX OMAR' }}
                            </div>
                            <div style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                <p style="margin: 2px 0;"><strong>Dirección:</strong> PERU</p>
                                <p style="margin: 2px 0;"><strong>Teléfono:</strong> {{ $venta->empresa->telefono ?? '952167090' }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            
            <td style="vertical-align: top; width: 40%; text-align: center;">
                <div style="border: 2px solid #000; padding: 15px; border-radius: 8px; background-color: #f9fafb;">
                    <div style="font-size: 16px; font-weight: bold; color: #000; margin-bottom: 5px;">
                        RUC: {{ $venta->empresa->ruc ?? '10038965161' }}
                    </div>
                    <div style="font-size: 15px; font-weight: bold; color: #1f2937; text-transform: uppercase; margin: 8px 0; letter-spacing: 0.5px;">
                        {{ $venta->tipoDocumento->nombre ?? 'BOLETA DE VENTA ELECTRÓNICA' }}
                    </div>
                    <div style="font-size: 18px; font-weight: bold; color: #ff0000; margin-top: 5px;">
                        {{ $venta->serie_doc ?? 'BA01' }} - {{ $venta->nro_doc ?? '00000133' }}
                    </div>
                </div>
            </td>
        </tr>
    </table>

    {{-- DATOS DEL CLIENTE Y EMISIÓN --}}
    <div style="border: 1px solid #e5e7eb; border-radius: 6px; padding: 12px; margin-bottom: 25px; background-color: #f9fafb;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td style="padding: 4px 0; vertical-align: top; width: 12%; font-weight: bold; color: #111;">Señor(es):</td>
                <td style="padding: 4px 0; vertical-align: top; color: #4b5563; text-transform: uppercase;">{{ $venta->cliente->nombres ?? 'SIN CLIENTE' }}</td>
                <td style="padding: 4px 0; vertical-align: top; width: 12%; font-weight: bold; color: #111; text-align: right; padding-right: 15px;">Fecha:</td>
                <td style="padding: 4px 0; vertical-align: top; width: 25%; color: #4b5563;">{{ $venta->fecha_emision ?? '2026-06-19 00:13:52' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px 0; vertical-align: top; font-weight: bold; color: #111;">DNI/RUC:</td>
                <td style="padding: 4px 0; vertical-align: top; color: #4b5563;">{{ $venta->cliente->numero_documento ?? '20508565934' }}</td>
                @if(isset($venta->usuario))
                <td style="padding: 4px 0; vertical-align: top; font-weight: bold; color: #111; text-align: right; padding-right: 15px;">Cajero:</td>
                <td style="padding: 4px 0; vertical-align: top; color: #4b5563;">{{ $venta->usuario->nombres ?? 'IMAN BRUNO DEIVID DAVID' }}</td>
                @else
                <td colspan="2"></td>
                @endif
            </tr>
        </table>
    </div>

    {{-- TABLA DE PRODUCTOS (Estilo Factura A4) --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 13px;">
        <thead>
            <tr style="background-color: #1f2937; color: #ffffff;">
                <th style="text-align: center; padding: 8px; font-weight: bold; width: 8%; border: 1px solid #1f2937;">CANT.</th>
                <th style="text-align: left; padding: 8px; font-weight: bold; width: 62%; border: 1px solid #1f2937;">DESCRIPCIÓN</th>
                <th style="text-align: right; padding: 8px; font-weight: bold; width: 15%; border: 1px solid #1f2937;">P. UNITARIO</th>
                <th style="text-align: right; padding: 8px; font-weight: bold; width: 15%; border: 1px solid #1f2937;">IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            @if($venta && $venta->detalles)
                @foreach($venta->detalles as $item)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px; text-align: center; border: 1px solid #e5e7eb;">{{ $item->cantidad }}</td>
                        <td style="padding: 10px; text-transform: uppercase; border: 1px solid #e5e7eb;">{{ $item->producto->nombre ?? '-' }}</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #e5e7eb;">{{ number_format($item->precio, 2) }}</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #e5e7eb;">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            @else
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 10px; text-align: center; border: 1px solid #e5e7eb;">1</td>
                    <td style="padding: 10px; text-transform: uppercase; border: 1px solid #e5e7eb;">EXTRA ARROZ</td>
                    <td style="padding: 10px; text-align: right; border: 1px solid #e5e7eb;">5.00</td>
                    <td style="padding: 10px; text-align: right; border: 1px solid #e5e7eb;">5.00</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- TOTALES, IMPORTE EN LETRAS Y QR --}}
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <tr>
            <td style="vertical-align: top; width: 65%;">
                <div style="margin-bottom: 15px; font-size: 12px; border-bottom: 1px dashed #ccc; padding-bottom: 8px;">
                    <span style="font-weight: bold; color: #000;">SON:</span> 
                    <span style="color: #333; text-transform: uppercase;">{{ $venta->total_letras ?? 'CINCO CON 00/100 SOLES' }}</span>
                </div>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 100px; vertical-align: middle; padding: 0;">
                            @if($venta && isset($venta->id))
                                {!! QrCode::size(90)->generate(url('/venta/ticket/' . $venta->id)) !!}
                            @else
                                <svg width="90" height="90" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h7v7H0V0zm1 1v5h5V1H1zm2 2h1v1H3V3zm19-3h7v7h-7V0zm1 1v5h5V1h-5zm2 2h1v1h-1V3zM0 22h7v7H0v-7zm1 1v5h5v-5H1zm2 2h1v1H3v-1zm10-14h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm5-2h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm-5 3h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm5-2h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1z" fill="#000"/>
                                    <path d="M9 1h1v1H9V1zm3 0h2v1h-2V1zm3 0h1v2h-1V1zm2 1h1v1h-1V2zm-8 2h1v2H9V4zm2 1h2v1h-2V5zm3-1h1v1h-1V4zm0 2h2v1h-2V6zm-5 3h2v1H9V9zm4 0h1v1h-1V9zm2 1h2v1h-2v-1zm3-1h1v2h-1V9zm2 1h1v1h-1v-1zm-9 3h1v1H9v-1zm2 1h1v1h-1v-1zm4-1h2v1h-2v-1zm3 0h1v1h-1v-1zm1 2h1v1h-1v-1zm-8 2h1v1H9v-1zm4 0h2v1h-2v-1zm3 1h1v1h-1v-1zm1-2h1v1h-1v-1z" fill="#000"/>
                                </svg>
                            @endif
                        </td>
                        <td style="vertical-align: middle; padding-left: 15px; font-size: 11px; color: #4b5563; line-height: 1.4;">
                            <p style="margin: 3px 0;">Representación impresa de la {{ $venta->tipoDocumento->nombre ?? 'BOLETA ELECTRÓNICA' }}</p>
                            @if(!empty($venta->hash_cpe))
                                <p style="margin: 3px 0; font-weight: bold; color: #111;">HASH: {{ $venta->hash_cpe }}</p>
                            @endif
                            <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 12px; color: #1f2937;">¡Gracias por su preferencia!</p>
                        </td>
                    </tr>
                </table>
            </td>

            <td style="vertical-align: top; width: 35%;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px; border: 1px solid #e5e7eb; background-color: #f9fafb;">
                    @if(($venta->op_gravadas ?? 0) > 0)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 8px; color: #4b5563; font-weight: bold;">OP. GRAVADA:</td>
                        <td style="padding: 8px; text-align: right; color: #111; font-weight: bold;">S/ {{ number_format($venta->op_gravadas, 2) }}</td>
                    </tr>
                    @endif
                    @if(isset($venta->op_exoneradas) && $venta->op_exoneradas > 0)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 8px; color: #4b5563; font-weight: bold;">OP. EXONERADA:</td>
                        <td style="padding: 8px; text-align: right; color: #111; font-weight: bold;">S/ {{ number_format($venta->op_exoneradas, 2) }}</td>
                    </tr>
                    @endif
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 8px; color: #4b5563; font-weight: bold;">IGV (18%):</td>
                        <td style="padding: 8px; text-align: right; color: #111; font-weight: bold;">S/ {{ number_format($venta->igv ?? 0.90, 2) }}</td>
                    </tr>
                    <tr style="background-color: #1f2937; color: #ffffff; font-size: 14px; font-weight: bold;">
                        <td style="padding: 10px; color: #fff;">TOTAL A PAGAR:</td>
                        <td style="padding: 10px; text-align: right; color: #fff;">S/ {{ number_format($venta->total ?? 5.00, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- BOTONES DE ACCIÓN (Escondidos automáticamente mediante .no-print en impresoras o PDFs físicos) --}}
    <div class="no-print" style="text-align: center; margin-top: 30px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
        
        <button onclick="window.print()" style="padding: 8px 14px; background-color: #1e40af; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 12px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.617 0-1.11-.51-1.07-1.122L6.34 18m11.32 0h-11.32M9 11V9c0-1.657 1.343-3 3-3s3 1.343 3 3v2M4.5 15.75h15" />
            </svg>
            Imprimir Comprobante
        </button>

        @php
            $cliente = $venta->cliente ?? null;
            $telefonoCliente = preg_replace('/\D/', '', $cliente->telefono ?? '51952167090');
            $nombreCliente = $cliente->nombres ?? 'Cliente';
            $ventaId = $venta->id ?? 0;
            $urlTicket = $ventaId ? url('/venta/ticket/' . $ventaId) : url('/venta');

            $mensajeWhatsapp = urlencode(
                "Estimado(a) $nombreCliente, aquí puede visualizar su comprobante " .
                ($venta->serie_doc ?? '') . "-" . ($venta->nro_doc ?? '') .
                ": " . $urlTicket
            );
        @endphp

        <a href="https://api.whatsapp.com/send?phone={{ $telefonoCliente }}&text={{ $mensajeWhatsapp }}"
           target="_blank"
           style="padding: 8px 14px; background-color: #065f46; color: white; border-radius: 5px; font-weight: bold; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            📱 Enviar por WhatsApp
        </a>

        @php
            $correoCliente = $venta->cliente->correo ?? '';
            $asunto = urlencode('Comprobante Electrónico - ' . ($venta->serie_doc ?? '') . '-' . ($venta->nro_doc ?? ''));
            $cuerpo = urlencode('Estimado cliente, adjuntamos el acceso a su comprobante electrónico correspondiente a su última compra. Gracias por su preferencia.');
        @endphp

        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $correoCliente }}&su={{ $asunto }}&body={{ $cuerpo }}"
           target="_blank"
           style="padding: 8px 14px; background-color: #991b1b; color: white; border-radius: 5px; font-weight: bold; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            📧 Enviar por Gmail
        </a>

        <a href="{{ route('admin.Venta.index') }}"
           style="padding: 8px 14px; background-color: #374151; color: white; border-radius: 5px; font-weight: bold; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Volver al Listado
        </a>

    </div>

</div>