<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $fillable=['idtipo_software','arquitectura','service_pack','fecha_adquisicion','id_activo_software','nombre_software','licencia'];
    protected  $primaryKey = 'idsoftware';

    protected $dates = ['fecha_adquisicion'];

    public function tiposoftware()
    {
        return $this->belongsTo('App\TipoSoftware', 'idtipo_software', 'id_tipo_software');
    }

     public function activo()
	{
	    return $this->belongsTo('App\Activo', 'id_activo_software','idactivo');
	}
}
