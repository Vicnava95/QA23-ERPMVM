<?php

namespace App\Http\Controllers;

use App\ToDoListImage;
use App\TimeLineProjectWork;
use Illuminate\Http\Request;

class ToDoListImageController extends Controller
{
    public function dropzoneUploadToDoImage(Request $request, TimeLineProjectWork $idTimeLine){
        $fileR = $request->file('file');
        $fileName =$fileR->getClientOriginalName();
        $file = ToDoListImage ::create([
            'nameFileDocument' => $fileName,
            'timeLineWork_fk' => $idTimeLine->id
        ]);
        $fileR->move(public_path('timeLine'),$fileName);
    }

    /** Esta función actua desde el dropzone, al momento de eliminar un archivo desde la caja */
    public function dropzoneUploadToDoImageDelete($name){
        ToDoListImage::where('nameFileDocument',$name)->delete();
    }

    public function deleteUploadToDoImage (ToDoListImage $idFile){
        $idFile->delete();
        return redirect()->back(); 
    }
}
