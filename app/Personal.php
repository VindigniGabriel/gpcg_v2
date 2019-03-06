<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'p00',
        'name',
        'phone',
        'email',
        'date_in',
        'date_out'
    ];

    protected $dates = ['deleted_at'];
    
    public function oficina()
    {
        return $this->belongsTo('App\Oficina');
    }

    /*public function rol()
    {
        return $this->belongsTo('App\Rol');
    }*/

    /*public function esquemaRxp()
    {
        return $this->hasMany('App\RxpIndividual');
    }*/

    public function history()
    {
        return $this->hasMany('App\History')->orderBy('date_rol_in', 'desc');
    }

}
