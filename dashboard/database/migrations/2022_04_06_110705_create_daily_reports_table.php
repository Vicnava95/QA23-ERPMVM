<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyReportsTable extends Migration
{
    
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('dateDailyReport',255);
            $table->string('statusDailyReport',255);
            $table->string('erpStatus',255);
            $table->longText('comments');
            $table->integer('projectPhase');

            //ForeignKey Project
            $table->unsignedBigInteger('projects_fk');
            $table->foreign('projects_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_reports');
    }
}
