<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
	protected $table = 'centro_costos';
    protected $primaryKey = "id";
    protected $fillable = ['codcentrocosto','centrocosto','idgerencia','idsubgerencia','idlocal','idpersonal'];
    
    public function getFullCentroCostoAttribute()
    {
        return ucfirst($this->codcentrocosto) . ' - ' . ucfirst($this->centrocosto);
    }

    public function gerencia()
    {
       return $this->belongsTo('App\Gerencia', 'idgerencia', 'idgerencia');
    }

    public function subgerencia()
	{
	    return $this->belongsTo('App\Subgerencia', 'idsubgerencia','idsubgerencia');
	}

	public function local()
	{
	    return $this->belongsTo('App\Local', 'idlocal','idlocal');
	}

	public function personal()
	{
	    return $this->belongsTo('App\Personal', 'idpersonal','idpersonal');
	}

}
