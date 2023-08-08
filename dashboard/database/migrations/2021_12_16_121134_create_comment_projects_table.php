<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('comment_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->longText('commentProject');

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
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_projects');
    }
}
