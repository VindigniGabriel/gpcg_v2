<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id');
            $table->unsignedInteger('indicador_tipo_id');
            $table->unsignedInteger('rol_id');
            $table->decimal('min', 5, 2);
            $table->decimal('med', 5, 2);
            $table->decimal('max', 5, 2);
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
        Schema::dropIfExists('indicadors_rol');
    }
}
