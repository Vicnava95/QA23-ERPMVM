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

class ReportMonthController extends Controller
{
    /**
     * Flag 6 = This Month
     * Flag 7 = Last Month
     * Se tiene una variable flag, para poder decidir que template mostrar
     */

    public function showReportMonth($sDate,$eDate,$flag)
    {
        //Se obtiene el rango de las fechas a consultar
        //Fomato de fechas : mes/dias/año
        $startDate = Carbon::parse($sDate)->format('m/d/Y');
        $endDate = Carbon::parse($eDate)->format('m/d/Y');
        $year = Carbon::parse($sDate)->format('Y');
        //$startDate = '04/01/2021';
        //$endDate = '04/05/2021'; 
/****************************************** PRIMERA COLUMNA STARTED **************************************/

        //Se obtienen los proyectos que iniciaron en esa fecha sin importar su estado
        $projectsStarts = Project::whereYear('created_at', '=', $year)
                                    ->whereBetween('start_date_project',[$startDate, $endDate])
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
                                    ->whereBetween('end_date_project',[$startDate, $endDate])
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

/************************************* TERCERA COLUMNA ONGOING ********************************************/

        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es activo
        if($flag == 7){
            $projectsActivates = Project::where('start_date_project', '<=',$endDate)
                                        ->where('status_fk',1)
                                        ->orderByDesc('start_date_project')
                                        ->get();
        }else{
            $projectsActivates = Project::where('status_fk',1)
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
        $fechaFinal = date_create($endDate);

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
        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es archivado
        $projectsArchiveds = Project::whereYear('created_at', '=', $year)
                                    ->whereBetween('start_date_project',[$startDate, $endDate])
                                    ->where('status_fk',4)
                                    ->orderByDesc('start_date_project')
                                    ->get();
        $nPArchived = $projectsArchiveds->count();

        /******************************************** SEXTA COLUMNA PAUSED ***************************************/
        //Se obtienen los proyectos que iniciaron en esa fecha y su estado es activo
        if($flag == 6){
            $projectsPaused = Project::whereYear('created_at', '=', $year)
                            ->where('status_fk',5)
                            ->orderByDesc('start_date_project')
                            ->get();
        }else{
            $projectsPaused = Project::whereYear('created_at', '=', $year)
                            ->where('start_date_project', '<=',$endDate)
                            ->where('status_fk',5)
                            ->orderByDesc('start_date_project')
                            ->get();
        }
        
        $nPPaused = $projectsPaused->count();
        //dd($projectsArchiveds);
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
        

/*********************************************** BUSCAR POR SEMANAS *****************************************/
        //Función para buscar las fechas que contiene una semana en un año específico
        $allProjects = Project::all();
        function getStartAndEndDate($week, $year,$startDate, $endDate, $fijoInicio,$fijoFinal ) {
            $dto = new DateTime();
            $dto->setISODate($year, $week);
            $ret['week'] = $week;
            $ret['week_start'] = $dto->format('m/d/Y');
            $dto->modify('+6 days');
            $ret['week_end'] = $dto->format('m/d/Y');
            $ret['startDateQuery'] = $startDate;
            $ret['endDateQuery'] = $endDate;
            $ret['inicio'] = $fijoInicio;
            $ret['final'] = $fijoFinal;
            return $ret;
        }

        //Creamos los objetos de tipo fecha con los string recibidos
        $fechaInicialConsulta = date_create($startDate);
        $fechaFinalConsulta = date_create($endDate);

        //Consultamos en que número de la semana se encuentra esa fecha
        $semanainicio = $fechaInicialConsulta->format("W");
        $semanafin = $fechaFinalConsulta->format("W");
        $fijoInicio = $semanainicio;
        $fijoFinal = $semanafin;
        if($semanainicio > $semanafin){
            $semanainicio = 1;
        }

        //Obtengo las fechas que contiene según el numero de semana del año
        $yearQuery = substr($startDate, -4); 
        for($i = (int) $semanainicio; $i <= $semanafin; $i++){
            $week_array = getStartAndEndDate($i,$yearQuery,$startDate,$endDate,$fijoInicio,$fijoFinal);
            $fechasXsemana[] = $week_array;
        } 
        //dd($fechasXsemana);
        /** La colleción $fechasXsemana[] contiene el número de la semana donde se hicieron las consultas de la fecha
         ** y en su arreglo contiene las fechas ingresadas */ 
        //dd($fechasXsemana);

/***************************************** TOTAL CURRENT SPENT X WEEK ****************************************/
        //Se realiza la resta de las semanas para saber cuantas hay entre ellas
        
        $resta = $semanafin - $semanainicio;
        $compareDates[] = ['first' => 0 , 'last' => $resta];
        //dd($resta);
        for($i = 0; $i <= $resta; $i++){    
             /* switch($i){
                case 0:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereYear('created_at', '=', $year)
                                            ->whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])->get();
                    break;
                case $resta:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereYear('created_at', '=', $year)
                                            ->whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])->get();
                    break;
                default:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereYear('created_at', '=', $year)
                                            ->whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])->get();
            }  */
            $comprasXWeek = Purchase::whereYear('created_at', '=', $year)
                                            ->whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])->get();
            //dd($comprasXWeek);
            $sumaXWeek = 0;
            if($comprasXWeek->count() != 0){
                foreach($comprasXWeek as $compraXWeek){
                    $sumaXWeek += $compraXWeek->amount;
                    //ALMACENA TODAS LAS COMPRAS QUE SE REALIZARON EN UNA FECHA ESPECIFICA
                    $projectXWeek[] = ['week'=> $i ,'project_FK' => $compraXWeek->project_fk , 'amount' => $compraXWeek->amount];
                    $totalXProjectXWeek[] = ['project_FK' => $compraXWeek->project_fk , 'amount' => $compraXWeek->amount];
                }
            }else{
                $projectXWeek[] = ['week'=> 0 ,'project_FK' => 0 , 'amount' => 0];
                $totalXProjectXWeek[] = ['project_FK' => 0 , 'amount' => 0];
            }
            
            $totalXWeek[] = ['week' => $fechasXsemana[$i]['week'] , 'total' => $sumaXWeek ]; 
        }

