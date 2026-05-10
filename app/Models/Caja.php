<?php

namespace App\Models;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

    protected $fillable = [
        'nombre',
        'estado',
        'fecha_apertura',
        'fecha_cierre'
    ];

    public function scopeActivas(Builder $query)
    {
        return $query->where('estado', 'activo');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'caja_usuario');
    }
}
