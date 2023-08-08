<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalForm extends Model
{
    protected $fillable = ['nameFormRental','phoneFormRental','deliveryAddressFormRental','deliveryDateFormRental',
                            'estimatedDateFormRental','deliveryNote'];
                            
    //Relationships Many to Many
    public function machinerys(){
        return $this->belongsToMany(Machinery::class,'rental_forms_machineri');
    }
}
