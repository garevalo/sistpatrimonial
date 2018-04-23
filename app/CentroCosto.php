<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    protected $primaryKey = "idcentrocosto";
    protected $fillable = ['codcentrocosto','centrocosto'];
}
