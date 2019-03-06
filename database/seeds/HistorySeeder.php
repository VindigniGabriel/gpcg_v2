<?php

use Illuminate\Database\Seeder;
use App\History;
use App\Personal;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        History::truncate();

        /*History::create([
            'personal_id' => 1, 
            'oficina_id' => 1,
            'rol_id' => 1,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 2, 
            'oficina_id' => 1,
            'rol_id' => 5,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 3, 
            'oficina_id' => 1,
            'rol_id' => 1,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 4, 
            'oficina_id' => 1,
            'rol_id' => 5,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 5, 
            'oficina_id' => 1,
            'rol_id' => 3,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 6, 
            'oficina_id' => 1,
            'rol_id' => 3,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 7, 
            'oficina_id' => 1,
            'rol_id' => 4,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);

        History::create([
            'personal_id' => 8, 
            'oficina_id' => 1,
            'rol_id' => 4,
            'date_rol_in' => '2019-01-08',
            'active' => 1
        ]);*/

        factory(History::class, 100)->create([
            'rol_id' => 1,
            'active' => 1
        ]);

    }
}
