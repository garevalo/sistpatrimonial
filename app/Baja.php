<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    protected $fillable = ['idlocal','idoficina','centrocosto','idpersonal','imagen','fechabaja','descripcion','idbien'];
    protected $primarykey = 'idbaja';
    protected $dates = ['fechabaja'];


    public function bien(){

    	return $this->belongsTo('App\Bien', 'idbien','idbien');

    }

}
