<?php

namespace App\Http\Controllers;

use App\Mail;
use App\Maildocument;
use Illuminate\Http\Request;
use App\PermitDocuments;

class MailController extends Controller
{
    public function index()
    {
        
    }

    public function create($idDocument, $permitId)
    {
        $document = PermitDocuments::find($idDocument);
        return view('Mail.create',compact('document','idDocument','permitId')); 
    }

    public function store(Request $request, $idDocument, $permitId)
    {
        $mailD = Mail::create([
            'courier' => request('courier'),
            'recipientsName' => request('recipientName'),
            'tracking' => request('tracking'),
            'permitDocument' => request('permitDocument'),
            'dateSend' => request('dateSend'),
            'dateReceived' => request('dateReceived'),
            'certifiedMail' =>request('certifiedMail'),
            'certificationNumber' => request('certficationNumber'),
            'permitDocuments_fk' => $idDocument
        ]);
        $mailD->save();
        return redirect()->route('infoPermit',$permitId);
    }

    public function show(Mail $mail)
    {
        //
    }

    public function edit($idDocument, $permitId, $idMail)
    {
        $mail = Mail::find($idMail);
        $document = PermitDocuments::find($idDocument);
        //dd($mail); 
        return view('Mail.edit',compact('mail','document','permitId'));
    }

    public function update(Request $request, $permitId, $idMail)
    {
        $mail = Mail::find($idMail);
        $mailD = $mail->update([
            'courier' => request('courier'),
            'recipientsName' => request('recipientName'),
            'tracking' => request('tracking'),
            'permitDocument' => request('permitDocument'),
            'dateSend' => request('dateSend'),
            'dateReceived' => request('dateReceived'),
            'certifiedMail' =>request('certifiedMail'),
            'certificationNumber' => request('certficationNumber')
        ]);
        return redirect()->route('infoPermit',$permitId);
    }

    public function delete($idDocument, $permitId, $idMail){
        $mail = Mail::find($idMail);
        $document = PermitDocuments::find($idDocument);
        return view('Mail.delete',compact('mail','document','permitId'));
    }

    public function destroy($permitId, $idMail)
    {
        $mail = Mail::find($idMail);
        $mail->delete();
        return redirect()->route('infoPermit',$permitId);
    }

    public function dropzone($idDocument, $permitId, $idMail)
    {
        $mail = Mail::find($idMail);
        $document = PermitDocuments::find($idDocument);
        return view('Mail.dropzone',compact('mail','document','permitId'));
    }

    public function dropzoneStore(Request $request, $idMail){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = Maildocument::create([
            'referenceMailDocument' => $fileName,
            'mail_fk' => $idMail
        ]);
        $fileR->move(public_path('documentMails'),$fileName);
    }

    public function dropzoneDestroy($name){
        Maildocument::where('referenceMailDocument',$name)->delete();
    }

    public function documentMailDestroy($permitId, $id){
        Maildocument::find($id)->delete();
        return redirect()->route('infoPermit',$permitId);
    }
    
}
