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
use App\PayrollDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;
use Carbon\Carbon;

class PayrollReportMonthController extends Controller
{
    public function payrollWeeks($sDate,$eDate,$flag){

        /* $stDate = Carbon::parse($sDate)->format('m/d/Y');
        $enDate = Carbon::parse($eDate)->format('m/d/Y'); */ 

        $stDate = Carbon::parse($sDate)->format('m/d/Y');
        $enDate = Carbon::parse($eDate)->format('m/d/Y');
        //Ingreso de fechas

        $startDate = $stDate;
        $endDate = $enDate;

        /* $startDate = "05/01/2021";
        $endDate = "05/01/2021"; */ 

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
        for($i = (int) $semanainicio; $i <= $semanafin; $i++){
            $week_array = getStartAndEndDate($i,2023,$startDate,$endDate,$fijoInicio,$fijoFinal);
            $fechasXsemana[] = $week_array;
        } 
        /** La colleción $fechasXsemana[] contiene el número de la semana donde se hicieron las consultas de la fecha
         ** y en su arreglo contiene las fechas ingresadas */ 
        //dd($fechasXsemana);

        function getPurchasesId($s,$e,$id){
            $year = Carbon::parse($s)->format('Y');

            $c = Purchase::whereYear('created_at', '=', $year)
                            ->whereBetween('date_purchase',[$s,$e])
                            ->where('purchase_categorie_fk',$id)
                            ->get();
            return $c; 
        }

        /** Función para obtener la información relavante
         * Se guarda en un array de acuerdo a la categoria solicitada
        */
        $data[] = [];
        function getDataPayroll($object){
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

        $numOfWeek = count($fechasXsemana)-1;

        $laborCategories = PurchaseCategory::where('type_category','labor')->get();

        for($i = 0; $i <= $numOfWeek; $i++){
            foreach ($laborCategories as $labCategori){
                switch($i){
                    case 0:
                        $payroll = getPurchasesId($fechasXsemana[$i]['startDateQuery'],$fechasXsemana[$i]['week_end'],$labCategori->id);                        
                    break;
                    case $numOfWeek:
                        $payroll = getPurchasesId($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['endDateQuery'],$labCategori->id);
                        
                    break; 
                    default:
                        $payroll = getPurchasesId($fechasXsemana[$i]['week_start'],$fechasXsemana[$i]['week_end'],$labCategori->id);
                }
                $array[] = getDataPayroll($payroll);
            }            
        }

        $cantidadArray = count($array);

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
        //dd($arrayIdProjects);
        foreach($fechasXsemana as $fecha){
            for($i = 0; $i < $cantidadArray; $i++){
                foreach($array[$i] as $a){
                    if($a['idProject'] != 0){
                        foreach($arrayIdProjects as $aIdPro){  

                        }
                    }  
                }
            }
        }
        
 
        //Totales x semana
        foreach($fechasXsemana as $fecha){
            $totalesxSemana = 0;
            for($i = 0; $i < $cantidadArray; $i++){
                foreach($array[$i] as $a){
                    if($a['day'] >= $fecha['week_start']   && $a['day'] <= $fecha['week_end'] )
                    $totalesxSemana += $a['amount'];
                }
            }
            $totales[] = ['week' => $fecha['week'] , 'weekStart' => $fecha['week_start'] , 'weekEnd' => $fecha['week_end'] , 'total' => $totalesxSemana ];
        }
        //dd($totales); 
        $total = 0; 
        foreach($totales as $t){
            $total += $t['total'];
        }
        //dd($total); 

        //Totales x trabajador
        foreach($arryCategorie as $category){
            $totalesCategory = 0;
            $workedDays = 0;
            for($i = 0; $i < $cantidadArray; $i++){
                foreach($array[$i] as $a){
                    if($a['category'] == $category){
                        $totalesCategory += $a['amount'];
                        $workedDays += 1;
                    }
                }
            }
            $totalCategory[] = ['category' => $category , 'total' => $totalesCategory, 'workedDays' => $workedDays];
        }
        //dd($totalCategory); 
        $allProjects = Project::get();
        $allCategorie = PurchaseCategory::get(); 

        switch($flag){
            case 6:
                return view('Payroll/payrollThisMonth',compact('startDate','endDate','allProjects',
                                                        'fechasXsemana','allCategorie','totalCategory',
                                                        'cantidadArray','total','arrayIdProjects','array','totales'));
            break;
            case 7:
                return view('Payroll/payrollLastMonth',compact('startDate','endDate','allProjects',
                                                        'fechasXsemana','allCategorie','totalCategory',
                                                        'cantidadArray','total','arrayIdProjects','array','totales'));
            break;
        }
    }
}