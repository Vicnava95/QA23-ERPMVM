<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permittype extends Model
{
    public function permitTicket(){
        return $this->hasMany(PermitTicket::class);
    }
}
