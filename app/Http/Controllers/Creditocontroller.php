<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credito;
use App\Models\PagoCredito;
use App\Models\Compra;
use App\Models\Proveedor;
use Carbon\Carbon;

class CreditoController extends Controller
{
    // ─── LISTADO DE CRÉDITOS ──────────────────────────────────────────────────
    public function index(Request $request)
    {
        $fechaInicio = $request->fecha_inicio
            ? Carbon::parse($request->fecha_inicio)->startOfDay()
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->fecha_fin
            ? Carbon::parse($request->fecha_fin)->endOfDay()
            : Carbon::now()->endOfDay();

        $query = Credito::with(['compra.proveedor'])
            ->whereBetween('fecha_vencimiento', [$fechaInicio, $fechaFin]);

        if ($request->filled('proveedor_id')) {
            $query->whereHas('compra', function ($q) use ($request) {
                $q->where('proveedor_id', $request->proveedor_id);
            });
        }

        if ($request->filled('estado') && $request->estado !== 'Todos') {
            $query->where('estado', $request->estado);
        }

        $creditos = $query->orderByDesc('created_at')->get();

        $totalDeuda    = $creditos->sum('monto_total');
        $totalInteres  = $creditos->sum('interes');
        $totalAmortizado = $creditos->sum('amortizado');
        $totalPendiente  = $creditos->sum('pendiente');

        $proveedores = Proveedor::where('estado', 'a')->orderBy('razon_social')->get();

        return view('admin.creditos.index', compact(
            'creditos',
            'totalDeuda',
            'totalInteres',
            'totalAmortizado',
            'totalPendiente',
            'proveedores',
            'fechaInicio',
            'fechaFin'
        ));
    }

    // ─── VER DETALLE DE CRÉDITO ───────────────────────────────────────────────
    public function show($id)
    {
        $credito = Credito::with(['compra.proveedor', 'compra.detalles.producto', 'pagos.usuario'])->findOrFail($id);
        return response()->json($credito);
    }

    // ─── REGISTRAR PAGO ───────────────────────────────────────────────────────
    public function registrarPago(Request $request, $id)
    {
        $credito = Credito::findOrFail($id);

        $request->validate([
            'monto'      => 'required|numeric|min:0.01|max:' . $credito->pendiente,
            'interes'    => 'nullable|numeric|min:0',
            'fecha_pago' => 'required|date',
            'observacion'=> 'nullable|string|max:255',
        ]);

        $monto   = $request->monto;
        $interes = $request->interes ?? 0;

        PagoCredito::create([
            'credito_id'  => $credito->id,
            'monto'       => $monto,
            'interes'     => $interes,
            'fecha_pago'  => $request->fecha_pago,
            'observacion' => $request->observacion,
            'usuario_id'  => auth()->id(),
        ]);

        // Actualizar crédito
        $credito->amortizado += $monto;
        $credito->interes    += $interes;
        $credito->pendiente   = $credito->monto_total - $credito->amortizado;

        if ($credito->pendiente <= 0) {
            $credito->pendiente = 0;
            $credito->estado    = 'pagado';
        }

        $credito->save();

        return response()->json([
            'success'   => true,
            'message'   => 'Pago registrado correctamente.',
            'pendiente' => $credito->pendiente,
            'estado'    => $credito->estado,
        ]);
    }

    // ─── CREAR CRÉDITO DESDE COMPRA (llamado al guardar compra con tipo Crédito) ─
    public static function crearDesdeCompra(Compra $compra, $fechaVencimiento = null)
    {
        Credito::create([
            'compra_id'         => $compra->id,
            'monto_total'       => $compra->total,
            'interes'           => 0,
            'amortizado'        => 0,
            'pendiente'         => $compra->total,
            'fecha_vencimiento' => $fechaVencimiento ?? Carbon::now()->addDays(30),
            'estado'            => 'pendiente',
            'usuario_id'        => auth()->id(),
        ]);
    }
}
