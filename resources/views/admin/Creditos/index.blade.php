@extends('layouts.dashboard')

@section('title', 'Créditos')

@section('content')
<div class="content-wrapper px-4 py-3">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:13px">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Créditos por Pagar</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-3">Créditos</h4>

    {{-- STATS CARDS --}}
    <div class="row g-3 mb-4">
        {{-- Total Deuda --}}
        <div class="col-md-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#f06292,#e91e63);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-dollar-sign fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Total Deuda</div>
                        <div class="fw-bold" style="font-size:1.8rem;line-height:1">
                            S/ {{ number_format($totalDeuda, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Intereses --}}
        <div class="col-md-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#ff8a65,#f4511e);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-percent fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Intereses</div>
                        <div class="fw-bold" style="font-size:1.8rem;line-height:1">
                            S/ {{ number_format($totalInteres, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Amortizado --}}
        <div class="col-md-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#66bb6a,#2e7d32);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-check-circle fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Amortizado</div>
                        <div class="fw-bold" style="font-size:1.8rem;line-height:1">
                            S/ {{ number_format($totalAmortizado, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Pendiente --}}
        <div class="col-md-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#ef5350,#b71c1c);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                         style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-exclamation-circle fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Pendiente</div>
                        <div class="fw-bold" style="font-size:1.8rem;line-height:1">
                            S/ {{ number_format($totalPendiente, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTADO --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-1">
                <div>
                    <h5 class="fw-bold mb-0"><i class="fas fa-credit-card text-danger me-2"></i>Listado de Créditos</h5>
                    <small class="text-muted">Gestione las deudas pendientes con proveedores.</small>
                </div>
            </div>

            {{-- FILTROS --}}
            <form method="GET" action="{{ route('admin.Creditos.index') }}" id="formFiltros">
                <div class="bg-light rounded p-3 mt-3">
                    <div class="row g-3 align-items-end">
                        {{-- Rango de Vencimiento --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">
                                <i class="fas fa-calendar-alt me-1 text-muted"></i> Rango de Vencimiento
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="date" name="fecha_inicio" class="form-control"
                                    value="{{ $fechaInicio->format('Y-m-d') }}">
                                <span class="input-group-text"><i class="fas fa-arrow-right"></i></span>
                                <input type="date" name="fecha_fin" class="form-control"
                                    value="{{ $fechaFin->format('Y-m-d') }}">
                            </div>
                        </div>
                        {{-- Proveedor --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Filtrar por Proveedor</label>
                            <select name="proveedor_id" class="form-select form-select-sm">
                                <option value="">Todos los proveedores</option>
                                @foreach($proveedores as $prov)
                                    <option value="{{ $prov->id }}" {{ request('proveedor_id') == $prov->id ? 'selected' : '' }}>
                                        {{ $prov->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Estado --}}
                        <div class="col-md-2">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Estado</label>
                            <select name="estado" class="form-select form-select-sm">
                                <option value="Todos">Todos</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="pagado"    {{ request('estado') == 'pagado'    ? 'selected' : '' }}>Pagado</option>
                                <option value="vencido"   {{ request('estado') == 'vencido'   ? 'selected' : '' }}>Vencido</option>
                            </select>
                        </div>
                        {{-- Botón --}}
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-search me-1"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.Creditos.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            {{-- TABLA --}}
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle" style="font-size:13px">
                    <thead class="table-light">
                        <tr>
                            <th>Proveedor</th>
                            <th>Documento</th>
                            <th class="text-end">Deuda</th>
                            <th class="text-end" style="color:#f4511e">Interés</th>
                            <th class="text-end" style="color:#2e7d32">Amortizado</th>
                            <th class="text-end" style="color:#b71c1c">Pendiente</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($creditos as $credito)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $credito->compra->proveedor->razon_social ?? '—' }}</span>
                                <br><small class="text-muted">{{ $credito->compra->proveedor->numero ?? '' }}</small>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $credito->compra->tipo_comprobante ?? '—' }}</span>
                                @if($credito->compra->serie || $credito->compra->numero)
                                    <br><small class="text-muted">{{ $credito->compra->serie }}-{{ $credito->compra->numero }}</small>
                                @endif
                            </td>
                            <td class="text-end fw-bold">S/ {{ number_format($credito->monto_total, 2) }}</td>
                            <td class="text-end" style="color:#f4511e">{{ number_format($credito->interes, 2) }}</td>
                            <td class="text-end" style="color:#2e7d32">S/ {{ number_format($credito->amortizado, 2) }}</td>
                            <td class="text-end fw-bold" style="color:#b71c1c">S/ {{ number_format($credito->pendiente, 2) }}</td>
                            <td>{{ $credito->fecha_vencimiento->format('d/m/Y') }}</td>
                            <td>
                                @if($credito->estado === 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                @elseif($credito->estado === 'vencido')
                                    <span class="badge bg-danger">Vencido</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" onclick="verDetalle({{ $credito->id }})" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if($credito->estado !== 'pagado')
                                <button class="btn btn-sm btn-outline-success ms-1" onclick="abrirPago({{ $credito->id }}, {{ $credito->pendiente }})" title="Registrar pago">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-2 d-block"></i>
                                No se encontraron datos
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- MODAL VER DETALLE --}}
<div class="modal fade" id="modalDetalle" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#e91e63,#b71c1c)">
                <h5 class="modal-title text-white"><i class="fas fa-credit-card me-2"></i>Detalle de Crédito</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetalleBody">
                <div class="text-center py-4"><div class="spinner-border text-danger"></div></div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL REGISTRAR PAGO --}}
<div class="modal fade" id="modalPago" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#66bb6a,#2e7d32)">
                <h5 class="modal-title text-white"><i class="fas fa-hand-holding-usd me-2"></i>Registrar Pago</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pagoCredito_id">
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px">Monto a Pagar</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">S/</span>
                        <input type="number" id="pagoMonto" class="form-control" step="0.01" min="0.01" placeholder="0.00">
                    </div>
                    <small class="text-muted">Saldo pendiente: <strong id="saldoPendiente">S/ 0.00</strong></small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px">Interés (opcional)</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">S/</span>
                        <input type="number" id="pagoInteres" class="form-control" step="0.01" min="0" value="0" placeholder="0.00">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px">Fecha de Pago</label>
                    <input type="date" id="pagoFecha" class="form-control form-control-sm"
                           value="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px">Observación</label>
                    <textarea id="pagoObservacion" class="form-control form-control-sm" rows="2" placeholder="Opcional..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-success btn-sm" onclick="guardarPago()">
                    <i class="fas fa-save me-1"></i> Guardar Pago
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ── Ver Detalle ──────────────────────────────────────────────────────────────
function verDetalle(id) {
    $('#modalDetalleBody').html('<div class="text-center py-4"><div class="spinner-border text-danger"></div></div>');
    $('#modalDetalle').modal('show');

    fetch(`/admin/Creditos/${id}`)
        .then(r => r.json())
        .then(data => {
            const compra  = data.compra  || {};
            const prov    = compra.proveedor || {};
            const detalles = (compra.detalles || []).map(d => `
                <tr>
                    <td>${d.descripcion || (d.producto ? d.producto.nombre : '—')}</td>
                    <td>${d.unidad_medida}</td>
                    <td class="text-end">${parseFloat(d.cantidad).toFixed(2)}</td>
                    <td class="text-end">S/ ${parseFloat(d.precio_unitario).toFixed(2)}</td>
                    <td class="text-end fw-bold">S/ ${parseFloat(d.importe).toFixed(2)}</td>
                </tr>`).join('');

            const pagos = (data.pagos || []).map(p => `
                <tr>
                    <td>${p.fecha_pago}</td>
                    <td class="text-end text-success fw-bold">S/ ${parseFloat(p.monto).toFixed(2)}</td>
                    <td class="text-end">${parseFloat(p.interes).toFixed(2)}</td>
                    <td>${p.observacion || '—'}</td>
                </tr>`).join('');

            const estadoBadge = {
                pagado:   '<span class="badge bg-success">Pagado</span>',
                pendiente:'<span class="badge bg-warning text-dark">Pendiente</span>',
                vencido:  '<span class="badge bg-danger">Vencido</span>',
            };

            $('#modalDetalleBody').html(`
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Proveedor:</strong> ${prov.razon_social || '—'}</p>
                        <p class="mb-1"><strong>RUC/DNI:</strong> ${prov.numero || '—'}</p>
                        <p class="mb-1"><strong>Comprobante:</strong> ${compra.tipo_comprobante || '—'} ${compra.serie ? compra.serie+'-'+compra.numero : ''}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Vencimiento:</strong> ${data.fecha_vencimiento}</p>
                        <p class="mb-1"><strong>Estado:</strong> ${estadoBadge[data.estado] || data.estado}</p>
                        <p class="mb-1"><strong>Pendiente:</strong> <span class="text-danger fw-bold">S/ ${parseFloat(data.pendiente).toFixed(2)}</span></p>
                    </div>
                </div>

                <h6 class="fw-bold mb-2"><i class="fas fa-boxes me-1 text-muted"></i>Productos de la Compra</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered" style="font-size:12px">
                        <thead class="table-light">
                            <tr><th>Producto/Insumo</th><th>U.M.</th><th class="text-end">Cant.</th><th class="text-end">P.U.</th><th class="text-end">Importe</th></tr>
                        </thead>
                        <tbody>${detalles || '<tr><td colspan="5" class="text-center text-muted">Sin detalles</td></tr>'}</tbody>
                        <tfoot>
                            <tr><td colspan="4" class="text-end">SubTotal</td><td class="text-end">S/ ${parseFloat(compra.subtotal||0).toFixed(2)}</td></tr>
                            <tr><td colspan="4" class="text-end">Descuento</td><td class="text-end">${parseFloat(compra.descuento||0).toFixed(2)}</td></tr>
                            <tr class="table-light fw-bold"><td colspan="4" class="text-end">Total</td><td class="text-end">S/ ${parseFloat(compra.total||0).toFixed(2)}</td></tr>
                        </tfoot>
                    </table>
                </div>

                <h6 class="fw-bold mb-2"><i class="fas fa-history me-1 text-muted"></i>Historial de Pagos</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style="font-size:12px">
                        <thead class="table-light">
                            <tr><th>Fecha</th><th class="text-end">Monto</th><th class="text-end">Interés</th><th>Observación</th></tr>
                        </thead>
                        <tbody>${pagos || '<tr><td colspan="4" class="text-center text-muted">Sin pagos registrados</td></tr>'}</tbody>
                    </table>
                </div>
            `);
        });
}

// ── Abrir modal de pago ──────────────────────────────────────────────────────
function abrirPago(creditoId, pendiente) {
    $('#pagoCredito_id').val(creditoId);
    $('#pagoMonto').val('').attr('max', pendiente);
    $('#pagoInteres').val(0);
    $('#pagoFecha').val(new Date().toISOString().split('T')[0]);
    $('#pagoObservacion').val('');
    $('#saldoPendiente').text('S/ ' + parseFloat(pendiente).toFixed(2));
    $('#modalPago').modal('show');
}

// ── Guardar pago ─────────────────────────────────────────────────────────────
function guardarPago() {
    const id    = $('#pagoCredito_id').val();
    const monto = $('#pagoMonto').val();
    const interes   = $('#pagoInteres').val();
    const fecha     = $('#pagoFecha').val();
    const obs       = $('#pagoObservacion').val();

    if (!monto || parseFloat(monto) <= 0) {
        Swal.fire('Error', 'Ingrese un monto válido.', 'error');
        return;
    }
    if (!fecha) {
        Swal.fire('Error', 'Seleccione la fecha de pago.', 'error');
        return;
    }

    fetch(`/admin/Creditos/${id}/pago`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ monto, interes, fecha_pago: fecha, observacion: obs })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            $('#modalPago').modal('hide');
            Swal.fire('¡Pago registrado!', data.message, 'success').then(() => location.reload());
        } else {
            Swal.fire('Error', data.message || 'No se pudo registrar el pago.', 'error');
        }
    });
}
</script>
@endpush
@endsection
