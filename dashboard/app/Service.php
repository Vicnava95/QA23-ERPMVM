<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name_service','generalStatus'];
    
    public function projects(){
        return $this->belongsToMany(Project::class,'project_services');
    }

    //Relationship with Clientweb
    public function clients(){
        return $this->hasMany(Clientweb::class);
    }

    //Pivot table
    public function clientsweb(){
        return $this->belongsToMany(Clientweb::class,'clientweb_service');
    }

    public function quoteRequest(){
        return $this->hasMany(QuoteRequest::class);
    }

}
