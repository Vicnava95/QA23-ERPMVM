<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTruckTable extends Migration
{
    public function up()
    {
        Schema::create('report_truck', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('quantityDailyTruck');
            $table->decimal('priceDailyTruck',8,2);
            $table->string('nameProviderTruck',255);
            $table->string('commentsDailyTruck',255);

            //ForeignKey Daily Report
            $table->unsignedBigInteger('dailyReport_fk');
            $table->foreign('dailyReport_fk')
                ->references('id')->on('daily_reports')
                ->onDelete('cascade');

            //ForeignKey Daily Truck
            $table->unsignedBigInteger('dailyTruck_fk');
            $table->foreign('dailyTruck_fk')
                ->references('id')->on('daily_trucks')
                ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('report_truck');
    }
}
