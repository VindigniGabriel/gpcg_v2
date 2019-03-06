<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicadorTipo extends Model
{
    public function indicadorrols()
    {
        return $this->hasMany('App\IndicadorRol');
    }

    public function indicadors()
    {
        return $this->belongsToMany('App\Indicador', 'indicador_rols');
    }

}
