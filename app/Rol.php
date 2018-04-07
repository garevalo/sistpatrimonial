<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $primaryKey = 'idrol';
    protected $table = 'roles';
    protected $fillable = ['rol'];
}
