<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    protected $table ='machineries';

    public $primaryKey='id_machine';

    public function rentas(){

        return $this->hasOne('App\Renta');
    }

    public function disponibilidad(){

        return $this->hasMany('App\Disponibilidads');

    }

    //Relationships Many to Many
    public function rentalForms(){
        return $this->belongsToMany(RentalForm::class,'rental_forms_machineri');
    }
}
