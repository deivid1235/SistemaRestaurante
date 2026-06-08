<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsumoCatg extends Model
{
    
    protected $table = 'insumo_catg';

    protected $fillable = [
        'descripcion',
        'estado'
    ];

    public function insumos()
    {
        return $this->hasMany(Insumo::class, 'insumo_catg_id');
    }
}