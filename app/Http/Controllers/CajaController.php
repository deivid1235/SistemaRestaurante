<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $query = Caja::with('usuarios'); 

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $cajas = $query->orderBy('nombre')->paginate(10);
        $total = Caja::count();

        return view('admin.Caja.index', compact('cajas', 'total'));
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

        return redirect()->route('admin.Caja.index')
                        ->with('success', 'Caja creada correctamente.');
    }
    public function edit(int $id)
    {
        $caja = Caja::findOrFail($id);
        return response()->json($caja);
    }

    public function update(Request $request, int $id)
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

        return redirect()->route('admin.Caja.index')->with('success', 'Caja actualizada correctamente.');
    }
    public function destroy(int $id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->route('admin.Caja.index')
                         ->with('success', 'Caja eliminada correctamente.');
    }

  
    public function abrir(int $id)
    {
        $caja = Caja::findOrFail($id);

        if ($caja->fecha_apertura && !$caja->fecha_cierre) {
            return redirect()->back()->with('error', 'La caja ya está abierta.');
        }

        $caja->update([
            'estado' => 'activo'
        ]);

        return redirect()->back()->with('success', 'Caja abierta correctamente.');
    }

   
    public function cerrar( int $id)
    {
        $caja = Caja::findOrFail($id);

        if (!$caja->fecha_apertura) {
            return redirect()->back()->with('error', 'La caja no ha sido abierta.');
        }

        if ($caja->fecha_cierre) {
            return redirect()->back()->with('error', 'La caja ya está cerrada.');
        }

        $caja->update([
            'fecha_cierre' => now(),
            'estado' => 'inactivo'
        ]);

        return redirect()->back()->with('success', 'Caja cerrada correctamente.');
    }

   
    public function usuarios(int $id)
    {
        $caja = Caja::with('usuarios')->findOrFail($id);

        $usuarios = Usuario::where('estado', 1)
            ->orderBy('nombres')
            ->get(['id', 'nombres', 'apellido_paterno', 'apellido_materno'])
            ->map(function ($u) {
                return [
                    'id' => $u->id,
                    'nombre_completo' => trim(
                        $u->nombres . ' ' .
                        $u->apellido_paterno . ' ' .
                        $u->apellido_materno
                    ),
                ];
            });

        return response()->json([
            'caja' => $caja,
            'usuarios' => $usuarios,
            'asignados' => $caja->usuarios->pluck('id')->toArray(),
        ]);
    }

    public function asignarUsuarios(Request $request, int $id)
    {
        $caja = Caja::findOrFail($id);

        $request->validate([
            'usuarios'   => 'nullable|array',
            'usuarios.*' => 'exists:usuarios,id',
        ]);

        $usuarios = $request->usuarios ?? [];

        $caja->usuarios()->sync($usuarios);

        return redirect()
            ->route('admin.Caja.index')
            ->with('success', 'Usuarios asignados correctamente.');
    }
}