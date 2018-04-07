<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personals_activos extends Model
{
    protected $fillable = ['activos_id','personals_idpersonal','fecha_asignacion'];
    protected $primaryKey = 'id_personals_activos';

    public function activo()
    {
        return $this->belongsTo('App\Activo', 'id_personals_activos','idactivo');
    }


}
