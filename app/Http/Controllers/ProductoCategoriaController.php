<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductoCategoria;
use Illuminate\Http\Request;

class ProductoCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = ProductoCategoria::orderBy('orden')->get();
        return view('admin.Categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.Categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $ruta = 'categorias';

        if (!Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->makeDirectory($ruta);
        }

        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store($ruta, 'public');
        }

        ProductoCategoria::create([
            'descripcion' => $request->descripcion,
            'delivery'    => $request->delivery ?? 0,
            'orden'       => $request->orden ?? 0,
            'imagen'      => $imagenPath,
            'estado'      => 'a',
        ]);

        return back()->with('success', 'Categoría creada');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoCategoria $productoCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $categoria = ProductoCategoria::findOrFail($id);
        return view('admin.Categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $cat = ProductoCategoria::findOrFail($id);
        $ruta = 'categorias';

        if (!Storage::disk('public')->exists($ruta)) {
            Storage::disk('public')->makeDirectory($ruta);
        }

        $imagenPath = $cat->imagen;

        if ($request->hasFile('imagen')) {

            if ($cat->imagen) {
                Storage::disk('public')->delete($cat->imagen);
            }

            $imagenPath = $request->file('imagen')->store($ruta, 'public');
        }

        $cat->update([
            'descripcion' => $request->descripcion,
            'delivery'    => $request->delivery ?? 0,
            'orden'       => $request->orden ?? 0,
            'imagen'      => $imagenPath,
            'estado'      => $request->estado ?? 'a',
        ]);

        return back()->with('success', 'Categoría actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        ProductoCategoria::findOrFail($id)->delete();
        return back()->with('success', 'Categoría eliminada');
    }
}
