<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        'salon_id' => 'required|exists:salons,id',
        'nombre' => 'required|string|max:50',
        'estado' => 'required|in:disponible,ocupado,reservado',
        ]);

        Mesa::create([
            'salon_id' => $request->salon_id,
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Mesa creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $mesa = Mesa::findOrFail($id);

        $mesa->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'salon_id' => $request->salon_id,
        ]);

        return redirect()->back()->with('success', 'Mesa actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $mesa = Mesa::findOrFail($id);
        $mesa->delete();
        return redirect()->back()->with('delete', 'Mesa eliminado correctamente');

    }
}
