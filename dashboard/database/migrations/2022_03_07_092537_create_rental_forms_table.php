<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalFormsTable extends Migration
{

    public function up()
    {
        Schema::create('rental_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameFormRental',255);
            $table->string('phoneFormRental',255);
            $table->string('deliveryAddressFormRental',255);
            $table->string('deliveryDateFormRental',255);
            $table->string('estimatedDateFormRental',255);
            $table->string('deliveryNote',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rental_forms');
    }
}
