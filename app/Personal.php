<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = ['nombres','apellido_paterno','apellido_materno','dni','idgerencia_personal','idcargo_personal','idsubgerencia_personal','idsede_personal'];
    protected $primaryKey = 'idpersonal';

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'idsede_personal', 'idsede');
    }

    public function gerencia()
    {
        return $this->belongsTo('App\Gerencia', 'idgerencia_personal', 'idgerencia');
    }

    public function subgerencia()
    {
        return $this->belongsTo('App\Subgerencia', 'idsubgerencia_personal', 'idsubgerencia');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo', 'idcargo_personal', 'idcargo');
    }


}
