<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Listar usuarios
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $usuarios = Usuario::with('rol')
            ->when($search, function ($query, $search) {
                $query->where('nombres', 'like', "%{$search}%")
                      ->orWhere('apellido_paterno', 'like', "%{$search}%")
                      ->orWhere('apellido_materno', 'like', "%{$search}%");
            })
            ->orderBy('nombres')
            ->paginate(10)
            ->withQueryString();

        return view('admin.Usuarios.index', compact('usuarios', 'search'));
    }

    /**
     * Form crear usuario
     */
    public function create()
    {
        $roles = Roles::all();
        return view('admin.Usuarios.create', compact('roles'));
    }

    /**
     * Guardar usuario
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
            'rol_id'           => 'required|exists:roles,id',
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
        $usuario->rol_id           = $request->rol_id;
        $usuario->estado           = $request->has('estado') ? 1 : 0;

        $usuario->save();

        return redirect()->route('admin.Usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Form editar usuario
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Roles::all();

        return view('admin.Usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'dni'              => 'nullable|string|max:20',
            'nombres'          => 'required|max:100',
            'apellido_paterno' => 'nullable|max:100',
            'apellido_materno' => 'nullable|max:100',
            'email'            => ['nullable', 'email', Rule::unique('usuarios')->ignore($usuario->id)],
            'cargo_rrhh'       => 'nullable|max:100',
            'username'         => ['required', Rule::unique('usuarios')->ignore($usuario->id)],
            'password'         => 'nullable|min:6',
            'rol_id'           => 'required|exists:roles,id',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
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
        $usuario->rol_id           = $request->rol_id;
        $usuario->estado           = $request->has('estado') ? 1 : 0;

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.Usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy(int $id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->foto && Storage::exists('public/' . $usuario->foto)) {
            Storage::delete('public/' . $usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('admin.Usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
