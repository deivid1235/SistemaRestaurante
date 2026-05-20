<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tipo_cliente',
        'tipo_documento',
        'numero_documento',
        'nombres',
        'razon_social',
        'telefono',
        'fecha_nac',
        'correo',
        'password',
        'direccion',
        'referencia',
        'estado'
    ];

    protected $casts = [
        'fecha_nac' => 'date',
    ];

    protected $hidden = [
        'password',
    ];
}