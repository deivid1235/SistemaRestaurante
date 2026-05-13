<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
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
        'direccion',
        'referencia',
        'estado'
    ];

    protected $casts = [
        'fecha_nac' => 'date',
    ];
}
