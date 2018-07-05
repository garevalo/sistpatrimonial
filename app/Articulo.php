<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = ['cantidad','umedida','idbien','idpedido','estado_articulo','updated_at'];
    protected $primaryKey = 'idarticulos';
   

    public function GrupoGenericos()
    {
       return $this->belongsTo('App\Pedido', 'idpedido', 'idpedido');
    }

    public function bien(){
    	return $this->hasOne('App\Bien','idbien','idbien');
    }
}
