<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Aperturas_Caja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\Salon;
use App\Models\Mesa;
use App\Models\ProductoCategoria;
use App\Models\Producto;
use App\Models\TipoDocumento;
use App\Models\Cliente;
use App\Models\TipoPago;
use App\Models\PedidoMesa;
use App\Models\Usuario;
use App\Models\Empresa;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cajaAbierta = Aperturas_Caja::where('usuario_id', Auth::id())
            ->where('estado', 'a')
            ->first();

        if (!$cajaAbierta) {
            return redirect()->route('admin.AperturaCaja.index')
                ->with('error', 'Debe abrir caja antes de ingresar al punto de venta');
        }

        $salones = Salon::all();
        $salonId = $request->get('salon_id', $salones->first()->id ?? null);

        $mesas = Mesa::with(['salon', 'pedidoMesa'])->where('salon_id', $salonId)->get();
        $pedidos = PedidoMesa::all()->keyBy('id_mesa');
        $clientes = Cliente::where('estado', 'a')->get();

        $mesasDisponibles = Mesa::where('estado', 'disponible')->count();
        $mesasOcupadas    = Mesa::where('estado', 'ocupado')->count();
        $mesasReservadas  = Mesa::where('estado', 'reservado')->count();
        

        $mozos = Usuario::where('rol_id', 4)->get();

        return view('admin.Venta.index', compact(
            'cajaAbierta',
            'salones',
            'salonId',
            'mesas',
            'pedidos',
            'mesasDisponibles',
            'mesasOcupadas',
            'mesasReservadas',
            'mozos',
            'clientes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tipo_doc' => 'required|exists:tipo_documentos,id',
            'nro_doc'     => 'required|max:8',
        ]);

        try {
            $carrito = session()->get('carrito', []);

            if (empty($carrito)) {
                return back()->with('error', 'El carrito está vacío');
            }

            DB::beginTransaction();

            $subtotal = 0;

            foreach ($carrito as $item) {
                $subtotal += ($item['precio'] * $item['cantidad']);
            }

            $descuento = $request->descuento ?? 0;

            if ($descuento > $subtotal) {
                $descuento = $subtotal;
            }

            $totalFinal = $subtotal - $descuento;

            $documento = TipoDocumento::where('estado', 'activo')->first();

            $igv = round($subtotal * 0.18, 2);

            $cajaAbierta = Aperturas_Caja::where('usuario_id', Auth::id())
                ->where('estado', 'a')
                ->first();

            $venta = Venta::create([
                'id_cliente' => $request->id_cliente ?: null,
                'id_tipo_doc' => $request->id_tipo_doc,
                'id_usu' => Auth::id(),
                'id_apc' => $cajaAbierta?->id,
                'serie_doc' => $documento->serie,
                'nro_doc' => $request->nro_doc,
                'codigo_operacion' => '0101',
                'op_gravadas' => $subtotal,
                'op_exoneradas' => 0,
                'op_inafectas' => 0,
                'igv' => $igv,
                'total' => $totalFinal,
                'descuento' => $descuento,
                'fecha_emision' => now(),
                'enviado_sunat' => '0',
                'estado_sunat' => 'pendiente',
                'estado' => 'emitido',
            ]);

            foreach ($carrito as $item) {
                DB::table('venta_detalles')->insert([
                    'venta_id' => $venta->id,
                    'id_prod' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'total' => ($item['precio'] * $item['cantidad']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if ($cajaAbierta) {
                $cajaAbierta->monto_sistema = ($cajaAbierta->monto_sistema ?? 0) + $totalFinal;
                $cajaAbierta->save();
            }

            DB::commit();
            session()->forget('carrito');

            // ACCIÓN
            if ($request->_action == 'previsualizar') {
                return redirect()->route('admin.Venta.ticket', $venta->id);
            }

            return redirect()
                ->route('admin.Venta.index')
                ->with('success', 'Venta registrada correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Error al guardar: ' . $e->getMessage()
            );
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function orden(int $id)
    {
        $categorias = ProductoCategoria::with('productos')
            ->where('estado', 'a')
            ->orderBy('orden')
            ->get();

        $carrito = session()->get('carrito', []);

        $total = 0;

        foreach ($carrito as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }

        return view('admin.Venta.orden', compact(
            'id',
            'categorias',
            'carrito',
            'total'
        ));
    }

    public function agregar(int $id)
    {
        $producto = Producto::with('presentaciones')->find($id);

        if (!$producto) return redirect()->back();

        $presentacion = $producto->presentaciones->first();
        $precio = $presentacion ? (float) $presentacion->precio : 0;

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "id" => $id, 
                "nombre" => $producto->nombre,
                "precio" => $precio,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back();
    }

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        foreach ($carrito as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }
        return view('carrito', compact('carrito', 'total'));
    }
    
    public function carritoAccion(string $accion, $id = null)
    {
        $carrito = session()->get('carrito', []);
        if ($accion === 'sumar' && $id) {
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad']++;
            }
        }
        if ($accion === 'restar' && $id) {
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad']--;
                if ($carrito[$id]['cantidad'] <= 0) {
                    unset($carrito[$id]);
                }
            }
        }
        if ($accion === 'eliminar' && $id) {
            if (isset($carrito[$id])) {
                unset($carrito[$id]);
            }
        }

        if ($accion === 'vaciar') {
            $carrito = [];
        }
        session()->put('carrito', $carrito);

        return redirect()->back();
    }

    public function ordenPedido(int $id_mesa)
    {
        if (!Auth::check()) {
            return redirect()->back()
                ->with('error', 'Debes iniciar sesión');
        }

        $mesa = Mesa::with(['salon', 'pedidoMesa'])
            ->findOrFail($id_mesa);

        $pedido = $mesa->pedidoMesa;

        return view('admin.Venta.index', [
            'pedido' => $pedido,
            'mesa' => $mesa,
            'salon' => $mesa->salon,
            'mozos' => Usuario::where('rol_id', 4)->get(),
            'cajaAbierta' => null
        ]);
    }


    public function GuardarPedido(Request $request)
    {
        $request->validate([
            'id_mesa' => 'required|exists:mesas,id',
            'id_mozo' => 'required|exists:usuarios,id',
            'nombre_cliente' => 'nullable|string',
            'nro_personas' => 'nullable|integer',
        ]);
        PedidoMesa::updateOrCreate(
            ['id_mesa' => $request->id_mesa],
            [
                'id_mozo' => $request->id_mozo,
                'nombre_cliente' => $request->nombre_cliente ?? 'Cliente General',
                'nro_personas' => $request->nro_personas ?? 1,
            ]
        );
        Mesa::where('id', $request->id_mesa)->update([
            'estado' => 'ocupado'
        ]);

        return redirect()->route('admin.Venta.orden', $request->id_mesa)
            ->with('success', 'Pedido guardado correctamente');
    }


    public function cancelarPedido(int $id_mesa)
    {
        PedidoMesa::where('id_mesa', $id_mesa)->delete();
        Mesa::where('id', $id_mesa)->update([
            'estado' => 'disponible'
        ]);
        return redirect()->route('admin.Venta.index')
            ->with('success', 'Pedido cancelado y mesa liberada');
    }

    public function pago()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }

        $tipos_doc = TipoDocumento::all();
        $documento = TipoDocumento::where('estado', 'activo')->first();
        $clientes = Cliente::where('estado', 'a')->get();
        $tipos_pago = TipoPago::all();
        $pedidos = PedidoMesa::whereHas('mesa')->get();
       
        

        return view('admin.Venta.pago', compact(
            'carrito',
            'total',
            'tipos_doc',
            'clientes',
            'tipos_pago',
            'pedidos',
            'documento'
        ));
    }

    public function ticket(int $id)
    {
        $venta = Venta::with([
            'detalles.producto',
            'cliente',
            'usuario',
            'tipoDocumento'
        ])->findOrFail($id);

        // convertir total a letras
        $venta->total_letras = $this->numeroALetras($venta->total);

        // empresa global del sistema
        $empresa = Empresa::first();

        // plantilla
        $config = DB::table('modeloplanilla')->first();
        $plantilla = $config->plantilla ?? '80';

        if (!in_array($plantilla, ['80', '58', '50', 'A4'])) {
            $plantilla = '80';
        }

        return view("admin.Inpresora.ModeloTikes.ticket_$plantilla", compact('venta', 'empresa'));
    }

    private function numeroALetras(float|int $numero): string
    {
        $formatter = new \NumberFormatter("es", \NumberFormatter::SPELLOUT);

        $entero = floor($numero);
        $decimal = round(($numero - $entero) * 100);

        return strtoupper(
            $formatter->format($entero)
            . " CON " . str_pad($decimal, 2, "0", STR_PAD_LEFT)
            . "/100 SOLES"
        );
    }

}
