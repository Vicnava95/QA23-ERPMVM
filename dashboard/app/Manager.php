<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['name_manager','generalStatus'];
    
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
