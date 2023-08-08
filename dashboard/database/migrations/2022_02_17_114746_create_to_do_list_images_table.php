<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToDoListImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_do_list_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameFileDocument',255);
            
            //Relationships
            //ForeignKey Time Line
            $table->unsignedBigInteger('timeLineWork_fk');
            $table->foreign('timeLineWork_fk')
                ->references('id')->on('time_line_project_works')
                ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('to_do_list_images');
    }
}
