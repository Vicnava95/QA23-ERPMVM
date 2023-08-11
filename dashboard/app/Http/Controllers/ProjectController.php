<?php

namespace App\Http\Controllers;
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 

use App\Project;
use App\Status;
use App\Manager;
use App\ProjectType;
use App\Category;
use App\Service;
use App\Phase;
use App\Contact;
use App\FileProject;
use App\Purchase;
use App\ClientSource;
use App\Clientweb;
use App\PermitTicket;
use App\Truck;
use App\DailyTruck;
use App\DailyLabor;
use App\ContactProject;
use App\Permitstage; 
use App\ComentTicket;
use App\PermitDocuments;
use App\Mail;
use App\Maildocument;
use App\CommentProject;
use App\DocumentProject;
use App\Todolist;
use App\ToDoListImage;
use App\TimeLineProjectWork;
use App\DailyReport;
use App\PaymentMethod;
use App\Payment;
use App\PaymentImage;
use App\PurchaseCategory;
use Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;
use Carbon\Carbon;
use ZipArchive;


class ProjectController extends Controller
{
    
    public function createZip(Project $project){
        $id = $project->id;
        $files = $project->files()->where('project_id',$id)->get(); 
        //Rutas absolutas
        //$nombreArchivoZip = "C:\Users\Alex\Documents\GitHub\MVM-Copia\app\public".$project->name_project.zip";
        //$nombreArchivoZip = "C:\Users\Alex\Documents\GitHub\MVM-Copia\app\public\prueba2.zip";
        $nombreArchivoZip = public_path(). "/$project->name_project.zip";
        $rutaDelDirentorio = "app/public/uploads";
        $zip = new ZipArchive();
        if (!$zip->open($nombreArchivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            exit("Error abriendo ZIP en $nombreArchivoZip");
        }
        foreach($files as $file){
            $rutaAbsoluta = public_path('uploads')."\\"."$file->reference_file_project";
            $nombre = basename($rutaAbsoluta);
            $zip->addFile($rutaAbsoluta, $nombre);
        }
        $resultado = $zip->close();
        
        if ($resultado) {
            echo "Archivo creado";
        } else {
            echo "Error creando archivo";
        }
        $routeFileZip = public_path()."\\"."$project->name_project.zip";
        /* $nameZipFile = "$project->name_project.zip"; */
        /* $headers = array(
            'Content-Type' => 'application/zip',
        ); */
        /* header("Content-type: application/octet-stream");*/
        /* header("Content-disposition: attachment; $nameZipFile"); */
        //return Response::download($routeFileZip, 'Photos3.zip', array('Content-Type: application/octet-stream','Content-Length: '. filesize($routeFileZip))); 
        //return FacadesResponse::download($routeFileZip);
        return response()->file($routeFileZip); 
    }

    public function index()
    {
        $projects = Project::all(); 
        foreach($projects as $project){
            $services = $project->services;
            $servicesArray = "";
            foreach($services as $service){
                $servicesArray = $servicesArray." - ".$service->name_service;
            }
            $purchases = Purchase::where('project_fk',$project->id)->get();
            $monto = 0;
            foreach($purchases as $purchase){
                $monto += $purchase->amount;
            }
            if($monto == 0){
                $profit = round(0,2) ;
                $profitMargin = 0 ;
            }else{
                $profit = round($project->sold_project - $monto,2) ;
                $profitMargin = round(($profit * 100)/$project->sold_project,2) ;
            }
            
            $infoProject[] = ['pId' => $project->id, 'pName' => $project->name_project, 'pAddress'=> $project->address_project, 'pBudget'=> $project->budget_project,
                              'pSold' => $project->sold_project, 'pPurchases' => $monto, 'pProfit' => $profit, 'pProfitMargin' => $profitMargin, 'pStatus' => $project->statu->name_status,
                              'services' => $servicesArray, 'startDate'=> $project->start_date_project, 'endDate'=> $project->end_date_project];
        }
        //dd($infoProject); 
        return view('Project/show_projects',compact('projects','infoProject'));
    }

    public function activeProjects()
    {
        $projects = Project::orderBy('id','desc')->get();
        $activateProjects = $projects->where('status_fk',1);
        $startingProjects = $projects->where('status_fk',3);
        $pausedProjects = $projects->where('status_fk',5);
        $permitProjects = $projects->where('status_fk',6);
        $projectsD = Project::orderBy('updated_at','desc')->get();
        $finishProjects = $projectsD->where('status_fk',2)
                                    ->take(20);

        $numActivate = $activateProjects->count();
        $numStarting = $startingProjects->count();
        $numFinish = $finishProjects->count();
        $numPaused = $pausedProjects->count();
        $numPermit = $permitProjects->count(); 
        
        $now1 = new DateTime();
        $now = $now1->format('m/d/Y');    // MySQL datetime format

        if($numActivate != 0){
            foreach($activateProjects as $activateProject){
                $purchasesOb = Purchase::where('project_fk',$activateProject->id)->get();

                $services = $activateProject->services()->get();
                $a = $activateProject->address_project;
                $addressActive = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);  
                $projectsServicesActive = DB::table('project_services')->where('project_id',$activateProject->id)->get();
                if(!$services->isEmpty()){
                    foreach ($services as $s){
                        foreach($projectsServicesActive as $projectsServices){
                            if($projectsServices->service_id == $s->id){
                                $arrayServicesA[] = ['idProject' => $activateProject->id , 'service' => $s->name_service, 'principal'=>$projectsServices->principal];
                            }
                        }
                    }
                }else{
                    $arrayServicesA[] = ['idProject' => 0 , 'service' => 0, 'principal'=>0];
                }
                
                 
                
                $suma = 0.00;
                foreach($purchasesOb as $p){
                    $suma += $p->amount;
                }
                $endDate = $activateProject->end_date_project;
    
                //Diferencia del presupuesto con las compras para mostrar alertas
                $budget = $activateProject->budget_project;
                $diferenciaA = $budget - $suma;
                if($diferenciaA < 0){
                    $diferenciaB = $suma - $budget;
                }
                else{
                    $diferenciaB = 0;
                }
    
                //Diferencia para el profit con respecto a la venta de los proyectos activos
                $soldP = $activateProject->sold_project;
                if($suma == 0){
                    $newProfitA = 0;
                }else{
                    $newProfitA = $soldP - $suma;
                }
                
                $dia2 = date_create($endDate);
                //$dia1 = date_create($endDate);
                $dia1 = date_create_from_format('m/d/Y',$endDate);
                $result2 = date_diff($now1,$dia1);
                $result = $result2->format('%a');
                $resultSigno = $result2->format('%R%a');
                //Enviar uno igual con formato de signos para hacer la comparación en el blade
                
                $client = Clientweb::find($activateProject->client_fk);
                if(empty($client)){
                    $nameClient = 'null';
                }else{
                    $nameClient = $client->nameClient;
                }

                $paymentsProject = Payment::where('project_fk',$activateProject->id)
                                    ->get();
                $incomes = 0;
                foreach($paymentsProject as $payProject){
                    $incomes += $payProject->amountPayment;
                }
                $accountReceivables = $soldP - $incomes;
                //dd($incomes);
                $purchasesA[] = ['id' => $activateProject->id , 'value' => $suma ,'diferencia' => $diferenciaA, 'diferenciab' => $diferenciaB,
                'fecha' => $result, 'fechaSigno'=> $resultSigno , 'newProfitA' => $newProfitA , 'address' => $addressActive, 'nameClient' => $nameClient,
                'accountReceivables'=>$accountReceivables];
                
            }
        }
        else{
            $purchasesA[] = ['id' => 0 , 'value' => 0 ,'diferencia' => 0, 'fecha' => 0, 'fechaSigno'=> 0 , 'newProfitA' => 0 , 'address' => '',
            'nameClient' => 'null','accountReceivables'=>0];
            $arrayServicesA[] = ['idProject' => 0 , 'service' => 0, 'principal'=>0];
        }
        //dd($arrayServicesA);

        if($numPaused != 0){
            foreach($pausedProjects as $pProjects){
                $purchasesPauses = Purchase::where('project_fk',$pProjects->id)->get();
                $sumaPPaused = 0.00;

                $services = $pProjects->services()->get();
                $a = $pProjects->address_project;
                $addressPaused = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);
                $projectsServicesPaused = DB::table('project_services')->where('project_id',$pProjects->id)->get();
                if(!$services->isEmpty()){
                    foreach ($services as $s){
                        foreach($projectsServicesPaused as $projectsServices){
                            if($projectsServices->service_id == $s->id){
                                $arrayServicesP[] = ['idProject' => $pProjects->id , 'service' => $s->name_service,'principal'=>$projectsServices->principal];
                            }
                        }
                    }
                }else{
                    $arrayServicesP[] = ['idProject' => 0 , 'service' => 0,'principal'=> 0];
                }
                

                foreach($purchasesPauses as $pur){
                    $sumaPPaused += $pur->amount;
                }

                $soldPaused = $pProjects->sold_project;
                if($sumaPPaused == 0){
                    $newProfitP = 0;
                }else{
                    $newProfitP = $soldPaused - $sumaPPaused;
                }
                
                $client = Clientweb::find($pProjects->client_fk);
                if(empty($client)){
                    $nameClient = 'null';
                }else{
                    $nameClient = $client->nameClient;
                }

                $paymentsProject = Payment::where('project_fk',$pProjects->id)
                                    ->get();
                $incomes = 0;
                foreach($paymentsProject as $payProject){
                    $incomes += $payProject->amountPayment;
                }
                $accountReceivables = $soldPaused - $incomes;

                $purchasesP[] = ['id' => $pProjects->id , 'value' => $sumaPPaused , 'newProfitP' => $newProfitP , 'address' => $addressPaused,
                'nameClient' => $nameClient,'accountReceivables'=>$accountReceivables];
            }
        }else{
            $purchasesP[] = ['id' => 0 , 'value' => 0 , 'newProfit' => 0, 'address' => '','nameClient' => 'null','accountReceivables'=>0];
            $arrayServicesP[] = ['idProject' => 0 , 'service' => 0,'principal'=> 0];
        }
        //dd($arrayServicesP); 
        
