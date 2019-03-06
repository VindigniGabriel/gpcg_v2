<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RxpCollective extends Model
{
    protected $fillable = [
        'indicador_id',
        'oficina_id',
        'porcentaje',
        'month_id'
    ];


    public function indicador()
    {
        return $this->belongsTo('App\Indicador');
    }

    public function oficina()
    {
        return $this->belongsTo('App\Oficina');
    }

    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'rxp_collective_rols')->withPivot('porcentaje_value', 'id');
    }

    public function month()
    {
        return $this->belongsTo('App\Month');
    }
}
