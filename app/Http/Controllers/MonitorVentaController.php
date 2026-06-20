<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class MonitorVentaController extends Controller
{
    //
    public function index(){
        $ventas = Venta::all();
        return view('admin.MonitorVenta.index', compact('ventas'));
    }

}
