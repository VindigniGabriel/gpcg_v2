<?php

use Illuminate\Database\Seeder;
use App\Semana;

class SemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semana::query()->truncate();

        Semana::create([
            'name' => 'Domingo'
        ]);

        Semana::create([
            'name' => 'Lunes'
        ]);

        Semana::create([
            'name' => 'Martes'
        ]);

        Semana::create([
            'name' => 'Miercoles'
        ]);

        Semana::create([
            'name' => 'Jueves'
        ]);

        Semana::create([
            'name' => 'Viernes'
        ]);

        Semana::create([
            'name' => 'Sábado'
        ]);

    }
}
