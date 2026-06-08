<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    //
    protected $table = 'producto_categorias';
    protected $fillable = [
        'descripcion',
        'delivery',
        'orden',
        'imagen',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_catg', 'id');
    }
}
