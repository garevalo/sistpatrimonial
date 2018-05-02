<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ['idproveedor','razon_social','telefono','ruc','direccion'];

    protected $primaryKey = 'idproveedor';
}
