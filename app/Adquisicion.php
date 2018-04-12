<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adquisicion extends Model
{
    protected $fillable = ['idadquisicion','adquisicion'];
    protected $primaryKey = 'idadquisicion';
}
