<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name_phase',100);
            $table->longText('text_phase');
            $table->decimal('budget_phase',8,2);
            $table->decimal('sold_phase',8,2);
           /*  $table->integer('truckOfDirt');
            $table->integer('truckOfConcrete');
            $table->integer('truckOfMix'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phases');
    }
}
