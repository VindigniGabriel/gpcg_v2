<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRxpCollectiveRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rxp_collective_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rxp_collective_id');
            $table->unsignedInteger('rol_id');
            $table->decimal('porcentaje_value', 7, 2)->nullable();
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
        Schema::dropIfExists('rxp_collective_rols');
    }
}
