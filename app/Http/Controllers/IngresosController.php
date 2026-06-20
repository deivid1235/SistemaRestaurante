<?php

namespace App\Http\Controllers;

use App\Models\Ingresos;
use Illuminate\Http\Request;
use App\Models\Aperturas_Caja;
use Illuminate\Support\Facades\Auth;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $apertura = Aperturas_Caja::with('caja')
        ->where('usuario_id', Auth::id()) 
        ->where('estado', 'a')
        ->first();
        $ingresos = Ingresos::all();

        return view('admin.Ingresos.index', compact('apertura','ingresos'));
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
        $request->validate([
            'importe' => 'required|numeric|min:0',
            'motivo' => 'required|string|max:255',
        ]);

        $apertura = Aperturas_Caja::where('usuario_id', Auth::id())
            ->where('estado', 'a') 
            ->first();


        if (!$apertura) {
            return back()->with('error', 'Debes abrir caja antes de registrar ingresos');
        }

        Ingresos::create([
            'id_usu' => Auth::id(),
            'id_apc' => $apertura->id,
            'importe' => $request->importe,
            'responsable' => Auth::user()->nombres ?? Auth::user()->name,
            'motivo' => $request->motivo,
            'fecha_reg' => now(),
            'estado' => 'A',
        ]);

        return back()->with('success', 'Ingreso registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingresos $ingresos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingresos $ingresos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingresos $ingresos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingresos $ingresos)
    {
        //
    }
}
