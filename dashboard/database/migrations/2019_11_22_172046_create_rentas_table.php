<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->time('hora_solicitada');
            $table->string('cliente');
            $table->string('maquina');
            $table->date('fecha');
            $table->string('driver');
            $table->integer('duracion');
            $table->decimal('delivery',8,2);
            $table->integer('paymentStatus');
            $table->longText('paymentComments');

            //Relationships
            //ForeignKey Status
            $table->unsignedBigInteger('client_fk');
            $table->foreign('client_fk')
                ->references('id')->on('clientwebs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentas');
    }
}
