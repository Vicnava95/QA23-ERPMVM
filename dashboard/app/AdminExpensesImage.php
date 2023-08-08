<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminExpensesImage extends Model
{
    protected $fillable = ['imageName','adminExpenses_fk'];

    public function expenses(){
        return $this->belongsTo(AdminExpenses::class,'user_fk');
    }
}
