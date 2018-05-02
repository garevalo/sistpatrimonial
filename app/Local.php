<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = ['idlocal','local'];

    protected $primaryKey = 'idlocal';
}
