<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientwebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientwebs', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->timestamps();
            $table->string('nameClient',255);
            $table->string('emailClient',255)->unique();
            $table->string('phoneClient',255);
            $table->string('addressClient',255);

            //ForeignKey Service
            $table->unsignedBigInteger('service_fk');
            $table->foreign('service_fk')
                ->references('id')->on('services')
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
        Schema::dropIfExists('clientwebs');
    }
}
