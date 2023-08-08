<?php

namespace App\Http\Controllers;

use App\TypeAdminExpenses;
use App\CategoryExpense;
use Illuminate\Http\Request;

class TypeAdminExpensesController extends Controller
{
    /** Se muestran todos los tipos de gastos administrativos sin importar su estado  */
    public function index()
    {
        $typesExpenses = TypeAdminExpenses::orderBy('categoryExpenses_fk','asc')
                        ->orderBy('nameTypeAdminExpenses','asc')
                        ->get();
        $categories = CategoryExpense::where('generalStatus_fk',1)->get();
        return view('TypeExpense.showTypeExpenses', compact('typesExpenses','categories'));
    }

    /** Se cambia de estado de un tipo de gasto activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatus($idType, $value){
        $typeAdmin = TypeAdminExpenses::find($idType);
        $typeAdmin->update([
            'generalStatus_fk' => $value
        ]);
        $typeAdmin->save();
    }

    /** Función para almacenar un nuevo de tipo de gasto administrativo, se almacena activo */
    public function store(Request $request)
    {
        //dd(request()); 
        $typeAdmin = TypeAdminExpenses::create([
            'nameTypeAdminExpenses' => request('nameType'),
            'categoryExpenses_fk' => request('category'),
            'generalStatus_fk' => 1
        ]);
        $typeAdmin->save();
        return back();
    }

    /** Función para actualizar el nombre del tipo de gasto administrativo */
    public function update(Request $request)
    {
        $idTypeAdmin = request('idTypeEdit');
        $typeAdmin = TypeAdminExpenses::find($idTypeAdmin);
        $typeAdmin->update([
            'nameTypeAdminExpenses' => request('nameTypeEdit'),
            'categoryExpenses_fk' => request('category')
        ]);
        $typeAdmin->save(); 
        return back();
    }

    /** Función para eliminar un tipo de gasto administrativo */
    public function destroy($idType)
    {
        $typeAdmin = TypeAdminExpenses::find($idType);
        $typeAdmin->delete(); 
        return back();
    }
}
