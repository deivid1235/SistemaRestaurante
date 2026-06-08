<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\MovimientoStock;
use Carbon\Carbon;

class InventarioController extends Controller
{
    // ─── STOCK ────────────────────────────────────────────────────────────────
    public function stock(Request $request)
    {
        $query = Producto::with('categoria')
            ->where('estado', 'a');

        if ($request->filled('tipo') && $request->tipo !== 'todos') {
            $query->where('preparacion', $request->tipo);
        }

        if ($request->filled('buscar')) {
            $b = $request->buscar;
            $query->where(function ($q) use ($b) {
                $q->where('nombre', 'like', "%$b%")
                  ->orWhere('codigo_barra', 'like', "%$b%");
            });
        }

        if ($request->filled('solo_bajo') && $request->solo_bajo == '1') {
            $query->whereColumn('stock', '<', 'stock_minimo');
        }

        $productos = $query->orderBy('nombre')->get();

        $categorias = ProductoCategoria::where('estado', 'a')->orderBy('descripcion')->get();

        return view('admin.Inventario.stock.index', compact('productos', 'categorias'));
    }

    // ─── KARDEX ───────────────────────────────────────────────────────────────
    public function kardex(Request $request)
    {
        $fechaInicio = $request->fecha_inicio
            ? Carbon::parse($request->fecha_inicio)->startOfDay()
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->fecha_fin
            ? Carbon::parse($request->fecha_fin)->endOfDay()
            : Carbon::now()->endOfDay();

        $tipo      = $request->tipo ?? 'cocina';
        $productos = Producto::where('estado', 'a')
                        ->where('preparacion', $tipo)
                        ->orderBy('nombre')->get();

        $movimientos  = collect();
        $stockInicial = 0;
        $entradas     = 0;
        $salidas      = 0;
        $productoSel  = null;

        if ($request->filled('producto_id')) {
            $productoSel = Producto::find($request->producto_id);

            // Stock inicial = stock actual - (entradas - salidas) del período
            $entradasPeriodo = MovimientoStock::where('producto_id', $request->producto_id)
                ->whereIn('tipo_operacion', ['entrada'])
                ->whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->sum('cantidad');

            $salidasPeriodo = MovimientoStock::where('producto_id', $request->producto_id)
                ->whereIn('tipo_operacion', ['salida', 'merma'])
                ->whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->sum('cantidad');

            $stockInicial = ($productoSel->stock ?? 0) - $entradasPeriodo + $salidasPeriodo;

            $movimientos = MovimientoStock::where('producto_id', $request->producto_id)
                ->whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->where('estado', '!=', 'anulado')
                ->orderBy('created_at')
                ->get();

            $entradas = $movimientos->whereIn('tipo_operacion', ['entrada'])->sum('cantidad');
            $salidas  = $movimientos->whereIn('tipo_operacion', ['salida', 'merma'])->sum('cantidad');
        }

        $stockFinal = $stockInicial + $entradas - $salidas;

        return view('admin.Inventario.kardex.index', compact(
            'movimientos', 'productos', 'stockInicial',
            'entradas', 'salidas', 'stockFinal',
            'fechaInicio', 'fechaFin', 'tipo', 'productoSel'
        ));
    }

    // ─── AJUSTE: LISTADO ──────────────────────────────────────────────────────
    public function ajuste(Request $request)
    {
        $fechaInicio = $request->fecha_inicio
            ? Carbon::parse($request->fecha_inicio)->startOfDay()
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->fecha_fin
            ? Carbon::parse($request->fecha_fin)->endOfDay()
            : Carbon::now()->endOfDay();

        $query = MovimientoStock::with(['producto', 'usuario'])
            ->whereBetween('created_at', [$fechaInicio, $fechaFin]);

        if ($request->filled('buscar')) {
            $b = $request->buscar;
            $query->where(function ($q) use ($b) {
                $q->where('responsable', 'like', "%$b%")
                  ->orWhere('concepto', 'like', "%$b%");
            });
        }

        $movimientos = $query->orderByDesc('created_at')->get();

        return view('admin.Inventario.ajuste.index', compact(
            'movimientos', 'fechaInicio', 'fechaFin'
        ));
    }

    // ─── AJUSTE: FORMULARIO NUEVO ─────────────────────────────────────────────
    public function ajusteCreate()
    {
        $productos = Producto::where('estado', 'a')->orderBy('nombre')->get();
        return view('admin.Inventario.ajuste.create', compact('productos'));
    }

    // ─── AJUSTE: GUARDAR ──────────────────────────────────────────────────────
    public function ajusteStore(Request $request)
    {
        $request->validate([
            'tipo_operacion' => 'required|in:entrada,salida,merma',
            'responsable'    => 'required|string|max:100',
            'concepto'       => 'nullable|string|max:255',
            'detalles'       => 'required|array|min:1',
            'detalles.*.producto_id'     => 'required|exists:productos,id',
            'detalles.*.cantidad'        => 'required|numeric|min:0.0001',
            'detalles.*.precio_unitario' => 'nullable|numeric|min:0',
        ]);

        foreach ($request->detalles as $det) {
            $pu    = $det['precio_unitario'] ?? 0;
            $total = $det['cantidad'] * $pu;

            MovimientoStock::create([
                'producto_id'     => $det['producto_id'],
                'tipo_operacion'  => $request->tipo_operacion,
                'cantidad'        => $det['cantidad'],
                'precio_unitario' => $pu,
                'total'           => $total,
                'concepto'        => $request->concepto,
                'responsable'     => $request->responsable,
                'estado'          => 'aprobado',
                'usuario_id'      => auth()->id(),
            ]);

            // Actualizar stock del producto
            $producto = Producto::find($det['producto_id']);
            if ($producto) {
                if ($request->tipo_operacion === 'entrada') {
                    $producto->increment('stock', $det['cantidad']);
                } else {
                    $producto->decrement('stock', $det['cantidad']);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Ajuste registrado correctamente.']);
    }

    // ─── AJUSTE: ANULAR ───────────────────────────────────────────────────────
    public function ajusteAnular($id)
    {
        $mov = MovimientoStock::findOrFail($id);

        if ($mov->estado === 'anulado') {
            return response()->json(['success' => false, 'message' => 'Ya está anulado.']);
        }

        $mov->update(['estado' => 'anulado']);

        // Revertir stock
        $producto = Producto::find($mov->producto_id);
        if ($producto) {
            if ($mov->tipo_operacion === 'entrada') {
                $producto->decrement('stock', $mov->cantidad);
            } else {
                $producto->increment('stock', $mov->cantidad);
            }
        }

        return response()->json(['success' => true, 'message' => 'Movimiento anulado.']);
    }
}
