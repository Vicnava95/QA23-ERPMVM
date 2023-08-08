<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyLaborsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_labors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameDailyLabor',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_labors');
    }
}
