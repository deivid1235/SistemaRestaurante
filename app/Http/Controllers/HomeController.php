<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        $path = public_path('carrusel');
        if (!File::exists($path)) {
            $images = collect([]);
        } else {
            $images = collect(File::files($path))
                ->filter(function ($file) {
                    return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png']);
                })
                ->map(function ($file) {
                    return asset('carrusel/' . $file->getFilename());
                })
                ->values();
        }

        return view('home.index', compact('images'));
    }
}