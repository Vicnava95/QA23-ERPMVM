<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientweb extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['nameClient','emailClient','phoneClient',
                            'addressClient','service_fk'];

    public function service(){
        return $this->belongsTo(Service::class,'service_fk');
    }

    public function servicesPivot(){
        return $this->belongsToMany(Service::class,'clientweb_service');
    }

    public function permitTicket(){
        return $this->hasMany(PermitTicket::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function rentas(){
        return $this->hasMany(Renta::class);
    }
}
