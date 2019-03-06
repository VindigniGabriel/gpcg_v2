<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DireccionSeeder::class);
        $this->call(GerenciaSeeder::class);
        $this->call(OficinaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(IndicadorSeeder::class);
        $this->call(IndicadorTipoSeeder::class);
        $this->call(PersonalSeeder::class);
        $this->call(IndicadorRolSeeder::class);
        $this->call(TurnoSeeder::class);
        //$this->call(SupervisorSeeder::class);
        $this->call(OficinaTipoRolSeeder::class);
        $this->call(OficinaTipoSeeder::class);
        //$this->call(DaySeeder::class);
        //$this->call(HorarioSeeder::class);
        $this->call(HistorySeeder::class);
        $this->call(GoalRxpSeeder::class);
    }
}