        //Se realiza la suma de todas las compras de todas las semanas
        $totalXQuery = 0.00;
        foreach($totalXWeek as $tXWeek){
            $totalXQuery += $tXWeek['total'];
        }
        //dd($projectXWeek);

        $longitud = sizeOf($projectXWeek);

            foreach($allProjects as $projects){
                
                for($l = 0; $l < $longitud; $l++){
                    if( $projectXWeek[$l]['project_FK'] == $projects->id){
                        $prueba[] = ['project_FK' => $projectXWeek[$l]['project_FK'] ,'week' => $projectXWeek[$l]['week'], 'amount' => $projectXWeek[$l]['amount'] , 'status' => $projects->status_fk];
                    }else{
                        $prueba[] = ['project_FK' => 0 ,'week' => 0, 'amount' => 0 ];
                    }
                }
            }
            //dd($prueba); 
        /* $prueba[] = ['project_FK' => 0 ,'week' => 0, 'amount' => 0 ]; */
        //dd($projectXWeek[0]['project_FK']);
        //Foreach para obtener los id de los proyectos que se encuentran en las compras
        $projects = [];
        $weeks= [];
        foreach ($prueba as $p){
            /*Initialize array with projects*/ 
            if( !in_array( $p['project_FK'] ,$projects ) )
            {
                array_push($projects,$p['project_FK']);
            }
            /*Initialize array with weeks*/
            if( !in_array( $p['week'] ,$weeks ) )
            {
                array_push($weeks,$p['week']);
            }
        }
        
        $projectsWithoutF = [];
        foreach($projects as $p){
            if($p){
                $PEstado = Project::find($p);
                //dd($PEstado);
                if($PEstado->status_fk != 2){
                    array_push($projectsWithoutF,$p);
                }
            }else{
                array_push($projectsWithoutF,0);
            }
        }
        //dd($projectsWithoutF); 

        //Funcion para almacenar en un arreglo las compras que corresponden a una semana
        function weeks($prueba, $numberWeek){
            foreach($prueba as $p){
                $sumaT = 0.00;
                if($p['week'] == $numberWeek){
                    $week0[] = $p;
                }
                else{
                    $week0[] = ['project_FK' => -1, 'week' => -1, 'amount' => 0];
                }
            }
            return $week0;
        }

        //Funcion para buscar las compras de un proyecto en una semana especifica, es el parámetro que recibe 
        function idProject($week0, $idProject){
            foreach($week0 as $we){
                if($we['project_FK'] == $idProject){
                    $another[] = $we; 
                }else{
                    $another[] = ['project_FK' => -1, 'week' => -1, 'amount' => 0];
                }
            }
            return $another; 
        }
    
        //Función para obtener el total de las compras por semana de un proyecto, ya viene el arreglo definido
        function acumulador($another){
            $ty = 0.00;
            foreach($another as $anot){
                $ty += $anot['amount'];
            }
            return $ty;
        }

    
        for($semana = 0; $semana <= $resta; $semana++){
            $paso1 = weeks($prueba,$semana);
            foreach($projects as $p){
                $paso2 = idProject($paso1,$p);
                $r = acumulador($paso2);
                $totakCurrentSpentxWeek[] = ['week' =>  $fechasXsemana[$semana]['week'], 'Project' => $p, 'acumulador' => $r];
            }
        }
        //dd($totakCurrentSpentxWeek);  
/*********************************************** INFORMACION POR PROYECTO FINALIZADO ***************************************/
    //dd($projectsFinished); 
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

    /*********************************************** INFORMACION POR PROYECTO **************************************************/
    
    if($flag == 6){
        $projectsActiPau = Project::whereIn('status_fk',[1])
                                    ->orderByDesc('start_date_project')
                                    ->get();

        $nPActiPau = $projectsActiPau->count();

        if($nPActiPau != 0){
            foreach($projectsActiPau as $proActivate){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsActivate = Purchase::where('project_fk', $proActivate->id)->get();
                $sumaPActivate = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsActivate as $pProjectsActivate){
                    $sumaPActivate += $pProjectsActivate->amount;
                }
                //Almacenamos la información en una colección
                $purProActiPau[] = ['idPro' => $proActivate->id, 'total' => $sumaPActivate];
            }
        }else{
            $purProActiPau[] = ['idPro' => 0, 'total' => 0];
        }

