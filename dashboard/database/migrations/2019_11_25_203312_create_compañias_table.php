<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompañiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compañias', function (Blueprint $table) {
            $table->bigIncrements('id_comp');
            // $table->timestamps();
            $table->string('Name');
            $table->string('Addres_comp');
            $table->string('Compa_phone');
            $table->string('Email_comp');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compañias');
    }
}
