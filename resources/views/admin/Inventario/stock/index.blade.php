@extends('layouts.dashboard')
@section('title', 'Stock de Inventario')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:none;padding:0;font-size:13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color:var(--primary)">Inicio</a></li>
            <li class="breadcrumb-item active">Stock de Inventario</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0" style="color:var(--text)">Stock de Inventario</h4>
</div>

<div class="card shadow-sm border-0" style="border-radius:14px;">
    <div class="card-body p-4">

        {{-- ENCABEZADO --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="fw-bold mb-0" style="color:var(--primary)">
                    <i class="fa fa-boxes me-2"></i> Stock de Inventario
                </h5>
                <small class="text-muted">Consulte las existencias actuales en tiempo real.</small>
            </div>
            <button onclick="descargarPdf()" class="btn btn-danger btn-sm px-3" title="Descargar PDF">
                <i class="fa fa-file-pdf me-1"></i> PDF
            </button>
        </div>

        {{-- FILTROS --}}
        <div class="row g-2 mb-3 align-items-center">
            <div class="col-md-3">
                <select id="filtroTipo" class="form-select form-select-sm" onchange="filtrar()">
                    <option value="todos">Todos los Tipos</option>
                    <option value="cocina">Cocina</option>
                    <option value="bodega">Bodega</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-center gap-2">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="soloBajo" onchange="filtrar()">
                </div>
                <label for="soloBajo" class="text-warning fw-semibold mb-0" style="font-size:13px; cursor:pointer;">
                    <i class="fa fa-exclamation-triangle me-1"></i> Ver solo Stock Bajo (Alerta)
                </label>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" id="buscador" class="form-control border-start-0"
                        placeholder="Buscar por nombre, código o categoría..." oninput="filtrarTabla()">
                </div>
            </div>
        </div>

        {{-- TABLA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="tablaStock">
                <thead>
                    <tr style="background:#f8fafc; font-size:12px; text-transform:uppercase; color:#64748b;">
                        <th>Tipo</th>
                        <th>Código</th>
                        <th>Categoría</th>
                        <th>Nombre Ítem</th>
                        <th>U. Medida</th>
                        <th class="text-end" style="color:#ef4444;">Stock Mín.</th>
                        <th class="text-end" style="color:#22c55e;">Stock Real</th>
                    </tr>
                </thead>
                <tbody id="tbodyStock">
                    @forelse($productos as $p)
                    <tr class="fila-stock"
                        data-tipo="{{ $p->preparacion }}"
                        data-nombre="{{ strtolower($p->nombre) }}"
                        data-codigo="{{ strtolower($p->codigo_barra ?? '') }}"
                        data-categoria="{{ strtolower($p->categoria->descripcion ?? '') }}"
                        data-bajo="{{ $p->stock < $p->stock_minimo ? '1' : '0' }}">
                        <td>
                            <span class="badge"
                                style="background:{{ $p->preparacion === 'cocina' ? '#3b82f6' : '#f59e0b' }};
                                       font-size:10px; padding:4px 8px; border-radius:6px;">
                                {{ strtoupper($p->preparacion) }}
                            </span>
                        </td>
                        <td style="font-size:13px; font-weight:500;">{{ $p->codigo_barra ?? '—' }}</td>
                        <td style="font-size:13px;">{{ $p->categoria->descripcion ?? '—' }}</td>
                        <td style="font-size:13px; font-weight:600;">{{ $p->nombre }}</td>
                        <td style="font-size:13px;">UND</td>
                        <td class="text-end" style="color:#ef4444; font-weight:600;">
                            {{ number_format($p->stock_minimo, 6) }}
                        </td>
                        <td class="text-end" style="color:#22c55e; font-weight:700; font-size:14px;">
                            {{ number_format($p->stock, 6) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa fa-exclamation-circle fa-2x mb-2 d-block"></i>
                            No se encontraron datos
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN INFO --}}
        <div class="text-muted" style="font-size:12px;" id="infoPaginacion">
            Mostrando <span id="contadorVisible">{{ $productos->count() }}</span> elemento(s)
        </div>

    </div>
</div>

@push('scripts')
<script>
function filtrar() {
    filtrarTabla();
}

function filtrarTabla() {
    const tipo    = document.getElementById('filtroTipo').value;
    const soloBajo = document.getElementById('soloBajo').checked;
    const buscar  = document.getElementById('buscador').value.toLowerCase();
    const filas   = document.querySelectorAll('.fila-stock');
    let visible   = 0;

    filas.forEach(f => {
        const matchTipo  = tipo === 'todos' || f.dataset.tipo === tipo;
        const matchBajo  = !soloBajo || f.dataset.bajo === '1';
        const matchBusc  = !buscar ||
            f.dataset.nombre.includes(buscar) ||
            f.dataset.codigo.includes(buscar) ||
            f.dataset.categoria.includes(buscar);

        if (matchTipo && matchBajo && matchBusc) {
            f.style.display = '';
            visible++;
        } else {
            f.style.display = 'none';
        }
    });

    document.getElementById('contadorVisible').textContent = visible;
}

function descargarPdf() {
    Swal.fire({
        icon: 'info',
        title: 'PDF',
        text: 'La función de exportar PDF estará disponible próximamente.',
        confirmButtonColor: 'var(--primary)'
    });
}
</script>
@endpush
@endsection
