<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameTicket',255);
            $table->string('numberPermit1',255);
            $table->string('namePermit2',255);
            $table->string('numberPermit2',255);
            $table->string('contactNameTicket',255);
            $table->string('contactPhoneTicket',255);
            $table->string('contactEmailTicket',255);
            $table->string('cityPermit',255);
            $table->string('documentDropoff',255);
            $table->longText('comentsTicket');
            $table->string('dateStage',255);
            $table->string('inspectorName',255);
            $table->string('inspectorTel',255);
            $table->string('inspectorCompany',255);
            $table->string('inspectorEmail',255);
            $table->string('subcontractorName',255);
            $table->string('subcontractorTel',255);
            $table->string('subcontractorCompany',255);
            $table->string('subcontractorEmail',255);

            //Relationships
            //ForeignKey Project
            $table->unsignedBigInteger('project_fk');
            $table->foreign('project_fk')
                ->references('id')->on('projects')
                ->onDelete('cascade');

            //ForeignKey Permit Type
            /* $table->unsignedBigInteger('permitType_fk');
            $table->foreign('permitType_fk')
                ->references('id')->on('permittypes')
                ->onDelete('cascade'); */

            //ForeignKey Permit Stage
            $table->unsignedBigInteger('permitStage_fk');
            $table->foreign('permitStage_fk')
                ->references('id')->on('permitstages')
                ->onDelete('cascade');
            
            //ForeignKey Client Web
            $table->unsignedBigInteger('clientweb_fk');
            $table->foreign('clientweb_fk')
                ->references('id')->on('clientwebs')
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
        Schema::dropIfExists('permit_tickets');
    }
}
