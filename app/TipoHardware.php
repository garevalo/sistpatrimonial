<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoHardware extends Model
{
    protected $fillable = ['tipo_hardware'];
    protected $primaryKey = 'id_tipo_hardware';


    public function hardware()
    {
        return $this->hasMany('App\Hardware');
    }
}
