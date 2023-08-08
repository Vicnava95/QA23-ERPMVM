<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingPickupTable extends Migration
{

    public function up()
    {
        Schema::create('recording_pickup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recordingDate',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recording_pickup');
    }
}
