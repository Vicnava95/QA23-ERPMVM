<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = ['todoComment','todoDate','project_fk','user_fk','generalStatus_fk','todoTitle'];
    
    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    } 

    public function users(){
        return $this->belongsTo(User::class,'user_fk');
    }

    public function status(){
        return $this->belongsTo(GeneralStatus::class,'generalStatus_fk');
    }

}
