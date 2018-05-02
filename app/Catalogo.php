<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = ['idcatalogo','codcatalogo','denom_catalogo','idestado','cod_grupo_generico','cod_clase_generico'];
    protected $primaryKey = 'idcatalogo';
}
