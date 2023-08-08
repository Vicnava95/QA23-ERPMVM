<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDailyReport extends Model
{
    protected $fillable = ['nameImageDailyReport','dailyReport_fk'];

    public function dailyReport(){
        return $this->belongsTo(DailyReport::class,'dailyReport_fk');
    }
}
