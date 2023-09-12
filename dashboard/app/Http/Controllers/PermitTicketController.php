<?php

namespace App\Http\Controllers;
/* require __DIR__ . '\twilio-php-master\src\Twilio\autoload.php'; */
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 

use App\PermitTicket;
use App\Permitstage; 
use App\Permittype; 
use App\Project;
use App\Service;
use App\Clientweb;
use App\PermitDocuments;
use App\Mail;
use App\Maildocument;
use App\ComentTicket;
use Twilio\Rest\Client;
use App\User;
use DB;
use Auth;
use DateTime; 
use Carbon\Carbon; 
use Illuminate\Http\Request;
use App\Notifications\Comments;

class PermitTicketController extends Controller
{
    /** DASHBOARD DE PERMISOS */
    public function index(){

        $projects = Project::all();
        $clients = Clientweb::all(); 
        //Obtengo todos los permisos de acuerdo a su tipo
        $projectsApplying = PermitTicket::where('permitStage_fk',1)
                            ->orderByDesc('created_at')                  
                            ->get();
        $projectsCovenant = PermitTicket::where('permitStage_fk',2)
                            ->orderByDesc('updated_at')                  
                            ->get();
        $projectsPending = PermitTicket::where('permitStage_fk',3)
                            ->orderByDesc('updated_at')                  
                            ->get();
        $projectsWaiting = PermitTicket::where('permitStage_fk',4)
                            ->orderByDesc('updated_at')                  
                            ->get();
        $projectsRTI = PermitTicket::where('permitStage_fk',5)
                            ->orderByDesc('updated_at')                  
                            ->get();
        $projectsIssued = PermitTicket::where('permitStage_fk',6)
                            ->orderByDesc('updated_at')                  
                            ->get();

        //Función para obtener la información del proyecto por el ID
        function getInfoProject($projects, $id){
            foreach($projects as $project){
                if($project->id == $id){
                    $proyecto = Project::find($id);
                }
            }
            return $proyecto;
        }

        //Función para obtener la información del cliente por el ID
        function getInfoClient($clients, $id){
            $cliente = 0;
            foreach($clients as $client){
                if($client->id == $id){
                    $cliente = Clientweb::find($id);
                }
            }
            return $cliente;
        }

        /** START Proyectos con estado Applying */
        /** Los mismo se realiza para cada uno de los permisos */
        if(count($projectsApplying) == 0){
            // Si no hay permisos en ese estado, se crea una colección vacia 
            $arrayProjectApplying[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            //Si hay proyectos en ese estado, se realiza una iteración
            foreach($projectsApplying as $pApplying){
                //Se hace uso de función para obtener la información del proyecto, ya que un permiso tiene relacionado un proyecto
                $project = getInfoProject($projects, $pApplying->project_fk);
                //Se obtiene la dirección pero se le quita algunas partes de la dirección
                //Se hace con la función str_replace
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                //Se obtiene los servicios que contiene ese proyecto
                $services = $project->services()->get();
                //Se obtiene la información del cliente
                $client = getInfoClient($clients,$pApplying->clientweb_fk);
                //Se le da formato a la fecha, mes/dia/año y la hora H:m am/pm 
                //Luego se obtienen todos los comentarios realizados a ese permiso y se muestra la cantidad
                $dateUpdate = Carbon::parse($pApplying->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pApplying->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pApplying->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments); 
                $idPermitNumber = $pApplying->numberPermit1;
                //Creación de una colleción, cada una de las colleciones se envían al template
                $arrayProjectApplying[] = 
                ['id' => $pApplying->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate ,'numComments' => $numComments , 'numberPermit' => $idPermitNumber];
                
            }
        }
        /** END Proyectos con estado Applying */
        
        /** START Proyectos con estado Covennant */
        if(count($projectsCovenant) == 0){
            $arrayProjectCovenant[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            foreach($projectsCovenant as $pCovenant){
                $project = getInfoProject($projects, $pCovenant->project_fk);
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                $services = $project->services()->get();
                $client = getInfoClient($clients,$pCovenant->clientweb_fk);
                $dateUpdate = Carbon::parse($pCovenant->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pCovenant->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pCovenant->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments);
                $idPermitNumber = $pCovenant->numberPermit1;
                $arrayProjectCovenant[] = 
                ['id' => $pCovenant->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate,'numComments' => $numComments ,'numberPermit' => $idPermitNumber];
            }
        }
        /** END Proyectos con estado Covennant */
 
        /** START Proyectos con estado Pending */
        if(count($projectsPending) == 0){
            //dd('vacio'); 
            $arrayProjectPending[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            foreach($projectsPending as $pPending){
                $project = getInfoProject($projects, $pPending->project_fk);
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                $services = $project->services()->get();
                $client = getInfoClient($clients,$pPending->clientweb_fk);
                $dateUpdate = Carbon::parse($pPending->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pPending->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pPending->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments);
                $idPermitNumber = $pPending->numberPermit1;
                $arrayProjectPending[] = 
                ['id' => $pPending->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate,'numComments' => $numComments, 'permitNumber' => $idPermitNumber];
            }
        }
        /** END Proyectos con estado Pending */
        
        /** START Proyectos con estado Waiting */
        if(count($projectsWaiting) == 0){
            $arrayProjectWaiting[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            foreach($projectsWaiting as $pWaiting){
                $project = getInfoProject($projects, $pWaiting->project_fk);
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                $services = $project->services()->get();
                $client = getInfoClient($clients,$pWaiting->clientweb_fk);
                $dateUpdate = Carbon::parse($pWaiting->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pWaiting->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pWaiting->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments);
                $idPermitNumber = $pWaiting->numberPermit1;
                $arrayProjectWaiting[] = 
                ['id' => $pWaiting->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate,'numComments' => $numComments, 'permitNumber' => $idPermitNumber];

                //dd($pWaiting); 
            }
        }
        /** END Proyectos con estado Waiting */

        /** START Proyectos con estado RTI */
        if(count($projectsRTI) == 0){
            $arrayProjectRTI[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            foreach($projectsRTI as $pRTI){
                $project = getInfoProject($projects, $pRTI->project_fk);
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                $services = $project->services()->get();
                $client = getInfoClient($clients,$pRTI->clientweb_fk);
                $dateUpdate = Carbon::parse($pRTI->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pRTI->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pRTI->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments);
                $idPermitNumber = $pRTI->numberPermit1;
                $arrayProjectRTI[] = 
                ['id' => $pRTI->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate,'numComments' => $numComments, 'permitNumber'=> $idPermitNumber];
            }
        }
        /** END Proyectos con estado RTI */

        /** START Proyectos con estado Issued */
        if(count($projectsIssued) == 0){
            $arrayProjectIssued[] = 
                ['id' => 0, 'address' => 0 , 'services' => 0 ,'client' => 0];
        }else{
            foreach($projectsIssued as $pIssued){
                $project = getInfoProject($projects, $pIssued->project_fk);
                $a = $project->address_project;
                $address = str_replace(array(', CA, USA',', California, EE. UU.'),'',$a);
                $services = $project->services()->get();
                $client = getInfoClient($clients,$pIssued->clientweb_fk);
                $dateUpdate = Carbon::parse($pIssued->updated_at)->format('m/d/Y');
                $timeUpdate = Carbon::parse($pIssued->updated_at)->format('g:i A');
                $coments = ComentTicket::where('ticket_fk',$pIssued->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
                $numComments = count($coments);
                $idPermitNumber = $pIssued->numberPermit1;
                $arrayProjectIssued[] = 
                ['id' => $pIssued->id, 'address' => $address , 'services' => $services ,'client' => $client,
                'dateUpdate' => $dateUpdate, 'timeUpdate' => $timeUpdate,'numComments' => $numComments, 'permitNumber' => $idPermitNumber];
            }
        }
        /** END Proyectos con estado Issued */

        return view('Permits/dashboardPermits',compact('arrayProjectApplying','arrayProjectCovenant','arrayProjectPending',
                                                        'arrayProjectWaiting','arrayProjectRTI','arrayProjectIssued',
                                                        'projects','clients'));
    }

    /** Función para la busqueda de un permiso por medio del nombre del proyecto */
    /** Esta relacionado con la función getIdProject */
    public function showPermitInfo($name){
        if($name != ''){
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                /* '<li style="margin-left:10px; margin-bottom:8px;" class="listaProyectos" value="'.$row->id.' "onclick=window.location="/dashboard/public/getIdProject/'.$row->id.'">'.' • '.$row->name_project.'</li>'; */
                '<li class="listaProyectos" value="'.$row->id.' "onclick=window.location="/getIdProject/'.$row->id.'">'.$row->name_project.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    //Función para obtener el permiso a partir del search bar que está en el dashboard de permisos
    public function getIdProject($idProject){
        $idPermitTicket = PermitTicket::where('project_fk',$idProject)->get();
        if($idPermitTicket->isEmpty()){
            return redirect()->route('showPermits')->with('message','Update Successfully Added');;
        }else{
            return redirect()->route('infoPermit',$idPermitTicket[0]->id);
        }
    }

    /** Función para el cambio de estado de un permiso
     *  Se cambia cuando se presionan las flechas que se muestran en la card de un permiso
     */
    public function updateStage($idPermitTicket,$id){
        $permitTicket = PermitTicket::find($idPermitTicket);
        $today = Carbon::now()->format('m/d/Y');
        $permitTicket->update([
            'permitStage_fk' => $id,
            'dateStage' => $today
        ]);
        $permitTicket->save();
        return redirect()->route('showPermits'); 
    }

    /** Se muestran todos los permisos, este template ya no se muestra en el flujo del ERP */
    public function allPermits(){
        $permitStages = Permitstage::all();
        $permitTypes = Permittype::all();
        $projects = Project::all();
        $permits = PermitTicket::all(); 
        return view('Permits/showPermits',compact('permitStages','permitTypes','projects','permits'));
    }
    
    public function fetch($name){
        if($name != ''){
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li class="listaProyectos" value="'.$row->id.'">'.$row->name_project.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    /** Función para realizar la búsqueda de clientes por nombre */
    public function fetchClient($name){
        if($name != ''){
            $data = DB::table('clientwebs')
                ->where('nameClient','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li class="listaClientes"  value="'.$row->id.'">'.$row->nameClient.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    /** Función para devolver los servicios en objeto JSON */
    public function services($id){
        $project = Project::find($id);
        $services = $project->services()->get();
        return response(json_encode($services),200)->header('Content-type','text/plain');
    }

    /** Función para devolver los clientes en formato JSON */
    public function clients($id){
        $client = Clientweb::find($id); 
        return response(json_encode($client),200)->header('Content-type','text/plain');
    }

    /** Función para crear un nuevo permiso */
    public function create(){
        //No se muestra el último estado de un permiso
        $permitStages = Permitstage::whereIn('id', [1, 2, 3, 4, 5, 6])->get();
        $permitType = Permittype::all(); 
        return view('Permits/newPermit', compact('permitStages','permitType')); 
    }

    /** Función para almacenar un permiso */
    public function store(Request $request){
        $today = Carbon::now()->format('m/d/Y');
        $permit = PermitTicket::create([
            'project_fk' => request('idProject'),
            'permitStage_fk' => request('permitStage'),
            'clientweb_fk' => request('idClient'),
            'nameTicket' => request('permitName'),
            'numberPermit1' => request('permitNumber1'),
            'namePermit2' => request('permitName2'),
            'numberPermit2' => request('permitNumber2'),
            'contactNameTicket' => request('contactName'),
            'contactPhoneTicket' => request('contactPhone'),
            'contactEmailTicket' => request('contactEmail'),
            'cityPermit' => request('cityPermit'),
            'documentDropoff' => request('documentDropoff'),
            'comentsTicket' => request('coments'),
            'dateStage' => $today,
            'inspectorName' => request('inspectorName'),
            'inspectorTel' => request('inspectorPhone'),
            'inspectorCompany' => request('inspectorCompany'),
            'inspectorEmail' => request('inspectorEmail'),
            'subcontractorName' => request('subcontractorName'),
            'subcontractorTel' => request('subcontractorPhone'),
            'subcontractorCompany' => request('subcontractorCompany'),
            'subcontractorEmail' => request('subcontractorEmail')
        ]);
        $permit->save();
        return redirect()->route('showPermits'); 
    }

    /** Se crea un permiso a partir de un proyecto, esta función no se ocupa por el momento */
    public function createTicketProject(Project $project){
        $permitStage = Permitstage::whereIn('id', [1, 2, 3, 4, 5, 6])->get();
        $permitType = Permittype::all();
        $services = $project->services()->get();
        $client = $project->clientsweb()->get(); 

        if(count($client) == 0 ){
            $clientName = '';
            $clientPhone = '';
            $clientEmail = '';
        }else{
            $clientName = $client[0]->nameClient;
            $clientPhone = $client[0]->phoneClient;
            $clientEmail = $client[0]->emailClient;
        }
        return view('Permits/newPermitProject', compact('permitStage','permitType','project','services','client',
                                                        'clientName','clientPhone','clientEmail')); 
    }

    /** Se muestra el template para subir archivos de un permiso */
    public function dropzonePermit(PermitTicket $permitTicket ){
        $project = Project::find($permitTicket->project_fk);
        return view('Permits.dropzonePermits',compact('permitTicket','project')); 
    }

    /** Se obtiene el archivo y se almacena con el permiso, el permiso debe de existir */
    public function dropzoneStore(Request $request, PermitTicket $permitTicket){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = PermitDocuments ::create([
            'referenceDocumentPermit' => $fileName,
            'ticket_fk' => $permitTicket->id,
            'checkList' => 0,
        ]);
        $fileR->move(public_path('documentPermits'),$fileName);
        $permitTicket->updated_at = Carbon::now()->toDateTimeString();
        $permitTicket->save();
    }

    /** Esta función actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function destroyDropzone($name){
        PermitDocuments::where('referenceDocumentPermit',$name)->delete();
    }

    /** Función para eliminar un archivo desde el ERP */
    public function destroyDocument(PermitTicket $permitTicket, $name){
        PermitDocuments::where('referenceDocumentPermit',$name)->delete();
        return redirect()->route('infoPermit',$permitTicket)
                        ->with('messageDocuments','Deleted Document'); 
    }

    public function destroyDocumentBack(PermitTicket $permitTicket, $name){
        PermitDocuments::where('referenceDocumentPermit',$name)->delete();
        return redirect()->back()->with('messageDocuments','Deleted Document'); 
    }

    /** Función para mostrar la información de un permiso */
    public function show($idPermitTicket){
        //Se obtiene el objeto de Perniso
        $permitTicket = PermitTicket::find($idPermitTicket);
        // Se obtiene en que estado está el permiso
        $permitStage = Permitstage::find($permitTicket->permitStage_fk);  
        // Se obtiene el proyecto y los servicios al cual está relacionado el permiso
        $project = Project::find($permitTicket->project_fk);
        $services = $project->services()->get();
        //Se obtiene la información del cliente
        $client = Clientweb:: find($permitTicket->clientweb_fk); 
        //Se obtienen los documentos relacionados con el permiso
            $documents = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',NULL)
                ->get(); 
            $documentsQuoteInformation = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',1)
                ->get(); 
            $documentsProjectsSitePlan = PermitDocuments::where('ticket_fk',$permitTicket->id) 
                ->where('typeDocumentPermit',2)
                ->get();
            $documentsProjectsSiteList = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',3)
                ->get();
            $documentsPermitsReceipts = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',4)
                ->get();
            $documentsPermitsApplications = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',5)
                ->get();
            $documentsBussinesLicense = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',6)
                ->get();
            $documentsCityInspection = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',7)
                ->get();
            $documentsJobberQuote = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',8)
                ->get();
            $documentsSitePlan = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',9)
                ->get();
            $documentsOthers = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',10)
                ->get();
            $documentsCovenantAgreement = PermitDocuments::where('ticket_fk',$permitTicket->id)
                ->where('typeDocumentPermit',11)
                ->get();
                
            $countFieldDocuments = count($documentsProjectsSitePlan) + count($documentsProjectsSiteList);
            $countEstimationJobber = count($documentsJobberQuote) + count($documentsQuoteInformation);
            $countAnotherPermits = count($documentsPermitsApplications) + count($documentsBussinesLicense) + count($documentsCovenantAgreement) + count($documentsSitePlan) +count($documentsCityInspection);

        if($documents->isEmpty()){
            //Si no hay documentos relacionados con el permiso, se crea una colección vacia 
            $infoMail [] = ['id' => 0, 'courier' => 0, 'recipientName' => 0,'tracking' => 0,
                            'permitDocument' => 0, 'dateSend' => 0,'dateReceived' => 0, 
                            'certifiedMail' => 0,'certificationNumber' => 0, 'nameDocument'=> 0,
                            'idDocument'=> 0];
        } 
        else{
            foreach($documents as $document){
                $mail = Mail::where('permitDocuments_fk',$document->id)->get(); 
                if($mail->isEmpty()){
                    $infoMail [] = ['id' => -1, 'courier' => -1, 'recipientName' => -1,'tracking' => -1,
                    'permitDocument' => -1, 'dateSend' => -1,'dateReceived' => -1, 
                    'certifiedMail' => -1,'certificationNumber' => -1, 'nameDocument'=> -1,
                    'idDocument'=> -1];
                }else{
                    $infoMail [] = ['id' => $mail[0]->id, 'courier' => $mail[0]->courier, 'recipientName' => $mail[0]->recipientsName,
                    'tracking' => $mail[0]->tracking, 'permitDocument' => $mail[0]->permitDocument, 'dateSend' => $mail[0]->dateSend,
                    'dateReceived' => $mail[0]->dateReceived, 'certifiedMail' => $mail[0]->certifiedMail,
                    'certificationNumber' => $mail[0]->certificationNumber, 'nameDocument'=> $document->referenceDocumentPermit,
                    'idDocument'=> $document->id];
                }
            }
        }

        $mails = [];
        foreach ($infoMail as $infoM){
            /*Initialize array with projects*/ 
            if( !in_array( $infoM['id'] ,$mails ) )
            {
                array_push($mails,$infoM['id']);
            }
        }

        foreach($mails as $m){
            $allMails = Maildocument::where('mail_fk',$m)->get();
            if($allMails->isEmpty()){
                $infoMailDocuments[] = ['idMail' => $m, 'idD' => -1, 'reference' => -1];
            }else{
                foreach ($allMails as $allM){
                    $infoMailDocuments[] = ['idMail' => $m ,'idD' => $allM->id, 'reference' => $allM->referenceMailDocument];
                }
            }
        }
        //dd($infoMailDocuments); 
        $today = Carbon::now()->format('m/d/Y');
        $dateTicket = $permitTicket->dateStage;
        $diaInicio = Carbon::parse($dateTicket);
        $diaFin = Carbon::parse($today);
        //Obtengo la diferencia de dias entre las dos fechas ingresadas
        $diferenciaDias = $diaFin->diffInDays($diaInicio);
        $date = $permitTicket->updated_at; 
        $stringDate = $date->toDayDateTimeString(); 
        $coments = ComentTicket::where('ticket_fk',$permitTicket->id)
                                ->orderBy('updated_at','desc')
                                ->get();
        if($coments->isEmpty()){
            $arrayTimes [] = ['idComment' => 0, 'date' => 0, 'time'=> 0];
        }else{
            foreach ($coments as $c){
                $dateComment = Carbon::parse($c->updated_at)->format('m/d/Y');
                $timeComment = Carbon::parse($c->updated_at)->format('g:i A');
                $arrayTimes[] = ['idComment' => $c->id , 'date' => $dateComment, 'time'=> $timeComment];
            }
        } 
        //dd($coments);
        
        return view('Permits.infoPermit',compact('permitTicket','permitStage','services','project','client','documents','stringDate',
                                                'infoMail','infoMailDocuments','diferenciaDias','coments','arrayTimes','documentsQuoteInformation',
                                                'documentsProjectsSitePlan','documentsProjectsSiteList','documentsPermitsReceipts','documentsPermitsApplications',
                                                'documentsBussinesLicense','documentsCityInspection','documentsJobberQuote','documentsSitePlan','documentsOthers',
                                                'documentsCovenantAgreement','countFieldDocuments','countEstimationJobber','countAnotherPermits')); 
    }

    /** Función para actualizar la descripción de un permiso */
    public function updateComents(PermitTicket $permitTicket){
        //dd($permitTicket);
        //Se registra un nuevo comentario para el timeline
        //Se le añade la persona que realiza el registro
        $user_id = Auth::user()->id;
        $coments = ComentTicket::create([
            'description' => request('comments'),
            'user_fk' => $user_id,
            'ticket_fk' => $permitTicket->id
        ]);
        $coments->save(); 
        $permitTicket->update([
            'comentsTicket' => request('comments'),
        ]);
        $permitTicket->save();
        $project = Project::find($permitTicket->project_fk);
        $client = Clientweb::find($permitTicket->clientweb_fk);

        $a = $project->address_project;
        $projectName = $project->name_project;
        $address = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a); 
        $clientName = $client->nameClient;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$client->phoneClient);
        $clientEmail = $client->emailClient;
        $url = 'https://bit.ly/3JbM4hl';
        //$url = 'https://bit.ly/3J8w4MQ/'.$clientEmail;
        $userName = Auth::user()->name;
        //$toNumber = '50361067071';
        $marvinNumber = '13104099884';
        //$miguelNumber = '13104050904';
        //$message = "\n".$projectName." / ".$address."\n"."New update: \n".request('comments') ."\n".$url;
        $message = "\n".$projectName." / ".$address."\n"."New update: \n".request('comments');
        //$message = request('comments');
        
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587822';

        //SMS TO MARVIN
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO MIGUEL
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($miguelNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO CLIENT
        /* $client = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $client->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        /** Creación del contenido para el correo */
        /* $globalQuote = [
            'addressClient' => 'Address: '.$address,
            'nameClient' => 'Client: '.$clientName,
            'comment' => 'New Update: '.request('comments'),
            'user' => 'User: '.$userName,
            
        ]; */ 

        /** Se busca que usuarios van a recibir el correo */
        /* $marvin =User::find(1);
        $miguel =User::find(2);
        $joseline =User::find(6);
        $ariel =User::find(3); */
        /* $victor =User::find(4); */
        

        /** Se envia la notificación a los usuarios */
        /* $marvin->notify(new Quote($globalQuote));
        $miguel->notify(new Quote($globalQuote));
        $joseline->notify(new Quote($globalQuote));
        $ariel->notify(new Quote($globalQuote)); */
        /* $victor->notify(new Comments($globalQuote)); */

        return redirect()->back()->with('message','Updated Comments'); 
    }

    /** Send the first sms permit to client */
    public function firstComment(PermitTicket $permitTicket){
        $project = Project::find($permitTicket->project_fk);
        $a = $project->address_project;
        $address = str_replace(array(', USA',', EE. UU.'),'',$a); 
        $mensaje = "You are now subscribed to receive permit updates notifications through SMS for your property at ".$address.". Thanks for doing business with us. MVM GRADING AND DEMO INC";

        $user_id = Auth::user()->id;
        $coments = ComentTicket::create([
            'description' => $mensaje,
            'user_fk' => $user_id,
            'ticket_fk' => $permitTicket->id
        ]);
        $coments->save(); 
        $permitTicket->update([
            'comentsTicket' => $mensaje,
        ]);
        $permitTicket->save();
        $client = Clientweb::find($permitTicket->clientweb_fk);

        $clientName = $client->nameClient;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$client->phoneClient);
        $userName = Auth::user()->name;
        //$toNumber = '50361067071';
        $marvinNumber = '13104099884';
        $url = 'https://bit.ly/3JbM4hl';
        $message = "\n".$mensaje;
        
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587822';

        //SMS TO MARVIN
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO CLIENT
        /* $client = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $client->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        /** Creación del contenido para el correo */
        /* $globalQuote = [
            'addressClient' => 'Address: '.$address,
            'nameClient' => 'Client: '.$clientName,
            'comment' => 'New Update: '.request('comments'),
            'user' => 'User: '.$userName,
            
        ]; */ 

        /** Se busca que usuarios van a recibir el correo */
        /* $marvin =User::find(1);
        $miguel =User::find(2);
        $joseline =User::find(6);
        $ariel =User::find(3); */
        /* $victor =User::find(4); */
        

        /** Se envia la notificación a los usuarios */
        /* $marvin->notify(new Quote($globalQuote));
        $miguel->notify(new Quote($globalQuote));
        $joseline->notify(new Quote($globalQuote));
        $ariel->notify(new Quote($globalQuote)); */
        /* $victor->notify(new Comments($globalQuote)); */

        return redirect()->back()->with('message','Updated Comments'); 
    }

    /** Send the last sms permit to client*/
    public function lastComment(PermitTicket $permitTicket){
        $project = Project::find($permitTicket->project_fk);
        $address = $project->address_project;
        $mensaje = "Your permit process has ended, you will receive full permit documentation through email in the next 5 business days.";

        $user_id = Auth::user()->id;
        $coments = ComentTicket::create([
            'description' => $mensaje,
            'user_fk' => $user_id,
            'ticket_fk' => $permitTicket->id
        ]);
        $coments->save(); 
        $permitTicket->update([
            'comentsTicket' => $mensaje,
        ]);
        $permitTicket->save();
        $client = Clientweb::find($permitTicket->clientweb_fk);

        $clientName = $client->nameClient;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$client->phoneClient);
        $userName = Auth::user()->name;
        //$toNumber = '50361067071';
        $marvinNumber = '13104099884';
        $message = "\n".$mensaje;
        
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587822';

        //SMS TO MARVIN
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO CLIENT
        /* $client = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $client->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        /** Creación del contenido para el correo */
        /* $globalQuote = [
            'addressClient' => 'Address: '.$address,
            'nameClient' => 'Client: '.$clientName,
            'comment' => 'New Update: '.request('comments'),
            'user' => 'User: '.$userName,
            
        ]; */ 

        /** Se busca que usuarios van a recibir el correo */
        /* $marvin =User::find(1);
        $miguel =User::find(2);
        $joseline =User::find(6);
        $ariel =User::find(3); */
        /* $victor =User::find(4); */
        

        /** Se envia la notificación a los usuarios */
        /* $marvin->notify(new Quote($globalQuote));
        $miguel->notify(new Quote($globalQuote));
        $joseline->notify(new Quote($globalQuote));
        $ariel->notify(new Quote($globalQuote)); */
        /* $victor->notify(new Comments($globalQuote)); */

        return redirect()->back()->with('message','Updated Comments'); 
    }

    /** Función pausada */
    public function updateCheckBoxDocument($idDocument, $val){
        $document = PermitDocuments::find($idDocument);
        $document->update([
            'checkList' => $val
        ]);
        $document->save();
    }

    /** Función para editar un permiso */
    public function edit(PermitTicket $permitTicket, $flag){
        //Se muestra la información que contiene el permiso y se pasa como parámetro la flag del template que ha solicitado la edición
        $permitStage = Permitstage::all();
        $permitType = Permittype::all(); 
        $project = Project::find($permitTicket->project_fk);
        $services = $project->services()->get();
        $client = Clientweb:: find($permitTicket->clientweb_fk); 
        return view('Permits.editPermit',compact('permitStage','permitType','project','services','client','permitTicket','flag')); 
    }

    /** Función para actualizar un permiso */
    public function update(Request $request, PermitTicket $permitTicket , $flag){
        //Se actualiza un permiso y de acuerdo al template de donde fue solicitado el controlador, asi retorna la vista
        $today = Carbon::now()->format('m/d/Y');
        $permitTicket->update([
            'project_fk' => request('idProject'),
            'permitStage_fk' => request('permitStage'),
            'clientweb_fk' => request('idClient'),
            'nameTicket' => request('permitName'),
            'numberPermit1' => request('permitNumber1'),
            'namePermit2' => request('permitName2'),
            'numberPermit2' => request('permitNumber2'),
            'contactNameTicket' => request('contactName'),
            'contactPhoneTicket' => request('contactPhone'),
            'contactEmailTicket' => request('contactEmail'),
            'cityPermit' => request('cityPermit'),
            'documentDropoff' => request('documentDropoff'),
            'comentsTicket' => request('comments'),
            'dateStage' => $today,
            'inspectorName' => request('inspectorName'),
            'inspectorTel' => request('inspectorPhone'),
            'inspectorCompany' => request('inspectorCompany'),
            'inspectorEmail' => request('inspectorEmail'),
            'subcontractorName' => request('subcontractorName'),
            'subcontractorTel' => request('subcontractorPhone'),
            'subcontractorCompany' => request('subcontractorCompany'),
            'subcontractorEmail' => request('subcontractorEmail')
        ]);
        $permitTicket->save(); 
        if($flag == 1){
            return redirect()->route('showPermits'); 
        }else{
            return redirect()->route('allPermits');
        }
    }

    /** Función para mostrar el permiso que se va a eliminar */
    public function delete(PermitTicket $permitTicket){
        //Se obtiene toda la información relacionada con el permiso, para luego mostrarla en el template
        $permitStage = Permitstage::all();
        $permitType = Permittype::all(); 
        $permitStage = Permitstage::find($permitTicket->permitStage_fk);
        $permitType = Permittype::find($permitTicket->permitType_fk);
        $project = Project::find($permitTicket->project_fk);
        $services = $project->services()->get();
        $client = Clientweb:: find($permitTicket->clientweb_fk); 
        return view('Permits.deletePermit',compact('permitTicket','permitStage','permitType','services','project',
                                                'permitStage','permitType','client' )); 
    }
    
    /** Función para eliminar un permiso */
    public function destroy(PermitTicket $permitTicket){
        $permitTicket->delete();
        return redirect()->route('showPermits');
    }

    /** Función para actualizar el ticket por medio de un botón */
    public function updateTicket(PermitTicket $permitTicket){
        //El botón se encuentra en la vista de infoPermit
        //La función es solamente para actualizar el permiso sin realizar ninguna modificación
        $permitTicket->updated_at = Carbon::now()->toDateTimeString();
        $permitTicket->save();
        return redirect()->route('infoPermit',[$permitTicket,1]); 
    }

    /** Login para el que el cliente pueda acceder al Dashboard */
    public function loginClient(){
        //Se despliega el template para que el cliente pueda ver el proceso de sus permisos
        //En el template se muestra la validación de los mensajes
        return view('Permits/loginClient')->with('message','login');
    }

    /** Dashboard donde el cliente verá el seguimiento de los permisos de su proyecto */
    public function dashboardClient($email){
        // Se busca el cliente
        $client = Clientweb::where('emailClient',$email)->get();
        // Validación de un cliente, si no existe lo regresa a la pantalla anterior con un mensaje de error
        if($client->isEmpty()){
            return view('Permits/loginClient')->with('message','Error'); 
        }else{
            //Si el cliente existe, se manda la información al template 
            $idClient = $client[0]->id; 
            $permits = PermitTicket::where('clientweb_fk',$idClient)->get(); 
            foreach($permits as $permit){ 
                //Obtengo los comentarios almacenados en el Modelo ComentTicket, todos los registros de acuerdo al id del permiso
                $coments = ComentTicket::where('ticket_fk',$permit->id)
                                        ->orderBy('updated_at','desc')
                                        ->get();
                //Validación para saber si hay permisos sin comentarios
                $date = $permit->updated_at; 
                $stringDate = $date->toDayDateTimeString();
                if($coments->isEmpty()){
                    //Se define una coleccion por defecto en el caso de que no tenga comentarios el permiso
                    $arrayTimes [] = ['idComment' => 0, 'date' => 0, 'time'=> 0,'descripcion'=> ' ', 'ticket_fk' => 0, 'user' => ''];
                }else{
                    foreach ($coments as $c){
                        //Se almacena la información en la colección
                        $dateComment = Carbon::parse($c->updated_at)->format('m/d/Y');
                        $timeComment = Carbon::parse($c->updated_at)->format('g:i A');
                        $arrayTimes[] = ['idComment' => $c->id , 'date' => $dateComment, 'time'=> $timeComment,
                                         'descripcion'=> $c->description, 'ticket_fk' => $c->ticket_fk, 
                                         'user' => $c->users->name];
                    }
                }
                //A la dirección se le quita el estado y el país
                $a = $permit->projects->address_project;
                $addressPermit = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);
                $address[] = ['idPermit' => $permit->id, 'addressPermit' => $addressPermit];
            }
            return view('Permits/dashboardClient',compact('permits','client','arrayTimes','address','stringDate')); 
        }
    }

    /** Función para mostrar el comentario de un timeline */
    public function editTimeLine($idComment){
        //Se obtiene le id del comentario y se envía el objeto al template
        $commentTimeLine = ComentTicket::find($idComment);
        return view('Permits.updateComments',compact('commentTimeLine')); 
    }
    
    /** Función para actualizar un comentario del timeline */
    public function updateTimeLine(Request $request, $idComment){
        //Se obtiene el id del comentario
        $commentTimeLine = ComentTicket::find($idComment);
        //Modificamos el objeto con el nuevo valor
        $commentTimeLine->update([
            'description' => request('comments')
        ]);
        //Se almacenan los cambios y se regresa al template de la información del permiso
        $commentTimeLine->save();
        return redirect()->route('infoPermit',$commentTimeLine->ticket_fk);
    }
    
    /** Función para eliminar el objeto del comentario */
    public function destroyTimeLine($idComment){
        //Se obtien el objeto del comentario y se elimina el objeto
        $commentTimeLine = ComentTicket::find($idComment);
        $commentTimeLine->delete();
        return redirect()->route('infoPermit',$commentTimeLine->ticket_fk);
    }

    public function sendSmsPoolDemoLead($flag, $numberPhone){
        if($flag == 1){
            $msg = "Hello, thanks for your interest in our pool demolition services, please fill in your information here to get a quote in less than 24 hours https://bit.ly/3mhxhXS. Do not reply here.";
        }else{
            $msg = "Hola, gracias por su interés en nuestros servicio de demolición de piscinas,por favor complete su información aquí para obtener una cotización en menos de 24 horas https://bit.ly/3mhxhXS, favor no responder por este medio.";
        }
        $mensaje = $msg;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$numberPhone);
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587010';
        $marvinNumber = '13104099884';

        //SMS TO CLIENT
        /* $smsToClient = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToClient->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $mensaje
        ]); */

        return redirect()->back()->with('messagePoolDemo','SMS Sent');
    }

    public function sendSmsEquipmentRental($flag, $numberPhone){
        if($flag == 1){
            $msg = "Hello, thanks for your interest in renting from us, please fill in your information in the next link to generate a dispatch https://bit.ly/3xcs7DA. If you need to change something please call us or just submit another form. Do not reply here.";
        }else{
            $msg = "Hola, gracias por su interés en alquilar con nosotros, por favor complete sus datos en el siguiente link para generar su despacho https://bit.ly/3xcs7DA. Si necesita cambiar algo, por favor llámenos o envíe otro formulario, favor no responder por este medio.";
        }
        $mensaje = $msg;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$numberPhone);
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587010';
        $marvinNumber = '13104099884';

        //SMS TO CLIENT
        /* $smsToClient = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToClient->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $mensaje
        ]); */

        return redirect()->back()->with('messageEquipment','SMS Sent');
    }

    public function sendSmsEstimateRequest($flag, $numberPhone){
        if($flag == 1){
            $msg = "Hello, for faster service, please fill in your information here https://bit.ly/3GMPtlO. Estimate have a 24 hour turn around. Supplemental documents attached to form please or email us: bids@mvm-machinery.com";
        }else{
            $msg = "Hola, para un mejor servicio, por favor coloca tu información aqui https://bit.ly/3GMPtlO, tendrá su estimación en menos de 24 horas. Por favor adjunte los documentos complementarios al formulario o envíenos un correo eletrónico a: bids@mvm-machinery.com";
        }
        $mensaje = $msg;
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$numberPhone);
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587010';
        $marvinNumber = '13104099884';
        
        //SMS TO CLIENT
        /* $smsToClient = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToClient->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $mensaje
        ]); */
        return redirect()->back()->with('messageEstimate','SMS Sent');
    }

    /******* START QUOTE INFORMATION DOCS  value = 1*/
    /** Se muestra el template para subir archivos de un permiso */
    public function dropzonePermitQuoteInformation(PermitTicket $permitTicket, $value ){
        $project = Project::find($permitTicket->project_fk);
        return view('Permits.docQuoteInformation',compact('permitTicket','project','value')); 
    }

    /** Se obtiene el archivo y se almacena con el permiso, el permiso debe de existir */
    public function dropzoneStoreQuoteInformation(Request $request, PermitTicket $permitTicket, $value){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        switch($value){
            case 1:
                //QUOTE INFORMATION DOCS value = 1
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('quoteInformationDocs'),$fileName);
            break;
            case 2:
                //PROJECT SITE PLAN DOCS  value = 2
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('projectSitePlansDocs'),$fileName);
            break;
            case 3:
                //PROJECT SITE LIST DOCS  value = 3
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('projectSiteListDocs'),$fileName);
            break;
            case 4:
                //PERMIT RECEIPTS DOCS  value = 4
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('permitReceiptsDocs'),$fileName);
            break;
            case 5:
                //PERMITS APPLICATIONS DOCS  value = 5
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('permitsApplicationsDocs'),$fileName);
            break;
            case 6:
                //BUSSINES LICENSE DOCS  value = 6
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('bussinesLicenseDocs'),$fileName);
            break;
            case 7:
                //CITY INSPECTIONS DOCS  value = 7
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('cityInspectionsDocs'),$fileName);
            break;
            case 8:
                //JOBBER QUOTE DOCS  value = 8
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('jobberQuotesDocs'),$fileName);
            break;
            case 9:
                //SITE PLAN DOCS  value = 9
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('sitePlansDocs'),$fileName);
            break;
            case 10:
                //OTHERS value = 10
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('othersDocs'),$fileName);
            break;
            case 11:
                //COVENANT AGREEMENT value = 11
                $file = PermitDocuments ::create([
                    'referenceDocumentPermit' => $fileName,
                    'ticket_fk' => $permitTicket->id,
                    'checkList' => 0,
                    'typeDocumentPermit' => $value,
                ]);
                $fileR->move(public_path('covenantAgreementDocs'),$fileName);
            break;
            default;
        }
        $permitTicket->updated_at = Carbon::now()->toDateTimeString();
        $permitTicket->save();
    }

    /** Esta función actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function destroyDropzoneQuoteInformation($name){
        PermitDocuments::where('referenceDocumentPermit',$name)->delete();
    }
    /******* END QUOTE INFORMATION DOCS ********************/
}
