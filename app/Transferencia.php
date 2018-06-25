<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $fillable = ['idtransferencia','cc_origen','personal_origen','cc_destino','personal_destino'];
    protected $primarykey = 'idtransferencia';


    public function CentrocostoOrigen()
	{
	    return $this->belongsTo('App\CentroCosto', 'cc_origen' ,'codcentrocosto');
	}

	public function PersonalOrigen()
	{
	    return $this->belongsTo('App\Personal','personal_origen','idpersonal');
	}

	public function CentrocostoDestino()
	{
	    return $this->belongsTo('App\CentroCosto', 'cc_destino','codcentrocosto');
	}

	public function PersonalDestino()
	{
	    return $this->belongsTo('App\Personal', 'personal_destino','idpersonal');
	}

	public function movimiento(){
		return $this->hasMany('App\Movimiento','idtransferencia','idtransferencia');
	}

}
