<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = ['cantidad','umedida','descripcion','idpedido','estado_articulo'];
    protected $primaryKey = 'idarticulos';


    public function GrupoGenericos()
    {
       return $this->belongsTo('App\Pedido', 'idpedido', 'idpedido');
    }
}
