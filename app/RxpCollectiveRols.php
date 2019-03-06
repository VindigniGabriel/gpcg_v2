<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RxpCollectiveRols extends Model
{
    protected $fillable = [ 
        'rxp_collective_id',
        'rol_id',
        'porcentaje_value',
        ];
}
