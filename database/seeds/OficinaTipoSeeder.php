<?php

use Illuminate\Database\Seeder;
use App\OficinaTipo;

class OficinaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OficinaTipo::query()->truncate();

        OficinaTipo::create([
            'name' => 'Comercial'
        ]);

        OficinaTipo::create([
            'name' => 'Servicio'
        ]);

    }
}
