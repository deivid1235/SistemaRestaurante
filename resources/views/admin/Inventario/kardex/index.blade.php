@extends('layouts.dashboard')
@section('title', 'Kardex Valorizado')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:none;padding:0;font-size:13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color:var(--primary)">Inicio</a></li>
            <li class="breadcrumb-item active">Kardex Valorizado</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0" style="color:var(--text)">Kardex Valorizado</h4>
</div>

<div class="card shadow-sm border-0" style="border-radius:14px;">
    <div class="card-body p-4">

        {{-- FILTROS --}}
        <form method="GET" action="{{ route('admin.Inventario.kardex') }}" id="formKardex">
            <div class="row g-3 mb-4 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size:12px;">
                        <i class="fa fa-calendar me-1"></i> Período
                    </label>
                    <div class="d-flex gap-1 align-items-center">
                        <input type="date" name="fecha_inicio" class="form-control form-control-sm"
                            value="{{ $fechaInicio->format('Y-m-d') }}">
                        <span class="text-muted">→</span>
                        <input type="date" name="fecha_fin" class="form-control form-control-sm"
                            value="{{ $fechaFin->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold" style="font-size:12px;">
                        <i class="fa fa-filter me-1"></i> Tipo de ítem
                    </label>
                    <select name="tipo" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="cocina"  {{ $tipo === 'cocina'  ? 'selected' : '' }}>COCINA</option>
                        <option value="bodega"  {{ $tipo === 'bodega'  ? 'selected' : '' }}>BODEGA</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size:12px;">
                        <i class="fa fa-search me-1"></i> Seleccionar ítem
                    </label>
                    <select name="producto_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Buscar por nombre...</option>
                        @foreach($productos as $p)
                            <option value="{{ $p->id }}"
                                {{ (isset($productoSel) && $productoSel->id == $p->id) ? 'selected' : '' }}>
                                {{ $p->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm px-4 text-white" style="background:var(--primary); border-radius:8px;">
                        <i class="fa fa-search me-1"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        {{-- TARJETAS RESUMEN --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="rounded-3 p-3 border text-center">
                    <div class="text-muted" style="font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Stock Inicial</div>
                    <div class="fw-bold" style="font-size:22px;">{{ number_format($stockInicial, 4) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="rounded-3 p-3 border text-center" style="border-color:#22c55e !important;">
                    <div style="color:#22c55e; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">
                        <i class="fa fa-arrow-down me-1"></i> Entradas
                    </div>
                    <div class="fw-bold" style="font-size:22px; color:#22c55e;">{{ number_format($entradas, 4) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="rounded-3 p-3 border text-center" style="border-color:#ef4444 !important;">
                    <div style="color:#ef4444; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">
                        <i class="fa fa-arrow-up me-1"></i> Salidas
                    </div>
                    <div class="fw-bold" style="font-size:22px; color:#ef4444;">{{ number_format($salidas, 4) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="rounded-3 p-3 text-white text-center" style="background:#1e293b; border-radius:12px !important;">
                    <div style="font-size:11px; text-transform:uppercase; letter-spacing:0.05em; opacity:.7;">Stock Final</div>
                    <div class="fw-bold" style="font-size:22px;">{{ number_format($stockFinal, 4) }}</div>
                </div>
            </div>
        </div>

        {{-- TABLA KARDEX --}}
        <div class="table-responsive">
            <table class="table align-middle" style="font-size:13px;">
                <thead>
                    <tr style="background:#f8fafc; font-size:11px; text-transform:uppercase; color:#64748b;">
                        <th>Fecha</th>
                        <th>Concepto / Detalle</th>
                        <th colspan="3" class="text-center" style="background:#f0fdf4; color:#16a34a; border-radius:8px 8px 0 0;">
                            Entrada
                        </th>
                        <th colspan="3" class="text-center" style="background:#fff5f5; color:#dc2626;">
                            Salida
                        </th>
                        <th colspan="3" class="text-center" style="background:#eff6ff; color:#2563eb;">
                            Saldo
                        </th>
                    </tr>
                    <tr style="font-size:11px; color:#94a3b8;">
                        <th></th><th></th>
                        <th class="text-center" style="background:#f0fdf4;">Cant.</th>
                        <th class="text-center" style="background:#f0fdf4;">C.U.</th>
                        <th class="text-center" style="background:#f0fdf4;">Total</th>
                        <th class="text-center" style="background:#fff5f5;">Cant.</th>
                        <th class="text-center" style="background:#fff5f5;">C.U.</th>
                        <th class="text-center" style="background:#fff5f5;">Total</th>
                        <th class="text-center" style="background:#eff6ff;">Cant.</th>
                        <th class="text-center" style="background:#eff6ff;">C.U.</th>
                        <th class="text-center" style="background:#eff6ff;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movimientos as $mov)
                    @php
                        $esEntrada = $mov->tipo_operacion === 'entrada';
                        $esSalida  = in_array($mov->tipo_operacion, ['salida', 'merma']);
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($mov->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge"
                                style="background:{{ $esEntrada ? '#dcfce7' : '#fee2e2' }};
                                       color:{{ $esEntrada ? '#16a34a' : '#dc2626' }};
                                       font-size:10px; padding:3px 7px;">
                                {{ strtoupper($mov->tipo_operacion) }}
                            </span>
                            {{ $mov->concepto ?? '—' }}
                        </td>
                        {{-- ENTRADA --}}
                        <td class="text-center" style="background:#f0fdf4;">{{ $esEntrada ? number_format($mov->cantidad,4) : '' }}</td>
                        <td class="text-center" style="background:#f0fdf4;">{{ $esEntrada ? number_format($mov->precio_unitario,4) : '' }}</td>
                        <td class="text-center" style="background:#f0fdf4;">{{ $esEntrada ? number_format($mov->total,4) : '' }}</td>
                        {{-- SALIDA --}}
                        <td class="text-center" style="background:#fff5f5;">{{ $esSalida ? number_format($mov->cantidad,4) : '' }}</td>
                        <td class="text-center" style="background:#fff5f5;">{{ $esSalida ? number_format($mov->precio_unitario,4) : '' }}</td>
                        <td class="text-center" style="background:#fff5f5;">{{ $esSalida ? number_format($mov->total,4) : '' }}</td>
                        {{-- SALDO --}}
                        <td class="text-center" style="background:#eff6ff; font-weight:600;">{{ number_format($mov->cantidad,4) }}</td>
                        <td class="text-center" style="background:#eff6ff;">{{ number_format($mov->precio_unitario,4) }}</td>
                        <td class="text-center" style="background:#eff6ff;">{{ number_format($mov->total,4) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-5 text-muted">
                            <i class="fa fa-exclamation-circle fa-2x mb-2 d-block"></i>
                            No se encontraron datos
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
