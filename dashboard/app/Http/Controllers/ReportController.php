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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sendDates()
    {
        return view('Report/dates');
    } 

    public function showReport()
    {
        //Se obtiene el rango de las fechas a consultar
        //Fomato de fechas : mes/dias/año
        //$startDate = Carbon::parse($sDate)->format('m/d/Y');
        //$endDate = Carbon::parse($eDate)->format('m/d/Y');
        //Se obtiene el rango de las fechas a consultar
        //Fomato de fechas : mes/dias/año
        $startDate = '04/01/2021';
        $endDate = '04/23/2021'; 
/****************************************** PRIMERA COLUMNA STARTED **************************************/

        //Se obtienen los proyectos que iniciaron en esa fecha sin importar su estado
        $projectsStarts = Project::whereBetween('start_date_project',[$startDate, $endDate])
                                    ->whereIn('status_fk',[1,2,3])
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
        $projectsFinished = Project::whereBetween('end_date_project',[$startDate, $endDate])
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
        $projectsActivates = Project::whereBetween('start_date_project',[$startDate, $endDate])
                                    ->where('status_fk',1)
                                    ->orderByDesc('start_date_project')
                                    ->get();
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
        $projectsNext = Project::whereBetween('start_date_project',[$newDateOneDayFormat, $newDateOneWeekFormat])
                                ->orderBy('start_date_project','asc')
                                ->get();
        $nPNext = $projectsNext->count();

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


        //Obtengo las fechas que contiene según el numero de semana del año
        for($i = (int) $semanainicio; $i <= $semanafin; $i++){
            $week_array = getStartAndEndDate($i,2021,$startDate,$endDate,$fijoInicio,$fijoFinal);
            $fechasXsemana[] = $week_array;
        } 
        /** La colleción $fechasXsemana[] contiene el número de la semana donde se hicieron las consultas de la fecha
         ** y en su arreglo contiene las fechas ingresadas */ 
        //dd($fechasXsemana);

/***************************************** TOTAL CURRENT SPENT X WEEK ****************************************/
        //Se realiza la resta de las semanas para saber cuantas hay entre ellas
        $resta = $semanafin - $semanainicio;
        $compareDates[] = ['first' => 0 , 'last' => $resta];
        //dd($resta);
        for($i = 0; $i <= $resta; $i++){   
            
             switch($i){
                case 0:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])->get();
                    break;
                case $resta:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])->get();
                    break;
                default:
                    //Consultas las compras que se encuentran en una semana específica
                    $comprasXWeek = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])->get();
            } 

            //$comprasXWeek = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])->get();

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
        //dd($comprasXWeek);
        //dd($totalXWeek);

        //Se realiza la suma de todas las compras de todas las semanas
        $totalXQuery = 0.00;
        foreach($totalXWeek as $tXWeek){
            $totalXQuery += $tXWeek['total'];
        }

        $longitud = sizeOf($projectXWeek);
        //dd($projectXWeek);
        if($projectXWeek[0]['project_FK'] != 0){
            foreach($allProjects as $projects){
                for($l = 0; $l < $longitud; $l++){
                    if( $projectXWeek[$l]['project_FK'] == $projects->id){
                        $prueba[] = ['project_FK' => $projectXWeek[$l]['project_FK'] ,'week' => $projectXWeek[$l]['week'], 'amount' => $projectXWeek[$l]['amount'] ];
                    }
                }
            }
        }else{
            $prueba[] = ['project_FK' => 0 ,'week' => 0, 'amount' => 0 ];
        }
        //dd($prueba);
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

/*     foreach($prueba as $p){
        $sumaT = 0.00;
        if($p['week'] == 0){
            $week0[] = $p;
        }
    }//dd($week0);
    foreach($week0 as $we){
        if($we['project_FK'] == 10){
            $another[] = $we; 
        }
    } //dd($another);
    $ty = 0.00;
    foreach($another as $anot){
        $ty += $anot['amount'];
    } */ 
