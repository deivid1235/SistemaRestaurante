<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aperturas_Caja extends Model
{
    protected $table = "aperturas_caja";

    protected $fillable = [
        'usuario_id',
        'caja_id',
        'turno_id',
        'fecha_apertura',
        'monto_apertura',
        'fecha_cierre',
        'monto_cierre',
        'monto_sistema',
        'diferencia',
        'estado',
        'observacion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }
}