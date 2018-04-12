<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['idmarca','marca'];
    protected $primaryKey = 'idmarca';
}
