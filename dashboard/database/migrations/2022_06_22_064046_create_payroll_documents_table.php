<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('payroll_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('namePayrollDocument',255);
            $table->date('startDateDocument',255);
            $table->date('endDateDocument',255);
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('payroll_documents');
    }
}
