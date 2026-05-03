<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartaDigitalController extends Controller
{
    public function index()
    {
        $url = Setting::where('key', 'carta_digital_url')->value('value') ?? '';
        $qrPath = 'qr/carta_digital.png';
        $qrExists = Storage::disk('public')->exists($qrPath);

        return view('admin.CartaDigital.index', compact('url', 'qrExists', 'qrPath'));
    }

    public function guardarUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:500',
        ]);

        Setting::updateOrCreate(
            ['key' => 'carta_digital_url'],
            ['value' => $request->url]
        );

        return redirect()->route('admin.CartaDigital.index')
                         ->with('success', 'URL de carta digital actualizada correctamente.');
    }

    public function generarQr(Request $request)
    {
        $url = Setting::where('key', 'carta_digital_url')->value('value');

        if (!$url) {
            return redirect()->route('admin.CartaDigital.index')
                             ->with('error', 'Primero debe guardar una URL válida.');
        }

        // Generar QR usando la API gratuita de QR Server
        $qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($url);

        $qrContent = @file_get_contents($qrApiUrl);

        if (!$qrContent) {
            return redirect()->route('admin.CartaDigital.index')
                             ->with('error', 'No se pudo generar el código QR. Verifique su conexión.');
        }

        Storage::disk('public')->makeDirectory('qr');
        Storage::disk('public')->put('qr/carta_digital.png', $qrContent);

        return redirect()->route('admin.CartaDigital.index')
                         ->with('success', 'Código QR generado correctamente.');
    }

    public function descargarQr()
    {
        $qrPath = storage_path('app/public/qr/carta_digital.png');

        if (!file_exists($qrPath)) {
            return redirect()->route('admin.CartaDigital.index')
                             ->with('error', 'El código QR no existe. Genérelo primero.');
        }

        return response()->download($qrPath, 'carta_digital_qr.png');
    }
}
