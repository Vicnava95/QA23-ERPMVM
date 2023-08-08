<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollDocument extends Model
{
    protected $fillable = ['namePayrollDocument','startDateDocument','endDateDocument']; 
    
}
