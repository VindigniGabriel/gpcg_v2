<?php

use Illuminate\Database\Seeder;
use App\Oficina;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Oficina::query()->truncate();

        Oficina::create([
            'oficina_tipo_id' => '1',
            'gerencia_id' => 1,
            'name' => 'Metrocenter',
            'alias' => 'OC20',
            'tmo' => '00:12:00',
            'ubicacion' => 'Centro Comercial Metrocenter',
            'lunes_in' => '08:00:00',
            'lunes_out' => '16:00:00',
            'martesviernes_in' => '08:00:00',
            'martesviernes_out' => '17:00:00',
            'sabados_in' => '08:00:00',
            'sabados_out' => '14:00:00',
            'plantilla_e' => 30
        ]);

        Oficina::create([
            'oficina_tipo_id' => '1',
            'gerencia_id' => 1,
            'name' => 'Recreo',
            'alias' => '0C15',
            'tmo' => '00:14:00',
            'ubicacion' => 'Centro Comercial El Recreo',
            'lunes_in' => '08:00:00',
            'lunes_out' => '16:00:00',
            'martesviernes_in' => '08:00:00',
            'martesviernes_out' => '17:00:00',
            'sabados_in' => '08:00:00',
            'sabados_out' => '14:00:00',
            'plantilla_e' => 30
        ]);

        Oficina::create([
            'oficina_tipo_id' => '1',
            'gerencia_id' => 2,
            'name' => 'Lido',
            'alias' => 'OC02',
            'tmo' => '00:10:00',
            'ubicacion' => 'Centro Comercial Lido',
            'lunes_in' => '08:00:00',
            'lunes_out' => '16:00:00',
            'martesviernes_in' => '08:00:00',
            'martesviernes_out' => '17:00:00',
            'sabados_in' => '08:00:00',
            'sabados_out' => '14:00:00',
            'plantilla_e' => 30
        ]);

        Oficina::create([
            'oficina_tipo_id' => '1',
            'gerencia_id' => 2,
            'name' => 'Sambil',
            'alias' => 'OC24',
            'tmo' => '00:18:00',
            'ubicacion' => 'Centro Comercial Sambil',
            'lunes_in' => '08:00:00',
            'lunes_out' => '16:00:00',
            'martesviernes_in' => '08:00:00',
            'martesviernes_out' => '17:00:00',
            'sabados_in' => '08:00:00',
            'sabados_out' => '14:00:00',
            'plantilla_e' => 30
        ]);
    }
}
