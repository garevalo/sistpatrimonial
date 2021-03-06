<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subgerencia extends Model
{
    protected $fillable = ['idsubgerencia','subgerencia','centrocosto'];
    protected $primaryKey = 'idsubgerencia';

    public function gerencia()
    {
        return $this->belongsTo('App\Gerencia', 'idgerencia', 'idgerencia');
    }
}
