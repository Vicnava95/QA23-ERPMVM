<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = ['yards','importDirt','importAsphalt','importAggregates','importBase','importGravell',
                            'purchaseImportDirt','purchaseImportAsphalt','purchaseImportAggregates','purchaseImportBase',
                            'purchaseImportGravell','exportDirtRock','exportAsphalt','exportDirt','exportConcrete',
                            'exportMixed','purchaseExportDirtRock','purchaseExportAsphalt','purchaseExportDirt',
                            'purchaseExportConcrete','purchaseExportMixed','description','project_fk','exportTrash','purchaseExportTrash',
                            'exportTrash40CY','purchaseExportTrash40CY','importSand','purchaseImportSand','importSoil','purchaseImportSoil'];
    
    public function projects(){
        return $this->belongsTo(Project::class,'project_fk');
    }
}
