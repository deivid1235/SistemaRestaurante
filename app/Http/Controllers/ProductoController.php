<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\AreaProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::with(['categoria', 'areaProduccion'])->orderBy('id', 'desc')->get();
        return view('admin.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = ProductoCategoria::where('estado', 'a')->get();
        $areas = AreaProduccion::where('estado', 'activo')->get();
        return view('admin.producto.create', compact('categorias', 'areas'));
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if (!Storage::disk('public')->exists('productos')) {
            Storage::disk('public')->makeDirectory('productos');
        }

        $rutaImagen = $request->hasFile('imagen')
            ? $request->file('imagen')->store('productos', 'public')
            : null;

        Producto::create([
            'id_catg' => $request->id_catg,
            'id_areap' => $request->id_areap,
            'nombre' => $request->nombre,
            'notas' => $request->notas,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'estado' => $request->estado ?? 'a',
            'orden' => $request->orden ?? 0,
        ]);

        return redirect()->route('admin.producto.index')->with('success', 'Producto registrado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $categorias = ProductoCategoria::all();
        $areas = AreaProduccion::all();

        // Retornar vista con datos
        return view('admin.producto.show', compact('producto', 'categorias', 'areas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $categorias = ProductoCategoria::where('estado', 'a')->get();
        $areas = AreaProduccion::where('estado', 'activo')->get();
        return view('admin.producto.edit', compact('producto', 'categorias', 'areas'));
       
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if (!Storage::disk('public')->exists('productos')) {
            Storage::disk('public')->makeDirectory('productos');
        }

        $rutaImagen = $producto->imagen;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update([
            'id_catg' => $request->id_catg,
            'id_areap' => $request->id_areap,
            'nombre' => $request->nombre,
            'notas' => $request->notas,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'estado' => $request->estado ?? 'a',
            'orden' => $request->orden ?? 0,
        ]);

        return redirect()->route('admin.producto.index')
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

}
