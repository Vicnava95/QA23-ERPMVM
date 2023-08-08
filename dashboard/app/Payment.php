<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['amountPayment','transactionDate','details','transaction','paymentMethod_fk','project_fk'];

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class,'paymentMethod_fk');
    }

    public function proyect(){
        return $this->belongsTo(Proyect::class,'project_fk');
    }

    public function paymentImage(){
        return $this->hasMany(PaymentImage::class);
    }
}
