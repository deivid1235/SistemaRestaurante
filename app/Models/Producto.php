<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'id_catg',
        'id_areap',
        'nombre',
        'notas',
        'descripcion',
        'imagen',
        'codigo_qr',
        'codigo_barra',
        'precio',
        'costo',
        'stock',
        'stock_minimo',
        'preparacion',
        'tiempo_preparacion',
        'delivery',
        'destacado',
        'estado',
        'orden',
    ];

    public function categoria()
    {
        return $this->belongsTo(ProductoCategoria::class, 'id_catg');
    }

    public function areaProduccion()
    {
        return $this->belongsTo(AreaProduccion::class, 'id_areap');
    }

    public function getPrecioFormatAttribute()
    {
        return number_format($this->precio, 2);
    }

    public function getStockBajoAttribute()
    {
        return $this->stock <= $this->stock_minimo;
    }
    
}