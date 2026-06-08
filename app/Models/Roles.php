<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación: un rol tiene muchos usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}