<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeAdminExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('type_admin_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nameTypeAdminExpenses',255);
            $table->string('colorTypeAdminExpenses',255);

            //ForeignKey General Status
            $table->unsignedBigInteger('generalStatus_fk');
            $table->foreign('generalStatus_fk')
                ->references('id')->on('general_statuses')
                ->onDelete('cascade');
            
            //ForeignKey Category Expense
            $table->unsignedBigInteger('categoryExpenses_fk');
            $table->foreign('categoryExpenses_fk')
                ->references('id')->on('category_expenses')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_admin_expenses');
    }
}
