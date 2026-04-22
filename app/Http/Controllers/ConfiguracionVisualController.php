<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConfiguracionVisualController extends Controller
{
    public function index()
    {
        $imagenes = collect(File::files(public_path('carrusel')))
            ->map(fn($file) => $file->getFilename())
            ->values();

        $savedColors = DB::table('settings')
            ->where('key', 'saved_colors')
            ->value('value');

        $savedColors = $savedColors ? json_decode($savedColors, true) : [];

        if (!is_array($savedColors)) {
            $savedColors = [];
        }

        $accent = DB::table('settings')
            ->where('key', 'accent_color')
            ->value('value');

        $logo = null;

        $files = File::files(public_path('perfil'));

        if (count($files) > 0) {
            $logo = 'perfil/' . $files[0]->getFilename();
        }

        return view('admin.ConfiguracionVisual.index', compact(
            'imagenes',
            'savedColors',
            'accent',
            'logo'
        ));
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
    

        return redirect()->back()->with('success', 'Imagen subida correctamente');
    }
     
    public function delete(Request $request)
    {
        $ruta = public_path('carrusel/' . $request->imagen);

        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        return redirect()->back()->with('success', 'Imagen eliminada correctamente');
        
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
       
        $ruta = public_path('carrusel/' . $request->old);

        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        $file = $request->file('imagen');
        $nombre = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('carrusel'), $nombre);

        return redirect()->back()->with('success', 'Imagen actualizada correctamente');
    }

    public function guardarColor(Request $request)
    {
        $request->validate([
            'accent_color' => 'required|string'
        ]);

        $setting = DB::table('settings')->where('key', 'saved_colors')->first();

        $colores = $setting ? json_decode($setting->value, true) : [];

        if (!in_array($request->accent_color, $colores)) {
            $colores[] = $request->accent_color;
        }

        DB::table('settings')->updateOrInsert(
            ['key' => 'saved_colors'],
            ['value' => json_encode($colores), 'updated_at' => now(), 'created_at' => now()]
        );

        DB::table('settings')->updateOrInsert(
            ['key' => 'accent_color'],
            ['value' => $request->accent_color, 'updated_at' => now(), 'created_at' => now()]
        );

       return redirect()->back()->with('success', 'Modalidad guardada correctamente');
    }
    
    public function guardarLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        $carpeta = public_path('perfil');

        if (!File::exists($carpeta)) {
            File::makeDirectory($carpeta, 0777, true);
        }

        $file = $request->file('logo');
        $nombre = time() . '.' . $file->getClientOriginalExtension();

        $file->move($carpeta, $nombre);

        foreach (File::files($carpeta) as $img) {
            if ($img->getFilename() !== $nombre) {
                File::delete($img);
            }
        }

        session(['logo' => 'perfil/' . $nombre]);

        return redirect()->back()->with('success', 'Logo guardado correctamente');
    }
}