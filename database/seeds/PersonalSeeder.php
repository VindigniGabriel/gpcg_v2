<?php

use Illuminate\Database\Seeder;
use App\Personal;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personal::query()->truncate();

        /*Personal::create([
            'p00' => 208090,
            'name' => 'Katiuska Fernandez'
        ]);

        Personal::create([
            'p00' => 205414,
            'name' => 'Gabriel Medina'
        ]);

        Personal::create([
            'p00' => 203045,
            'name' => 'Pedro Ejecutivo'
        ]);

        Personal::create([
            'p00' => 205433,
            'name' => 'Richard Rojas'
        ]);

        Personal::create([
            'p00' => 265443,
            'name' => 'Lorena Agostinone'
        ]);

        Personal::create([
            'p00' => 205544,
            'name' => 'Jordan Baez'
        ]);

        Personal::create([
            'p00' => 231233,
            'name' => 'Carmen Martinez'
        ]);

        Personal::create([
            'p00' => 203344,
            'name' => 'Maria Belen'
        ]);*/

        factory(Personal::class, 100)->create();
    }
}
