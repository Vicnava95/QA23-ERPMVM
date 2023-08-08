<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Manager;
use App\Category;
use App\ProjectType;
use App\Status;
use App\Service;
use App\PurchaseCategory;
use Illuminate\Http\Request;


class GeneralSettingsController extends Controller
{

    public function menu()
    {
        return view('GeneralSettings.menuSettings');
    }

    /********************** MANAGER *******************/
    public function showManager(){
        $managers = Manager::all();
        return view('GeneralSettings.showManager',compact('managers'));
    }

    /** Función para almacenar un nuevo manager, se almacena activo */
    public function storeManager(Request $request)
    {
        $manager = Manager::create([
            'name_manager' => request('nameManager'),
            'generalStatus' => 1
        ]);
        $manager->save();
        return back();
    }

    /** Función para actualizar el nombre del manager */
    public function updateManager(Request $request)
    {
        $idManager = request('idManager');
        $manager = Manager::find($idManager);
        $manager->update([
            'name_manager' => request('editManager'),
        ]);
        $manager->save(); 
        return back();
    }

    /** Se cambia de estado de un manager activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusManager($idType, $value){
        $manager = Manager::find($idType);
        $manager->update([
            'generalStatus' => $value
        ]);
        $manager->save();
    }

    /********************** CATEGORIES *******************/
    public function showCategory(){
        $categories = Category::all();
        return view('GeneralSettings.showCategorie',compact('categories'));
    }

    /** Función para almacenar una nueva categoria, se almacena activo */
    public function storeCategorie(Request $request)
    {
        $category = Category::create([
            'name_category' => request('nameCategory'),
            'generalStatus' => 1
        ]);
        $category->save();
        return back();
    }

    /** Función para actualizar el nombre de la categoria */
    public function updateCategorie(Request $request)
    {
        $idCategory = request('idCategory');
        $category = Category::find($idCategory);
        $category->update([
            'name_category' => request('editCategory'),
        ]);
        $category->save(); 
        return back();
    }

    /** Se cambia de estado de una categoria activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusCategorie($idType, $value){
        $category = Category::find($idType);
        $category->update([
            'generalStatus' => $value
        ]);
        $category->save();
    }

    /********************** PROJECT TYPES *******************/
    public function showProjectType(){
        $projects = ProjectType::all();
        return view('GeneralSettings.showProjectType',compact('projects'));
    }

    /** Función para almacenar una tipo de proyecto, se almacena activo */
    public function storeProjectType(Request $request)
    {
        $project = ProjectType::create([
            'name_project_type' => request('nameProject'),
            'generalStatus' => 1
        ]);
        $project->save();
        return back();
    }

    /** Función para actualizar el nombre del tipo de proyecto */
    public function updateProjectType(Request $request)
    {
        $idProject = request('idProject');
        $project = ProjectType::find($idProject);
        $project->update([
            'name_project_type' => request('editProject'),
        ]);
        $project->save(); 
        return back();
    }

    /** Se cambia de estado de un tipo de proyecto activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusProjectType($idType, $value){
        $project = ProjectType::find($idType);
        $project->update([
            'generalStatus' => $value
        ]);
        $project->save();
    }

    /********************** STATUS *******************/
    public function showStatus(){
        $status = Status::all();
        return view('GeneralSettings.showStatus',compact('status'));
    }

    /** Función para almacenar un nuevo status, se almacena activo */
    public function storeStatus(Request $request)
    {
        $statu = Status::create([
            'name_status' => request('nameStatu'),
            'generalStatus' => 1
        ]);
        $statu->save();
        return back();
    }

    /** Función para actualizar el nombre de la categoria */
    public function updateStatus(Request $request)
    {
        $idStatu = request('idStatu');
        $statu = Status::find($idStatu);
        $statu->update([
            'name_status' => request('editStatu'),
        ]);
        $statu->save(); 
        return back();
    }

    /** Se cambia de estado de una categoria activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusStatus($idType, $value){
        $statu = Status::find($idType);
        $statu->update([
            'generalStatus' => $value
        ]);
        $statu->save();
    }

    /********************** SERVICES *******************/
    public function showServices(){
        $services = Service::all();
        return view('GeneralSettings.showService',compact('services'));
    }

    /** Función para almacenar un nuevo servicio, se almacena activo */
    public function storeService(Request $request)
    {
        $service = Service::create([
            'name_service' => request('nameService'),
            'generalStatus' => 1
        ]);
        $service->save();
        return back();
    }

    /** Función para actualizar el nombre de un servicio */
    public function updateService(Request $request)
    {
        $idService = request('idService');
        $service = Service::find($idService);
        $service->update([
            'name_service' => request('editService'),
        ]);
        $service->save(); 
        return back();
    }

    /** Se cambia de estado de un servicio activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusService($idType, $value){
        $service = Service::find($idType);
        $service->update([
            'generalStatus' => $value
        ]);
        $service->save();
    }

    /********************** CATEGORY PURCHASE *******************/
    public function showCategoryPurchases(){
        $purchases = PurchaseCategory::where('type_category',null)->get();
        return view('GeneralSettings.showCategoryPurchase',compact('purchases'));
    }

    /** Función para almacenar una nueva categoria de compra, se almacena activo */
    public function storeCategoryPurchase(Request $request)
    {
        $purchaseCategory = PurchaseCategory::create([
            'name_category' => request('nameCategoryPurchase'),
            'color' => request('nameCategoryColor'),
            'generalStatus' => 1
        ]);
        $purchaseCategory->save();
        return back();
    }

    /** Función para actualizar el nombre de una categoria de compra */
    public function updateCategoryPurchase(Request $request)
    {
        //dd($request);
        $idPurchase = request('idPurchase');
        $purchase = PurchaseCategory::find($idPurchase);
        $purchase->update([
            'name_category' => request('editPurchase'),
            'color' => request('editCategoryColor'),
        ]);
        $purchase->save(); 
        return back();
    }

    /** Se cambia de estado de una categoria de compra activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusCategoryPurchase($idType, $value){
        $purchase = PurchaseCategory::find($idType);
        $purchase->update([
            'generalStatus' => $value
        ]);
        $purchase->save();
    }

    /********************** LABOR *******************/
    public function showLaborCruds(){
        $purchases = PurchaseCategory::where('type_category','labor')->get();
        return view('GeneralSettings.showLabor',compact('purchases'));
    }

    /** Función para almacenar una nueva categoria de compra, se almacena activo */
    public function storeLaborCrud(Request $request)
    {
        $purchaseCategory = PurchaseCategory::create([
            'name_category' => request('nameCategoryPurchase'),
            'color' => request('nameCategoryColor'),
            'generalStatus' => 1,
            'type_category' => 'labor',
            'showDailyReport' => 1,
        ]);
        $purchaseCategory->save();
        return back();
    }

    /** Se cambia de estado de una categoria de compra activando el tooltip switch, la función se realiza por medio de AJAX */
    public function changeStatusDalilyLabor($idType, $value){
        $purchase = PurchaseCategory::find($idType);
        $purchase->update([
            'showDailyReport' => $value
        ]);
        $purchase->save();
    }

}
