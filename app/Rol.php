<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function indicadors()
    {
        return $this->belongsToMany('App\Indicador', 'indicador_rols')->withPivot('id', 'indicador_tipo_id', 'min', 'med', 'max');
    }

    public function personals()
    {
        return $this->hasMany('App\History');
    }

    public function oficinas()
    {
        return $this->belongsToMany('App\Oficina', 'oficina_rols');
    }

    public function oficinatipos()
    {
        return $this->belongsToMany('App\OficinaTipo', 'oficina_tipo_rols');
    }

    public function sumaesquema($rol, $value)
    {
        $min = IndicadorRol::where('rol_id', $rol)
                            ->sum('min') + Indicador::where('name', 'Empresarial')->first()->min;

        $med = IndicadorRol::where('rol_id', $rol)
                            ->sum('med') + Indicador::where('name', 'Empresarial')->first()->med;

        $max = IndicadorRol::where('rol_id', $rol)
                            ->sum('max') + Indicador::where('name', 'Empresarial')->first()->max;

        if ($value >= $max) {
        return '30';
        }elseif($med <= $value && $value < $max){
        return '25';
        }elseif($min <= $value && $value < $med){
            return '20';
        }elseif($value < $min){
            return '0';
        };          

    }   

}
