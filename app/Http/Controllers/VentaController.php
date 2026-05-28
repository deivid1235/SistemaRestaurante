<?php

namespace App\Http\Controllers;
use App\Models\Aperturas_Caja;
use Illuminate\Support\Facades\Auth;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajaAbierta = Aperturas_Caja::where('usuario_id', Auth::id())
            ->where('estado', 'a')
            ->first();

        if (!$cajaAbierta) {
            return redirect()->route('admin.AperturaCaja.index')
                ->with('error', 'Debe abrir caja antes de ingresar al punto de venta');
        }

        return view('admin.Venta.index', compact('cajaAbierta'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
