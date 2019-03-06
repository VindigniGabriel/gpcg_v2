<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HourConnection extends Model
{
    protected $fillable = [
        'rxp_individual_id',
        'time'
    ];
}
