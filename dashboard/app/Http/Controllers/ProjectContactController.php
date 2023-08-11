<?php

namespace App\Http\Controllers;
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 

use App\ProjectContact;
use App\DailyReport;
use App\DailyTruck;
use App\DailyLabor;
use App\Project;
use App\ImageDailyReport;
use App\CommentProject;
use App\Phase;
use App\PurchaseCategory;
use App\Purchase;
use Twilio\Rest\Client;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Slack;
use Carbon\Carbon;

class ProjectContactController extends Controller
{

    
    public function index()
    {
        $projects = Project::where('status_fk',1)->get();
        $labors = PurchaseCategory::where('showDailyReport',1)->get();
        $user = Auth::user()->rol;
        //dd($projects); 
        return view('DailyReport.dailyReport',compact('projects','labors','user'));
    }

    public function postDaily(){
        //dd(request());
        $dailyReport = DailyReport::create([
            'projects_fk' => request('dailyProjectId'),
            'dateDailyReport' => request('dailyDate'),
            'statusDailyReport'=> 'incomplete',
            'erpStatus' => 'pending',
            'comments' => request('comments'),
            'projectPhase' => request('phaseId')
        ]);
        $dailyReport->save();

        $valorNull = 'null';
        //Daily Labor
        if (request()->amountLabor != 0){
            foreach(request()->amountLabor as $item=>$v){
                if(strcmp(request()->amountLabor[$item], $valorNull)!== 0){
                    $dataDailyLabor = DB::table('report_labor')->insert([
                        'dailyReport_fk' => $dailyReport->id,
                        'dailyLabor_fk' => request()->idLaborList[$item],
                        'amount' => request()->amountLabor[$item],
                        'comments' => request()->commentsLabor[$item],
                    ]);
                }
            }
        }

        //dd(request()->countTrucks);
        //Trucks
        if (request()->countTrucks != 0){
            $total = request()->countTrucks - 1;
            for($x = 0; $x <= $total; $x++){
                if(request()->quantityInfoCard[$x] == null){
                    $quantityTruck = 0;
                }else{
                    $quantityTruck = request()->quantityInfoCard[$x];
                }
                $dataDailyLabor = DB::table('report_truck')->insert([
                    
                    'quantityDailyTruck' => $quantityTruck,
                    'priceDailyTruck' => request()->priceInfoCard[$x],
                    'nameProviderTruck' => request()->providerInfoCard[$x],
                    'commentsDailyTruck' => request()->commentsInfoCard[$x],
                    'dailyTruck_fk' => request()->idTruckInfoCard[$x],
                    'dailyReport_fk' => $dailyReport->id
                ]);
            }
        }
        
        //dd($dataDailyLabor);
        
        /* foreach(request()->modalQuantity as $item=>$v){
            if(request()->modalQuantity[$item] != null){
                $dataDailyLabor = DB::table('report_truck')->insert([
                    'quantityDailyTruck' => request()->modalQuantity[$item],
                    'priceDailyTruck' => request()->modalPrice[$item],
                    'nameProviderTruck' => request()->modalProvider[$item],
                    'commentsDailyTruck' => request()->modalCommentTruck[$item],
                    'dailyTruck_fk' => $item + 1,
                    'dailyReport_fk' => $dailyReport->id
                ]);
            }
        } */

        //Extra Labor
        if(request()->nameLabor != null){
            foreach(request()->nameLabor as $item=>$v){
                if(request()->nameLabor[$item] != null){
                    $dataExtraLabor = DB::table('daily_more_reports')->insert([
                        'nameMoreReport' => request()->nameLabor[$item],
                        'amountMoreReport' => request()->paymentLabor[$item],
                        'typeMoreReport' => 'ExtraLabor',
                        'dailyReport_fk' => $dailyReport->id
                    ]);
                }
            }
        } 

        //Subcontractor
        if(request()->nameSub != null){
            foreach(request()->nameSub as $item=>$v){
                if(request()->nameSub[$item] != null){
                    $dataExtraLabor = DB::table('daily_more_reports')->insert([
                        'nameMoreReport' => request()->nameSub[$item],
                        'amountMoreReport' => request()->paymentSub[$item],
                        'descriptionMoreReport' => request()->descriptionSub[$item],
                        'typeMoreReport' => 'Subcontractor',
                        'dailyReport_fk' => $dailyReport->id
                    ]);
                }
            }
        }
        

        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->get();
        $reportLabor = DB::table('report_labor')->get();
        $reportExtraLabor = DB::table('daily_more_reports')
                            ->where('typeMoreReport','ExtraLabor')
                            ->where('dailyReport_fk', $dailyReport->id)
                            ->get();
        $reportSubcontratista = DB::table('daily_more_reports')
                            ->where('typeMoreReport','Subcontractor')
                            ->where('dailyReport_fk', $dailyReport->id)
                            ->get();
        $arrowLabor = "";
        $intLabor = 0;
        foreach ($reportLabor as $rtLabor){
            foreach ($allDailyLabor as $dailyLabor){
                if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id){
                    $arrowLabor .= $dailyLabor->nameDailyLabor .",";
                    $intLabor = 1;
                }
            }
        }

