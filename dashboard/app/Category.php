<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_category','generalStatus'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
