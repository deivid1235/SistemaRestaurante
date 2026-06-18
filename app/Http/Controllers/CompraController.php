<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use App\Models\Producto;
use Carbon\Carbon;

class CompraController extends Controller
{
    // ─── HISTORIAL DE COMPRAS ───────────────────────────────────────────────────
    public function index(Request $request)
    {
        $fechaInicio = $request->fecha_inicio
            ? Carbon::parse($request->fecha_inicio)->startOfDay()
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->fecha_fin
            ? Carbon::parse($request->fecha_fin)->endOfDay()
            : Carbon::now()->endOfDay();

        $query = Compra::with('proveedor')
            ->whereBetween('fecha_documento', [$fechaInicio, $fechaFin]);

        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        if ($request->filled('tipo_pago') && $request->tipo_pago !== 'Todos') {
            $query->where('tipo_pago', $request->tipo_pago);
        }

        if ($request->filled('tipo_comprobante') && $request->tipo_comprobante !== 'Todos') {
            $query->where('tipo_comprobante', $request->tipo_comprobante);
        }

        if ($request->filled('estado') && $request->estado !== 'Todos') {
            $query->where('estado', $request->estado);
        }

        $compras = $query->orderByDesc('created_at')->get();

        $totalOperaciones = $compras->count();
        $montoTotal       = $compras->where('estado', '!=', 'anulado')->sum('total');

        $proveedores = Proveedor::where('estado', 'a')->orderBy('razon_social')->get();

        return view('admin.compras.index', compact(
            'compras', 'totalOperaciones', 'montoTotal',
            'proveedores', 'fechaInicio', 'fechaFin'
        ));
    }

    // ─── NUEVA COMPRA (formulario) ───────────────────────────────────────────────
    public function create()
    {
        $proveedores  = Proveedor::where('estado', 'a')->orderBy('razon_social')->get();
        $productos    = Producto::where('estado', 1)->orderBy('nombre')->get();
        $comprobantes = ['Factura', 'Boleta', 'Ticket', 'Nota de Pedido', 'Otros'];
        $tiposPago    = ['Contado', 'Crédito'];

        return view('admin.compras.create', compact('proveedores', 'productos', 'comprobantes', 'tiposPago'));
    }

    // ─── GUARDAR COMPRA ──────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id'      => 'required|exists:proveedor,id',
            'tipo_comprobante'  => 'required|string',
            'fecha_documento'   => 'required|date',
            'tipo_pago'         => 'required|string',
            'detalles'          => 'required|array|min:1',
            'detalles.*.producto_id'     => 'nullable|exists:productos,id',
            'detalles.*.descripcion'     => 'nullable|string',
            'detalles.*.unidad_medida'   => 'required|string',
            'detalles.*.cantidad'        => 'required|numeric|min:0.001',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        // Calcular totales
        $subtotal = 0;
        foreach ($request->detalles as $det) {
            $subtotal += $det['cantidad'] * $det['precio_unitario'];
        }
        $descuento = $request->descuento ?? 0;
        $total     = $subtotal - $descuento;

        $compra = Compra::create([
            'proveedor_id'     => $request->proveedor_id,
            'tipo_comprobante' => $request->tipo_comprobante,
            'serie'            => $request->serie,
            'numero'           => $request->numero,
            'fecha_documento'  => $request->fecha_documento,
            'hora_documento'   => $request->hora_documento ?? now()->format('H:i:s'),
            'tipo_pago'        => $request->tipo_pago,
            'subtotal'         => $subtotal,
            'descuento'        => $descuento,
            'total'            => $total,
            'estado'           => 'aceptado',
            'usuario_id'       => auth()->id(),
        ]);

        foreach ($request->detalles as $det) {
            DetalleCompra::create([
                'compra_id'       => $compra->id,
                'producto_id'     => $det['producto_id'] ?? null,
                'descripcion'     => $det['descripcion'] ?? null,
                'unidad_medida'   => $det['unidad_medida'],
                'cantidad'        => $det['cantidad'],
                'precio_unitario' => $det['precio_unitario'],
                'importe'         => $det['cantidad'] * $det['precio_unitario'],
            ]);

            // Actualizar stock del producto si existe
            if (!empty($det['producto_id'])) {
                $producto = Producto::find($det['producto_id']);
                if ($producto) {
                    $producto->increment('stock', $det['cantidad']);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Compra registrada correctamente.', 'id' => $compra->id]);
    }

    // ─── VER DETALLE ─────────────────────────────────────────────────────────────
    public function show($id)
    {
        $compra = Compra::with(['proveedor', 'detalles.producto', 'usuario'])->findOrFail($id);
        return response()->json($compra);
    }

    // ─── ANULAR COMPRA ───────────────────────────────────────────────────────────
    public function anular($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->update(['estado' => 'anulado']);

        // Revertir stock
        foreach ($compra->detalles as $det) {
            if ($det->producto_id) {
                $producto = Producto::find($det->producto_id);
                if ($producto) {
                    $producto->decrement('stock', $det->cantidad);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Compra anulada.']);
    }

    // ─── PROVEEDORES (listado) ───────────────────────────────────────────────────
    public function proveedores()
    {
        $proveedores = Proveedor::orderBy('razon_social')->get();
        $total       = $proveedores->count();
        return view('admin.compras.proveedores', compact('proveedores', 'total'));
    }

    // ─── GUARDAR PROVEEDOR (desde modal) ────────────────────────────────────────
    public function storeProveedor(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|in:DNI,RUC',
            'numero'         => 'required|string|unique:proveedor,numero',
            'razon_social'   => 'required|string|max:150',
            'direccion'      => 'nullable|string|max:255',
            'telefono'       => 'nullable|string|max:20',
            'email'          => 'nullable|email|unique:proveedor,email',
            'contacto'       => 'nullable|string|max:100',
        ]);

        $proveedor = Proveedor::create([
            'tipo_documento' => $request->tipo_documento,
            'numero'         => $request->numero,
            'razon_social'   => $request->razon_social,
            'direccion'      => $request->direccion,
            'telefono'       => $request->telefono,
            'email'          => $request->email,
            'contacto'       => $request->contacto,
            'estado'         => 'a',
        ]);

        return response()->json(['success' => true, 'proveedor' => $proveedor]);
    }

    // ─── ACTUALIZAR PROVEEDOR ────────────────────────────────────────────────────
    public function updateProveedor(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $request->validate([
            'tipo_documento' => 'required|in:DNI,RUC',
            'numero'         => 'required|string|unique:proveedor,numero,' . $id,
            'razon_social'   => 'required|string|max:150',
            'direccion'      => 'nullable|string|max:255',
            'telefono'       => 'nullable|string|max:20',
            'email'          => 'nullable|email|unique:proveedor,email,' . $id,
            'contacto'       => 'nullable|string|max:100',
        ]);

        $proveedor->update($request->only([
            'tipo_documento','numero','razon_social','direccion','telefono','email','contacto'
        ]));

        return response()->json(['success' => true, 'proveedor' => $proveedor]);
    }

    // ─── TOGGLE ESTADO PROVEEDOR ─────────────────────────────────────────────────
    public function toggleProveedor($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->estado = $proveedor->estado === 'a' ? 'i' : 'a';
        $proveedor->save();
        return response()->json(['success' => true, 'estado' => $proveedor->estado]);
    }
}
