<?php

namespace App\Http\Controllers;

use App\Models\Inpresora;
use Illuminate\Http\Request;

class InpresoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $impresoras = Inpresora::all();
        return view('admin.Inpresora.index', compact('impresoras'));;
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
        Inpresora::create([
        'nombre' => $request->nombre,
        'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', 'Impresora registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inpresora $inpresora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inpresora $inpresora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $impresora = Inpresora::findOrFail($id);

        $impresora->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado
        ]);

        return redirect()->back()->with('success', 'Impresora actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $impresora = Inpresora::findOrFail($id);
        $impresora->delete();
        return redirect()->back()->with('success', 'Impresora eliminada');

    }
}
