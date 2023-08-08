<?php

namespace App\Http\Controllers;

use App\QuoteRequest;
use App\Clientweb;
use App\User;
use App\Notifications\Quote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index()
    {
       
    }

    public function create()
    {
        $message = 'null';
        return view('QuoteRequest.quoteRequest',compact('message'));
    }

    public function store(Request $request)
    {
        switch(request('service')){
            case '1':
                //Grading
                $service = 12;
                $emailService = 'Grading';
            break;
            case '2':
                //Pool Excavation
                $service = 2;
                $emailService = 'Pool Excavation';
            break;
            case '3':
                //House Demolition
                $service = 16;
                $emailService = 'House Demolition';
            break;
            case '4':
                //Pool Demolition
                $service = 19;
                $emailService = 'Pool Demolition';
            break;
            case '5':
                //Concrete Services
                $service = 17;
                $emailService = 'Concrete Services';
            break;
            case '6':
                //Excavation Services
                $service = 11;
                $emailService = 'Excavation Services';
            break;
            case '7':
                //Concrete Asphalt Demo Services
                $service = 7;
                $emailService = 'Concrete and Asphalt';
            break;
        }
        $nameForm = request('nameClient'); 
        $convertedName = Str::title($nameForm); 

        $quote = QuoteRequest::create([
            'name' => request('nameClient'),
            'address' => request('project_address'),
            'phone' => request('phoneClient'),
            'email' => request('emailContact'),
            'service_fk' => $service,
        ]);

        $quote->save();
        $message = 'message';

        $clients = Clientweb::all();
        $emailForm = request('emailContact'); 
        $validator = Clientweb::where('emailClient',$emailForm)->get();
        if($validator->isEmpty()){
            $client = Clientweb::create([
                'nameClient' => $convertedName,
                'emailClient' => request('emailContact'),
                'phoneClient' => request('phoneClient'),
                'addressClient' => request('project_address'),
            ]);
            $client->save();
            
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client->id,
                'service_id' => $service, 
                'client_source_id' => 10
            ]);
        }
        else{
            $client = Clientweb::where('emailClient',$emailForm)->get();
            DB::table('clientweb_service')->insert([
                'clientweb_id' => $client[0]->id,
                'service_id' => $service, 
                'client_source_id' => 10
            ]);
        }

        /** Creación del contenido para el correo */
        /* $globalQuote = [
            'nameClient' => 'Client: '.request('nameClient'),
            'phoneClient' => 'Phone: '.request('phoneClient'),
            'emailClient' => 'Email: '.request('emailContact'),
            'serviceClient' => 'Service: '.$emailService,
            'addressClient' => 'Address: '.request('project_address'),
            'textButton' => 'View the address in the Map',
            'url' => 'http://maps.apple.com/?q='. request('project_address')
        ]; */

        /** Se busca que usuarios van a recibir el correo */
        /* $marvin =User::find(1);
        $miguel =User::find(2);
        $joseline =User::find(6);
        $victor =User::find(4);
        $ariel =User::find(3); */

        /** Se envia la notificación a los usuarios */
        /* $marvin->notify(new Quote($globalQuote));
        $miguel->notify(new Quote($globalQuote));
        $joseline->notify(new Quote($globalQuote));
        $victor->notify(new Quote($globalQuote));
        $ariel->notify(new Quote($globalQuote)); */
        return view('QuoteRequest.quoteRequest',compact('message'));
    }

    public function show(QuoteRequest $quoteRequest)
    {
        //
    }

    public function edit(QuoteRequest $quoteRequest)
    {
        //
    }

    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        //
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        //
    }
}
