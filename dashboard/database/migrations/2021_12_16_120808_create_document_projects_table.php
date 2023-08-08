<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('document_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameFileDocument',255);
            
            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_projects');
    }
}
