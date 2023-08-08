<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentTicket extends Model
{
    protected $fillable = [
        'description', 'user_fk', 'ticket_fk',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_fk');
    }

    public function permitTickets(){
        return $this->belongsTo(PermitTicket::class,'ticket_fk');
    }
}
