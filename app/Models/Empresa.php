<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table = 'empresas';

    protected $fillable = [
    'ruc',
    'razon_social',
    'nombre_comercial',
    'direccion_comercial',
    'direccion_fiscal',
    'ubigeo',
    'departamento',
    'provincia',
    'distrito',
    'modo',
    'usuariosol',
    'clave_sol',
    'clavecertificado',
    'logo',
    'celular',
    'email'
];
}
