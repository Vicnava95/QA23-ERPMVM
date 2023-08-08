<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compañia extends Model
{

    protected $table='compañias';

    public $timestamps= false;

    public $primaryKey='id_comp';

    public function clientes(){

        return $this->hasMany('App\Cliente');

    }

}
