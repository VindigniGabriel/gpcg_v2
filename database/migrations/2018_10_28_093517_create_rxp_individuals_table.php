<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRxpIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rxp_individuals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id');
            $table->unsignedInteger('history_id');
            $table->decimal('porcentaje', 7, 2)->default(0.00);
            $table->decimal('porcentaje_value', 7, 2)->default(0.00);
            $table->unsignedInteger('month_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rxp_individuals');
    }
}
