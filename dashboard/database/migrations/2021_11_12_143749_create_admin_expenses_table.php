<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('admin_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('dateAdminExpenses',255);
            $table->decimal('amountDecimalExpenses',8,2);
            $table->longText('commentAdminExpenses');

            //ForeignKey Type Admin Expenses
            $table->unsignedBigInteger('type_admin_expenses_fk');
            $table->foreign('type_admin_expenses_fk')
                ->references('id')->on('type_admin_expenses')
                ->onDelete('cascade');

            //ForeignKey User
            $table->unsignedBigInteger('user_fk');
            $table->foreign('user_fk')
                ->references('id')->on('users')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_expenses');
    }
}
