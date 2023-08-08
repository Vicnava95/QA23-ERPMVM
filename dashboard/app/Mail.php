<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['courier','recipientsName','tracking','permitDocument','dateSend',
                            'dateReceived','certifiedMail','certificationNumber','permitDocuments_fk'];

    public function permitDocuments(){
        return $this->belongsTo(PermitDocuments::class,'permitDocuments_fk');
    }

    public function mailsdocuments(){
        return $this->hasMany(Maildocument::class);
    }
}
