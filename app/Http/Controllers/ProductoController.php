<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\AreaProduccion;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::with(['categoria', 'areaProduccion'])->orderBy('id', 'desc')->get();
        return view('admin.Producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = ProductoCategoria::where('estado', 'a')->get();
        $areas = AreaProduccion::where('estado', 'activo')->get();
        return view('admin.Producto.create', compact('categorias', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_catg' => 'required|exists:producto_categorias,id',
            'id_areap' => 'required|exists:areas_produccion,id',
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'nullable|integer',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Crear carpetas si no existen
        if (!Storage::disk('public')->exists('productos')) {
            Storage::disk('public')->makeDirectory('productos');
        }

        if (!Storage::disk('public')->exists('qr')) {
            Storage::disk('public')->makeDirectory('qr');
        }

        if (!Storage::disk('public')->exists('barra')) {
            Storage::disk('public')->makeDirectory('barra');
        }

      
        $rutaImagen = $request->hasFile('imagen')
            ? $request->file('imagen')->store('productos', 'public')
            : null;

        $nombreQR = 'qr_' . time() . '.svg';
        $rutaQR = 'qr/' . $nombreQR;

        $contenidoQR = $request->nombre . ' - S/ ' . $request->precio;

        $qr = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($contenidoQR);

        Storage::disk('public')->put($rutaQR, $qr);
        $codigo = $request->codigo_barra ?? time();

        $nombreBarra = 'barra_' . time() . '.png';
        $rutaBarra = 'barra/' . $nombreBarra;
        
        $barra = DNS1D::getBarcodePNG($codigo, 'C128');
        Storage::disk('public')->put($rutaBarra, base64_decode($barra));

     
        Producto::create([
            'id_catg' => $request->id_catg,
            'id_areap' => $request->id_areap,
            'nombre' => $request->nombre,
            'notas' => $request->notas,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'codigo_qr' => $rutaQR,
            'codigo_barra' => $rutaBarra, 
            'precio' => $request->precio,
            'costo' => $request->costo,
            'stock' => $request->stock ?? 0,
            'stock_minimo' => $request->stock_minimo ?? 0,
            'preparacion' => $request->preparacion,
            'tiempo_preparacion' => $request->tiempo_preparacion ?? 0,
            'delivery' => $request->has('delivery'),
            'destacado' => $request->has('destacado'),
            'estado' => $request->estado ?? 'a',
            'orden' => $request->orden ?? 0,
        ]);

        return redirect()->route('admin.Producto.index')
            ->with('success', 'Producto registrado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $categorias = ProductoCategoria::all();
        $areas = AreaProduccion::all();

        // Retornar vista con datos
        return view('admin.Producto.show', compact('producto', 'categorias', 'areas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $categorias = ProductoCategoria::all();
        $areas = AreaProduccion::all();

        // Retornar vista con datos
        return view('admin.Producto.edit', compact('producto', 'categorias', 'areas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'id_catg' => 'required|exists:producto_categorias,id',
            'id_areap' => 'required|exists:areas_produccion,id',
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'nullable|integer',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Crear carpetas si no existen
        if (!Storage::disk('public')->exists('productos')) {
            Storage::disk('public')->makeDirectory('productos');
        }

        if (!Storage::disk('public')->exists('qr')) {
            Storage::disk('public')->makeDirectory('qr');
        }

        if (!Storage::disk('public')->exists('barra')) {
            Storage::disk('public')->makeDirectory('barra');
        }

        $rutaImagen = $producto->imagen;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        if ($producto->codigo_qr && Storage::disk('public')->exists($producto->codigo_qr)) {
            Storage::disk('public')->delete($producto->codigo_qr);
        }

        $nombreQR = 'qr_' . time() . '.svg';
        $rutaQR = 'qr/' . $nombreQR;

        $contenidoQR = $request->nombre . ' - S/ ' . $request->precio;

        $qr = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($contenidoQR);

        Storage::disk('public')->put($rutaQR, $qr);

        if ($producto->codigo_barra && Storage::disk('public')->exists($producto->codigo_barra)) {
            Storage::disk('public')->delete($producto->codigo_barra);
        }

        $codigo = $request->codigo_barra ?? time();

        $nombreBarra = 'barra_' . time() . '.png';
        $rutaBarra = 'barra/' . $nombreBarra;

        $barra = DNS1D::getBarcodePNG($codigo, 'C128');

        Storage::disk('public')->put($rutaBarra, base64_decode($barra));

        $producto->update([
            'id_catg' => $request->id_catg,
            'id_areap' => $request->id_areap,
            'nombre' => $request->nombre,
            'notas' => $request->notas,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'codigo_qr' => $rutaQR,
            'codigo_barra' => $rutaBarra,
            'precio' => $request->precio,
            'costo' => $request->costo,
            'stock' => $request->stock ?? 0,
            'stock_minimo' => $request->stock_minimo ?? 0,
            'preparacion' => $request->preparacion,
            'tiempo_preparacion' => $request->tiempo_preparacion ?? 0,
            'delivery' => $request->has('delivery'),
            'destacado' => $request->has('destacado'),
            'estado' => $request->estado ?? 'a',
            'orden' => $request->orden ?? 0,
        ]);

        return redirect()->route('admin.Producto.index')
            ->with('success', 'Producto actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->back()->with('success', 'Producto eliminado');
    }

    
    public function ticket( int $id)
    {
        $producto = Producto::findOrFail($id);

        $pdf = Pdf::loadView('admin.Producto.ticket', compact('producto'));

        return $pdf->download('ticket.pdf');
    }
    
    public function print( int $id)
    {
        $producto = Producto::with(['categoria', 'areaProduccion'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.producto.print', compact('producto'));

        return $pdf->download('producto_'.$producto->id.'.pdf'); 
    }

}
