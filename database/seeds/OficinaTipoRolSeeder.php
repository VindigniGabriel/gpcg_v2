<?php

use Illuminate\Database\Seeder;
use App\OficinaTipoRol;

class OficinaTipoRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OficinaTipoRol::query()->truncate();

        OficinaTipoRol::create([
            'oficina_tipo_id' => 1,
            'rol_id' => 1,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 1,
            'rol_id' => 3,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 1,
            'rol_id' => 4,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 1,
            'rol_id' => 5,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 2,
            'rol_id' => 2,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 2,
            'rol_id' => 3,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 2,
            'rol_id' => 4,
        ]);

        OficinaTipoRol::create([
            'oficina_tipo_id' => 2,
            'rol_id' => 6,
        ]);
    }
}
