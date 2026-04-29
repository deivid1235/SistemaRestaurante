<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empresa = Empresa::first();
        return(view('admin.Empresa.index', compact('empresa')));
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
        'ruc' => 'required|size:11|unique:empresas,ruc',
        'razon_social' => 'required|max:255',
        'nombre_comercial' => 'nullable|max:255',
        ]);

        $empresa = new Empresa();

        // LOGO
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('empresas', 'public');
            $empresa->logo = $path;
        }

        $empresa->modo = $request->has('modo') ? 'produccion' : 'beta';

        $empresa->ruc = $request->ruc;
        $empresa->razon_social = $request->razon_social;
        $empresa->nombre_comercial = $request->nombre_comercial;

        $empresa->direccion_comercial = $request->direccion_comercial;
        $empresa->direccion_fiscal = $request->direccion_fiscal;

        $empresa->ubigeo = $request->ubigeo;
        $empresa->departamento = $request->departamento;
        $empresa->provincia = $request->provincia;
        $empresa->distrito = $request->distrito;

        $empresa->usuariosol = $request->usuariosol;
        $empresa->clave_sol = $request->clave_sol;
        $empresa->clavecertificado = $request->clavecertificado;

        $empresa->celular = $request->celular;
        $empresa->email = $request->email;

        $empresa->save();

        return redirect()->back()->with('success', 'Empresa creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
          $empresa = Empresa::findOrFail($id);

        $request->validate([
            'ruc' => 'required|size:11|unique:empresas,ruc,' . $empresa->id,
            'razon_social' => 'required|max:255',
            'nombre_comercial' => 'nullable|max:255',
            'direccion_comercial' => 'nullable|max:255',
            'direccion_fiscal' => 'nullable|max:255',

            'ubigeo' => 'nullable|size:6',
            'departamento' => 'nullable|max:100',
            'provincia' => 'nullable|max:100',
            'distrito' => 'nullable|max:100',

            'usuariosol' => 'nullable|max:100',
            'clave_sol' => 'nullable',
            'clavecertificado' => 'nullable',

            'celular' => 'nullable|max:20',
            'email' => 'nullable|email|max:150',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            if ($empresa->logo && Storage::exists('public/' . $empresa->logo)) {
                Storage::delete('public/' . $empresa->logo);
            }

            $path = $request->file('logo')->store('empresas', 'public');
            $empresa->logo = $path;
        }

        $empresa->modo = $request->has('modo') ? 'produccion' : 'beta';

        $empresa->update([
            'ruc' => $request->ruc,
            'razon_social' => $request->razon_social,
            'nombre_comercial' => $request->nombre_comercial,

            'direccion_comercial' => $request->direccion_comercial,
            'direccion_fiscal' => $request->direccion_fiscal,

            'ubigeo' => $request->ubigeo,
            'departamento' => $request->departamento,
            'provincia' => $request->provincia,
            'distrito' => $request->distrito,

            'usuariosol' => $request->usuariosol,
            'clave_sol' => $request->clave_sol,
            'clavecertificado' => $request->clavecertificado,

            'celular' => $request->celular,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Empresa actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
