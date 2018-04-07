<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSoftware extends Model
{
    protected $fillable = ['tipo_software'];
    protected $primaryKey = 'id_tipo_software';


    public function hardware()
    {
        return $this->hasMany('App\Software');
    }
}
