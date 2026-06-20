<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Inpresora;
use App\Models\Venta;
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
    public function destroy(int $id)
    {
        //
        $impresora = Inpresora::findOrFail($id);
        $impresora->delete();
        return redirect()->back()->with('success', 'Impresora eliminada');

    }

    public function ticket(int $id)
    {
        $venta = Venta::with([
            'detalles.producto',
            'cliente',
            'usuario',
            'tipoDocumento'
        ])->findOrFail($id);

        // obtener plantilla activa desde BD
        $config = DB::table('modeloplanilla')->first();

        $plantilla = $config->plantilla ?? '80';

        // validar por seguridad
        if (!in_array($plantilla, ['80', '58', '50', 'A4'])) {
            $plantilla = '80';
        }

        return view("admin.Inpresora.ModeloTikes.ticket_$plantilla", compact('venta'));
    }
    
}
