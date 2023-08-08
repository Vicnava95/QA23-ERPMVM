<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = 'rentals';
    protected $fillable = ['paymentStatus','paymentComments'];
    public $timestamps= false;

//    const CREATED_AT = 'creation_date';
//    const UPDATED_AT = 'last_update';
    public $primaryKey='id';

    public function clientes(){
        return $this->belongsTo('App\Cliente', 'client');
    }
    
    public function machine(){
        return $this->belongsTo('App\Machinery', 'machine');
    }

    public function entregas(){
        return $this->hasOne('App\Entrega');
    }

    public function machinery(){
        return $this->belongsTo('App\Machinery', 'machine');
    }

    public function disponibilidads(){
        return $this->hasOne('App\Disponibilidads');
    }

    public function clients(){
        return $this->belongsTo(Clientweb::class,'client_fk');
    }
}
