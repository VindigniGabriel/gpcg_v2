<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = [
        'month',
        'year_id'
    ];

    public function rxpindividuals()
    {
        return $this->hasMany('App\RxpIndividual');
    }
}
