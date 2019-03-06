<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervisor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'p00',
        'name',
        'phone',
        'email',
        'turno_id',
        'oficina_id'
    ];

    protected $dates = ['deleted_at'];

    public function turno()
    {
        return $this->belongsTo('App\Turno');
    }
    
    public function oficina()
    {
        return $this->belongsTo('App\Oficina');
    }
    
}
