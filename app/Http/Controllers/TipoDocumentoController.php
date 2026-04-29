<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoDocumento::query();

        if ($request->filled('buscar')) {
            $query->where('descripcion', 'like', '%' . $request->buscar . '%');
        }

        $tipos = $query->get();

        return view('admin.TipoDocumento.index', compact('tipos'));
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
        //
        $request->validate([
            'descripcion' => 'required',
            'serie' => 'required',
            'numero' => 'required'
        ]);

        TipoDocumento::create([
            'descripcion' => $request->descripcion,
            'serie' => $request->serie,
            'numero' => $request->numero,
            'estado' => 'activo'
        ]);

        return back()->with('success', 'Documento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $documento = TipoDocumento::findOrFail($id);
        $tipos = TipoDocumento::all();

        return view('admin.TipoDocumento.index', compact('documento', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $doc = TipoDocumento::findOrFail($id);

        $doc->update([
            'descripcion' => $request->descripcion,
            'serie' => $request->serie,
            'numero' => $request->numero,
            'estado' => $request->estado
        ]);

        return back()->with('success', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( int $id)
    {
        //
        TipoDocumento::destroy($id);
        return back()->with('success', 'Eliminado correctamente');
    }
}
