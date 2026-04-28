<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $usuarios = Usuario::when($search, function ($query, $search) {
                $query->where('nombres', 'like', "%{$search}%")
                      ->orWhere('apellido_paterno', 'like', "%{$search}%")
                      ->orWhere('apellido_materno', 'like', "%{$search}%")
                      ->orWhere('cargo_rrhh', 'like', "%{$search}%");
            })
            ->orderBy('nombres')
            ->paginate(10)
            ->withQueryString();

        return view('admin.Empresa.usuarios.index', compact('usuarios', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = ['ADMINISTRADOR', 'CAJERO', 'PRODUCCION', 'MOZO', 'REPARTIDOR', 'PERSONALIZADO'];
        return view('admin.Empresa.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni'              => 'nullable|string|max:20',
            'nombres'          => 'required|max:100',
            'apellido_paterno' => 'nullable|max:100',
            'apellido_materno' => 'nullable|max:100',
            'email'            => 'nullable|email|unique:usuarios,email',
            'cargo_rrhh'       => 'nullable|max:100',
            'username'         => 'required|max:50|unique:usuarios,username',
            'password'         => 'required|min:6',
            'rol'              => 'required|in:ADMINISTRADOR,CAJERO,PRODUCCION,MOZO,REPARTIDOR,PERSONALIZADO',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $usuario = new Usuario();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('usuarios', 'public');
            $usuario->foto = $path;
        }

        $usuario->dni              = $request->dni;
        $usuario->nombres          = $request->nombres;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email            = $request->email;
        $usuario->cargo_rrhh       = $request->cargo_rrhh;
        $usuario->username         = $request->username;
        $usuario->password         = bcrypt($request->password);
        $usuario->rol              = $request->rol;
        $usuario->estado           = $request->has('estado') ? 1 : 0;

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles   = ['ADMINISTRADOR', 'CAJERO', 'PRODUCCION', 'MOZO', 'REPARTIDOR', 'PERSONALIZADO'];
        return view('admin.Empresa.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'dni'              => 'nullable|string|max:20',
            'nombres'          => 'required|max:100',
            'apellido_paterno' => 'nullable|max:100',
            'apellido_materno' => 'nullable|max:100',
            'email'            => ['nullable', 'email', Rule::unique('usuarios', 'email')->ignore($usuario->id)],
            'cargo_rrhh'       => 'nullable|max:100',
            'username'         => ['required', 'max:50', Rule::unique('usuarios', 'username')->ignore($usuario->id)],
            'password'         => 'nullable|min:6',
            'rol'              => 'required|in:ADMINISTRADOR,CAJERO,PRODUCCION,MOZO,REPARTIDOR,PERSONALIZADO',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($usuario->foto && Storage::exists('public/' . $usuario->foto)) {
                Storage::delete('public/' . $usuario->foto);
            }
            $path = $request->file('foto')->store('usuarios', 'public');
            $usuario->foto = $path;
        }

        $usuario->dni              = $request->dni;
        $usuario->nombres          = $request->nombres;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email            = $request->email;
        $usuario->cargo_rrhh       = $request->cargo_rrhh;
        $usuario->username         = $request->username;
        $usuario->rol              = $request->rol;
        $usuario->estado           = $request->has('estado') ? 1 : 0;

        // Solo actualizar contraseña si se envió una nueva
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->foto && Storage::exists('public/' . $usuario->foto)) {
            Storage::delete('public/' . $usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
