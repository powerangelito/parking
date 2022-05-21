<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in_outs', function (Blueprint $table) {
            $table->id();
            $table->string("id_car");
            $table->dateTime("fecha_entrada");
            $table->dateTime("fecha_salida")->nullable();
            $table->boolean("activo")->nullable();
            $table->boolean("estancia")->nullable();
            $table->integer("acumulado")->nullable();
            $table->integer("importe")->nullable();
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
        Schema::dropIfExists('check_in_outs');
    }
}
