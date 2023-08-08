<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileProject extends Model
{
    protected $fillable = ['reference_file_project'];
    public function projects(){
        return $this->belongsToMany(Project::class,'project_file_projects','project_id','file_project_id');
    }
}
