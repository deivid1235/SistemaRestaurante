<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\ProductoPres;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class ProductoPresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        //
        $producto = Producto::findOrFail($id);
        $presentaciones = DB::table('producto_pres')->where('producto_id', $id)->get();

        return view('admin.producto_temp.create', compact('producto', 'presentaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'presentacion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $producto = DB::table('productos')
            ->where('id', $request->producto_id)
            ->first();

        $codigo = $request->codigo ?? 'PRD-' . strtoupper(uniqid());
        $textoQR = $producto->nombre . ' - S/ ' . number_format($request->precio, 2);
        $codigo_barra = $codigo;

        if (!Storage::disk('public')->exists('qr')) {
            Storage::disk('public')->makeDirectory('qr');
        }

        if (!Storage::disk('public')->exists('barra')) {
            Storage::disk('public')->makeDirectory('barra');
        }

        $nombreQR = 'qr_' . time() . '.svg';
        $rutaQR = 'qr/' . $nombreQR;

        $qr = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($textoQR);

        Storage::disk('public')->put($rutaQR, $qr);

        $nombreBarra = 'barra_' . time() . '.png';
        $rutaBarra = 'barra/' . $nombreBarra;

        $barcode = DNS1D::getBarcodePNG($codigo_barra, 'C128');

        Storage::disk('public')->put($rutaBarra, base64_decode($barcode));


        DB::table('producto_pres')->insert([
            'producto_id' => $request->producto_id,
            'codigo' => $codigo, 
            'codigo_qr' => $rutaQR,
            'codigo_barra' => $rutaBarra,
            'presentacion' => $request->presentacion,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'precio_delivery' => $request->precio_delivery,
            'costo' => $request->costo,
            'stock' => $request->stock,
            'stock_min' => $request->stock_min,
            'igv' => 0.10,
            'receta' => $request->receta,
            'delivery' => $request->delivery ?? 1,
            'estado' => $request->estado ?? 1,
            'orden' => $request->orden ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Presentación creada correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(ProductoPres $productoPres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'presentacion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $pres = DB::table('producto_pres')->where('id', $id)->first();

        $producto = DB::table('productos')
            ->where('id', $pres->producto_id)
            ->first();

        $codigo = $request->codigo ?? $pres->codigo;
        $textoQR = $producto->nombre . ' - S/ ' . number_format($request->precio, 2);

        $rutaQR = $pres->codigo_qr;
        $rutaBarra = $pres->codigo_barra;
        if ($request->precio != $pres->precio) {

            $nombreQR = 'qr_' . time() . '.svg';
            $rutaQR = 'qr/' . $nombreQR;

            $qr = QrCode::format('svg')
                ->size(300)
                ->errorCorrection('H')
                ->generate($textoQR);

            Storage::disk('public')->put($rutaQR, $qr);
        }

        if ($codigo != $pres->codigo) {

            $nombreBarra = 'barra_' . time() . '.png';
            $rutaBarra = 'barra/' . $nombreBarra;

            $barcode = DNS1D::getBarcodePNG($codigo, 'C128');

            Storage::disk('public')->put($rutaBarra, base64_decode($barcode));
        }
 
        DB::table('producto_pres')
            ->where('id', $id)
            ->update([
                'codigo' => $codigo,
                'codigo_qr' => $rutaQR,
                'codigo_barra' => $rutaBarra,
                'presentacion' => $request->presentacion,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'precio_delivery' => $request->precio_delivery,
                'costo' => $request->costo,
                'stock' => $request->stock,
                'stock_min' => $request->stock_min,
                'igv' => $request->igv ?? 0.10,
                'receta' => $request->receta,
                'delivery' => $request->delivery ?? 1,
                'estado' => $request->estado ?? 1,
                'orden' => $request->orden ?? 0,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Presentación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoPres $productoPres)
    {
        //
    }

    public function form(int $producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $productoPres = DB::table('producto_pres')
            ->where('producto_id', $producto_id)
            ->first();
        return view('admin.producto_temp.create', compact('producto', 'productoPres'));
    }
}
