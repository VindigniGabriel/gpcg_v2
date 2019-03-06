<?php

use Illuminate\Database\Seeder;
use App\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::query()->truncate();

        Day::create([
            'name' => 'Domingo'
        ]);

        Day::create([
            'name' => 'Lunes'
        ]);

        Day::create([
            'name' => 'Martes'
        ]);

        Day::create([
            'name' => 'Miercoles'
        ]);

        Day::create([
            'name' => 'Jueves'
        ]);

        Day::create([
            'name' => 'Viernes'
        ]);

        Day::create([
            'name' => 'Sábado'
        ]);

    }
}
