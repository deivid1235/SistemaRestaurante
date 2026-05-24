<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ProductoCategoria;
use App\Models\Producto;
use App\Models\Combo;
use App\Models\Cliente;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = ProductoCategoria::where('estado', 'a')->orderBy('orden')->get();
        $productos = Producto::where('estado', 'a')->get();
        $combos = Combo::where('estado', 'activo')->get();

        $path = public_path('storage/combos');

        $imagenesCombos = [];

        if (File::exists($path)) {
            foreach (File::files($path) as $file) {
                $imagenesCombos[] = 'storage/combos/' . $file->getFilename();
            }
        }

        return view('home.index', compact('categorias', 'productos', 'combos', 'imagenesCombos'));
    }
        
       
    public function inicioSECCION()
    {
        $path = public_path('carrusel');

        $images = collect();

        if (File::exists($path)) {
            $images = collect(File::files($path))
                ->filter(function ($file) {
                    return preg_match('/\.(jpg|jpeg|png|webp)$/i', $file->getFilename());
                })
                ->map(function ($file) {
                    return asset('carrusel/' . $file->getFilename());
                })
                ->values();
        }

        return view('home.IniciarSeccion', compact('images'));
    }

    public function productoDetalle(int $id)
    {
        $producto = Producto::findOrFail($id);
        return view('home.Producto', compact('producto'));
    }

    public function byCategoria( int $id)
    {
        $productos = Producto::where('id_catg', $id)->get();

        return response()->json($productos);
    }

    public function storeClientePublico(Request $request)
    {
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
            'telefono' => $request->telefono,
            'fecha_nac' => $request->fecha_nac,
            'correo' => $request->correo,
            'password' => bcrypt($request->password),
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'estado' => 'a',
        ]);

        return redirect()->back()->with('success', 'Registro exitoso');
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

            if (
                !$endpoints ||
                !isset($endpoints['dni']) ||
                !isset($endpoints['ruc'])
            ) {
                return response()->json([
                    'error' => 'Endpoints no configurados correctamente'
                ], 500);
            }

            if ($tipo === 'DNI') {
                $url = $endpoints['dni'] . $numero;
            } elseif ($tipo === 'RUC') {
                $url = $endpoints['ruc'] . $numero;
            } else {
                return response()->json([
                    'error' => 'Tipo no válido (solo DNI o RUC)'
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

            $data = $response->json() ?? [];

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
                'error' => 'Error interno del servidor',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

  
}