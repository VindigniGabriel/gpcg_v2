<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'year'
    ];
    
    public function months()
    {
        return $this->hasMany('App\Month');
    }
     
}
