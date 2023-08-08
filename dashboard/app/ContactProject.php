<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactProject extends Model
{
    protected $fillable = ['project_fk','idClient'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }
}
