<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminExpenses extends Model
{
    protected $fillable = ['dateAdminExpenses','amountDecimalExpenses','commentAdminExpenses','type_admin_expenses_fk','user_fk'];

    /** Este modelo almacena los gastos administrativos, tiene relacionado el usuario que realizó el gasto y el tipo de gasto */
    public function status(){
        return $this->belongsTo(TypeAdminExpenses::class,'type_admin_expenses_fk');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_fk');
    }

    public function adminExpensesImage(){
        return $this->hasMany(AdminExpensesImage::class);
    }
}
