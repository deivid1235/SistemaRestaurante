<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $fillable = [
        'tipo_documento',
        'numero',
        'razon_social',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'estado',
    ];
}