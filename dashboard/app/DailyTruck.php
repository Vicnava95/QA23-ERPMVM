<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyTruck extends Model
{
    protected $fillable = ['nameTypeTruck','categoryTypeTruck'];
    
    public function dailyReportTruck(){
        return $this->belongsToMany(DailyReport::class,'report_truck');
    }
}
