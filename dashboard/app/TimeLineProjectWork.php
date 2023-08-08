<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLineProjectWork extends Model
{
    protected $fillable = ['timeLineTitle','timeLineComment','timeLineDate','project_fk'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    } 

    public function image(){
        return $this->hasMany(ToDoListImage::class);
    }
}
