<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class OptimizacionController extends Controller
{
    public function index()
    {
        return view('admin.Optimizacion.index');
    }

    /**
     * Optimizar Pedidos — limpia cache, sessions y jobs temporales
     */
    public function optimizarPedidos()
    {
        try {
            // Limpiar jobs fallidos
            if (Schema::hasTable('failed_jobs')) {
                DB::table('failed_jobs')->truncate();
            }

            // Limpiar jobs pendientes
            if (Schema::hasTable('jobs')) {
                DB::table('jobs')->truncate();
            }

            // Limpiar cache de la aplicación
            if (Schema::hasTable('cache')) {
                DB::table('cache')->truncate();
            }
            if (Schema::hasTable('cache_locks')) {
                DB::table('cache_locks')->truncate();
            }

            // Limpiar sessions
            if (Schema::hasTable('sessions')) {
                DB::table('sessions')->truncate();
            }

            // Limpiar cache de Laravel
            Artisan::call('cache:clear');

            return redirect()->route('admin.Optimizacion.index')
                             ->with('success', 'Pedidos optimizados correctamente. Cache, sesiones y jobs temporales eliminados.');
        } catch (\Exception $e) {
            return redirect()->route('admin.Optimizacion.index')
                             ->with('error', 'Error al optimizar: ' . $e->getMessage());
        }
    }

    /**
     * Restaurar tabla genérica
     */
    private function restaurarTabla(string $tabla, string $nombre): \Illuminate\Http\RedirectResponse
    {
        try {
            if (!Schema::hasTable($tabla)) {
                return redirect()->route('admin.Optimizacion.index')
                                 ->with('warning', "La tabla de {$nombre} no existe en el sistema aún.");
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($tabla)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route('admin.Optimizacion.index')
                             ->with('success', "{$nombre} restaurado(a) correctamente.");
        } catch (\Exception $e) {
            return redirect()->route('admin.Optimizacion.index')
                             ->with('error', "Error al restaurar {$nombre}: " . $e->getMessage());
        }
    }

    public function restaurarVentas()
    {
        return $this->restaurarTabla('ventas', 'Ventas');
    }

    public function restaurarProductos()
    {
        return $this->restaurarTabla('productos', 'Productos');
    }

    public function restaurarInsumos()
    {
        return $this->restaurarTabla('insumos', 'Insumos');
    }

    public function restaurarClientes()
    {
        return $this->restaurarTabla('clientes', 'Clientes');
    }

    public function restaurarProveedores()
    {
        return $this->restaurarTabla('proveedores', 'Proveedores');
    }

    public function restaurarSalones()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            if (Schema::hasTable('mesas')) {
                DB::table('mesas')->truncate();
            }
            if (Schema::hasTable('salons')) {
                DB::table('salons')->truncate();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->route('admin.Optimizacion.index')
                             ->with('success', 'Salones y mesas restaurados correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.Optimizacion.index')
                             ->with('error', 'Error al restaurar salones: ' . $e->getMessage());
        }
    }

    public function restaurarNotasVentas()
    {
        return $this->restaurarTabla('notas_ventas', 'Notas de Ventas');
    }
}
