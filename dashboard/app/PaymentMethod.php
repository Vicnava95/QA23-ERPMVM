<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['namePaymentMethod'];
    
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
