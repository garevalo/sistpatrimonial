<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ConteoInventario extends Model
{
    protected $fillable 	= 	['idconteo','idbien','codcatalogo','codinventario','codpatrimonial','fecha_conteo','situacion','idinventario'];
    protected $primaryKey 	= 	'idconteo'; 
    protected $dates 		= 	['fecha_conteo'];

     public function Inventario()
    {
       return $this->belongsTo('App\Inventario', 'idinventario', 'idinventario');
    } 

    /*
    public function setFechaConteoAttribute($value)
    {
        $this->attributes['fecha_conteo'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    */

    public function getEstadoAttribute()
    {
    	if($this->attributes['situacion'] == 1){
    		return 'Conciliado';
    	}elseif($this->attributes['situacion'] == 2){
    		return 'Faltante';
    	}else {
    		return 'Sobrante';
    	}
    }
}
