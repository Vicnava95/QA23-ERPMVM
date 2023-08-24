<?php

namespace App\Http\Controllers;

use App\Clientweb;
use App\Service;
use App\ClientSource; 
use App\ContactProject;
use App\Project;
use App\Purchase;
use DateTime;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon; 
use App\Notifications\Comments;

class ClientwebController extends Controller
{

    public function index()
    {
        $clients = Clientweb::orderBy('id','desc')->get();
        $clientSource = ClientSource::all(); 
        foreach($clients as $client){
            $id = $client->id;
            $services = DB::table('clientweb_service')
                        ->where('clientweb_id',$id)
                        ->get();
            if($services->isEmpty()){

            }else{
                foreach ($services as $service){
                    $idLanding = $service->client_source_id;
                    $idService = $service->service_id;
                    $idTable = $service->id;
                    $dateCreated = Carbon::parse($service->creted_at)->format('m/d/Y');
                    $timeCreated = Carbon::parse($service->creted_at)->format('g:i A');  
                }
                $infoClient [] = ['idTable' => $idTable, 'idClient' => $id , 'idLanding' => $idLanding , 'idService' => $idService , 'dateCreate' => $dateCreated , 'timeCreate' => $timeCreated];
            }
            /** Obtengo el id de todas las personas que tienen un proyecto asignado */
            $allContacts = ContactProject::orderBy('created_at','desc')->get();
            $arrayContacts= [];
            foreach($allContacts as $co){
                if(!in_array($co->idClient,$arrayContacts))
                {
                    array_push($arrayContacts,$co->idClient);
                }
            }

            $contactProjects = ContactProject::where('idClient', $client->id)->get();
            foreach($contactProjects as $cProjects){
                $project = Project::find($cProjects->project_fk);
                if($project != null){
                    $purchases = Purchase::where('project_fk',$project->id)->get();
                    $amountPurchase = 0;
                    foreach($purchases as $purchase){
                        $amountPurchase += $purchase->amount;
                    }
                    if($amountPurchase == 0){
                        $profit = 0;
                    }else{
                        $profit = $project->sold_project - $amountPurchase;
                    }
                    
                    $deals[] = ['idClient' => $client->id, 'idProject' => $project->id, 'nameProject' => $project->name_project, 
                                'soldProject' => $project->sold_project, 'profitProject' => $profit, 'expense' =>$amountPurchase ]; 
                    $flag = 1;
                }else{
                    $deals[] = ['idClient' => $client->id, 'idProject' => 0, 'nameProject' => 0, 
                                'soldProject' => 0, 'profitProject' => 0, 'expense' => 0]; 
                    $flag = 0;
                }
                $haveProject [] = ['idClient' => $client->id, 'flag' => $flag];
            }
        } 
        return view('Clientsweb.showClientsWeb',compact('clients','clientSource','infoClient','deals','haveProject')); 
    }

    public function searchClientFromProject($name){
        $data = DB::table('clientwebs')
                ->where('nameClient','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
        $output = '<ul id="listC" class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
            $output .= 
            '<li onclick="getInfoClient('.$row->id.')" value='.$row->id.'>'.$row->nameClient.'</li>';
        }
        $output .= '</ul><br>';
        echo $output;  
    }

    public function searchClient($name){
        $clientSource = ClientSource::all();
        $data = DB::table('clientwebs')
                ->where('nameClient','LIKE',"%{$name}%")
                ->get();//obtenemos el data si cumple la restricción
        foreach($data as $client){
            $id = $client->id;
            $services = DB::table('clientweb_service')
                        ->where('clientweb_id',$id)
                        ->get();
            if($services->isEmpty()){

            }else{
                foreach ($services as $service){
                    $idLanding = $service->client_source_id;
                    $idService = $service->service_id;
                    $idTable = $service->id;
                    $dateCreated = $service->creted_at;   
                }
                $infoClient [] = ['idTable' => $idTable, 'idClient' => $id , 'idLanding' => $idLanding , 'idService' => $idService , 'dateCreate' => $dateCreated];
            }
        } 
        $source = ClientSource::find($idLanding);

        $output = '<div>';
        foreach($data as $d){
            $output .= 
            '<div href="#" class="list-group-item list-group-item-action flex-column align-items-start" data-toggle="collapse" data-target="#collapse1'.$d->id.'" aria-expanded="false" aria-controls="collapse'.$d->id.'" onclick="showSourceClient('.$d->id.')">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">'.$d->nameClient.'</h5>
                    <a class="mb-1 text-left noprop" href="tel:'.$d->phoneClient.'" target="_blank">'.$d->phoneClient.'</a>
                    
                </div>
                <div class="d-flex w-100 justify-content-between">
                <a class="mb-1 text-left noprop" href="mailto:'.$d->emailClient.'" target="_blank">'.$d->emailClient.'</a>
                </div>
                <div class="d-flex w-100 justify-content-between">';
                foreach($infoClient as $info){
                    if($info['idClient'] == $d->id){
                        foreach($clientSource as $clSource){
                            if($info['idLanding'] == $clSource->id){
                                $output .= '<p class="mb-1 text-left">'.$clSource->nameClientSource.'</p>';
                            }
                        }
                    }
                }
            $output .='</div>
                <div class="d-flex w-100 justify-content-between">
                <a class="mb-1 text-left noprop" href="http://maps.apple.com/?q='.$d->addressClient.'">'.$d->addressClient.'</a>
                </div>

                <div class="d-flex w-100 justify-content-between">';
                foreach($infoClient as $info){
                    if($info['idClient'] == $d->id){
                        $output .= '<p class="mb-1 text-left">'.$info['dateCreate'].'</p>';
                    }
                }
            $output .='</div>
                <div id="collapse1'.$d->id.'" class="collapse" aria-labelledby="heading'.$d->id.'" data-parent="#accordion">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Client Source</th>
                                <th scope="col">Service</th>
                                <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody class="showData">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>';
        }
        $output .= '</div>
                    <script>
                        $(".noprop").click(function(event) {
                        event.stopPropagation();
                        });
                    </script>';
        echo $output;  
    }

