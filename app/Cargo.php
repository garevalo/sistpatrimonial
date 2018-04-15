<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['idcargo','cargo'];
    protected $primaryKey = 'idcargo';
    public function personals()
    {
        return $this->hasMany('App\Personal');
    }
}
