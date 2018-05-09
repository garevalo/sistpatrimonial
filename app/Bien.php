<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $primaryKey = 'idbien';
    
   protected $fillable = ['codcatalogo','codinventario','codpatrimonial','ordencompra','idmarca','idmodelo','idcolor','imagen','numserie','centrocosto','idpersonal','idestado','valor','idadquisicion','fecha_adquisicion','descripcion'];

    protected $dates = ['fecha_adquisicion'];


    public function marca()
    {
       return $this->belongsTo('App\Marca', 'idmarca', 'idmarca');
    }

    public function modelo()
	{
	    return $this->belongsTo('App\Modelo', 'idmodelo','idmodelo');
	}

	public function color()
	{
	    return $this->belongsTo('App\Color', 'idcolor','idcolor');
	}

	public function adquisicion()
	{
	    return $this->belongsTo('App\Adquisicion', 'idadquisicion','idadquisicion');
	}

	public function centrocostos()
	{
	    return $this->belongsTo('App\CentroCosto', 'centrocosto','codcentrocosto');
	}

	public function personal()
	{
	    return $this->belongsTo('App\Personal', 'idpersonal','idpersonal');
	}

	public function catalogo()
	{
	    return $this->belongsTo('App\Catalogo', 'codcatalogo','codcatalogo');
	}

	public function movimientos()
    {
        return $this->hasMany('App\Movimiento','idbien','idbien');
    }
}
