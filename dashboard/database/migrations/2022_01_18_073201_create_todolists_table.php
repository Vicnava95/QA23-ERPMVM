<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodolistsTable extends Migration
{
    public function up()
    {
        Schema::create('todolists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('todoComment',255);
            $table->string('todoDate',255);
            $table->string('todoTitle',255);

            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
                
            //ForeignKey User
            $table->unsignedBigInteger('user_fk');
            $table->foreign('user_fk')
                ->references('id')->on('users')
                ->onDelete('cascade');

            //ForeignKey General Status
            $table->unsignedBigInteger('generalStatus_fk');
            $table->foreign('generalStatus_fk')
                ->references('id')->on('general_statuses')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('todolists');
    }
}