        if($numFinish != 0){
            foreach($finishProjects as $finishProject){
                $purchasesOF = Purchase::where('project_fk',$finishProject->id)->get();
                $sumaF = 0.00;

                $services = $finishProject->services()->get();
                $a = $finishProject->address_project;
                $addressFinish = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);
                $projectsServicesFinish = DB::table('project_services')->where('project_id',$finishProject->id)->get();
                if(!$services->isEmpty()){
                    foreach ($services as $s){
                        foreach($projectsServicesFinish as $projectsServices){
                            if($projectsServices->service_id == $s->id){
                                $arrayServicesF[] = ['idProject' => $finishProject->id , 'service' => $s->name_service,'principal'=>$projectsServices->principal];
                            }
                        }
                    }
                }else{
                    $arrayServicesF[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
                }
                

                foreach($purchasesOF as $p){
                    $sumaF += $p->amount;
                }
    
                $soldF = $finishProject->sold_project;
                if($sumaF == 0){
                    $newProfitF = 0;
                }else{
                    $newProfitF = $soldF - $sumaF;
                }

                $client = Clientweb::find($finishProject->client_fk);
                if(empty($client)){
                    $nameClient = 'null';
                }else{
                    $nameClient = $client->nameClient;
                }

                $paymentsProject = Payment::where('project_fk',$finishProject->id)
                                    ->get();
                $incomes = 0;
                foreach($paymentsProject as $payProject){
                    $incomes += $payProject->amountPayment;
                }
                $accountReceivables = $soldF - $incomes;

                $purchasesF[] = ['id' => $finishProject->id , 'value' => $sumaF, 'newProfitF' => $newProfitF , 'address'=> $addressFinish,
                'nameClient' => $nameClient, 'accountReceivables'=>$accountReceivables];
            }
        }
        else{
            $purchasesF[] = ['id' => 0 , 'value' => 0, 'newProfitF' => 0 , 'address'=> '','nameClient' => 'null','accountReceivables'=>0];
            $arrayServicesF[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
        }
        //dd($purchasesF); 
        
        if($numStarting != 0){
            foreach($startingProjects as $startingProject){
                $purchasesOS = Purchase::where('project_fk',$startingProject->id)->get();
                $sumaS = 0.00;

                $a = $startingProject->address_project;
                $addressStarting = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);
                $projectsServicesStarting = DB::table('project_services')->where('project_id',$startingProject->id)->get();
                $services = $startingProject->services()->get();

                if(!$services->isEmpty() ){
                    foreach ($services as $s){
                        /* dd($s); */
                        foreach($projectsServicesStarting as $projectsServices){
                            if($projectsServices->service_id == $s->id){
                                $arrayServicesS[] = ['idProject' => $startingProject->id , 'service' => $s->name_service, 'principal'=>$projectsServices->principal];
                            }
                        }
                    }
                }else{
                    $arrayServicesS[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
                }
                
                foreach($purchasesOS as $p){
                    $sumaS += $p->amount;
                }
                $soldSP = $startingProject->sold_project;
                if($sumaS == 0){
                    $newProfitSP = 0;
                }else{
                    $newProfitSP = $soldSP - $sumaS;
                }     

                $client = Clientweb::find($startingProject->client_fk);
                if(empty($client)){
                    $nameClient = 'null';
                }else{
                    $nameClient = $client->nameClient;
                }  
                
                $paymentsProject = Payment::where('project_fk',$startingProject->id)
                                    ->get();
                $incomes = 0;
                foreach($paymentsProject as $payProject){
                    $incomes += $payProject->amountPayment;
                }
                $accountReceivables = $soldSP - $incomes;

                $purchasesS[] = ['id' => $startingProject->id , 'value' => $sumaS, 'newProfitSP' => $newProfitSP, 'address' => $addressStarting,
                'nameClient' => $nameClient,'accountReceivables'=>$accountReceivables];
            }
        }
        else{
            $purchasesS[] = ['id' => 0 , 'value' => 0, 'newProfitSP' => 0, 'address' => '','nameClient' => 'null','accountReceivables'=>0];
            $arrayServicesS[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
        }

        if($numPermit != 0){
            foreach($permitProjects as $permitPro){
                $purchasesPermit = Purchase::where('project_fk',$permitPro->id)->get();
                $sumaPermitPaused = 0.00;

                $services = $permitPro->services()->get();
                $a = $permitPro->address_project;
                $addressPermit = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$a);
                $projectsServicesPermit = DB::table('project_services')->where('project_id',$permitPro->id)->get();
                if(!$services->isEmpty()){
                    foreach ($services as $s){
                        foreach($projectsServicesPermit as $projectsServices){
                            if($projectsServices->service_id == $s->id){
                                $arrayServicesPermit[] = ['idProject' => $permitPro->id , 'service' => $s->name_service, 'principal'=>$projectsServices->principal];
                            }
                        }
                    }
                }else{
                    $arrayServicesPermit[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
                }
                

                foreach($purchasesPermit as $pur){
                    $sumaPermitPaused += $pur->amount;
                }

                $soldPermit = $permitPro->sold_project;
                if($sumaPermitPaused == 0){
                    $newProfitP = 0;
                }else{
                    $newProfitP = $soldPermit - $sumaPermitPaused;
                }

                $client = Clientweb::find($permitPro->client_fk);
                if(empty($client)){
                    $nameClient = 'null';
                }else{
                    $nameClient = $client->nameClient;
                }

                $paymentsProject = Payment::where('project_fk',$permitPro->id)
                                    ->get();
                $incomes = 0;
                foreach($paymentsProject as $payProject){
                    $incomes += $payProject->amountPayment;
                }
                $accountReceivables = $soldPermit - $incomes;

                $purchasesPermits[] = ['id' => $permitPro->id , 'value' => $sumaPermitPaused , 'newProfitP' => $newProfitP , 'address' => $addressPermit,'nameClient' => $nameClient,
                'accountReceivables'=>$accountReceivables];
            }
        }else{
            $purchasesPermits[] = ['id' => 0 , 'value' => 0 , 'newProfit' => 0, 'address' => '', 'nameClient' => 'null',
            'accountReceivables'=>0];
            $arrayServicesPermit[] = ['idProject' => 0 , 'service' => 0,'principal'=>0];
        }
        $allPermitTickets =PermitTicket::all();
        $paymentMethod = PaymentMethod::where('namePaymentMethodStatus',1)->get();

        return view('Project/projectActive',compact('activateProjects','startingProjects','finishProjects',
                                                    'pausedProjects','permitProjects','purchasesA','purchasesF','purchasesS',
                                                    'purchasesP','purchasesPermits','arrayServicesA','arrayServicesP','arrayServicesF',
                                                    'arrayServicesS','arrayServicesPermit','allPermitTickets','paymentMethod'));
    }

    public function showPermit($idProject){
        $ticket = PermitTicket::where('project_fk',$idProject)->get();
        //dd($ticket); 
        return redirect()->route('infoPermit',$ticket[0]->id);
    }

    public function create()
    {
        $status = Status::where('generalStatus',1)->get();
        $managers = Manager::where('generalStatus',1)->get();
        $projectTypes = ProjectType::where('generalStatus',1)->get();
        $categoris = Category::where('generalStatus',1)->get();
        $services = Service::where('generalStatus',1)->get();
        $clientSource = ClientSource::all();
        return view('Project/new_project',compact('status','managers','projectTypes','categoris','services','clientSource'));
    }

    public function store()
    { 
        $validatedData = request()->validate([
            'name' => ['required'],
            'phone' => ['required']
       ]);

        //Create project
        $project = Project::create([
            'status_fk' => request('statusProject'),
            'name_project' => request('nameProject'),
            'address_project' => request('project_address'),
            'manager_fk' => request('selectManager'),
            'start_date_project' => request('start_date'),
            'end_date_project' => request('end_date'),
            'budget_project' => request('budgetProyect'),
            'sold_project' => request('soldProject'),
            'profit_project' => request('profitProject'),
            'total_sold_project' => request('totalProject'),
            'scope_project' => request('note'),
            'project_type_fk' => request('projectType'),
            'category_fk' => request('category'),
            'client_fk' => request('idClientName'),
        ]);

        if(request('selectClientSource') == 0){
            $project->client_source_fk  = 6;
        }else{
            $project->client_source_fk  = request('selectClientSource');
        }

        $project->save(); 
         
        $project_id = $project->id;
        $valorNull = "";

        //Create Relationships with Services
        $service = request()->service;
        $project->services()->attach($service);

        $projectsServices = DB::table('project_services')->where('project_id',$project->id)->get();
        foreach($projectsServices as $pServices){
            if($pServices->service_id == request('principal')){
                DB::table('project_services')
                ->where('id', $pServices->id)
                ->update(['principal' => 1]);
            }else{
                DB::table('project_services')
                ->where('id', $pServices->id)
                ->update(['principal' => 0]);
            }
        }

        //Phases
        if(count(request()->phaseNameProject) > 0){
            foreach(request()->phaseNameProject as $item=>$v){
                if(strcmp(request()->phaseNameProject[$item], $valorNull)!==0){
                    $dataPhase = array(
                        'name_phase' => request()->phaseNameProject[$item],
                        'text_phase' => request()->phaseTextProject[$item],
                        'budget_phase' => request()->phaseBudgetProject[$item],
                        'sold_phase' => request()->phaseSoldProject[$item],
                    );
                    $phase = Phase::create($dataPhase);
                    $project->phases()->attach($phase);
                }
                else{
                    $dataPhase = array(
                        'name_phase' => "Empty",
                        'text_phase' => "Empty",
                        'budget_phase' => 0,
                        'sold_phase' => 0,
                    );
                    $phase = Phase::create($dataPhase);
                    $project->phases()->attach($phase);  
                }

                $pivotTable = DB::table('project_phases')->where('phase_id',$phase->id)->get();

                DB::table('project_phases')
                    ->where('id', $pivotTable[0]->id)
                    ->update(['service_id' => request()->inputService[$item]]);
            }
        }

        //Contact
        if (count(request()->name) > 0){
            foreach(request()->name as $item=>$v){
                if(strcmp(request()->name[$item], $valorNull)!== 0 && strcmp(request()->phone[$item], $valorNull) !== 0){
                    $dataContact=array(
                        'name_contact'=> request()->name[$item],
                        'phone_contact'=> request()->phone[$item],
                    );
                    $contact = Contact::create($dataContact);
                    $project->contacts()->attach($contact);
                }else if(strcmp(request()->name[$item], $valorNull)!== 0 && strcmp(request()->phone[$item], $valorNull) == 0){
                    $dataContact=array(
                        'name_contact'=> request()->name[$item],
                        'phone_contact'=> 000,
                    );
                    $contact = Contact::create($dataContact);
                    $project->contacts()->attach($contact);
                }else if(strcmp(request()->name[$item], $valorNull) == 0 && strcmp(request()->phone[$item], $valorNull) !== 0){
                    $dataContact=array(
                        'name_contact'=> 'Empty',
                        'phone_contact'=> request()->phone[$item],
                    );
                    $contact = Contact::create($dataContact);
                    $project->contacts()->attach($contact);
                }
                    
            }
        }
        
        //Files
        //$file = base64_decode(request('file'));
        $file = request()->file('file');
        //dd($file);
        if($file != null){
            if(strcmp($file[0],$valorNull)!==0){
                if (count($file) > 0){
                    foreach(request()->file as $item=>$v){
                        if(strcmp(request()->file[$item], $valorNull)!==0){
                            $file = FileProject ::create([
                                'reference_file_project' => request()->file('file')[$item]->hashName()
                            ]);
                            $filename = request()->file('file')[$item]->hashName();
                            request()->file('file')[$item]->move(public_path('uploads'),$filename);
                            $project->files()->attach($file);
                        }
                    }
                }
            }
        }
        

        //Creación de camiones
        $truck = Truck::create([
            'project_fk' => $project_id,
            'yards' => request('yards'),
            'importDirt' => request('importDirt'),
            'importAsphalt' => request('importAsphalt'),
            'importAggregates' => request('importAggregates'),
            'importBase' => request('importBase'),
            'importGravell' => request('importGravell'),
            'importSand' => request('importSand'),
            'importSoil' => request('importSoil'),
            'exportDirtRock' => request('exportDirtRock'),
            'exportAsphalt' => request('exportAsphalt'),
            'exportDirt' => request('exportDirt'),
            'exportConcrete' => request('exportConcrete'),
            'exportMixed' => request('exportMixed'),
            'exportTrash' => request('exportTrash'),
            'exportTrash40CY' => request('exportTrash40CY'),
            'description' => request('descriptionMaterial')
        ]);
        $truck->save();

        $clientFK = $project->client_fk;
        if(!empty($clientFK)){
            $contactProject = ContactProject::create([
                'project_fk' => $project_id,
                'idClient' => $clientFK
            ]);
            $contactProject->save();
        }

        $projectAddress = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$project->address_project);
        $clientSource = ClientSource::find($project->client_source_fk)->first();
        $message =  "NEW PROJECT ERP \n".
            "\n"."Project Name: ".$project->name_project.
            "\n"."Project Address: ".$projectAddress.
            "\n"."Start Date: ".$project->start_date_project;

            //dd($message);

            /* MODIFICAR */
            $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
            $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
            $TWILIO_NUMBER='14753234196';
            $marvinNumber = '13104099884';
            //$joselinNumber = '13109127546';
            //$diegoNumber = '13109127546';

            //SMS TO MARVIN
            $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
            $smsToMarvin->messages->create($marvinNumber, [
                'from' => $TWILIO_NUMBER,
                'body' => $message
            ]);
        
        return view('Project/dropzoneProject',compact('project'));
        //return redirect()->route('project.active');             
    }

