


{{-- Contenedor Principal Ajustado --}}
<div class="ticket-box" style="width: 80mm; max-width: 100%; margin: 0 auto; padding: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333; background-color: #fff; border: 1px solid #d1d5db; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); box-sizing: border-box;">

    {{-- CABECERA (Logo, Empresa y Datos Fiscales) --}}
    <div style="text-align: center; margin-bottom: 10px;">
        <div style="margin-bottom: 5px;">

            @php
                $empresa = $venta->empresa ?? null;
            @endphp

            <div style="width:70px; height:70px; margin:0 auto; border-radius:50%; overflow:hidden; border:2px solid #eee;">
                <img 
                    src="{{ $empresa && $empresa->logo 
                        ? asset('storage/' . $empresa->logo) 
                        : asset('iconos/Empresa.jpg') }}"
                    style="width:70px; height:70px; object-fit:cover;"
                >
            </div>

            <div style="font-weight: bold; font-size: 15px; color: #111; text-transform: uppercase;">
                {{ $venta->empresa->nombre ?? 'GRUPOAOSC' }}
            </div>
            <div style="font-size: 9px; color: #6b7280; text-transform: uppercase;">
                {{ $venta->empresa->razon_social ?? 'SANCHEZ CASTILLO ALEX OMAR' }}
            </div>
        </div>
        
        <div style="font-size: 10px; color: #374151;">
            <p style="margin: 2px 0;">RUC: {{ $venta->empresa->ruc ?? '10038965161' }}</p>
            <p style="margin: 2px 0;">PERU</p>
            <p style="margin: 2px 0;">Tel: {{ $venta->empresa->telefono ?? '952167090' }}</p>
        </div>
    </div>

    {{-- TIPO Y NÚMERO DE COMPROBANTE --}}
    <div style="border-top: 1px dashed #9ca3af; border-bottom: 1px dashed #9ca3af; text-align: center; padding: 6px 0; margin-bottom: 10px;">
        <div style="font-weight: bold; font-size: 13px; color: #000; text-transform: uppercase;">
            {{ $venta->tipoDocumento->nombre ?? 'BOLETA DE VENTA ELECTRÓNICA' }}
        </div>
        <div style="font-size: 12px; font-weight: bold; margin-top: 2px; color: #000;">
            {{ $venta->serie_doc ?? 'BA01' }}-{{ $venta->nro_doc ?? '00000133' }}
        </div>
    </div>

    {{-- DATOS DEL CLIENTE / EMISIÓN --}}
    <div style="margin-bottom: 10px; font-size: 10px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 2px 0; vertical-align: top; width: 50px; font-weight: bold;">Fecha:</td>
                <td style="padding: 2px 0; color: #374151;">{{ $venta->fecha_emision ?? '2026-06-19 00:13:52' }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 0; vertical-align: top; font-weight: bold;">Cliente:</td>
                <td style="padding: 2px 0; color: #374151; text-transform: uppercase;">{{ $venta->cliente->nombres ?? 'SIN CLIENTE' }}</td>
            </tr>
            <tr>
                <td style="padding: 2px 0; vertical-align: top; font-weight: bold;">DNI/RUC:</td>
                <td style="padding: 2px 0; color: #374151;">{{ $venta->cliente->numero_documento ?? '20508565934' }}</td>
            </tr>
            @if(isset($venta->usuario))
            <tr>
                <td style="padding: 2px 0; vertical-align: top; font-weight: bold;">Cajero:</td>
                <td style="padding: 2px 0; color: #374151;">{{ $venta->usuario->nombres ?? 'IMAN BRUNO DEIVID DAVID' }}</td>
            </tr>
            @endif
        </table>
    </div>

    {{-- TABLA DE PRODUCTOS --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 8px; font-size: 10px;">
        <thead>
            <tr style="border-bottom: 1px solid #000;">
                <th style="text-align: left; padding: 4px 0; font-weight: bold; width: 12%;">CANT</th>
                <th style="text-align: left; padding: 4px 2px; font-weight: bold; width: 53%;">DESCRIPCIÓN</th>
                <th style="text-align: right; padding: 4px 2px; font-weight: bold; width: 17%;">P.UNIT</th>
                <th style="text-align: right; padding: 4px 0; font-weight: bold; width: 18%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @if($venta && $venta->detalles)
                @foreach($venta->detalles as $item)
                    <tr style="border-bottom: 1px dashed #e5e7eb;">
                        <td style="padding: 4px 0; vertical-align: top;">{{ $item->cantidad }}</td>
                        <td style="padding: 4px 2px; vertical-align: top; text-transform: uppercase; word-break: break-word;">{{ $item->producto->nombre ?? '-' }}</td>
                        <td style="padding: 4px 2px; vertical-align: top; text-align: right;">{{ number_format($item->precio, 2) }}</td>
                        <td style="padding: 4px 0; vertical-align: top; text-align: right;">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            @else
                <tr style="border-bottom: 1px dashed #e5e7eb;">
                    <td style="padding: 4px 0; vertical-align: top;">1</td>
                    <td style="padding: 4px 2px; vertical-align: top; text-transform: uppercase;">EXTRA ARROZ</td>
                    <td style="padding: 4px 2px; vertical-align: top; text-align: right;">5.00</td>
                    <td style="padding: 4px 0; vertical-align: top; text-align: right;">5.00</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- TOTALES --}}
    <div style="border-top: 1px dashed #9ca3af; padding-top: 4px; font-size: 10.5px;">
        <table style="width: 100%; border-collapse: collapse;">
            @if(($venta->op_gravadas ?? 0) > 0)
            <tr>
                <td style="padding: 2px 0; color: #4b5563;">SUBTOTAL:</td>
                <td style="padding: 2px 0; text-align: right;">S/ {{ number_format($venta->op_gravadas, 2) }}</td>
            </tr>
            @endif
            @if(isset($venta->op_exoneradas) && $venta->op_exoneradas > 0)
            <tr>
                <td style="padding: 2px 0; color: #4b5563;">OP. EXONERADAS:</td>
                <td style="padding: 2px 0; text-align: right;">S/ {{ number_format($venta->op_exoneradas, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding: 2px 0; color: #4b5563;">IGV (18%):</td>
                <td style="padding: 2px 0; text-align: right;">S/ {{ number_format($venta->igv ?? 0.90, 2) }}</td>
            </tr>
            <tr style="border-top: 1px solid #000; font-size: 11.5px; font-weight: bold;">
                <td style="padding: 4px 0;">TOTAL A PAGAR:</td>
                <td style="padding: 4px 0; text-align: right;">S/ {{ number_format($venta->total ?? 5.00, 2) }}</td>
            </tr>
        </table>
    </div>

    {{-- TOTAL EN LETRAS --}}
    <div style="margin: 6px 0; font-size: 9.5px; border-bottom: 1px dashed #9ca3af; padding-bottom: 6px;">
        <span style="font-weight: bold;">SON:</span> 
        <span style="text-transform: uppercase;">{{ $venta->total_letras ?? 'CINCO CON 00/100 SOLES' }}</span>
    </div>

    {{-- SECCIÓN QR Y PIE DIGITAL (SUNAT) --}}
    <div style="text-align: center; margin-top: 8px;">
        <div style="text-align:center; margin:6px 0;">
            @if($venta)
                {!! QrCode::size(100)->generate(url('/venta/ticket/' . $venta->id)) !!}
            @endif
        </div>
        <div style="font-size: 8px; color: #4b5563; line-height: 1.2; padding: 0 5px;">
            <p style="margin: 2px 0;">Representación impresa de la {{ $venta->tipoDocumento->nombre ?? 'BOLETA DE VENTA ELECTRONICA' }}</p>
            @if(!empty($venta->hash_cpe))
                <p style="margin: 2px 0; font-weight: bold; color: #111;">HASH: {{ $venta->hash_cpe }}</p>
            @endif
        </div>

        <div style="margin-top: 10px; font-weight: bold; font-size: 10.5px; color: #000; text-transform: uppercase;">
            ¡Gracias por su preferencia!
        </div>
    </div>

    {{-- BOTONES DE ACCIÓN (Se ocultan automáticamente en la impresión física) --}}
    <div class="no-print" style="text-align: center; margin-top: 25px; display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
        
        <button onclick="window.print()" style="padding: 10px 14px; background-color: #1e40af; color: white; border: none; border-radius: 6px; font-weight: bold; font-size: 11px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
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
        style="padding: 10px 14px; background-color: #065f46; color: white; border-radius: 6px; font-weight: bold; font-size: 11px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            📱 WhatsApp
        </a>

        @php
            $correoCliente = $venta->cliente->correo ?? '';

            $asunto = urlencode('Comprobante de venta');
            $cuerpo = urlencode('Hola, adjuntamos su comprobante. Gracias por su compra.');
        @endphp

        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $correoCliente }}&su={{ $asunto }}&body={{ $cuerpo }}"
        target="_blank"
        style="padding: 10px 14px; background-color: #991b1b; color: white; border-radius: 6px; font-weight: bold; font-size: 11px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
        
            📧 Gmail
        </a>
        <a href="{{ route('admin.Venta.index') }}"
           style="padding: 10px 14px; background-color: #374151; color: white; border-radius: 6px; font-weight: bold; font-size: 11px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Volver
        </a>

    </div>

</div>