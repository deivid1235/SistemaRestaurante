<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamacion;
use Illuminate\Http\Request;

class LibroReclamacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $libroReclamaciones = LibroReclamacion::latest()->get();
        return view('admin.LibroReclamacion.index', compact('libroReclamaciones'));
       
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
            'tipo_documento' => 'required|string',
            'numero_documento' => 'required|string|max:15|unique:libro_reclamacions,numero_documento',
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'departamento' => 'required|string',
            'provincia' => 'required|string',
            'distrito' => 'required|string',

            'servicio_contratado' => 'nullable|string|max:255',
            'numero_orden' => 'nullable|string|max:255',
            'identificacion_servicio' => 'nullable|string|max:255',
            'monto_reclamado' => 'nullable|numeric',

            'tipo_reclamo' => 'required|string|in:Reclamo,Queja',
            'motivo' => 'nullable|string',

            'detalle_solicitud' => 'required|string',
            'pedido_concreto' => 'required|string',

            'acepto_politicas' => 'accepted'
        ]);

        LibroReclamacion::create([
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,

            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,

            'departamento' => $request->departamento,
            'provincia' => $request->provincia,
            'distrito' => $request->distrito,

            'servicio_contratado' => $request->servicio_contratado,
            'numero_orden' => $request->numero_orden,
            'identificacion_servicio' => $request->identificacion_servicio,
            'monto_reclamado' => $request->monto_reclamado,

            'tipo_reclamo' => $request->tipo_reclamo,
            'motivo' => $request->motivo,

            'detalle_solicitud' => $request->detalle_solicitud,
            'pedido_concreto' => $request->pedido_concreto,

            'acepto_politicas' => $request->has('acepto_politicas'),
        ]);

        return redirect()->back()->with('success', 'Reclamo registrado correctamente.');
    }
        

    /**
     * Display the specified resource.
     */
    public function show(LibroReclamacion $libroReclamacion)
    {
        return view('admin.LibroReclamacion.show', compact('libroReclamacion'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LibroReclamacion $libroReclamacion)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LibroReclamacion $libroReclamacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LibroReclamacion $libroReclamacion)
    {
        //
    }
}
