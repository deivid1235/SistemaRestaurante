@extends('layouts.dashboard')
@section('title', 'Ajuste de Stock')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:none;padding:0;font-size:13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color:var(--primary)">Inicio</a></li>
            <li class="breadcrumb-item active">Ajuste de Stock</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0" style="color:var(--text)">Ajuste de Stock</h4>
</div>

<div class="card shadow-sm border-0" style="border-radius:14px;">
    <div class="card-body p-4">

        {{-- ENCABEZADO --}}
        <div class="d-flex align-items-start justify-content-between mb-3">
            <div>
                <h5 class="fw-bold mb-0">
                    <i class="fa fa-clipboard-check me-2" style="color:var(--primary)"></i>
                    Movimientos de Stock
                </h5>
                <small class="text-muted">Entradas, Salidas y Mermas manuales.</small>
            </div>
            <a href="{{ route('admin.Inventario.ajuste.create') }}"
               class="btn btn-success btn-sm px-3" style="border-radius:8px;">
                <i class="fa fa-plus me-1"></i> Nuevo Ajuste
            </a>
        </div>

        {{-- FILTROS --}}
        <form method="GET" action="{{ route('admin.Inventario.ajuste') }}" class="row g-2 mb-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size:12px;">
                    <i class="fa fa-calendar me-1"></i> Rango de Fechas
                </label>
                <div class="d-flex gap-1 align-items-center">
                    <input type="date" name="fecha_inicio" class="form-control form-control-sm"
                        value="{{ $fechaInicio->format('Y-m-d') }}">
                    <span class="text-muted">→</span>
                    <input type="date" name="fecha_fin" class="form-control form-control-sm"
                        value="{{ $fechaFin->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size:12px;">&nbsp;</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" name="buscar" class="form-control border-start-0"
                        placeholder="Buscar por responsable o concepto..."
                        value="{{ request('buscar') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm text-white px-3" style="background:var(--primary); border-radius:8px;">
                    <i class="fa fa-search me-1"></i> Filtrar
                </button>
            </div>
        </form>

        {{-- TABLA --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size:13px;">
                <thead>
                    <tr style="background:#f8fafc; font-size:12px; text-transform:uppercase; color:#64748b;">
                        <th>Fecha</th>
                        <th>Tipo Operación</th>
                        <th>Responsable</th>
                        <th>Concepto</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movimientos->groupBy(fn($m) => $m->created_at->format('Y-m-d').'_'.$m->responsable.'_'.$m->concepto) as $grupo)
                    @php $primero = $grupo->first(); @endphp
                    <tr>
                        <td>{{ $primero->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @php
                                $colores = ['entrada'=>'success','salida'=>'danger','merma'=>'warning'];
                                $color = $colores[$primero->tipo_operacion] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ strtoupper($primero->tipo_operacion) }}</span>
                        </td>
                        <td>{{ $primero->responsable ?? '—' }}</td>
                        <td>{{ $primero->concepto ?? '—' }}</td>
                        <td>
                            @if($primero->estado === 'anulado')
                                <span class="badge bg-secondary">ANULADO</span>
                            @else
                                <span class="badge bg-success">APROBADO</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($primero->estado !== 'anulado')
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="anularMovimiento({{ $primero->id }})"
                                title="Anular">
                                <i class="fa fa-ban"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
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

@push('scripts')
<script>
function anularMovimiento(id) {
    Swal.fire({
        title: '¿Anular movimiento?',
        text: 'Se revertirá el stock afectado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, anular',
        cancelButtonText: 'Cancelar'
    }).then(r => {
        if (r.isConfirmed) {
            fetch(`/admin/Inventario/ajuste/${id}/anular`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Anulado', data.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            });
        }
    });
}
</script>
@endpush
@endsection
