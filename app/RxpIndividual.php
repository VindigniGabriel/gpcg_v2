<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RxpIndividual extends Model
{
    protected $fillable = [ 
        'indicador_id',
        'porcentaje',
        'history_id',
        'porcentaje_value',
        'month_id' 
        ];
    //

    
    public function indicador()
    {
        return $this->belongsTo('App\Indicador');
    }

    public function history()
    {
        return $this->belongsTo('App\History');
    }

    public function time()
    {
        return $this->hasOne('App\AverageOperatingTime');
    }

}
