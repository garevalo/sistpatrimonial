<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = ['idcatalogo','codcatalogo','denom_catalogo','idestado'];
    protected $primaryKey = 'idcatalogo';
}
