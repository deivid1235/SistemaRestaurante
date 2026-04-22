<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Reclamaciones - #{{ str_pad($libroReclamacion->id, 6, '0', STR_PAD_LEFT) }}</title>

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #e5e7eb; /* gris para simular visor */
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }

        /* 🔥 HOJA REAL */
        .page {
            width: 210mm;
            min-height: 297mm;
            background: #fff;
            margin: 20px auto;
            padding: 20mm;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 10px;
        }

        .section-title {
            background: #d9d9d9;
            font-weight: bold;
            text-align: center;
            padding: 6px;
            border: 1px solid #000;
            margin-top: 12px;
            text-transform: uppercase;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .label {
            background: #f2f2f2;
            font-weight: bold;
            width: 25%;
        }

        .value {
            width: 75%;
        }

        .text-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 60px;
            text-align: justify;
        }

        .signatures {
            margin-top: 50px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin: 0 30px;
            padding-top: 5px;
        }

        /* 🔥 SOLO IMPRESIÓN */
        @media print {
            body {
                background: white !important;
            }

            .page {
                margin: 0;
                width: 100%;
                min-height: auto;
                padding: 1cm;
                box-shadow: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="page">

    <div class="header">
        LIBRO DE RECLAMACIONES<br>
        <span style="font-size: 11pt;">
            N° {{ str_pad($libroReclamacion->id, 6, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <div class="section-title">1. DATOS DEL USUARIO</div>

    <table class="data-table">
        <tr>
            <td class="label">Documento</td>
            <td class="value">DNI: {{ $libroReclamacion->numero_documento }}</td>
        </tr>
        <tr>
            <td class="label">Teléfono</td>
            <td class="value">{{ $libroReclamacion->telefono }}</td>
        </tr>
        <tr>
            <td class="label">Nombres</td>
            <td class="value">
                {{ $libroReclamacion->primer_nombre }} {{ $libroReclamacion->primer_apellido }}
            </td>
        </tr>
        <tr>
            <td class="label">Correo</td>
            <td class="value">{{ $libroReclamacion->correo }}</td>
        </tr>
    </table>

    <div class="section-title">2. DATOS DEL SERVICIO</div>

    <table class="data-table">
        <tr>
            <td class="label">Servicio</td>
            <td class="value">{{ $libroReclamacion->servicio_contratado }}</td>
        </tr>
        <tr>
            <td class="label">Orden</td>
            <td class="value">{{ $libroReclamacion->numero_orden ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Monto</td>
            <td class="value">S/ {{ number_format($libroReclamacion->monto_reclamado, 2) }}</td>
        </tr>
    </table>

    <div class="section-title">3. DETALLE DEL RECLAMO</div>

    <table class="data-table">
        <tr>
            <td class="label">Tipo</td>
            <td class="value">Reclamo</td>
        </tr>
        <tr>
            <td class="label">Detalle</td>
            <td class="value">
                <div class="text-box">
                    {{ $libroReclamacion->detalle_solicitud }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">4. PEDIDO DEL CLIENTE</div>

    <table class="data-table">
        <tr>
            <td class="label">Solicitud</td>
            <td class="value">
                <div class="text-box">
                    {{ $libroReclamacion->pedido_concreto }}
                </div>
            </td>
        </tr>
    </table>

    <div class="signatures">
        <table>
            <tr>
                <td style="width:50%;">
                    <div class="signature-line">
                        Firma Cliente<br><br>
                        {{ $libroReclamacion->primer_nombre }} {{ $libroReclamacion->primer_apellido }}<br>
                        DNI: {{ $libroReclamacion->numero_documento }}
                    </div>
                </td>

                <td style="width:50%;">
                    <div class="signature-line">
                        Firma Empresa<br><br>
                        Sistema Restaurante
                    </div>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>
