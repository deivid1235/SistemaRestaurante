<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_cliente',
        'id_tipo_doc',
        'id_usu',
        'id_apc',
        'serie_doc',
        'nro_doc',
        'codigo_operacion',
        'op_gravadas',
        'op_exoneradas',
        'op_inafectas',
        'igv',
        'descuento',
        'total',
        'fecha_emision',
        'fecha_vencimiento',
        'enviado_sunat',
        'estado_sunat',

        'code_respuesta_sunat',
        'descripcion_sunat_cdr',
        'hash_cpe',
        'hash_cdr',
        'name_file_sunat',
        'estado',
    ];

    protected $casts = [
        'fecha_emision' => 'datetime',
        'fecha_vencimiento' => 'date',
        'op_gravadas' => 'decimal:2',
        'op_exoneradas' => 'decimal:2',
        'op_inafectas' => 'decimal:2',
        'igv' => 'decimal:2',
        'total' => 'decimal:2',
    ];
}