<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoGenerico extends Model
{
    protected $fillable = ['id_grupogenerico','grupogenerico'];
    protected $primaryKey = 'id_grupogenerico';

    public function ClaseGenerico()
    {
       return $this->belongsTo('App\ClaseGenerico', 'idmarca', 'idmarca');
    }

    public function ClaseGenericos()
    {
        return $this->hasMany('App\ClaseGenerico');
    }
}
