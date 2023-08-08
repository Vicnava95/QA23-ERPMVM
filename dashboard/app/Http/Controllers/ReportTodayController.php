<?php

namespace App\Http\Controllers;

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
use App\PurchaseCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;
use Carbon\Carbon;

class ReportTodayController extends Controller
{
    /**
     * Flag 1 = Today
     * Flag 5 = AnotherDay
     */

    public function showDay($day,$flag){
        //Se establece el dia de la consulta
        $date = Carbon::parse($day)->format('m/d/Y');
        $year = Carbon::parse($day)->format('Y');
        //$date = "04/05/2021";
        /****************************************** PRIMERA COLUMNA STARTED **************************************/
        //Se obtienen los proyectos que iniciaron en esa fecha sin importar su estado
        $projectsStarts = Project::whereYear('created_at', '=', $year)
                                    ->where('start_date_project',$date)
                                    ->whereIn('status_fk',[1,2,5])
                                    ->orderByDesc('start_date_project')
                                    ->get();
        //Se cuentan los proyectos que cumplen con la restricción anterior
        $nPStarts = $projectsStarts->count();

        /*** COMPRAS DE LOS PROYECTOS INICIADOS  */
        //Consultamos la cantidad de proyectos que iniciaron en el rango de fechas consultadas
        if($nPStarts != 0){
            foreach($projectsStarts as $proStarts){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsStarts = Purchase::where('project_fk', $proStarts->id)->get();
                $sumaPStarts = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsStarts as $pProjectsStarts){
                    $sumaPStarts += $pProjectsStarts->amount;
                }

                //Almacenamos la información en una colección
                $purProStarts[] = ['id' => $proStarts->id, 'value' => $sumaPStarts];
            }
        }else{
            $purProStarts[] = ['id' => 0, 'value' => 0];
        }

        /******************************************* SEGUNDA COLUMNA FINISHED *************************************/
        //Se obtienen los proyectos que finalizaron en esa fecha y su estado es finalizado
        //Hay proyectos que tienen una fecha de fin estipulada pero no tienen el estado de finalizado
        $projectsFinished = Project::whereYear('created_at', '=', $year)
                                    ->where('end_date_project',$date)
                                    ->where('status_fk',2)
                                    ->orderByDesc('end_date_project')
                                    ->get();
        //Se cuentan los proyectos que cumplen con la restricción anterior
        $nPFinished = $projectsFinished->count();

