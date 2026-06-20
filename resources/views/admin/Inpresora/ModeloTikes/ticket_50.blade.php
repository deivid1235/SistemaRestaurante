<div style="width: 50mm; max-width: 100%; margin: 0 auto; padding: 2px; font-family: Arial, Helvetica, sans-serif; font-size: 8px; color: #333; background-color: #fff; line-height: 1.25;">

    {{-- CABECERA (Logo, Empresa y Datos Fiscales) --}}
    <div style="text-align: center; margin-bottom: 6px;">
        <div style="margin-bottom: 2px;">

            @php
                $empresa = $venta->empresa ?? null;
            @endphp

            <div style="width: 50px; height: 50px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 2px solid #eee;">
                <img 
                    src="{{ $empresa && $empresa->logo 
                        ? asset('storage/' . $empresa->logo) 
                        : asset('iconos/Empresa.jpg') }}"
                    style="width: 50px; height: 50px; object-fit: cover;"
                >
            </div>

            <div style="font-weight: bold; font-size: 11px; color: #1f2937; text-transform: uppercase; tracking-wider;">
                {{ $venta->empresa->nombre ?? 'GRUPOAOSC' }}
            </div>
            <div style="font-size: 7.5px; color: #4b5563; text-transform: uppercase;">
                {{ $venta->empresa->razon_social ?? 'SANCHEZ CASTILLO ALEX OMAR' }}
            </div>
        </div>
        
        <div style="font-size: 8px; color: #4b5563;">
            <p style="margin: 1px 0;">RUC: {{ $venta->empresa->ruc ?? '10038965161' }}</p>
            <p style="margin: 1px 0;">PERU</p>
            <p style="margin: 1px 0;">Tel: {{ $venta->empresa->telefono ?? '952167090' }}</p>
        </div>
    </div>

    {{-- TIPO Y NÚMERO DE COMPROBANTE --}}
    <div style="border-top: 1px dashed #bbb; border-bottom: 1px dashed #bbb; text-align: center; padding: 4px 0; margin-bottom: 6px;">
        <div style="font-weight: bold; font-size: 9.5px; color: #000; text-transform: uppercase; letter-spacing: 0.1px;">
            {{ $venta->tipoDocumento->nombre ?? 'BOLETA DE VENTA ELECTRÓNICA' }}
        </div>
        <div style="font-size: 9px; font-weight: bold; margin-top: 2px; color: #111;">
            {{ $venta->serie_doc ?? 'BA01' }}-{{ $venta->nro_doc ?? '00000133' }}
        </div>
    </div>

    {{-- DATOS DEL CLIENTE / EMISIÓN --}}
    <div style="margin-bottom: 6px; font-size: 8px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 1px 0; vertical-align: top; width: 40px; font-weight: bold; color: #111;">Fecha:</td>
                <td style="padding: 1px 0; color: #4b5563;">{{ $venta->fecha_emision ?? '2026-06-19 00:13:52' }}</td>
            </tr>
            <tr>
                <td style="padding: 1px 0; vertical-align: top; font-weight: bold; color: #111;">Cliente:</td>
                <td style="padding: 1px 0; color: #4b5563; text-transform: uppercase; word-break: break-all;">{{ $venta->cliente->nombres ?? 'SIN CLIENTE' }}</td>
            </tr>
            <tr>
                <td style="padding: 1px 0; vertical-align: top; font-weight: bold; color: #111;">DNI/RUC:</td>
                <td style="padding: 1px 0; color: #4b5563;">{{ $venta->cliente->numero_documento ?? '20508565934' }}</td>
            </tr>
            @if(isset($venta->usuario))
            <tr>
                <td style="padding: 1px 0; vertical-align: top; font-weight: bold; color: #111;">Cajero:</td>
                <td style="padding: 1px 0; color: #4b5563;">{{ $venta->usuario->nombres ?? 'IMAN BRUNO DEIVID DAVID' }}</td>
            </tr>
            @endif
        </table>
    </div>

    {{-- TABLA DE PRODUCTOS --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px; font-size: 8px;">
        <thead>
            <tr style="border-bottom: 1px solid #000;">
                <th style="text-align: left; padding: 2px 0; font-weight: bold; width: 12%; color: #000;">CT</th>
                <th style="text-align: left; padding: 2px 1px; font-weight: bold; width: 44%; color: #000;">DESCRIPCIÓN</th>
                <th style="text-align: right; padding: 2px 1px; font-weight: bold; width: 22%; color: #000;">P.U.</th>
                <th style="text-align: right; padding: 2px 0; font-weight: bold; width: 22%; color: #000;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @if($venta && $venta->detalles)
                @foreach($venta->detalles as $item)
                    <tr style="border-bottom: 1px dashed #eee;">
                        <td style="padding: 3px 0; vertical-align: top;">{{ $item->cantidad }}</td>
                        <td style="padding: 3px 1px; vertical-align: top; text-transform: uppercase; word-break: break-word;">{{ $item->producto->nombre ?? '-' }}</td>
                        <td style="padding: 3px 1px; vertical-align: top; text-align: right;">{{ number_format($item->precio, 2) }}</td>
                        <td style="padding: 3px 0; vertical-align: top; text-align: right;">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            @else
                <tr style="border-bottom: 1px dashed #eee;">
                    <td style="padding: 3px 0; vertical-align: top;">1</td>
                    <td style="padding: 3px 1px; vertical-align: top; text-transform: uppercase; word-break: break-word;">EXTRA ARROZ</td>
                    <td style="padding: 3px 1px; vertical-align: top; text-align: right;">5.00</td>
                    <td style="padding: 3px 0; vertical-align: top; text-align: right;">5.00</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- TOTALES --}}
    <div style="border-top: 1px dashed #bbb; padding-top: 3px; font-size: 8px;">
        <table style="width: 100%; border-collapse: collapse;">
            @if(($venta->op_gravadas ?? 0) > 0)
            <tr>
                <td style="padding: 1px 0; color: #4b5563;">SUBTOTAL:</td>
                <td style="padding: 1px 0; text-align: right; color: #111;">S/ {{ number_format($venta->op_gravadas, 2) }}</td>
            </tr>
            @endif
            @if(isset($venta->op_exoneradas) && $venta->op_exoneradas > 0)
            <tr>
                <td style="padding: 1px 0; color: #4b5563;">OP. EXONERADAS:</td>
                <td style="padding: 1px 0; text-align: right; color: #111;">S/ {{ number_format($venta->op_exoneradas, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding: 1px 0; color: #4b5563;">IGV (18%):</td>
                <td style="padding: 1px 0; text-align: right; color: #111;">S/ {{ number_format($venta->igv ?? 0.90, 2) }}</td>
            </tr>
            <tr style="border-top: 1px solid #000; font-size: 9px; font-weight: bold;">
                <td style="padding: 3px 0; color: #000;">TOTAL A PAGAR:</td>
                <td style="padding: 3px 0; text-align: right; color: #000;">S/ {{ number_format($venta->total ?? 5.00, 2) }}</td>
            </tr>
        </table>
    </div>

    {{-- TOTAL EN LETRAS --}}
    <div style="margin: 5px 0; font-size: 7.5px; border-bottom: 1px dashed #bbb; padding-bottom: 5px;">
        <span style="font-weight: bold; color: #000;">SON:</span> 
        <span style="color: #333; text-transform: uppercase;">{{ $venta->total_letras ?? 'CINCO CON 00/100 SOLES' }}</span>
    </div>

    {{-- SECCIÓN QR Y PIE DIGITAL (SUNAT) --}}
    <div style="text-align: center; margin-top: 6px;">
        <div style="text-align: center; margin: 6px 0;">
            @if($venta && isset($venta->id))
                {!! QrCode::size(75)->generate(url('/venta/ticket/' . $venta->id)) !!}
            @else
                <div style="display: inline-block; margin-bottom: 4px;">
                    <svg width="75" height="75" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: block; margin: 0 auto;">
                        <path d="M0 0h7v7H0V0zm1 1v5h5V1H1zm2 2h1v1H3V3zm19-3h7v7h-7V0zm1 1v5h5V1h-5zm2 2h1v1h-1V3zM0 22h7v7H0v-7zm1 1v5h5v-5H1zm2 2h1v1H3v-1zm10-14h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm5-2h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm-5 3h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1zm5-2h1v1h-1v-1zm2 2h1v1h-1v-1zm-2 2h1v1h-1v-1z" fill="#000"/>
                        <path d="M9 1h1v1H9V1zm3 0h2v1h-2V1zm3 0h1v2h-1V1zm2 1h1v1h-1V2zm-8 2h1v2H9V4zm2 1h2v1h-2V5zm3-1h1v1h-1V4zm0 2h2v1h-2V6zm-5 3h2v1H9V9zm4 0h1v1h-1V9zm2 1h2v1h-2v-1zm3-1h1v2h-1V9zm2 1h1v1h-1v-1zm-9 3h1v1H9v-1zm2 1h1v1h-1v-1zm4-1h2v1h-2v-1zm3 0h1v1h-1v-1zm1 2h1v1h-1v-1zm-8 2h1v1H9v-1zm4 0h2v1h-2v-1zm3 1h1v1h-1v-1zm1-2h1v1h-1v-1z" fill="#000"/>
                    </svg>
                </div>
            @endif
        </div>

        <div style="font-size: 7px; color: #4b5563; line-height: 1.2; padding: 0 1px;">
            <p style="margin: 1px 0;">Representación impresa de la {{ $venta->tipoDocumento->nombre ?? 'BOLETA DE VENTA ELECTRONICA' }}</p>
            @if(!empty($venta->hash_cpe))
                <p style="margin: 1px 0; font-weight: bold; color: #111; word-break: break-all;">HASH: {{ $venta->hash_cpe }}</p>
            @endif
        </div>

        <div style="margin-top: 6px; font-weight: bold; font-size: 8.5px; color: #000; letter-spacing: 0.1px; text-transform: uppercase;">
            ¡Gracias por su preferencia!
        </div>
    </div>

    {{-- BOTONES DE ACCIÓN (Se ocultan automáticamente en la impresión física) --}}
    <div class="no-print" style="text-align: center; margin-top: 15px; display: flex; gap: 4px; justify-content: center; flex-wrap: wrap;">
        
        <button onclick="window.print()" style="padding: 6px 8px; background-color: #1e40af; color: white; border: none; border-radius: 4px; font-weight: bold; font-size: 8px; cursor: pointer; display: flex; align-items: center; gap: 3px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 10px; height: 10px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.617 0-1.11-.51-1.07-1.122L6.34 18m11.32 0h-11.32M9 11V9c0-1.657 1.343-3 3-3s3 1.343 3 3v2M4.5 15.75h15" />
            </svg>
            Imprimir
        </button>

        @php
            $cliente = $venta->cliente ?? null;
            $telefonoCliente = preg_replace('/\D/', '', $cliente->telefono ?? '51952167090');
            $nombreCliente = $cliente->nombres ?? 'Cliente';
            $ventaId = $venta->id ?? 0;
            $urlTicket = $ventaId ? url('/venta/ticket/' . $ventaId) : url('/venta');

            $mensajeWhatsapp = urlencode(
                "Hola $nombreCliente, aquí tienes tu comprobante " .
                ($venta->serie_doc ?? '') . "-" . ($venta->nro_doc ?? '') .
                ": " . $urlTicket
            );
        @endphp

        <a href="https://api.whatsapp.com/send?phone={{ $telefonoCliente }}&text={{ $mensajeWhatsapp }}"
           target="_blank"
           style="padding: 6px 8px; background-color: #065f46; color: white; border-radius: 4px; font-weight: bold; font-size: 8px; text-decoration: none; display: flex; align-items: center; gap: 3px;">
            📱 WhatsApp
        </a>

        @php
            $correoCliente = $venta->cliente->correo ?? '';
            $asunto = urlencode('Comprobante de venta');
            $cuerpo = urlencode('Hola, adjuntamos su comprobante. Gracias por su compra.');
        @endphp

        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $correoCliente }}&su={{ $asunto }}&body={{ $cuerpo }}"
           target="_blank"
           style="padding: 6px 8px; background-color: #991b1b; color: white; border-radius: 4px; font-weight: bold; font-size: 8px; text-decoration: none; display: flex; align-items: center; gap: 3px;">
            📧 Gmail
        </a>

        <a href="{{ route('admin.Venta.index') }}"
           style="padding: 6px 8px; background-color: #374151; color: white; border-radius: 4px; font-weight: bold; font-size: 8px; text-decoration: none; display: flex; align-items: center; gap: 3px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 10px; height: 10px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Volver
        </a>

    </div>

</div>