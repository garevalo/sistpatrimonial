<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = ['idcatalogo','codcatalogo','denom_catalogo','idestado','cod_grupo_generico','cod_clase_generico'];
    protected $primaryKey = 'idcatalogo';

    public function grupos()
    {
       return $this->belongsTo('App\GrupoGenerico', 'cod_grupo_generico', 'cod_grupo_generico');
    }

    public function clases()
    {
       return $this->belongsTo('App\ClaseGenerico', 'cod_clase_generico', 'cod_clase_generico');
    }

    public function bien()
    {
        return $this->hasMany('App\Bien', 'codcatalogo','codcatalogo');
    }
}