        $arrowTruck = "";
        $intTruck = 0;
        foreach ($reportTruck as $rtTruck){
            foreach ($allDailyTrucks as $dailyTrucks){
                if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id){
                    $arrowTruck .= $dailyTrucks->categoryTypeTruck ." / ";
                    $arrowTruck .= $dailyTrucks->nameTypeTruck ." / ";
                    $arrowTruck .= $rtTruck->quantityDailyTruck ." / ";
                    if($rtTruck->commentsDailyTruck != null){
                        $arrowTruck .= $rtTruck->commentsDailyTruck ." / ";
                        $arrowTruck .= "$".$rtTruck->priceDailyTruck ."\n";
                    }else{
                        $arrowTruck .= "$".$rtTruck->priceDailyTruck ."\n";
                    }
                    $intTruck = 1;
                }
            }
        }

        $extraLabor = "";
        $intExtraLabor = 0;
        foreach ($reportExtraLabor as $rExtraLabor){
            $extraLabor .= $rExtraLabor->nameMoreReport ." / ";
            $extraLabor .= "$".$rExtraLabor->amountMoreReport ."\n";
            $intExtraLabor = 1;
        }

        $subcontractor = "";
        $intSubcontractor = 0;
        foreach ($reportSubcontratista as $selectSubcontractor){
            $subcontractor .= $selectSubcontractor->nameMoreReport ." / ";
            $subcontractor .= $selectSubcontractor->descriptionMoreReport ." / ";
            $subcontractor .= "$".$selectSubcontractor->amountMoreReport ."\n";
            $intSubcontractor = 1;
        }

        $formatDate = Carbon::parse($dailyReport->dateDailyReport)->format('l jS, Y');
        //https://carbon.nesbot.com/docs/#api-constants 

        //dd($dailyReport);
        $message =  "Date: ".$formatDate."\n".
            "\n"."Project: ".$dailyReport->project->name_project."\n";

        if($intLabor != 0){
            $message .= "\n"."Labor: ".$arrowLabor."\n";
        }
        if($intExtraLabor != 0){
            $message .= "\n"."Extra Labor: ".$extraLabor;
        }
        if($intSubcontractor != 0){
            $message .= "\n"."Subcontractor: ".$subcontractor;
        }
        if($intTruck != 0){
            $message .= "\n"."Trucks: ".$arrowTruck;
        }
        $message .= "\n"."Comments: ".$dailyReport->comments;

        /* $message =  "Date: ".$formatDate."\n".
            "\n"."Project: ".$dailyReport->project->name_project."\n".
            "\n"."Labor: ".$arrowLabor."\n".
            "\n"."Extra Labor: ".$extraLabor.
            "\n"."Subcontractor: ".$subcontractor.
            "\n"."Trucks: ".$arrowTruck.
            "\n"."Comments: ".$dailyReport->comments; */
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14753234196';
        $marvinNumber = '13104099884';
        //$joselinNumber = '13109127546';

        \Slack::send($message);
        //\Slack::to('#project-comments')->send('Hi Testing!');

        //SMS TO MARVIN
        $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]);

        //SMS TO JOSELIN
        /* $smsToJoselin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToJoselin->messages->create($joselinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        $user_id = Auth::user()->id;
        $project = CommentProject::create([
            'commentProject' => request('comments'),
            'project_fk' => request('dailyProjectId'),
            'user_fk' => $user_id
        ]); 

        $flag = request('flagSubmit');
        if($flag == 0){
            return redirect()->back()->with('message','Report Sent');
        }else{
            return view('DailyReport.dropzoneImage',compact('dailyReport'));
        }
        
    }

    public function activeDailyReport()
    {
        $allDailyReports = DailyReport::where('erpStatus','pending')
                            ->orderByDesc('dateDailyReport')
                            ->get();
        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->get();
        $reportLabor = DB::table('report_labor')->get();
        /* dd($reportLabor[300]); */
        $reportExtralabor = DB::table('daily_more_reports')->where('typeMoreReport','ExtraLabor')->get();
        $reportSubcontractor = DB::table('daily_more_reports')->where('typeMoreReport','Subcontractor')->get();
        $images = DB::table('image_daily_reports')->get();
        $labors = PurchaseCategory::where('type_category','labor')->get();
        $phases = Phase::all();
        return view('DailyReport.listDailyReport',compact('allDailyReports','allDailyTrucks','allDailyLabor','reportTruck','reportLabor',
        'reportExtralabor','reportSubcontractor','images','labors','phases'));
    }

    public function statusDailyReport(DailyReport $dailyReport){
        $reportTruck = DB::table('report_truck')->where('dailyReport_fk',$dailyReport->id)->get();
        //dd($reportTruck);
        $reportLabor = DB::table('report_labor')->where('dailyReport_fk',$dailyReport->id)->get();
        $reportSubcontractor = DB::table('daily_more_reports')->where('typeMoreReport','Subcontractor')->where('dailyReport_fk',$dailyReport->id)->get();

        /* Purchases Labor */
        foreach($reportLabor as $rLabor){
            if($rLabor->comments == null){
                $comments = 'No comments';
            }else{
                $comments = $rLabor->comments;
            }

            if($rLabor->amount == null){
                $amountLabor = 0;
            }else{
                $amountLabor = $rLabor->amount;
            } 
            $purchase = Purchase::create([
                'project_fk'=> $dailyReport->projects_fk,
                'purchase_categorie_fk'=>$rLabor->dailyLabor_fk,
                'phase_fk'=> $dailyReport->projectPhase,
                'description_purchase'=> $comments,
                'amount'=> $amountLabor,
                'date_purchase'=> $dailyReport->dateDailyReport
            ]);
        }

        /* Purchases Subcontractor */
        foreach($reportSubcontractor as $reSubcontractor){
            if($reSubcontractor->descriptionMoreReport == null){
                $commentsSub = 'No comments';
            }else{
                $commentsSub = $reSubcontractor->descriptionMoreReport;
            }

            if($reSubcontractor->amountMoreReport == null){
                $amount = 0;
            }else{
                $amount = $reSubcontractor->amountMoreReport;
            }

            $comment = $reSubcontractor->nameMoreReport .' - '. $commentsSub .' $'.$amount;
            //dd($comment);
            $purchase = Purchase::create([
                'project_fk'=> $dailyReport->projects_fk,
                'purchase_categorie_fk'=>2,
                'phase_fk'=> $dailyReport->projectPhase,
                'description_purchase'=> $comment,
                'amount'=> $amount,
                'date_purchase'=> $dailyReport->dateDailyReport
            ]);
        }

        
        foreach($reportTruck as $rTruck){
            switch($rTruck->dailyTruck_fk){
                case 1:
                    //Dirt Import
                    $truckFK = 42;
                break;
                case 2:
                    //Dirt Export
                    $truckFK = 20;
                break;
                case 3:
                    //Concrete Export
                    $truckFK = 19;
                break;
                case 4:
                    //Mixed Export
                    $truckFK = 21;
                break;
                case 5:
                    //Trash Export
                    $truckFK = 22;
                break;
                case 6:
                    //Asphalt Export
                    $truckFK = 39;
                break;
                case 7:
                    //Dirt + Rock Export
                    $truckFK = 40;
                break;
                case 8:
                    //Demolition Debris
                    $truckFK = 22;
                break;
                case 9:
                    //Gravel Import
                    $truckFK = 25;
                break;
                case 10:
                    //Base Import
                    $truckFK = 24;
                break;
                case 11:
                    //DG
                    $truckFK = 26;
                break;
            }

            if($rTruck->priceDailyTruck != 0){
                $amount = $rTruck->priceDailyTruck;
            }else{
                $amount = 0;
            }

            if($rTruck->nameProviderTruck != ''){
                $nameProvider = $rTruck->nameProviderTruck;
            }else{
                $nameProvider = '';
            }

            if($rTruck->commentsDailyTruck != ''){
                $commentTruckValidate = $rTruck->commentsDailyTruck;
            }else{
                $commentTruckValidate = '';
            }

            $commentTruck = $nameProvider.' - '.$commentTruckValidate;
            //dd($commentTruck);
            $purchase = Purchase::create([
                'project_fk'=> $dailyReport->projects_fk,
                'purchase_categorie_fk'=>$truckFK,
                'phase_fk'=> $dailyReport->projectPhase,
                'description_purchase'=> $commentTruck,
                'amount'=> $amount,
                'date_purchase'=> $dailyReport->dateDailyReport
            ]);
        }
        
        $dailyReport->update([
            'erpStatus' => 'saved'
        ]);


        return redirect()->back(); 
    }

    public function allDailyReport()
    {
        $allDailyReports = DailyReport::orderByDesc('created_at')
                                        ->orderByDesc('dateDailyReport')
                                        ->take(40)                            
                                        ->get();
        //dd($allDailyReports);
        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->get();
        $reportLabor = DB::table('report_labor')->get();
        $reportExtralabor = DB::table('daily_more_reports')->where('typeMoreReport','ExtraLabor')->get();
        $reportSubcontractor = DB::table('daily_more_reports')->where('typeMoreReport','Subcontractor')->get();
        $labors = PurchaseCategory::where('type_category','labor')->get();
        $images = DB::table('image_daily_reports')->get();
        return view('DailyReport.allDailyReport',compact('allDailyReports','allDailyTrucks','allDailyLabor',
        'reportTruck','reportLabor','reportExtralabor','reportSubcontractor','images','labors'));
    }

    public function dropzoneDailyImage(Request $request, DailyReport $dailyReport){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = ImageDailyReport::create([
            'nameImageDailyReport' => $fileName,
            'dailyReport_fk' => $dailyReport->id
        ]);
        $fileR->move(public_path('imageDailyReport'),$fileName);
    }

    /** Esta funci��n actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function dropzoneFileDocumentDelete($name){
        ImageDailyReport::where('nameImageDailyReport',$name)->delete();
    }

    public function dropzoneFileDocumentDeleteMoreInfo($name){
        ImageDailyReport::where('nameImageDailyReport',$name)->delete();
        return redirect()->back(); 
    }

    public function editDailyReport(DailyReport $dailyReport)
    {
        //dd($dailyReport);
        $project = Project::where('id',$dailyReport->projects_fk)->first();
        $phases = $project->phases()->get();
        //dd($phases);
        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->where('dailyReport_fk',$dailyReport->id)->get();
        $reportLabor = DB::table('report_labor')->where('dailyReport_fk',$dailyReport->id)->get();
        //dd($reportLabor);
        $arrayLabors= [];
            foreach($reportLabor as $co){
                if(!in_array($co->dailyLabor_fk,$arrayLabors))
                {
                    array_push($arrayLabors,$co->dailyLabor_fk);
                }
            }
        foreach($reportLabor as $arrLabor){
            $labor = PurchaseCategory::where('id',$arrLabor->dailyLabor_fk)->first();
            $arrayLaborsData[] = ['id'=> $arrLabor->dailyLabor_fk, 'name' =>$labor->name_category, 'amount'=> $arrLabor->amount, 'comments'=>$arrLabor->comments];
        }
        $extraLabor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','ExtraLabor')->get();
        $subcontractor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','Subcontractor')->get();
        $labors = PurchaseCategory::where('showDailyReport',1)
                                    ->whereNotIn('id',$arrayLabors)
                                    ->get();
        //dd($labors);
        foreach($labors as $arrLabor){
            $labor = PurchaseCategory::where('id',$arrLabor->id)->first();
            $arrayLaborsData[] = ['id'=> $arrLabor->id, 'name' =>$labor->name_category , 'amount'=> 0, 'comments'=>null];
        }
        //dd($arrayLaborsData);
        return view('DailyReport.dailyReportEdit',compact('project','dailyReport','allDailyTrucks','allDailyLabor','reportTruck',
        'reportLabor','extraLabor','subcontractor','labors','phases','arrayLaborsData'));
    }

    public function updateDaily(DailyReport $dailyReport){
        //dd(request());
        $dailyReport->update([
            'projects_fk' => request('dailyProjectId'),
            'dateDailyReport' => request('dailyDate'),
            'statusDailyReport'=> 'incomplete',
            'erpStatus' => 'pending',
            'comments' => request('comments'),
            'projectPhase' => request('phaseId')
        ]);
        $dailyReport->save();

        $valorNull = "";
        //Daily Labor
        $reportLabor = DB::table('report_labor')->where('dailyReport_fk',$dailyReport->id)->get();
        foreach($reportLabor as $rLabor){
            DB::table('report_labor')->where('id', $rLabor->id)->delete();
        }
        
        foreach(request()->modalIdLabor as $item=>$v){
            if(strcmp(request()->modalIdLabor[$item], $valorNull)!== 0){
                $dataDailyLabor = DB::table('report_labor')->insert([
                    'dailyReport_fk' => $dailyReport->id,
                    'dailyLabor_fk' => request()->modalIdLabor[$item],
                    'amount' => request()->modalAmountLabor[$item],
                    'comments' => request()->modalCommentLabor[$item],
                ]);
            }
        }
        

        /* if(request()->dailyLabor != null){
            foreach(request()->dailyLabor as $item=>$v){
                if(strcmp(request()->dailyLabor[$item], $valorNull)!==0){
                    DB::table('report_labor')->insert([
                        'dailyReport_fk' => $dailyReport->id,
                        'dailyLabor_fk' => request()->dailyLabor[$item]
                    ]);
                }
            }
        } */

        //Trucks
        $reportTruck = DB::table('report_truck')->where('dailyReport_fk',$dailyReport->id)->get();
        foreach($reportTruck as $rTruck){
            DB::table('report_truck')->where('id', $rTruck->id)->delete();
        }
        foreach(request()->modalQuantity as $item=>$v){
            if(request()->modalQuantity[$item] != null){
                $dataDailyLabor = DB::table('report_truck')->insert([
                    'quantityDailyTruck' => request()->modalQuantity[$item],
                    'priceDailyTruck' => request()->modalPrice[$item],
                    'nameProviderTruck' => request()->modalProvider[$item],
                    'commentsDailyTruck' => request()->modalCommentTruck[$item],
                    'dailyTruck_fk' => $item + 1,
                    'dailyReport_fk' => $dailyReport->id
                ]);
            }
        }

        //Extra Labor
        $extraLabor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','ExtraLabor')->get();
        foreach($extraLabor as $eLabor){
            DB::table('daily_more_reports')->where('id', $eLabor->id)->delete();
        }
        if(request()->nameLabor != null){
            foreach(request()->nameLabor as $item=>$v){
                if(request()->nameLabor[$item] != null){
                    $dataExtraLabor = DB::table('daily_more_reports')->insert([
                        'nameMoreReport' => request()->nameLabor[$item],
                        'amountMoreReport' => request()->paymentLabor[$item],
                        'typeMoreReport' => 'ExtraLabor',
                        'dailyReport_fk' => $dailyReport->id
                    ]);
                }
            }
        } 

        //Subcontractor
        $subcontractor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','Subcontractor')->get();
        foreach($subcontractor as $scontractor){
            DB::table('daily_more_reports')->where('id', $scontractor->id)->delete();
        }
        if(request()->nameSub != null){
            foreach(request()->nameSub as $item=>$v){
                if(request()->nameSub[$item] != null){
                    $dataExtraLabor = DB::table('daily_more_reports')->insert([
                        'nameMoreReport' => request()->nameSub[$item],
                        'amountMoreReport' => request()->paymentSub[$item],
                        'descriptionMoreReport' => request()->descriptionSub[$item],
                        'typeMoreReport' => 'Subcontractor',
                        'dailyReport_fk' => $dailyReport->id
                    ]);
                }
            }
        }
        

        $allDailyTrucks = DailyTruck::all();
        $allDailyLabor = DailyLabor::all();
        $reportTruck = DB::table('report_truck')->get();
        $reportLabor = DB::table('report_labor')->get();
        $reportExtraLabor = DB::table('daily_more_reports')
                            ->where('typeMoreReport','ExtraLabor')
                            ->where('dailyReport_fk', $dailyReport->id)
                            ->get();
        $reportSubcontratista = DB::table('daily_more_reports')
                            ->where('typeMoreReport','Subcontractor')
                            ->where('dailyReport_fk', $dailyReport->id)
                            ->get();
        $arrowLabor = "";
        $intLabor = 0;
        foreach ($reportLabor as $rtLabor){
            foreach ($allDailyLabor as $dailyLabor){
                if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id){
                    $arrowLabor .= $dailyLabor->nameDailyLabor .",";
                    $intLabor = 1;
                }
            }
        }

        $arrowTruck = "";
        $intTruck = 0;
        foreach ($reportTruck as $rtTruck){
            foreach ($allDailyTrucks as $dailyTrucks){
                if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id){
                    $arrowTruck .= $dailyTrucks->categoryTypeTruck ." / ";
                    $arrowTruck .= $dailyTrucks->nameTypeTruck ." / ";
                    $arrowTruck .= $rtTruck->quantityDailyTruck ." / ";
                    if($rtTruck->commentsDailyTruck != null){
                        $arrowTruck .= $rtTruck->commentsDailyTruck ." / ";
                        $arrowTruck .= "$".$rtTruck->priceDailyTruck ."\n";
                    }else{
                        $arrowTruck .= "$".$rtTruck->priceDailyTruck ."\n";
                    }
                    $intTruck = 1;
                }
            }
        }

        $extraLabor = "";
        $intExtraLabor = 0;
        foreach ($reportExtraLabor as $rExtraLabor){
            $extraLabor .= $rExtraLabor->nameMoreReport ." / ";
            $extraLabor .= "$".$rExtraLabor->amountMoreReport ."\n";
            $intExtraLabor = 1;
        }

        $subcontractor = "";
        $intSubcontractor = 0;
        foreach ($reportSubcontratista as $selectSubcontractor){
            $subcontractor .= $selectSubcontractor->nameMoreReport ." / ";
            $subcontractor .= $selectSubcontractor->descriptionMoreReport ." / ";
            $subcontractor .= "$".$selectSubcontractor->amountMoreReport ."\n";
            $intSubcontractor = 1;
        }

        $formatDate = Carbon::parse($dailyReport->dateDailyReport)->format('l jS, Y');
        //https://carbon.nesbot.com/docs/#api-constants 

        $message = "Edited Report: \n". 
        "Date: ".$formatDate."\n".
            "\n"."Project: ".$dailyReport->project->name_project."\n";

        if($intLabor != 0){
            $message .= "\n"."Labor: ".$arrowLabor."\n";
        }
        if($intExtraLabor != 0){
            $message .= "\n"."Extra Labor: ".$extraLabor;
        }
        if($intSubcontractor != 0){
            $message .= "\n"."Subcontractor: ".$subcontractor;
        }
        if($intTruck != 0){
            $message .= "\n"."Trucks: ".$arrowTruck;
        }
        $message .= "\n"."Comments: ".$dailyReport->comments;

        /* $message =  "Date: ".$formatDate."\n".
            "\n"."Project: ".$dailyReport->project->name_project."\n".
            "\n"."Labor: ".$arrowLabor."\n".
            "\n"."Extra Labor: ".$extraLabor.
            "\n"."Subcontractor: ".$subcontractor.
            "\n"."Trucks: ".$arrowTruck.
            "\n"."Comments: ".$dailyReport->comments; */
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14753234196';
        $marvinNumber = '13104099884';
        //$joselinNumber = '13109127546';

        \Slack::send($message);
        //\Slack::to('#project-comments')->send('Hi Testing!');

        //SMS TO MARVIN
        $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]);

        //SMS TO JOSELIN
        /* $smsToJoselin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToJoselin->messages->create($joselinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */
        $flag = request('flagSubmit');
        if($flag == 0){
            return redirect()->back()->with('message','Report Sent');
        }else{
            return view('DailyReport.dropzoneImage',compact('dailyReport'));
        }
        
    }

    public function deleteDailyReport(DailyReport $dailyReport)
    {
        $reportLabor = DB::table('report_labor')->where('dailyReport_fk',$dailyReport->id)->get();
        foreach($reportLabor as $rLabor){
            DB::table('report_labor')->where('id', $rLabor->id)->delete();
        }
        $reportTruck = DB::table('report_truck')->where('dailyReport_fk',$dailyReport->id)->get();
        foreach($reportTruck as $rTruck){
            DB::table('report_truck')->where('id', $rTruck->id)->delete();
        }
        
        $extraLabor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','ExtraLabor')->get();
        foreach($extraLabor as $eLabor){
            DB::table('daily_more_reports')->where('id', $eLabor->id)->delete();
        }
        
        $subcontractor = DB::table('daily_more_reports')->where('dailyReport_fk',$dailyReport->id)->where('typeMoreReport','Subcontractor')->get();
        foreach($subcontractor as $scontractor){
            DB::table('daily_more_reports')->where('id', $scontractor->id)->delete();
        }

        $dailyReport->delete();

        return redirect()->back();
    }

    public function showPhasesList($idProject){
        //query es el dato que viene del template por medio del JS
        if($idProject != ''){
            $project = Project::find($idProject);
            $allPhases = $project->phases()->orderby('created_at','asc')->get();
            //dd($allPhases);
            $output = '';
            foreach($allPhases as $phase){
                $output  .='<div class="form-check">';
                $output  .='<input class="form-check-input-project" type="radio" name="phaseId" id="phaseProjects'.$phase->id.'" value="'.$phase->id.'" required>';
                    $output  .='<label class="form-check-label" for="phaseProjects'.$phase->id.'">
                    '. $phase->name_phase.'';
                $output  .=    '</label>
                </div>';
            }            
            echo $output;    
        }
    }

    public function showPhasesListEdit($idProject,$dailyReport){
        $dailyReport = DailyReport::where('id',$dailyReport)->get();
        //query es el dato que viene del template por medio del JS
        if($idProject != ''){
            $project = Project::find($idProject);
            $allPhases = $project->phases()->orderby('created_at','asc')->get();
            //dd($dailyReport);
            $output = '';
            foreach($allPhases as $phase){
                $output  .='<div class="form-check">';
                dd($dailyReport->projectPhase);
                if($phase->id == $dailyReport->projectPhase){
                    $output  .='<input class="form-check-input-project" type="radio" name="phaseId" id="phaseProjects'.$phase->id.'" value="'.$phase->id.'" required>';
                }else{
                    $output  .='<input class="form-check-input-project" type="radio" name="phaseId" id="phaseProjects'.$phase->id.'" value="'.$phase->id.'" required>';
                }
                    $output  .='<label class="form-check-label" for="phaseProjects'.$phase->id.'">'. $phase->name_phase.'';
                $output  .=    '</label>
                </div>';
            }            
            echo $output;    
        }
    }
}
