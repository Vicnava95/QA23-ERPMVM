<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->decimal('amountPayment',8,2);
            $table->string('transactionDate',255);
            $table->string('details',255);
            $table->string('transaction',255);

            //ForeignKey Payment Method
            $table->unsignedBigInteger('paymentMethod_fk');
            $table->foreign('paymentMethod_fk')
                ->references('id')->on('payment_methods')
                ->onDelete('cascade');

            //ForeignKey Proyect
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
