<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use DB;
use App\Renta;
use App\Cliente;
use App\Compañia;

use setasign\Fpdi\Fpdi;
use Imagick;


class Rental_Agreement_Controller extends Controller
{
    public function rental_customer_data(){

//        $re= DB::table('rentals')->get(); se usuara un where par filtrar la busqueda


        $id=Session::get('id_renta_first');
        $ren=Renta::with('clientes','machine')->where('id','=',$id)->first();

        /* FOLDER CREATION */
        $path = public_path('documents/signature/' .$ren->id);
        File::makeDirectory($path, $mode = 0777, true, true);
       // Storage::makeDirectory('/Users/user/Documents/Code/MyV/Mvm-platform-master/MVM/public/documents/signature/adadasdasd');


        $pdf=new Fpdi();


        $pdf->AddPage();
        $pdf->setSourceFile('documents/base/croped.pdf');

        $tplIdx=$pdf->importPage(1);
        $pdf->useTemplate($tplIdx,null,null,null,null,true);
        /* ********************CROPED****************** */
//--------------------RENTAL TEXT-------------------
// CUSTOMER N. TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 47.5);
        $pdf->Write(11,"23908");
// RENTAL AGREEMENT N. TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(177, 47.5);
        $pdf->Write(11,"15525");
//--------------------CUSTOMER TEXT-----------------
// FULLNAME TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 61.4);
        $pdf->Write(11,$ren->clientes->full_name);
// COMPANY TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 67.5);
        $pdf->Write(11,$ren->clientes->id_comp);
// ADDRESS TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 73.5);
        $pdf->Write(11,$ren->delivery_site);
// JOBSITE TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 79.5);
        $pdf->Write(11,"El Cerrito");
// PHONE TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(46, 85.7);
        $pdf->Write(11,$ren->clientes->phone_num);
//--------------------DATE&TIME TEXT-----------------
// DATE OUT TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(157, 61.1);
        $pdf->Write(11,date("m/d/Y",strtotime($ren->dispatch_date)));
// DATE OUT->TIME TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(157, 67.1);
        $pdf->Write(11,"8:43");
// EST DATE IN TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(157, 79.6);
        $pdf->Write(11,"2/15/2020");
// EST DATE IN->TIME TEXT
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(157, 86);
        $pdf->Write(11,"20:00");

//MACHINES
// QTY
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(25, 110);
        $pdf->Write(11,"1");
// DESCRIPTION
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(57, 110);
        $pdf->Write(11,$ren->machinery->name);
// DAY
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(145, 110);
        $pdf->Write(11,"2");
// PRICE
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(163, 110);
        $pdf->Write(11,"$200");
// Total
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(2, 4, 7);
        $pdf->SetXY(182, 110);
        $pdf->Write(11,"$42 00");
//// QTY
//        $pdf->SetFont('Helvetica');
//        $pdf->SetTextColor(2, 4, 7);
//        $pdf->SetXY(25, 115);
//        $pdf->Write(11,"1");
//// DESCRIPTION
//        $pdf->SetFont('Helvetica');
//        $pdf->SetTextColor(2, 4, 7);
//        $pdf->SetXY(57, 115);
//        $pdf->Write(11,"Skid Steer Loader 262-D");
//// DAY
//        $pdf->SetFont('Helvetica');
//        $pdf->SetTextColor(2, 4, 7);
//        $pdf->SetXY(145, 115);
//        $pdf->Write(11,"2");
//// PRICE
//        $pdf->SetFont('Helvetica');
//        $pdf->SetTextColor(2, 4, 7);
//        $pdf->SetXY(163, 115);
//        $pdf->Write(11,"$150");
//// Total
//        $pdf->SetFont('Helvetica');
//        $pdf->SetTextColor(2, 4, 7);
//        $pdf->SetXY(182, 115);
//        $pdf->Write(11,"$300");

        $filePath='documents/pdf/'.$ren->id.'.pdf';
        $pdf->Output($filePath,'F');


        /* PDF FULL */
        $pdf2=new Fpdi();


        $pdf2->AddPage();
        $pdf2->setSourceFile('documents/base/Rental_agreement_2020.pdf');

        $tplIdx=$pdf2->importPage(1);
        $pdf2->useTemplate($tplIdx,null,null,null,null,true);
         //--------------------RENTAL TEXT-------------------
// CUSTOMER N. TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 55.5);
$pdf2->Write(11,"23908");
// RENTAL AGREEMENT N. TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(177, 55.5);
$pdf2->Write(11,"15525");
//--------------------CUSTOMER TEXT-----------------
// FULLNAME TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 68.6);
$pdf2->Write(11,$ren->clientes->full_name);
// COMPANY TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 75);
$pdf2->Write(11,$ren->clientes->id_comp);
// ADDRESS TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 81);
$pdf2->Write(11,$ren->delivery_site);
// JOBSITE TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 87.2);
$pdf2->Write(11,"El Cerrito");
// PHONE TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(46, 93.3);
$pdf2->Write(11,$ren->clientes->phone_num);
//--------------------DATE&TIME TEXT-----------------
// DATE OUT TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(157, 68.9);
$pdf2->Write(11,date("m/d/Y",strtotime($ren->dispatch_date)));
// DATE OUT->TIME TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(157, 74.7);
$pdf2->Write(11,"8:43");
// EST DATE IN TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(157, 87.2);
$pdf2->Write(11,"2/15/2020");
// EST DATE IN->TIME TEXT
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(157, 93.5);
$pdf2->Write(11,"20:00");
// ------------- SIGNATURE  --------------
// DATE
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(157, 257.2);
$pdf2->Write(11,"2/12/2020");
// PRINTED NAME
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(104, 257.2);
$pdf2->Write(11,"Marvin Vigil");
// QTY
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(25, 115);
$pdf2->Write(11,"1");
// DESCRIPTION
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(57, 115);
$pdf2->Write(11,$ren->machinery->name);
// DAY
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(145, 115);
$pdf2->Write(11,"2");
// PRICE
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(163, 115);
$pdf2->Write(11,"$200");
// Total
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(182, 115);
$pdf2->Write(11,"$400");
/* // QTY
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(25, 120);
$pdf2->Write(11,"1");
// DESCRIPTION
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(57, 120);
$pdf2->Write(11,"Skid Steer Loader 262-D");
// DAY
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(145, 120);
$pdf2->Write(11,"2");
// PRICE
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(163, 120);
$pdf2->Write(11,"$150");
// Total
$pdf2->SetFont('Helvetica');
$pdf2->SetTextColor(2, 4, 7);
$pdf2->SetXY(182, 120);
$pdf2->Write(11,"$300"); */
$filePath='documents/pdf/croped'.$ren->id.'.pdf';
        $pdf->Output($filePath,'F');
        /* IMAGIC FUNCTION */
        $im = new Imagick();

        $im->setResolution(595,648);
        $im->readimage('documents/pdf/'.$ren->id.'.pdf[0]');
        $im->setImageFormat('jpg');
        /* $im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
        $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE); */
        $im->writeImage('documents/jpg/'.$ren->id.'.jpg');
        $im->clear();
        $im->destroy();

         return redirect()->action('Calendar_Controller@index');
        /* return View('pdf')->with('ren',$ren->id); */





    }

    public function save_signature(Request $request){
        $result = array();
	$imagedata = base64_decode($request->input('img_data'));
	$filename = md5(date("dmYhisA"));
	//Location to where you want to created sign image
	$file_name = 'documents/signs/test.png';
	file_put_contents($file_name,$imagedata);
	$result['status'] = 1;
	$result['file_name'] = $file_name;
	echo json_encode($result);
    }

    public function signature($id){

      /* $im = new Imagick();

        $im->setResolution(595,648);
        $im->readimage('signed_Documents/MVRENTcroped.pdf[0]');
        $im->setImageFormat('jpg');
        $im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
        $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $im->writeImage('thumb222.jpg');
        $im->clear();
        $im->destroy(); */
        return View('pdf')->with('id',$id);;
    }

}
