<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Salon;
use App\Models\PedidoMesa;

class Mesa extends Model
{
    protected $table = 'mesas';

    protected $fillable = [
        'salon_id',
        'nombre',
        'estado'
    ];

    // Relación con salón
    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    // Relación con pedido de mesa
    public function pedidoMesa()
    {
        return $this->hasOne(PedidoMesa::class, 'id_mesa')
            ->latestOfMany();
    }
}