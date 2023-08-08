<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('referenceDocumentPermit',255);
            $table->bool('checkList'); 
            $table->integer('typeDocumentPermit');

            //Relationships
            //ForeignKey Permit Ticket
            $table->unsignedBigInteger('ticket_fk');
            $table->foreign('ticket_fk')
                ->references('id')->on('permit_tickets')
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
        Schema::dropIfExists('permit_documents');
    }
}
