<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clients';

    public $timestamps= false;

    public $primaryKey= 'id_client';

    public function renta()
{
    return $this->hasMany('App\Renta');
}

    public function compañia(){
        return $this->belongsTo('App\Compañia', 'id_comp');
    }

}

