<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminExpensesImagesTable extends Migration
{
    public function up()
    {
        Schema::create('admin_expenses_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('imageName',255);

            //ForeignKey General Status
            $table->unsignedBigInteger('adminExpenses_fk');
            $table->foreign('adminExpenses_fk')
                ->references('id')->on('admin_expenses')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_expenses_images');
    }
}
