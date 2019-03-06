<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficina extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'oficina_tipo_id',
        'gerencia_id',
        'name',
        'alias',
        'tmo',
        'ubicacion'
    ];

    protected $dates = ['deleted_at'];

    public function gerencia()
    {
        return $this->belongsTo('App\Gerencia');
    }
    
    /*public function personals()
    {
        return $this->hasMany('App\Personal')->orderBy('rol_id');
    }*/

    public function history()
    {
        return $this->hasMany('App\History')->orderBy('rol_id');
    }

    public function supervisors()
    {
        return $this->hasMany('App\Supervisor');
    }
    
    public function oficinatipo()
    {
        return $this->belongsTo('App\OficinaTipo', 'oficina_tipo_id');
    }

    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'histories')->where('date_rol_out', null);
    }

}
