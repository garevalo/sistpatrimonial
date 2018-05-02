<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaseGenerico extends Model
{
    protected $fillable = ['idclasegenerico','cod_clase_generico','clase_generico','cod_grupo_generico'];
    protected $primaryKey = 'idclasegenerico';


    public function GrupoGenericos()
    {
       return $this->belongsTo('App\GrupoGenerico', 'cod_grupo_generico', 'cod_grupo_generico');
    }


}
