<?php

use Illuminate\Database\Seeder;
use App\Gerencia;

class GerenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gerencia::query()->truncate();

        Gerencia::create([
            'direccion_id' => 1,
            'name' => 'Caracas Oeste',
            'titular' => 'Lasmy Pena',
            'alias' => 'Oeste',
            'email' => 'lp@movilnet.com.ve',
            'phone' => 4166123456
        ]);

        Gerencia::create([
            'direccion_id' => 1,
            'name' => 'Caracas Este',
            'titular' => 'Jose Este',
            'alias' => 'Este',
            'email' => 'je@movilnet.com.ve',
            'phone' => 4268645231
        ]);

        Gerencia::create([
            'direccion_id' => 1,
            'name' => 'Altos Mirandinos',
            'titular' => 'Maria Miranda',
            'alias' => 'Miranda',
            'email' => 'mm@movilnet.com.ve',
            'phone' => 4268954127
        ]);

        Gerencia::create([
            'direccion_id' => 1,
            'name' => 'Alto Valor',
            'titular' => 'Alexandra Valor',
            'alias' => 'Altv',
            'email' => 'av@movilnet.com.ve',
            'phone' => 4169845233
        ]);

    }
}
