<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToDisponibilidads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disponibilidads', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->bigInteger("id_renta")->unsigned()->nullable(false);
            $table->foreign('id_renta')->references('id')->on('rentas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disponibilidads', function (Blueprint $table) {
            //
        });
    }
}
