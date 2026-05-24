<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Salon;
use App\Models\Mesa;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalProductos = Producto::count();
        $totalSalones = Salon::count();
        $totalMesas = Mesa::count();
        $totalUsuarios = User::count();

        $clientesSemana = Cliente::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $clientesSemanaAnterior = Cliente::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();

        $porcentajeClientes = $clientesSemanaAnterior > 0
            ? (($clientesSemana - $clientesSemanaAnterior) / $clientesSemanaAnterior) * 100
            : 100;

        $productosSemana = Producto::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $productosSemanaAnterior = Producto::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();

        $porcentajeProductos = $productosSemanaAnterior > 0
            ? (($productosSemana - $productosSemanaAnterior) / $productosSemanaAnterior) * 100
            : 100;

        $mesasSemana = Mesa::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $mesasSemanaAnterior = Mesa::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();

        $porcentajeMesas = $mesasSemanaAnterior > 0
            ? (($mesasSemana - $mesasSemanaAnterior) / $mesasSemanaAnterior) * 100
            : 100;

        $usuariosSemana = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        $usuariosSemanaAnterior = User::whereBetween('created_at', [
            Carbon::now()->subDays(14),
            Carbon::now()->subDays(7)
        ])->count();

        $porcentajeUsuarios = $usuariosSemanaAnterior > 0
            ? (($usuariosSemana - $usuariosSemanaAnterior) / $usuariosSemanaAnterior) * 100
            : 100;

        return view('admin.dashboard', compact(
            'totalClientes',
            'totalProductos',
            'totalSalones',
            'totalMesas',
            'totalUsuarios',
            'porcentajeClientes',
            'porcentajeProductos',
            'porcentajeMesas',
            'porcentajeUsuarios'
        ));
    }
}