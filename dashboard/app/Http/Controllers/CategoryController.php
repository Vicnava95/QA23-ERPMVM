<?php


namespace App\Http\Controllers;
require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php'; 

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
use App\ClientSource;
use App\Clientweb;
use App\PermitTicket;
use App\Truck;
use App\DailyTruck;
use App\DailyLabor;
use App\ContactProject;
use App\Permitstage; 
use App\ComentTicket;
use App\PermitDocuments;
use App\Mail;
use App\Maildocument;
use App\CommentProject;
use App\DocumentProject;
use App\Todolist;
use App\ToDoListImage;
use App\TimeLineProjectWork;
use App\DailyReport;
use App\Payment;
use Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;
use Carbon\Carbon;
use ZipArchive;
class CategoryController extends Controller
{
    public function getGallery($project){
        //Imágenes de los proyectos
        $project = Project::find($project);
        $files = $project->files()->where('project_id',$project->id)->get(); 
        foreach($files as $file){
            $file->reference_file_project;
        }
        
        //Imágenes de los reportes diarios
        $allDailyReports = DailyReport::where('projects_fk',$project->id)->orderBy('dateDailyReport','desc')->get();
        $imageList[] = ['id' => '0' , 'nameImageDailyReport' => 'null'];
        foreach($allDailyReports as $dailyReport){
            $images = DB::table('image_daily_reports')->where('dailyReport_fk',$dailyReport->id)->get();
            if($images->isNotEmpty()){
                foreach($images as $image){
                    if($image->dailyReport_fk == $dailyReport->id){
                        $imageList[] = ['id' => $image->id , 'nameImageDailyReport' => $image->nameImageDailyReport]; 
                    }
                }
            }
        }

        $arrayImages[] = ['type' => 0, 'imageRef' => 'null'];
        foreach ($files as $file){
            $arrayImages[] = ['type' => 1, 'id' => $file->id ,'imageRef' => $file->reference_file_project];
        }
        foreach ($imageList as $iList){
            $arrayImages[] = ['type' => 2, 'id' => $iList['id'] , 'imageRef' => $iList['nameImageDailyReport']];
        }

        //dd($arrayImages);
        $output = '';
        foreach($arrayImages as $aImages){
            if($aImages['imageRef'] != 'null'){
                switch($aImages['type']){
                    case 1:
                        if(substr($aImages['imageRef'],-3) == "MOV" || substr($aImages['imageRef'],-3) == "mp4" || substr($aImages['imageRef'],-3) == "mov"){
                            $output .= '<video id="myImg'.$aImages['id'].'" style="width:100%;max-width:40px;max-height:40px" controls>
                                            <source  src="https://mvm-machinery.com/dashboard/public/uploads/'.$aImages['imageRef'].'">
                                        </video>';
                        }else{
                            $output .= '<img id="myImg'.$aImages['id'].'"'; 
                            /* $output .= 'alt="<a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/deleteFile/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>"'; */
                            $output .= 'src="https://mvm-machinery.com/dashboard/public/uploads/'.$aImages['imageRef'].'" style="width:100%;max-width:40px;max-height:40px">';
                        }
                        /* $output .= '<a href="https://mvm-machinery.com/dashboard/public/uploads/'.$aImages['imageRef'].'" target="_blank">'.$aImages['imageRef'].'</a>'; */

                        /* The Modal */
                        $output .= '<div id="myModal'.$aImages['id'].'" class="modalImage">
                                        <!-- The Close Button -->
                                        <span class="close-image" id="close'.$aImages['id'].'">&times;</span>
                                        <!-- Modal Content (The Image) -->
                                        <img class="modal-content-image" id="img'.$aImages['id'].'">
                                        <!-- Modal Caption (Image Text) -->
                                        <div  style="text-align: center" id="caption'.$aImages['id'].'">
                                            <a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/deleteFile/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>    
                                        </div>
                                    </div>';
                        
                        $output .= '<script>
                                        $("img").lazyload();
                                        $("video").lazyload();
                                        // Get the modal
                                        var modal = document.getElementById("myModal'.$aImages['id'].'");
                            
                                        // Get the image and insert it inside the modal - use its "alt" text as a caption
                                        var img = document.getElementById("myImg'.$aImages['id'].'");
                                        var modalImg = document.getElementById("img'.$aImages['id'].'");
                                        var captionText = document.getElementById("caption'.$aImages['id'].'");
                                        img.onclick = function(){
                                        modal.style.display = "block";
                                        modalImg.src = this.src;
                                        captionText.innerHTML = this.alt;
                                        }
                            
                                        modal.onclick = function() {
                                            img'.$aImages['id'].'.className += " out";
                                            setTimeout(function() {
                                            modal.style.display = "none";
                                            img'.$aImages['id'].'.className = "modal-content-image";
                                            }, 40);
                                            
                                        }
                                    </script>';

                            $output .= '<style>
                                            /* Style the Image Used to Trigger the Modal */
                                            #myImg'.$aImages['id'].' {
                                                border-radius: 5px;
                                                cursor: pointer;
                                                transition: 0.3s;
                                            }
                                
                                            #myImg'.$aImages['id'].':hover {opacity: 0.7;}
                                
                                            /* The Modal (background) */
                                            .modalImage {
                                                display: none; /* Hidden by default */
                                                position: fixed; /* Stay in place */
                                                z-index: 1; /* Sit on top */
                                                padding-top: 100px; /* Location of the box */
                                                left: 0;
                                                top: 0;
                                                width: 100%; /* Full width */
                                                height: 100%; /* Full height */
                                                overflow: auto; /* Enable scroll if needed */
                                                background-color: rgb(0,0,0); /* Fallback color */
                                                background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
                                            }
                                
                                            /* Modal Content (Image) */
                                            .modal-content-image {
                                                margin: auto;
                                                display: block;
                                                width: 80%;
                                                max-width: 700px;
                                            }
                                
                                            /* Caption of Modal Image (Image Text) - Same Width as the Image */
                                            #caption {
                                                margin: auto;
                                                display: block;
                                                width: 80%;
                                                max-width: 700px;
                                                text-align: center;
                                                color: #ccc;
                                                padding: 10px 0;
                                                height: 150px;
                                            }
                                
                                            /* Add Animation - Zoom in the Modal */
                                            .modal-content-image, #caption {
                                                animation-name: zoom;
                                                animation-duration: 0.6s;
                                            }
                                
                                            @keyframes zoom {
                                                from {transform:scale(0)}
                                                to {transform:scale(1)}
                                            }
                                
                                            /* The Close Button */
                                            .close-image {
                                                position: absolute;
                                                top: 15px;
                                                right: 35px;
                                                color: #f1f1f1;
                                                font-size: 40px;
                                                font-weight: bold;
                                                transition: 0.3s;
                                            }
                                
                                            .close-image:hover,
                                            .close-image:focus {
                                                color: #bbb;
                                                text-decoration: none;
                                                cursor: pointer;
                                            }
                                
                                            /* 100% Image Width on Smaller Screens */
                                            @media only screen and (max-width: 700px){
                                                .modal-content-image {
                                                width: 100%;
                                                }
                                            }
                                        </style>';
                        break;
                    case 2:
                        if(substr($aImages['imageRef'],-3) == "MOV" || substr($aImages['imageRef'],-3) == "mp4" || substr($aImages['imageRef'],-3) == "mov"){
                            $output .= '<video id="myImgDaily'.$aImages['id'].'" style="width:100%;max-width:40px;max-height:40px" controls>
                                            <source  src="https://mvm-machinery.com/dashboard/public/imageDailyReport/'.$aImages['imageRef'].'">
                                        </video>';
                        }else{
                            $output .= '<img id="myImgDaily'.$aImages['id'].'"'; 
                            /* $output .= 'alt="<a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/dropzoneImageDailyReportMoreInfo/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>"';  */
                            $output .= 'src="https://mvm-machinery.com/dashboard/public/imageDailyReport/'.$aImages['imageRef'].'" style="width:100%;max-width:40px;max-height:40px">';
                            
                        }
                        /* $output .= '<a href="https://mvm-machinery.com/dashboard/public/imageDailyReport/'.$aImages['imageRef'].'" target="_blank">'.$aImages['imageRef'].'</a>'; */

                        /* The Modal */
                        $output .= '<div id="myModal'.$aImages['id'].'" class="modalImage">
                                        <!-- The Close Button -->
                                        <span class="close-image" id="closeI'.$aImages['id'].'">&times;</span>
                                        <!-- Modal Content (The Image) -->
                                        <img class="modal-content-image" id="img'.$aImages['id'].'">
                                        <!-- Modal Caption (Image Text) -->
                                        <div  style="text-align: center" id="captionI'.$aImages['id'].'">
                                            <a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/dropzoneImageDailyReportMoreInfo/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>    
                                        </div>
                                    </div>';

                        $output .= '<script>
                                    $("img").lazyload();
                                    $("video").lazyload();
                                    // Get the modal
                                    var modal = document.getElementById("myModal'.$aImages['id'].'");
                    
                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var img = document.getElementById("myImgDaily'.$aImages['id'].'");
                                    var modalImg = document.getElementById("img'.$aImages['id'].'");
                                    var captionText = document.getElementById("captionI'.$aImages['id'].'");
                                    img.onclick = function(){
                                    modal.style.display = "block";
                                    modalImg.src = this.src;
                                    captionText.innerHTML = this.alt;
                                    }
                    
                                    modal.onclick = function() {
                                        img'.$aImages['id'].'.className += " out";
                                        setTimeout(function() {
                                        modal.style.display = "none";
                                        img'.$aImages['id'].'.className = "modal-content-image";
                                        }, 40);
                                    }
                                </script>';

                        $output .= '<style>
                        /* Style the Image Used to Trigger the Modal */
                        #myImgDaily'.$aImages['id'].' {
                            border-radius: 5px;
                            cursor: pointer;
                            transition: 0.3s;
                        }
        
