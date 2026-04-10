<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ConfiguracionVisualController extends Controller
{
    public function index()
    {
        $imagenes = File::files(public_path('carrusel'));

        $imagenes = collect($imagenes)->map(function ($file) {
            return $file->getFilename();
        })->values();

        return view('admin.ConfiguracionVisual.index', [
            'imagenes' => $imagenes
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('carrusel'), $nombre);
        }

        return back()->with('success', 'Imagen subida correctamente');
    }
     
    public function delete(Request $request)
    {
        $ruta = public_path('carrusel/' . $request->imagen);

        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        return back()->with('success', 'Imagen eliminada correctamente');
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        // eliminar imagen antigua
        $ruta = public_path('carrusel/' . $request->old);

        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        // guardar nueva
        $file = $request->file('imagen');
        $nombre = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('carrusel'), $nombre);

        return back()->with('success', 'Imagen actualizada correctamente');
    }

    public function guardarTema(Request $request)
    {
        // Validación
        $request->validate([
            'color_mode'   => 'nullable|string|in:light,dark,system',
            'accent_color' => 'nullable|string',
        ]);

        // Guardar en sesión
        session([
            'color_mode'   => $request->color_mode ?? 'light',
            'accent_color' => $request->accent_color ?? '#1e88b6',
        ]);

        return back()->with('success', 'Tema guardado correctamente');
    }

    public function getTema()
    {
        return [
            'color_mode'   => session('color_mode', 'light'),
            'accent_color' => session('accent_color', '#1e88b6'),
        ];
    }
}