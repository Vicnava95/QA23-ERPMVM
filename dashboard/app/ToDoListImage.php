<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoListImage extends Model
{
    protected $fillable = ['nameFileDocument','timeLineWork_fk'];
    public function todolist(){
        return $this->belongsTo(TimeLineProjectWork::class,'timeLineWork_fk');
    } 
}
