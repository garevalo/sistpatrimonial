<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $fillable = ['fecha_adquisicion','estado_activo','tipo_activo','asignado','orden_compra'];
    protected $primaryKey = "idactivo";
    protected $dates = ['fecha_adquisicion'];

    public function hardware()
    {
        return $this->hasOne('App\Hardware','id_activo_hardware', 'idactivo');
    }

    public function software()
    {
        return $this->hasOne('App\Software','id_activo_software', 'idactivo');
    }

    public function personals_activos()
    {
        return $this->hasMany('App\personals_activos','activos_id', 'idactivo');
    }


}
