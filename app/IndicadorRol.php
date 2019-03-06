<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicadorRol extends Model
{
    protected $fillable = [
        'indicador_id',
        'rol_id',
        'indicador_tipo_id',
        'min',
        'med',
        'max'
    ];

    public function indicadortipo()
    {
        return $this->belongsTo('App\IndicadorTipo', 'indicador_tipo_id');
    }

}
