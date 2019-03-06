<?php

use Illuminate\Database\Seeder;
use App\IndicadorTipo;

class IndicadorTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndicadorTipo::query()->truncate();

        IndicadorTipo::create([
            'name' => 'Individual',
            'peso' => 40.00
        ]);

        IndicadorTipo::create([
            'name' => 'Colectivo',
            'peso' => 50.00
        ]);

        IndicadorTipo::create([
            'name' => 'Empresarial',
            'peso' => 10.00
        ]);
    }
}
