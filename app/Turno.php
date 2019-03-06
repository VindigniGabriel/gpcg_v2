<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    public function supervisors()
    {
        return $this->hasMany('App\Supervisor');
    }
}