    public function create()
    {
        $services = Service::whereIn('id',[2,6,19,10,11,12,13,14,15,16,17,18])->get();
        $clientSource = ClientSource::all();
        return view('Clientsweb.createClientsWeb',compact('services','clientSource'));
    }

    public function storeERP(){ 
        $clients = Clientweb::all();
        $emailForm = request('emailClient'); 
        $validator = Clientweb::where('emailClient',$emailForm)->get();
        $nameForm = request('nameClient'); 
        $convertedName = Str::title($nameForm); 
        if($validator->isEmpty()){
            $client = Clientweb::create([
                'nameClient' => $convertedName,
                'emailClient' => request('emailClient'),
                'phoneClient' => request('phoneClient'),
                'addressClient' => request('addressClient'),
            ]);
            $client->save();
            
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client->id,
                'service_id' => request('selectService'), 
                'client_source_id' => request('selectClientSource')
            ]);
        }
        else{
            $client = Clientweb::where('emailClient',$emailForm)->get();
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client[0]->id,
                'service_id' => request('selectService'), 
                'client_source_id' => request('selectClientSource')
            ]);
        }
        return redirect()->route('clientsweb'); 
    }

    //Store API
    public function store($nameForm,$emailForm,$phoneForm,$addressForm,$serviceForm,$landingNameid)
    {
        $validator = Clientweb::where('emailClient',$emailForm)->get();
        $convertedName = Str::title($nameForm); 
        if($validator->isEmpty()){
            $client = Clientweb::create([
                'nameClient' => $convertedName,
                'emailClient' => $emailForm,
                'phoneClient' => $phoneForm,
                'addressClient' => $addressForm,
            ]);
            $client->save();
            
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client->id,
                'service_id' => $serviceForm, 
                'client_source_id' => $landingNameid
            ]);
        }
        else{
            $client = Clientweb::where('emailClient',$emailForm)->get();
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client[0]->id,
                'service_id' => $serviceForm, 
                'client_source_id' => $landingNameid
            ]);
        }

        $clientSource = ClientSource::find($landingNameid)->first();

        $message =  "NEW LEAD FROM - ".$clientSource->nameClientSource."\n".
            "\n"."Name: ".$convertedName.
            "\n"."Email: ".$emailForm.
            "\n"."Phone: ".$phoneForm.
            "\n"."Address: ".$addressForm;

            //dd($message);

            /* MODIFICAR */
            /* $TWILIO_SID='AC95dd1cfb53cae79cc24195835f06e8b1';
            $TWILIO_TOKEN='1aa7a38178458ffdb912cf67ff739a68';
            $TWILIO_NUMBER='14753234196'; */
            //$marvinNumber = '13104099884';
            //$joselinNumber = '13109127546';
            //$diegoNumber = '13109127546';

            //SMS TO MARVIN
            /* $smsToMarvin = new Client($TWILIO_SID,$TWILIO_TOKEN);
            $smsToMarvin->messages->create($diegoNumber, [
                'from' => $TWILIO_NUMBER,
                'body' => $message
            ]); */
    }

    public function servicesLanding($id){
        $client = Clientweb::find($id);
        $pivotTable = DB::table('clientweb_service')
                    //->where('clientweb_id','=',$client->id)
                    ->where('clientweb_id','=',$client->id)
                    ->get();
        foreach($pivotTable as $pivot){
            $landing = ClientSource::find($pivot->client_source_id);
            $service = Service::find($pivot->service_id);
            $date = new DateTime($pivot->creted_at);
            $dateFormat = $date->format('m/d/y');
            $data[] = ['idClient' => $client->id , 'clientSource' => $landing->nameClientSource , 'Service' => $service->name_service, 'date' => $dateFormat];
        }
        return response(json_encode($data),200)->header('Content-type','text/plain'); 
    }

    public function showFormClient()
    {
        $services = Service::whereIn('id',[2,6,19,10,11,12,13,14,15,16,17,18])->get();
        $clientSource = ClientSource::all(); 

        $output = '<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="mediumBody">
        
            <div class="row"> 
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Client Name*</label>
                        <input type="text" class="form-control form-control-sm" id="nameClient" name="nameClient" autocomplete="off" required>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Email</label>
                        <input type="email" class="form-control form-control-sm" id="emailClient" name="emailClient" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                    <label style="font-size: 12px;">Address</label>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                    <div id="locationField" >
                    <input type="text" class="form-control form-control-sm" id="autocomplete2" onFocus="geolocate()" name="project_address" required>
                    </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Phone</label> 
                        <input type="text" class="form-control form-control-sm" id="phoneClient" name="phoneClient" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Services</label> 
                        <select class="form-control" id="selectService" style="font-size: 12px;" name="selectService">';
                        foreach($services as $service)
                        {
                            $output .= 
                            '<option value="'.$service->id.'">'.$service->name_service.'</option>';
                        }
              $output .='</select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Client Source</label> 
                        <select class="form-control" id="selectClientSource" style="font-size: 12px;" name="selectClientSource">';
                        foreach($clientSource as $client)
                        {
                            $output .= 
                            '<option value="'.$client->id.'">'.$client->nameClientSource.'</option>';
                        }
            $output .='</select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitClient" form="formCreate" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <script>
            $("#phoneClient").mask("+1 (000) 000-0000");
            var addressFirst = $("#autocomplete").val();
            $("#autocomplete2").val(addressFirst);
            </script>
            <style>
                .pac-container {
                    z-index: 10000 !important;
                }
            </style>';
        echo $output;
    }

    public function edit(Clientweb $client)
    {
        $services = Service::whereIn('id',[2,6,19,10,11,12,13,14,15,16,17,18])->get();
        $clientSource = ClientSource::all();
        //$ruta = 'updateClientweb/'.$client->id.'/';
        $method = '@csrf @method("PATCH")';
        $output = '<form action="http://127.0.0.1:8000/updateClientweb/'.$client->id.'" name="form1" method="GET" class="well form-horizontal" enctype="multipart/form-data" > 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <fieldset>
            <div class="row"> 
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Client Name*</label>
                        <input type="text" class="form-control form-control-sm" id="nameClient" name="nameClient" value="'.$client->nameClient.'" autocomplete="off" required>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Email</label>
                        <input type="email" class="form-control form-control-sm" id="emailClient" name="emailClient" value="'.$client->emailClient.'" autocomplete="off" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                    <div class="form-group">
                        <label style="font-size: 12px;">Address</label>
                        <div id="locationField" >
                            <input type="text" class="form-control form-control-sm" id="autocomplete" onFocus="geolocate()" name="addressClient" value="'.$client->addressClient.'" required>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label style="font-size: 12px;">Phone</label> 
                        <input type="text" class="form-control form-control-sm" id="phoneClient" name="phoneClient" value="'.$client->phoneClient.'" autocomplete="off" required>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Update Client</button>
            </div>
        </fieldset>
        </form>
        <script>
        $(document).ready(function(){
            $("#phoneClient").mask("+1 (000) 000-0000");
        });
        </script>';
        echo $output;
        //return view('Clientsweb.editClientsWeb',compact('services','clientSource','client')); 
    }

    public function update(Request $request, Clientweb $client)
    {
        $clients = Clientweb::all();
        $client->update([
            'nameClient' => request('nameClient'),
            'emailClient' => request('emailClient'),
            'phoneClient' => request('phoneClient'),
            'addressClient' => request('addressClient'),
        ]);
        $client->save();
        return redirect()->back();
    }

    public function delete(Clientweb $client){
        $services = Service::whereIn('id',[2,6,19,10,11,12,13,14,15,16,17,18])->get();
        $clientSource = ClientSource::all();
        return view('Clientsweb.deleteClientsWeb',compact('services','clientSource','client')); 
    }

    public function destroy($client)
    {
        $Client = Clientweb::find($client);
        $Client->delete();
        return redirect()->route('clientsweb');
    }

    public function smsDashboard(){
        return view('Sms.sms');
    }
}
