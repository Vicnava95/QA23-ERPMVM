<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientwebServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientweb_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //Relationships
            $table->unsignedBigInteger('clientweb_id');
            $table->foreign('clientweb_id')
                ->references('id')->on('clientwebs')
                ->onDelete('cascade');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')
                ->references('id')->on('services')
                ->onDelete('cascade');

            $table->unsignedBigInteger('client_source_id');
            $table->foreign('client_source_id')
                ->references('id')->on('client_sources')
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
        Schema::dropIfExists('clientweb_service');
    }
}
