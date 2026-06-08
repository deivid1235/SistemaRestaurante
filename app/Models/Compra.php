<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'proveedor_id',
        'tipo_comprobante',
        'serie',
        'numero',
        'fecha_documento',
        'hora_documento',
        'tipo_pago',
        'subtotal',
        'descuento',
        'total',
        'estado',
        'usuario_id',
    ];

    protected $casts = [
        'fecha_documento' => 'date',
        'subtotal'        => 'decimal:2',
        'descuento'       => 'decimal:2',
        'total'           => 'decimal:2',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
