<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    //
    protected $table = 'metodo_pagos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo_pago_id',
        'estado'
    ];

    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }
}
