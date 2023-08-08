<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseCategory extends Model
{
    protected $fillable = ['name_category','color','generalStatus','type_category','showDailyReport'];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
