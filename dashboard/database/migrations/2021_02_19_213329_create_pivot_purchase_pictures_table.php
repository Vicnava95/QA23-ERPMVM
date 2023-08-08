<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotPurchasePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_purchase_pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade');

            //ForeignKey Purchase Category
            $table->unsignedBigInteger('purchase_picture_id');
            $table->foreign('purchase_picture_id')
                ->references('id')->on('purchase_pictures')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_purchase_pictures');
    }
}
