<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTrucksTable extends Migration
{
    public function up()
    {
        Schema::create('daily_trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameTypeTruck',255);
            $table->string('categoryTypeTruck',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_trucks');
    }
}
