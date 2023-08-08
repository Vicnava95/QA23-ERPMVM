<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitDocuments extends Model
{
    protected $fillable = ['referenceDocumentPermit','ticket_fk','checkList','typeDocumentPermit'];

    public function permit(){
        return $this->belongsTo(PermitTicket::class,'ticket_fk');
    }

    public function mails(){
        return $this->hasMany(Mail::class);
    }
}
