<?php

namespace App\Http\Controllers;

use App\ContactProject;
use App\Clientweb;
use App\Project;
use App\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactProjectController extends Controller
{
    public function index()
    {
        $allContacts = ContactProject::orderBy('created_at','desc')->get();
        $arrayContacts= [];
        foreach($allContacts as $co){
            if(!in_array($co->idClient,$arrayContacts))
            {
                array_push($arrayContacts,$co->idClient);
            }
        }

        
        foreach($arrayContacts as $array){
            $client = Clientweb::find($array);
            if($client == null){
                $clientInfo[] = ['idClient' => 0, 'nameClient' => 0,
                'phoneClient'=> 0, 'emailClient' => 0, 'addressClient'=> 0];
            }else{
                $clientInfo[] = ['idClient' => $client->id, 'nameClient' => $client->nameClient,
                'phoneClient'=> $client->phoneClient, 'emailClient' => $client->emailClient, 'addressClient'=> $client->addressClient];
            }
        }

        foreach($allContacts as $contact){
            $client = Clientweb::find($contact->idClient);
            $project = Project::find($contact->project_fk);
            if($project == null){
                $projects[] = ['idClient' => 0, 'nameProject' => 0,
                            'profit' => 0, 'address' => 0];
            }else{
                $services = $project->services()->get();
                $purchases = Purchase::where('project_fk',$project->id)->get();
                $totalAmount = 0; 
                foreach($purchases as $purchase){
                    $totalAmount += $purchase->amount;
                }
                $profit = $project->sold_project - $totalAmount; 
                foreach($services as $service){
                    $servicios[] = ['idProject' => $project->id , 'service' => $service->name_service];
                }
                $projects[] = ['idClient' => $client->id, 'nameProject' => $project->name_project,
                                'profit' => $profit, 'address' => $project->address_project,];
            }
            
        }

        foreach($arrayContacts as $array){
            $sumaProfitProjects = 0;
            foreach($projects as $pro){
                if($pro['idClient'] == $array){
                    $sumaProfitProjects += $pro['profit']; 
                }
            }
            $profitArray[] = ['idClient' => $array , 'totalProfit' => $sumaProfitProjects];
        }
        return view('Contact.contacts',compact('clientInfo','projects','profitArray'));
    }

    public function searchClient($name){
        //$clientSource = ClientSource::all();
        $data = DB::table('clientwebs')
                ->where('nameClient','LIKE',"%{$name}%")
                ->get();
        foreach($data as $d){
            $contactPro = DB::table('contact_projects')
            ->where('idClient','LIKE',"{$d->id}")
            ->get();
        }
        $output = '<div>';
        foreach($data as $d){
                $output .= '<div href="#" class="list-group-item list-group-item-action flex-column align-items-start" data-toggle="collapse" data-target="#collapse'.$d->id.'" aria-expanded="false" aria-controls="collapse'.$d->id.'">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">'.$d->nameClient.'</h5>
                    <h5 class="mb-1">'.$d->id.'</h5>
                    <a class="mb-1 text-left noprop" href="tel:+1'.$d->phoneClient.'" target="_blank">'.$d->phoneClient.'</a>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <a class="mb-1 text-left noprop" href="mailto:'.$d->emailClient.'" target="_blank">'.$d->emailClient.'</a>
                </div>
                <div class="d-flex w-100 justify-content-between">';
                    /* @foreach ($profitArray as $profitA)
                        @if ($cInfo['idClient'] == $profitA['idClient']) */
                        $output .= '<p class="mb-1 text-left">Total Profit: $895</p>';
                        /* @endif
                    @endforeach */
                    $output .= '</div>
            </div>

            <div id="collapse'.$d->nameClient.'" class="collapse" aria-labelledby="heading'.$d->nameClient.'" data-parent="#accordion">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Project</th>
                            <th scope="col">Address</th>
                            </tr>
                        </thead>';
                        $output .= '<tbody>';
                            /* @foreach ($projects as $project)
                                @if ($cInfo['idClient'] == $project['idClient']) */
                                $output .= '<tr>
                                        <td>nombre proyecto</td>
                                        <td>address proyecto</td>
                                    </tr>';
                                /* @endif
                            @endforeach */
                            $output .= '</tbody>
                    </table>
                </div>
            </div>';
            
        }
        $output .= '</div>';
        echo $output;  
    }

    public function edit(Clientweb $client)
    {
        $method = '@csrf @method("PATCH")';
        $output = '<form action="https://mvm-machinery.com/dashboard/public/updateContactweb/'.$client->id.'" name="form1" method="GET" class="well form-horizontal" enctype="multipart/form-data" > 
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
        return redirect()->back();
    }



}
