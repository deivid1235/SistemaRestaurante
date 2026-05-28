<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\InsumoCatg;
use App\Models\Tipomedida;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::with(['categoria', 'tipomedida'])->get();
        return view('admin.Insumo.index', compact('insumos'));
    }

    public function create()
    {
        $categorias = InsumoCatg::where('estado', 'a')->get();
        $tipomedidas = Tipomedida::all();

        return view('admin.Insumo.create', compact('categorias', 'tipomedidas'));
    }

    public function store(Request $request)
    {
        if ($request->filled('descripcion')) {

            InsumoCatg::create([
                'descripcion' => $request->descripcion,
                'estado' => 'a'
            ]);

            return back()->with('success', 'Categoría creada correctamente');
        }

        $request->validate([
            'insumo_catg_id' => 'required',
            'tipomedida_id' => 'required',
            'nombre' => 'required',
        ]);

        Insumo::create([
            'insumo_catg_id' => $request->insumo_catg_id,
            'tipomedida_id' => $request->tipomedida_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'costo' => $request->costo,
            'estado' => 'a'
        ]);

        return redirect()
            ->route('admin.Insumo.index')
            ->with('success', 'Insumo agregado correctamente');
    }

    public function edit(Insumo $insumo)
    {
        $categorias = InsumoCatg::where('estado', 'a')->get();
        $tipomedidas = Tipomedida::all();

        return view('admin.Insumo.edit', compact('insumo', 'categorias', 'tipomedidas'));
    }

    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'insumo_catg_id' => 'required',
            'tipomedida_id' => 'required',
            'nombre' => 'required',
        ]);

        $insumo->update([
            'insumo_catg_id' => $request->insumo_catg_id,
            'tipomedida_id' => $request->tipomedida_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'costo' => $request->costo,
            'estado' => $request->estado ?? $insumo->estado
        ]);

        return redirect()
            ->route('admin.Insumo.index')
            ->with('success', 'Insumo actualizado correctamente');
    }

    public function destroy(Insumo $insumo)
    {
        $insumo->delete();

        return redirect()
            ->route('admin.Insumo.index')
            ->with('success', 'Insumo eliminado correctamente');
    }
    
    public function categorias()
    {
        $categorias = InsumoCatg::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function destroyCategoria(InsumoCatg $categoria)
    {
        $categoria->delete();
        return back()->with('success', 'Categoría eliminada');
    }
}