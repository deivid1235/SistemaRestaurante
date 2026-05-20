<?php

namespace App\Http\Controllers;

use App\Models\Aperturas_Caja;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Caja;
use App\Models\Turno;

class AperturasCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $aperturas = Aperturas_Caja::all();
        return view("admin.AperturaCaja.index", compact("aperturas")); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $usuarios = Usuario::all();
        $cajas = Caja::all();
        $turnos = Turno::all();

        return view("admin.AperturaCaja.create", compact("usuarios", "cajas", "turnos"));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'usuario_id' => 'required',
            'caja_id' => 'required',
            'turno_id' => 'required',
            'fecha_apertura' => 'required',
            'monto_apertura' => 'required|numeric',

            'fecha_cierre' => 'nullable',
            'monto_cierre' => 'nullable|numeric',
            'monto_sistema' => 'nullable|numeric',
            'estado' => 'nullable',
            'observacion' => 'nullable'
        ]);

        $diferencia = 0;

        if ($request->monto_cierre && $request->monto_sistema) {
            $diferencia = $request->monto_cierre - $request->monto_sistema;
        }

        Aperturas_Caja::create([
            'usuario_id' => $request->usuario_id,
            'caja_id' => $request->caja_id,
            'turno_id' => $request->turno_id,
            'fecha_apertura' => $request->fecha_apertura,
            'monto_apertura' => $request->monto_apertura,

            'fecha_cierre' => $request->fecha_cierre,
            'monto_cierre' => $request->monto_cierre,
            'monto_sistema' => $request->monto_sistema,
            'diferencia' => $diferencia,
            'estado' => $request->estado ?? 'a',
            'observacion' => $request->observacion,
        ]);

        return redirect()->route('admin.AperturaCaja.index')
            ->with('success', 'Apertura registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aperturas_Caja $aperturas_Caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $apertura = Aperturas_Caja::findOrFail($id);
        $usuarios = Usuario::all();
        $cajas = Caja::all();
        $turnos = Turno::all();

        return view("admin.AperturaCaja.edit", compact("apertura","usuarios","cajas","turnos"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $apertura = Aperturas_Caja::findOrFail($id);
        $request->validate([
            'usuario_id' => 'required',
            'caja_id' => 'required',
            'turno_id' => 'required',
            'fecha_apertura' => 'required',
            'monto_apertura' => 'required|numeric',

            'fecha_cierre' => 'nullable',
            'monto_cierre' => 'nullable|numeric',
            'monto_sistema' => 'nullable|numeric',
            'estado' => 'nullable',
            'observacion' => 'nullable'
        ]);

        $diferencia = 0;

        if ($request->monto_cierre && $request->monto_sistema) {
            $diferencia = $request->monto_cierre - $request->monto_sistema;
        }

        $apertura->update([
            'usuario_id' => $request->usuario_id,
            'caja_id' => $request->caja_id,
            'turno_id' => $request->turno_id,
            'fecha_apertura' => $request->fecha_apertura,
            'monto_apertura' => $request->monto_apertura,

            'fecha_cierre' => $request->fecha_cierre,
            'monto_cierre' => $request->monto_cierre,
            'monto_sistema' => $request->monto_sistema,
            'diferencia' => $diferencia,
            'estado' => $request->estado ?? 'a',
            'observacion' => $request->observacion,
        ]);

        return redirect()->route('admin.AperturaCaja.index')
            ->with('success', 'Apertura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $apertura = Aperturas_Caja::findOrFail($id);
        $apertura->delete();

        return redirect()->route('admin.AperturaCaja.index')
            ->with('success', 'Apertura eliminada correctamente');
    }
}
