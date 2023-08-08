<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $fillable = ['name_project_type','generalStatus'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
