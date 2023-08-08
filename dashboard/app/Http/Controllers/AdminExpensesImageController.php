<?php

namespace App\Http\Controllers;

use App\AdminExpensesImage;
use App\AdminExpenses;
use Illuminate\Http\Request;

class AdminExpensesImageController extends Controller
{
    public function dropzone($idAdminExpense)
    {
        $adminExpense = AdminExpenses::find($idAdminExpense);
        return view('AdminExpenses.dropzoneAdminExpenses',compact('adminExpense'));
    }

    public function dropzoneStore(Request $request, $idAdminExpense){
        $fileR = $request->file('file');
        $fileName = $fileR->getClientOriginalName();
        $file = AdminExpensesImage::create([
            'imageName' => $fileName,
            'adminExpenses_fk' => $idAdminExpense
        ]);
        $fileR->move(public_path('adminExpensesImage'),$fileName);
    }

    public function dropzoneDestroy($name){
        AdminExpensesImage::where('imageName',$name)->delete();
    }

    public function adminImageDestroy($id){
        AdminExpensesImage::find($id)->delete();
        return redirect()->back();
    }
}
