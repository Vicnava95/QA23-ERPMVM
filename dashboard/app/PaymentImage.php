<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentImage extends Model
{
    protected $fillable = ['namePaymentImage','payment_fk'];
    
    public function payments(){
        return $this->belongsTo(Payment::class,'payment_fk');
    }
}
