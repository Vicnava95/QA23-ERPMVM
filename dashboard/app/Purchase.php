<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['project_fk','purchase_categorie_fk','description_purchase','amount','phase_fk','date_purchase','numberTruck'];

    public function purchaseCategories(){
        return $this->belongsTo(PurchaseCategory::class,'purchase_categorie_fk');
    }

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }

    public function phases(){
        return $this->belongsTo(Phase::class,'phase_fk');
    }

    //Relationships Many to Many
    public function pictures(){
        return $this->belongsToMany(PurchasePicture::class,'pivot_purchase_pictures','purchase_id','purchase_picture_id');
    }
}
