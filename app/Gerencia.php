<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gerencia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'direccion_id',
        'name',
        'titular',
        'alias',
        'phone',
        'email'
    ];

    protected $dates = ['deleted_at'];

    public function direccion()
    {
        return $this->belongsTo('App\Direccion');
    }

    public function oficinas()
    {
        return $this->hasMany('App\Oficina');
    }

    public function personals()
    {
        return $this->hasManyThrough('App\Personal', 'App\Oficina');
    }
}
