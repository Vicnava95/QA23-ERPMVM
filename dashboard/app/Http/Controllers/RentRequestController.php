<?php

namespace App\Http\Controllers;
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Renta;
use App\Clientweb;
use App\Machinery;
use App\RentalForm;
use Twilio\Rest\Client;
use Carbon\Carbon;
use DB;
use DateTime; 
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Else_;
use PDF;

class RentRequestController extends Controller
{
    public function index(){
        $machi= DB::table('machineries')->get();
        return View('DispachCenter.new_dispatch')->with('equip', $machi);
    }

    public function getClientRental($name){
        $data = DB::table('clientwebs')
            ->where('nameClient','LIKE',"%{$name}%")
            ->get();//obtenemos el data si cumple la restricción
        $output = '<ul id="listP" class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
            $output .= 
            '<li value="'.$row->id.' "onclick="getid('.$row->id.')">'.$row->nameClient.'</li>';
        }
        $output .= '</ul><br>';
        echo $output;    
    }

    public function infoClientRental($id){
        $data = Clientweb::find($id);
        echo $data;
    }

    public function store(Request $request){
        $full = ucwords(request('full_name'));
        $machinery = request('machinery');
        $address1= request('address_1');
        $address2 = request('address_2');
        $city=request('city');
        $address_rent= request('address_1');
        $start_date=date("Y-m-d",strtotime(request('start_date')));
        $time = strtotime('10/16/2003');  //SETEADO HASTA QUE SE TOQUE FRONT
        $cli_id=request('cli_id');
        $end_date=date("Y-m-d",strtotime(request('pick_up_date')));
        $start_time= '15:25:22' ;  //SETEADO HASTA QUE SE TOQUE FRONT
        $driver= 'Marvin';
        $rental_cost = request('rentalCost');
        $phone = request('phone');
        $email = request('email');
        $compa=request('compa');
        $like_valid=date("Y-m",strtotime(request('start_date')));
        $status=0;
        $pick_status=0;

        //Si el campo de las notas viene vacio se le agrega un comentario
        if (empty(request('note'))){
            $note='No notes';
        }else{
            $note = request('note'); 
        }

        //EL CLIENTE NO EXISTE Y SE AGREGA SU COMPAÑIA TAMBIEN
        if (empty($compa)){
            //SI LA COMPAÑIA NO SE PONE EN EL FORMULARIO QUE LA GUARDE COMO UN CAMPO NULO
            $id_fisrt_client = DB::table('clients')->insertGetId(["full_name"=>$full, 'client_address' => $address_rent, 'phone_num'=>$phone, 'email'=>$email]);
        }else{
            //SI LA COMPAÑIA YA ESTA EN LA BASE DE DATOS QUE SOLO BUSQUE Y SAQUE EL ID
            $compañia = DB::table('machineries')->where('name', '=', $compa)->exists();
            $id_fisrt_comp = DB::table('companies')->insertGetId(['company_name'=>$compa]);
            $id_fisrt_client = DB::table('clients')->insertGetId(["full_name"=>$full, 'client_address' => $address_rent, 'phone_num'=>$phone, 'email'=>$email, 'id_comp'=>$id_fisrt_comp]);
        }
        
        //----------------------------------------------------------------------------------------------------------------------------------------------------
        //Busqueda de maquinaria segun nombre
        $mach_id = DB::table('machineries')->select('id_machine')->where('name', '=', $machinery)->get();
        foreach ($mach_id as $post) {
            $maquina_id = $post;
        }
        //---------------------------------------------------------------------------------------------------------------
        //SI EL CLIENTE YA EXISTE
        $mach_id = DB::table('machineries')->select('id_machine')->where('name', '=', $machinery)->get();
        foreach ($mach_id as $post) {
            $maquina_id = $post->id_machine;
        }
        $user2 = DB::table('clients')->where('full_name', '=', $full)->get();
        foreach ($user2 as $us) {
            $user3 = $us->id_client;
        }
        $id_renta_first = DB::table('rentals')->insertGetId([
            "machine"=>$maquina_id, 
            "driver" => $driver, 
            'rental_cost'=>$rental_cost,
            'dispatch_date'=>$start_date,
            'pick_up_date'=>$end_date,
            'delivery_site'=>$address_rent,
            'client'=> $user3, 
            'delivery_note'=> $note, 
            'status_deliver'=>$status, 
            'status_pickup'=>$pick_status,
            'delivery'=>request('delivery'),
            'client_fk'=>request('idshowCustomer'),
            'paymentStatus' => 0
        ]); 
        Session::put('id_renta_first', $id_renta_first);

        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587822';

        $marvinNumber = '13104099884';
        $miguelNumber = '13104050904';
        $clientNumber = str_replace(array('+','(',')',' ','-'),'',$phone);
        $address = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$address_rent); 
        $machinery = Machinery::find($maquina_id);
        $machineryName = $machinery->name;
        $initialDay = Carbon::createFromFormat('Y-m-d', $start_date)->isoFormat('MMM Do YYYY');
        $finalDay = Carbon::createFromFormat('Y-m-d', $end_date)->isoFormat('MMM Do YYYY');
        $message = "\n Rental Confirmation: \nAddress: ".$address."\nEquipment: ".$machineryName."\nDate: ".$initialDay." - ".$finalDay."\nComments: ".$note;

        //SMS TO MARVIN
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO MIGUEL
        /* $smsToMiguel = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMiguel->messages->create($miguelNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        //SMS TO CLIENT
        /* $smsToClient = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToClient->messages->create($clientNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        return redirect()->action('Calendar_Controller@index');
        //return redirect()->action('Rental_Agreement_Controller@rental_customer_data');
    }

    public function paymentStatus(Request $request, $idRenta, $status){
        $renta = Renta::find($idRenta);
        switch($status){
            case 1:
                $renta->update([
                    'paymentStatus' => $status,
                    'paymentComments' => request('paymentCommentsModalPay') 
                ]);
                $renta->save();
            break;
            case 0:
                $renta->update([
                    'paymentStatus' => $status,
                    'paymentComments' => request('paymentCommentsModalPending') 
                ]);
                $renta->save(); 
            break;
        }
        //dd($renta); 
        return redirect()->back(); 
    }

    public function allRentals(){
        $allRentalsDB = Renta::all()
                        ->sortByDesc('dispatch_date');
        foreach($allRentalsDB as $rental){

            $myDateTimeOut = DateTime::createFromFormat('Y-m-d', $rental->dispatch_date);
            $dateOut = $myDateTimeOut->format('m/d/Y');

            $myDateTimeIn = DateTime::createFromFormat('Y-m-d', $rental->pick_up_date);
            $dateIn = $myDateTimeIn->format('m/d/Y');

            $customerName = $rental->clientes->full_name;
            $address = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$rental->delivery_site); 

            $diffDays = $myDateTimeOut->diff($myDateTimeIn);

            $paymentStatus = $rental->paymentStatus;
           
            if($paymentStatus != 0){
                $payment = 'Pay';
            }else{
                $payment = 'Pending';
            }
            
            $allRentals[]=['id' => $rental->id, 'dateOut' => $dateOut,  'dateIn' => $dateIn, 'customer' => $customerName,
                            'deliveryAddress' => $address, 'machinery' => $rental->machinery->model, 'diffDays' => $diffDays->days,
                            'priceDay' => $rental->machinery->price, 'delivery' => $rental->delivery, 'totalDelivery' => $rental->rental_cost,
                            'notes' => $rental->delivery_note, 'payStatus' => $payment, 'payComments'=> $rental->paymentComments];
        }
        //dd($allRentals); 
        return view('DispachCenter.allRentals',compact('allRentals'));
    }

    public function rentalClientForm(){
        $machinerys = Machinery::all();
        return view('DispachCenter.clientFormRental',compact('machinerys'));
    }

    public function showMachinery(){
        $machinerys = Machinery::all();
        return response(json_encode($machinerys),200)->header('Content-type','text/plain');
    }

    public function storeRentalForm(){
        
        $rentalForm = RentalForm::create([
            'nameFormRental' => request('nameClient'),
            'phoneFormRental' => request('phoneClient'),
            'deliveryAddressFormRental' => request('project_address'),
            'deliveryDateFormRental' => request('start_date'),
            'estimatedDateFormRental' => request('pick_up_date'),
            'deliveryNote' => request('deliveryNotes')
        ]);
        $rentalForm->save();

        $valorNull = "";
        $machinerys = array();
        //Machinerys
        if(count(request()->inputMachinerys) > 0){
            foreach(request()->inputMachinerys as $item=>$v){
                if(strcmp(request()->inputMachinerys[$item], $valorNull)!==0){
                    DB::table('rental_forms_machineri')->insert([
                        'rentalForm_fk' => $rentalForm->id,
                        'machinery_fk' => request()->inputMachinerys[$item]
                    ]);
                    array_push($machinerys,request()->inputMachinerys[$item]);
                }
                else{
                    DB::table('rental_forms_machineri')->insert([
                        'rentalForm_fk' => null,
                        'machinery_fk' => null
                    ]);
                }
            }
        }
        $ma = "";
        foreach($machinerys as $m){
            $ma = $ma.",".$m;
        }
        
        $message =  "\n"."Client: ".request('nameClient')." ".
                    "\n".request('phoneClient').
                    "\n"."Equipment: ".$ma.
                    "\n"."Job Site: ".request('project_address').
                    "\n"."Delivery Date: ".request('start_date').
                    "\n"."Estimated Return: ".request('pick_up_date').
                    "\n"."Notes: ".request('deliveryNotes');
        //$message = request('comments');
        
        $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
        $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
        $TWILIO_NUMBER='14752587010';
        $marvinNumber = '13104099884';

        //SMS TO MARVIN
        /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
        $smsToMarvin->messages->create($marvinNumber, [
            'from' => $TWILIO_NUMBER,
            'body' => $message
        ]); */

        $resultado = self::addToDispatch($rentalForm, $machinerys);

        return view('DispachCenter.thankYouRentals');
    }

    public function addToDispatch(RentalForm $rentalForm, $machinerys){

        if (empty($rentalForm->deliveryNote)){
            $note='No notes';
        }else{
            $note = $rentalForm->deliveryNote; 
        }

        $id_fisrt_client = DB::table('clients')->insertGetId(['full_name'=>$rentalForm->nameFormRental, 
                                                              'client_address' => $rentalForm->phoneFormRental, 
                                                              'phone_num'=>$rentalForm->deliveryAddressFormRental, 
                                                              'email'=>'null']);
        $driver= 'Marvin';
        $start_date=date("Y-m-d",strtotime($rentalForm->deliveryDateFormRental));
        $end_date=date("Y-m-d",strtotime($rentalForm->estimatedDateFormRental));
        $status=0;
        $pick_status=0;
        foreach($machinerys as $machinery){
            $machin = DB::table('machineries')->where('model', '=', $machinery)->get();
            $id_renta_first = DB::table('rentals')->insertGetId([
                "machine"=>$machin[0]->id_machine, 
                "driver" => $driver, 
                'rental_cost'=>$machin[0]->price,
                'dispatch_date'=>$start_date,
                'pick_up_date'=>$end_date,
                'delivery_site'=>$rentalForm->deliveryAddressFormRental,
                'client'=> $id_fisrt_client, 
                'delivery_note'=> $note, 
                'status_deliver'=>$status, 
                'status_pickup'=>$pick_status,
                'delivery'=>0,//
                'client_fk'=> NULL,
                'paymentStatus' => 0
            ]); 
            Session::put('id_renta_first', $id_renta_first);
        }                                                              
    }

    public function thankYouRental(){
        return view('DispachCenter.thankYouRentals');
    }

    public function showAllRentalForms(){
        $allRental = RentalForm::all();
        $allRentaMachinery = DB::table('rental_forms_machineri')->get();
        $machinerys = Machinery::all(); 
        return view('DispachCenter.showAllForms',compact('allRental','allRentaMachinery','machinerys'));
    }

    public function editRentalForm(RentalForm $rental){
        $machinerys = Machinery::all(); 
        $allRentaMachinery = DB::table('rental_forms_machineri')->get();
        return view('DispachCenter.editRentalForm',compact('rental','machinerys','allRentaMachinery'));
    }

    public function updateRentalForm(RentalForm $rental){
        $rental->update([
            'nameFormRental' => request('clientName'),
            'phoneFormRental' => request('clientPhone'),
            'deliveryAddressFormRental' => request('clientDeliveryAddress'),
            'deliveryDateFormRental' => request('clientDeliveryDate'),
            'estimatedDateFormRental' => request('clientEstimatedReturn'),
            'deliveryNote' => request('clientDeliveryNote')
        ]);

        $allRentaMachinery = DB::table('rental_forms_machineri')
        ->where('rentalForm_fk',$rental->id)
        ->get();

        if(!$allRentaMachinery->isEmpty()){
            foreach($allRentaMachinery as $rentaMachinery){
                DB::table('rental_forms_machineri')->delete($rentaMachinery->id);
            }
        }
        
        $valorNull = "";
        $machinerys = array();
        if(count(request()->inputMachinerys) > 0){
            foreach(request()->inputMachinerys as $item=>$v){
                if(strcmp(request()->inputMachinerys[$item], $valorNull)!==0){
                    DB::table('rental_forms_machineri')->insert([
                        'rentalForm_fk' => $rental->id,
                        'machinery_fk' => request()->inputMachinerys[$item]
                    ]);
                    array_push($machinerys,request()->inputMachinerys[$item]);
                }
                else{
                    DB::table('rental_forms_machineri')->insert([
                        'rentalForm_fk' => null,
                        'machinery_fk' => null
                    ]);
                }
            }
        }
        return redirect()->route('showAllRentalForms')->with('updateMessage','Rental form updated'); 
    }

    public function deleteRentalForm(RentalForm $rental){
        $allRentaMachinery = DB::table('rental_forms_machineri')
        ->where('rentalForm_fk',$rental->id)
        ->get();

        if(!$allRentaMachinery->isEmpty()){
            foreach($allRentaMachinery as $rentaMachinery){
                DB::table('rental_forms_machineri')->delete($rentaMachinery->id);
            }
        }
        $rental->delete(); 
        return redirect()->route('showAllRentalForms')->with('updateMessage','Rental form deleted');
    }

    public function showPDF(RentalForm $rental){
        $allRentaMachinery = DB::table('rental_forms_machineri')
        ->where('rentalForm_fk',$rental->id)
        ->get();
        $rentalAddress = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$rental->deliveryAddressFormRental);
        $data = compact('rental','rentalAddress','allRentaMachinery');

        $pdf = PDF::loadView('pdf.contractRentalForm',$data);
        return $pdf->stream();
    }

    public function recordingPickup(){
        $flag = 0; //
        $today = new Carbon();
        $currentDay = $today->format('m/d/Y');
        $nextDay = $today->add(1,'day')->format('m/d/Y');
        $rentalsPickUp = RentalForm::where('estimatedDateFormRental',$nextDay)->get();
        //dd($rentalsPickUp[0]->id);
        if(empty($rentalsPickUp)){
            $flag = 1;
        }

        if($flag == 0){
            //dd('mandar sms');
            $recordingsDay= DB::table('recording_pickup')
                            ->where('recordingDate',$currentDay)
                            ->get();
            //dd(count($recordingsDay));
            if(count($recordingsDay) == 0){
                $recordingsDay= DB::table('recording_pickup')->insert([
                    'recordingDate' => $currentDay
                ]);

                $address = str_replace(array(', CA, USA',', California, EE. UU.',', California, USA'),'',$rentalsPickUp[0]->deliveryAddressFormRental);
                $machineries = DB::table('rental_forms_machineri')->where('rentalForm_fk',$rentalsPickUp[0]->id)->get();
                $ma = "";
                //dd($machineries);
                foreach($machineries as $m){
                    $ma = $ma.",".$m->machinery_fk;
                }
                $message =  
                    "\n"."Pick up machine"." ".$ma." "." TOMORROW".
                    "\n"."Client: ".$rentalsPickUp[0]->nameFormRental." ".
                    "\n".$rentalsPickUp[0]->phoneFormRental.
                    "\n"."Address: ".$address;

                //dd($message);
                $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
                $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
                $TWILIO_NUMBER='14752587010';
                $marvinNumber = '13104099884';
                $joselinNumber = '13109127546';

                //SMS TO MARVIN
                /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
                $smsToMarvin->messages->create($marvinNumber, [
                    'from' => $TWILIO_NUMBER,
                    'body' => $message
                ]); */

                //SMS TO JOSELIN
                /* $smsToJoselin = new Client($TWILIO_SID,$TWILIO_TOKEN);
                $smsToJoselin->messages->create($joselinNumber, [
                    'from' => $TWILIO_NUMBER,
                    'body' => $message
                ]); */
            }
        }
    }
}
