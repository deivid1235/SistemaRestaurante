<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;
use App\Models\AreaProduccion;
use Illuminate\Support\Facades\File;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $combos = Combo::all();
        $areas = AreaProduccion::all();
        return view('admin.Combos.index', compact('combos', 'areas'));
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
            'nombre' => 'required|string|max:255',
            'id_area' => 'required|exists:areas_produccion,id',
            'descripcion' => 'nullable|string',
            'nota' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'estado' => 'required|in:activo,inactivo',
            'delivery' => 'required|boolean',
        ]);

        $combo = new Combo();
        $combo->nombre = $request->nombre;
        $combo->id_area = $request->id_area;
        $combo->descripcion = $request->descripcion;
        $combo->nota = $request->nota;
        $combo->estado = $request->estado;
        $combo->delivery = $request->delivery;

        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $path = public_path('storage/combos');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($path, $fileName);

            $combo->imagen = 'storage/combos/' . $fileName;
        }

        $combo->save();

        return redirect()->back()->with('success', 'Combo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Combo $combo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Combo $combo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Combo $combo, int $id)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_area' => 'required|exists:areas_produccion,id',
            'descripcion' => 'nullable|string',
            'nota' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'estado' => 'required|in:activo,inactivo',
            'delivery' => 'required|boolean',
        ]);

        $combo = Combo::findOrFail($id);

        $combo->nombre = $request->nombre;
        $combo->id_area = $request->id_area;
        $combo->descripcion = $request->descripcion;
        $combo->nota = $request->nota;
        $combo->estado = $request->estado;
        $combo->delivery = $request->delivery;

        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $path = public_path('storage/combos');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);

            if ($combo->imagen && file_exists(public_path($combo->imagen))) {
                unlink(public_path($combo->imagen));
            }

            $combo->imagen = 'storage/combos/' . $fileName;
        }

        $combo->save();

        return redirect()->back()->with('success', 'Combo actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $combo = Combo::findOrFail($id);

        if ($combo->imagen && file_exists(public_path($combo->imagen))) {
            unlink(public_path($combo->imagen));
        }

        $combo->delete();

        return redirect()->back()->with('success', 'Combo eliminado correctamente');
    }
    
}
