<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaProduccion extends Model
{
    use HasFactory;

    protected $table = 'areas_produccion';

    protected $fillable = [
        'nombre',
        'inpresora_id',
        'estado',
    ];

    /**
     * Scope para áreas activas
     */
    public function scopeActivas(Builder $query): Builder
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Relación con la impresora asignada
     */
    public function impresora()
    {
        return $this->belongsTo(Inpresora::class, 'inpresora_id');
    }
}
