<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('category_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameCategory',255);

            //ForeignKey General Status
            $table->unsignedBigInteger('generalStatus_fk');
            $table->foreign('generalStatus_fk')
                ->references('id')->on('general_statuses')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_expenses');
    }
}
