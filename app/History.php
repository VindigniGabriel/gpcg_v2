<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'personal_id',
        'oficina_id',
        'rol_id',
        'date_rol_in',
        'date_rol_out',
        'active'
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function oficina()
    {
        return $this->belongsTo('App\Oficina');
    }

    public function personal()
    {
        return $this->belongsTo('App\Personal')->withTrashed();
    }

    public function esquemaRxp()
    {
        return $this->hasMany('App\RxpIndividual', 'history_id');
    }

    public function rxp()
    {
        return $this->hasMany('App\RxpIndividual', 'history_id');
    }

}