        /*** COMPRAS DE LOS PROYECTOS FINALIZADOS  */
        //Consultamos la cantidad de proyectos que finalizaron en el rango de fechas consultadas
        if($nPFinished != 0){
            foreach($projectsFinished as $proFinished){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsFinish = Purchase::where('project_fk', $proFinished->id)->get();
                $sumaPFinish = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsFinish as $pProjectsFinish){
                    $sumaPFinish += $pProjectsFinish->amount;
                }

                //Almacenamos la información en una colección
                $purProFinish[] = ['id' => $proFinished->id, 'value' => $sumaPFinish];
            }
        }else{
            $purProFinish[] = ['id' => 0, 'value' => 0];
        }
        //dd($purProFinish);

        /************************************* TERCERA COLUMNA ONGOING ********************************************/
        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es activo
        if($flag == 1){
            $projectsActivates = Project::whereYear('created_at', '=', $year)
                                            ->where('status_fk',1)->get();
        }else{
            $projectsActivates = Project::whereYear('created_at', '=', $year)
                                            ->where('status_fk',1)
                                            ->where('start_date_project', '<=',$date)
                                            ->where('end_date_project', '>=',$date)
                                            ->orderByDesc('start_date_project')
                                            ->get();
        }

        //Se cuentan los proyectos que cumplen con la restricción anterior
        $nPActivates = $projectsActivates->count();

        /*** COMPRAS DE LOS PROYECTOS EN CURSO  */
        //Consultamos la cantidad de proyectos que finalizaron en el rango de fechas consultadas
        if($nPActivates != 0){
            foreach($projectsActivates as $proActivate){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsActivate = Purchase::where('project_fk', $proActivate->id)->get();
                $sumaPActivate = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsActivate as $pProjectsActivate){
                    $sumaPActivate += $pProjectsActivate->amount;
                }

                //Almacenamos la información en una colección
                $purProActivate[] = ['id' => $proActivate->id, 'value' => $sumaPActivate];
            }
        }else{
            $purProActivate[] = ['id' => 0, 'value' => 0];
        }

        /**************************************** CUARTA COLUMNA NEXT PROJECTS ************************************/
        /** SUMA DE FECHAS */
        //Se convierte la fecha string a un objeto tipo Date
        $fechaFinal = date_create($date);
        //dd($date);

        //Fecha final de la consulta mas un dia
        $newDateOneDay =date_add($fechaFinal,date_interval_create_from_date_string("1 days"));
        $newDateOneDayFormat = date_format($newDateOneDay,"m/d/Y"); //Se cambia el formato

        //Fecha final de la consulta mas dos semanas
        $newDateOneWeek =date_add($fechaFinal,date_interval_create_from_date_string("2 weeks"));
        $newDateOneWeekFormat = date_format($newDateOneWeek,"m/d/Y");

        //Consultamos los proyectos que se encuentran en el nuevo rango de fechas
        $projectsNext = Project::whereYear('created_at', '=', $year)
                                ->whereBetween('start_date_project',[$newDateOneDayFormat, $newDateOneWeekFormat])
                                ->orderBy('start_date_project','asc')
                                ->get();
        $nPNext = $projectsNext->count();

        /******************************************** QUINTA COLUMNA ARCHIVED ***************************************/
        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es activo
       
        $projectsArchiveds = Project::whereYear('created_at', '=', $year)
                                    ->where('start_date_project', '<=',$date)
                                    ->where('end_date_project', '>=',$date)
                                    ->where('status_fk',4)
                                    ->orderByDesc('start_date_project')
                                    ->get();

        $nPArchived = $projectsArchiveds->count();
        //dd($projectsArchiveds);

        /******************************************** SEXTA COLUMNA PAUSED ***************************************/
        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es activo
        if($flag == 1){
            $projectsPaused = Project::whereYear('created_at', '=', $year)
                                        ->where('status_fk',5)
                                        ->get(); 
                                
        }else{
            $projectsPaused = Project::whereYear('created_at', '=', $year)
                                        ->where('status_fk',5)
                                        ->where('start_date_project', '<=',$date)
                                        ->where('end_date_project', '>=',$date)
                                        ->orderByDesc('start_date_project')
                                        ->get();
        }
        
        $nPPaused = $projectsPaused->count();
        //dd($projectsPaused);
        if($nPPaused != 0){
            foreach($projectsPaused as $proPaused){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsPaused = Purchase::where('project_fk', $proPaused->id)->get();
                $sumaPPaused = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsPaused as $pProjectsPause){
                    $sumaPPaused += $pProjectsPause->amount;
                }

                //Almacenamos la información en una colección
                $purProPaused[] = ['id' => $proPaused->id, 'value' => $sumaPPaused];
            }
        }else{
            $purProPaused[] = ['id' => 0, 'value' => 0];
        }

        /***************************************** TOTAL CURRENT SPENT X DAY ****************************************/
        $allProjects = Project::all();

        $comprasDiarias = Purchase::where('date_purchase',$date)->get();
        if($comprasDiarias->count() != 0){
            $sumaXTotalCurrentSpent = 0;
            foreach($comprasDiarias as $comprasDiarias){
                $sumaXTotalCurrentSpent += $comprasDiarias->amount;
                //ALMACENA TODAS LAS COMPRAS QUE SE REALIZARON EN UNA FECHA ESPECIFICA
                $project = Project::find($comprasDiarias->project_fk);
                $projectXDays[] = ['project_FK' => $comprasDiarias->project_fk , 'amount' => $comprasDiarias->amount, 'date' => $comprasDiarias->date_purchase , 'status' => $project->status_fk];
            }
        }else{
            $projectXDays[] = ['project_FK' => 0 , 'amount' => 0, 'date' => 0 , 'status' => 0];
            $sumaXTotalCurrentSpent = 0; 
        }
        //dd($projectXDays);

        //Obtengo el total de compras por cada fecha
        //Foreach para obtener los id de los proyectos que se encuentran en las compras
        $idProjects = [];
        foreach ($projectXDays as $p){
            if( !in_array( $p['project_FK'] ,$idProjects ) )
            {
                array_push($idProjects,$p['project_FK']);
            }
        }

        $idProWithoutF = []; 
        //dd($idProjects);

        foreach($idProjects as $idp){
            if($idp != 0){
                $pro = Project::find($idp);
                //dd($pro); 
                if($pro->status_fk != 2){
                    array_push($idProWithoutF,$idp);
                }
            }else{
                array_push($idProWithoutF,0);
            } 
        }

        foreach($idProjects as $idPro){
            $t = 0.00;
            foreach($projectXDays as $p){
                if($p['project_FK']== $idPro){
                    $t += $p['amount'];
                }
            }
            $arrayProjectsXDay[] = ['idPro'=> $idPro,'total' => $t];
        }
        /********************************************** INFORMACION POR PROYECTO FINALIZADO *********************/
        if(count($projectsFinished) != 0){
            foreach($projectsFinished as $projectF){
                foreach($purProFinish as $purPro){
                    if($projectF->id == $purPro['id']){
                        $diferencia = $projectF->sold_project - $purPro['value'];
                        $infoProFinish[] = ['namePro' => $projectF->name_project ,'proSold' => $projectF->sold_project , 'proExpen' => $purPro['value'] , 'profit' => $diferencia,
                        'dateProFinish'=> $projectF->end_date_project]; 
                    }
                }
            }
        }else{
            $infoProFinish[] = ['namePro' => 0 ,'proSold' => 0 , 'proExpen' => 0 , 'profit' => 0, 'dateProFinish'=>0]; 
        }
        
        $totalSoldFinished = 0;
        $totalExpensesFinished = 0;
        $totalProfitFinished = 0; 
        foreach($infoProFinish as $infoP){
            $totalSoldFinished +=  $infoP['proSold'];
            $totalExpensesFinished += $infoP['proExpen'];
            $totalProfitFinished += $infoP['profit'];
        }
        $totalesProjectsFinished[] = ['tSoldFinish' => $totalSoldFinished , 'tExpensesFinish' => $totalExpensesFinished , 'tProfitFinish' => $totalProfitFinished];
        //dd($totalesProjectsFinished); 


        //Ongoing overview para el día actual
        if($flag == 1){

        /********************************************** INFORMACION POR PROYECTOS EN ONGOING ********************/
        //Proyectos que estan activos: $projectsActivates
        //Cantidad de proyectos activos: $nPActivates
        //Compras de los proyectos activos 
        $projectsActiPau = Project::whereYear('created_at', '=', $year)
                            ->whereIn('status_fk',[1])
                            ->orderByDesc('start_date_project')
                            ->get();

            //Se cuentan los proyectos que cumplen con la restricción anterior
            $nPActiPau = $projectsActiPau->count();

            /*** COMPRAS DE LOS PROYECTOS EN CURSO  */
            //Consultamos la cantidad de proyectos que finalizaron en el rango de fechas consultadas
            if($nPActiPau != 0){
                foreach($projectsActiPau as $proActivate){
                    //Obtenemos las compras de cada uno de los proyectos
                    $purchaseProjectsActivate = Purchase::whereYear('created_at', '=', $year)
                                                ->where('project_fk', $proActivate->id)
                                                ->get();
                    $sumaPActivate = 0.00;
                    //Realizamos la suma de cada una de las compras
                    foreach($purchaseProjectsActivate as $pProjectsActivate){
                        $sumaPActivate += $pProjectsActivate->amount;
                    }
                    //Almacenamos la información en una colección
                    $purProActiPau[] = ['id' => $proActivate->id, 'value' => $sumaPActivate];
                }
            }else{
                $purProActiPau[] = ['id' => 0, 'value' => 0];
            }

            if(count($purProActiPau) != 0){
                foreach($allProjects as $allP){
                    foreach($purProActiPau as $purProA){
                        if($purProA['id'] == $allP->id){
                            $red = 0;
                            $green = 0;
                            $yellow = 0; 
                            $gray = 0;
                            if($allP->start_date_project >= $date &&  $allP->start_date_project <= $date ){
                                $green = 1;
                            }
                            if($allP->end_date_project >= $date &&  $allP->end_date_project <= $date && $allP->status_fk == 2){
                                $red = 1;
                            }
                            if($allP->status_fk == 1){
                                $yellow = 1; 
                            }
                            if($allP->status_fk == 5){
                                $gray = 1; 
                            }
                            if($purProA['value'] != 0){
                                $profit = $allP->sold_project - $purProA['value']; 
                            }else{
                                $profit = 0; 
                            }
                            
                            $arrayProfit[] = ['name' => $allP->name_project, 'sold' => $allP->sold_project, 'expenses' => $purProA['value'] , 'profit'=> $profit ,
                            'green' => $green , 'red' => $red , 'yellow' => $yellow , 'gray' => $gray, 'budget' => $allP->budget_project];
                        }else{
                            $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0, 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 , 'budget' => 0];
                        }
                    }
                }
            }else{
                $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0, 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 , 'budget' => 0];
            }
            //dd($arrayProfit);

            //Funcion para realizar la suma total de las ventas, gastos y beneficio
            $totalSold = 0.00;
            $totalSpent = 0.00;
            $totalCurrentSpent = 0.00;
            $totalProfit = 0.00;
            $budget = 0.00; 
            foreach($arrayProfit as $protArray){
            $totalSold += $protArray['sold'];
            $totalSpent += $protArray['expenses'];
            $totalProfit += $protArray['profit'];
            $budget += $protArray['budget'];
            }
            //dd($protArray);
            $totalesProjects[] = ['totalSold' => $totalSold, 'totalSpent' => $totalSpent , 'totalProfit' => $totalProfit , 'totalCurrent' => $totalCurrentSpent, 'budget' => $budget];

        }else{
            
        
        /********************************************** INFORMACION POR PROYECTO ********************************/
        $projectsActiPau = Project::whereYear('created_at', '=', $year)
                                    ->whereIn('status_fk',[1])
                                    ->where('start_date_project', '<=',$date)
                                    ->where('end_date_project', '>=',$date)
                                    ->orderByDesc('start_date_project')
                                    ->get();
        //Se cuentan los proyectos que cumplen con la restricción anterior
        $nPActiPau = $projectsActiPau->count();

        /*** COMPRAS DE LOS PROYECTOS EN CURSO  */
        //Consultamos la cantidad de proyectos que finalizaron en el rango de fechas consultadas
        if($nPActiPau != 0){
            foreach($projectsActiPau as $proActivate){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsActivate = Purchase::where('project_fk', $proActivate->id)
                                                    ->where('date_purchase', $date)
                                                    ->get();
                $sumaPActivate = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsActivate as $pProjectsActivate){
                    $sumaPActivate += $pProjectsActivate->amount;
                }
                //Almacenamos la información en una colección
                $purProActiPau[] = ['id' => $proActivate->id, 'value' => $sumaPActivate];
            }
        }else{
            $purProActiPau[] = ['id' => 0, 'value' => 0];
        }

        //dd($purProActiPau);
        if(count($purProActiPau) != 0){
            
            foreach($allProjects as $allP){
                foreach($purProActiPau as $purProA){
                    
                    if($purProA['id'] == $allP->id){
                        $red = 0;
                        $green = 0;
                        $yellow = 0; 
                        $gray = 0;
                        if($allP->start_date_project >= $date &&  $allP->start_date_project <= $date ){
                            $green = 1;
                        }
                        if($allP->end_date_project >= $date &&  $allP->end_date_project <= $date && $allP->status_fk == 2){
                            $red = 1;
                        }
                        if($allP->status_fk == 1){
                            $yellow = 1; 
                        }
                        if($allP->status_fk == 5){
                            $gray = 1; 
                        }
                        $allPurchases =Purchase::where('project_fk', $allP->id)->get();
                        $acumuladorPurchases = 0.00;
                        foreach($allPurchases as $allPu){
                            
                            $acumuladorPurchases += $allPu->amount;
                        }
                        if($purProA['value'] != 0){
                            $profit = $allP->sold_project - $purProA['value']; 
                        }else{
                            $profit = 0; 
                        }
                        
                        $arrayProfit[] = ['name' => $allP->name_project, 'sold' => $allP->sold_project, 'expenses' => $purProA['value'] , 'profit'=> $profit ,
                        'green' => $green , 'red' => $red , 'yellow' => $yellow , 'gray' => $gray, 'totalCurrent' => $acumuladorPurchases , 'budget' =>  $allP->budget_project ];
                        
                    }
                    else{
                        $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0, 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 ,'totalCurrent' => 0 , 'budget' => 0];
                    }
                }
            }
        }else{
            $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0, 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 , 'totalCurrent' => 0 ,'budget' => 0];
        }
        
         
 /*         if($arrayTotalProjects[0]['idPro'] != 0){
            foreach($allProjects as $allP){
                foreach($arrayTotalProjects as $aTotalProjects){
                    if($aTotalProjects['idPro'] == $allP->id){
                        $red = 0;
                        $green = 0;
                        $yellow = 0; 
                        $gray = 0;
                        if($allP->start_date_project >= $date &&  $allP->start_date_project <= $date ){
                            $green = 1;
                        }
                        if($allP->end_date_project >= $date &&  $allP->end_date_project <= $date && $allP->status_fk == 2){
                            $red = 1;
                        }
                        if($allP->status_fk == 1){
                            $yellow = 1; 
                        }
                        if($allP->status_fk == 5){
                            $gray = 1; 
                        }
                        $profit = $allP->sold_project - $aTotalProjects['totalACompras'];
                        $arrayProfit[] = ['name' => $allP->name_project, 'sold' => $allP->sold_project, 'expenses' => $aTotalProjects['total'] , 'profit'=> $profit ,
                        'green' => $green , 'red' => $red , 'yellow' => $yellow , 'gray' => $gray, 'totalCurrent' => $aTotalProjects['totalACompras']];
                    }
                }
            }
        }else{
            $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0 , 'profit'=> 0 ,'totalCurrent' => 0,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0];
        } */
        
        //Funcion para realizar la suma total de las ventas, gastos y beneficio
        $totalSold = 0.00;
        $totalSpent = 0.00;
        $totalCurrentSpent = 0.00;
        $totalProfit = 0.00;
        $totalBudget = 0.00;
        foreach($arrayProfit as $protArray){
            $totalSold += $protArray['sold'];
            $totalSpent += $protArray['expenses'];
            $totalCurrentSpent += $protArray['totalCurrent'];
            $totalProfit += $protArray['profit'];
            $totalBudget += $protArray['budget'];
        }
        $totalesProjects[] = ['totalSold' => $totalSold, 'totalSpent' => $totalSpent , 'totalProfit' => $totalProfit , 'totalCurrent' => $totalCurrentSpent , 'budget' => $totalBudget ];
        }

        
        //dd($totalesProjects);

        /****************************************************** TOTAL PAYROLL ******************************/

        function getPurchases($date1,$id){
            $purchases = Purchase::where('date_purchase',$date1)
                                    ->where('purchase_categorie_fk', $id)
                                    ->get();
            return $purchases;
        }

        $data[] = [];
        function getData($object){
            $cant = count($object);
            if($cant != 0){
                foreach($object as $o){
                    $data[] = ['day' => $o->date_purchase , 'idProject' => $o->project_fk , 'category' => $o->purchase_categorie_fk , 'amount' => $o->amount]; 
                }
            }else{
                $data[] = ['day' => 0 , 'idProject' => 0 , 'category' => 0 , 'amount' => 0];
            }
            return $data;
        }
        $laborCategories = PurchaseCategory::where('type_category','labor')->get();
        foreach($laborCategories as $laCategori){
            $compras = getPurchases($date,$laCategori->id);
            $array[] = getData($compras);
        }

        $cantidadArray = count($array);

        //Se obtiene los id de los proyectos donde hubieron trabajadores y las categorias
        $arrayIdProjects = [];
        for($i = 0; $i < $cantidadArray; $i++){
            foreach($array[$i] as $a){
                if( !in_array( $a['idProject'] ,$arrayIdProjects ) )
                {
                array_push($arrayIdProjects,$a['idProject']);
                }
            }
        }

        foreach($arrayIdProjects as $idPro){
            $totalIdProject = 0;
            for ($i = 0; $i < $cantidadArray; $i++){
                foreach($array[$i] as $a){
                        if($a['idProject'] == $idPro){
                            $totalIdProject += $a['amount']; 
                        }
                }
            }
            $totalXProjectDay[] = ['day' => $date, 'idPro' => $idPro , 'total' => $totalIdProject];
        }

        $totalPayroll = 0;
        foreach($totalXProjectDay as $totales){
            $totalPayroll += $totales['total']; 
        }

        /**************************************** TRUCKING SUMMARY ****************************************/

        function purchaseQuery($i,$date){
            $comprasQuery = Purchase::where('date_purchase',$date)
                                ->where('purchase_categorie_fk',$i)
                                ->get();
            return $comprasQuery;
        }
        function collectionPurchase($compras){
                    //Cuento cuantas compras cumplen con los requisitos
            $n = count($compras);
            //Valido que la cantidad de compras sea distinta de cero, ya que se debe de crear una colección con datos.
            if($n != 0){
                foreach($compras as $compra){
                    $C[] = ['projectFK' => $compra->project_fk ,'compra' => $compra->amount];
                }
            }else{
                //Si no hay compras se asigna un proyecto con el valor de -1 ya que no existe dicho proyecto, además ese valor se puede ocupar para futuras validaciones.
                $C[] = ['projectFK' => -1,'compra' => 0];
            }
            return $C;
        }
        //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
        
        //Material Export --- 4
        $comprasMaterialE = purchaseQuery(4,$date);
        $C_MaterialE[] = collectionPurchase($comprasMaterialE);

        /* Export ***********************/
        //Concret Export --- 19
        $comprasConcreteE = purchaseQuery(19,$date);
        $C_ExportE[] = collectionPurchase($comprasConcreteE);

        //Dirt Export --- 20
        $comprasDirtE = purchaseQuery(20,$date);
        $C_DirtE[] = collectionPurchase($comprasDirtE);

        //Mixed Export --- 21
        $comprasMixedE = purchaseQuery(21,$date);
        $C_MixedE[] = collectionPurchase($comprasMixedE);

        //Trash Export --- 22
        $comprasTrashE = purchaseQuery(22,$date);
        $C_TrashE[] = collectionPurchase($comprasTrashE);

        //Asphalt Export --- 39
        $comprasAsphaltE = purchaseQuery(39,$date);
        $C_AsphaltE[] = collectionPurchase($comprasAsphaltE);

        //Dirt + Rock Export --- 40
        $comprasDirtRockE = purchaseQuery(40,$date);
        $C_DirtRockE[] = collectionPurchase($comprasDirtRockE);

        //Trash 40CY Export --- 41
        $comprasTrash40CYE = purchaseQuery(41,$date);
        $C_Trash40CYE[] = collectionPurchase($comprasTrash40CYE);

        /* Import **********************/
        //Sand Import --- 23
        $comprasSandI = purchaseQuery(23,$date);
        $C_SandI[] = collectionPurchase($comprasSandI);

        //Base Import --- 24
        $comprasBaseI = purchaseQuery(24,$date);
        $C_BaseI[] = collectionPurchase($comprasBaseI);

        //Gravel Import --- 25
        $comprasGravelI = purchaseQuery(25,$date);
        $C_GravelI[] = collectionPurchase($comprasGravelI);

        //Soil Import --- 26
        $comprasSoilI = purchaseQuery(26,$date);
        $C_SoilI[] = collectionPurchase($comprasSoilI);

        //Dirt Import --- 42
        $comprasDirtI = purchaseQuery(42,$date);
        $C_DirtI[] = collectionPurchase($comprasDirtI);

        //Asphalt Import --- 43
        $comprasAsphaltI = purchaseQuery(43,$date);
        $C_AsphaltI[] = collectionPurchase($comprasAsphaltI);

        //Aggregates Import --- 14
        $comprasAggregatesI = purchaseQuery(14,$date);
        $C_AggregatesI[] = collectionPurchase($comprasAggregatesI);

        
        /**** FUNCIÓN PARA OBTENER EL TOTAL DE LAS COMPRAS DE PROYECTO POR CATEGORIA DE CAMIONES ****/
        //LA FUNCIÓN RECIBE EL ID DEL PROYECTO Y LA COLECCION DE LA CATEGORIA DE CAMIONES
        function SumaxCategoria($id, $arreglo){
            //se declara una variable para la acumulación de las compras
            $totalSumaxCategory = 0.00;
            //Se recorre el arreglo de la categoria 
            foreach($arreglo as $category){
                //Compara que en el arreglo de la categoria sea igual los ID de los proyectos
                if($id == $category['projectFK']){
                    $totalSumaxCategory += $category['compra'];
                }
            }
            //Se retorna el total
            return $totalSumaxCategory;
        }

        //Foreach para obtener el total de compras de manera independiente 
        foreach($allProjects as $project){
            $totalCompraMaterialE = SumaxCategoria($project->id, $C_MaterialE[0]); 
            $totalCompraExportE = SumaxCategoria($project->id, $C_ExportE[0]);
            $totalCompraDirtE = SumaxCategoria($project->id, $C_DirtE[0]);
            $totalCompraMixedE = SumaxCategoria($project->id, $C_MixedE[0]);
            $totalCompraTrashE = SumaxCategoria($project->id, $C_TrashE[0]);
            $totalCompraAsphaltE = SumaxCategoria($project->id, $C_AsphaltE[0]);
            $totalCompraDirtRockE = SumaxCategoria($project->id, $C_DirtRockE[0]);
            $totalCompraTrash40CYE = SumaxCategoria($project->id, $C_Trash40CYE[0]);
            $totalCompraSandI = SumaxCategoria($project->id, $C_SandI[0]);
            $totalCompraBaseI = SumaxCategoria($project->id, $C_BaseI[0]);
            $totalCompraGravelI = SumaxCategoria($project->id, $C_GravelI[0]);
            $totalCompraSoilI = SumaxCategoria($project->id, $C_SoilI[0]);
            $totalCompraDirtI = SumaxCategoria($project->id, $C_DirtI[0]);
            $totalCompraAsphaltI = SumaxCategoria($project->id, $C_AsphaltI[0]);
            $totalCompraAggregatesI = SumaxCategoria($project->id, $C_AggregatesI[0]);
            $totalAllCompras = $totalCompraMaterialE + $totalCompraExportE + $totalCompraDirtE + $totalCompraMixedE + $totalCompraTrashE 
            + $totalCompraSandI + $totalCompraBaseI + $totalCompraGravelI + $totalCompraSoilI + $totalCompraDirtI + $totalCompraAsphaltI + $totalCompraAggregatesI
            + $totalCompraAsphaltE + $totalCompraDirtRockE + $totalCompraTrash40CYE; 

            $totalComprasTruck[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCMaterialE' => $totalCompraMaterialE , 'tCExportE' => $totalCompraExportE , 
            'tCDirtE' => $totalCompraDirtE, 'tCMixedE' => $totalCompraMixedE, 'tCTrashE' => $totalCompraTrashE , 'tCSandI' => $totalCompraSandI ,'tCBaseI' => $totalCompraBaseI , 
            'tCGravelI' => $totalCompraGravelI ,'tCSoilI' => $totalCompraSoilI ,'tCDirtI'=>$totalCompraDirtI ,'tCAsphaltI'=>$totalCompraAsphaltI ,
            'tCAggregatesI'=> $totalCompraAggregatesI,'tCAsphaltE'=>  $totalCompraAsphaltE,'tCDirtRockE'=>$totalCompraDirtRockE,'tCTrash40CYE'=>$totalCompraTrash40CYE,'total' => $totalAllCompras];
        }
        //dd($totalComprasTruck);
        //Acumulador para la suma total de los camiones
        $totalCurrentTrucking= 0.00;
        foreach($totalComprasTruck as $totalCurrentSpentTrucking){
            $totalCurrentTrucking += $totalCurrentSpentTrucking['total'];
        }

        function totalxCategorie($arreglo, $type){
            $total = 0;
            foreach($arreglo as $totalTrucking){
                $total += $totalTrucking[$type];
            }
            return $total;
        }

        /* Exports */
        $totalMaterialE = totalxCategorie($totalComprasTruck, 'tCMaterialE');
        $totalExportE = totalxCategorie($totalComprasTruck, 'tCExportE');
        $totalDirtE = totalxCategorie($totalComprasTruck, 'tCDirtE');
        $totalMixedE = totalxCategorie($totalComprasTruck, 'tCMixedE');
        $totalTrashE = totalxCategorie($totalComprasTruck, 'tCTrashE');
        $totalAsphaltE = totalxCategorie($totalComprasTruck, 'tCAsphaltE');
        $totalDirtRockE = totalxCategorie($totalComprasTruck, 'tCDirtRockE');
        $totalTrash40CYE = totalxCategorie($totalComprasTruck, 'tCTrash40CYE');

        $totalTruckExport = $totalMaterialE + $totalExportE + $totalDirtE + $totalMixedE + 
                            $totalTrashE + $totalAsphaltE + $totalDirtRockE + $totalTrash40CYE;
        
        $arrayTotalExport[] = ['total'=>$totalTruckExport, 'Material'=>$totalMaterialE, 'Export'=>$totalExportE,
                                'Dirt'=>$totalDirtE, 'Mixed'=>$totalMixedE, 'Trash'=>$totalTrashE,
                                'Asphalt'=>$totalAsphaltE,'DirtRock'=>$totalDirtRockE, 'Trash40CY'=>$totalTrash40CYE];

        /* Imports */
        $totalSandI = totalxCategorie($totalComprasTruck, 'tCSandI');
        $totalBaseI = totalxCategorie($totalComprasTruck, 'tCBaseI');
        $totalGravelI = totalxCategorie($totalComprasTruck, 'tCGravelI');
        $totalSoilI = totalxCategorie($totalComprasTruck, 'tCSoilI');
        $totalDirtI = totalxCategorie($totalComprasTruck, 'tCDirtI');
        $totalAsphaltI = totalxCategorie($totalComprasTruck, 'tCAsphaltI');
        $totalAggregatesI = totalxCategorie($totalComprasTruck, 'tCAggregatesI');

        $totalTruckImport = $totalSandI + $totalBaseI + $totalGravelI + $totalSoilI +
                            $totalDirtI + $totalAsphaltI + $totalAggregatesI;

        $arrayTotalImport[] = ['total'=>$totalTruckImport, 'Sand'=>$totalSandI, 'Base'=>$totalBaseI, 'Gravel'=>$totalGravelI,
                                'Soil'=>$totalSoilI, 'Dirt'=>$totalDirtI, 'Asphalt'=>$totalAsphaltI, 'Aggregates'=>$totalAggregatesI];

        /******************************************************* OTHER **************************************************/
        // 1. Tools & Materials
        $comprasToolsMaterial = purchaseQuery(1,$date);
        $C_ToolMaterial[] = collectionPurchase($comprasToolsMaterial);

        // 2. Subcontractor
        $comprasSubcontractor = purchaseQuery(2,$date);
        $C_Subcontractor[] = collectionPurchase($comprasSubcontractor);
        
        // 3. Aggregates Import
        $comprasAggregates = purchaseQuery(3,$date);
        $C_Aggregate[] = collectionPurchase($comprasAggregates);

        // 7. Homedepot
        $comprasHomedepot = purchaseQuery(7,$date);
        $C_Home[] = collectionPurchase($comprasHomedepot);
        
        // 8. Materials
        $comprasMateria = purchaseQuery(8,$date);
        $C_Mate[] = collectionPurchase($comprasMateria);

        // 9. Repairs/Tow
        $comprasRepairs = purchaseQuery(9,$date);
        $C_Repair[] = collectionPurchase($comprasRepairs);
        
        // 10. Equipment Rental
        $comprasEquipmentRental = purchaseQuery(10,$date);
        $C_Equipment[] = collectionPurchase($comprasEquipmentRental);

        // 14. Import (Aggregates)
        $comprasImportA = purchaseQuery(14,$date);
        $C_ImportA[] = collectionPurchase($comprasImportA);

        // 15. Office/Admin
        $comprasOffice = purchaseQuery(15,$date);
        $C_Office[] = collectionPurchase($comprasOffice);

        // 16. Tool Purchase
        $comprasToolPurchase = purchaseQuery(16,$date);
        $C_ToolPurchase[] = collectionPurchase($comprasToolPurchase);

        // 17. Tools Rental
        $comprasToolRental = purchaseQuery(17,$date);
        $C_ToolRental[] = collectionPurchase($comprasToolRental);

        // 18. Miscellaneus
        $comprasMiscellaneus = purchaseQuery(18,$date);
        $C_Miscellaneus[] = collectionPurchase($comprasMiscellaneus);

        // 44. Concrete Mix
        $comprasConcreteMix = purchaseQuery(44,$date);
        $C_ConcreteMix[] = collectionPurchase($comprasConcreteMix);

        // 45. Pump
        $comprasPump = purchaseQuery(45,$date);
        $C_Pump[] = collectionPurchase($comprasPump);

        foreach($allProjects as $project){
            $totalCompraToolMa = SumaxCategoria($project->id, $C_ToolMaterial[0]); 
            $totalCompraSubcontractor = SumaxCategoria($project->id, $C_Subcontractor[0]);
            $totalCompraAggregates = SumaxCategoria($project->id, $C_Aggregate[0]);
            $totalCompraHomedepot = SumaxCategoria($project->id, $C_Home[0]);
            $totalCompraMaterials = SumaxCategoria($project->id, $C_Mate[0]);
            $totalCompraRepairs = SumaxCategoria($project->id,$C_Repair[0]);
            $totalCompraEquipmentRental = SumaxCategoria($project->id, $C_Equipment[0]);
            $totalCompraImport = SumaxCategoria($project->id,$C_ImportA[0]);
            $totalCompraOffice = SumaxCategoria($project->id, $C_Office[0]);
            $totalCompraToolPurchase = SumaxCategoria($project->id,$C_ToolPurchase[0]);
            $totalCompraToolRental = SumaxCategoria($project->id, $C_ToolRental[0]);
            $totalCompraMiscellaneus = SumaxCategoria($project->id, $C_Miscellaneus[0]);
            $totalCompraConcreteMix = SumaxCategoria($project->id, $C_ConcreteMix[0]);
            $totalCompraPump = SumaxCategoria($project->id, $C_Pump[0]);
            $totalAllCompras = $totalCompraToolMa + $totalCompraAggregates + $totalCompraHomedepot + $totalCompraMaterials 
            + $totalCompraRepairs + $totalCompraEquipmentRental + $totalCompraImport + $totalCompraOffice + $totalCompraToolPurchase + $totalCompraToolRental
            + $totalCompraMiscellaneus; 

            $totalAllConcreteMix_pump = $totalCompraConcreteMix + $totalCompraPump;
        
            $totalComprasOther[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCToolMa' => $totalCompraToolMa ,'tCAggre' => $totalCompraAggregates,
            'tCHome' => $totalCompraHomedepot, 'tCMateria' => $totalCompraMaterials , 'tCRepair' => $totalCompraRepairs ,'tCEquipmentRental' => $totalCompraEquipmentRental , 'tCImport' => $totalCompraImport ,
            'tCOffice' => $totalCompraOffice , 'tCToolPurchase' => $totalCompraToolPurchase , 'tCToolRental' => $totalCompraToolRental , 'tCMiscellaneus' => $totalCompraMiscellaneus , 
            'total' => $totalAllCompras];

            $totalConcreteMix_pump[] = ['IDProject' => $project->id, 'projectName' => $project->name_project,'tCConcreteMix'=> $totalCompraConcreteMix,'tCPump'=>$totalCompraPump , 'total' => $totalAllConcreteMix_pump];

            $totalSubcontractor[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCSubcontra' => $totalCompraSubcontractor];
        }
        //Acumulador para la suma total de los otras compras
        $totalCurrentOther= 0.00;
        foreach($totalComprasOther as $totalCurrentSpentOthe){
            $totalCurrentOther += $totalCurrentSpentOthe['total'];
        }

        //Acumulador para la suma total de Concrete Mix & Pump
        $totalCurrentMixPump= 0.00;
        foreach($totalConcreteMix_pump as $totalCurrentSpentOthe){
            $totalCurrentMixPump += $totalCurrentSpentOthe['total'];
        }

        //Acumulador para la suma total de Subcontractor
        $totalCurrentSubcontractor= 0.00;
        foreach($totalSubcontractor as $totalCurrentSpentOthe){
            $totalCurrentSubcontractor += $totalCurrentSpentOthe['tCSubcontra'];
        }

        /*********************************************************** RETURN *********************************************/
        switch($flag){
            case 1:
                return view('Report.reportToday',compact('date','allProjects','nPStarts','projectsStarts','purProStarts','nPFinished','projectsFinished',
                'purProFinish','nPActivates','projectsActivates','purProActivate','nPNext','projectsNext','sumaXTotalCurrentSpent',
                'arrayProjectsXDay','arrayProfit','totalesProjects','totalComprasTruck','totalCurrentTrucking','totalComprasOther','totalCurrentOther',
                'nPArchived','projectsArchiveds','totalPayroll','totalXProjectDay','infoProFinish','totalesProjectsFinished','nPPaused','projectsPaused',
                'purProPaused','totalConcreteMix_pump','totalCurrentMixPump','totalSubcontractor','totalCurrentSubcontractor','arrayTotalExport','arrayTotalImport'));
            break;
            case 5: 
                return view('Report.reportOneDay',compact('date','allProjects','nPStarts','projectsStarts','purProStarts','nPFinished','projectsFinished',
                    'purProFinish','nPActivates','projectsActivates','purProActivate','nPNext','projectsNext','sumaXTotalCurrentSpent',
                    'arrayProjectsXDay','arrayProfit','totalesProjects','totalComprasTruck','totalCurrentTrucking','totalComprasOther','totalCurrentOther',
                    'nPArchived','projectsArchiveds','totalPayroll','totalXProjectDay','infoProFinish','totalesProjectsFinished','day','nPPaused','projectsPaused',
                    'purProPaused','totalConcreteMix_pump','totalCurrentMixPump','totalSubcontractor','totalCurrentSubcontractor','arrayTotalExport','arrayTotalImport'));
            break;
        }
    }
}