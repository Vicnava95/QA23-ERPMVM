<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('description_purchase');
            $table->decimal('amount',8,2);
            $table->decimal('numberTruck',8,2);
            $table->string('date_purchase');

            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');

            //ForeignKey Purchase Category
            $table->unsignedBigInteger('purchase_categorie_fk');
            $table->foreign('purchase_categorie_fk')
                ->references('id')->on('purchase_categories')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('phase_fk')->nullable();
            $table->foreign('phase_fk')
                ->references('id')->on('phases')
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
        Schema::dropIfExists('purchases');
    }
}
