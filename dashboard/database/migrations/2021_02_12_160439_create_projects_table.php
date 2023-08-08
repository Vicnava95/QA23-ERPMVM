<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name_project',150);
            $table->string('address_project',255);
            $table->string('start_date_project');
            $table->string('end_date_project');
            $table->decimal('budget_project',8,2);
            $table->decimal('sold_project',8,2);
            $table->string('profit_project');
            $table->string('total_sold_project');
            $table->longText('scope_project');
            $table->string('homeDepotLocation',255);

            //Relationships
            //ForeignKey Status
            $table->unsignedBigInteger('status_fk');
            $table->foreign('status_fk')
                ->references('id')->on('statuses')
                ->onDelete('cascade');

            //ForeignKey Manager
            $table->unsignedBigInteger('manager_fk');
            $table->foreign('manager_fk')
                ->references('id')->on('managers')
                ->onDelete('cascade');

            //ForeignKey ProjectType
            $table->unsignedBigInteger('project_type_fk');
            $table->foreign('project_type_fk')
                ->references('id')->on('project_types')
                ->onDelete('cascade');

            //ForeignKey Category
            $table->unsignedBigInteger('category_fk');
            $table->foreign('category_fk')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            //ForeignKey Client Source
            $table->unsignedBigInteger('client_source_fk');
            $table->foreign('client_source_fk')
                ->references('id')->on('client_sources')
                ->onDelete('cascade');

            //ForeignKey Client
            $table->unsignedBigInteger('client_fk')->nullable();
            $table->foreign('client_fk')
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
        Schema::dropIfExists('projects');
    }
}
