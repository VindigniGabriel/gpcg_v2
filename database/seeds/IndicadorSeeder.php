<?php

use Illuminate\Database\Seeder;
use App\Indicador;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Indicador::query()->truncate();

        Indicador::create([
            'name' => 'Empresarial',
            'description' => 'Resultados Financieros',
            'min' => 7.00,
            'med' => 9.00,
            'max' => 10.00,
        ]);

        Indicador::create([
            'name' => 'HC',
            'description' => 'Horas de Conexión',
            'min' => 85.00,
            'med' => 100.00,
            'max' => 120.00,
        ]);

        Indicador::create([
            'name' => 'TPA',
            'description' => 'Tiempo Promedio de Atención',
            'min' => 85,
            'med' => 100,
            'max' => 120,
        ]);

        Indicador::create([
            'name' => 'Despacho',
            'description' => 'Porcentaje Despacho ST',
            'min' => 90.00,
            'med' => 95.00,
            'max' => 100.00,
        ]);

        Indicador::create([
            'name' => 'IGE',
            'description' => 'Indicador de Gestión del Ejecutivo',
            'min' => 90.00,
            'med' => 95.00,
            'max' => 100.00,
        ]);
    }
}
