<?php

use Illuminate\Database\Seeder;
use App\IndicadorRol;

class IndicadorRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndicadorRol::query()->truncate();

        IndicadorRol::create([
            'indicador_id' => 2,
            'indicador_tipo_id' => 1,
            'rol_id' => 1,
            'min' => 17.00,
            'med' => 21.00,
            'max' => 25.00
        ]);

        IndicadorRol::create([
            'indicador_id' => 3,
            'indicador_tipo_id' => 1,
            'rol_id' => 1,
            'min' => 10.00,
            'med' => 12.50,
            'max' => 15.00
        ]);

        IndicadorRol::create([
            'indicador_id' => 5,
            'indicador_tipo_id' => 2,
            'rol_id' => 1,
            'min' => 7.00,
            'med' => 9.50,
            'max' => 10.00
        ]);

        IndicadorRol::create([
            'indicador_id' => 4,
            'indicador_tipo_id' => 1,
            'rol_id' => 5,
            'min' => 10.00,
            'med' => 13.00,
            'max' => 15.00
        ]);

        IndicadorRol::create([
            'indicador_id' => 5,
            'indicador_tipo_id' => 2,
            'rol_id' => 5,
            'min' => 7.00,
            'med' => 9.50,
            'max' => 10.00
        ]);

    }
}
