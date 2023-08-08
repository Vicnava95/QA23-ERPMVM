<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name_status','generalStatus']; 

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function clientweb(){
        return $this->hasMany(Clientweb::class);
    }
}
