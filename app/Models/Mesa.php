<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    //
    protected $table = 'mesas';
    protected $fillable = ['salon_id', 'nombre', 'estado'];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
