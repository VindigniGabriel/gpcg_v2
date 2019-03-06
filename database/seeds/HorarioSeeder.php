<?php

use Illuminate\Database\Seeder;
use App\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::query()->truncate();

        Horario::create([
            'oficina_id' => 1,
            'day_id' => 2,
            'hour_in' => '08:00',
            'hour_out' => '08:00'
        ]);

        Horario::create([
            'oficina_id' => 1,
            'day_id' => 3,
            'hour_in' => '08:00',
            'hour_out' => '08:00'
        ]);

        Horario::create([
            'oficina_id' => 1,
            'day_id' => 4,
            'hour_in' => '08:00',
            'hour_out' => '08:00'
        ]);

        Horario::create([
            'oficina_id' => 1,
            'day_id' => 5,
            'hour_in' => '08:00',
            'hour_out' => '08:00'
        ]);

        Horario::create([
            'oficina_id' => 1,
            'day_id' => 6,
            'hour_in' => '08:00',
            'hour_out' => '08:00'
        ]);

        
    }
}
