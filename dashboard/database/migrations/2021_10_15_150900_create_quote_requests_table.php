<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name',255);
            $table->string('address',255);
            $table->string('phone',255);
            $table->string('email',255);

            //ForeignKey Projects
            $table->unsignedBigInteger('service_fk');
            $table->foreign('service_fk')
                ->references('id')->on('services')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_requests');
    }
}
