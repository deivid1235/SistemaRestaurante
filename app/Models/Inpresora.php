<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inpresora extends Model
{
    //
    protected $table = 'inpresoras';
    protected $fillable = [
        'nombre',
        'estado'
    ];
}
