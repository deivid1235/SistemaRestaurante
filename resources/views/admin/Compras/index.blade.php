@extends('layouts.dashboard')

@section('title', 'Compras')

@section('content')
<div class="content-wrapper px-4 py-3">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:13px">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Historial de Compras</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-3">Compras</h4>

    {{-- STATS CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#29b6f6,#0288d1);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-shopping-cart fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Total Operaciones</div>
                        <div class="fw-bold" style="font-size:2rem;line-height:1">{{ $totalOperaciones }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg,#7c4dff,#3d5afe);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-dollar-sign fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Monto Total Comprado</div>
                        <div class="fw-bold" style="font-size:2rem;line-height:1">S/ {{ number_format($montoTotal, 2) }}</div>
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
                    <h5 class="fw-bold mb-0"><i class="fas fa-list text-danger me-2"></i>Listado de Compras</h5>
                    <small class="text-muted">Gestione sus adquisiciones de insumos y productos.</small>
                </div>
                <a href="{{ route('admin.Compras.create') }}" class="btn btn-success btn-sm px-3">
                    <i class="fas fa-plus me-1"></i> Registrar Compra
                </a>
            </div>

            {{-- FILTROS --}}
            <form method="GET" action="{{ route('admin.Compras.index') }}" id="formFiltros">
                <div class="bg-light rounded p-3 mt-3">
                    <div class="row g-3 align-items-end">
                        {{-- Rango de fechas --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">
                                <i class="fas fa-calendar-alt me-1 text-muted"></i> Rango de Fechas
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
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Proveedor</label>
                            <select name="proveedor_id" class="form-select form-select-sm">
                                <option value="">Todos los proveedores</option>
                                @foreach($proveedores as $prov)
                                    <option value="{{ $prov->id }}" {{ request('proveedor_id') == $prov->id ? 'selected' : '' }}>
                                        {{ $prov->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Tipo Pago --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Tipo Pago</label>
                            <select name="tipo_pago" class="form-select form-select-sm">
                                <option value="Todos">Todos</option>
                                <option value="Contado" {{ request('tipo_pago') == 'Contado' ? 'selected' : '' }}>Contado</option>
                                <option value="Crédito" {{ request('tipo_pago') == 'Crédito' ? 'selected' : '' }}>Crédito</option>
                            </select>
                        </div>
                        {{-- Comprobante --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Comprobante</label>
                            <select name="tipo_comprobante" class="form-select form-select-sm">
                                <option value="Todos">Todos</option>
                                @foreach(['Factura','Boleta','Ticket','Nota de Pedido','Otros'] as $comp)
                                    <option value="{{ $comp }}" {{ request('tipo_comprobante') == $comp ? 'selected' : '' }}>{{ $comp }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Estado --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold mb-1" style="font-size:13px">Estado</label>
                            <select name="estado" class="form-select form-select-sm">
                                <option value="Todos">Todos</option>
                                <option value="aceptado" {{ request('estado') == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="anulado" {{ request('estado') == 'anulado' ? 'selected' : '' }}>Anulado</option>
                            </select>
                        </div>
                        {{-- Botón --}}
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-search me-1"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.Compras.index') }}" class="btn btn-outline-secondary btn-sm">
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
                            <th>F. Reg.</th>
                            <th>F. Doc.</th>
                            <th>Documento</th>
                            <th>Proveedor</th>
                            <th class="text-end">Total</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($compras as $compra)
                        <tr>
                            <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($compra->fecha_documento)->format('d/m/Y') }}</td>
                            <td>
                                <span class="fw-semibold">{{ $compra->tipo_comprobante }}</span>
                                @if($compra->serie || $compra->numero)
                                    <br><small class="text-muted">{{ $compra->serie }}-{{ $compra->numero }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $compra->proveedor->razon_social ?? '—' }}</span>
                                <br><small class="text-muted">RUC: {{ $compra->proveedor->numero ?? '' }}</small>
                            </td>
                            <td class="text-end fw-bold">S/ {{ number_format($compra->total, 2) }}</td>
                            <td>
                                <span class="badge {{ $compra->tipo_pago === 'Contado' ? 'bg-info text-dark' : 'bg-warning text-dark' }}">
                                    {{ $compra->tipo_pago }}
                                </span>
                            </td>
                            <td>
                                @if($compra->estado === 'aceptado')
                                    <span class="badge bg-success">Aceptado</span>
                                @elseif($compra->estado === 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    <span class="badge bg-danger">Anulado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" onclick="verDetalle({{ $compra->id }})" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if($compra->estado !== 'anulado')
                                <button class="btn btn-sm btn-outline-danger ms-1" onclick="anularCompra({{ $compra->id }})" title="Anular">
                                    <i class="fas fa-ban"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
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
            <div class="modal-header" style="background:linear-gradient(135deg,#7c4dff,#3d5afe)">
                <h5 class="modal-title text-white"><i class="fas fa-file-invoice me-2"></i>Detalle de Compra</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetalleBody">
                <div class="text-center py-4"><div class="spinner-border text-primary"></div></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function verDetalle(id) {
    $('#modalDetalleBody').html('<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>');
    $('#modalDetalle').modal('show');
    fetch(`/admin/Compras/${id}`)
        .then(r => r.json())
        .then(data => {
            let rows = data.detalles.map(d => `
                <tr>
                    <td>${d.descripcion || (d.producto ? d.producto.nombre : '—')}</td>
                    <td>${d.unidad_medida}</td>
                    <td class="text-end">${parseFloat(d.cantidad).toFixed(2)}</td>
                    <td class="text-end">S/ ${parseFloat(d.precio_unitario).toFixed(2)}</td>
                    <td class="text-end fw-bold">S/ ${parseFloat(d.importe).toFixed(2)}</td>
                </tr>`).join('');

            const estadoBadge = {
                aceptado: '<span class="badge bg-success">Aceptado</span>',
                pendiente: '<span class="badge bg-warning text-dark">Pendiente</span>',
                anulado:   '<span class="badge bg-danger">Anulado</span>',
            };

            $('#modalDetalleBody').html(`
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Proveedor:</strong> ${data.proveedor ? data.proveedor.razon_social : '—'}</p>
                        <p class="mb-1"><strong>RUC/DNI:</strong> ${data.proveedor ? data.proveedor.numero : '—'}</p>
                        <p class="mb-1"><strong>Comprobante:</strong> ${data.tipo_comprobante} ${data.serie ? data.serie+'-'+data.numero : ''}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Fecha:</strong> ${data.fecha_documento}</p>
                        <p class="mb-1"><strong>Tipo Pago:</strong> ${data.tipo_pago}</p>
                        <p class="mb-1"><strong>Estado:</strong> ${estadoBadge[data.estado] || data.estado}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style="font-size:13px">
                        <thead class="table-light">
                            <tr><th>Producto/Insumo</th><th>U.M.</th><th class="text-end">Cantidad</th><th class="text-end">P.U.</th><th class="text-end">Importe</th></tr>
                        </thead>
                        <tbody>${rows}</tbody>
                        <tfoot>
                            <tr><td colspan="4" class="text-end">SubTotal</td><td class="text-end">S/ ${parseFloat(data.subtotal).toFixed(2)}</td></tr>
                            <tr><td colspan="4" class="text-end">Descuento</td><td class="text-end">${parseFloat(data.descuento).toFixed(2)}</td></tr>
                            <tr class="table-light fw-bold"><td colspan="4" class="text-end">Total</td><td class="text-end">S/ ${parseFloat(data.total).toFixed(2)}</td></tr>
                        </tfoot>
                    </table>
                </div>
            `);
        });
}

function anularCompra(id) {
    Swal.fire({
        title: '¿Anular compra?',
        text: 'Esta acción revertirá el stock. ¿Desea continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Sí, anular',
        cancelButtonText: 'Cancelar'
    }).then(r => {
        if (r.isConfirmed) {
            fetch(`/admin/Compras/${id}/anular`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Anulada', data.message, 'success').then(() => location.reload());
                }
            });
        }
    });
}
</script>
@endpush
@endsection
