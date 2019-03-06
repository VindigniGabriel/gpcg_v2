<?php

use Illuminate\Database\Seeder;
use App\Supervisor;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supervisor::query()->truncate();

        Supervisor::create([
            'turno_id' => 1,
            'oficina_id' => 1,
            'p00' => 201456,
            'name' => 'Natacha Herrera',
            'phone' => 4166666666,
            'email' => 'nh@movilnet.com.ve'
        ]);

        Supervisor::create([
            'turno_id' => 2,
            'oficina_id' => 1,
            'p00' => 201589,
            'name' => 'Sandra Orozco',
            'phone' => 4167777777,
            'email' => 'so@movilnet.com.ve'
        ]);
    }
}
