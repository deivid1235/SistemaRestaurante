<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    //
    protected $table = 'combos';

    protected $fillable = [
        'nombre',
        'id_area',
        'nota',
        'descripcion',
        'imagen',
        'estado',
        'delivery'
    ];


    public function area()
    {
        return $this->belongsTo(AreaProduccion::class, 'id_area');
    }
}
