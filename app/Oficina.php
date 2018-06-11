<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = ['idoficina','oficina','idlocal'];
    protected $primaryKey = 'idoficina';


    public function local(){
    	return $this->belongsTo('App\Local', 'idlocal', 'idlocal');
    }
}
