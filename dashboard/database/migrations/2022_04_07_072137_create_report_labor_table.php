<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportLaborTable extends Migration
{
    public function up()
    {
        Schema::create('report_labor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //ForeignKey Daily Report
            $table->unsignedBigInteger('dailyReport_fk');
            $table->foreign('dailyReport_fk')
                ->references('id')->on('daily_reports')
                ->onDelete('cascade');

            //ForeignKey Daily Labor
            $table->unsignedBigInteger('dailyLabor_fk');
            $table->foreign('dailyLabor_fk')
                ->references('id')->on('daily_labors')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_labor');
    }
}
