<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = ['service_fk','name','address','phone','email','description'];

    public function services(){
        return $this->belongsTo(Service::class,'service_fk');
    }
}
