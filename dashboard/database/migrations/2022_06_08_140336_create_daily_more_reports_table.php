<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMoreReportsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_more_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameMoreReport',255);
            $table->decimal('amountMoreReport',8,2);
            $table->string('descriptionMoreReport',255);
            //Datos aceptados ExtraLabor y Subcontractor
            $table->string('typeMoreReport',255);

            //ForeignKey Daily Report
            $table->unsignedBigInteger('dailyReport_fk');
            $table->foreign('dailyReport_fk')
                ->references('id')->on('daily_reports')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_more_reports');
    }
}
