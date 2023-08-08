<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentProject extends Model
{
    protected $fillable = ['commentProject','project_fk','user_fk']; 

    public function users(){
        return $this->belongsTo(User::class,'user_fk');
    }

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }
}
