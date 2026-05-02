<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function scopeActivas($query)
    {
        return $query->where('estado', 'activo');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'caja_usuario', 'caja_id', 'usuario_id');
    }
}
