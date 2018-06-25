<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $primaryKey = 'idmovimiento';
    
    protected $fillable = ['idbien','codinventario','codpatrimonial','imagen','centrocosto','idpersonal','idestado','valor','fecha_movimiento','desde_centrocosto','desde_personal','desde_local','desde_oficina','idtransferencia'];

    protected $dates = ['fecha_movimiento'];


    public function centrocosto_origen()
	{
	    return $this->belongsTo('App\CentroCosto', 'desde_centrocosto' ,'codcentrocosto');
	}

	public function personal_origen()
	{
	    return $this->belongsTo('App\Personal','desde_personal','idpersonal');
	}

	public function centrocosto_destino()
	{
	    return $this->belongsTo('App\CentroCosto', 'centrocosto','codcentrocosto');
	}

	public function personal()
	{
	    return $this->belongsTo('App\Personal', 'idpersonal','idpersonal');
	}

	public function bien()
	{
	    return $this->belongsTo('App\Bien', 'idbien','idbien');
	}
}