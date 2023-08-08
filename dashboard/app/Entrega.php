<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    public $timestamps= false;

    protected $table = 'entregas';

    public  $primaryKey = 'id_entrega';

    public function rentas(){
        return $this->belongsTo('App\Renta', 'id_renta');
    }
}
