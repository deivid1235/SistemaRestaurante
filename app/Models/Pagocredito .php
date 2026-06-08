<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoCredito extends Model
{
    protected $table = 'pagos_credito';

    protected $fillable = [
        'credito_id',
        'monto',
        'interes',
        'fecha_pago',
        'observacion',
        'usuario_id',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'monto'      => 'decimal:2',
        'interes'    => 'decimal:2',
    ];

    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
