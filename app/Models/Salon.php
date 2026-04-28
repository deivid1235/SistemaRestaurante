<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    //
    protected $table = 'salons';
    protected $fillable = [
        'nombre',
        'estado',
    ];
}
