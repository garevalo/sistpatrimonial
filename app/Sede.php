<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = ['idsede','sede','direccion'];
    protected $primaryKey = 'idsede';

    /*public function gerencias()
    {
        return $this->hasMany('App\Gerencia');
    }*/

}
