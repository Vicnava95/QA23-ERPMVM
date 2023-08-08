<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('namePaymentMethod',255);
            $table->integer('namePaymentMethodStatus');
            //ALTER TABLE `payment_methods` ADD namePaymentMethodStatus integer;
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