    public function dropzone(Project $project){
        return view('Project.dropzoneProject',compact('project')); 
    }

    public function storeDropzone(Request $request, Project $project){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = FileProject ::create([
            'reference_file_project' => $fileName
        ]);
        $fileR->move(public_path('uploads'),$fileName);
        /* DB::table('project_file_projects')->insert([
            'project_id' => $project->id,
            'file_project_id' => $file->id
        ]); */
        $project->files()->attach($file);
    }
    
    public function editDropzone(Project $project){
        return view('Project.editDropzoneProject',compact('project')); 
    }

    public function updateDropzone(Request $request, Project $project){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = FileProject ::create([
            'reference_file_project' => $fileName
        ]);
        $fileR->move(public_path('uploads'),$fileName);
        /* DB::table('project_file_projects')->insert([
            'project_id' => $project->id,
            'file_project_id' => $file->id
        ]); */
        $project->files()->attach($file);
    }
    
    public function deleteDropzone(Request $request, $name){
        FileProject::where('reference_file_project',$name)->delete();
        return redirect()->back();
        
    }

    public function deleteDropzoneMoreInfo(Request $request, Project $project, $name ){
        FileProject::where('reference_file_project',$name)->delete();
        return redirect()->route('project.moreInfo',$project);
    }

    public function deleteDropzoneMoreInfo2(Request $request, Project $project, $name ){
        FileProject::where('reference_file_project',$name)->delete();
        return redirect()->route('project.moreInfo2',$project);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $services = $project->services()->where('project_id',$id)->get();
        $phases = $project->phases()->where('project_id',$id)->get();
        $contacts = $project->contacts()->where('project_id',$id)->get();
        $files = $project->files()->where('project_id',$id)->get(); 
        return view('Project/project',compact('project','services','phases','contacts','files'));
    }

    public function edit(Project $project)
    {
        $status = Status::where('generalStatus',1)->get();
        $managers = Manager::where('generalStatus',1)->get();
        $projectTypes = ProjectType::where('generalStatus',1)->get();
        $categoris = Category::where('generalStatus',1)->get();
        $servicios = Service::where('generalStatus',1)->get();
        $clientSource = ClientSource::all();

        $servicesP = $project->services()->where('project_id',$project->id)->get();
        $phases = $project->phases()->where('project_id',$project->id)->get();
        $contacts = $project->contacts()->where('project_id',$project->id)->get();

        $projectsServices = DB::table('project_services')->where('project_id',$project->id)->get();
        $principalService = 0;
        foreach($projectsServices as $proServices){
            if($proServices->principal != null){
                $principalService = $proServices->service_id;
            }
        }

        //Modificación de clientes y camiones
        $clientes = Clientweb::find($project->client_fk);
        if(empty($clientes)){
            $clients[] = ['id' => 0 , 'name' => 'null'];
        }else{
            $clients[] = ['id' => $clientes->id , 'name' => $clientes->nameClient];
        }

        $idtruck = Truck::where('project_fk',$project->id)->get(); 
        if($idtruck->isEmpty()){
            $truck = Truck::create([
                'project_fk' => $project->id,
                'yards' => 0,
                'importDirt' => 0,
                'importAsphalt' => 0,
                'importAggregates' => 0,
                'importBase' => 0,
                'importGravell' => 0,
                'exportDirtRock' => 0,
                'exportAsphalt' => 0,
                'exportDirt' => 0,
                'exportConcrete' => 0,
                'exportMixed' => 0
            ]);
            $truck->save(); 
        }else{
            $truck = Truck::find($idtruck[0]->id);
        }
        //dd($truck); 
        //return $servicesP->services->id;
        return view('Project/edit_project',compact('project','status','managers','projectTypes',
                                                    'categoris','servicios','servicesP','phases',
                                                    'contacts','clientSource','clients','truck','principalService'));
    }

