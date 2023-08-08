<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permitstage extends Model
{
    public function permitTicket(){
        return $this->hasMany(PermitTicket::class);
    }
}