                        #myImgDaily'.$aImages['id'].':hover {opacity: 0.7;}
        
                        /* The Modal (background) */
                        .modalImage {
                            display: none; /* Hidden by default */
                            position: fixed; /* Stay in place */
                            z-index: 1; /* Sit on top */
                            padding-top: 100px; /* Location of the box */
                            left: 0;
                            top: 0;
                            width: 100%; /* Full width */
                            height: 100%; /* Full height */
                            overflow: auto; /* Enable scroll if needed */
                            background-color: rgb(0,0,0); /* Fallback color */
                            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
                        }
        
                        /* Modal Content (Image) */
                        .modal-content-image {
                            margin: auto;
                            display: block;
                            width: 80%;
                            max-width: 700px;
                        }
        
                        /* Caption of Modal Image (Image Text) - Same Width as the Image */
                        #caption {
                            margin: auto;
                            display: block;
                            width: 80%;
                            max-width: 700px;
                            text-align: center;
                            color: #ccc;
                            padding: 10px 0;
                            height: 150px;
                        }
        
                        /* Add Animation - Zoom in the Modal */
                        .modal-content-image, #caption {
                            animation-name: zoom;
                            animation-duration: 0.6s;
                        }
        
                        @keyframes zoom {
                            from {transform:scale(0)}
                            to {transform:scale(1)}
                        }
        
                        /* The Close Button */
                        .close-image {
                            position: absolute;
                            top: 15px;
                            right: 35px;
                            color: #f1f1f1;
                            font-size: 40px;
                            font-weight: bold;
                            transition: 0.3s;
                        }
        
                        .close-image:hover,
                        .close-image:focus {
                            color: #bbb;
                            text-decoration: none;
                            cursor: pointer;
                        }
        
                        /* 100% Image Width on Smaller Screens */
                        @media only screen and (max-width: 700px){
                            .modal-content-image {
                            width: 100%;
                            }
                        }
                    </style>';

                        
                        break;
                }
            }
        }
        /* $output = '<h1>test</h1>'; */
        echo $output;
    }

    public function getDailyReportGallery(DailyReport $dailyReport){

        //Imágenes de los reportes diarios
        $imageList[] = ['id' => '0' , 'nameImageDailyReport' => 'null'];
        $images = DB::table('image_daily_reports')->where('dailyReport_fk',$dailyReport->id)->get();
        if($images->isNotEmpty()){
            foreach($images as $image){
                if($image->dailyReport_fk == $dailyReport->id){
                    $imageList[] = ['id' => $image->id , 'nameImageDailyReport' => $image->nameImageDailyReport]; 
                }
            }
        }
        
        $arrayImages[] = ['type' => 0, 'imageRef' => 'null'];
        foreach ($imageList as $iList){
            $arrayImages[] = ['type' => 2, 'id' => $iList['id'] , 'imageRef' => $iList['nameImageDailyReport']];
        }

        //dd($arrayImages);
        $output = '';
        foreach($arrayImages as $aImages){
            if($aImages['imageRef'] != 'null'){
                   
                        if(substr($aImages['imageRef'],-3) == "MOV" || substr($aImages['imageRef'],-3) == "mp4" || substr($aImages['imageRef'],-3) == "mov"){
                            $output .= '<video id="myImgDaily'.$aImages['id'].'" style="width:100%;max-width:40px;max-height:40px" controls>
                                            <source  src="https://mvm-machinery.com/dashboard/public/imageDailyReport/'.$aImages['imageRef'].'">
                                        </video>';
                        }else{
                            $output .= '<img id="myImgDaily'.$aImages['id'].'"'; 
                            $output .= 'src="https://mvm-machinery.com/dashboard/public/imageDailyReport/'.$aImages['imageRef'].'" style="width:100%;max-width:40px;max-height:40px">';
                            
                        }

                       
                        $output .= '<div id="myModal'.$aImages['id'].'" class="modalImage">
                                        <!-- The Close Button -->
                                        <span class="close-image" id="closeI'.$aImages['id'].'">&times;</span>
                                        <!-- Modal Content (The Image) -->
                                        <img class="modal-content-image" id="img'.$aImages['id'].'">
                                        <!-- Modal Caption (Image Text) -->
                                        <div  style="text-align: center" id="captionI'.$aImages['id'].'">
                                            <a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/dropzoneImageDailyReportMoreInfo/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>    
                                        </div>
                                    </div>';

                        $output .= '<script>
                                    $("img").lazyload();
                                    $("video").lazyload();
                                    // Get the modal
                                    var modal = document.getElementById("myModal'.$aImages['id'].'");
                    
                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var img = document.getElementById("myImgDaily'.$aImages['id'].'");
                                    var modalImg = document.getElementById("img'.$aImages['id'].'");
                                    var captionText = document.getElementById("captionI'.$aImages['id'].'");
                                    img.onclick = function(){
                                    modal.style.display = "block";
                                    modalImg.src = this.src;
                                    captionText.innerHTML = this.alt;
                                    }
                    
                                    modal.onclick = function() {
                                        img'.$aImages['id'].'.className += " out";
                                        setTimeout(function() {
                                        modal.style.display = "none";
                                        img'.$aImages['id'].'.className = "modal-content-image";
                                        }, 40);
                                    }
                                </script>';

                        $output .= '<style>
                                    
                                    #myImgDaily'.$aImages['id'].' {
                                        border-radius: 5px;
                                        cursor: pointer;
                                        transition: 0.3s;
                                    }
        
                                    #myImgDaily'.$aImages['id'].':hover {opacity: 0.7;}
                    
                                   
                                    .modalImage {
                                        display: none; 
                                        position: fixed; 
                                        z-index: 1; 
                                        padding-top: 100px; 
                                        left: 0;
                                        top: 0;
                                        width: 100%; 
                                        height: 100%; 
                                        overflow: auto; 
                                        background-color: rgb(0,0,0); 
                                        background-color: rgba(0,0,0,0.9); 
                                    }
        
                                    
                                    .modal-content-image {
                                        margin: auto;
                                        display: block;
                                        width: 80%;
                                        max-width: 700px;
                                    }
                    
                                    
                                    #caption {
                                        margin: auto;
                                        display: block;
                                        width: 80%;
                                        max-width: 700px;
                                        text-align: center;
                                        color: #ccc;
                                        padding: 10px 0;
                                        height: 150px;
                                    }
        
                                    
                                    .modal-content-image, #caption {
                                        animation-name: zoom;
                                        animation-duration: 0.6s;
                                    }
                    
                                    @keyframes zoom {
                                        from {transform:scale(0)}
                                        to {transform:scale(1)}
                                    }
                    
                                    
                                    .close-image {
                                        position: absolute;
                                        top: 15px;
                                        right: 35px;
                                        color: #f1f1f1;
                                        font-size: 40px;
                                        font-weight: bold;
                                        transition: 0.3s;
                                    }
        
                                    .close-image:hover,
                                    .close-image:focus {
                                        color: #bbb;
                                        text-decoration: none;
                                        cursor: pointer;
                                    }
                    
                                    
                                    @media only screen and (max-width: 700px){
                                        .modal-content-image {
                                        width: 100%;
                                        }
                                    }
                                    </style>';
            }
        }

        echo $output;
    }

    public function getPaymentsGallery($payment){

        /* $payments = Payment::where('project_fk',$project->id)->get(); */
        //Imágenes de los payments
        $imageList[] = ['id' => '0' , 'nameImageDailyReport' => 'null'];
        /* foreach($payments as $payment){ */
            $images = DB::table('payment_images')->where('payment_fk',$payment)->get();
            /* dd($images); */
            if($images->isNotEmpty()){
                foreach($images as $image){
                    if($image->payment_fk == $payment){
                        $imageList[] = ['id' => $image->id , 'nameImageDailyReport' => $image->namePaymentImage]; 
                    }
                }
            }
        /* } */
        
        $arrayImages[] = ['type' => 0, 'imageRef' => 'null'];
        foreach ($imageList as $iList){
            $arrayImages[] = ['type' => 2, 'id' => $iList['id'] , 'imageRef' => $iList['nameImageDailyReport']];
        }

        //dd($arrayImages);
        $output = '';
        foreach($arrayImages as $aImages){
            if($aImages['imageRef'] != 'null'){
                   
                        if(substr($aImages['imageRef'],-3) == "MOV" || substr($aImages['imageRef'],-3) == "mp4" || substr($aImages['imageRef'],-3) == "mov"){
                            $output .= '<video id="myImgDaily'.$aImages['id'].'" style="width:100%;max-width:40px;max-height:40px" controls>
                                            <source  src="https://mvm-machinery.com/dashboard/public/paymentImages/'.$aImages['imageRef'].'">
                                        </video>';

                            /* $output .= '<video id="myImgDaily'.$aImages['id'].'" style="width:100%;max-width:40px;max-height:40px" controls>
                                            <source  src="http://127.0.0.1:8000/paymentImages/'.$aImages['imageRef'].'">
                                        </video>'; */
                        }else{
                            $output .= '<img id="myImgDaily'.$aImages['id'].'"'; 
                            $output .= 'src="https://mvm-machinery.com/dashboard/public/paymentImages/'.$aImages['imageRef'].'" style="width:100%;max-width:40px;max-height:40px">';
                            
                            /* $output .= 'src="http://127.0.0.1:8000/paymentImages/'.$aImages['imageRef'].'" style="width:100%;max-width:40px;max-height:40px">'; */
                            
                        }

                       
                        $output .= '<div id="myModal'.$aImages['id'].'" class="modalImage">
                                        <!-- The Close Button -->
                                        <span class="close-image" id="closeI'.$aImages['id'].'">&times;</span>
                                        <!-- Modal Content (The Image) -->
                                        <img class="modal-content-image" id="img'.$aImages['id'].'">
                                        <!-- Modal Caption (Image Text) -->
                                        <div  style="text-align: center" id="captionI'.$aImages['id'].'">
                                            <a class="btn btn-outline-danger" href="https://mvm-machinery.com/dashboard/public/dropzoneImageDailyReportMoreInfo/'.$aImages['imageRef'].'" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>    
                                        </div>
                                    </div>';

                        $output .= '<script>
                                    $("img").lazyload();
                                    $("video").lazyload();
                                    // Get the modal
                                    var modal = document.getElementById("myModal'.$aImages['id'].'");
                    
                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var img = document.getElementById("myImgDaily'.$aImages['id'].'");
                                    var modalImg = document.getElementById("img'.$aImages['id'].'");
                                    var captionText = document.getElementById("captionI'.$aImages['id'].'");
                                    img.onclick = function(){
                                    modal.style.display = "block";
                                    modalImg.src = this.src;
                                    captionText.innerHTML = this.alt;
                                    }
                    
                                    modal.onclick = function() {
                                        img'.$aImages['id'].'.className += " out";
                                        setTimeout(function() {
                                        modal.style.display = "none";
                                        img'.$aImages['id'].'.className = "modal-content-image";
                                        }, 40);
                                    }
                                </script>';

                        $output .= '<style>
                                    
                                    #myImgDaily'.$aImages['id'].' {
                                        border-radius: 5px;
                                        cursor: pointer;
                                        transition: 0.3s;
                                    }
        
                                    #myImgDaily'.$aImages['id'].':hover {opacity: 0.7;}
                    
                                   
                                    .modalImage {
                                        display: none; 
                                        position: fixed; 
                                        z-index: 1; 
                                        padding-top: 100px; 
                                        left: 0;
                                        top: 0;
                                        width: 100%; 
                                        height: 100%; 
                                        overflow: auto; 
                                        background-color: rgb(0,0,0); 
                                        background-color: rgba(0,0,0,0.9); 
                                    }
        
                                    
                                    .modal-content-image {
                                        margin: auto;
                                        display: block;
                                        width: 80%;
                                        max-width: 700px;
                                    }
                    
                                    
                                    #caption {
                                        margin: auto;
                                        display: block;
                                        width: 80%;
                                        max-width: 700px;
                                        text-align: center;
                                        color: #ccc;
                                        padding: 10px 0;
                                        height: 150px;
                                    }
        
                                    
                                    .modal-content-image, #caption {
                                        animation-name: zoom;
                                        animation-duration: 0.6s;
                                    }
                    
                                    @keyframes zoom {
                                        from {transform:scale(0)}
                                        to {transform:scale(1)}
                                    }
                    
                                    
                                    .close-image {
                                        position: absolute;
                                        top: 15px;
                                        right: 35px;
                                        color: #f1f1f1;
                                        font-size: 40px;
                                        font-weight: bold;
                                        transition: 0.3s;
                                    }
        
                                    .close-image:hover,
                                    .close-image:focus {
                                        color: #bbb;
                                        text-decoration: none;
                                        cursor: pointer;
                                    }
                    
                                    
                                    @media only screen and (max-width: 700px){
                                        .modal-content-image {
                                        width: 100%;
                                        }
                                    }
                                    </style>';
            }
        }
        //dd($output);
        echo $output;
    }

}
