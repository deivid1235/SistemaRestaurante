<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'dni',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'cargo_rrhh',
        'foto',
        'username',
        'password',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'password' => 'hashed',
    ];

    // Accessor: nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}");
    }

    // Scope: activos
    public function scopeActivos($query)
    {
        return $query->where('estado', true);
    }
}
