<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodopago extends Model
{
    //
    protected $table = 'metodos_pago';
    protected $fillable = ['descripcion'];
}