        //dd($arrayTotalProjects);
        if($purProActiPau[0]['idPro'] != 0){
            foreach($allProjects as $allP){
                foreach($purProActiPau as $aTotalProjects){
                    if($aTotalProjects['idPro'] == $allP->id){
                        $red = 0;
                        $green = 0;
                        $yellow = 0; 
                        $gray = 0;
                        if($allP->start_date_project >= $startDate &&  $allP->start_date_project <= $endDate ){
                            $green = 1;
                        }
                        if($allP->end_date_project >= $startDate &&  $allP->end_date_project <= $endDate && $allP->status_fk == 2){
                            $red = 1;
                        }
                        if($allP->status_fk == 1){
                            $yellow = 1; 
                        }
                        if($allP->status_fk == 5){
                            $gray = 1; 
                        }

                        if($aTotalProjects['total'] != 0){
                            $profit = $allP->sold_project - $aTotalProjects['total'];
                        }else{
                            $profit = 0;
                        }
                        $arrayProfit[] = ['name' => $allP->name_project, 'sold' => $allP->sold_project, 'expenses' => $aTotalProjects['total'] , 'profit'=> $profit ,
                        'green' => $green , 'red' => $red , 'yellow' => $yellow ,'gray' => $gray, 'budget' => $allP->budget_project];
                    }
                }
            }
        }else{
            $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0 , 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 , 'totalCurrent'=> 0, 'budget'=>0];
        }


        //Funcion para realizar la suma total de las ventas, gastos y beneficio
        $totalSold = 0.00;
        $totalSpent = 0.00;
        $totalExpensesActualy = 0.00;
        $totalProfit = 0.00;
        $totalBudget = 0.00;
        foreach($arrayProfit as $protArray){
            $totalSold += $protArray['sold'];
            $totalSpent += $protArray['expenses'];
            /* $totalExpensesActualy += $protArray['totalExpenses']; */
            $totalProfit += $protArray['profit'];
            $totalBudget += $protArray['budget'];
        }
        $totalesProjects[] = ['totalSold' => $totalSold, 'totalSpent' => $totalSpent , 'totalProfit' => $totalProfit, 'budget' => $totalBudget];
        //dd($totalesProjects);

    }else{

        $projectsActiPau = Project::whereIn('status_fk',[1])
                            ->where('start_date_project', '<=',$endDate)
                            ->orderByDesc('start_date_project')
                            ->get();

        $nPActiPau = $projectsActiPau->count();

        if($nPActiPau != 0){
            foreach($projectsActiPau as $proActivate){
                //Obtenemos las compras de cada uno de los proyectos
                $purchaseProjectsActivate = Purchase::where('project_fk', $proActivate->id)
                                                    ->whereBetween('date_purchase',[$startDate,$endDate])
                                                    ->get();
                $sumaPActivate = 0.00;
                //Realizamos la suma de cada una de las compras
                foreach($purchaseProjectsActivate as $pProjectsActivate){
                    $sumaPActivate += $pProjectsActivate->amount;
                }
                //Almacenamos la información en una colección
                $purProActiPau[] = ['idPro' => $proActivate->id, 'total' => $sumaPActivate];
            }
        }else{
            $purProActiPau[] = ['idPro' => 0, 'total' => 0];
        }

        //dd($arrayTotalProjects);
        if($purProActiPau[0]['idPro'] != 0){
            foreach($allProjects as $allP){
                foreach($purProActiPau as $aTotalProjects){
                    if($aTotalProjects['idPro'] == $allP->id){
                        $red = 0;
                        $green = 0;
                        $yellow = 0; 
                        $gray = 0;
                        if($allP->start_date_project >= $startDate &&  $allP->start_date_project <= $endDate ){
                            $green = 1;
                        }
                        if($allP->end_date_project >= $startDate &&  $allP->end_date_project <= $endDate && $allP->status_fk == 2){
                            $red = 1;
                        }
                        if($allP->status_fk == 1){
                            $yellow = 1; 
                        }
                        if($allP->status_fk == 5){
                            $gray = 1; 
                        }
                        $allPurchases = Purchase::where('project_fk', $allP->id)
                                                ->get();
                        $totalPurchase = 0.00;
                        foreach($allPurchases as $allPur){
                            $totalPurchase += $allPur->amount; 
                        }
                        if($totalPurchase != 0){
                            $profit = $allP->sold_project - $totalPurchase;
                        }else{
                            $profit = 0;
                        }
                        $arrayProfit[] = ['name' => $allP->name_project, 'sold' => $allP->sold_project, 'expenses' => $aTotalProjects['total'] , 'profit'=> $profit ,
                        'green' => $green , 'red' => $red , 'yellow' => $yellow ,'gray' => $gray , 'totalExpenses' => $totalPurchase, 'budget' => $allP->budget_project];
                    }
                }
            }
        }else{
            $arrayProfit[] = ['name' => 0, 'sold' => 0, 'expenses' => 0 , 'profit'=> 0 ,'green' => 0 , 'red' => 0 , 'yellow' => 0 , 'gray' => 0 , 'totalCurrent'=> 0,
            'totalExpenses' => 0, 'budget'=> 0];
        }


        //Funcion para realizar la suma total de las ventas, gastos y beneficio
        $totalSold = 0.00;
        $totalSpent = 0.00;
        $totalExpensesActualy = 0.00;
        $totalProfit = 0.00;
        $totalBudget = 0.00;
        foreach($arrayProfit as $protArray){
            $totalSold += $protArray['sold'];
            $totalSpent += $protArray['expenses'];
            $totalExpensesActualy += $protArray['totalExpenses'];
            $totalProfit += $protArray['profit'];
            $totalBudget += $protArray['budget'];
        }
        $totalesProjects[] = ['totalSold' => $totalSold, 'totalSpent' => $totalSpent , 'totalProfit' => $totalProfit , 'totalExpensesActualy' => $totalExpensesActualy, 'budget' => $totalBudget];
        //dd($totalesProjects);
    }


    /******************************************************* TOTAL PAYROLL  ***************************************************/
    function getPurchases($date1, $date2,$id){
        $year = Carbon::parse($date1)->format('Y');
        $purchases = Purchase::whereYear('created_at', '=', $year)
                                ->whereBetween('date_purchase',[$date1, $date2])
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
        //$numOfWeek = count($fechasXsemana);
        //dd($fechasXsemana); 
        $laborCategories = PurchaseCategory::where('type_category','labor')->get();
        for($i = 0; $i <= $resta; $i++){

            foreach($laborCategories as $laCategori){
                $compras = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],$laCategori->id);
                $array[] = getData($compras);
            }
        }
        //dd($array); 
        $cantidadArray = count($array);
        //dd($cantidadArray);

        $allCategorie = PurchaseCategory::get();
        //dd($allCategorie);
        //Se obtiene los id de los proyectos donde hubieron trabajadores y las categorias
        $arrayIdProjects = [];
        $arryCategorie = [];
        for($i = 0; $i < $cantidadArray; $i++){
            foreach($array[$i] as $a){
                if( !in_array( $a['idProject'] ,$arrayIdProjects ) )
                {
                array_push($arrayIdProjects,$a['idProject']);
                }
                if( !in_array( $a['category'] ,$arryCategorie ) )
                {
                array_push($arryCategorie,$a['category']);
                }
            }
        }

        foreach($fechasXsemana as $fecha){
            foreach($arrayIdProjects as $idPro){
                $totalIdProject = 0;
                for ($i = 0; $i < $cantidadArray; $i++){
                    foreach($array[$i] as $a){
                        if($a['day'] >= $fecha['week_start']   && $a['day'] <= $fecha['week_end']){
                            if($a['idProject'] == $idPro){
                                $totalIdProject += $a['amount']; 
                            }
                        }
                    }
                }
                $totalXProjectSemana[] = ['fechaStart' => $fecha['week_start'] , 'fechaEnd' => $fecha['week_end'] , 'idPro' => $idPro , 'total' => $totalIdProject];
            }
        }
        //dd($totalXProjectSemana);
        
        foreach($fechasXsemana as $fecha){
            $totalxWeekPayroll = 0;
            for ($i = 0; $i < $cantidadArray; $i++){
                foreach($array[$i] as $a){
                    if($a['day'] >= $fecha['week_start']   && $a['day'] <= $fecha['week_end']){
                        $totalxWeekPayroll += $a['amount'];
                    }
                }
            }
            $totales[] = ['week' => $fecha['week'] , 'weekStart' => $fecha['week_start'] , 'weekEnd' => $fecha['week_end'] , 'total' => $totalxWeekPayroll ];
        }

        $totalPayroll = 0;
        foreach($totales as $t){
            $totalPayroll += $t['total'];
        }
         


    /******************************************************* TRUCKING SUMMARY *************************************************/

        // Mostrar los proyectos que tuvieron compras en la fecha consultada
        for($i = 0; $i <= $resta; $i++){
            /***************************************************************** */
            
            //Se realiza lo mismo para cada una de las categorias. 
            /* switch($i){
                case 0:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],4);
                    $comprasConcreteE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],19);
                    $comprasDirtE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],20);
                    $comprasMixedE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],21);
                    $comprasTrashE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],22);
                    $comprasAsphaltE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],39);
                    $comprasDirtRockE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],40);
                    $comprasTrash40CYE = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],41);
                    $comprasSandI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],23);
                    $comprasBaseI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],24);
                    $comprasGravelI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],25);
                    $comprasSoilI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],26);
                    $comprasDirtI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],42);
                    $comprasAsphaltI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],43);
                    $comprasAggregatesI = getPurchases($fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end'],14);

                    break;
                case $resta:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],4);
                    $comprasConcreteE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],19);
                    $comprasDirtE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],20);
                    $comprasMixedE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],21);
                    $comprasTrashE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],22);
                    $comprasAsphaltE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],39);
                    $comprasDirtRockE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],40);
                    $comprasTrash40CYE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],41);
                    $comprasSandI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],23);
                    $comprasBaseI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],24);
                    $comprasGravelI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],25);
                    $comprasSoilI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],26);
                    $comprasDirtI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],42);
                    $comprasAsphaltI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],43);
                    $comprasAggregatesI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery'],14);

                    break;
                default:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],4);
                    $comprasConcreteE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],19);
                    $comprasDirtE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],20);
                    $comprasMixedE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],21);
                    $comprasTrashE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],22);
                    $comprasAsphaltE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],39);
                    $comprasDirtRockE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],40);
                    $comprasTrash40CYE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],41);
                    $comprasSandI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],23);
                    $comprasBaseI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],24);
                    $comprasGravelI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],25);
                    $comprasSoilI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],26);
                    $comprasDirtI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],42);
                    $comprasAsphaltI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],43);
                    $comprasAggregatesI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],14);

            }  */

            $comprasMaterialE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],4);
            $comprasConcreteE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],19);
            $comprasDirtE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],20);
            $comprasMixedE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],21);
            $comprasTrashE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],22);
            $comprasAsphaltE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],39);
            $comprasDirtRockE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],40);
            $comprasTrash40CYE = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],41);
            $comprasSandI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],23);
            $comprasBaseI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],24);
            $comprasGravelI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],25);
            $comprasSoilI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],26);
            $comprasDirtI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],42);
            $comprasAsphaltI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],43);
            $comprasAggregatesI = getPurchases($fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end'],14);

            //Material Export --- 4
            //Cuento cuantas compras cumplen con los requisitos
            $nCMaterialE = count($comprasMaterialE);
            //Valido que la cantidad de compras sea distinta de cero, ya que se debe de crear una colección con datos.
            if($nCMaterialE != 0){
                foreach($comprasMaterialE as $compraMaterialE){
                    $C_MaterialE[] = ['projectFK' => $compraMaterialE->project_fk ,'compra' => $compraMaterialE->amount];
                }
            }else{
                //Si no hay compras se asigna un proyecto con el valor de -1 ya que no existe dicho proyecto, además ese valor se puede ocupar para futuras validaciones.
                $C_MaterialE[] = ['projectFK' => -1,'compra' => 0];
            }

            /********************************************************************************************************** */
            //Concret Export --- 19
            $nCConcreteE = count($comprasConcreteE);
            if($nCConcreteE != 0){
                foreach($comprasConcreteE as $compraConcreteE){
                    $C_ExportE[] = ['projectFK' => $compraConcreteE->project_fk ,'compra' => $compraConcreteE->amount];
                }
            }else{
                $C_ExportE[] = ['projectFK' => -1 ,'compra' => 0];
            }
            
            /*********************************************************************************************************** */
            //Dirt Export --- 20
            $nCDirtE = count($comprasDirtE);
            if($nCDirtE != 0){
                foreach($comprasDirtE as $compraDirtE){
                    $C_DirtE[] = ['projectFK' => $compraDirtE->project_fk ,'compra' => $compraDirtE->amount];
                }
            }else{
                $C_DirtE[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /*********************************************************************************************************** */
            //Mixed Export --- 21
            $nCMixedE = count($comprasMixedE);
            if($nCMixedE != 0){
                foreach($comprasMixedE as $compraMixedE){
                    $C_MixedE[] = ['projectFK' => $compraMixedE->project_fk ,'compra' => $compraMixedE->amount];
                }
            }else{
                $C_MixedE[] = ['projectFK' => -1 ,'compra' => 0];
            }
            
            /*********************************************************************************************************** */
            //Trash Export --- 22
            $nCTrashE = count($comprasTrashE);
            if($nCTrashE != 0){
                foreach($comprasTrashE as $compraTrashE){
                    $C_TrashE[] = ['projectFK' => $compraTrashE->project_fk ,'compra' => $compraTrashE->amount];
                }
            }
            else{
                $C_TrashE[] = ['projectFK' => -1 ,'compra' => 0];
            }
            /*********************************************************************************************************** */
            //Asphalt Export --- 39
            $nCAsphaltE = count($comprasAsphaltE);
            if($nCAsphaltE != 0){
                foreach($comprasAsphaltE as $compraAsphaltE){
                    $C_AsphaltE[] = ['projectFK' => $compraAsphaltE->project_fk ,'compra' => $compraAsphaltE->amount];
                }
            }
            else{
                $C_AsphaltE[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /*********************************************************************************************************** */
            //Dirt + Rock Export --- 40
            $nCDirtRockE = count($comprasDirtRockE);
            if($nCDirtRockE != 0){
                foreach($comprasDirtRockE as $compraDirtRockE){
                    $C_DirtRockE[] = ['projectFK' => $compraDirtRockE->project_fk ,'compra' => $compraDirtRockE->amount];
                }
            }
            else{
                $C_DirtRockE[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /*********************************************************************************************************** */
            //Trash40CY Export --- 41
            $nCTrash40CYE = count($comprasTrash40CYE);
            if($nCTrash40CYE != 0){
                foreach($comprasTrash40CYE as $compraTrash40CYE){
                    $C_Trash40CYE[] = ['projectFK' => $compraTrash40CYE->project_fk ,'compra' => $compraTrash40CYE->amount];
                }
            }
            else{
                $C_Trash40CYE[] = ['projectFK' => -1 ,'compra' => 0];
            }
            
            /*********************************************************************************************************** */
            //Sand Import --- 23
            $nCSandI = count($comprasSandI);
            if($nCSandI != 0){
                foreach($comprasSandI as $compraSandI){
                    $C_SandI[] = ['projectFK' => $compraSandI->project_fk ,'compra' => $compraSandI->amount];
                }
            }else{
                $C_SandI[] = ['projectFK' => -1 ,'compra' => 0];
            }
            
            /************************************************************************************************************ */
            //Base Import --- 24
            $nCBaseI = count($comprasBaseI);
            if($nCBaseI != 0){
                foreach($comprasBaseI as $compraBaseI){
                    $C_BaseI[] = ['projectFK' => $compraBaseI->project_fk ,'compra' => $compraBaseI->amount];
                }
            }else{
                $C_BaseI[] = ['projectFK' => -1 ,'compra' => 0];
            }
        
            /************************************************************************************************************ */
            //Gravel Import --- 25
            $nCGravelI = count($comprasGravelI);
            if($nCGravelI != 0){
                foreach($comprasGravelI as $compraGravelI){
                    $C_GravelI[] = ['projectFK' => $compraGravelI->project_fk ,'compra' => $compraGravelI->amount];
                }
            }else{
                $C_GravelI[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /************************************************************************************************************ */
            //Soil Import --- 26
            $nCSoilI = count($comprasSoilI);
            if($nCSoilI != 0){
                foreach($comprasSoilI as $compraSoilI){
                    $C_SoilI[] = ['projectFK' => $compraSoilI->project_fk ,'compra' => $compraSoilI->amount];
                }
            }else{
                $C_SoilI[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /************************************************************************************************************ */
            //Dirt Import --- 42
            $nCDirtI = count($comprasDirtI);
            if($nCDirtI != 0){
                foreach($comprasDirtI as $compraDirtI){
                    $C_DirtI[] = ['projectFK' => $compraDirtI->project_fk ,'compra' => $compraDirtI->amount];
                }
            }else{
                $C_DirtI[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /************************************************************************************************************ */
            //Asphalt Import --- 43
            $nCAsphaltI = count($comprasAsphaltI);
            if($nCAsphaltI != 0){
                foreach($comprasAsphaltI as $compraAsphaltI){
                    $C_AsphaltI[] = ['projectFK' => $compraAsphaltI->project_fk ,'compra' => $compraAsphaltI->amount];
                }
            }else{
                $C_AsphaltI[] = ['projectFK' => -1 ,'compra' => 0];
            }

            /************************************************************************************************************ */
            //Aggregates Import --- 14
            $nCAggregatesI = count($comprasAggregatesI);
            if($nCAggregatesI != 0){
                foreach($comprasAggregatesI as $compraAggregatesI){
                    $C_AggregatesI[] = ['projectFK' => $compraAggregatesI->project_fk ,'compra' => $compraAggregatesI->amount];
                }
            }else{
                $C_AggregatesI[] = ['projectFK' => -1 ,'compra' => 0];
            }
        }

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
            $totalCompraMaterialE = SumaxCategoria($project->id, $C_MaterialE); 
            $totalCompraExportE = SumaxCategoria($project->id, $C_ExportE);
            $totalCompraDirtE = SumaxCategoria($project->id, $C_DirtE);
            $totalCompraMixedE = SumaxCategoria($project->id, $C_MixedE);
            $totalCompraTrashE = SumaxCategoria($project->id, $C_TrashE);
            $totalCompraAsphaltE = SumaxCategoria($project->id, $C_AsphaltE);
            $totalCompraDirtRockE = SumaxCategoria($project->id, $C_DirtRockE);
            $totalCompraTrash40CYE = SumaxCategoria($project->id, $C_Trash40CYE);
            $totalCompraSandI = SumaxCategoria($project->id, $C_SandI);
            $totalCompraBaseI = SumaxCategoria($project->id, $C_BaseI);
            $totalCompraGravelI = SumaxCategoria($project->id, $C_GravelI);
            $totalCompraSoilI = SumaxCategoria($project->id, $C_SoilI);
            $totalCompraDirtI = SumaxCategoria($project->id, $C_DirtI);
            $totalCompraAsphaltI = SumaxCategoria($project->id, $C_AsphaltI);
            $totalCompraAggregatesI = SumaxCategoria($project->id, $C_AggregatesI);

            $totalAllCompras = $totalCompraMaterialE + $totalCompraExportE + $totalCompraDirtE + $totalCompraMixedE + $totalCompraTrashE + $totalCompraAsphaltE + $totalCompraDirtRockE + $totalCompraTrash40CYE
            + $totalCompraSandI + $totalCompraBaseI + $totalCompraGravelI + $totalCompraSoilI + $totalCompraDirtI + $totalCompraAsphaltI + $totalCompraAggregatesI; 

            $totalComprasTruck[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCMaterialE' => $totalCompraMaterialE , 'tCExportE' => $totalCompraExportE , 'tCDirtE' => $totalCompraDirtE,
            'tCMixedE' => $totalCompraMixedE, 'tCTrashE' => $totalCompraTrashE ,'tCAsphaltE' => $totalCompraAsphaltE,'tCDirtRockE'=>$totalCompraDirtRockE,'tCTrash40CYE'=>$totalCompraTrash40CYE ,
            'tCSandI' => $totalCompraSandI ,'tCBaseI' => $totalCompraBaseI , 'tCGravelI' => $totalCompraGravelI ,'tCSoilI' => $totalCompraSoilI ,'tCDirtI' => $totalCompraDirtI ,'tCAsphaltI' => $totalCompraAsphaltI,
            'tCAggregatesI' => $totalCompraAggregatesI ,'total' => $totalAllCompras];
        }

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


    /******************************************** OTHER EXPENSES ************************************************/
    for($i = 0; $i <= $resta; $i++){
        
        /* switch($i){
            case 0:
                $comprasToolsMaterial = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],1);
                $comprasSubcontractor = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],2);
                $comprasAggregates = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],3);
                $comprasHomedepot = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],7);
                $comprasMateria = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],8);
                $comprasRepairs = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],9);
                $comprasEquipmentRental = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],10);
                $comprasImportA = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],14);
                $comprasOffice = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],15);
                $comprasToolPurchase = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],16);
                $comprasToolRental = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],17);
                $comprasMiscellaneus = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],18);
                $comprasConcreteMix = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],44);
                $comprasPump = getPurchases($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],45);
                break;
            case $resta:
                $comprasToolsMaterial = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],1);
                $comprasSubcontractor = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],2);
                $comprasAggregates = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],3);
                $comprasHomedepot = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],7);
                $comprasMateria = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],8);
                $comprasRepairs = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],9);
                $comprasEquipmentRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],10);
                $comprasImportA = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],14);
                $comprasOffice = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],15);
                $comprasToolPurchase = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],16);
                $comprasToolRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],17);
                $comprasMiscellaneus = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],18);
                $comprasConcreteMix = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],44);
                $comprasPump = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],45);
                break;
            default:
                $comprasToolsMaterial = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],1);
                $comprasSubcontractor = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],2);
                $comprasAggregates = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],3);
                $comprasHomedepot = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],7);
                $comprasMateria = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],8);
                $comprasRepairs = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],9);
                $comprasEquipmentRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],10);
                $comprasImportA = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],14);
                $comprasOffice = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],15);
                $comprasToolPurchase = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],16);
                $comprasToolRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],17);
                $comprasMiscellaneus = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],18);
                $comprasConcreteMix = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],44); 
                $comprasPump = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],45);               
        } */

        $comprasToolsMaterial = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],1);
        $comprasSubcontractor = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],2);
        $comprasAggregates = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],3);
        $comprasHomedepot = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],7);
        $comprasMateria = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],8);
        $comprasRepairs = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],9);
        $comprasEquipmentRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],10);
        $comprasImportA = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],14);
        $comprasOffice = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],15);
        $comprasToolPurchase = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],16);
        $comprasToolRental = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],17);
        $comprasMiscellaneus = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],18);
        $comprasConcreteMix = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],44); 
        $comprasPump = getPurchases($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],45);

        // 1. Tools & Materials
        $nCToolsMa = count($comprasToolsMaterial);
        if($nCToolsMa != 0){
            foreach($comprasToolsMaterial as $compraToolMaterial){
                $C_ToolMaterial[] = ['projectFK' => $compraToolMaterial->project_fk ,'compra' => $compraToolMaterial->amount];
            }
        }else{
            $C_ToolMaterial[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 2. Subcontractor
        $nCSubcontractor = count($comprasSubcontractor);
        if($nCSubcontractor != 0){
            foreach($comprasSubcontractor as $compraSub){
                $C_Subcontractor[] = ['projectFK' => $compraSub->project_fk ,'compra' => $compraSub->amount];
            }
        }else{
            $C_Subcontractor[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 3. Aggregates Import
        $nCSAggregates = count($comprasAggregates);
        if($nCSAggregates != 0){
            foreach($comprasAggregates as $compraAggre){
                $C_Aggregate[] = ['projectFK' => $compraAggre->project_fk ,'compra' => $compraAggre->amount];
            }
        }else{
            $C_Aggregate[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 7. Homedepot
        $nCSHomedepot = count($comprasHomedepot);
        if($nCSHomedepot != 0){
            foreach($comprasHomedepot as $compraHome){
                $C_Home[] = ['projectFK' => $compraHome->project_fk ,'compra' => $compraHome->amount];
            }
        }else{
            $C_Home[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 8. Materials
        $nCSMa = count($comprasMateria);
        if($nCSMa != 0){
            foreach($comprasMateria as $compraMate){
                $C_Mate[] = ['projectFK' => $compraMate->project_fk ,'compra' => $compraMate->amount];
            }
        }else{
            $C_Mate[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 9. Repairs/Tow
        $nCSRepairs = count($comprasRepairs);
        if($nCSRepairs != 0){
            foreach($comprasRepairs as $compraRepair){
                $C_Repair[] = ['projectFK' => $compraRepair->project_fk ,'compra' => $compraRepair->amount];
            }
        }else{
            $C_Repair[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 10. Equipment Rental
        $nCSEquipment = count($comprasEquipmentRental);
        if($nCSEquipment != 0){
            foreach($comprasEquipmentRental as $compraEquipment){
                $C_Equipment[] = ['projectFK' => $compraEquipment->project_fk ,'compra' => $compraEquipment->amount];
            }
        }else{
            $C_Equipment[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 14. Import (Aggregates)
        $nCSImportA = count($comprasImportA);
        if($nCSImportA != 0){
            foreach($comprasImportA as $compraImportA){
                $C_ImportA[] = ['projectFK' => $compraImportA->project_fk ,'compra' => $compraImportA->amount];
            }
        }else{
            $C_ImportA[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 15. Office/Admin
        $nCSOffice = count($comprasOffice);
        if($nCSOffice != 0){
            foreach($comprasOffice as $compraOffice){
                $C_Office[] = ['projectFK' => $compraOffice->project_fk ,'compra' => $compraOffice->amount];
            }
        }else{
            $C_Office[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 16. Tool Purchase
        $nCSToolP = count($comprasToolPurchase);
        if($nCSToolP != 0){
            foreach($comprasToolPurchase as $compraToolPur){
                $C_ToolPurchase[] = ['projectFK' => $compraToolPur->project_fk ,'compra' => $compraToolPur->amount];
            }
        }else{
            $C_ToolPurchase[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 17. Tools Rental
        $nCSToolRental = count($comprasToolRental);
        if($nCSToolRental != 0){
            foreach($comprasToolRental as $compraToolRental){
                $C_ToolRental[] = ['projectFK' => $compraToolRental->project_fk ,'compra' => $compraToolRental->amount];
            }
        }else{
            $C_ToolRental[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 18. Miscellaneus
        $nCSMiscellaneus = count($comprasMiscellaneus);
        if($nCSMiscellaneus != 0){
            foreach($comprasMiscellaneus as $compraMisce){
                $C_Miscellaneus[] = ['projectFK' => $compraMisce->project_fk ,'compra' => $compraMisce->amount];
            }
        }else{
            $C_Miscellaneus[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 44. Concrete Mix
        $nCSConcreteMix = count($comprasConcreteMix);
        if($nCSConcreteMix != 0){
            foreach($comprasConcreteMix as $compraConMix){
                $C_ConcreteMix[] = ['projectFK' => $compraConMix->project_fk ,'compra' => $compraConMix->amount];
            }
        }else{
            $C_ConcreteMix[] = ['projectFK' => -1 ,'compra' => 0];
        }

        // 45. Pump
        $nCSPump = count($comprasPump);
        if($nCSPump != 0){
            foreach($comprasPump as $compraPump){
                $C_Pump[] = ['projectFK' => $compraPump->project_fk ,'compra' => $compraPump->amount];
            }
        }else{
            $C_Pump[] = ['projectFK' => -1 ,'compra' => 0];
        }

    }

    // 1. Tools & Materials
    // 2. Subcontractor
    // 3. Aggregates Import
    // 7. Homedepot
    // 8. Materials
    // 9. Repairs/Tow
    // 10. Equipment Rental
    // 14. Import (Aggregates)
    // 15. Office/Admin
    // 16. Tool Purchase
    // 17. Tools Rental
    // 18. Miscellaneus
    // 44. Concrete Mix
    // 45. Pump

    foreach($allProjects as $project){
        $totalCompraToolMa = SumaxCategoria($project->id, $C_ToolMaterial); 
        $totalCompraSubcontractor = SumaxCategoria($project->id, $C_Subcontractor);
        $totalCompraAggregates = SumaxCategoria($project->id, $C_Aggregate);
        $totalCompraHomedepot = SumaxCategoria($project->id, $C_Home);
        $totalCompraMaterials = SumaxCategoria($project->id, $C_Mate);
        $totalCompraRepairs = SumaxCategoria($project->id,$C_Repair);
        $totalCompraEquipmentRental = SumaxCategoria($project->id, $C_Equipment);
        $totalCompraImport = SumaxCategoria($project->id,$C_ImportA);
        $totalCompraOffice = SumaxCategoria($project->id, $C_Office);
        $totalCompraToolPurchase = SumaxCategoria($project->id,$C_ToolPurchase );
        $totalCompraToolRental = SumaxCategoria($project->id, $C_ToolRental);
        $totalCompraMiscellaneus = SumaxCategoria($project->id, $C_Miscellaneus);
        $totalCompraConcreteMix = SumaxCategoria($project->id, $C_ConcreteMix);
        $totalCompraPump = SumaxCategoria($project->id, $C_Pump);
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

/********************************************* RETURN ******************************************************/
    switch($flag){
        case 6:
            return view('Report/reportThisMonth',compact('startDate','endDate','nPStarts','nPFinished','nPActivates','nPNext','projectsStarts','projectsFinished','projectsActivates',
                                        'projectsNext','purProStarts','purProFinish','purProActivate','fechasXsemana','totalXWeek','totalXQuery','totalComprasTruck', 
                                        'totalCurrentTrucking','totakCurrentSpentxWeek','allProjects','arrayProfit','totalesProjects','compareDates','totalComprasOther','totalCurrentOther',
                                        'nPArchived','projectsArchiveds','cantidadArray','array','allCategorie','totales','totalPayroll','totalXProjectSemana','infoProFinish','totalesProjectsFinished',
                                        'nPPaused','projectsPaused','purProPaused','totalConcreteMix_pump','totalCurrentMixPump','totalSubcontractor','totalCurrentSubcontractor','arrayTotalExport','arrayTotalImport'));
        break;
        case 7:
            return view('Report/reportLastMonth',compact('startDate','endDate','nPStarts','nPFinished','nPActivates','nPNext','projectsStarts','projectsFinished','projectsActivates',
                                        'projectsNext','purProStarts','purProFinish','purProActivate','fechasXsemana','totalXWeek','totalXQuery','totalComprasTruck', 
                                        'totalCurrentTrucking','totakCurrentSpentxWeek','allProjects','arrayProfit','totalesProjects','compareDates','totalComprasOther','totalCurrentOther',
                                        'nPArchived','projectsArchiveds','cantidadArray','array','allCategorie','totales','totalPayroll','totalXProjectSemana','infoProFinish','totalesProjectsFinished',
                                        'nPPaused','projectsPaused','purProPaused','totalConcreteMix_pump','totalCurrentMixPump','totalSubcontractor','totalCurrentSubcontractor','arrayTotalExport','arrayTotalImport'));
        break;
    }   
}
}
