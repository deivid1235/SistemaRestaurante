<?php

namespace App\Models;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\VentaDetalle;
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

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'venta_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu');
    }
    

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_doc');
    }
    
    
}