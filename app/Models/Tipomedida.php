<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipomedida extends Model
{
    protected $table = 'tipomedida'; 
    protected $fillable = [
        'descripcion',
        'grupo'
    ];

   
   
}