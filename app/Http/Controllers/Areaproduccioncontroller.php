<?php

namespace App\Http\Controllers;

use App\Models\AreaProduccion;
use App\Models\Inpresora;
use Illuminate\Http\Request;

class AreaProduccionController extends Controller
{
    public function index(Request $request)
    {
        $query = AreaProduccion::with('impresora');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $areas      = $query->orderBy('nombre')->paginate(10);
        $impresoras = Inpresora::orderBy('nombre')->get();
        $total      = AreaProduccion::count();
        $activos    = AreaProduccion::where('estado', 'activo')->count();
        $inactivos  = AreaProduccion::where('estado', 'inactivo')->count();

        return view('admin.AreaProduccion.index', compact(
            'areas',
            'impresoras',
            'total',
            'activos',
            'inactivos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:100|unique:areas_produccion,nombre',
            'inpresora_id' => 'nullable|exists:inpresoras,id',
            'estado'       => 'required|in:activo,inactivo',
        ]);

        AreaProduccion::create([
            'nombre'       => strtoupper($request->nombre),
            'inpresora_id' => $request->inpresora_id ?: null,
            'estado'       => $request->estado,
        ]);

        return redirect()->route('admin.AreaProduccion.index')
                         ->with('success', 'Área de producción creada correctamente.');
    }

    public function update(Request $request, int $id)
    {
        $area = AreaProduccion::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:100|unique:areas_produccion,nombre,' . $id,
            'inpresora_id' => 'nullable|exists:inpresoras,id',
            'estado'       => 'required|in:activo,inactivo',
        ]);

        $area->update([
            'nombre'       => strtoupper($request->nombre),
            'inpresora_id' => $request->inpresora_id ?: null,
            'estado'       => $request->estado,
        ]);

        return redirect()->route('admin.AreaProduccion.index')
                         ->with('success', 'Área de producción actualizada correctamente.');
    }

    public function destroy(int $id)
    {
        $area = AreaProduccion::findOrFail($id);
        $area->delete();

        return redirect()->route('admin.AreaProduccion.index')
                         ->with('success', 'Área de producción eliminada correctamente.');
    }
}
