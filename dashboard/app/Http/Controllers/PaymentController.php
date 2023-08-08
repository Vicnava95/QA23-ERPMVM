<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentImage;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $payments = Payment::create([
            'paymentMethod_fk' => request('methodPayment'),
            'project_fk' => $projectId,
            'amountPayment' => request('amountPayment'),
            'transactionDate' => date("Y-m-d",strtotime(request('paymentDate'))),
            'details' => request('orderDescription'),
            'transaction' => request('orderPayment'),
        ]);
        return redirect()->route('uploadImagePayment',[$payments]);
    }

    public function update(Request $request, Payment $paymentId)
    {
        $paymentId->update([
            'paymentMethod_fk' => request('methodPayment'),
            'amountPayment' => request('amountPayment'),
            'transactionDate' => date("Y-m-d",strtotime(request('paymentDate'))),
            'details' => request('orderDescription'),
            'transaction' => request('orderPayment'),
        ]);
        return redirect()->back();
    }

    public function destroy(Request $request, Payment $paymentId)
    {
        $paymentId->delete();
        return redirect()->back();
    }

    public function uploadImagePayment(Payment $paymentId){
        return view('Project.dropzonePayments',compact('paymentId'));
    }

    public function dropzonePaymentImage(Request $request, Payment $paymentId){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = PaymentImage ::create([
            'namePaymentImage' => $fileName,
            'payment_fk' => $paymentId->id
        ]);
        $fileR->move(public_path('paymentImages'),$fileName);
    }

    /** Esta función actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function dropzonePaymentImageDelete($name){
        PaymentImage::where('namePaymentImage',$name)->delete();
    }

}
