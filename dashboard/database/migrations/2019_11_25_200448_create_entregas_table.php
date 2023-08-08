<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->bigIncrements('id_Renta');
            $table->time('Delivery_time');
            $table->integer('Machine_time');
            $table->integer('Gas');
            $table->time('Pick_up_time');
            $table->integer('Mt_at_pick_up');
            $table->integer('Gas_at_pick_up');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entregas');
    }
}
