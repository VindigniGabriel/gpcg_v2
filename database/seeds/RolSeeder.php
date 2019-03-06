<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::query()->truncate();

        Rol::Create([
            'name' => 'EIAC',
            'Description' => 'Ejecutivo de Atención al Cliente'
        ]);


        Rol::Create([
            'name' => 'EIAE',
            'Description' => 'Ejecutivo de Atención Especializada'
        ]);


        Rol::Create([
            'name' => 'EDQ',
            'Description' => 'Especialista de Operaciones Comerciales Qmatic'
        ]);

        Rol::Create([
            'name' => 'EDS',
            'Description' => 'Especialista de Operaciones Comerciales Servicio'
        ]);

        Rol::Create([
            'name' => 'EDH',
            'Description' => 'Especialista de Operaciones Comerciales Homologador'
        ]);

        Rol::Create([
            'name' => 'EDHS',
            'Description' => 'Especialista de Operaciones Comerciales Homologador Servicio'
        ]);

        
    }
}
