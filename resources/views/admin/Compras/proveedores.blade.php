@extends('layouts.dashboard')

@section('title', 'Proveedores')

@section('content')
<div class="content-wrapper px-4 py-3">

    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size:13px">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Proveedores</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-3">Compras</h4>

    {{-- STATS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-5">
            <div class="card border-0 text-white h-100" style="background:linear-gradient(135deg,#7c4dff,#3d5afe);">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;min-width:52px">
                        <i class="fas fa-truck fa-lg text-white"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;opacity:.85">Total Registrados</div>
                        <div class="fw-bold" style="font-size:2rem;line-height:1">{{ $total }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card border-0 h-100" style="background:#e3f6fd;">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-info-circle fa-2x text-info"></i>
                    <div>
                        <div class="fw-bold">Gestión de Proveedores</div>
                        <small class="text-muted">Mantenga actualizada la información de sus socios comerciales para agilizar las órdenes de compra.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTADO --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-0"><i class="fas fa-list text-danger me-2"></i>Directorio de Proveedores</h5>
                    <small class="text-muted">Listado completo de empresas y contactos.</small>
                </div>
                <button class="btn btn-success btn-sm px-3" onclick="abrirModalProveedor()">
                    <i class="fas fa-plus me-1"></i> Nuevo Proveedor
                </button>
            </div>

            {{-- Buscador --}}
            <div class="input-group input-group-sm mb-3" style="max-width:400px">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="busqueda" placeholder="Buscar por RUC, nombre o teléfono..."
                    oninput="filtrarTabla()">
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" style="font-size:13px" id="tablaProveedores">
                    <thead class="table-light">
                        <tr>
                            <th>Datos del Proveedor</th>
                            <th>Dirección / Contacto</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proveedores as $prov)
                        <tr data-busqueda="{{ strtolower($prov->razon_social . ' ' . $prov->numero . ' ' . $prov->telefono) }}">
                            <td>
                                <span class="fw-semibold">{{ $prov->razon_social }}</span>
                                <br><small class="text-muted">{{ $prov->tipo_documento }}: {{ $prov->numero }}</small>
                            </td>
                            <td>
                                {{ $prov->direccion ?? '—' }}
                                @if($prov->contacto)
                                    <br><small class="text-muted"><i class="fas fa-user me-1"></i>{{ $prov->contacto }}</small>
                                @endif
                                @if($prov->email)
                                    <br><small class="text-muted"><i class="fas fa-envelope me-1"></i>{{ $prov->email }}</small>
                                @endif
                            </td>
                            <td>
                                @if($prov->estado === 'a')
                                    <span class="badge bg-success">ACTIVO</span>
                                @else
                                    <span class="badge bg-secondary">INACTIVO</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" title="Editar"
                                    onclick="editarProveedor({{ $prov->id }}, '{{ $prov->tipo_documento }}', '{{ $prov->numero }}', '{{ addslashes($prov->razon_social) }}', '{{ addslashes($prov->direccion) }}', '{{ $prov->telefono }}', '{{ $prov->contacto }}', '{{ $prov->email }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-2 d-block"></i>
                                No hay proveedores registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <small class="text-muted">Mostrando {{ $total }} de {{ $total }} elementos</small>
        </div>
    </div>
</div>

{{-- MODAL PROVEEDOR --}}
<div class="modal fade" id="modalProveedor" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#7c4dff,#3d5afe)">
                <h5 class="modal-title text-white" id="tituloModalProv">Nuevo Proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="prov_id">
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
                    <label class="form-label form-label-sm" id="labelNum">RUC</label>
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
                <button class="btn btn-sm btn-success" id="btnGuardarProv" onclick="guardarProveedor()">
                    <i class="fas fa-save me-1"></i> Guardar Datos
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('input[name="tipoDoc"]').forEach(r => {
    r.addEventListener('change', () => {
        const v = document.querySelector('input[name="tipoDoc"]:checked').value;
        document.getElementById('labelNum').textContent = v;
        document.getElementById('prov_numero').maxLength = v === 'DNI' ? 8 : 11;
    });
});

function abrirModalProveedor() {
    document.getElementById('prov_id').value = '';
    document.getElementById('tituloModalProv').textContent = 'Nuevo Proveedor';
    document.getElementById('prov_numero').value = '';
    document.getElementById('prov_razon_social').value = '';
    document.getElementById('prov_direccion').value = '';
    document.getElementById('prov_telefono').value = '';
    document.getElementById('prov_contacto').value = '';
    document.getElementById('prov_email').value = '';
    document.getElementById('radioRUC').checked = true;
    document.getElementById('labelNum').textContent = 'RUC';
    new bootstrap.Modal(document.getElementById('modalProveedor')).show();
}

function editarProveedor(id, tipo, numero, razon, direccion, telefono, contacto, email) {
    document.getElementById('prov_id').value = id;
    document.getElementById('tituloModalProv').textContent = 'Editar Proveedor';
    document.getElementById('prov_numero').value = numero;
    document.getElementById('prov_razon_social').value = razon;
    document.getElementById('prov_direccion').value = direccion;
    document.getElementById('prov_telefono').value = telefono;
    document.getElementById('prov_contacto').value = contacto;
    document.getElementById('prov_email').value = email;
    document.querySelector(`input[name="tipoDoc"][value="${tipo}"]`).checked = true;
    document.getElementById('labelNum').textContent = tipo;
    new bootstrap.Modal(document.getElementById('modalProveedor')).show();
}

function guardarProveedor() {
    const id = document.getElementById('prov_id').value;
    const data = {
        tipo_documento: document.querySelector('input[name="tipoDoc"]:checked').value,
        numero:         document.getElementById('prov_numero').value,
        razon_social:   document.getElementById('prov_razon_social').value,
        direccion:      document.getElementById('prov_direccion').value,
        telefono:       document.getElementById('prov_telefono').value,
        contacto:       document.getElementById('prov_contacto').value,
        email:          document.getElementById('prov_email').value,
    };

    const url    = id ? `/admin/Compras/proveedores/${id}` : '{{ route("admin.Compras.proveedores.store") }}';
    const method = id ? 'PUT' : 'POST';

    if (method === 'PUT') data['_method'] = 'PUT';

    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            Swal.fire('¡Guardado!', 'Proveedor guardado correctamente.', 'success')
                .then(() => location.reload());
        } else {
            Swal.fire('Error', 'No se pudo guardar.', 'error');
        }
    });
}

function filtrarTabla() {
    const q = document.getElementById('busqueda').value.toLowerCase();
    document.querySelectorAll('#tablaProveedores tbody tr').forEach(tr => {
        tr.style.display = tr.dataset.busqueda && tr.dataset.busqueda.includes(q) ? '' : 'none';
    });
}
</script>
@endpush
@endsection
