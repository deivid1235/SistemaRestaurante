<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table = 'creditos';

    protected $fillable = [
        'compra_id',
        'monto_total',
        'interes',
        'amortizado',
        'pendiente',
        'fecha_vencimiento',
        'estado',
        'usuario_id',
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
        'monto_total'       => 'decimal:2',
        'interes'           => 'decimal:2',
        'amortizado'        => 'decimal:2',
        'pendiente'         => 'decimal:2',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function pagos()
    {
        return $this->hasMany(PagoCredito::class, 'credito_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
