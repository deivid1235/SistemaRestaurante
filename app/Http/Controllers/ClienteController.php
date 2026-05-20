<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view('admin.Clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.Clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tipo_cliente' => 'required',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:13',
            'nombres' => 'required',
            'correo' => 'required|email',
            'password' => 'required|min:6',
        ]);

        Cliente::create([
            'tipo_cliente' => $request->tipo_cliente,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'nombres' => $request->nombres,
            'razon_social' => $request->razon_social,
            'telefono' => $request->telefono,
            'fecha_nac' => $request->fecha_nac,
            'correo' => $request->correo,
            'password' => bcrypt($request->password),
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'estado' => $request->estado ?? 'a',
        ]);

        return redirect()->route('admin.Clientes.index')
            ->with('success', 'Cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
         $cliente = Cliente::findOrFail($id);
        return view('admin.Clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {

        $request->validate([
            'tipo_cliente' => 'required',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:13',
            'nombres' => 'required',
            'correo' => 'required|email',
            'password' => 'nullable|min:6',
            'fecha_nac' => 'nullable|date',
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->update([
            'tipo_cliente' => $request->tipo_cliente,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'nombres' => $request->nombres,
            'razon_social' => $request->razon_social,
            'telefono' => $request->telefono,
            'fecha_nac' => $request->fecha_nac,
            'correo' => $request->correo,
            'password' => $request->password ? bcrypt($request->password) : $cliente->password,
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'estado' => $request->estado ?? 'i',
        ]);

        return redirect()->route('admin.Clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('admin.Clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }

    public function buscarDocumento(string $tipo, string $numero)
    {
        try {
            
            $token = config('api.token');
            $endpoints = config('api.endpoints');

            if (!$token) {
                return response()->json([
                    'error' => 'Token no configurado'
                ], 500);
            }

            
            if ($tipo === 'DNI') {
                $url = $endpoints['dni'] . $numero;
            } elseif ($tipo === 'RUC') {
                $url = $endpoints['ruc'] . $numero;
            } else {
                return response()->json([
                    'error' => 'Tipo no válido'
                ], 400);
            }

           
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get($url);

            
            if ($response->failed()) {

                if ($tipo === 'DNI') {
                    return response()->json([
                        'full_name' => 'NO ENCONTRADO'
                    ]);
                }

                if ($tipo === 'RUC') {
                    return response()->json([
                        'razon_social' => 'NO ENCONTRADO',
                        'direccion' => ''
                    ]);
                }
            }

           
            $data = $response->json();

            if ($tipo === 'DNI') {
                return response()->json([
                    'full_name' => $data['full_name'] ?? ''
                ]);
            }

            if ($tipo === 'RUC') {
                return response()->json([
                    'razon_social' => $data['razon_social'] ?? '',
                    'direccion' => $data['direccion'] ?? ''
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error interno',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }
}
