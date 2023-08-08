<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryExpense extends Model
{
    protected $fillable = ['nameCategory','generalStatus_fk'];

    public function typeAdmin(){
        return $this->hasMany(TypeAdminExpenses::class);
    }

    public function status(){
        return $this->belongsTo(GeneralStatus::class,'generalStatus_fk');
    }
}
