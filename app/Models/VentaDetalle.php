<?php

namespace App\Models;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table = 'venta_detalles';

    protected $fillable = [
        'venta_id',
        'id_prod',
        'cantidad',
        'precio',
        'total'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_prod');
    }
}