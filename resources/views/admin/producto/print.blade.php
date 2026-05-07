<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ficha - {{ $producto->nombre }}</title>
<style>

    @page { size: A4; margin: 0; }
    * { margin: 0; padding: 0; box-sizing: border-box; }

    html, body {
        width: 210mm;
        height: 297mm;
        font-family: Arial, sans-serif;
        background: white;
        font-size: 10px;
    }

   
    .page {
        width: 210mm;
        height: 297mm;
        padding: 0;
    }


    .header {
        width: 100%;
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        padding: 16px 18px 14px 18px;
    }

    .header-inner { width: 100%; border-collapse: collapse; }

    .badges { margin-bottom: 5px; }

    .badge {
        display: inline-block;
        font-size: 8px;
        background: rgba(255,255,255,0.22);
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        margin-right: 4px;
        font-weight: bold;
        letter-spacing: 0.3px;
    }

    .h-nombre {
        font-size: 22px;
        font-weight: bold;
        color: white;
        margin: 4px 0 3px 0;
        letter-spacing: -0.3px;
    }

    .h-sub { font-size: 9px; color: rgba(255,255,255,0.82); }

    .h-precio-label {
        font-size: 8.5px;
        color: rgba(255,255,255,0.75);
        text-align: right;
        margin-bottom: 2px;
    }

    .h-precio {
        font-size: 28px;
        font-weight: bold;
        color: white;
        text-align: right;
        white-space: nowrap;
        letter-spacing: -0.5px;
    }


    .body-wrap {
        padding: 10px 14px 10px 14px;
    }

    .body-table {
        width: 100%;
        border-collapse: collapse;
    }


    .col-left {
        width: 162px;
        vertical-align: top;
        padding-right: 12px;
    }


    .img-wrap {
        width: 150px;
        height: 172px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        background: #f8fafc;
        text-align: center;
    }

    .img-wrap img {
        width: 150px;
        height: 172px;
        object-fit: cover;
        display: block;
    }

    .img-empty {
        color: #94a3b8;
        font-size: 9px;
        padding: 62px 8px;
        line-height: 1.8;
    }


    .codes-wrap {
        width: 150px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 6px;
        background: #fafafa;
        text-align: center;
        margin-top: 8px;
    }

    .code-lbl {
        font-size: 7px;
        color: #64748b;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 4px;
        display: block;
    }

    .code-txt {
        font-size: 8px;
        font-family: monospace;
        color: #1e293b;
        font-weight: bold;
        margin-top: 3px;
        display: block;
    }


    .col-right { vertical-align: top; }


    .sec {
        font-size: 8px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #0284c7;
        background: #f0f9ff;
        border-left: 3px solid #0284c7;
        padding: 4px 8px;
        margin-bottom: 5px;
        border-radius: 0 4px 4px 0;
    }

    .sec-gap { margin-top: 10px; }


    .ct {
        width: 100%;
        border-collapse: separate;
        border-spacing: 4px 0;
        margin-bottom: 5px;
    }

    .ct td {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 6px;
        padding: 7px 9px;
        width: 33%;
        vertical-align: top;
    }

    .cl {
        font-size: 7px;
        color: #64748b;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: block;
        margin-bottom: 3px;
    }

    .cv {
        font-size: 11.5px;
        font-weight: bold;
        color: #1e293b;
        display: block;
    }

    .verde { color: #16a34a; }
    .rojo  { color: #dc2626; }
    .azul  { color: #0284c7; }


    .tbox {
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 8px 10px;
        font-size: 9px;
        line-height: 1.55;
        color: #334155;
        background: white;
        margin-top: 6px;
        word-wrap: break-word;
    }

    .tbox-lbl {
        font-size: 7px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #0284c7;
        display: block;
        margin-bottom: 4px;
        padding-bottom: 3px;
        border-bottom: 1px solid #e0f2fe;
    }

    .notes-box {
        background: #fffbeb;
        border-color: #fde68a;
    }

    .notes-box .tbox-lbl {
        color: #b45309;
        border-bottom-color: #fde68a;
    }

    .alerta {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        border-left: 4px solid #dc2626;
        border-radius: 6px;
        padding: 7px 10px;
        font-size: 9px;
        font-weight: bold;
        color: #dc2626;
        text-align: center;
        margin-top: 7px;
    }


    .footer-wrap {
        padding: 0 14px;
        margin-top: 10px;
    }

    .footer-table {
        width: 100%;
        border-collapse: collapse;
        border-top: 1px solid #e2e8f0;
        padding-top: 6px;
        font-size: 7.5px;
        color: #94a3b8;
    }

    .footer-table td { padding-top: 5px; }
    .fc { text-align: center; font-weight: bold; color: #0284c7; }
    .fr { text-align: right; }

    @media print { body { background: none; } }
</style>
</head>
<body>
<div class="page">


<div class="header">
    <table class="header-inner">
        <tr>
            <td style="vertical-align:middle;">
                <div class="badges">
                    <span class="badge">ID {{ $producto->id }}</span>
                    <span class="badge">ORD {{ $producto->orden }}</span>
                    <span class="badge">{{ $producto->estado == 'a' ? '✔ ACTIVO' : '✘ INACTIVO' }}</span>
                </div>
                <div class="h-nombre" style="
                    font-size: 32px; 
                    font-weight: 800; 
                    color: #0070f3; 
                    text-transform: uppercase; 
                    letter-spacing: -0.5px;
                    line-height: 1.1;
                    margin-bottom: 5px;
                    text-shadow: 1px 1px 0px rgba(0,0,0,0.05);
                ">
                    {{ $producto->nombre }}
                </div>
                <div class="h-sub">
                    {{ $producto->categoria->descripcion ?? 'Sin categoría' }}
                    &nbsp;•&nbsp;
                    {{ $producto->areaProduccion->nombre ?? 'Sin área' }}
                </div>
            </td>
            <td style="vertical-align:middle; width:170px;">
                <div class="h-precio-label">Precio de venta</div>
                <div class="h-precio">S/ {{ number_format($producto->precio, 2) }}</div>
            </td>
        </tr>
    </table>
</div>

<div class="body-wrap">
<table class="body-table">
<tr>
    <td class="col-left">

        <div class="img-wrap">
            @if($producto->imagen)
                <img src="{{ public_path('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
            @else
                <div class="img-empty">📷<br>Sin imagen</div>
            @endif
        </div>

        <div class="codes-wrap">
            <span class="code-lbl">Código QR</span>
           <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(132)->generate($producto->codigo_qr ?? $producto->id)) }}"
     style="width:132px; height:132px; display:block; margin:0 auto;">

            <span class="code-lbl" style="margin-top:8px;">Código de Barra</span>
            <img src="data:image/png;base64,{!! DNS1D::getBarcodePNG($producto->codigo_barra ?? '0000000000000', 'C128', 1, 30, [1,1,1]) !!}"
                 style="width:138px; height:30px; display:block; margin:0 auto;">
            <span class="code-txt">{{ $producto->codigo_barra ?? '0000000000000' }}</span>
        </div>
    </td>

    <td class="col-right">

        <div class="sec">Precios &amp; Inventario</div>
        @php
            $margen = $producto->precio - ($producto->costo ?? 0);
            $pct    = $producto->precio > 0 ? ($margen / $producto->precio * 100) : 0;
        @endphp

        <table class="ct">
            <tr>
                <td>
                    <span class="cl">Precio Venta</span>
                    <span class="cv azul">S/ {{ number_format($producto->precio, 2) }}</span>
                </td>
                <td>
                    <span class="cl">Costo</span>
                    <span class="cv">S/ {{ number_format($producto->costo ?? 0, 2) }}</span>
                </td>
                <td>
                    <span class="cl">Margen</span>
                    <span class="cv verde">S/ {{ number_format($margen,2) }} ({{ number_format($pct,1) }}%)</span>
                </td>
            </tr>
        </table>

        <table class="ct">
            <tr>
                <td>
                    <span class="cl">Stock Actual</span>
                    <span class="cv {{ $producto->stock <= $producto->stock_minimo ? 'rojo' : 'verde' }}">
                        {{ $producto->stock }} unid.
                    </span>
                </td>
                <td>
                    <span class="cl">Stock Mínimo</span>
                    <span class="cv">{{ $producto->stock_minimo }} unid.</span>
                </td>
                <td>
                    <span class="cl">Estado Stock</span>
                    @if($producto->stock <= $producto->stock_minimo)
                        <span class="cv rojo">⚠ BAJO</span>
                    @else
                        <span class="cv verde">✔ OK</span>
                    @endif
                </td>
            </tr>
        </table>

        <div class="sec sec-gap">Producción &amp; Logística</div>

        <table class="ct">
            <tr>
                <td>
                    <span class="cl">Preparación</span>
                    <span class="cv">{{ ucfirst($producto->preparacion) }}</span>
                </td>
                <td>
                    <span class="cl">Área</span>
                    <span class="cv">{{ $producto->areaProduccion->nombre ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="cl">Tiempo Prep.</span>
                    <span class="cv">{{ $producto->tiempo_preparacion }} min</span>
                </td>
            </tr>
        </table>

        <table class="ct">
            <tr>
                <td>
                    <span class="cl">Delivery</span>
                    <span class="cv {{ $producto->delivery ? 'verde' : 'rojo' }}">
                        {{ $producto->delivery ? '✔ Sí' : '✘ No' }}
                    </span>
                </td>
                <td>
                    <span class="cl">Destacado</span>
                    <span class="cv {{ $producto->destacado ? 'azul' : '' }}">
                        {{ $producto->destacado ? '★ Sí' : 'No' }}
                    </span>
                </td>
                <td>
                    <span class="cl">Categoría</span>
                    <span class="cv">{{ $producto->categoria->descripcion ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>

        <div class="tbox" style="margin-top:8px;">
            <span class="tbox-lbl">Descripción</span>
            {{ $producto->descripcion ?? 'Sin descripción.' }}
        </div>

        <div class="tbox notes-box">
            <span class="tbox-lbl">Notas / Observaciones</span>
            {{ $producto->notas ?? 'Sin notas.' }}
        </div>

        @if($producto->stock <= $producto->stock_minimo)
            <div class="alerta">
                 &nbsp; STOCK BAJO — Stock actual ({{ $producto->stock }}) menor al mínimo requerido ({{ $producto->stock_minimo }})
            </div>
        @endif

    </td>
</tr>
</table>
</div>


<div class="footer-wrap">
    <table class="footer-table">
        <tr>
            <td>Creado: {{ $producto->created_at }}</td>
            <td class="fc">AOSC GRUPO</td>
            <td class="fr">Actualizado: {{ $producto->updated_at }}</td>
        </tr>
    </table>
</div>

</div>
</body>
</html>