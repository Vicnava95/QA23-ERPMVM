<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalFormsMachineri extends Migration
{
    public function up()
    {
        Schema::create('rental_forms_machineri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('rentalForm_fk');
            $table->foreign('rentalForm_fk')
                ->references('id')->on('rental_forms')
                ->onDelete('cascade');

            //ForeignKey Purchase Category
            $table->string('machinery_fk',255);
            $table->foreign('machinery_fk')
                ->references('id')->on('machineries')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rental_forms_machineri');
    }
}
