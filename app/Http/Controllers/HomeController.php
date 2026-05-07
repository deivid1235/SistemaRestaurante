<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ProductoCategoria;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index(){
        $categorias = ProductoCategoria::where('estado', 'a')->orderBy('orden')->get();
        $productos = Producto::where('estado', 'a')->get();
        return view('home.index', compact('categorias', 'productos'));
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
}