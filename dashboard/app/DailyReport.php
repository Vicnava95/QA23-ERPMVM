<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = ['dateDailyReport','statusDailyReport','projects_fk','erpStatus','comments','projectPhase'];
    
    public function project(){
        return $this->belongsTo(Project::class,'projects_fk');
    }

    public function dailyReportLabor(){
        return $this->belongsToMany(DailyLabor::class,'report_labor');
    }

    public function dailyReportTruck(){
        return $this->belongsToMany(DailyTruck::class,'report_truck');
    }

    public function imagesDaily(){
        return $this->hasMany(ImageDailyReport::class);
    }
    
}
