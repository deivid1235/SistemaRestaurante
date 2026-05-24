<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $proveedores = Proveedor::all();
        return view('admin.Proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.Proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tipo_documento' => 'required',
            'numero' => 'required|unique:proveedor,numero',
            'razon_social' => 'required',
        ]);

        Proveedor::create([
            'tipo_documento' => $request->tipo_documento,
            'numero' => $request->numero,
            'razon_social' => $request->razon_social,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'estado' => $request->estado ?? 'a',
        ]);

        return redirect()->route('admin.Proveedor.index')
            ->with('success', 'Proveedor registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $provedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)    
    {
        //
        return view('admin.Proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Proveedor $proveedor)
    {
        //
        $request->validate([
            'tipo_documento' => 'required',
            'numero' => 'required|unique:proveedor,numero,' . $proveedor->id,
            'razon_social' => 'required',
        ]);

        $proveedor->update([
            'tipo_documento' => $request->tipo_documento,
            'numero' => $request->numero,
            'razon_social' => $request->razon_social,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'contacto' => $request->contacto,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.Proveedor.index')
            ->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
        $proveedor->delete();
        return redirect()->route('admin.Proveedor.index')
            ->with('success', 'Proveedor eliminado correctamente');
    }
}
