<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos'; 
    protected $fillable = [
        'insumo_catg_id',
        'tipomedida_id',
        'codigo',
        'nombre',
        'stock',
        'costo',
        'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(InsumoCatg::class, 'insumo_catg_id');
    }

    public function tipomedida()
    {
        return $this->belongsTo(Tipomedida::class, 'tipomedida_id');
    }
   
}