<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>

    <style>
        @page {
            size: 80mm 200mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial;
        }

        .ticket {
            width: 80mm;
            padding: 5px;
            text-align: center;
        }

        img {
            width: 70mm;   
            display: block;
            margin: 0 auto;
        }

        h3 {
            font-size: 13px;
            margin: 5px 0;
        }

        .separador {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        p {
            margin: 2px 0;
            font-size: 11px;
        }

        .precio {
            font-size: 14px;
            font-weight: bold;
        }

        button {
            display: none;
        }
    </style>
</head>

<body>

<div class="ticket">

    <h3>{{ $producto->nombre }}</h3>

    <div class="separador"></div>

    {{-- QR --}}
    <p>QR</p>
    <img src="{{ public_path('storage/' . $producto->codigo_qr) }}">

    <div class="separador"></div>

    {{-- BARRAS --}}
    <p>Código de barras</p>
    <img src="{{ public_path('storage/' . $producto->codigo_barra) }}">

    <div class="separador"></div>

    <p class="precio">S/ {{ $producto->precio }}</p>

</div>

</body>
</html>