    public function update(Request $request, Project $project)
    { 
        if(request('statusProject') == '2'){
            // Contar los días trabajados por proyecto, siempre y cuando sea del tipo labor
            $purchasesLabor = Purchase ::where('project_fk',$project->id)
                                        ->whereIn('purchase_categorie_fk',[6,27,28,29,30,31,32,33,34,35,36,37,38])
                                        ->orderBy('date_purchase','desc')
                                        ->orderBy('purchase_categorie_fk','desc')
                                        ->get();
            $daysLaborArray = [];
            foreach ($purchasesLabor as $purchase){
                /*Initialize array with projects*/ 
                if( !in_array( $purchase->date_purchase ,$daysLaborArray ) )
                {
                    array_push($daysLaborArray,$purchase->date_purchase);
                }
            }
            $daysWorked = count($daysLaborArray);

            $purchases = Purchase ::where('project_fk',$project->id)->get();
            //Compras totales
            $suma1 = 0.00;
            foreach($purchases as $purchase){
                $suma1 += $purchase->amount;
            }

            $sold = $project->sold_project;
            if ($suma1 == 0 ){
                $newProfit = 0;
                $newMargin = 0;
            }else if( $sold == 0) {
                $newProfit = 0;
                $newMargin = round($sold-$suma1,2);
            }else{
                $newMargin = round($sold-$suma1,2);
                $newProfit = number_format(($newMargin*100)/$sold,2);
            }

            $message =  "PROJECT IS FINALIZED\n".
            "\n"."Project: ".$project->name_project."\n".
            "Sold for: ".$project->total_sold_project.
            "\n"."Purchases: $".$suma1.
            "\n"."Profit: $".$newMargin.
            "\n"."Worked Days: ".$daysWorked;

            //dd($message);

            $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
            $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
            $TWILIO_NUMBER='14753234196';
            //$marvinNumber = '13104099884';
            //$joselinNumber = '13109127546';

            //SMS TO MARVIN
            /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
            $smsToMarvin->messages->create($joselinNumber, [
                'from' => $TWILIO_NUMBER,
                'body' => $message
            ]); */
        }


        $project->update([
            'status_fk' => request('statusProject'),
            'name_project' => request('nameProject'),
            'address_project' => request('project_address'),
            'manager_fk' => request('selectManager'),
            'start_date_project' => request('start_date'),
            'end_date_project' => request('end_date'),
            'budget_project' => request('budgetProyect'),
            'sold_project' => request('soldProject'),
            'profit_project' => request('profitProject'),
            'total_sold_project' => request('totalProject'),
            'scope_project' => request('note'),
            'project_type_fk' => request('projectType'),
            'category_fk' => request('category'),
            'client_fk' => request('idClientName'),
        ]);
        $project->client_source_fk  = request('selectClientSource');
        $project->save();
        $valorNull = "";

        $service = request()->service;
        $project->services()->sync($service);//Actualiza los servicios

        $projectsServices = DB::table('project_services')->where('project_id',$project->id)->get();
        foreach($projectsServices as $pServices){
            if($pServices->service_id == request('principal')){
                DB::table('project_services')
                ->where('id', $pServices->id)
                ->update(['principal' => 1]);
            }
        }

        /*      if (count(request()->name) > 0){
            foreach(request()->name as $item=>$v){
                if(strcmp(request()->name[$item], $valorNull)!==0){
                    $dataContact=array(
                        'name_contact'=> request()->name[$item],
                        'phone_contact'=> request()->phone[$item],
                    );
                    $contact = Contact::firstOrCreate($dataContact);
                    $project->contacts()->sync($contact);
                }
            }
        } */

        //Camiones
        $idtruck = Truck::where('project_fk',$project->id)->get();
        $truck = Truck::find($idtruck[0]->id);
        $truck->update([
            'project_fk' => $project->id,
            'yards' => request('yards'),
            'importDirt' => request('importDirt'),
            'importAsphalt' => request('importAsphalt'),
            'importAggregates' => request('importAggregates'),
            'importBase' => request('importBase'),
            'importGravell' => request('importGravell'),
            'importSand' => request('importSand'),
            'importSoil' => request('importSoil'),
            'exportDirtRock' => request('exportDirtRock'),
            'exportAsphalt' => request('exportAsphalt'),
            'exportDirt' => request('exportDirt'),
            'exportConcrete' => request('exportConcrete'),
            'exportMixed' => request('exportMixed'),
            'exportTrash' => request('exportTrash'),
            'exportTrash40CY' => request('exportTrash40CY'),
            'description' => request('descriptionMaterial')
        ]);
        $truck->save(); 

        //dd($request); 
        $clientFK = $project->client_fk;
        
        if(!empty($clientFK)){
            if($project->client_fk != request('idClientName')){
                $findProject = ContactProject::where('project_fk',$project->id)->get(); 
            //dd($findProject);
                if(empty($findProject)){
                    $contactProjecto = ContactProject::find($findProject[0]->id);
                    $contactProjecto->update([
                        'idClient' => $clientFK,
                    ]);
                    $contactProjecto->save();
                }else{
                    $contactProject = ContactProject::create([
                        'project_fk' => $project->id,
                        'idClient' => $clientFK
                    ]);
                    $contactProject->save();
                }
            }
        }
        //return $dataContact;
        //return view('Project.editDropzoneProject',compact('project')); 
        return redirect()->route('project.moreInfo',$project);
    }

    public function updateStatus(Project $project, $id){
        $project->update([
            'status_fk' => $id
        ]);

        if($id == 2){
            // Contar los días trabajados por proyecto, siempre y cuando sea del tipo labor
            $purchasesLabor = Purchase ::where('project_fk',$project->id)
                                        ->whereIn('purchase_categorie_fk',[6,27,28,29,30,31,32,33,34,35,36,37,38])
                                        ->orderBy('date_purchase','desc')
                                        ->orderBy('purchase_categorie_fk','desc')
                                        ->get();
            $daysLaborArray = [];
            foreach ($purchasesLabor as $purchase){
                /*Initialize array with projects*/ 
                if( !in_array( $purchase->date_purchase ,$daysLaborArray ) )
                {
                    array_push($daysLaborArray,$purchase->date_purchase);
                }
            }
            $daysWorked = count($daysLaborArray);

            $purchases = Purchase ::where('project_fk',$project->id)->get();
            //Compras totales
            $suma1 = 0.00;
            foreach($purchases as $purchase){
                $suma1 += $purchase->amount;
            }

            $sold = $project->sold_project;
            if ($suma1 == 0 ){
                $newProfit = 0;
                $newMargin = 0;
            }else if( $sold == 0) {
                $newProfit = 0;
                $newMargin = round($sold-$suma1,2);
            }else{
                $newMargin = round($sold-$suma1,2);
                $newProfit = number_format(($newMargin*100)/$sold,2);
            }

            $message =  "PROJECT IS UPDATED\n".
            "\n"."Project: ".$project->name_project."\n".
            "Sold for: ".$project->total_sold_project.
            "\n"."Purchases: $".$suma1.
            "\n"."Profit: $".$newMargin.
            "\n"."Worked Days: ".$daysWorked;

            $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
            $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
            $TWILIO_NUMBER='14753234196';
            $marvinNumber = '13104099884';
            //$joselinNumber = '13109127546';

            //SMS TO MARVIN
            /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
            $smsToMarvin->messages->create($marvinNumber, [
                'from' => $TWILIO_NUMBER,
                'body' => $message
            ]); */
        }
        return redirect()->back();
    }

    public function updateEndDateProject($idProject, $endDate){
        $ymd = DateTime::createFromFormat('m-d-Y', $endDate)->format('m/d/Y');
        $project = Project::find($idProject);
        $project->update([
            'end_date_project' => $ymd, 
            'status_fk' => 2
        ]);
        return redirect()->route('project.active');
    }

    public function updateEndDate($idProject, $endDate ){

        $ymd = DateTime::createFromFormat('m-d-Y', $endDate)->format('m/d/Y');
        $project = Project::find($idProject);
        $project->update([
            'end_date_project' => $ymd, 
            'status_fk' => 5
        ]);
        return response(200)->header('Content-type','text/plain');
    }

    public function confirm(Project $project)
    {
        $services = $project->services()->where('project_id',$project->id)->get();
        $phases = $project->phases()->where('project_id',$project->id)->get();
        $contacts = $project->contacts()->where('project_id',$project->id)->get();
        $clientes = Clientweb::find($project->client_fk);
        if(empty($clientes)){
            $clients[] = ['id' => 0 , 'name' => 'null'];
        }else{
            $clients[] = ['id' => $clientes->id , 'name' => $clientes->nameClient];
        }

        $idtruck = Truck::where('project_fk',$project->id)->get();
        //dd($idtruck); 
        //$truck = Truck::find($idtruck[0]->id);
        if($idtruck->isEmpty()){
            $truck[] = ['id' => 0, 'yards' => 0, 'importDirt' => 0, 'importAsphalt' => 0, 'importAggregates' => 0, 'importBase' => 0,
                        'importGravell' => 0, 'exportDirt' => 0, 'exportAsphalt' => 0, 'exportDirtRock' => 0, 'exportConcrete' => 0, 'exportMixed' => 0,];
            
        }else{
            $truck1 = Truck::find($idtruck[0]->id);
            $truck[] = ['id' => $truck1->id, 'yards' => $truck1->yards, 'importDirt' => $truck1->importDirt,'importAsphalt' => $truck1->importAsphalt, 
                        'importAggregates' => $truck1->importAggregates, 'importBase' => $truck1->importBase, 'importGravell' => $truck1->importGravell, 
                        'exportDirt' => $truck1->exportDirt, 'exportAsphalt' => $truck1->exportAsphalt, 'exportDirtRock' => $truck1->exportDirtRock, 
                        'exportConcrete' => $truck1->exportConcrete, 'exportMixed' => $truck1->exportMixed];
        }

        return view('Project/confirmProject',compact('project','services','phases','contacts','clients','truck'));
    }
    public function destroy(Project $project, $idTruck)
    {
        $truck = Truck::find($idTruck);
        if(!empty($truck)){
            $truck->delete();
        }
        $project->delete();
        return redirect()->route('project.index');

    }

