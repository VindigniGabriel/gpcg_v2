<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AverageOperatingTime extends Model
{
    protected $fillable = [
        'rxp_individual_id',
        'time'
    ];
}
