<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $primaryKey = 'idmovimiento';
    
    protected $fillable = ['idbien','codinventario','codpatrimonial','imagen','centrocosto','idpersonal','idestado','valor','fecha_movimiento'];

    protected $dates = ['fecha_movimiento'];


    public function centrocosto()
	{
	    return $this->belongsTo('App\CentroCosto', 'centrocosto','codcentrocosto');
	}

	public function personal()
	{
	    return $this->belongsTo('App\Personal', 'idpersonal','idpersonal');
	}
}
