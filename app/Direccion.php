<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'titular',
        'phone',
        'email',
        'alias'
    ];

    protected $dates = ['deleted_at'];

    public function gerencias()
    {
        return $this->hasMany('App\Gerencia');
    }


    public function oficinas()
    {
        return $this->hasManyThrough('App\Oficina', 'App\Gerencia');
    }
    
}
