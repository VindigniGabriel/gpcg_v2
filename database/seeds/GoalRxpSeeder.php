<?php

use Illuminate\Database\Seeder;
use App\GoalRxp;

class GoalRxpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoalRxp::truncate();

        GoalRxp::create([
            'name' => 'Sin Logro'
        ]);

        GoalRxp::create([
            'name' => 'Meta Mínima'
        ]);

        GoalRxp::create([
            'name' => 'Meta Media'
        ]);

        GoalRxp::create([
            'name' => 'Meta Máxima'
        ]);
    }
}
