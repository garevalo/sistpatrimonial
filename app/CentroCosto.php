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
}
