<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRxpCollectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rxp_collectives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id');
            $table->unsignedInteger('oficina_id');
            $table->decimal('porcentaje', 7, 2)->default(0.00);
            $table->unsignedInteger('month_id')->default(0.00);
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
        Schema::dropIfExists('rxp_collectives');
    }
}
