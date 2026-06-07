<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoPres extends Model
{
    //
    protected $table = 'producto_pres';
    protected $fillable = [
        'producto_id',
        'codigo',
        'codigo_qr',
        'codigo_barra',
        'presentacion',
        'descripcion',
        'precio',
        'precio_delivery',
        'costo',
        'stock',
        'stock_min',
        'igv',
        'receta',
        'delivery',
        'estado',
        'orden',
    ];
}
