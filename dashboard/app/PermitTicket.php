<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitTicket extends Model
{
    protected $fillable = ['project_fk','permitStage_fk','clientweb_fk','nameTicket',
                            'contactNameTicket','contactPhoneTicket','contactEmailTicket',
                            'comentsTicket','dateStage','numberPermit1','namePermit2',
                            'numberPermit2','cityPermit','documentDropoff','inspectorName',
                            'inspectorTel','inspectorCompany','inspectorEmail','subcontractorName',
                            'subcontractorTel','subcontractorCompany','subcontractorEmail'];

    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }

    /* public function permitType(){
        return $this->belongsTo(Permittype::class,'permitType_fk');
    } */

    public function permitStage(){
        return $this->belongsTo(Permitstage::class,'permitStage_fk');
    }

    public function client(){
        return $this->belongsTo(Clientweb::class,'clientweb_fk');
    }

    public function permitDocuments(){
        return $this->hasMany(PermitDocuments::class);
    }

    public function comentsTicket(){
        return $this->hasMany(comentsTicket::class);
    }
}
