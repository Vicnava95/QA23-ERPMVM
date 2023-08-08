<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('courier',255);
            $table->string('recipientsName',255);
            $table->int('tracking',255);
            $table->string('permitDocument',255);
            $table->string('dateSend',255);
            $table->string('dateReceived',255);
            $table->bool('certifiedMail');
            $table->string('certificationNumber',255); 

            //ForeignKey Permit Documents
            $table->unsignedBigInteger('permitDocuments_fk');
            $table->foreign('permitDocuments_fk')
                ->references('id')->on('permit_documents')
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
        Schema::dropIfExists('mails');
    }
}
