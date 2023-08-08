<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasePicture extends Model
{
    protected $fillable = ['reference_picture'];
    //Relationships Many to Many
    /* public function purchases(){
        return $this->belongsToMany(Purchase::class,'pivot_purchase_pictures','purchase_id','purchase_picture_id');
    } */
}
