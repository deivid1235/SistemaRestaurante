@extends('layouts.dashboard')
@section('title', 'Nuevo Ajuste de Stock')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:none;padding:0;font-size:13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color:var(--primary)">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.Inventario.ajuste') }}" style="color:var(--primary)">Ajuste de Stock</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0" style="color:var(--text)">Nuevo Ajuste de Stock</h4>
</div>

<div class="row g-4">
    {{-- DATOS GENERALES --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100" style="border-radius:14px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Datos generales</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:12px;">Tipo Operación</label>
                    <select id="tipo_operacion" class="form-select form-select-sm">
                        <option value="">Seleccionar...</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                        <option value="merma">Merma</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:12px;">Responsable</label>
                    <input type="text" id="responsable" class="form-control form-control-sm"
                        placeholder="Nombre del responsable" value="{{ auth()->user()->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:12px;">Descripción / Concepto</label>
                    <textarea id="concepto" class="form-control form-control-sm" rows="3"
                        placeholder="Motivo del ajuste..."></textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- DETALLE --}}
    <div class="col-md-8">
        <div class="card shadow-sm border-0" style="border-radius:14px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-1">Detalle</h6>
                <p class="text-muted mb-3" style="font-size:12px;">Búsqueda del producto o insumo</p>

                {{-- BUSCADOR --}}
                <div class="mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fa fa-search text-muted"></i></span>
                        <input type="text" id="buscadorProducto" class="form-control border-start-0"
                            placeholder="Buscar producto por nombre..."
                            oninput="buscarProducto(this.value)">
                    </div>
                    <div id="resultadosBusqueda" class="list-group mt-1 shadow-sm" style="display:none; position:absolute; z-index:999; max-height:200px; overflow-y:auto;"></div>
                </div>

                {{-- TABLA DE ITEMS --}}
                <div class="table-responsive mb-3">
                    <table class="table align-middle" style="font-size:13px;">
                        <thead>
                            <tr style="background:#f8fafc; font-size:11px; text-transform:uppercase; color:#64748b;">
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th style="width:120px;">Cantidad</th>
                                <th>Unidad</th>
                                <th style="width:120px;">P.U.</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDetalle">
                            <tr id="filaVacia">
                                <td colspan="6" class="text-center text-muted py-4" style="font-size:12px;">
                                    <i class="fa fa-box-open fa-2x mb-2 d-block opacity-30"></i>
                                    Busca y agrega productos
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.Inventario.ajuste') }}" class="btn btn-outline-secondary btn-sm px-4">
                        Cancelar
                    </a>
                    <button onclick="guardarAjuste()" class="btn btn-success btn-sm px-4">
                        <i class="fa fa-check me-1"></i> Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Productos disponibles desde PHP
const productosDisponibles = @json($productos);
let detalles = [];

function buscarProducto(query) {
    const resultados = document.getElementById('resultadosBusqueda');
    if (!query || query.length < 2) {
        resultados.style.display = 'none';
        return;
    }
    const filtrados = productosDisponibles.filter(p =>
        p.nombre.toLowerCase().includes(query.toLowerCase())
    );
    if (!filtrados.length) {
        resultados.style.display = 'none';
        return;
    }
    resultados.innerHTML = filtrados.map(p => `
        <button type="button" class="list-group-item list-group-item-action py-2 px-3"
            onclick="agregarProducto(${p.id})" style="font-size:13px;">
            <span class="badge" style="background:${p.preparacion==='cocina'?'#3b82f6':'#f59e0b'};font-size:10px;margin-right:6px;">
                ${p.preparacion.toUpperCase()}
            </span>
            ${p.nombre}
            <small class="text-muted ms-2">Stock: ${p.stock}</small>
        </button>
    `).join('');
    resultados.style.display = 'block';
}

function agregarProducto(id) {
    document.getElementById('resultadosBusqueda').style.display = 'none';
    document.getElementById('buscadorProducto').value = '';

    if (detalles.find(d => d.id === id)) return;

    const p = productosDisponibles.find(p => p.id === id);
    detalles.push({ id: p.id, nombre: p.nombre, preparacion: p.preparacion, cantidad: 1, precio: 0 });
    renderTabla();
}

function renderTabla() {
    const tbody = document.getElementById('tablaDetalle');
    if (!detalles.length) {
        tbody.innerHTML = `<tr id="filaVacia"><td colspan="6" class="text-center text-muted py-4">
            <i class="fa fa-box-open fa-2x mb-2 d-block opacity-30"></i>Busca y agrega productos</td></tr>`;
        return;
    }
    tbody.innerHTML = detalles.map((d, i) => `
        <tr>
            <td>
                <span class="badge" style="background:${d.preparacion==='cocina'?'#3b82f6':'#f59e0b'};font-size:10px;">
                    ${d.preparacion.toUpperCase()}
                </span>
            </td>
            <td class="fw-semibold">${d.nombre}</td>
            <td>
                <input type="number" class="form-control form-control-sm" min="0.0001" step="0.0001"
                    value="${d.cantidad}" onchange="updateDetalle(${i},'cantidad',this.value)"
                    style="width:100px;">
            </td>
            <td><span class="text-muted">UND</span></td>
            <td>
                <input type="number" class="form-control form-control-sm" min="0" step="0.0001"
                    value="${d.precio}" onchange="updateDetalle(${i},'precio',this.value)"
                    style="width:100px;" placeholder="0.00">
            </td>
            <td class="text-center">
                <button class="btn btn-outline-danger btn-sm" onclick="quitarDetalle(${i})">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function updateDetalle(i, campo, val) {
    detalles[i][campo] = parseFloat(val) || 0;
}

function quitarDetalle(i) {
    detalles.splice(i, 1);
    renderTabla();
}

function guardarAjuste() {
    const tipo        = document.getElementById('tipo_operacion').value;
    const responsable = document.getElementById('responsable').value.trim();
    const concepto    = document.getElementById('concepto').value.trim();

    if (!tipo) return Swal.fire('Atención', 'Selecciona el tipo de operación.', 'warning');
    if (!responsable) return Swal.fire('Atención', 'Ingresa el responsable.', 'warning');
    if (!detalles.length) return Swal.fire('Atención', 'Agrega al menos un producto.', 'warning');

    const payload = {
        tipo_operacion: tipo,
        responsable,
        concepto,
        detalles: detalles.map(d => ({
            producto_id: d.id,
            cantidad: d.cantidad,
            precio_unitario: d.precio
        }))
    };

    fetch('{{ route("admin.Inventario.ajuste.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire('¡Listo!', data.message, 'success').then(() => {
                window.location.href = '{{ route("admin.Inventario.ajuste") }}';
            });
        } else {
            Swal.fire('Error', data.message ?? 'Ocurrió un error.', 'error');
        }
    })
    .catch(() => Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error'));
}

// Cerrar resultados al hacer click fuera
document.addEventListener('click', e => {
    if (!e.target.closest('#buscadorProducto') && !e.target.closest('#resultadosBusqueda')) {
        document.getElementById('resultadosBusqueda').style.display = 'none';
    }
});
</script>
@endpush
@endsection
