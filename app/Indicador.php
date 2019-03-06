<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{
    use SoftDeletes;

    protected $fillable = ['name' , 'description', 'min', 'med', 'max'];

    protected $dates = ['deleted_at'];
    
    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'indicador_rols');
    }

    public function rxpindividuals()
    {
        return $this->hasMany('App\RxpIndividual');
    }

    public function indicadortipo()
    {
        return $this->belongsToMany('App\IndicadorTipo', 'indicador_rols')->withPivot('id', 'min', 'med', 'max');
    }

    public function personals()
    {
        return $this->hasMany('App\History');
    }

}
