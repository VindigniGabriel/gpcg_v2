<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('oficina_tipo_id');
            $table->unsignedInteger('gerencia_id');
            $table->string('name');
            $table->string('alias');
            $table->string('tmo')->default('00:00');
            $table->string('ubicacion');
            $table->timeTz('lunes_in')->nullable();
            $table->timeTz('lunes_out')->nullable();
            $table->timeTz('martesviernes_in')->nullable();
            $table->timeTz('martesviernes_out')->nullable();
            $table->timeTz('sabados_in')->nullable();
            $table->timeTz('sabados_out')->nullable();
            $table->string('plantilla_e')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('oficinas');
    }
}
