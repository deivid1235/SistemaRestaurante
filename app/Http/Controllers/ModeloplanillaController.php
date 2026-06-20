<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModeloplanillaController extends Controller
{
    /**
     * Mostrar configuración actual
     */
    public function index()
    {
        $config = DB::table('modeloplanilla')->first();

        return view('admin.Inpresora.plantilla', compact('config'));
    }

    /**
     * Activar plantilla
     */
    public function activar(string $tipo)
    {
        $permitidos = ['80', '58', '50', 'A4'];

        if (!in_array($tipo, $permitidos)) {
            return back()->with('error', 'Plantilla no válida');
        }

        DB::table('modeloplanilla')->updateOrInsert(
            ['id' => 1],
            [
                'plantilla' => $tipo,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return back()->with('success', 'Plantilla activada: ' . $tipo);
    }
}