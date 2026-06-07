<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoMesa extends Model
{
    //
    protected $table = 'pedido_mesas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pedido',
        'id_mesa',
        'id_mozo',
        'nombre_cliente',
        'nro_personas'
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa');
    }
}
