<?php

use Illuminate\Database\Seeder;
use App\Turno;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::query()->truncate();

        Turno::create([
            'name' => 'AM'
        ]);

        Turno::create([
            'name' => 'PM'
        ]);
    }
}