/*********************************************** INFORMACION POR PROYECTO **************************************************/
        
        //Foreach para obtener el total de compras de un proyecto según las fechas ingresadas
        foreach($projects as $pro){
            $acumulador = 0.00;
            foreach($prueba as $prue){
                if($pro == $prue['project_FK'])
                    $acumulador += $prue['amount'];
            }
            $infoProjects[] = ['idProject' => $pro , 'total' => $acumulador];
        }
        //dd($infoProjects);

        //Foreach para obtener el profit de cada uno de los proyectos
        //La venta del proyecto menos lo gastado por las fechas ingresadas
        if( $infoProjects[0]['idProject'] != 0){
            foreach($allProjects as $all){
                foreach($projects as $pro){
                    if($all->id == $pro){
                        foreach($infoProjects as $info){
                            if($info['idProject'] == $pro){
                                $profit = $all->sold_project - $info['total'];
                                $profitArray[] = ['nameProject' => $all->name_project , 'soldProject' =>$all->sold_project, 'Spent' => $info['total'] ,'profit' => $profit];
                            }
                        }
                    }
                }
            }
        }else{
            $profitArray[] = ['nameProject' => 0 , 'soldProject' =>0, 'Spent' => 0 ,'profit' => 0];
        }


        //Funcion para realizar la suma total de las ventas, gastos y beneficio
        $totalSold = 0.00;
        $totalSpent = 0.00;
        $totalProfit = 0.00;
        foreach($profitArray as $protArray){
            $totalSold += $protArray['soldProject'];
            $totalSpent += $protArray['Spent'];
            $totalProfit += $protArray['profit'];
        }
        $totalesProjects[] = ['totalSold' => $totalSold, 'totalSpent' => $totalSpent , 'totalProfit' => $totalProfit];
        //dd($totalesProjects);

/******************************************************* TOTAL PAYROLL  ***************************************************/

        for($i = 0; $i <= $resta; $i++){
            switch($i){
                case 0:
                    $comprasOperator = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                                ->where('purchase_categorie_fk', 5)
                                                ->get(); 
                    $comprasLabor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                                ->where('purchase_categorie_fk',6)
                                                ->get();
                    break; 
                case $resta:
                    $comprasOperator = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                                ->where('purchase_categorie_fk', 5)
                                                ->get(); 
                    $comprasLabor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                                ->where('purchase_categorie_fk',6)
                                                ->get();
                    break;
                default:
                    $comprasOperator = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                                ->where('purchase_categorie_fk', 5)
                                                ->get(); 
                    $comprasLabor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                            ->where('purchase_categorie_fk',6)
                                            ->get();
            }
            /* $comprasOperator = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                    ->where('purchase_categorie_fk', 5)
                                    ->get(); 
            $comprasLabor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                    ->where('purchase_categorie_fk',6)
                                    ->get(); */

            $totalXWeekOperatorPayroll = 0.00;
            $totalXWeekLaborPayroll = 0.00;
            //dd($comprasOperator->count());
            if($comprasOperator->count() != 0){
                foreach($comprasOperator as $compraOperator){
                    $totalXWeekOperatorPayroll += $compraOperator->amount;
                    $projectsOperatorPayRoll[] = ['week'=> $i, 'project_FK' => $compraOperator->project_fk , 'amount' => $compraOperator->amount]; 
                }
            }else{
                $projectsOperatorPayRoll[] = ['week'=> 0, 'project_FK' => 0 , 'amount' => 0]; 
            }
            
            if($comprasLabor->count() != 0){
                foreach($comprasLabor as $compraLabor){
                    $totalXWeekLaborPayroll += $compraLabor->amount;
                    $projectsLaborPayRoll[] = ['week' => $i, 'project_FK' => $compraLabor->project_fk , 'amount' => $compraLabor->amount]; 
                }
            }else{
                $projectsLaborPayRoll[] = ['week' => 0, 'project_FK' => 0 , 'amount' => 0]; 
            }
            
            $arrayTotalOperator[] = ['week' => $fechasXsemana[$i]['week'] , 'total' => $totalXWeekOperatorPayroll];
            $arrayTotalLabor[] = ['week' => $fechasXsemana[$i]['week'] , 'total' => $totalXWeekLaborPayroll];
        }
        //dd($arrayTotalOperator);

        //Foreach para obtener los id de los proyectos que se encuentran en las compras
        //Operator PayRoll
        $pOperatorPayRoll = [];
        $weeks= [];
        foreach ($projectsOperatorPayRoll as $p){
            /*Initialize array with projects*/
            if( !in_array( $p['project_FK'] ,$pOperatorPayRoll ) )
            {
                array_push($pOperatorPayRoll,$p['project_FK']);
            }
        }

        for($semana = 0; $semana <= $resta; $semana++){
            $paso1 = weeks($projectsOperatorPayRoll,$semana);
            foreach($pOperatorPayRoll as $p){
                $paso2 = idProject($paso1,$p);
                $r = acumulador($paso2);
                $totalOperatorPayRollxWeek[] = ['week' =>  $fechasXsemana[$semana]['week'], 'Project' => $p, 'acumulador' => $r];
            }
        }

        //Labor Payroll
        $pLaborPayRoll = [];
        $weeks= [];
        foreach ($projectsLaborPayRoll as $p){
            /*Initialize array with projects*/
            if( !in_array( $p['project_FK'] ,$pLaborPayRoll ) )
            {
                array_push($pLaborPayRoll,$p['project_FK']);
            }
        }

        for($semana = 0; $semana <= $resta; $semana++){
            $paso1 = weeks($projectsLaborPayRoll,$semana);
            foreach($pLaborPayRoll as $p){
                $paso2 = idProject($paso1,$p);
                $r = acumulador($paso2);
                $totalLaborPayRollxWeek[] = ['week' =>  $fechasXsemana[$semana]['week'], 'Project' => $p, 'acumulador' => $r];
            }
        }

        $toOpPa =0.00;
        $toLaPa =0.00;
        foreach($totalOperatorPayRollxWeek as $totOperatorPayRollxWeek){
            $toOpPa += $totOperatorPayRollxWeek['acumulador'];
        }
        foreach($totalLaborPayRollxWeek as $totLaborPayRollxWeek){
            $toLaPa += $totLaborPayRollxWeek['acumulador'];
        }
        $totalOperatorLabor = $toOpPa + $toLaPa;

