<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use App\Models\TipoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $metodos = MetodoPago::with('tipoPago')->latest()->get();
        $tipos = TipoPago::all();

        return view('admin.MetodoPago.index', compact('metodos', 'tipos'));
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
            'tipo_pago_id' => 'required|exists:tipo_pagos,id',
            'descripcion' => 'required|string|max:255',
        ]);

        MetodoPago::create([
            'tipo_pago_id' => $request->tipo_pago_id,
            'descripcion' => $request->descripcion,
            'estado' => true,
        ]);

        return redirect()->back()->with('success', 'Método de pago creado correctamente');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodoPago $metodoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetodoPago $metodoPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'tipo_pago_id' => 'required|exists:tipo_pagos,id',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $metodo = MetodoPago::findOrFail($id);

        $metodo->update([
            'tipo_pago_id' => $request->tipo_pago_id,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Método de pago actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $metodo = MetodoPago::findOrFail($id);
        $metodo->delete();

        return redirect()->back()->with('success', 'Método de pago eliminado');
    }

    public function toggleEstado($id)
    {
        $metodo = MetodoPago::findOrFail($id);

        $metodo->estado = !$metodo->estado;
        $metodo->save();

        return response()->json([
            'success' => true,
            'estado' => $metodo->estado
        ]);
    }

    
}
