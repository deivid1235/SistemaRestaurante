<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $query = Caja::query();

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $cajas = $query->orderBy('nombre')->paginate(10);
        $total = Caja::count();

        return view('admin.Restaurante.Caja.index', compact('cajas', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:cajas,nombre',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Caja::create([
            'nombre' => strtoupper($request->nombre),
            'estado' => $request->estado,
        ]);

        return redirect()->route('cajas.index')
                         ->with('success', 'Caja creada correctamente.');
    }

    public function edit($id)
    {
        $caja = Caja::findOrFail($id);
        return response()->json($caja);
    }

    public function update(Request $request, $id)
    {
        $caja = Caja::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100|unique:cajas,nombre,' . $id,
            'estado' => 'required|in:activo,inactivo',
        ]);

        $caja->update([
            'nombre' => strtoupper($request->nombre),
            'estado' => $request->estado,
        ]);

        return redirect()->route('cajas.index')
                         ->with('success', 'Caja actualizada correctamente.');
    }

    public function destroy($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->route('cajas.index')
                         ->with('success', 'Caja eliminada correctamente.');
    }

    // Mostrar usuarios disponibles y asignados a la caja
    public function usuarios($id)
    {
        $caja = Caja::with('usuarios')->findOrFail($id);

        $usuarios = Usuario::where('estado', 1)
            ->orderBy('nombres')
            ->get(['id', 'nombres', 'apellido_paterno', 'apellido_materno'])
            ->map(function ($u) {
                return [
                    'id'     => $u->id,
                    'nombre' => trim($u->nombres . ' ' . $u->apellido_paterno . ' ' . $u->apellido_materno),
                ];
            });

        return response()->json([
            'caja'      => $caja,
            'usuarios'  => $usuarios,
            'asignados' => $caja->usuarios->pluck('id')->toArray(),
        ]);
    }

    // Guardar usuarios asignados a la caja
    public function asignarUsuarios(Request $request, $id)
    {
        $caja = Caja::findOrFail($id);

        $request->validate([
            'usuarios'   => 'nullable|array',
            'usuarios.*' => 'exists:usuarios,id',
        ]);

        $caja->usuarios()->sync($request->usuarios ?? []);

        return redirect()->route('cajas.index')
                         ->with('success', 'Usuarios asignados correctamente.');
    }
}
