<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['status_fk','name_project','address_project','manager_fk',
                          'start_date_project','end_date_project','budget_project','sold_project',
                          'profit_project','total_sold_project','scope_project','project_type_fk',
                          'category_fk','client_fk','homeDepotLocation'];
    
    //Se agrega la relación de la FK para que se pueda consultar desde una vista                      
    public function statu(){
        return $this->belongsTo(Status::class,'status_fk');
    }

    public function manager(){
        return $this->belongsTo(Manager::class,'manager_fk');
    }

    public function projectType(){
        return $this->belongsTo(ProjectType::class,'project_type_fk');
    }

    public function categorie(){
        return $this->belongsTo(Category::class,'category_fk');
    }

    public function clients(){
        return $this->belongsTo(ClientSource::class,'client_source_fk');
    }

    public function clientsweb(){
        return $this->belongsTo(Clientweb::class, 'client_fk');
    }

    //Relationships Many to Many
    public function services(){
        return $this->belongsToMany(Service::class,'project_services');
    }

    public function phases(){
        return $this->belongsToMany(Phase::class,'project_phases');
    }

    public function contacts(){
        return $this->belongsToMany(Contact::class,'project_contacts');
    }

    public function files(){
        return $this->belongsToMany(FileProject::class,'project_file_projects');
    }

    //Relationships with Purchases
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function permitTicket(){
        return $this->hasMany(PermitTicket::class);
    }

    public function commentsProject(){
        return $this->hasMany(CommentProject::class);
    }

    public function documentProject(){
        return $this->hasMany(DocumentProject::class);
    }

    /* public function trucks(){
        return $this->hasMany(Truck::class);
    } */

    public function contactProjects(){
        return $this->hasMany(ContactProject::class);
    }

    public function todoComments(){
        return $this->hasMany(Todolist::class);
    }

    public function timeLineWork(){
        return $this->hasMany(TimeLineProjectWork::class);
    }

    public function dailyReport(){
        return $this->hasMany(DailyReport::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
