<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAdminExpenses extends Model
{
    protected $fillable = ['nameTypeAdminExpenses','generalStatus_fk','categoryExpenses_fk','colorTypeAdminExpenses']; 

    /** Este modelo va almacenar los tipos de gastos adminitrativos que se estarán ocupando, está relacionado con el modelo
     * de AdminExpenses y GeneralStatus, puede tener un estado ya sea Active o Disables y este mismo tipo puede estar en muchos gastos  
     */
    public function status(){
        return $this->belongsTo(GeneralStatus::class,'generalStatus_fk');
    }

    public function adminExpenses(){
        return $this->hasMany(AdminExpenses::class);
    }
    
    public function categoryExpense(){
        return $this->belongsTo(CategoryExpense::class,'categoryExpenses_fk');
    }
}
