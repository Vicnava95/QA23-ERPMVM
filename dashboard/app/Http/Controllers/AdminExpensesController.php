<?php

namespace App\Http\Controllers;

use App\AdminExpenses;
use App\AdminExpensesImage;
use App\TypeAdminExpenses;
use App\CategoryExpense;
use App\Purchase;
use App\PurchaseCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminExpensesController extends Controller
{
    /** Dashboard para la consulta desde el primer dia del mes hasta el día actual */
    public function dashboard(){
        //Otengo la fecha actual, el primer día de la fecha actual
        $currentDate = Carbon::now()->format('m/d/Y');
        $firstDayOfMonth =Carbon::now()->startOfMonth()->format('m/d/Y');

        //Obtengo los gastos administrativos y de los proyectos, desde el primer día del mes ACTUAL hasta el día ACTUAL.
        $totalAdminExpenses = AdminExpenses::whereBetween('dateAdminExpenses',[$firstDayOfMonth, $currentDate])->get();
        $totalAdmin = 0;
        foreach($totalAdminExpenses as $tAdminExpenses){
            $totalAdmin += $tAdminExpenses->amountDecimalExpenses;
        }
        $purchases = Purchase::whereBetween('date_purchase',[$firstDayOfMonth, $currentDate])->get();
        $totalPurchases = 0;
        foreach($purchases as $purchase){
            $totalPurchases += $purchase->amount;
        }
        $totalCurrentCost = $totalAdmin + $totalPurchases;

        /************************************************************************************************************ */

        //Obtengo el primero y último día del mes PASADO
        $lastMonth = Carbon::now()->subMonth()->format('m');
        $firstDayLastMonth = Carbon::createFromFormat('m',$lastMonth)->startOfMonth()->format('m/d/Y');
        $lastDayLastMonth = Carbon::createFromFormat('m',$lastMonth)->endOfMonth()->format('m/d/Y');

        //Obtengo los gastos administrativos y de los proyectos, del mes PASADO.
        $totalAdminExpensesLastMonth = AdminExpenses::whereBetween('dateAdminExpenses',[$firstDayLastMonth, $lastDayLastMonth])->get();
        $totalAdminLastMonth = 0;
        foreach($totalAdminExpensesLastMonth as $tAdminExpenses){
            $totalAdminLastMonth += $tAdminExpenses->amountDecimalExpenses;
        }
        $purchasesLastMonth = Purchase::whereBetween('date_purchase',[$firstDayLastMonth, $lastDayLastMonth])->get();
        $totalPurchasesLastMonth = 0;
        foreach($purchasesLastMonth as $purchase){
            $totalPurchasesLastMonth += $purchase->amount;
        }
        $totalLastMonthCost = $totalAdminLastMonth + $totalPurchasesLastMonth;

        /************************************************************************************************************ */

        //Obtengo los gastos de OFFICE y YARD, desde el primer día del mes ACTUAL hasta el día ACTUAL.
        $totalOfficeYard = 0;
        foreach($totalAdminExpenses as $tAdminExpenses){
            if($tAdminExpenses->status->categoryExpenses_fk == 1 || $tAdminExpenses->status->categoryExpenses_fk == 2){
                $totalOfficeYard += $tAdminExpenses->amountDecimalExpenses;
            }
        }

        /************************************************************************************************************ */

        //GRAFICA CARROUSEL 1

        /************************************************************************************************************ */

        //GRAFICA CARROUSEL 2

        /************************************************************************************************************ */
        //PIE CHART Projects - Office - Yard 
        //Obtengo el total gastado por cada una de las categorias hasta el día actual

        $totalOnlyOffice = 0;
        foreach($totalAdminExpenses as $tAdminExpenses){
            if($tAdminExpenses->status->categoryExpenses_fk == 1){
                $totalOnlyOffice += $tAdminExpenses->amountDecimalExpenses;
            }
        }
        $totalOnlyYard = 0;
        foreach($totalAdminExpenses as $tAdminExpenses){
            if($tAdminExpenses->status->categoryExpenses_fk == 2){
                $totalOnlyYard += $tAdminExpenses->amountDecimalExpenses;
            }
        }

        $pieChartCategory[] = ['category' => 'Projects', 'total' => $totalPurchases , 'color' => '#ff704d'];
        $pieChartCategory[] = ['category' => 'Office', 'total' => $totalOnlyOffice , 'color' => '#668cff'];
        $pieChartCategory[] = ['category' => 'Yard', 'total' => $totalOnlyYard , 'color' => '#53c653'];

        /************************************************************************************************************ */
        function getAdminExpensesOffice($totalAdminExpenses,$idCategory, $typeCategory){
            $total = 0;
            foreach($totalAdminExpenses as $tAdminExpenses){
                //dd($tAdminExpenses->status->categoryExpenses_fk);
                if($tAdminExpenses->status->categoryExpenses_fk == $idCategory && $tAdminExpenses->type_admin_expenses_fk == $typeCategory ){
                    $total += $tAdminExpenses->amountDecimalExpenses;
                }
            }
            return $total;
        }

        $categories = TypeAdminExpenses::all();
        foreach($categories as $categorie){
            $totalCategorie = getAdminExpensesOffice($totalAdminExpenses,$categorie->categoryExpenses_fk,$categorie->id);
            $data[] = ['idCategory' => $categorie->categoryExpenses_fk ,'typeCategoryName'=> $categorie->nameTypeAdminExpenses , 'total' => $totalCategorie, 'color' => $categorie->colorTypeAdminExpenses];
        }

        /************************************************************************************************************ */
        //PIE CHART PROJECTS
        $allPurchaseCategory = PurchaseCategory::all();
        foreach($allPurchaseCategory as $purchaseCategory){
            $totalCategory = 0;
            foreach($purchases as $purchase){
                if($purchase->purchase_categorie_fk == $purchaseCategory->id){
                    $totalCategory += $purchase->amount;
                }
            }
            $projectArray[] = ['idPurCategory' => $purchaseCategory->id, 'categoryName' => $purchaseCategory->name_category, 'total' => $totalCategory, 'color' => $purchaseCategory->color];
        }
        $projectPieChart[] = [];
        foreach($projectArray as $ptArray){
            if($ptArray['total'] != 0){
              $projectPieChart[] = $ptArray;
            }
        }

        /************************************************************************************************************ */
        //PIE CHART OFFICE
        $officePieChart[] = [];
        foreach($data as $d){
            if($d['idCategory'] == 1 && $d['total'] != 0){
                $officePieChart[] = $d;
            }
        }

        /************************************************************************************************************ */
        //PIE CHART YARD
        $yardPieChart[] = [];
        foreach($data as $d){
            //dd($d);
            if($d['idCategory'] == 2 && $d['total'] != 0){
                $yardPieChart[] = $d;
            }
            
        }

        return view('AdminExpenses.dashboard',compact('currentDate','totalCurrentCost','totalLastMonthCost','totalOfficeYard','pieChartCategory',
                                                      'officePieChart','yardPieChart','projectPieChart'));
    }

    /** Se muestran todos los gastos administrativos */
    public function index()
    {
        $allAdminExpenses = AdminExpenses::all();
        $categories = CategoryExpense::where('generalStatus_fk',1)->get();
        $imagesAdmin = AdminExpensesImage::all();
        return view('AdminExpenses.showAdminExpenses', compact('allAdminExpenses','categories','imagesAdmin'));
    }

    /** Función para crear un nuevo gasto adminitrativo, pero los tipos de gasto, solo muestra los que tienen un estado activo */
    public function create()
    {
        $typesAdminExpenses = TypeAdminExpenses::where('generalStatus_fk',1)->get();
        $categories = CategoryExpense::where('generalStatus_fk',1)->get();
        return view('AdminExpenses.createAdminExpenses',compact('typesAdminExpenses','categories'));
    }

    /** Función para obtener los tipos de compra desde JS para almacenar varias compras */
    public function getcategories($id){
        $categories = TypeAdminExpenses::where('generalStatus_fk',1)
                                        ->where('categoryExpenses_fk',$id)
                                        ->get();
        return response(json_encode($categories),200)->header('Content-type','text/plain');
    }

    /** Función para obtener las categorias desde JS para almacenar varias compras */
    public function getCate(){
        $typeCategories = CategoryExpense::where('generalStatus_fk',1)->get();
        return response(json_encode($typeCategories),200)->header('Content-type','text/plain');
    }

    /** Función para almacenar el gasto administrativo, el request viene en un array */
    public function store(Request $request)
    {
        //dd(request());
        $user_id = Auth::user()->id;
        $valorNull = "";
        foreach(request()->expensesType as $item=>$v){
            if(strcmp(request()->expensesType[$item], $valorNull)!==0){
                $data=array(
                    'amountDecimalExpenses'=> request()->amount[$item],
                    'dateAdminExpenses'=>request()->dateExpense[$item],
                    'commentAdminExpenses'=> request()->comment[$item],
                    'type_admin_expenses_fk'=> request()->expensesType[$item],
                    'user_fk' => $user_id
                );
                $adminExpense = AdminExpenses::create($data);
                $adminExpense->save();
            }
        }
        return view('AdminExpenses.dropzoneAdminExpenses',compact('adminExpense'));
        //return redirect()->route('showAdminExpenses');
    }

    /** Función para editar, solo muestra los tipos de gastos activos */
    public function edit(AdminExpenses $adminExpenses)
    {
        $typesAdminExpenses = TypeAdminExpenses::where('generalStatus_fk',1)->get();
        $categories = CategoryExpense::where('generalStatus_fk',1)->get();
        return view('AdminExpenses.editAdminExpenses',compact('adminExpenses','typesAdminExpenses','categories'));
    }

    /** Función para actualizar el gasto administrativo */
    public function update(Request $request, AdminExpenses $adminExpenses)
    {
        $user_id = Auth::user()->id;
        $adminExpenses->update([
            'amountDecimalExpenses'=> request('amount'),
            'dateAdminExpenses'=>request('dateExpense'),
            'commentAdminExpenses'=> request('comment'),
            'type_admin_expenses_fk'=> request('expensesType'),
            'user_fk' => $user_id
        ]);
        return redirect()->route('showAdminExpenses');
    }

    /** Función para eliminar un gasto administrativo */
    public function destroy(AdminExpenses $adminExpense)
    {
        $adminExpense->delete();
        return back(); 
    }
}
