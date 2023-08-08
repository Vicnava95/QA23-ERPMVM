<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentProject extends Model
{
    protected $fillable = ['nameFileDocument','project_fk'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }
}
