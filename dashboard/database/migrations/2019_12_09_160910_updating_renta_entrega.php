<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatingRentaEntrega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rentas', function (Blueprint $table) {
            $table->dropColumn('id_entrega');

        });
        Schema::table('entregas', function (Blueprint $table) {
            $table->bigInteger('id_renta',false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //        database/migrations/2019_12_09_160910_updating_renta_entrega.php
    }
}