/******************************************************* TRUCKING SUMMARY *************************************************/

        // Mostrar los proyectos que tuvieron compras en la fecha consultada
        for($i = 0; $i <= $resta; $i++){
            /***************************************************************** */
            //Material Export --- 4
            //Se realiza lo mismo para cada una de las categorias. 
            switch($i){
                case 0:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                                ->where('purchase_categorie_fk',4)
                                                ->get();
                    break;
                case $resta:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                                ->where('purchase_categorie_fk',4)
                                                ->get();
                    break;
                default:
                    //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
                    $comprasMaterialE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                                ->where('purchase_categorie_fk',4)
                                                ->get();
            } 
            //Busco las compras que se realizaron en las fechas establecidas y también de acuerdo a su categoria.
            /* $comprasMaterialE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',4)
                                        ->get(); */

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
            switch($i){
                case 0:
                    $comprasConcreteE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',19)
                                        ->get();
                    break;
                case $resta:
                    $comprasConcreteE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',19)
                                        ->get();
                    break;
                default:
                    $comprasConcreteE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',19)
                                        ->get();
            } 
            /* $comprasConcreteE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',19)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasDirtE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',20)
                                        ->get();
                    break;
                case $resta:
                    $comprasDirtE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',20)
                                        ->get();
                    break;
                default:
                    $comprasDirtE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',20)
                                        ->get();
            }
            /* $comprasDirtE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',20)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasMixedE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',21)
                                        ->get();
                    break;
                case $resta:
                    $comprasMixedE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',21)
                                        ->get();
                    break;
                default:
                    $comprasMixedE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',21)
                                        ->get();
            }
            /* $comprasMixedE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',21)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasTrashE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',22)
                                        ->get();
                    break;
                case $resta:
                    $comprasTrashE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',22)
                                        ->get();
                    break;
                default:
                    $comprasTrashE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',22)
                                        ->get();
            }
            /* $comprasTrashE = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',22)
                                        ->get(); */
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
            //Sand Import --- 23
            switch($i){
                case 0:
                    $comprasSandI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',23)
                                        ->get();
                    break;
                case $resta:
                    $comprasSandI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',23)
                                        ->get();
                    break;
                default:
                    $comprasSandI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',23)
                                        ->get();
            }
            /* $comprasSandI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',23)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasBaseI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',24)
                                        ->get();
                    break;
                case $resta:
                    $comprasBaseI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',24)
                                        ->get();
                    break;
                default:
                    $comprasBaseI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',24)
                                        ->get();
            }
            /* $comprasBaseI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',24)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasGravelI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',25)
                                        ->get();
                    break;
                case $resta:
                    $comprasGravelI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',25)
                                        ->get();
                    break;
                default:
                    $comprasGravelI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',25)
                                        ->get();
            }
            /* $comprasGravelI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',25)
                                        ->get(); */
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
            switch($i){
                case 0:
                    $comprasSoilI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',26)
                                        ->get();
                    break;
                case $resta:
                    $comprasSoilI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                        ->where('purchase_categorie_fk',26)
                                        ->get();
                    break;
                default:
                    $comprasSoilI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',26)
                                        ->get();
            }
            /* $comprasSoilI = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                        ->where('purchase_categorie_fk',26)
                                        ->get() */;
            $nCSoilI = count($comprasSoilI);
            if($nCSoilI != 0){
                foreach($comprasSoilI as $compraSoilI){
                    $C_SoilI[] = ['projectFK' => $compraSoilI->project_fk ,'compra' => $compraSoilI->amount];
                }
            }else{
                $C_SoilI[] = ['projectFK' => -1 ,'compra' => 0];
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
            $totalCompraSandI = SumaxCategoria($project->id, $C_SandI);
            $totalCompraBaseI = SumaxCategoria($project->id, $C_BaseI);
            $totalCompraGravelI = SumaxCategoria($project->id, $C_GravelI);
            $totalCompraSoilI = SumaxCategoria($project->id, $C_SoilI);
            $totalAllCompras = $totalCompraMaterialE + $totalCompraExportE + $totalCompraDirtE + $totalCompraMixedE + $totalCompraTrashE 
            + $totalCompraSandI + $totalCompraBaseI + $totalCompraGravelI + $totalCompraSoilI; 

            $totalComprasTruck[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCMaterialE' => $totalCompraMaterialE , 'tCExportE' => $totalCompraExportE , 'tCDirtE' => $totalCompraDirtE,
            'tCMixedE' => $totalCompraMixedE, 'tCTrashE' => $totalCompraTrashE , 'tCSandI' => $totalCompraSandI ,'tCBaseI' => $totalCompraBaseI , 'tCGravelI' => $totalCompraGravelI ,
            'tCSoilI' => $totalCompraSoilI , 'total' => $totalAllCompras];
        }

        //Acumulador para la suma total de los camiones
        $totalCurrentTrucking= 0.00;
        foreach($totalComprasTruck as $totalCurrentSpentTrucking){
            $totalCurrentTrucking += $totalCurrentSpentTrucking['total'];
        }
/******************************************** OTHER EXPENSES ************************************************/
for($i = 0; $i <= $resta; $i++){
    // 1. Tools & Materials
    switch($i){
        case 0:
            $comprasToolsMaterial = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',1)
                                ->get();
            break;
        case $resta:
            $comprasToolsMaterial = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',1)
                                ->get();
            break;
        default:
            $comprasToolsMaterial = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',1)
                                ->get();
    }
    $nCToolsMa = count($comprasToolsMaterial);
    if($nCToolsMa != 0){
        foreach($comprasToolsMaterial as $compraToolMaterial){
            $C_ToolMaterial[] = ['projectFK' => $compraToolMaterial->project_fk ,'compra' => $compraToolMaterial->amount];
        }
    }else{
        $C_ToolMaterial[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 2. Subcontractor
    switch($i){
        case 0:
            $comprasSubcontractor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',2)
                                ->get();
            break;
        case $resta:
            $comprasSubcontractor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',2)
                                ->get();
            break;
        default:
            $comprasSubcontractor = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',2)
                                ->get();
    }
    $nCSubcontractor = count($comprasSubcontractor);
    if($nCSubcontractor != 0){
        foreach($comprasSubcontractor as $compraSub){
            $C_Subcontractor[] = ['projectFK' => $compraSub->project_fk ,'compra' => $compraSub->amount];
        }
    }else{
        $C_Subcontractor[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 3. Aggregates Import
    switch($i){
        case 0:
            $comprasAggregates = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',3)
                                ->get();
            break;
        case $resta:
            $comprasAggregates = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',3)
                                ->get();
            break;
        default:
            $comprasAggregates = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',3)
                                ->get();
    }
    $nCSAggregates = count($comprasAggregates);
    if($nCSAggregates != 0){
        foreach($comprasAggregates as $compraAggre){
            $C_Aggregate[] = ['projectFK' => $compraAggre->project_fk ,'compra' => $compraAggre->amount];
        }
    }else{
        $C_Aggregate[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 7. Homedepot
    switch($i){
        case 0:
            $comprasHomedepot = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',7)
                                ->get();
            break;
        case $resta:
            $comprasHomedepot = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',7)
                                ->get();
            break;
        default:
            $comprasHomedepot = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',7)
                                ->get();
    }
    $nCSHomedepot = count($comprasHomedepot);
    if($nCSHomedepot != 0){
        foreach($comprasHomedepot as $compraHome){
            $C_Home[] = ['projectFK' => $compraHome->project_fk ,'compra' => $compraHome->amount];
        }
    }else{
        $C_Home[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 8. Materials
    switch($i){
        case 0:
            $comprasMateria = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',8)
                                ->get();
            break;
        case $resta:
            $comprasMateria = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',8)
                                ->get();
            break;
        default:
            $comprasMateria = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',8)
                                ->get();
    }
    $nCSMa = count($comprasMateria);
    if($nCSMa != 0){
        foreach($comprasMateria as $compraMate){
            $C_Mate[] = ['projectFK' => $compraMate->project_fk ,'compra' => $compraMate->amount];
        }
    }else{
        $C_Mate[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 9. Repairs/Tow
    switch($i){
        case 0:
            $comprasRepairs = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',9)
                                ->get();
            break;
        case $resta:
            $comprasRepairs = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',9)
                                ->get();
            break;
        default:
            $comprasRepairs = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',9)
                                ->get();
    }
    $nCSRepairs = count($comprasRepairs);
    if($nCSRepairs != 0){
        foreach($comprasRepairs as $compraRepair){
            $C_Repair[] = ['projectFK' => $compraRepair->project_fk ,'compra' => $compraRepair->amount];
        }
    }else{
        $C_Repair[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 10. Equipment Rental
    switch($i){
        case 0:
            $comprasEquipmentRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',10)
                                ->get();
            break;
        case $resta:
            $comprasEquipmentRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',10)
                                ->get();
            break;
        default:
            $comprasEquipmentRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',10)
                                ->get();
    }
    $nCSEquipment = count($comprasEquipmentRental);
    if($nCSEquipment != 0){
        foreach($comprasEquipmentRental as $compraEquipment){
            $C_Equipment[] = ['projectFK' => $compraEquipment->project_fk ,'compra' => $compraEquipment->amount];
        }
    }else{
        $C_Equipment[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 14. Import (Aggregates)
    switch($i){
        case 0:
            $comprasImportA = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',14)
                                ->get();
            break;
        case $resta:
            $comprasImportA = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',14)
                                ->get();
            break;
        default:
            $comprasImportA = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',14)
                                ->get();
    }
    $nCSImportA = count($comprasImportA);
    if($nCSImportA != 0){
        foreach($comprasImportA as $compraImportA){
            $C_ImportA[] = ['projectFK' => $compraImportA->project_fk ,'compra' => $compraImportA->amount];
        }
    }else{
        $C_ImportA[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 15. Office/Admin
    switch($i){
        case 0:
            $comprasOffice = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',15)
                                ->get();
            break;
        case $resta:
            $comprasOffice = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',15)
                                ->get();
            break;
        default:
            $comprasOffice = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',15)
                                ->get();
    }
    $nCSOffice = count($comprasOffice);
    if($nCSOffice != 0){
        foreach($comprasOffice as $compraOffice){
            $C_Office[] = ['projectFK' => $compraOffice->project_fk ,'compra' => $compraOffice->amount];
        }
    }else{
        $C_Office[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 16. Tool Purchase
    switch($i){
        case 0:
            $comprasToolPurchase = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',16)
                                ->get();
            break;
        case $resta:
            $comprasToolPurchase = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',16)
                                ->get();
            break;
        default:
            $comprasToolPurchase = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',16)
                                ->get();
    }
    $nCSToolP = count($comprasToolPurchase);
    if($nCSToolP != 0){
        foreach($comprasToolPurchase as $compraToolPur){
            $C_ToolPurchase[] = ['projectFK' => $compraToolPur->project_fk ,'compra' => $compraToolPur->amount];
        }
    }else{
        $C_ToolPurchase[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 17. Tools Rental
    switch($i){
        case 0:
            $comprasToolRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',17)
                                ->get();
            break;
        case $resta:
            $comprasToolRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',17)
                                ->get();
            break;
        default:
            $comprasToolRental = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',17)
                                ->get();
    }
    $nCSToolRental = count($comprasToolRental);
    if($nCSToolRental != 0){
        foreach($comprasToolRental as $compraToolRental){
            $C_ToolRental[] = ['projectFK' => $compraToolRental->project_fk ,'compra' => $compraToolRental->amount];
        }
    }else{
        $C_ToolRental[] = ['projectFK' => -1 ,'compra' => 0];
    }

    // 18. Miscellaneus
    switch($i){
        case 0:
            $comprasMiscellaneus = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['startDateQuery'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',18)
                                ->get();
            break;
        case $resta:
            $comprasMiscellaneus = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['endDateQuery']])
                                ->where('purchase_categorie_fk',18)
                                ->get();
            break;
        default:
            $comprasMiscellaneus = Purchase::whereBetween('date_purchase',[$fechasXsemana[$i]['week_start'], $fechasXsemana[$i]['week_end']])
                                ->where('purchase_categorie_fk',18)
                                ->get();
    }
    $nCSMiscellaneus = count($comprasMiscellaneus);
    if($nCSMiscellaneus != 0){
        foreach($comprasMiscellaneus as $compraMisce){
            $C_Miscellaneus[] = ['projectFK' => $compraMisce->project_fk ,'compra' => $compraMisce->amount];
        }
    }else{
        $C_Miscellaneus[] = ['projectFK' => -1 ,'compra' => 0];
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
    $totalAllCompras = $totalCompraToolMa + $totalCompraSubcontractor + $totalCompraAggregates + $totalCompraHomedepot + $totalCompraMaterials 
    + $totalCompraRepairs + $totalCompraEquipmentRental + $totalCompraImport + $totalCompraOffice + $totalCompraToolPurchase + $totalCompraToolRental
    + $totalCompraMiscellaneus; 

    $totalComprasOther[] = ['IDProject' => $project->id, 'projectName' => $project->name_project, 'tCToolMa' => $totalCompraToolMa , 'tCSubcontra' => $totalCompraSubcontractor , 'tCAggre' => $totalCompraAggregates,
    'tCHome' => $totalCompraHomedepot, 'tCMateria' => $totalCompraMaterials , 'tCRepair' => $totalCompraRepairs ,'tCEquipmentRental' => $totalCompraEquipmentRental , 'tCImport' => $totalCompraImport ,
    'tCOffice' => $totalCompraOffice , 'tCToolPurchase' => $totalCompraToolPurchase , 'tCToolRental' => $totalCompraToolRental , 'tCMiscellaneus' => $totalCompraMiscellaneus , 'total' => $totalAllCompras];
}

//Acumulador para la suma total de los otras compras
$totalCurrentOther= 0.00;
foreach($totalComprasOther as $totalCurrentSpentOthe){
    $totalCurrentOther += $totalCurrentSpentOthe['total'];
}


/********************************************* RETURN ******************************************************/
        //realizar un if de acuerdo a la cantidad de dias seleccionado
        return view('Report/report',compact('startDate','endDate','nPStarts','nPFinished','nPActivates','nPNext','projectsStarts','projectsFinished','projectsActivates',
                                    'projectsNext','purProStarts','purProFinish','purProActivate','fechasXsemana','totalXWeek','totalXQuery','totalComprasTruck', 
                                    'totalCurrentTrucking','totakCurrentSpentxWeek','allProjects','arrayTotalOperator', 'arrayTotalLabor','totalOperatorPayRollxWeek',
                                    'totalLaborPayRollxWeek','totalOperatorLabor','profitArray','totalesProjects','compareDates','totalComprasOther','totalCurrentOther'));
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
