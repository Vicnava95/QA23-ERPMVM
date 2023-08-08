<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name_contact','phone_contact'];
    public function projects(){
        return $this->belongsToMany(Project::class,'project_contacts');
    }
}
