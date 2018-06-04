<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Inventario extends Model
{
	protected $primaryKey 	= 'idinventario';
	protected $fillable 	= ['idinventario','idpersonal','centrocosto','estado','fecha_desde','fecha_hasta'];
	protected $dates 		= ['fecha_desde','fecha_hasta'];

	public function CentroCosto()
    {
       return $this->belongsTo('App\CentroCosto', 'centrocosto', 'codcentrocosto');
    } 

    public function User()
    {
       return $this->belongsTo('App\User', 'idpersonal', 'id');
    } 

	public function setFechaDesdeAttribute($value)
    {
        $this->attributes['fecha_desde'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setFechaHastaAttribute($value)
    {
        $this->attributes['fecha_hasta'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getEstadoFormatAttribute()
    {
        return ($this->attributes['estado'] == 1 )? 'En Curso': 'Cerrado';
    }

    public function Conteo(){

        return $this->hasMany('App\ConteoInventario','idinventario','idinventario');
    }
   

}
