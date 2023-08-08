<?php

namespace App\Http\Controllers;
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 

use App\Purchase;
use App\Project;
use App\PurchaseCategory;
use App\Phase;
use App\Truck;
use App\PurchasePicture;
use App\AdminExpenses;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return view('Purchase/show_purchases',compact('purchases'));
    }

    public function filterPurchases()
    {
        $projects = Project::orderBy('id','desc')->get();
        $activateProjects = $projects->where('status_fk',1);
        $finishProjects = $projects->where('status_fk',2);
        $startingProjects = $projects->where('status_fk',3);
        $archivedProjects = $projects->where('status_fk',4);

        $numActivate = $activateProjects->count();
        $numFinished = $finishProjects->count();

        if($numActivate != 0){
            foreach($activateProjects as $activateProject){
                $purchasesOb = Purchase::where('project_fk',$activateProject->id)->get();
                $suma = 0.00;
                foreach($purchasesOb as $p){
                    $suma += $p->amount;
                }
                $budgetA = $activateProject->budget_project;
                $diferenciaA = $budgetA - $suma;
                $purchasesA[] = ['id' => $activateProject->id , 'value' => $suma ,'diferencia' => $diferenciaA];
            }
        }
        else{
            $purchasesA[] = ['id' => 0 , 'value' => 0 ,'diferencia' => 0];
        }
        
        if($numFinished != 0){
            foreach($finishProjects as $finishProject){
                $purchasesOF = Purchase::where('project_fk',$finishProject->id)->get();
                $sumaF = 0.00;
                foreach($purchasesOF as $p){
                    $sumaF += $p->amount;
                }
                $purchasesF[] = ['id' => $finishProject->id , 'value' => $sumaF];
            }
        }
        else{
            $purchasesF[] = ['id' => 0 , 'value' => 0];
        }

        return view('Purchase/projectsPurchases',compact('activateProjects','startingProjects','finishProjects',
                                                            'archivedProjects','purchasesA','purchasesF'));
    }

    public function findPurchases($id){
        $s = 0.00;
        $projects = Project::findOrfail($id);
        $purchases = Purchase ::where('project_fk',$projects->id)->get();
        foreach($purchases as $purchase){
            $s += $purchase->amount;
        }
        $suma = round($s,2);
        $contador = count($purchases);
        return response(json_encode($suma),200)->header('Content-type','text/plain');
    }

    public function create()
    {
        $purchaseCategories = PurchaseCategory::where('generalStatus',1)->get();
        return view('Purchase/new_purchase',compact('purchaseCategories'));
    }
    //Function with POST
    /*     public function fetch(Request $request){
        //query es el dato que viene del template por medio del JS
        if($request->get('query')){
            $query = $request->get('query'); //Se obtiene el valor de query
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$query}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul id="listP" class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li value="'.$row->id.' "onclick="searchPhase('.$row->id.')">'.$row->name_project.'</li>';
            }
            $output .= '</ul><hr>';
            echo $output;    
        }
    } */

    public function fetch($name){
        //query es el dato que viene del template por medio del JS
        if($name != ''){
            $data = DB::table('projects')
                ->where('name_project','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
            $output = '<ul id="listP" class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= 
                '<li value="'.$row->id.' "onclick="searchPhase('.$row->id.')">'.$row->name_project.'</li>';
            }
            $output .= '</ul><br>';
            echo $output;    
        }
    }

    /*     public function getPhases(Request $request){
        
        $idProject = $request->get('query');
        $phases = Project::find($idProject)->phases()->get();
        return response(json_encode($phases),200)->header('Content-type','text/plain');
    } */

    public function getPhases($id){
        $phases = Project::find($id)->phases()->get();
        return response(json_encode($phases),200)->header('Content-type','text/plain');
    }

    public function store(Request $request)
    {
        $nameProject = request('searchProject');
        $p = Project::where('name_project',$nameProject)->get('id');
        $number = strtok($p, '[{"id":}]');
        $valorNull = "";

        $countPurchases = Purchase::where('project_fk',$number)->get(); 
        if($countPurchases->isEmpty()){
            $project = Project::find($number);
            $project->update([
                'start_date_project' => request()->datePurchase[0],
            ]);
            $project->save();
        }else{
            
        }

        foreach(request()->categoryPurchase as $item=>$v){
            if(strcmp(request()->categoryPurchase[$item], $valorNull)!==0){
                $dataContact=array(
                    'project_fk'=> $number,
                    'purchase_categorie_fk'=>request()->categoryPurchase[$item],
                    'phase_fk'=> request()->phasePurchase[$item],
                    'description_purchase'=> request()->descriptionPurchase[$item],
                    'amount'=> request()->amountPurchase[$item],
                    'date_purchase'=> request()->datePurchase[$item]
                );
                $purchase = Purchase::create($dataContact);
            }
        }

        $files = request()->file('myfile');
        //dd($files);
        if(strcmp($files[0],$valorNull)!==0){
            if (count($files) > 0){
                foreach(request()->myfile as $item=>$v){
                    if(strcmp(request()->myfile[$item], $valorNull)!==0){
                        $file = PurchasePicture ::create([
                            'reference_picture' => request()->file('myfile')[$item]->hashName()
                        ]);
                        $filename = request()->file('myfile')[$item]->hashName();
                        //dd(request()->file('myfile')[$item]); 
                        request()->file('myfile')[$item]->move(public_path('filePurchases'),$filename);
                        $purchase->pictures()->attach($file);
                    }
                }
            }
        }

        return redirect()->route('purchase.purchaseXProject',[$number]);
        
    }
    //Create more purchase from show projects
    public function createPurchase(Project $project){
        $phases = $project->phases()->where('project_id',$project->id)->get();
        $purchaseCategories = PurchaseCategory::where('generalStatus',1)->get();
        //dd($purchaseCategories); 
        return view('Purchase/morePurchase',compact('purchaseCategories','project','phases'));
    }

    public function storePurchase(Request $request){
        //dd($request);
        $valorNull = "";
        $id = request('searchProjectHi');
        $countPurchases = Purchase::where('project_fk',$id)->get(); 
        if($countPurchases->isEmpty()){
            $project = Project::find($id);
            $project->update([
                'start_date_project' => request()->datePurchase[0],
            ]);
            $project->save();
        }else{
        }

        foreach(request()->categoryPurchase as $item=>$v){
            //dd(request()->categoryPurchase[$item]);
            switch(request()->categoryPurchase[$item]){
                case '19':
                    //19 -- Concrete Export
                    $numberTrucks = request()->concreteExport[$item];
                break;
                case '20':
                    //20 -- Dirt Export
                    $numberTrucks = request()->dirtExport[$item];
                break;
                case '21':
                    //21 -- Mixed Export
                    $numberTrucks = request()->mixedExport[$item];
                break;
                case '22':
                    //22 -- Trash Export
                    $numberTrucks = request()->trashExport[$item];
                break;
                case '39':
                    //39 -- Asphalt Export
                    $numberTrucks = request()->asphaltExport[$item];
                break;
                case '40':
                    //40 -- Dirt + Rock Export
                    $numberTrucks = request()->dirtRockExport[$item];
                break;
                case '41':
                    //41 -- Trash 40CY Export
                    $numberTrucks = request()->trash40CYExport[$item];
                break;
                case '42':
                    //42 -- Dirt Import
                    $numberTrucks = request()->dirtImport[$item];
                break;
                case '43':
                    //43 -- Asphalt Import
                    $numberTrucks = request()->asphaltImport[$item];
                break;
                case '14':
                    //14 -- Aggregates Import
                    $numberTrucks = request()->aggregatesImport[$item];
                break;
                case '24':
                    //24 -- Base Import
                    $numberTrucks = request()->baseImport[$item];
                break;
                case '25':
                    //25 -- Gravell Import
                    $numberTrucks = request()->gravellImport[$item];
                break;
                case '23':
                    //23 -- Sand Import
                    $numberTrucks = request()->sandImport[$item];
                break;
                case '26':
                    //26 -- Soil Import
                    $numberTrucks = request()->soilImport[$item];
                break;
                default:
                    $numberTrucks =  0;
            }
            
            if(strcmp(request()->categoryPurchase[$item], $valorNull)!==0){
                $dataContact=array(
                    'project_fk'=> request('searchProjectHi'),
                    'purchase_categorie_fk'=>request()->categoryPurchase[$item],
                    'phase_fk'=> request()->phasePurchase[$item],
                    'description_purchase'=> request()->descriptionPurchase[$item],
                    'amount'=> request()->amountPurchase[$item],
                    'date_purchase'=> request()->datePurchase[$item],
                    'numberTruck' => $numberTrucks,
                );
                $purchase = Purchase::create($dataContact);
                $allPurchasePhase = Purchase::where('phase_fk',$purchase->phase_fk)->get();
                $phase = Phase::where('id',$purchase->phase_fk)->get();
                $totalPhase = 0.0;
                foreach($allPurchasePhase as $aPurchasePhase){
                    $totalPhase += $aPurchasePhase->amount;
                }
                if($phase[0]->name_phase != 'Empty' ){
                    if(floatval($phase[0]->budget_phase) != 0){
                        $project = Project::where('id',$purchase->project_fk)->get();
                        $percentPhase = round(($totalPhase * 100 )/ floatval($phase[0]->budget_phase));
                        if($percentPhase >= 100){
                            $mensaje = "Project: ".$project[0]->name_project.",\n Budget on Phase ".$phase[0]->name_phase. " has been exceeded.";
                            $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
                            $TWILIO_TOKEN='fb02139bd9647917f56def7008f9b739';
                            $TWILIO_NUMBER='14752587010';
                            $marvinNumber = '13104099884';
                            $joselinNumber = '13109127546';
                    
                            //SMS TO MARVIN
                            $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
                            $smsToMarvin->messages->create($marvinNumber, [
                                'from' => $TWILIO_NUMBER,
                                'body' => $mensaje
                            ]);
                        }else if($percentPhase >= 80){
                            $mensaje = "Project: ".$project[0]->name_project.",\n".$percentPhase."% of the budget has been spent: ".$phase[0]->name_phase;
                            $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
                            $TWILIO_TOKEN='fb02139bd9647917f56def7008f9b739';
                            $TWILIO_NUMBER='14752587010';
                            $marvinNumber = '13104099884';
                            $joselinNumber = '13109127546';

                            //SMS TO MARVIN
                            $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
                            $smsToMarvin->messages->create($marvinNumber, [
                                'from' => $TWILIO_NUMBER,
                                'body' => $mensaje
                            ]);
                        }
                    }
                }
                
                
                $idProject = $purchase->project_fk;
                $truck = Truck::where('project_fk',$idProject)->get();
                if($truck->isEmpty()){
                    switch($purchase->purchase_categorie_fk){
                        case '19':
                            //19 -- Concrete Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportConcrete' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                            
                        break;

                        case '20':
                            //20 -- Dirt Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportDirt' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '21':
                            //21 -- Mixed Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportMixed' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '22':
                            //22 -- Trash Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportTrash' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '39':
                            //39 -- Asphalt Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportAsphalt' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '40':
                            //40 -- Dirt + Rock Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportDirtRock' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '41':
                            //41 -- Trash 40CY Export
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseExportTrash40CY' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '42':
                            //42 -- Dirt Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportDirt' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '43':
                            //43 -- Asphalt Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportAsphalt' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '14':
                            //14 -- Aggregates Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportAggregates' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '24':
                            //24 -- Base Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportBase' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '25':
                            //25 -- Gravell Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportGravell' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '23':
                            //23 -- Sand Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportSand' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;

                        case '26':
                            //26 -- Soil Import
                            $newModelTruck = Truck::create([
                                'project_fk' => $purchase->project_fk,
                                'purchaseImportSoil' => $purchase->numberTruck
                            ]);
                            $newModelTruck->save();
                        break;
                    }
                    
                    
                }else{
                    switch($purchase->purchase_categorie_fk){
                        case '19':
                            //19 -- Concrete Export
                            $number = $truck[0]->purchaseExportConcrete + request()->concreteExport[$item];
                            $truck[0]->update([
                                'purchaseExportConcrete' => $number
                            ]);
                            $truck[0]->save();

                        break;
                        case '20':
                            //20 -- Dirt Export
                            $number = $truck[0]->purchaseExportDirt + request()->dirtExport[$item];
                            $truck[0]->update([
                                'purchaseExportDirt' => $number
                            ]);
                            $truck[0]->save();

                        break;
                        case '21':
                            //21 -- Mixed Export
                            $number = $truck[0]->purchaseExportMixed + request()->mixedExport[$item];
                            $truck[0]->update([
                                'purchaseExportMixed' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '22':
                            //22 -- Trash Export
                            $number = $truck[0]->purchaseExportTrash + request()->trashExport[$item];
                            $truck[0]->update([
                                'purchaseExportTrash' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '39':
                            //39 -- Asphalt Export
                            $number = $truck[0]->purchaseExportAsphalt + request()->asphaltExport[$item];
                            $truck[0]->update([
                                'purchaseExportAsphalt' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '40':
                            //40 -- Dirt + Rock Export
                            $number = $truck[0]->purchaseExportDirtRock + request()->dirtRockExport[$item];
                            $truck[0]->update([
                                'purchaseExportDirtRock' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '41':
                            //41 -- Trash 40CY Export
                            $number = $truck[0]->purchaseExportTrash40CY + request()->trash40CYExport[$item];
                            $truck[0]->update([
                                'purchaseExportTrash40CY' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '42':
                            //42 -- Dirt Import
                            $number = $truck[0]->purchaseImportDirt + request()->dirtImport[$item];
                            $truck[0]->update([
                                'purchaseImportDirt' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '43':
                            //43 -- Asphalt Import
                            $number = $truck[0]->purchaseImportAsphalt + request()->asphaltImport[$item];
                            $truck[0]->update([
                                'purchaseImportAsphalt' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '14':
                            //14 -- Aggregates Import
                            $number = $truck[0]->purchaseImportAggregates + request()->aggregatesImport[$item];
                            $truck[0]->update([
                                'purchaseImportAggregates' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '24':
                            //24 -- Base Import
                            $number = $truck[0]->purchaseImportBase + request()->baseImport[$item];
                            $truck[0]->update([
                                'purchaseImportBase' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '25':
                            //25 -- Gravell Import
                            $number = $truck[0]->purchaseImportGravell + request()->gravellImport[$item];
                            $truck[0]->update([
                                'purchaseImportGravell' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '23':
                            //23 -- Sand Import
                            $number = $truck[0]->purchaseImportSand + request()->sandImport[$item];
                            $truck[0]->update([
                                'purchaseImportSand' => $number
                            ]);
                            $truck[0]->save();
                        break;

                        case '26':
                            //26 -- Soil Import
                            $number = $truck[0]->purchaseImportSoil + request()->soilImport[$item];
                            $truck[0]->update([
                                'purchaseImportSoil' => $number
                            ]);
                            $truck[0]->save();
                        break;
                    }
                }
            }  
        }
        $project = Project::find($id);
        $purchases = Purchase::where('project_fk',$project->id)->get();
        $amountPro = 0;
        foreach($purchases as $purchase){
            $amountPro += $purchase->amount;
        }

        if(floatval($project->budget_project) >= $amountPro ){
            $diferenceBudget = 0;
            $percentDiference = 0;
        }else{
            if($project->budget_project != 0){
                $diferenceBudget = $amountPro - floatval($project->budget_project);
                $percentDiference = ($diferenceBudget *100 ) / floatval($project->budget_project);
           
                $mensaje = "Project: ".$project->name_project."\nExpenses are $".number_format($diferenceBudget,2)."(".number_format($percentDiference,2)."%) over the budget.";
                $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
                $TWILIO_TOKEN='fb02139bd9647917f56def7008f9b739';
                $TWILIO_NUMBER='14752587010';
                $marvinNumber = '13104099884';
                //$joselinNumber = '13109127546';
        
                //SMS TO MARVIN
                $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
                $smsToMarvin->messages->create($marvinNumber, [
                    'from' => $TWILIO_NUMBER,
                    'body' => $mensaje
                ]);
            }
        }
        //return redirect()->route('purchase.purchaseXProject',[$id]);
        return redirect()->route('project.moreInfo',$project);
    }

    public function show($id,$flag)
    {
        $purchase = Purchase::findOrFail($id);
        $id = $purchase->project_fk;
        $project = Project::find($id);
        return view('Purchase.purchase',compact('purchase','id','flag','project'));
        
    }

    public function edit(Purchase $purchase, $flag)
    {
        $purchaseCategories = PurchaseCategory::where('generalStatus',1)->get();
        $id = $purchase->project_fk;
        $project = Project::find($id);
        $phases = Project::find($purchase->project_fk)->phases()->get();
        return view('Purchase.edit_purchase',compact('purchase','purchaseCategories','phases','id','flag','project'));
    }

    public function update(Request $request, Purchase $purchase , $flag)
    {
        $id = $purchase->project_fk;
        $project = Project::find($id); 
        $truck = Truck::where('project_fk',$id)->get();
        if(!($truck->isEmpty())){
            switch($purchase->purchase_categorie_fk){
                case '19':
                    //19 -- Concrete Export
                    $rest = $truck[0]->purchaseExportConcrete - $purchase->numberTruck;
                    $newValue = $rest + request('numberTruck');
                    $truck[0]->update([
                        'purchaseExportConcrete' => $newValue
                    ]);
                    $truck[0]->save();
                break;

                case '20':
                    //20 -- Dirt Export
                    $rest = $truck[0]->purchaseExportDirt - $purchase->numberTruck;
                    $newValue = $rest + request('numberTruck');
                    $truck[0]->update([
                        'purchaseExportDirt' => $newValue
                    ]);
                    $truck[0]->save();
                break;

                case '21':
                    //21 -- Mixed Export
                    $rest = $truck[0]->purchaseExportMixed - $purchase->numberTruck;
                    $newValue = $rest + request('numberTruck');
                    $truck[0]->update([
                        'purchaseExportMixed' => $newValue
                    ]);
                    $truck[0]->save();
                break;
            }
            
        }

        $purchase->update([
            //'project_fk'=> $number,
            'purchase_categorie_fk'=>request('categoryPurchase'),
            'phase_fk'=>request('phasePurchase'),
            'description_purchase'=>request('descriptionPurchase'),
            'amount'=>request('amountPurchase'),
            'date_purchase'=>request('datePurchase'),
            'numberTruck' => request('numberTruck')
        ]);
        switch($flag){
            case 1:
                return redirect()->route('project.moreInfo',$project);
            break;
            case 2:
                return redirect()->route('purchase.purchaseXProject',[$id]);
            break;
        }
    }

    public function confirm(Purchase $purchase, $flag){
        $purchaseCategories = PurchaseCategory::where('generalStatus',1)->get();
        $id = $purchase->project_fk;
        $project = Project::find($id);
        return view('Purchase.confirmPurchase',compact('purchase','purchaseCategories','id','flag','project'));
    }

    public function destroy(Purchase $purchase, $flag)
    {
        $purchase->delete();
        $id = $purchase->project_fk;
        $project = Project::find($id);
        switch($flag){
            case 1:
                return redirect()->route('project.moreInfo',$project);
            break;
            case 2:
                return redirect()->route('purchase.purchaseXProject',[$id]);
            break;
        }
    }

    public function getcategories(){
        $categories = PurchaseCategory::where('generalStatus',1)->get();
        return response(json_encode($categories),200)->header('Content-type','text/plain');
    }

    public function purchaseXProject($id){
        $s = 0.00;
        $project = Project::findOrFail($id);
        $purchases = Purchase::where('project_fk',$project->id)->get();
        
        //Obtengo los id de las compras realizadas a un proyecto específico
        $arrayIdPurchases = [];
        foreach($purchases as $p){
            if( !in_array( $p->id ,$arrayIdPurchases ) )
            {
            array_push($arrayIdPurchases,$p->id);
            }
        }
     
        //Funcion para obtener el id de la imagen relacionada en la tabla pivote
        function getPictures($id){
            $pictures = DB::table('pivot_purchase_pictures')
                        ->where('purchase_id',$id)
                        ->first(); 
            if($pictures != null){
                return $pictures->purchase_picture_id;
            }else{
                return 0;
            } 
        }

        /**Se ocupa una flag vara validar si hay compras con imagenes
         * solo va a cambiar de estado si existe una al menos
         */
        $flag = 0; 
        foreach($arrayIdPurchases as $array){
            $number = getPictures($array);
            if($number != 0){
                $idPictures[] = $number; 
                $flag = 1;
            }
        } 

        //Función para obtener la información de la imagen almacenada
       function getPicture($idPicture){
            $imagenes = PurchasePicture:: where('id',$idPicture)
                                            ->get();
            return $imagenes[0]->reference_picture;
        }

        //Obtengo el nombre de la imagen u archivo
        if($flag != 0){
            foreach($idPictures as $pic){
                $array = getPicture($pic); 
                $nombres[] = ['name' => $array];
            }
        }else{
            $nombres[] = ['name' => 'null'];
        }
                 
        foreach($purchases as $p){
            $s += $p->amount;
        }
        $suma = round($s,2);

        function getPurchases($idPro,$idCate){
            $purchasesFunction = Purchase :: where('purchase_categorie_fk',$idCate)
                                            ->where('project_fk',$idPro)
                                            ->get();
            return $purchasesFunction; 
        }

        /*** PAYROLL */

        $sumaInternalPayroll = 0.00;
        $purchasesInternalPayroll = getPurchases($id,5);
        foreach($purchasesInternalPayroll as $pInternalPayroll){
            $sumaInternalPayroll += $pInternalPayroll->amount;
        }

        $sumaHelpersPayroll = 0.00;
        $purchasesHelpersPayroll = getPurchases($id,6);
        foreach($purchasesHelpersPayroll as $pHelpersPayroll){
            $sumaHelpersPayroll += $pHelpersPayroll->amount;
        }

        $sumaAlberto = 0.00;
        $purchasesAlberto = getPurchases($id,27);
        foreach($purchasesAlberto as $pAlberto){
            $sumaAlberto += $pAlberto->amount;
        }
 
        $sumaManuel = 0.00;
        $purchasesManuel = getPurchases($id,28);
        foreach($purchasesManuel as $pManuel){
            $sumaManuel += $pManuel->amount;
        }

        $sumaThomas = 0.00;
        $purchasesThomas = getPurchases($id,29);
        foreach($purchasesThomas as $pThomas){
            $sumaThomas += $pThomas->amount;
        }

        $sumaJorge = 0.00;
        $purchasesJorge = getPurchases($id,30);
        foreach($purchasesJorge as $pJorge){
            $sumaJorge += $pJorge->amount;
        }

        $sumaDelfino = 0.00;
        $purchasesDelfino = getPurchases($id,31);
        foreach($purchasesDelfino as $pDelfino){
            $sumaDelfino += $pDelfino->amount;
        }

        $sumaGustavo = 0.00;
        $purchasesGustavo = getPurchases($id,32);
        foreach($purchasesGustavo as $pGustavo){
            $sumaGustavo += $pGustavo->amount;
        }

        $sumaAngel = 0.00;
        $purchasesAngel = getPurchases($id,33);
        foreach($purchasesAngel as $pAngel){
            $sumaAngel += $pAngel->amount;
        }

        $sumaLeon = 0.00;
        $purchasesLeon = getPurchases($id,34);
        foreach($purchasesLeon as $pLeon){
            $sumaLeon += $pLeon->amount;
        }

        $sumaJulio = 0.00;
        $purchasesJulio = getPurchases($id,35);
        foreach($purchasesJulio as $pJulio){
            $sumaJulio += $pJulio->amount;
        }

        /*** OTHERS */

        $sumaToolsMaterial = 0.00;
        $purchasesToolsMaterial = getPurchases($id,1);
        foreach($purchasesToolsMaterial as $pToolsMaterial){
            $sumaToolsMaterial += $pToolsMaterial->amount;
        }

        $sumaSubcontractor = 0.00; 
        $purchasesSubcontractor = getPurchases($id,2);
        foreach($purchasesSubcontractor as $pSubcontractor){
            $sumaSubcontractor += $pSubcontractor->amount;
        }

        $sumaAggregatesImport = 0.00;
        $purchasesAggregatesImport = getPurchases($id,3);  
        foreach($purchasesAggregatesImport as $pAggregatesImport){
            $sumaAggregatesImport += $pAggregatesImport->amount;
        }   

        $sumaMaterialExport = 0.00;
        $purchasesMaterialExport = getPurchases($id,4);
        foreach($purchasesMaterialExport as $pMaterialExport){
            $sumaMaterialExport += $pMaterialExport->amount;
        }

        $sumaHomedepotLowes = 0.00; 
        $purchasesHomedepotLowes = getPurchases($id,7);
        foreach($purchasesHomedepotLowes as $pHomedepotLowes){
            $sumaHomedepotLowes += $pHomedepotLowes->amount;
        }

        $sumaMaterials = 0.00; 
        $purchasesMaterials = getPurchases($id,8);
        foreach($purchasesMaterials as $pToolsMateria){
            $sumaMaterials += $pToolsMateria->amount;
        }

        $sumaRepairsTow = 0.00;
        $purchasesRepairsTow = getPurchases($id,9);
        foreach($purchasesRepairsTow as $pRepairsTow){
            $sumaRepairsTow += $pRepairsTow->amount;
        }

        $sumaEquipmentRental = 0.00;
        $purchasesEquipmentRental = getPurchases($id,10);
        foreach($purchasesEquipmentRental as $pEquipmentRental){
            $sumaEquipmentRental += $pEquipmentRental->amount;
        }

        $sumaBrokenConcreteTruck = 0.00;
        $purchasesBrokenConcreteTruck = getPurchases($id,11);
        foreach($purchasesBrokenConcreteTruck as $pBrokenConcreteTruck){
            $sumaBrokenConcreteTruck += $pBrokenConcreteTruck->amount;
        }

        $sumaDirtTruckHauling = 0.00;
        $purchasesDirtTruckHauling = getPurchases($id,12);
        foreach($purchasesDirtTruckHauling as $pDirtTruckHauling){
            $sumaDirtTruckHauling += $pDirtTruckHauling->amount;
        }

        $sumaMixedTruckHauling = 0.00;
        $purchasesMixedTruckHauling = getPurchases($id,13);
        foreach($purchasesMixedTruckHauling as $pMixedTruckHauling){
            $sumaMixedTruckHauling += $pMixedTruckHauling->amount;
        }

        $sumaImportAggregates = 0.00; 
        $purchasesImportAggregates = getPurchases($id,14);
        foreach($purchasesImportAggregates as $pImportAggregates){
            $sumaImportAggregates += $pImportAggregates->amount;
        }

        $sumaOfficeAdmin = 0.00;
        $purchasesOfficeAdmin = getPurchases($id,15);  
        foreach($purchasesOfficeAdmin as $pOfficeAdmin){
            $sumaOfficeAdmin += $pOfficeAdmin->amount;
        } 

        $sumaToolPurchase = 0.00;
        $purchasesToolPurchase = getPurchases($id,16);
        foreach($purchasesToolPurchase as $pToolPurchase){
            $sumaToolPurchase += $pToolPurchase->amount;
        }

        $sumaToolsRental = 0.00; 
        $purchasesToolsRental = getPurchases($id,17);
        foreach($purchasesToolsRental as $pToolsRental){
            $sumaToolsRental += $pToolsRental->amount;
        }

        $sumaMiscellaneous = 0.00; 
        $purchasesMiscellaneou = getPurchases($id,18);
        foreach($purchasesMiscellaneou as $pMiscellaneous){
            $sumaMiscellaneous += $pMiscellaneous->amount;
        }

        $sumaConcreteExport = 0.00;
        $purchasesConcreteExport = getPurchases($id,19);
        foreach($purchasesConcreteExport as $pConcreteExport){
            $sumaConcreteExport += $pConcreteExport->amount;
        }

        $sumaDirtExport = 0.00;
        $purchasesDirtExport = getPurchases($id,20); 
        foreach($purchasesDirtExport as $pDirtExport){
            $sumaDirtExport += $pDirtExport->amount;
        }  

        $sumaMixedExport = 0.00;
        $purchasesMixedExport = getPurchases($id,21); 
        foreach($purchasesMixedExport as $pMixedExport){
            $sumaMixedExport += $pMixedExport->amount;
        }

        $sumaTrushExport = 0.00;
        $purchasesTrushExport = getPurchases($id,22); 
        foreach($purchasesTrushExport as $pTrushExport){
            $sumaTrushExport += $pTrushExport->amount;
        }   

        $sumaSandImport = 0.00;
        $purchasesSandImport = getPurchases($id,23); 
        foreach($purchasesSandImport as $pSandImport){
            $sumaSandImport += $pSandImport->amount;
        }    

        $sumaBaseImport = 0.00;
        $purchasesBaseImport = getPurchases($id,24);
        foreach($purchasesBaseImport as $pBaseImport){
            $sumaBaseImport += $pBaseImport->amount;
        }

        $sumaGravelImport = 0.00;
        $purchasesGravelImport = getPurchases($id,25);
        foreach($purchasesGravelImport as $pGravelImport){
            $sumaGravelImport += $pGravelImport->amount;
        }

        $sumaSoilImport = 0.00;
        $purchasesSoilImport = getPurchases($id,26);
        foreach($purchasesSoilImport as $pSoilImport){
            $sumaSoilImport += $pSoilImport->amount;
        }

        $truckSummary = $sumaConcreteExport +$sumaDirtExport + $sumaMixedExport + $sumaTrushExport + $sumaMaterialExport + $sumaSandImport
        + $sumaBaseImport + $sumaGravelImport + $sumaSoilImport ;

        $totalLabor = $sumaInternalPayroll + $sumaHelpersPayroll + $sumaAlberto + 
        $sumaManuel + $sumaThomas + $sumaJorge + $sumaDelfino + $sumaGustavo + $sumaAngel + $sumaLeon + $sumaJulio;

        return view('Purchase/show_purchases_project',compact('purchases','project','suma',
        'sumaToolsMaterial','sumaSubcontractor','sumaAggregatesImport','sumaMaterialExport',
        'sumaInternalPayroll','sumaHelpersPayroll','sumaHomedepotLowes','sumaMaterials','sumaRepairsTow',
        'sumaEquipmentRental','sumaBrokenConcreteTruck','sumaDirtTruckHauling','sumaMixedTruckHauling',
        'sumaImportAggregates','sumaOfficeAdmin','sumaToolPurchase','sumaToolsRental','sumaMiscellaneous',
        'sumaConcreteExport','sumaDirtExport','sumaMixedExport','sumaTrushExport','sumaSandImport',
        'sumaBaseImport','sumaGravelImport','sumaSoilImport', 'truckSummary','totalLabor','nombres','flag'));
    }

    public function allPurchases(){
        $allPurchases = Purchase::all();
        $allAdminExpenses = AdminExpenses::all();
        //dd($allAdminExpenses[50]);

        foreach($allPurchases as $aPurchases){
            $newDate = date("Y/m/d", strtotime($aPurchases->date_purchase));
            $allExpenses[] = ['date'=>$newDate,'type'=>'Project', 'category'=>$aPurchases->purchaseCategories->name_category, 'description'=>$aPurchases->description_purchase, 'amount'=>$aPurchases->amount, 'projectID'=>$aPurchases->project_fk, 'projectName'=>$aPurchases->projects->name_project];
        }
        foreach($allAdminExpenses as $aAdminExpenses){
            $newDate = date("Y/m/d", strtotime($aAdminExpenses->dateAdminExpenses));
            $allExpenses[] = ['date'=>$newDate,'type'=>'Admin', 'category'=>$aAdminExpenses->status->nameTypeAdminExpenses, 'description'=>$aAdminExpenses->commentAdminExpenses, 'amount'=>$aAdminExpenses->amountDecimalExpenses,'projectID'=>'-', 'projectName'=>'-'];
        }
        /* dd($allExpenses); */

        return view('Purchase.showAllPurchases',compact('allExpenses'));
    }
}
