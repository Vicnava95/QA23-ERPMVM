<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maildocument extends Model
{
    protected $fillable = ['referenceMailDocument','mail_fk']; 

    public function mailDocuments(){
        return $this->belongsTo(Mail::class,'mail_fk');
    }
}
