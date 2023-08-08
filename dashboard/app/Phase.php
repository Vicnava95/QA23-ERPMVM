<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable = ['name_phase','text_phase','budget_phase','sold_phase'];
    
    public function projects(){
        return $this->belongsToMany(Project::class,'project_phases');
    }

    //Relationships with Purchases
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
