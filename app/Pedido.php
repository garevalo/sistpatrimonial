<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $fillable = ['cc_solicitante','cc_destino','responsable','lugar','estado_pedido','fecha_entrega','descripcion'];
    protected $primaryKey = 'idpedido';

    protected $dates = ['fecha_entrega'];

    public function centroCostoSolicitante()
    {
       return $this->belongsTo('App\CentroCosto', 'cc_solicitante', 'codcentrocosto');
    } 

    public function CentroCostoDestino()
    {
       return $this->belongsTo('App\CentroCosto', 'cc_destino', 'codcentrocosto');
    } 

    public function PersonalResponsable()
    {
       return $this->belongsTo('App\Personal', 'responsable', 'idpersonal');
    } 

    public function articulo()
    {
        return $this->hasMany('App\Articulo','idpedido','idpedido');
    }



}
