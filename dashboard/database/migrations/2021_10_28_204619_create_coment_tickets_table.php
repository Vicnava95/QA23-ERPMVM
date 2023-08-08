<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coment_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->longText('description');

            //Relationships
            //ForeignKey Permit Ticket
            $table->unsignedBigInteger('ticket_fk');
            $table->foreign('ticket_fk')
                ->references('id')->on('permit_tickets')
                ->onDelete('cascade');

            //ForeignKey User
            $table->unsignedBigInteger('user_fk');
            $table->foreign('user_fk')
                ->references('id')->on('users')
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
        Schema::dropIfExists('coment_tickets');
    }
}
