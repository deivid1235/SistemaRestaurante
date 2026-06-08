@extends('layouts.dashboard')

@section('title', 'Nueva Compra')

@section('content')
<div class="content-wrapper px-4 py-3">

    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:13px">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.Compras.index') }}">Todas las compras</a></li>
            <li class="breadcrumb-item active">Nueva compra</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-3">Compras</h4>

    <div class="row g-3">
        {{-- ── DATOS GENERALES ── --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Datos generales</h6>

                    <div class="mb-3">
                        <label class="form-label form-label-sm">Tipo</label>
                        <select class="form-select form-select-sm" id="tipo_comprobante" name="tipo_comprobante">
                            <option value="">Seleccionar</option>
                            @foreach($comprobantes as $comp)
                                <option value="{{ $comp }}">{{ $comp }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label form-label-sm">Documento</label>
                        <select class="form-select form-select-sm" id="tipo_pago" name="tipo_pago">
                            <option value="">Seleccionar</option>
                            @foreach($tiposPago as $tp)
                                <option value="{{ $tp }}">{{ $tp }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label form-label-sm">Serie</label>
                            <input type="text" class="form-control form-control-sm" id="serie" placeholder="F001">
                        </div>
                        <div class="col-6">
                            <label class="form-label form-label-sm">Número</label>
                            <input type="text" class="form-control form-control-sm" id="numero" placeholder="00001">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label form-label-sm">Fecha</label>
                            <input type="date" class="form-control form-control-sm" id="fecha_documento"
                                value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label form-label-sm">Hora</label>
                            <input type="time" class="form-control form-control-sm" id="hora_documento"
                                value="{{ date('H:i') }}">
                        </div>
                    </div>

                    {{-- PROVEEDOR --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label form-label-sm fw-bold mb-0">Proveedor</label>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-warning" onclick="abrirModalProveedor('nuevo')" title="Nuevo proveedor">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <select class="form-select form-select-sm" id="proveedor_id">
                        <option value="">Ingrese un proveedor</option>
                        @foreach($proveedores as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->razon_social }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted" id="infoProveedor"></small>
                </div>
            </div>
        </div>

        {{-- ── DETALLE ── --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Detalle</h6>
                    <small class="text-muted">Búsqueda del producto o insumo</small>

                    {{-- Buscador de producto --}}
                    <div class="row g-2 align-items-end mt-2 mb-3">
                        <div class="col-md-5">
                            <select class="form-select form-select-sm" id="selectProducto">
                                <option value="">Buscar producto / insumo...</option>
                                @foreach($productos as $prod)
                                    <option value="{{ $prod->id }}"
                                        data-nombre="{{ $prod->nombre }}"
                                        data-precio="{{ $prod->costo }}"
                                        data-um="UND">
                                        {{ $prod->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control form-control-sm" id="inputUM" placeholder="U.M." value="UND">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control form-control-sm" id="inputCantidad" placeholder="Cantidad" value="1" min="0.001" step="0.001">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control form-control-sm" id="inputPrecio" placeholder="P.U." min="0" step="0.01">
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-danger btn-sm rounded-circle" style="width:32px;height:32px" onclick="agregarProducto()" title="Agregar">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Tabla detalle --}}
                    <div class="table-responsive">
                        <table class="table table-sm align-middle" style="font-size:13px" id="tablaDetalle">
                            <thead class="table-light">
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto/Insumo</th>
                                    <th>U.M.</th>
                                    <th class="text-end">P.U.</th>
                                    <th class="text-end">Importe</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="detalleBody">
                                <tr id="rowVacio">
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-exclamation-circle fa-2x mb-2 d-block"></i>
                                        Sin productos agregados
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end text-muted">SubTotal</td>
                                    <td class="text-end" id="lblSubtotal">S/ 0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end text-muted">Descuento</td>
                                    <td class="text-end">
                                        <input type="number" class="form-control form-control-sm text-end" id="inputDescuento"
                                            style="width:90px;margin-left:auto" value="0" min="0" step="0.01"
                                            oninput="calcularTotales()">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-end">Total</td>
                                    <td class="text-end" id="lblTotal">S/ 0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-end mt-2 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.Compras.index') }}" class="btn btn-sm btn-outline-secondary">Cancelar</a>
                        <button class="btn btn-sm btn-success px-4" onclick="guardarCompra()">
                            <i class="fas fa-save me-1"></i> Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL NUEVO PROVEEDOR --}}
<div class="modal fade" id="modalProveedor" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#7c4dff,#3d5afe)">
                <h5 class="modal-title text-white">Nuevo Proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end gap-3 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoDoc" id="radioDNI" value="DNI">
                        <label class="form-check-label" for="radioDNI">DNI</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoDoc" id="radioRUC" value="RUC" checked>
                        <label class="form-check-label" for="radioRUC">RUC</label>
                    </div>
                </div>

                <p class="fw-semibold text-uppercase text-muted mb-1" style="font-size:11px;letter-spacing:1px">Identificación</p>
                <div class="mb-2">
                    <label class="form-label form-label-sm" id="labelNumDoc">RUC</label>
                    <input type="text" class="form-control form-control-sm" id="prov_numero" maxlength="11">
                </div>
                <div class="mb-3">
                    <label class="form-label form-label-sm">Razón Social / Nombre</label>
                    <input type="text" class="form-control form-control-sm" id="prov_razon_social">
                </div>

                <p class="fw-semibold text-uppercase text-muted mb-1" style="font-size:11px;letter-spacing:1px">Contacto y Ubicación</p>
                <div class="mb-2">
                    <label class="form-label form-label-sm">Dirección Fiscal</label>
                    <input type="text" class="form-control form-control-sm" id="prov_direccion">
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="form-label form-label-sm"><i class="fas fa-phone me-1"></i>Teléfono</label>
                        <input type="text" class="form-control form-control-sm" id="prov_telefono">
                    </div>
                    <div class="col-6">
                        <label class="form-label form-label-sm"><i class="fas fa-user me-1"></i>Persona de Contacto</label>
                        <input type="text" class="form-control form-control-sm" id="prov_contacto">
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label form-label-sm"><i class="fas fa-envelope me-1"></i>Correo Electrónico</label>
                    <input type="email" class="form-control form-control-sm" id="prov_email">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-sm btn-success" onclick="guardarProveedor()">
                    <i class="fas fa-save me-1"></i> Guardar Datos
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let detalles = [];

// Tipo doc en modal
document.querySelectorAll('input[name="tipoDoc"]').forEach(r => {
    r.addEventListener('change', () => {
        const v = document.querySelector('input[name="tipoDoc"]:checked').value;
        document.getElementById('labelNumDoc').textContent = v;
        document.getElementById('prov_numero').maxLength = v === 'DNI' ? 8 : 11;
    });
});

function abrirModalProveedor(tipo) {
    document.getElementById('prov_numero').value = '';
    document.getElementById('prov_razon_social').value = '';
    document.getElementById('prov_direccion').value = '';
    document.getElementById('prov_telefono').value = '';
    document.getElementById('prov_contacto').value = '';
    document.getElementById('prov_email').value = '';
    new bootstrap.Modal(document.getElementById('modalProveedor')).show();
}

function guardarProveedor() {
    const data = {
        tipo_documento: document.querySelector('input[name="tipoDoc"]:checked').value,
        numero:         document.getElementById('prov_numero').value,
        razon_social:   document.getElementById('prov_razon_social').value,
        direccion:      document.getElementById('prov_direccion').value,
        telefono:       document.getElementById('prov_telefono').value,
        contacto:       document.getElementById('prov_contacto').value,
        email:          document.getElementById('prov_email').value,
    };
    fetch('{{ route("admin.Compras.proveedores.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            // Agregar al select
            const opt = new Option(res.proveedor.razon_social, res.proveedor.id, true, true);
            document.getElementById('proveedor_id').add(opt);
            bootstrap.Modal.getInstance(document.getElementById('modalProveedor')).hide();
            Swal.fire('¡Guardado!', 'Proveedor registrado correctamente.', 'success');
        } else {
            Swal.fire('Error', 'No se pudo guardar el proveedor.', 'error');
        }
    });
}

// Autocompletar precio al seleccionar producto
document.getElementById('selectProducto').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    document.getElementById('inputPrecio').value = opt.dataset.precio || '';
    document.getElementById('inputUM').value = opt.dataset.um || 'UND';
});

function agregarProducto() {
    const sel     = document.getElementById('selectProducto');
    const opt     = sel.options[sel.selectedIndex];
    const nombre  = opt.dataset.nombre || opt.text;
    const prodId  = sel.value;
    const um      = document.getElementById('inputUM').value || 'UND';
    const cant    = parseFloat(document.getElementById('inputCantidad').value) || 0;
    const precio  = parseFloat(document.getElementById('inputPrecio').value) || 0;

    if (!nombre || nombre === 'Buscar producto / insumo...') {
        Swal.fire('Atención', 'Seleccione un producto.', 'warning'); return;
    }
    if (cant <= 0) { Swal.fire('Atención', 'Ingrese una cantidad válida.', 'warning'); return; }
    if (precio <= 0) { Swal.fire('Atención', 'Ingrese un precio válido.', 'warning'); return; }

    const importe = cant * precio;
    const idx = detalles.length;
    detalles.push({ producto_id: prodId || null, descripcion: nombre, unidad_medida: um, cantidad: cant, precio_unitario: precio, importe });

    document.getElementById('rowVacio') && document.getElementById('rowVacio').remove();

    const tr = document.createElement('tr');
    tr.id = `row_${idx}`;
    tr.innerHTML = `
        <td>${cant.toFixed(3)}</td>
        <td>${nombre}</td>
        <td>${um}</td>
        <td class="text-end">S/ ${precio.toFixed(2)}</td>
        <td class="text-end fw-bold">S/ ${importe.toFixed(2)}</td>
        <td class="text-center">
            <button class="btn btn-sm btn-outline-danger" onclick="quitarProducto(${idx})"><i class="fas fa-trash"></i></button>
        </td>`;
    document.getElementById('detalleBody').appendChild(tr);

    // Limpiar
    sel.value = '';
    document.getElementById('inputCantidad').value = 1;
    document.getElementById('inputPrecio').value = '';
    document.getElementById('inputUM').value = 'UND';

    calcularTotales();
}

function quitarProducto(idx) {
    detalles[idx] = null;
    const row = document.getElementById(`row_${idx}`);
    if (row) row.remove();
    if (detalles.filter(d => d !== null).length === 0) {
        document.getElementById('detalleBody').innerHTML = `
            <tr id="rowVacio"><td colspan="6" class="text-center text-muted py-4">
                <i class="fas fa-exclamation-circle fa-2x mb-2 d-block"></i>Sin productos agregados
            </td></tr>`;
    }
    calcularTotales();
}

function calcularTotales() {
    const sub = detalles.filter(d => d !== null).reduce((a, d) => a + d.importe, 0);
    const desc = parseFloat(document.getElementById('inputDescuento').value) || 0;
    document.getElementById('lblSubtotal').textContent = `S/ ${sub.toFixed(2)}`;
    document.getElementById('lblTotal').textContent = `S/ ${(sub - desc).toFixed(2)}`;
}

function guardarCompra() {
    const items = detalles.filter(d => d !== null);
    if (!document.getElementById('proveedor_id').value) {
        Swal.fire('Atención', 'Seleccione un proveedor.', 'warning'); return;
    }
    if (!document.getElementById('tipo_comprobante').value) {
        Swal.fire('Atención', 'Seleccione el tipo de comprobante.', 'warning'); return;
    }
    if (!document.getElementById('tipo_pago').value) {
        Swal.fire('Atención', 'Seleccione el tipo de pago.', 'warning'); return;
    }
    if (items.length === 0) {
        Swal.fire('Atención', 'Agregue al menos un producto.', 'warning'); return;
    }

    const payload = {
        proveedor_id:     document.getElementById('proveedor_id').value,
        tipo_comprobante: document.getElementById('tipo_comprobante').value,
        tipo_pago:        document.getElementById('tipo_pago').value,
        serie:            document.getElementById('serie').value,
        numero:           document.getElementById('numero').value,
        fecha_documento:  document.getElementById('fecha_documento').value,
        hora_documento:   document.getElementById('hora_documento').value,
        descuento:        parseFloat(document.getElementById('inputDescuento').value) || 0,
        detalles:         items,
    };

    fetch('{{ route("admin.Compras.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            Swal.fire('¡Registrado!', res.message, 'success')
                .then(() => window.location.href = '{{ route("admin.Compras.index") }}');
        } else {
            Swal.fire('Error', 'No se pudo registrar la compra.', 'error');
        }
    });
}
</script>
@endpush
@endsection
