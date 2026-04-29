<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $salones = Salon::all();
        return view('admin.Salon.index', compact('salones'));
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
            'nombre' => 'required|max:100',
            'estado' => 'required|in:activo,inactivo'
        ]);

        Salon::create([
            'nombre' => strtoupper($request->nombre),
            'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', 'Salón creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $salon = Salon::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:100',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $salon->update([
            'nombre' => strtoupper($request->nombre),
            'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', 'Salón actualizado');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $salon = Salon::findOrFail($id);
        $salon->delete();
        return redirect()->back()->with('success', 'Salón eliminado');
    }
}
