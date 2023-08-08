<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('idClient',255);
            
            //ForeignKey Projects
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_projects');
    }
}
