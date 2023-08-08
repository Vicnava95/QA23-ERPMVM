<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Datetime;
use App\Purchase;
use App\Project;
use App\Service;
use Carbon\Carbon;

class ReportProjects extends Controller
{
    /** Recibe una variable llamada $flag con los siguientes posibles valores
     * 1: Día actual
     * 2: Mes actual
     * 3: Mes anterior
     * 4: Rango de fechas
     * De acuerdo al tipo de bandera, así es la información que se va a mostrar
    */
    public function report($flag){
        /**************************************** FORMATO DE FECHAS ***************************************/
        //dd($flag);
        $today = Carbon::today();
        $todayFormat = Carbon::parse($today)->format('m/d/Y');

        $firstDayThisMonth = $today->startOfMonth()->format('m/d/Y');
        $lastDayThisMonth = $today->endOfMonth()->format('m/d/Y');

        $firstDayLastMonth = Carbon::now()->startOfMonth()->subMonth()->format('m/d/Y');
        $lastDayLastMonth = Carbon::now()->startofMonth()->subMonth()->endOfMonth()->format('m/d/Y');

        $inputStartDay = request('startDate');
        $inputEndDay = request('endDate');

        /****************************** OBTENCIÓN DE LOS GASTOS EN UN RANGO DE FECHAS *******************/

        //Se ha creado una función para obtener los gastos en un rango de fechas
        function allPurchasesFunction($firstDate, $secondDate, $year, $flag){
            if($flag == 1){
                $allPurchases = Purchase::whereYear('created_at', '=', $year)
                                        ->where('date_purchase',$firstDate)
                                        ->get();
            }else{
                $allPurchases = Purchase::whereYear('created_at', '=', $year)
                                        ->whereBetween('date_purchase',[$firstDate,$secondDate])
                                        ->get();
            }
            return $allPurchases;
        }

        function allProjectsFinishedFunction($firstDate,$secondDate,$flag){
            if($flag == 1){
                $pFinished = Project::where('end_date_project',$firstDate)
                                        ->where('status_fk',2)
                                        ->get();
            }else{
                $pFinished = Project::whereBetween('end_date_project',[$firstDate,$secondDate])
                                        ->where('status_fk',2)
                                        ->get();
            }
            

            return $pFinished;
        }

        //De acuerdo a la $flag así son las fechas de los gastos a solicitar
        //De acuerdo a la $flag se obtienen los proyectos finalizados en el rango de fechas
        switch($flag){
            case(1):
                $year = Carbon::parse($today)->format('Y');
                $purchases = allPurchasesFunction($todayFormat,$todayFormat,$year,1);
                $projectFinished = allProjectsFinishedFunction($todayFormat,$todayFormat,1);
                break;

            case(2):
                $year = $today->startOfMonth()->format('Y');
                $purchases = allPurchasesFunction($firstDayThisMonth,$lastDayThisMonth,$year,2);
                $projectFinished = allProjectsFinishedFunction($firstDayThisMonth,$lastDayThisMonth,2);
                break;
                
            case(3):
                $year = Carbon::now()->startOfMonth()->subMonth()->format('Y');
                $purchases = allPurchasesFunction($firstDayLastMonth,$lastDayLastMonth,$year,3);
                $projectFinished = allProjectsFinishedFunction($firstDayLastMonth,$lastDayLastMonth,3);
                break;

            case(4):
                $year = Carbon::parse($inputStartDay)->format('Y');
                $purchases = allPurchasesFunction($inputStartDay,$inputEndDay,$year,4);
                $projectFinished = allProjectsFinishedFunction($inputStartDay,$inputEndDay,4);
                break;
        }

        //Obtengo el ID de los proyectos a los cuales se le han realizado un gasto
        $arrayProjectId = [];
        foreach($purchases as $purchase){
            if(preg_match("/$year$/",$purchase->date_purchase)){
                if( !in_array( $purchase->project_fk ,$arrayProjectId ) )
                {
                array_push($arrayProjectId,$purchase->project_fk);
                }
            }
        }

        /************************ CÓDIGO PARA MOSTRAR LA PRIMERA TABLA ACUMULATIVA ***************************************/
        //Declaro un array vacio para guardar la información de cada proyecto
        $projectInfo[] = ['projectId'=>0,'projectName'=>'Empty','projectStatus'=>0, 'trucking'=>0,'labor'=>0,'subcontractor'=>0,
        'workedDays'=>0,'equipRental'=>0,'materialTools'=>0,'toolsRental'=>0,'miscelaneous'=>0,'repairs'=>0,
        'others'=>0,'total'=>0];

        //Declaro un array vacio para guardar la información de los gastos por tipo de camion
        $trucksArray[] = ['agregatesIm' => 0, 'materialEx'=>0, 'concreteEx'=>0,'dirtEx'=>0,'mixedEx'=>0,'trashEx'=>0,'asphaltEx'=>0,
        'dirtRock'=>0,'trash40Ex'=>0,'sandIm'=>0,'baseIm'=>0,'gravelIm'=>0,'soilIm'=>0,'dirtIm'=>0,'asphaltIm'=>0];

        //Declaro un array vacio para guardar la información de los gastos por tipo de labor
        $laborArray[] = ['operator'=>0,'labor'=>0,'albertoZamora'=>0,'manuel'=>0,'thomas'=>0,'jorge'=>0,'delfino'=>0,'gustavo'=>0,
        'angel'=>0,'leon'=>0,'julio'=>0,'humberto'=>0,'efren'=>0,'juan'=>0,'javier'=>0,'emeregildo'=>0,'fernando'=>0,'armando'=>0,
        'manuelV'=>0,'chamba'=>0,'alberoMenjivar'=>0,'jairon'=>0,'rafael'=>0,'erick'=>0,'dario'=>0,'gilberto'=>0,'alfredoR'=>0,'temporary'=>0];

        foreach($arrayProjectId as $projectId){
            //Para cada uno de los proyectos de la lista, quiero conocer los siguientes totales 
            $totalPurchases = 0; $totalTrucks = 0; $totalLabor = 0; $totalSubcontractor = 0; $totalEquipRental = 0;
            $totalMaterialTools = 0; $totalToolsRental = 0; $totalMiscellaneous = 0; $totalRepairs = 0;
            $totalOthers = 0;

            /**TRUCKS TYPES */
            //Para cada uno de los proyectos de la lista, quiero conocer cuanto se gastó por cada tipo de camión
            $aggregatesImport = 0; $materialExport = 0; $concreteExport = 0; $dirtExport = 0; $mixedExport = 0;
            $trashExport = 0; $asphaltExport = 0; $dirtRock = 0; $trashExport40CY = 0; $sandImport = 0; $baseImport = 0;
            $gravelImport = 0; $soilImport = 0; $dirtImport = 0; $asphaltImport = 0;

            /**LABOR TYPES */
            $operator = 0; $labor = 0; $albertoZamora = 0; $manuel = 0; $thomas = 0; $jorge = 0; $delfino = 0;
            $gustavo = 0; $angel = 0; $leon = 0; $julio = 0; $humberto = 0; $efren = 0; $juan = 0; $javier = 0;
            $emeregildo = 0; $fernando = 0; $armando = 0; $manuelV = 0; $chamba = 0; $alberoMenjivar = 0; $jairon = 0; $rafael = 0;
            $erick = 0; $dario = 0; $gilberto = 0; $alfredoR = 0; $temporary = 0;

            //Variable para almacenar los días trabajados en un proyecto
            $arrayDateWorkeds = [];

            //Obtengo la información del proyecto
            $project = Project::find($projectId);
            foreach($purchases as $purchase){
                //Acá limito que solo sean del año consultado
                if(preg_match("/$year$/",$purchase->date_purchase)){
                    //Acá limito que los gastos sean solo del proyecto de la lista
                    if($projectId == $purchase->project_fk){
                        //Obtengo el total de lo gastado en un proyecto
                        $totalPurchases += $purchase->amount;

                        //Obtengo el tipo de gasto realizado al proyecto
                        $purCategorie = $purchase->purchase_categorie_fk;
    
                        //Trucks
                        if($purCategorie == 3 || $purCategorie == 4 || $purCategorie == 19 || $purCategorie == 20 || 
                        $purCategorie == 21 || $purCategorie == 22 || $purCategorie == 39 || $purCategorie == 40 || 
                        $purCategorie == 41 || $purCategorie == 23 || $purCategorie == 24 || $purCategorie == 25 ||
                        $purCategorie == 26 || $purCategorie == 42 || $purCategorie == 43 || $purCategorie == 14){
                            $totalTrucks += $purchase->amount;
                            switch($purCategorie){
                                case(3):
                                        $aggregatesImport += $purchase->amount;
                                    break;
                                case(4):
                                        $materialExport += $purchase->amount;
                                    break;
                                case(19):
                                        $concreteExport += $purchase->amount;
                                    break;
                                case(20):
                                        $dirtExport += $purchase->amount;
                                    break;
                                case(21):
                                        $mixedExport += $purchase->amount;
                                    break;
                                case(22):
                                        $trashExport += $purchase->amount;
                                    break;
                                case(39):
                                        $asphaltExport += $purchase->amount;
                                    break;
                                case(40):
                                        $dirtRock += $purchase->amount;
                                    break;
                                case(41):
                                        $trashExport40CY += $purchase->amount;
                                    break;
                                case(23):
                                        $sandImport += $purchase->amount;
                                    break;
                                case(24):
                                        $baseImport += $purchase->amount;
                                    break;
                                case(25):
                                        $gravelImport += $purchase->amount;
                                    break;
                                case(26):
                                        $soilImport += $purchase->amount;
                                    break;
                                case(42):
                                        $dirtImport += $purchase->amount;
                                    break;
                                case(43):
                                        $asphaltImport += $purchase->amount;
                                    break;
                                case(14):
                                        $aggregatesImport += $purchase->amount;
                                    break;
                            }
                        }
    
                        //Labor
                        if($purCategorie == 5 || $purCategorie == 6 || $purCategorie == 27 || $purCategorie == 28 || 
                        $purCategorie == 29 || $purCategorie == 30 || $purCategorie == 31 || $purCategorie == 32 || 
                        $purCategorie == 33 || $purCategorie == 34 || $purCategorie == 35 || $purCategorie == 36 ||
                        $purCategorie == 37 || $purCategorie == 38 || $purCategorie == 46 || $purCategorie == 47 || 
                        $purCategorie == 48 || $purCategorie == 49 || $purCategorie == 50 || $purCategorie == 51 || 
                        $purCategorie == 52 || $purCategorie == 53 || $purCategorie == 56 || $purCategorie == 57 || 
                        $purCategorie == 58 || $purCategorie == 59 || $purCategorie == 60 || $purCategorie == 61){
                            $totalLabor += $purchase->amount;
                            
                            if( !in_array( $purchase->date_purchase ,$arrayDateWorkeds ) )
                            {
                            array_push($arrayDateWorkeds,$purchase->date_purchase);
                            }
                            switch($purCategorie){
                                case(5):
                                    $operator += $purchase->amount;
                                break;
                                case(6):
                                    $labor += $purchase->amount;
                                break;
                                case(27):
                                    $albertoZamora += $purchase->amount;
                                break;
                                case(28):
                                    $manuel += $purchase->amount;
                                break;
                                case(29):
                                    $thomas += $purchase->amount;
                                break;
                                case(30):
                                    $jorge += $purchase->amount;
                                break;
                                case(31):
                                    $delfino += $purchase->amount;
                                break;
                                case(32):
                                    $gustavo += $purchase->amount;
                                break;
                                case(33):
                                    $angel += $purchase->amount;
                                break;
                                case(34):
                                    $leon += $purchase->amount;
                                break;
                                case(35):
                                    $julio += $purchase->amount;
                                break;
                                case(36):
                                    $humberto += $purchase->amount;
                                break;
                                case(37):
                                    $efren += $purchase->amount;
                                break;
                                case(38):
                                    $juan += $purchase->amount;
                                break;
                                case(46):
                                    $javier += $purchase->amount;
                                break;
                                case(47):
                                    $emeregildo += $purchase->amount;
                                break;
                                case(48):
                                    $fernando += $purchase->amount;
                                break;
                                case(49):
                                    $armando += $purchase->amount;
                                break;
                                case(50):
                                    $manuelV += $purchase->amount;
                                break;
                                case(51):
                                    $chamba += $purchase->amount;
                                break;
                                case(52):
                                    $alberoMenjivar += $purchase->amount;
                                break;
                                case(53):
                                    $jairon += $purchase->amount;
                                break;
                                case(56):
                                    $rafael += $purchase->amount;
                                break;
                                case(57):
                                    $erick += $purchase->amount;
                                break;
                                case(58):
                                    $dario += $purchase->amount;
                                break;
                                case(59):
                                    $gilberto += $purchase->amount;
                                break;
                                case(60):
                                    $alfredoR += $purchase->amount;
                                break;
                                case(61):
                                    $temporary += $purchase->amount;
                                break;
                            }
                            
                        }
    
                        //Subcontractor
                        if($purCategorie == 2){
                            $totalSubcontractor += $purchase->amount;
                        }
    
                        //Equip Rental
                        if($purCategorie == 10){
                            $totalEquipRental += $purchase->amount;
                        }
    
                        //Material Tools
                        if($purCategorie == 1 || $purCategorie == 8){
                            $totalMaterialTools += $purchase->amount;
                        }
    
                        //Tools Rental
                        if($purCategorie == 17){
                            $totalToolsRental += $purchase->amount;
                        }
    
                        //Miscelaneous
                        if($purCategorie == 18){
                            $totalMiscellaneous += $purchase->amount;
                        }
    
                        //Repairs
                        if($purCategorie == 9){
                            $totalRepairs += $purchase->amount;
                        }
    
                        //Others
                        if($purCategorie == 7 || $purCategorie == 15 || $purCategorie == 16 || $purCategorie == 44 || 
                        $purCategorie == 45){
                            $totalOthers += $purchase->amount;
                        }
                    }
                }
            }
            $projectInfo[] = ['projectId'=>$project->id,'projectName'=>$project->name_project,'projectStatus'=>$project->status_fk,'workedDays'=>count($arrayDateWorkeds),
            'trucking'=>$totalTrucks,'labor'=>$totalLabor,'subcontractor'=>$totalSubcontractor, 'equipRental'=>$totalEquipRental,
            'materialTools'=>$totalMaterialTools,'toolsRental'=>$totalToolsRental,'miscelaneous'=>$totalMiscellaneous,'repairs'=>$totalRepairs,
            'others'=>$totalOthers,'total'=> $totalPurchases];

            $trucksArray[] = ['agregatesIm' => $aggregatesImport, 'materialEx'=>$materialExport, 'concreteEx'=>$concreteExport,'dirtEx'=>$dirtExport,'mixedEx'=>$mixedExport,
            'trashEx'=>$trashExport,'asphaltEx'=>$asphaltExport,'dirtRock'=>$dirtRock,'trash40Ex'=>$trashExport40CY,'sandIm'=>$sandImport,'baseIm'=>$baseImport,
            'gravelIm'=>$gravelImport,'soilIm'=>$soilImport,'dirtIm'=>$dirtImport,'asphaltIm'=>$asphaltImport];

            $laborArray[] = ['operator'=>$operator,'labor'=>$labor,'albertoZamora'=>$albertoZamora,'manuel'=>$manuel,'thomas'=>$thomas,'jorge'=>$jorge,'delfino'=>$delfino,
            'gustavo'=>$gustavo,'angel'=>$angel,'leon'=>$leon,'julio'=>$julio,'humberto'=>$humberto,'efren'=>$efren,'juan'=>$juan,'javier'=>$javier,'emeregildo'=>$emeregildo,
            'fernando'=>$fernando,'armando'=>$armando,'manuelV'=>$manuelV,'chamba'=>$chamba,'alberoMenjivar'=>$alberoMenjivar,'jairon'=>$jairon, 'rafael'=>$rafael,'erick'=>$erick,
            'dario'=>$dario , 'gilberto'=>$gilberto, 'alfredoR'=>$alfredoR, 'temporary'=>$temporary];
        }

        //Se calcula el total gastado por cada una de las categorías
        $allTotalWorkedDays = 0; $allTotalTrucking = 0; $allTotalLabor = 0; $allTotalSubcontractor = 0; $allTotalEquipRental = 0;
        $allTotalMaterialTools = 0; $allTotalToolsRental = 0; $allTotalMiscelaneous = 0; $allTotalRepairs = 0; $allTotalOthers = 0;
        $allTotal = 0;
        foreach($projectInfo as $pInfo){
            $allTotalWorkedDays += $pInfo['workedDays'];
            $allTotalTrucking += $pInfo['trucking'];
            $allTotalLabor += $pInfo['labor'];
            $allTotalSubcontractor += $pInfo['subcontractor'];
            $allTotalEquipRental += $pInfo['equipRental'];
            $allTotalMaterialTools += $pInfo['materialTools'];
            $allTotalToolsRental += $pInfo['toolsRental'];
            $allTotalMiscelaneous += $pInfo['miscelaneous'];
            $allTotalRepairs += $pInfo['repairs'];
            $allTotalOthers += $pInfo['others'];
            $allTotal += $pInfo['total'];
        }

        //En un array guardo todos los totales ocupados por categoria, esto se muestra en el footer de la tabla
        $allTotalArray[] = ['tWorkedDays'=>$allTotalWorkedDays,'tTruck'=>$allTotalTrucking,'tLabor'=>$allTotalLabor,
        'tSubcontractor'=>$allTotalSubcontractor,'tEquipRental'=>$allTotalEquipRental,'tMaterialTools'=>$allTotalMaterialTools,
        'tToolsRental'=>$allTotalToolsRental,'tMiscelaneous'=>$allTotalMiscelaneous,'tRepairs'=>$allTotalRepairs,
        'tOthers'=>$allTotalOthers,'total'=>$allTotal];

        /******************* START - CHART CATEGORY Se crea un array para guardar la información de los gastos por categoría ******/
        if($allTotalArray[0]['total'] != 0){
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tTruck'],'label'=>'Truck', 'a'=>number_format((($allTotalArray[0]['tTruck']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tLabor'],'label'=>'Labor', 'a'=>number_format((($allTotalArray[0]['tLabor']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tSubcontractor'],'label'=>'Subcontractor', 'a'=>number_format((($allTotalArray[0]['tSubcontractor']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tEquipRental'],'label'=>'Eq. Rental', 'a'=>number_format((($allTotalArray[0]['tEquipRental']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tMaterialTools'],'label'=>'Materials & Tools', 'a'=>number_format((($allTotalArray[0]['tMaterialTools']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tToolsRental'],'label'=>'Tools Rental', 'a'=>number_format((($allTotalArray[0]['tToolsRental']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tMiscelaneous'],'label'=>'Misc', 'a'=>number_format((($allTotalArray[0]['tMiscelaneous']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tRepairs'],'label'=>'Repairs', 'a'=>number_format((($allTotalArray[0]['tRepairs']*100)/$allTotalArray[0]['total']),2)];
            $categoryPieChart[] = ['y'=>$allTotalArray[0]['tOthers'],'label'=>'Others', 'a'=>number_format((($allTotalArray[0]['tOthers']*100)/$allTotalArray[0]['total']),2)];
        }else{
            $categoryPieChart[] = ['y'=>0,'label'=>'Empty', 'a'=>0];
        }
        /******************* END - CHART CATEGORY Se crea un array para guardar la información de los gastos por categoría ******/

        /********************************************* START - TRUCKS TYPES TOTAL CHART *****************************************/
        $allAggregatesImport = 0; $allMaterialExport = 0; $allConcreteExport = 0; $allDirtExport = 0; $allMixedExport = 0;
        $allTrashExport = 0; $allAsphaltExport = 0; $allDirtRock = 0; $allTrashExport40CY = 0; $allSandImport = 0; $allBaseImport = 0;
        $allGravelImport = 0; $allSoilImport = 0; $allDirtImport = 0; $allAsphaltImport = 0;

        foreach($trucksArray as $trucksA){
            $allAggregatesImport += $trucksA['agregatesIm'];
            $allMaterialExport += $trucksA['materialEx'];
            $allConcreteExport += $trucksA['concreteEx'];
            $allDirtExport += $trucksA['dirtEx'];
            $allMixedExport += $trucksA['mixedEx'];
            $allTrashExport += $trucksA['trashEx'];
            $allAsphaltExport += $trucksA['asphaltEx'];
            $allDirtRock += $trucksA['dirtRock'];
            $allTrashExport40CY += $trucksA['trash40Ex'];
            $allSandImport += $trucksA['sandIm'];
            $allBaseImport += $trucksA['baseIm'];
            $allGravelImport += $trucksA['gravelIm'];
            $allSoilImport += $trucksA['soilIm'];
            $allDirtImport += $trucksA['dirtIm'];
            $allAsphaltImport += $trucksA['asphaltIm'];
        }

        if($allTotalArray[0]['tTruck'] != 0){
            if($allAggregatesImport != 0){$trucksPieChart[] = ['y'=>$allAggregatesImport,'label'=>'Aggregates Import', 'a'=>number_format((($allAggregatesImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allMaterialExport != 0){$trucksPieChart[] = ['y'=>$allMaterialExport,'label'=>'Material Export', 'a'=>number_format((($allMaterialExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allConcreteExport != 0){$trucksPieChart[] = ['y'=>$allConcreteExport,'label'=>'Concrete Export', 'a'=>number_format((($allConcreteExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allDirtExport != 0){$trucksPieChart[] = ['y'=>$allDirtExport,'label'=>'Dirt Export', 'a'=>number_format((($allDirtExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allMixedExport != 0){$trucksPieChart[] = ['y'=>$allMixedExport,'label'=>'Mixed Export', 'a'=>number_format((($allMixedExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allTrashExport != 0){$trucksPieChart[] = ['y'=>$allTrashExport,'label'=>'Trash Export', 'a'=>number_format((($allTrashExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allAsphaltExport != 0){$trucksPieChart[] = ['y'=>$allAsphaltExport,'label'=>'Asphalt Export', 'a'=>number_format((($allAsphaltExport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allDirtRock != 0){$trucksPieChart[] = ['y'=>$allDirtRock,'label'=>'Dirt + Rock', 'a'=>number_format((($allDirtRock*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allTrashExport40CY != 0){$trucksPieChart[] = ['y'=>$allTrashExport40CY,'label'=>'Trash Export 40CY', 'a'=>number_format((($allTrashExport40CY*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allSandImport != 0){$trucksPieChart[] = ['y'=>$allSandImport,'label'=>'Sand Import', 'a'=>number_format((($allSandImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allBaseImport != 0){$trucksPieChart[] = ['y'=>$allBaseImport,'label'=>'Base Import', 'a'=>number_format((($allBaseImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allGravelImport != 0){$trucksPieChart[] = ['y'=>$allGravelImport,'label'=>'Gravel Import', 'a'=>number_format((($allGravelImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allSoilImport != 0){$trucksPieChart[] = ['y'=>$allSoilImport,'label'=>'Soil Import', 'a'=>number_format((($allSoilImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allDirtImport != 0){$trucksPieChart[] = ['y'=>$allDirtImport,'label'=>'Dirt Import', 'a'=>number_format((($allDirtImport*100)/$allTotalArray[0]['tTruck']),2)];}
            if($allAsphaltImport != 0){$trucksPieChart[] = ['y'=>$allAsphaltImport,'label'=>'Asphalt Import', 'a'=>number_format((($allAsphaltImport*100)/$allTotalArray[0]['tTruck']),2)];}
        }else{
            $trucksPieChart[] = ['y'=>0,'label'=>'Empty', 'a'=>0];
        }
        /********************************************* END - TRUCKS TYPES TOTAL CHART *****************************************/

        /********************************************** START - lABOR TYPES TOTAL CHART  *************************************/
        $allOperator = 0; $allLabor = 0; $allAlbertoZamora = 0; $allManuel = 0; $allThomas = 0; $allJorge = 0; $allDelfino = 0;
        $allGustavo = 0; $allAngel = 0; $allLeon = 0; $allJulio = 0; $allHumberto = 0; $allEfren = 0; $allJuan = 0; $allJavier = 0;
        $allEmeregildo = 0; $allFernando = 0; $allArmando = 0; $allManuelV = 0; $allChamba = 0; $allAlberoMenjivar = 0; $allJairon = 0; $allRafael = 0;
        $allErick = 0; $allDario = 0; $allGilberto = 0; $allAlfredoR = 0; $allTemporary = 0;

        foreach($laborArray as $laborA){
            $allOperator += $laborA['operator'];
            $allLabor += $laborA['labor'];
            $allAlbertoZamora += $laborA['albertoZamora'];
            $allManuel += $laborA['manuel'];
            $allThomas += $laborA['thomas'];
            $allJorge += $laborA['jorge'];
            $allDelfino += $laborA['delfino'];
            $allGustavo += $laborA['gustavo'];
            $allAngel += $laborA['angel'];
            $allLeon += $laborA['leon'];
            $allJulio += $laborA['julio'];
            $allHumberto += $laborA['humberto'];
            $allEfren += $laborA['efren'];
            $allJuan += $laborA['juan'];
            $allJavier += $laborA['javier'];
            $allEmeregildo += $laborA['emeregildo'];
            $allFernando += $laborA['fernando'];
            $allArmando += $laborA['armando'];
            $allManuelV += $laborA['manuelV'];
            $allChamba += $laborA['chamba'];
            $allAlberoMenjivar += $laborA['alberoMenjivar'];
            $allJairon += $laborA['jairon'];
            $allRafael += $laborA['rafael'];
            $allErick += $laborA['erick'];
            $allDario += $laborA['dario'];
            $allGilberto += $laborA['gilberto'];
            $allAlfredoR += $laborA['alfredoR'];
            $allTemporary += $laborA['temporary'];
        }

        if($allTotalArray[0]['tLabor'] != 0){
            if($allOperator != 0){$laborsPieChart[] = ['y'=>$allOperator,'label'=>'Operator', 'a'=>number_format((($allOperator*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allLabor != 0){$laborsPieChart[] = ['y'=>$allLabor,'label'=>'Labor', 'a'=>number_format((($allLabor*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allAlbertoZamora != 0){$laborsPieChart[] = ['y'=>$allAlbertoZamora,'label'=>'Alberto Z', 'a'=>number_format((($allAlbertoZamora*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allManuel != 0){$laborsPieChart[] = ['y'=>$allManuel,'label'=>'Manuel', 'a'=>number_format((($allManuel*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allThomas != 0){$laborsPieChart[] = ['y'=>$allThomas,'label'=>'Thomas', 'a'=>number_format((($allThomas*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allJorge != 0){$laborsPieChart[] = ['y'=>$allJorge,'label'=>'Jorge', 'a'=>number_format((($allJorge*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allDelfino != 0){$laborsPieChart[] = ['y'=>$allDelfino,'label'=>'Delfino', 'a'=>number_format((($allDelfino*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allGustavo != 0){$laborsPieChart[] = ['y'=>$allGustavo,'label'=>'Gustavo', 'a'=>number_format((($allGustavo*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allAngel != 0){$laborsPieChart[] = ['y'=>$allAngel,'label'=>'Angel', 'a'=>number_format((($allAngel*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allLeon != 0){$laborsPieChart[] = ['y'=>$allLeon,'label'=>'Leon', 'a'=>number_format((($allLeon*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allJulio != 0){$laborsPieChart[] = ['y'=>$allJulio,'label'=>'Julio', 'a'=>number_format((($allJulio*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allHumberto != 0){$laborsPieChart[] = ['y'=>$allHumberto,'label'=>'Humberto', 'a'=>number_format((($allHumberto*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allEfren != 0){$laborsPieChart[] = ['y'=>$allEfren,'label'=>'Efren', 'a'=>number_format((($allEfren*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allJuan != 0){$laborsPieChart[] = ['y'=>$allJuan,'label'=>'Juan', 'a'=>number_format((($allJuan*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allJavier != 0){$laborsPieChart[] = ['y'=>$allJavier,'label'=>'Javier', 'a'=>number_format((($allJavier*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allEmeregildo != 0){$laborsPieChart[] = ['y'=>$allEmeregildo,'label'=>'Emeregildo', 'a'=>number_format((($allEmeregildo*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allFernando != 0){$laborsPieChart[] = ['y'=>$allFernando,'label'=>'Fernando', 'a'=>number_format((($allFernando*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allArmando != 0){$laborsPieChart[] = ['y'=>$allArmando,'label'=>'Armando', 'a'=>number_format((($allArmando*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allManuelV != 0){$laborsPieChart[] = ['y'=>$allManuelV,'label'=>'Manuel V', 'a'=>number_format((($allManuelV*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allChamba != 0){$laborsPieChart[] = ['y'=>$allChamba,'label'=>'Chamba', 'a'=>number_format((($allChamba*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allAlberoMenjivar != 0){$laborsPieChart[] = ['y'=>$allAlberoMenjivar,'label'=>'Alberto M', 'a'=>number_format((($allAlberoMenjivar*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allJairon != 0){$laborsPieChart[] = ['y'=>$allJairon,'label'=>'Jairo', 'a'=>number_format((($allJairon*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allRafael != 0){$laborsPieChart[] = ['y'=>$allRafael,'label'=>'Rafael', 'a'=>number_format((($allRafael*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allErick != 0){$laborsPieChart[] = ['y'=>$allErick,'label'=>'Erick', 'a'=>number_format((($allErick*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allDario != 0){$laborsPieChart[] = ['y'=>$allDario,'label'=>'Dario', 'a'=>number_format((($allDario*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allGilberto != 0){$laborsPieChart[] = ['y'=>$allGilberto,'label'=>'Gilberto', 'a'=>number_format((($allGilberto*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allAlfredoR != 0){$laborsPieChart[] = ['y'=>$allAlfredoR,'label'=>'Alfredo Rodriguez', 'a'=>number_format((($allAlfredoR*100)/$allTotalArray[0]['tLabor']),2)];}
            if($allTemporary != 0){$laborsPieChart[] = ['y'=>$allTemporary,'label'=>'Temporary Labor', 'a'=>number_format((($allTemporary*100)/$allTotalArray[0]['tLabor']),2)];}
        }else{
            $laborsPieChart[] = ['y'=>0,'label'=>'Empty', 'a'=>0];
        }
        /********************************************** END - lABOR TYPES TOTAL CHART  *************************************/

        /********************************************** START - FINISHED PROJECTS OVERVIEW  *************************************/

        $projectFinishedArray[] = ['projectId'=>0, 'projectName'=>'Empty', 'projectServices'=>0,'projectEndDate'=>0,
        'projectSold'=>0, 'projectBudget'=>0,'expenses'=>0,'current'=>0,'profit'=>0, 'days'=>0, 'profitXday'=>0];
                
        //Los proyectos terminados dentro de un rango de fechas, los obtengo de un switch que está al inicio
        foreach($projectFinished as $proFinished){
            if(preg_match("/$year$/",$proFinished->end_date_project)){
                //dd($proFinished->services);
                $totalPurchases = 0;
                $allPurchases = Purchase::where('project_fk',$proFinished->id)->get();
                $arrayProjectWorkedDays = [];
                foreach($allPurchases as $purchase){
                    $totalPurchases += $purchase->amount;
                    $proPurCategory = $purchase->purchase_categorie_fk;
                    if($proPurCategory == 5 || $proPurCategory == 6 || $proPurCategory == 27 || $proPurCategory == 28 || 
                        $proPurCategory == 29 || $proPurCategory == 30 || $proPurCategory == 31 || $proPurCategory == 32 || 
                        $proPurCategory == 33 || $proPurCategory == 34 || $proPurCategory == 35 || $proPurCategory == 36 ||
                        $proPurCategory == 37 || $proPurCategory == 38 || $proPurCategory == 46 || $proPurCategory == 47 || 
                        $proPurCategory == 48 || $proPurCategory == 49 || $proPurCategory == 50 || $proPurCategory == 51 || 
                        $proPurCategory == 52 || $proPurCategory == 53 || $proPurCategory == 56 || $proPurCategory == 57 || 
                        $proPurCategory == 58 || $proPurCategory == 59 || $proPurCategory == 60 || $proPurCategory == 61){
                            if( !in_array( $purchase->date_purchase ,$arrayProjectWorkedDays))
                            {
                                array_push($arrayProjectWorkedDays,$purchase->date_purchase);
                            }
                        }
                }

                $currentExpenses = 0;
                foreach($purchases as $purchase){
                    
                    if($proFinished->id == $purchase->project_fk){
                        $currentExpenses += $purchase->amount;
                    }
                }

                $profit = $proFinished->sold_project - $totalPurchases;
                if(count($arrayProjectWorkedDays) == 0){
                    $profitXday = 0;
                }else{
                    $profitXday = $profit / count($arrayProjectWorkedDays);
                }
                
                $projectFinishedArray[] = ['projectId'=>$proFinished->id, 'projectName'=>$proFinished->name_project, 'projectServices'=>$proFinished->services,
                'projectEndDate'=>$proFinished->end_date_project,'projectSold'=>$proFinished->sold_project, 'projectBudget'=>$proFinished->budget_project,
                'expenses'=>$totalPurchases,'current'=>$currentExpenses,'profit'=>$profit, 'days'=>count($arrayProjectWorkedDays), 'profitXday'=>$profitXday];
            }
        }

        $totalFinshedProjectBudget = 0;
        $totalFinshedProjectExpenses = 0;
        $totalFinshedProjectCurrent = 0;
        $totalFinshedProjectProfit = 0;
        foreach($projectFinishedArray as $pFinishedArray){
            $totalFinshedProjectBudget += $pFinishedArray['projectBudget'];
            $totalFinshedProjectExpenses += $pFinishedArray['expenses'];
            $totalFinshedProjectCurrent += $pFinishedArray['current'];
            $totalFinshedProjectProfit += $pFinishedArray['profit'];
            
            //dd($pFinishedArray);
        }

        $totalFinishedProjects[] = ['totalBudget'=>$totalFinshedProjectBudget, 'totalExpenses'=>$totalFinshedProjectExpenses,
        'totalCurrent'=>$totalFinshedProjectCurrent, 'totalProfit'=>$totalFinshedProjectProfit];
        /********************************************** END - FINISHED PROJECTS OVERVIEW  ***************************************/

        /************************************** START - BUDGET VS EXPENSES & PROFIT VS EXPENSES *********************************/

        //dd($projectFinishedArray);
        if(count($projectFinishedArray) > 1){
            foreach($projectFinishedArray as $pFinishedArray){
                if($pFinishedArray['projectId'] != 0){
                    $budgeProjectsChart[] = ['label'=>$pFinishedArray['projectName'],'y'=>(float)$pFinishedArray['projectBudget']];
                    $expensesProjectChart[] = ['label'=>$pFinishedArray['projectName'],'y'=>$pFinishedArray['expenses']];
                    $profitProjectChart[] = ['label'=>$pFinishedArray['projectName'],'y'=>$pFinishedArray['profit']];
                }
            }
        }else{
            $budgeProjectsChart[] = ['label'=>'Empty','y'=>0.0];
            $expensesProjectChart[] = ['label'=>'Empty','y'=>0.0];
            $profitProjectChart[] = ['label'=>'Empty','y'=>0.0];
        }

        //dd($budgeProjectsChart);
        /************************************** END - BUDGET VS EXPENSES & PROFIT VS EXPENSES *********************************/

        /************************************** START - REDITUACION POR SERVICIOS *********************************/
        $allProjects = Project::where('status_fk',2)->get();
        /* $allProjects = Project::all(); */
        $totalMargin = 0;
        
        foreach ($allProjects as $projectsService){
            
            $services = $projectsService->services()->get();
            $purchases = Purchase::where('project_fk',$projectsService->id)->get();
            $totalPurchase = 0;
            foreach($purchases as $purchase){
                $totalPurchase += $purchase->amount;
            }
            //dd($totalPurchase);
            $projectSold = (float)$projectsService->sold_project;
            $margin = 0;
            if($projectSold != 0){
                $margin = $projectSold - $totalPurchase;
                $totalMargin += $margin;
            }
            //$infoServiceProject[] = ['projectID'=>0, 'servicesId'=>0];
            if($totalPurchase != 0){
                foreach($services as $service){
                    $infoServiceProject[] = ['projectID'=>$projectsService->id, 'servicesId'=>$service->id, 'margin'=>$margin];
                }
            }
        }

        $arrayProjectService = [];
        $allServices = Service::all();
        foreach($allServices as $service){
            $totalService = 0;
            foreach($infoServiceProject as $iSerProject){
                if($iSerProject['servicesId'] == $service->id){
                    $totalService += $iSerProject['margin'];
                }
            }
            $percent = ($totalService * 100 ) / $totalMargin;
            $totalForService[] = ['percent'=>number_format($percent, 2, '.', ''),'serviceId'=>$service->id, 'serviceName'=>$service->name_service, 'total'=>number_format($totalService, 2, '.', ',')];
        }
        arsort($totalForService);
        //dd($totalForService);
        
        /************************************** END - REDITUACION POR SERVICIOS ***********************************/
        
        //dd($totalFinishedProjects);
        return view('Report.consolidado',compact('flag','todayFormat','firstDayThisMonth','lastDayThisMonth','firstDayLastMonth',
        'lastDayLastMonth','inputStartDay','inputEndDay','projectInfo','allTotalArray','categoryPieChart','trucksPieChart','laborsPieChart',
        'projectFinishedArray','totalFinishedProjects','budgeProjectsChart','expensesProjectChart','profitProjectChart','totalForService','totalMargin'));
    }
}
