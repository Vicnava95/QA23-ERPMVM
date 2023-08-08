<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyLabor extends Model
{
    protected $fillable = ['nameDailyLabor'];
    
    public function dailyReport(){
        return $this->belongsToMany(DailyReport::class,'report_labor');
    }
}