    public function projectTracker(Project $project){
        $suma = 0.00;
        $id = $project->id;
        //$phases = $project->phases()->where('project_id',$id)->get();
        $services = $project->services()->where('project_id',$id)->get();
        $purchases = Purchase ::where('project_fk',$id)->get();
        foreach($purchases as $purchase){
            $suma += $purchase->amount;
        }
        $sold = $project->sold_project;
        if ($suma == 0 ){
            $newProfit = 0;
            $newMargin = 0;
        }else if( $sold == 0) {
            $newProfit = 0;
            $newMargin = $sold-$suma;
        }else{
            $newMargin = $sold-$suma;
            $newProfit = number_format(($newMargin*100)/$sold,2);
        }

        $contador = count($purchases);
        return view('Project.projectTracker',compact('project','services','purchases','suma','contador','newMargin','newProfit'));
    }

    public function fetchP($name){
        //query es el dato que viene del template por medio del JS
        if($name != ''){
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$name}%")
                ->orwhere('id','LIKE',"%{$name}%")
                ->orwhere('address_project','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul id="listP" class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li style="margin-left:10px; margin-bottom:8px;" value="'.$row->id.' "onclick=window.location="/dashboard/public/moreInfo/'.$row->id.'">'.' • '.$row->name_project.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    public function fetchProjectDaily($name){
        //query es el dato que viene del template por medio del JS
        if($name != ''){
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul id="listP" class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li value="'.$row->id.'" >'.$row->name_project.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    public function moreInfoProject($id1){
        $project = Project::find($id1);
        $projectAddress = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$project->address_project);  
        $services = $project->services()->get();
        $projectsServices = DB::table('project_services')->where('project_id',$project->id)->get();
        $principalService = 0;
        foreach($projectsServices as $proServices){
            if($proServices->principal != null){
                $principalService = $proServices->service_id;
            }
        }

        $id = $project->id;
        /** Validación para conocer si el proyecto tiene relacionado un cliente */
        if($project->client_fk == null){
            $client = null; 
        }else{
            $client = Clientweb::find($project->client_fk); 
        }
        
        $files = $project->files()->where('project_id',$id)->get(); 
        if(count($files) != 0){
            $first = $files[0]->id;
        }else{
            $first = 0;
        }   
        $purchases = Purchase ::where('project_fk',$id)
                                ->orderBy('date_purchase','desc')
                                ->orderBy('purchase_categorie_fk','desc')
                                ->get();

        $purchasesAll = Purchase ::where('project_fk',$id)
                                ->orderBy('date_purchase','desc')
                                ->orderBy('purchase_categorie_fk','desc')
                                ->get();
        //dd($purchases);
        $purchasesGraph = Purchase ::where('project_fk',$id)
                                ->orderBy('date_purchase','asc')
                                ->orderBy('purchase_categorie_fk','desc')
                                ->get();

        $fechasPurchases= [];
        foreach($purchasesGraph as $pur){
            if(!in_array($pur['date_purchase'],$fechasPurchases))
            {
                array_push($fechasPurchases,$pur['date_purchase']);
            }
        }

        $c = $purchasesGraph->count();
        //dd($c);
        if($c != 0){
            foreach($fechasPurchases as $fecha){
                $sumaxDate = 0.00;
                foreach($purchasesGraph as $pur){
                    if($fecha == $pur->date_purchase){
                        $sumaxDate += $pur->amount;
                    }
                }
                $SpentxDate[] = ['date' => $fecha ,'total' => round($sumaxDate,2)];
            }
        }else{
            $SpentxDate[] = ['date' => '12/12/2021' ,'total' => 0];
        }

        $t = 0;
        foreach($SpentxDate as $spent){
            $t += $spent['total'] ;
        }

        $cantDailyPurchase = 0;
        if($t != 0){
            $cantDailyPurchase = count($SpentxDate);
        }
        //dd($cantDailyPurchase); 

        function getPurchases($idP,$idCate){
            $purchasesFunction = Purchase :: where('purchase_categorie_fk',$idCate)
                                    ->where('project_fk',$idP)
                                    ->get();
            return $purchasesFunction;
        }

        /*** PAYROLL */
        $laborCategories = PurchaseCategory::where('type_category','labor')->get();
        foreach($laborCategories as $laborCategorie){
            $totalPurchasesLabor = Purchase :: where('purchase_categorie_fk',$laborCategorie->id)
                                                ->where('project_fk',$id)
                                                ->get();
            $amount = 0;
            foreach($totalPurchasesLabor as $totalPurLabor){
               $amount += $totalPurLabor->amount;
            }
            $arrayLaborsPurchasePayroll[] = ['id'=> $laborCategorie->id, 'name'=> $laborCategorie->name_category, 'total'=>$amount]; 
        }
        //dd($laborCategories);
        /*** OTHERS */

        $sumaToolsMaterial1 = 0.00;
        $purchasesToolsMaterial = getPurchases($id,1);
        foreach($purchasesToolsMaterial as $pToolsMaterial){
            $sumaToolsMaterial1 += $pToolsMaterial->amount;
        }
        $sumaToolsMaterial = round($sumaToolsMaterial1,2);

        $sumaSubcontractor1 = 0.00; 
        $purchasesSubcontractor = getPurchases($id,2);
        foreach($purchasesSubcontractor as $pSubcontractor){
            $sumaSubcontractor1 += $pSubcontractor->amount;
        }
        $sumaSubcontractor = round($sumaSubcontractor1,2);

        $sumaAggregatesImport1 = 0.00;
        $purchasesAggregatesImport = getPurchases($id,3);   
        foreach($purchasesAggregatesImport as $pAggregatesImport){
            $sumaAggregatesImport1 += $pAggregatesImport->amount;
        }   
        $sumaAggregatesImportId3 = round($sumaAggregatesImport1,2);

        $sumaMaterialExport1 = 0.00;
        $purchasesMaterialExport = getPurchases($id,4);
        foreach($purchasesMaterialExport as $pMaterialExport){
            $sumaMaterialExport1 += $pMaterialExport->amount;
        }
        $sumaMaterialExport = round($sumaMaterialExport1,2);

        $sumaHomedepotLowes1 = 0.00; 
        $purchasesHomedepotLowes = getPurchases($id,7);
        foreach($purchasesHomedepotLowes as $pHomedepotLowes){
            $sumaHomedepotLowes1 += $pHomedepotLowes->amount;
        }
        $sumaHomedepotLowes = round($sumaHomedepotLowes1,2);

        $sumaMaterials1 = 0.00; 
        $purchasesMaterials = getPurchases($id,8);
        foreach($purchasesMaterials as $pToolsMateria){
            $sumaMaterials1 += $pToolsMateria->amount;
        }
        $sumaMaterials = round($sumaMaterials1,2);

        $sumaRepairsTow1 = 0.00;
        $purchasesRepairsTow = getPurchases($id,9);
        foreach($purchasesRepairsTow as $pRepairsTow){
            $sumaRepairsTow1 += $pRepairsTow->amount;
        }
        $sumaRepairsTow = round($sumaRepairsTow1,2);

        $sumaEquipmentRental1 = 0.00;
        $purchasesEquipmentRental = getPurchases($id,10);
        foreach($purchasesEquipmentRental as $pEquipmentRental){
            $sumaEquipmentRental1 += $pEquipmentRental->amount;
        }
        $sumaEquipmentRental = round($sumaEquipmentRental1,2);

        $sumaBrokenConcreteTruck1 = 0.00;
        $purchasesBrokenConcreteTruck = getPurchases($id,11);
        foreach($purchasesBrokenConcreteTruck as $pBrokenConcreteTruck){
            $sumaBrokenConcreteTruck1 += $pBrokenConcreteTruck->amount;
        }
        $sumaBrokenConcreteTruck = round($sumaBrokenConcreteTruck1,2);

        $sumaDirtTruckHauling1 = 0.00;
        $purchasesDirtTruckHauling = getPurchases($id,12);
        foreach($purchasesDirtTruckHauling as $pDirtTruckHauling){
            $sumaDirtTruckHauling1 += $pDirtTruckHauling->amount;
        }
        $sumaDirtTruckHauling = round($sumaDirtTruckHauling1,2);


        $sumaMixedTruckHauling1 = 0.00;
        $purchasesMixedTruckHauling = getPurchases($id,13);
        foreach($purchasesMixedTruckHauling as $pMixedTruckHauling){
            $sumaMixedTruckHauling1 += $pMixedTruckHauling->amount;
        }
        $sumaMixedTruckHauling = round($sumaMixedTruckHauling1,2);

        $sumaImportAggregates1 = 0.00; 
        $purchasesImportAggregates = getPurchases($id,14);
        foreach($purchasesImportAggregates as $pImportAggregates){
            $sumaImportAggregates1 += $pImportAggregates->amount;
        }
        $sumaImportAggregates = round($sumaImportAggregates1,2);

        $sumaOfficeAdmin1 = 0.00;
        $purchasesOfficeAdmin = getPurchases($id,15);
        foreach($purchasesOfficeAdmin as $pOfficeAdmin){
            $sumaOfficeAdmin1 += $pOfficeAdmin->amount;
        } 
        $sumaOfficeAdmin = round($sumaOfficeAdmin1,2);

        $sumaToolPurchase1 = 0.00;
        $purchasesToolPurchase = getPurchases($id,16);
        foreach($purchasesToolPurchase as $pToolPurchase){
            $sumaToolPurchase1 += $pToolPurchase->amount;
        }
        $sumaToolPurchase = round($sumaToolPurchase1,2);

        $sumaToolsRental1 = 0.00; 
        $purchasesToolsRental = getPurchases($id,17);
        foreach($purchasesToolsRental as $pToolsRental){
            $sumaToolsRental1 += $pToolsRental->amount;
        }
        $sumaToolsRental = round($sumaToolsRental1,2);

        $sumaMiscellaneous1 = 0.00; 
        $purchasesMiscellaneou = getPurchases($id,18);
        foreach($purchasesMiscellaneou as $pMiscellaneous){
            $sumaMiscellaneous1 += $pMiscellaneous->amount;
        }
        $sumaMiscellaneous = round($sumaMiscellaneous1,2);

        /* TRUCKS */
        $sumaConcreteExport1 = 0.00;
        $purchasesConcreteExport = getPurchases($id,19);
        foreach($purchasesConcreteExport as $pConcreteExport){
            $sumaConcreteExport1 += $pConcreteExport->amount;
        }
        $sumaConcreteExport = round($sumaConcreteExport1,2);

        $sumaDirtExport1 = 0.00;
        $purchasesDirtExport = getPurchases($id,20);
        foreach($purchasesDirtExport as $pDirtExport){
            $sumaDirtExport1 += $pDirtExport->amount;
        }  
        $sumaDirtExport = round($sumaDirtExport1,2);

        $sumaMixedExport1 = 0.00;
        $purchasesMixedExport = getPurchases($id,21);
        foreach($purchasesMixedExport as $pMixedExport){
            $sumaMixedExport1 += $pMixedExport->amount;
        }
        $sumaMixedExport = round($sumaMixedExport1,2);

        $sumaTrushExport1 = 0.00;
        $purchasesTrushExport = getPurchases($id,22); 
        foreach($purchasesTrushExport as $pTrushExport){
            $sumaTrushExport1 += $pTrushExport->amount;
        }   
        $sumaTrushExport = round($sumaTrushExport1,2);

        $sumaAsphaltExport1 = 0.00;
        $purchasesAsphaltExport = getPurchases($id,39);
        foreach($purchasesAsphaltExport as $pAsphaltExport){
            $sumaAsphaltExport1 += $pAsphaltExport->amount;
        }
        $sumaAsphaltExport = round($sumaAsphaltExport1,2);

        $sumaDirtRockExport1 = 0.00;
        $purchasesDirtRockExport = getPurchases($id,40);
        foreach($purchasesDirtRockExport as $pDirtRockExport){
            $sumaDirtRockExport1 += $pDirtRockExport->amount;
        }
        $sumaDirtRockExport = round($sumaDirtRockExport1,2);

        $sumaTrash40CYExport1 = 0.00;
        $purchasesTrash40CYExport = getPurchases($id,41);
        foreach($purchasesTrash40CYExport as $pTrash40CYExport){
            $sumaTrash40CYExport1 += $pTrash40CYExport->amount;
        }
        $sumaTrash40CYExport = round($sumaTrash40CYExport1,2);
        
        $sumaSandImport1 = 0.00;
        $purchasesSandImport = getPurchases($id,23);
        foreach($purchasesSandImport as $pSandImport){
            $sumaSandImport1 += $pSandImport->amount;
        }    
        $sumaSandImport = round($sumaSandImport1,2);

        $sumaBaseImport1 = 0.00;
        $purchasesBaseImport = getPurchases($id,24);
        foreach($purchasesBaseImport as $pBaseImport){
            $sumaBaseImport1 += $pBaseImport->amount;
        }
        $sumaBaseImport = round($sumaBaseImport1,2); 

        $sumaGravelImport1 = 0.00;
        $purchasesGravelImport = getPurchases($id,25);
        foreach($purchasesGravelImport as $pGravelImport){
            $sumaGravelImport1 += $pGravelImport->amount;
        }
        $sumaGravelImport = round($sumaGravelImport1,2);

        $sumaSoilImport1 = 0.00;
        $purchasesSoilImport = getPurchases($id,26);
        foreach($purchasesSoilImport as $pSoilImport){
            $sumaSoilImport1 += $pSoilImport->amount;
        }
        $sumaSoilImport = round($sumaSoilImport1,2); 

        $sumaDirtImport1 = 0.00;
        $purchasesDirtImport = getPurchases($id,42);
        foreach($purchasesDirtImport as $pDirtImport){
            $sumaDirtImport1 += $pDirtImport->amount;
        }
        $sumaDirtImport = round($sumaDirtImport1,2); 

        $sumaAsphaltImport1 = 0.00;
        $purchasesAsphaltImport = getPurchases($id,43);
        foreach($purchasesAsphaltImport as $pAsphaltImport){
            $sumaAsphaltImport1 += $pAsphaltImport->amount;
        }
        $sumaAsphaltImport = round($sumaAsphaltImport1,2);

        $sumaAggregatesImport1 = 0.00;
        $purchasesAggregatesImport = getPurchases($id,14);
        foreach($purchasesAggregatesImport as $pAggregatesImport){
            $sumaAggregatesImport1 += $pAggregatesImport->amount;
        }
        $sumaAggregatesImport = round($sumaAggregatesImport1,2);

        $sumaConcreteMix = 0.00;
        $purchasesConcreteMix = getPurchases($id,44);
        foreach($purchasesConcreteMix as $pConcreteMix){
            $sumaConcreteMix += $pConcreteMix->amount;
        }
        $sumaConcreteMix = round($sumaConcreteMix,2);

        $sumaPump = 0.00;
        $purchasesPump = getPurchases($id,45);
        foreach($purchasesPump as $pPump){
            $sumaPump += $pPump->amount;
        }
        $sumaPump = round($sumaPump,2);

        //Total de todos los camiones
        $truckSummary = $sumaConcreteExport +$sumaDirtExport + $sumaMixedExport + $sumaTrushExport + $sumaMaterialExport + $sumaSandImport
        + $sumaBaseImport + $sumaGravelImport + $sumaSoilImport + $sumaAsphaltExport + $sumaDirtRockExport + $sumaDirtImport 
        + $sumaAsphaltImport + $sumaAggregatesImport;

        //Total de la mano de obra
        $laborSummary1 = 0;
        foreach($arrayLaborsPurchasePayroll as $arrayLaborsPurPayroll){
            $laborSummary1 += $arrayLaborsPurPayroll['total'];
        }
        $laborSummary = round($laborSummary1,2); 

        //Compras totales
        $suma1 = 0.00;
        foreach($purchases as $purchase){
            $suma1 += $purchase->amount;
        }
        $suma = round($suma1,2);
        $sold = $project->sold_project;
        if ($suma1 == 0 ){
            $newProfit = 0;
            $newMargin = 0;
        }else if( $sold == 0) {
            $newProfit = 0;
            $newMargin = round($sold-$suma1,2);
        }else{
            $newMargin = round($sold-$suma1,2);
            $newProfit = number_format(($newMargin*100)/$sold,2);
        }

        // TRUCK ESTIMATION
        $truck = Truck::where('project_fk',$id1)->first();
        //dd($truck);

        //AVERAGE WORK DAYS
        $dayNow = Carbon::now();
        $dayNowFormat = $dayNow->format('m/d/Y');

        $startDateCarbon = Carbon::parse($project->start_date_project);
        $endDateCarbon = Carbon::parse($project->end_date_project);

        $amount = 0;
        
        //Menor o igual que "lte"
        if($dayNow->lte($endDateCarbon)){
            $daysWorked = $dayNow->diffInDays($startDateCarbon);
            $purchases = Purchase::where('project_fk',$project->id)
                                ->where('date_purchase','<=',$dayNowFormat)
                                ->get();
            foreach($purchases as $purchase){
                $amount += $purchase->amount;
            }
            if($amount != 0){
                if($daysWorked != 0){
                    $totalProfit = $project->sold_project - $amount;
                    $average = $totalProfit / $daysWorked;
                }else{
                    $totalProfit = $project->sold_project - $amount;
                    $average = $totalProfit / 1;
                }
            }else{
                $average = 0;
            }
        }else{
            $daysWorked = $endDateCarbon->diffInDays($startDateCarbon) + 1; 
            $purchases = Purchase::where('project_fk',$project->id)->get();
            foreach($purchases as $purchase){
                $amount += $purchase->amount;
            }
            if($amount != 0){
                $totalProfit = $project->sold_project - $amount;
                $average = $totalProfit / $daysWorked;
            }else{
                $average = 0;
            }
        }

        $permit = PermitTicket::where('project_fk',$project->id)->get();
        
        if($permit->isEmpty()){
            $permitInfo = ['id' => 0];
            $coments = ['id' => 0]; 
            $arrayTimes [] = ['idComment' => 0, 'date' => 0, 'time'=> 0];
            $stringDate = 0; 
            $documents = 0;
            $infoMail = 0; 
            $infoMailDocuments = 0; 
            $documentsQuoteInformation = 0;
            $documentsProjectsSitePlan = 0;
            $documentsProjectsSiteList = 0;
            $documentsPermitsReceipts = 0;
            $documentsPermitsApplications = 0;
            $documentsBussinesLicense = 0;
            $documentsCityInspection = 0;
            $documentsJobberQuote = 0;
            $documentsSitePlan = 0;
            $documentsOthers = 0;
            $documentsCovenantAgreements = 0;
            $countFieldDocuments = 0;
            $countEstimationJobber = 0;
            $countAnotherPermits = 0;
        }else{
            $permitStage = Permitstage::find($permit[0]->permitStage_fk); 
            $date = $permit[0]->updated_at; 
            $stringDate = $date->toDayDateTimeString();
            $permitInfo = ['id' => $permit[0]->id, 'contact' => $permit[0]->contactNameTicket, 'email' => $permit[0]->contactEmailTicket, 
                            'permitName'=>$permit[0]->nameTicket, 'permitNumber1'=>$permit[0]->numberPermit1,'permitName2'=>$permit[0]->namePermit2,
                            'permitNumber2'=>$permit[0]->numberPermit2,'phone' =>$permit[0]->contactPhoneTicket,'idPermitStage' => $permitStage->id,
                            'namePermit' => $permitStage->namePermitStage,'permitCity'=>$permit[0]->cityPermit ,  'permitDropoff'=>$permit[0]->documentDropoff,
                            'inspectorName'=>$permit[0]->inspectorName,'inspectorTel'=>$permit[0]->inspectorTel,'inspectorCompany'=>$permit[0]->inspectorCompany,
                            'inspectorEmail'=>$permit[0]->inspectorEmail,'subcontractorName'=>$permit[0]->subcontractorName, 'subcontractorTel'=>$permit[0]->subcontractorTel,
                            'subcontractorCompany'=>$permit[0]->subcontractorCompany,'subcontractorEmail'=>$permit[0]->subcontractorEmail];
            
                            $coments = ComentTicket::where('ticket_fk',$permit[0]->id)
                                    ->orderBy('updated_at','desc')
                                    ->get();
            //dd($coments); 
            if($coments->isEmpty()){
                $arrayTimes [] = ['idComment' => 0, 'date' => 0, 'time'=> 0];
            }else{
                foreach ($coments as $c){
                    $dateComment = Carbon::parse($c->updated_at)->format('m/d/Y');
                    $timeComment = Carbon::parse($c->updated_at)->format('g:i A');
                    $arrayTimes[] = ['idComment' => $c->id , 'date' => $dateComment, 'time'=> $timeComment];
                }
            }

            $documents = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',NULL)
                ->get(); 

            $documentsQuoteInformation = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',1)
                ->get(); 
            $documentsProjectsSitePlan = PermitDocuments::where('ticket_fk',$permit[0]->id) 
                ->where('typeDocumentPermit',2)
                ->get();

            $documentsProjectsSiteList = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',3)
                ->get();

            $documentsPermitsReceipts = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',4)
                ->get();

            $documentsPermitsApplications = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',5)
                ->get();

            $documentsBussinesLicense = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',6)
                ->get();

            $documentsCityInspection = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',7)
                ->get();

            $documentsJobberQuote = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',8)
                ->get();

            $documentsSitePlan = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',9)
                ->get();

            $documentsOthers = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',10)
                ->get();

            $documentsCovenantAgreements = PermitDocuments::where('ticket_fk',$permit[0]->id)
                ->where('typeDocumentPermit',11)
                ->get();
            
            $countFieldDocuments = count($documentsProjectsSitePlan) + count($documentsProjectsSiteList);
            $countEstimationJobber = count($documentsJobberQuote) + count($documentsQuoteInformation);
            $countAnotherPermits = count($documentsPermitsApplications) + count($documentsBussinesLicense) + count($documentsCovenantAgreements) + count($documentsSitePlan) + count($documentsCityInspection);

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
            //dd($infoMail); 
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
        }

        $contador = count($purchases);

        //COMMENT PROJECTS
        $commentProjects = CommentProject::where('project_fk',$project->id)
                                            ->orderBy('updated_at','desc')
                                            ->get();
        if($commentProjects->isEmpty()){
            $arrayTimesComments [] = ['idComment' => 0, 'date' => 0, 'time'=> 0];
        }else{
            foreach ($commentProjects as $c){
                $dateComment = Carbon::parse($c->updated_at)->format('m/d/Y');
                $timeComment = Carbon::parse($c->updated_at)->format('g:i A');
                $arrayTimesComments[] = ['idComment' => $c->id , 'date' => $dateComment, 'time'=> $timeComment];
            }
        }

        //DOCUMENT PROJECTS
        $documentProjects = DocumentProject::where('project_fk',$project->id)
                                            ->orderBy('updated_at','desc')
                                            ->get();

        //ToDo TASKS
        $toDos = Todolist::where('project_fk',$project->id)
                            ->orderBy('todoDate','asc')
                            ->get();

        //TIMELINE
        $timeline = TimeLineProjectWork::where('project_fk',$project->id)
                                        ->orderBy('timeLineDate','desc')
                                        ->get();
        //dd($timeline); 
        if($timeline->isEmpty()){
            $timeLineImage[] = ['id' => 0, 'nameFileDocument' => 0, 'timeLineWork_fk' => 0, ];
        }
        else{
            foreach($timeline as $tline){
                $imageList =ToDoListImage::where('timeLineWork_fk',$tline->id)->get();
                if($imageList->isEmpty()){
                    $timeLineImage[] = ['id' => 0, 'nameFileDocument' => 0, 'timeLineWork_fk' => 0, ];
                }
                foreach($imageList as $image){
                    $timeLineImage[] = ['id' => $image->id, 'nameFileDocument' => $image->nameFileDocument, 'timeLineWork_fk' => $image->timeLineWork_fk ];
                }
            }
        }
        $phases = $project->phases()->where('project_id',$id)->orderby('created_at','asc')->get();

        if(floatval($project->budget_project) >= $suma ){
            $diferenceBudget = 0;
            $percentDiference = 0;
        }else{
            $diferenceBudget = $suma - floatval($project->budget_project);
            if(floatval($project->budget_project) == 0){
                $percentDiference = 0;
            }else{
                $percentDiference = ($diferenceBudget *100 ) / floatval($project->budget_project);
            }
        }

        /* Expenses for Phases */
        $arrayPhases = [];
        $amountPhases[] = ['idPhase'=> -1, 'amountPhase'=> -1];
        foreach ($purchases as $purchase){
            if( !in_array( $purchase->phase_fk ,$arrayPhases ) )
            {
                array_push($arrayPhases,$purchase->phase_fk);
            }
        }
        
        foreach($arrayPhases as $aPhases){
            $totalPhase = 0.0;
            foreach ($purchases as $purchase){
                if($purchase->phase_fk == $aPhases){
                    $totalPhase += $purchase->amount;
                }
            }
            $amountPhases[] = ['idPhase'=> $aPhases, 'amountPhase'=> $totalPhase];
        }
        //dd($amountPhases);

        /**Obtengo la lista para contar los días trabajados */
        $arrayCategoryLabor = [];
        foreach ($laborCategories as $labCategori){
            /*Initialize array with projects*/ 
            if( !in_array( $labCategori->id ,$arrayCategoryLabor ) )
            {
                array_push($arrayCategoryLabor,$labCategori->id);
            }
        }

        // Contar los días trabajados por proyecto, siempre y cuando sea del tipo labor
        $purchasesLabor = Purchase ::where('project_fk',$id)
                                ->whereIn('purchase_categorie_fk',$arrayCategoryLabor)
                                ->orderBy('date_purchase','desc')
                                ->orderBy('purchase_categorie_fk','desc')
                                ->get();
        //dd($purchasesLabor);
        $daysLaborArray = [];
        foreach ($purchasesLabor as $purchase){
            /*Initialize array with projects*/ 
            if( !in_array( $purchase->date_purchase ,$daysLaborArray ) )
            {
                array_push($daysLaborArray,$purchase->date_purchase);
            }
        }
        $daysWorked = count($daysLaborArray);
        //dd($daysLaborArray);

        $allPhases = $project->phases()->orderby('created_at','asc')->get();
        //dd($allPhases);
        foreach($allPhases as $allPhase){
            if(floatval($allPhase->budget_phase) == 0){
                //Si es cero, mostrar un mensaje que diga que no hay Budget
                $percent = -1;
                $budget = floatval($allPhase->budget_phase);
                $expenses = -1;
                $profit = -1;
                $losefit = -1;
            }else{
                $percent = -2;
                $budget = floatval($allPhase->budget_phase);
                $expenses = -2;
                $profit = -2;
                $losefit = -2;
                foreach($amountPhases as $amouPhases){
                    if($amouPhases['idPhase'] == $allPhase->id){
                        if($amouPhases['amountPhase'] >= floatval($allPhase->budget_phase)){
                            $percent = 100;
                            $expenses = $amouPhases['amountPhase'];
                            $budget = floatval($allPhase->budget_phase);
                            $profit = -1;
                            $losefit = $expenses - $budget;
                        }else{
                            $budget = floatval($allPhase->budget_phase);
                            $expenses = $amouPhases['amountPhase'];
                            $percent = round(($amouPhases['amountPhase'] * 100) / floatval($allPhase->budget_phase));
                            $profit = $budget - $expenses;
                            $losefit = -1;
                        }
                    }
                }
            }
            $profitSold = 0;
            if($allPhase->sold_phase != null && $allPhase->sold_phase != 0){
                foreach($amountPhases as $amouPhases){
                    if($amouPhases['idPhase'] == $allPhase->id){
                        $profitSold = $allPhase->sold_phase - $amouPhases['amountPhase'];
                    }
                }
            }

            $pivotPhaseService = DB::table('project_phases')->where('phase_id',$allPhase->id)->get();
            $service = Service::where('id',$pivotPhaseService[0]->service_id)->get();
            /* var_dump($service); */
            if($service->isEmpty()){
                $serviceName = 'null';
            }else{
                $serviceName = $service[0]->name_service;
            }

            /* dd($purchasesLabor); */
            $phaseCountDays = 0;
            foreach($daysLaborArray as $dLaborArray){
                foreach($purchasesLabor as $pLabor){
                    if($pLabor->phase_fk == $allPhase->id && $pLabor->date_purchase == $dLaborArray){
                        $phaseCountDays += 1;
                        break;
                    }
                }
            }
            

            $infoPhasePercent[] = ['idPhase'=> $allPhase->id, 'percent'=> $percent,'budget'=> $budget, 'totalExpenses'=>$expenses, 
            'profit' => $profit, 'lose'=> $losefit, 'profitSold' => $profitSold, 'service' => $serviceName, 'days'=> $phaseCountDays];
        }
        //dd($infoPhasePercent);

        $allDailyReports = DailyReport::where('projects_fk',$id)->where('erpStatus','saved')->orderBy('dateDailyReport','desc')->get();
        $imageList[] = ['id' => '0' , 'nameImageDailyReport' => 'null'];
        foreach($allDailyReports as $dailyReport){
            $images = DB::table('image_daily_reports')->where('dailyReport_fk',$dailyReport->id)->get();
            if($images->isNotEmpty()){
                foreach($images as $image){
                    if($image->dailyReport_fk == $dailyReport->id){
                        $imageList[] = ['id' => $image->id , 'nameImageDailyReport' => $image->nameImageDailyReport]; 
                    }
                }
            }
        }

        //dd($allDailyReports);
        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->get();
        $reportLabor = DB::table('report_labor')->get();
        $reportExtralabor = DB::table('daily_more_reports')->where('typeMoreReport','ExtraLabor')->get();
        $reportSubcontractor = DB::table('daily_more_reports')->where('typeMoreReport','Subcontractor')->get();
        $images = DB::table('image_daily_reports')->get();

        //Cantidad de material que se sacó y lo que se ganó
        //1 YD se cobra en $60 a $65

        //Payments Information
        $paymentMethod = PaymentMethod::where('namePaymentMethodStatus',1)->get();

        $paymentsProject = Payment::where('project_fk',$id)
                                    ->orderBy('transactionDate','desc')
                                    ->get();
        $paymentsImage = PaymentImage::all();

        $incomes = 0;
        foreach($paymentsProject as $payProject){
            $incomes += $payProject->amountPayment;
        }

        
        $paymentPending = $project->sold_project - $incomes;
        $allServices = Service::where('generalStatus',1)->get();

        $phaseService = DB::table('project_phases')->where('project_id',$project->id)->get();

        $laborsReport = PurchaseCategory::where('type_category','labor')->get();
        //dd($laborsReport);

        return view('Project.moreInfo',compact('project','suma','newProfit','newMargin','purchases',
                                                'sumaToolsMaterial','sumaSubcontractor','sumaMaterialExport',
                                                'sumaHomedepotLowes','sumaMaterials','sumaRepairsTow',
                                                'sumaEquipmentRental','sumaBrokenConcreteTruck','sumaDirtTruckHauling','sumaMixedTruckHauling','sumaAsphaltExport',
                                                'sumaDirtRockExport', 'sumaTrash40CYExport', 'sumaDirtImport', 'sumaAsphaltImport', 'sumaAggregatesImport',
                                                'sumaImportAggregates','sumaOfficeAdmin','sumaToolPurchase','sumaToolsRental','sumaMiscellaneous',
                                                'sumaConcreteExport','sumaDirtExport','sumaMixedExport','sumaTrushExport','sumaSandImport','sumaConcreteMix','sumaPump',
                                                'sumaBaseImport','sumaGravelImport','sumaSoilImport','truckSummary','laborSummary','SpentxDate',
                                                'cantDailyPurchase','files','first','client','truck','services','daysWorked','average','permitInfo',
                                                'coments','arrayTimes','stringDate','documents','infoMail','infoMailDocuments','commentProjects',
                                                'arrayTimesComments','documentProjects','projectAddress','toDos','documentsQuoteInformation',
                                                'documentsProjectsSitePlan','documentsProjectsSiteList','documentsPermitsReceipts','documentsPermitsApplications',
                                                'documentsBussinesLicense','documentsCityInspection','documentsJobberQuote','documentsSitePlan',
                                                'documentsOthers','documentsCovenantAgreements','timeline','timeLineImage','phases','countFieldDocuments',
                                                'countEstimationJobber','countAnotherPermits','diferenceBudget','percentDiference','amountPhases','infoPhasePercent',
                                                'allDailyReports','allDailyTrucks','allDailyLabor','reportTruck','reportLabor','reportExtralabor','reportSubcontractor',
                                                'images','imageList','daysWorked','purchasesAll','paymentMethod','paymentsProject','paymentsImage','incomes','paymentPending',
                                                'principalService','allServices','phaseService','arrayLaborsPurchasePayroll','laborsReport'));
    }

    public function getInfoClient($id){
        $client = Clientweb::find($id); 
        $clientWeb = DB::table('clientweb_service')
            ->where('clientweb_id','LIKE',$client->id)
            ->first();
        $clientSource = ClientSource::find($clientWeb->client_source_id);
        $output = 
        '<div class="card border-light mb-12">
            <div class="card-body text-dark">';
            $output .='<h5 class="card-title">'.$client->nameClient.'</h5>';
            $output .='<h6>Email: '.$client->emailClient.'</h6>';
            $output .='<h6>Phone: '.$client->phoneClient.'</h6>';
            $output .='<h6>Source: '.$clientSource->nameClientSource.'</h6>';
            $output .='</div>
        </div>';
        echo $output;  
    }

    public function commentsProject(Project $project){
        $user_id = Auth::user()->id;
        $project = CommentProject::create([
            'commentProject' => request('commentsProject'),
            'project_fk' => $project->id,
            'user_fk' => $user_id
        ]);
        return redirect()->back();
    }

    public function updateCommentsProject($commentsId){
        $comment = CommentProject::find($commentsId);
        $comment->update([
            'commentProject' => request('commentsProject')
        ]);
        return redirect()->back();
    }

    public function deleteCommentsProject($commentsId){
        $comment = CommentProject::find($commentsId);
        $comment->delete();
        return redirect()->back();
    }

    public function uploadFileDocument (Project $project){
        return view('Project.documentDropzone',compact('project'));
    }

    public function dropzoneFileDocument(Request $request, Project $project){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = DocumentProject ::create([
            'nameFileDocument' => $fileName,
            'project_fk' => $project->id
        ]);
        $fileR->move(public_path('documentProjects'),$fileName);
    }

    /** Esta función actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function dropzoneFileDocumentDelete($name){
        DocumentProject::where('nameFileDocument',$name)->delete();
    }

    public function deleteFileDocumentProject (DocumentProject $idFile){
        $idFile->delete();
        return redirect()->back(); 
    }

    public function addHomeDepotLocation(Project $project){
        $project->update([
            'homeDepotLocation' => request('inputHomedepot')
        ]);
        $project->save();
        return redirect()->back();
    }

    public function chooseMainService(Project $project){
        $projectsServices = DB::table('project_services')->where('project_id',$project->id)->get();
        foreach($projectsServices as $pServices){
            if($pServices->service_id == request('principal')){
                DB::table('project_services')
                ->where('id', $pServices->id)
                ->update(['principal' => 1]);
            }else{
                DB::table('project_services')
                ->where('id', $pServices->id)
                ->update(['principal' => 0]);
            }
        }
        return redirect()->back();
    }
}
