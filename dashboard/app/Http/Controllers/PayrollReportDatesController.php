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

class PayrollReportDatesController extends Controller
{
    public function payrollDates($sDate,$eDate,$flag){

        $stDate = Carbon::parse($sDate)->format('m/d/Y');
        $enDate = Carbon::parse($eDate)->format('m/d/Y');
        //Ingreso de fechas

        if($flag == 1){
            //Si es uno, es porque solo se consulta un día en específico
            $startDate = $stDate;
            $endDate = $stDate;
        }else{
            $startDate = $stDate;
            $endDate = $enDate;
        }
        

        //Las fechas de inicio y fin las paso el tipo de dato Carbon para poder realizar operaciones con ellas
        $diaInicio = Carbon::parse($startDate);
        $diaFin = Carbon::parse($endDate);
        //Obtengo la diferencia de dias entre las dos fechas ingresadas
        $diferenciaDias = $diaFin->diffInDays($diaInicio);
        //dd($diferenciaDias);

        //Obtengo los dias que contiene ese rango de fechas.
        if($diferenciaDias != 0){
            $dia = new Carbon($startDate);
            for($i = 0; $i < $diferenciaDias; $i++){
                if($i == 0){
                    $diasX[] = ['days' => $startDate];
                }
            $diasX[] = ['days' => $dia->addDays(1)->format('m/d/Y')];
            }
        }else{
            $diasX[] = ['days' => $startDate];
        }
         
        //dd($diasX);

        /***
         * Payrolls
         * 27 - Alberto
         * 28 - Manuel
         * 29 - Thomas
         * 30 - Jorge
         * 31 - Delfino
         * 32 - Gustavo
         * 33 - Angel
         * 34 - León
         * 35 - Julio
         */

        /** Función para obtener las compras de un trabajador
         *  se ingresa la fecha y el id de la categoria
         *  en este caso seria la persona.*/
        function getPurchasesId($s,$e,$id){
            $year = Carbon::parse($s)->format('Y');
            //dd($year);
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

        $allProjects = Project::get();
        $allCategorie = PurchaseCategory::get(); 
        //dd($allCategorie);

        /**Obtengo la lista para contar los días trabajados */
        $laborCategories = PurchaseCategory::where('type_category','labor')->get();
        foreach ($laborCategories as $labCategori){
            $payroll = getPurchasesId($startDate,$endDate,$labCategori->id);
            $array[] = getDataPayroll($payroll);
        }
        //dd($array); 
        $n = count($array);
        foreach($diasX as $dia){
            $totalxDia = 0;
            for($i = 0; $i < $n; $i++){
                foreach($array[$i] as $a){
                    if($a['day'] == $dia['days']){
                        $totalxDia += $a['amount'];
                    }
                }
            }
            $totales[] = ['dia' => $dia['days'] , 'total' => $totalxDia];
        }

        /** Total de pagos */
        $totalPayroll = 0;
        foreach($totales as $t){
            $totalPayroll += $t['total'];
        }

        //Se obtiene los id de los proyectos donde hubieron trabajadores y las categorias
        $arrayIdProjects = [];
        $arryCategorie = [];
        for($i = 0; $i < $n; $i++){
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

        //Total a pagar por trabajador
        foreach($arryCategorie as $idPro){
            $totalxTrabajador = 0;
            $workedDays = 0;
            for($i = 0; $i < $n; $i++){
                foreach($array[$i] as $a){
                    if($a['category'] == $idPro){
                        $totalxTrabajador += $a['amount']; 
                        $workedDays += 1;
                    }
                }
            }
            $montoCategori[] = ['categori' => $idPro, 'total' => $totalxTrabajador, 'workedDays' => $workedDays];
        } 
        //dd($montoCategori);

        switch($flag){
            case "1":
                return view('Payroll.payrollNow',compact('startDate','diasX','array','allCategorie','allProjects','n','totales','arrayIdProjects','totalPayroll','montoCategori'));
                break;
            case "2":
                return view('Payroll.payrollThisWeek1',compact('startDate','endDate','diasX','array','allCategorie',
                                                    'allProjects','n','totales','arrayIdProjects','totalPayroll','montoCategori'));
                break; 
            case "3":
                return view('Payroll.payrollLastWeek',compact('startDate','endDate','diasX','array','allCategorie',
                                                    'allProjects','n','totales','arrayIdProjects','totalPayroll','montoCategori'));
                break;
            case "4":
                return view('Payroll.payrollOneDay',compact('startDate','diasX','array','allCategorie',
                                                    'allProjects','n','totales','arrayIdProjects','totalPayroll','montoCategori','sDate'));
                break;
            case "5":
                return view('Payroll.payrollDays',compact('startDate','endDate','diasX','array','allCategorie',
                                                    'allProjects','n','totales','arrayIdProjects','totalPayroll','montoCategori','sDate','eDate'));
                break;
        }
    }

    public function showPayrollFiles(){
        return view('Payroll.payrollFiles');
    }

    /* public function postPayrollFiles(Request $request){
        $saveFiles = PayrollDocument::create([
            'namePayrollDocument' => 'test1',
            'startDateDocument' => $request->start_date,
            'endDateDocument' => $request->end_dateF,
        ]);
        $saveFiles->save();
        return response()->json(['status'=>"success"]);
    } */

    /* public function postPayrollImages(Request $request){
        return view('Payroll.payrollFiles');
    } */
}
