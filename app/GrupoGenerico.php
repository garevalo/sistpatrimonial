<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;


class GrupoGenerico extends Model
{

	use FormAccessible;

    protected $fillable = ['idgrupogenerico','cod_grupo_generico','grupo_generico'];
    protected $primaryKey = 'idgrupogenerico';


    public function ClaseGenericos()
    {
        return $this->hasMany('App\ClaseGenerico','cod_grupo_generico','cod_grupo_generico');
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    /**
     * Get the user's first name for forms.
     *
     * @param  string  $value
     * @return string
     */
    public function formDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
