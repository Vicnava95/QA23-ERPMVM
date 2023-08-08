<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralStatusesTable extends Migration
{

    public function up()
    {
        Schema::create('general_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameGeneralStatus',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_statuses');
    }
}
