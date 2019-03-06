<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficinaTipo extends Model
{
    
    public function oficinas()
    {
        return $this->hasMany('App\Oficina');
    }

    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'oficina_tipo_rols');
    }
    
}
