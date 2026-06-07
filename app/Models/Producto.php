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

    public function presentaciones()
    {
        return $this->hasMany(ProductoPres::class, 'producto_id');
    }

    
    
    
}