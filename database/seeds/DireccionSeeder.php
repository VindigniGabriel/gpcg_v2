<?php

use Illuminate\Database\Seeder;
use App\Direccion;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direccion::query()->truncate();

        Direccion::create([
            'name' => 'Dir. Gran Caracas',
            'titular' => 'Jesús Colmenares',
            'alias' => 'Caracas',
            'phone' => 4166123434,
            'email' => 'jc@movilnet.com.ve'
        ]);

        Direccion::create([
            'name' => 'Dir. Occidente',
            'titular' => 'Maria Occidente',
            'alias' => 'Occidente',
            'phone' => 4166133344,
            'email' => 'mo@movilnet.com.ve'
        ]);
    }
}
