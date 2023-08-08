<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentImagesTable extends Migration
{

    public function up()
    {
        Schema::create('payment_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('namePaymentImage',255);

            //ForeignKey Payment 
            $table->unsignedBigInteger('payment_fk');
            $table->foreign('payment_fk')
                ->references('id')->on('payments')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_images');
    }
}
