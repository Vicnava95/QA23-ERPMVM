<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageDailyReportsTable extends Migration
{
    public function up()
    {
        Schema::create('image_daily_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameImageDailyReport',255);

            //ForeignKey Daily Report
            $table->unsignedBigInteger('dailyReport_fk');
            $table->foreign('dailyReport_fk')
                    ->references('id')->on('daily_reports')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_daily_reports');
    }
}
