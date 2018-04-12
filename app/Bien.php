<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $primaryKey = 'idbien';
    
    protected $fillable = ['codinventario','codpatrimonial','ordencompra','denominacion','idmarca','idmodelo','numserie','idestado','idadquisicion','fecha_adquision','descripcion'];

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
}
