<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $TipoPagos = TipoPago::all();
        return view('admin.AdministracionGeneral.index', compact('TipoPagos'));
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
        'descripcion' => 'required|string|max:100'
        ]);

        TipoPago::create([
            'descripcion' => $request->descripcion
        ]);

        return redirect()->back()->with('success', 'Tipo de pago agregado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(TipoPago $tipoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoPago $tipoPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        //
          $request->validate([
            'descripcion' => 'required|max:100'
        ]);

        $tipoPago = TipoPago::findOrFail($id);
        $tipoPago->update([
            'descripcion' => $request->descripcion
        ]);
         return redirect()->back()->with('success', 'Tipo de pago actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        TipoPago::findOrFail($id)->delete();
         return redirect()->back()->with('success', 'Tipo de pago eliminado correctamente');
    }
}
