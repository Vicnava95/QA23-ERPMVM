<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaildocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maildocuments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('referenceMailDocument',255);

            $table->unsignedBigInteger('mail_fk');
            $table->foreign('mail_fk')
                ->references('id')->on('mails')
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
        Schema::dropIfExists('maildocuments');
    }
}
