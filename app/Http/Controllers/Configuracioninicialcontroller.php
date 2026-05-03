<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ConfiguracionInicialController extends Controller
{
    /**
     * Claves que maneja este módulo
     */
    private array $keys = [
        // Zona Horaria
        'zona_horaria',
        // Identificación
        'id_tributaria_nombre',
        'id_tributaria_caracteres',
        'id_personal_nombre',
        'id_personal_caracteres',
        // Impuesto / Moneda
        'impuesto_nombre',
        'impuesto_porcentaje',
        'moneda_nombre',
        'moneda_simbolo',
        // Ordenador
        'pc_nombre',
        'pc_ip',
        // Impresión
        'imp_comandas',
        'imp_precuenta',
        'imp_comprobantes',
    ];

    public function index()
    {
        // Cargar todos los settings de una sola consulta
        $rawSettings = Setting::whereIn('key', $this->keys)->pluck('value', 'key');

        $settings = collect($this->keys)->mapWithKeys(fn($k) => [$k => $rawSettings->get($k, '')])->all();

        // Detectar datos del PC automáticamente si aún no están guardados
        if (empty($settings['pc_nombre'])) {
            $settings['pc_nombre'] = gethostname() ?: 'DESCONOCIDO';
        }
        if (empty($settings['pc_ip'])) {
            $settings['pc_ip'] = $this->detectarIp();
        }

        // Valores por defecto
        $defaults = [
            'zona_horaria'            => 'America/Lima',
            'id_tributaria_nombre'    => 'RUC',
            'id_tributaria_caracteres'=> '11',
            'id_personal_nombre'      => 'DNI',
            'id_personal_caracteres'  => '8',
            'impuesto_nombre'         => 'IGV',
            'impuesto_porcentaje'     => '18.00',
            'moneda_nombre'           => 'Soles',
            'moneda_simbolo'          => 'S/',
            'imp_comandas'            => '1',
            'imp_precuenta'           => '1',
            'imp_comprobantes'        => '1',
        ];

        foreach ($defaults as $key => $val) {
            if ($settings[$key] === '') {
                $settings[$key] = $val;
            }
        }

        return view('admin.ConfiguracionInicial.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'zona_horaria'             => 'required|string|max:100',
            'id_tributaria_nombre'     => 'required|string|max:20',
            'id_tributaria_caracteres' => 'required|integer|min:1|max:30',
            'id_personal_nombre'       => 'required|string|max:20',
            'id_personal_caracteres'   => 'required|integer|min:1|max:20',
            'impuesto_nombre'          => 'required|string|max:20',
            'impuesto_porcentaje'      => 'required|numeric|min:0|max:100',
            'moneda_nombre'            => 'required|string|max:50',
            'moneda_simbolo'           => 'required|string|max:10',
            'pc_nombre'                => 'nullable|string|max:100',
            'pc_ip'                    => 'nullable|string|max:50',
        ]);

        $data = [
            'zona_horaria'             => $request->zona_horaria,
            'id_tributaria_nombre'     => strtoupper($request->id_tributaria_nombre),
            'id_tributaria_caracteres' => $request->id_tributaria_caracteres,
            'id_personal_nombre'       => strtoupper($request->id_personal_nombre),
            'id_personal_caracteres'   => $request->id_personal_caracteres,
            'impuesto_nombre'          => strtoupper($request->impuesto_nombre),
            'impuesto_porcentaje'      => number_format((float)$request->impuesto_porcentaje, 2),
            'moneda_nombre'            => $request->moneda_nombre,
            'moneda_simbolo'           => $request->moneda_simbolo,
            'pc_nombre'                => $request->pc_nombre ?? gethostname(),
            'pc_ip'                    => $request->pc_ip ?? $this->detectarIp(),
            'imp_comandas'             => $request->has('imp_comandas') ? '1' : '0',
            'imp_precuenta'            => $request->has('imp_precuenta') ? '1' : '0',
            'imp_comprobantes'         => $request->has('imp_comprobantes') ? '1' : '0',
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.ConfiguracionInicial.index')
                         ->with('success', 'Configuración guardada correctamente.');
    }

    private function detectarIp(): string
    {
        if (isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] !== '::1') {
            return $_SERVER['SERVER_ADDR'];
        }

        $ip = gethostbyname(gethostname());
        return ($ip && $ip !== gethostname()) ? $ip : '127.0.0.1';
    }
}
