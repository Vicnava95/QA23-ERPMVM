<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Project;
use App\Status;
use App\Manager;
use App\Clientweb;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function reviewFunnelAPI($id)
    {
        $project = Project::find($id);
        if(!empty($project)){
            $projectId = $id;
            $projectName = $project->name_project;
            $projectStatus = $project->statu->name_status;
            $projectAddress = $project->address_project;
            if($project->client_fk == null){
                $clientId = null; 
                $clientName = null;
                $clientEmail= null;
                $clientPhone= null;
            }else{
                $client = Clientweb::find($project->client_fk); 
                $clientId = $client->id; 
                $clientName = $client->nameClient;
                $clientEmail= $client->emailClient;
                $clientPhone= $client->phoneClient;
            }
        }
        else{
            $projectId = null;
            $projectName = null;
            $projectStatus = null;
            $projectAddress = null;
            $clientId = null;
            $clientName = null;
            $clientEmail= null;
            $clientPhone= null;
        }
        $data[] = ['projectId' => $projectId, 'clientId' => $clientId, 'projectName' => $projectName,
                   'projectStatus' => $projectStatus, 'clientName' => $clientName,'clientEmail' => $clientEmail, 
                   'clientAddress' => $projectAddress, 'clientPhone' => $clientPhone];
        return response(json_encode($data),200)->header('Content-type','text/plain'); 
    }
}
