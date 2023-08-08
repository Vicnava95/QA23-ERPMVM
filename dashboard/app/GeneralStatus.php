<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralStatus extends Model
{
    protected $fillable = ['nameGeneralStatus']; 

    /** Este modelo almacena 2 valores, active y disabled, la utilidad de este modelo es poder activar o desactivar algunos servicios
     * ya que se pueden ir agregando o quitando tipos de gastos, pero no va ser necesario borrarlos, sino solo cambiarlo de estado 
     * a no visible, sin afectar los reportes
     */
    public function typeAdmin(){
        return $this->hasMany(TypeAdminExpenses::class);
    }

    public function todoComments(){
        return $this->hasMany(Todolist::class);
    }

    public function categoryExpenses(){
        return $this->hasMany(CategoryExpense::class);
    }
}
