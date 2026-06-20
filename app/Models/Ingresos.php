<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    //

    protected $table = 'ingresos';

    protected $fillable = [
        'id_usu',
        'id_apc',
        'importe',
        'responsable',
        'motivo',
        'fecha_reg',
        'estado'
    ];
}
