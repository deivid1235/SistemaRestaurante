@extends('layouts.dashboard')
@section('title', 'Gestión de tickets para impresoras')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-left: 10px; margin-right: 10px; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
    <div>
        <h1 style="text-align: left; margin: 0; font-size: 28px; font-weight: normal; color: #0c0c0c; font-family: sans-serif;">
            Tickets de sistema
        </h1>
        <p style="margin: 5px 0 0 0; font-size: 14px; color: #6b7280; font-family: sans-serif;">
            Elije una plantilla para imprimir
        </p>
    </div>
    <div>
        <a href="{{ route('admin.Inpresora.index') }}" 
        style="background: linear-gradient(135deg, var(--primary) 0%, #0096D9 100%);
                padding:10px 15px;
                color:white;
                text-decoration:none;
                border-radius:6px;
                display:inline-block;">
            ← Volver
        </a>
    </div>

</div>

<div style="display: flex; gap: 20px; justify-content: flex-start; align-items: flex-start; flex-wrap: wrap; padding-left: 10px; width: 100%;">

    {{-- Plantilla: 80mm --}}
    <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px; text-align: center; background-color: #fff; box-sizing: border-box;">
        <div style="background-color: #f5f5f5; height: 350px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <div style="background-color: #fff; height: 330px; width: 90%; overflow-y: auto; border: 1px dashed #ccc; padding: 5px; display: inline-block; text-align: left;">
                @include('admin.Inpresora.ModeloTikes.ticket_80', ['venta' => $venta ?? null])
            </div>
        </div>
        
        <h3>Plantilla: 80mm</h3>
        
        <form action="{{ route('plantilla.activar', 80) }}" method="POST" style="margin-top: 15px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #aaa; cursor: pointer; font-weight: bold;">
                Activar plantilla
            </button>
        </form>
    </div>

    {{-- Plantilla: 58mm --}}
    <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px; text-align: center; background-color: #fff; box-sizing: border-box;">
        <div style="background-color: #f5f5f5; height: 350px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <div style="background-color: #fff; height: 330px; width: 90%; overflow-y: auto; border: 1px dashed #ccc; padding: 5px; display: inline-block; text-align: left;">   
                @include('admin.Inpresora.ModeloTikes.ticket_58', ['venta' => $venta ?? null])
            </div>
        </div>
        
        <h3>Plantilla: 58mm</h3>
        <form action="{{ route('plantilla.activar', 58) }}" method="POST" style="margin-top: 15px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #aaa; cursor: pointer; font-weight: bold;">
                Activar plantilla
            </button>
        </form>
    </div>
    {{-- Plantilla: 50 mm --}}
    <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px; text-align: center; background-color: #fff; box-sizing: border-box;">
        <div style="background-color: #f5f5f5; height: 350px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <div style="background-color: #fff; height: 330px; width: 233px; overflow-x: hidden; overflow-y: auto; border: 1px dashed #ccc; padding: 5px; text-align: left; position: relative;">
                <div style="width: 50mm; transform: scale(1.15); transform-origin: top left;">
                    @include('admin.Inpresora.ModeloTikes.ticket_50', ['venta' => $venta ?? null])
                </div>
            </div>
        </div>
        
        <h3>Plantilla: 50 mm</h3>
        
        <form action="{{ route('plantilla.activar', 50) }}" method="POST" style="margin-top: 15px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #aaa; cursor: pointer; font-weight: bold;">
                Activar plantilla
            </button>
        </form>
    </div>
    {{-- Plantilla: A4 --}}
    <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 300px; text-align: center; background-color: #fff; box-sizing: border-box;">
        <div style="background-color: #f5f5f5; height: 350px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <div style="background-color: #fff; height: 330px; width: 233px; overflow: hidden; border: 1px solid #ddd; text-align: left; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                <div style="width: 210mm; transform: scale(0.293); transform-origin: top left; position: absolute; top: 0; left: 0; pointer-events: none;">
                    @include('admin.Inpresora.ModeloTikes.ticket_a4', ['venta' => $venta ?? null])
                </div>
            </div>
        </div>
        
        <h3>Plantilla: A4</h3>
        
        <form action="{{ route('plantilla.activar', 'A4') }}" method="POST" style="margin-top: 15px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #aaa; cursor: pointer; font-weight: bold;">
                Activar plantilla
            </button>
        </form>
    </div>


</div>

@endsection