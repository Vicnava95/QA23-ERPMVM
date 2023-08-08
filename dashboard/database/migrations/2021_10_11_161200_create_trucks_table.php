<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->decimal('yards',8,2);
            $table->string('description',255);
            //Import
            $table->integer('importDirt',255);
            $table->integer('importAsphalt',255);
            $table->integer('importAggregates',255);
            $table->integer('importBase',255);
            $table->integer('importGravell',255);
            $table->integer('purchaseImportDirt',255);
            $table->integer('purchaseImportAsphalt',255);
            $table->integer('purchaseImportAggregates',255);
            $table->integer('purchaseImportBase',255);
            $table->integer('purchaseImportGravell',255);
            //Export
            $table->integer('exportDirtRock',255);
            $table->integer('exportAsphalt',255);
            $table->integer('exportDirt',255);
            $table->integer('exportConcrete',255);
            $table->integer('exportMixed',255);
            $table->integer('purchaseExportDirtRock',255);
            $table->integer('purchaseExportAsphalt',255);
            $table->integer('purchaseExportDirt',255);
            $table->integer('purchaseExportConcrete',255);
            $table->integer('purchaseExportMixed',255);

            //ForeignKey Projects
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
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
        Schema::dropIfExists('trucks');
    }
}
