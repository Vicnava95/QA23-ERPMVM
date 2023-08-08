<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeLineProjectWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_line_project_works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('timeLineTitle',255);
            $table->string('timeLineComment',255);
            $table->string('timeLineDate',255);

            //Relationships
            //ForeignKey Time Line
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('time_line_project_works');
    }
}
