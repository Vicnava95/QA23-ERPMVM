<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('new_dispatch', function () {
//    return view('DispachCenter/new_dispatch');
//});


//Route::get('dispatchcenter', function(){
//    return view('DispachCenter/dispatch_center');
//});
/** Los siguientes enlaces no requieren inicio de sesión */
// Formulario de Quote https://mvm-machinery.com/dashboard/public/Quote 
Route::get('Quote','QuoteRequestController@create')->name('quoteRequest');
Route::post('postQuoteRequest','QuoteRequestController@store')->name('postQuoteRequest');

//Conexión con API de Pipedrive
Route::get('createClientWeb/{nameForm}/{emailForm}/{phoneForm}/{addressForm}/{serviceForm}/{landingNameid}','ClientwebController@store')->name('clientWeb.store');

//Consulta de los permisos de un proyecto, requiere 
Route::get('MVM_Permits','PermitTicketController@loginClient')->name('loginClient');
Route::get('Permitupdates/{email}','PermitTicketController@dashboardClient')->name('dashboardPermit'); 

Route::get('reviewAPI/{id}','ContactController@reviewFunnelAPI')->name('reviewFunnelAPI');

//Formulario para que Marvin realice una renta de máquina
Route::get('Rental','RentRequestController@rentalClientForm')->name('rentalClientForm');
Route::get('getMachinerysRental','RentRequestController@showMachinery')->name('getMachinerysRental');
Route::post('postRentalForm','RentRequestController@storeRentalForm')->name('storeRentalForm');
Route::get('thankYouRental','RentRequestController@thankYouRental')->name('thankYouRental');

Auth::routes();

/************************ UPLOAD IMAGE ***********************************************/
Route::group(['middleware' => ['uploadImage']], function () {
    Route::get('example', function(){
        return view('example');
    });
    Route::get('/2', function(){return view('dashboard');})->name('dashboard2');
    Route::get('activeProjects2','ProjectController@activeProjects')->name('project.active2');
    Route::get('moreInfo2/{project}', 'ProjectController@moreInfoProject')->name('project.moreInfo2');
    Route::get('editDropzone2/{project}', 'ProjectController@editDropzone')->name('project.editDropzone2'); 
    Route::post('updateDrop2/{project}', 'ProjectController@updateDropzone')->name('project.updateDrop2');//Post
    Route::get('deleteFile2/{name}','ProjectController@deleteDropzone')->name('project.deleteDrop2');//Delete
    Route::get('deleteFileMoreInfo2/{project}/{name}','ProjectController@deleteDropzoneMoreInfo2')->name('project.deleteDropMoreInfo2');//Delete
});

/***************************** ADMIN *************************************************/
Route::middleware(['admin'])->group(function (){
    Route::get('/dashboard',function(){
        return view('dashboard');
    });

    Route::get('pdf', function(){
        return view('pdf');
    });

    //RUTA DEL DASHBOARD
    Route::get('/', function(){
        return view('dashboard');
    })->name('dashboard');

    //Ruta del SAVED
    Route::get('/saved',function(){
        return view('saved');
    });

    //Dropzone
    Route::get('dropzone/{project}', 'ProjectController@dropzone')->name('project.dropzone'); 
    Route::post('saveDrop/{project}', 'ProjectController@storeDropzone')->name('project.storeDrop');//Post
    Route::get('editDropzone/{project}', 'ProjectController@editDropzone')->name('project.editDropzone'); 
    Route::post('updateDrop/{project}', 'ProjectController@updateDropzone')->name('project.updateDrop');//Post
    Route::get('deleteFile/{name}','ProjectController@deleteDropzone')->name('project.deleteDrop');//Delete

    Route::get('deleteFileMoreInfo/{project}/{name}','ProjectController@deleteDropzoneMoreInfo')->name('project.deleteDropMoreInfo');//Delete

    //Create Zip
    Route::get('createZip1/{project}','ProjectController@createZip')->name('project.createZip');

    //RUTAS DEL MODULO DE PROJECT
    Route::get('showProjects','ProjectController@index')->name('project.index');
    Route::get('showProject/{id}', 'ProjectController@show')->name('project.show');
    Route::get('newProject', 'ProjectController@create')->name('project.create');//Responsive
    Route::post('saveProject', 'ProjectController@store')->name('project.store');//Post
    Route::get('infoClientNewProject/{id}','ProjectController@getInfoClient')->name('infoClientNewProject'); 
    Route::get('showPhases/{project}','ProjectController@showPhases')->name('project.showPhases');
    Route::get('editProject/{project}','ProjectController@edit')->name('project.edit');//Responsive
    Route::patch('updateProject/{project}','ProjectController@update')->name('project.update');//Patch
    Route::get('confirmProject/{project}','ProjectController@confirm')->name('project.confirm');//Responsive
    Route::delete('deleteProject/{project}/{idTruck}','ProjectController@destroy')->name('project.destroy');//Delete
    Route::get('chooseMainService/{project}','ProjectController@chooseMainService')->name('chooseMainService');
    //PROJECT TRACKER
    Route::get('projectTracker/{project}','ProjectController@projectTracker')->name('project.projectTracker');
    //MUESTRAN LOS PROYECTOS FILTRADOS Y LA INFORMACIÓN DETALLADA 
    Route::get('activeProjects','ProjectController@activeProjects')->name('project.active');
    Route::get('purchasesP/{id}', 'PurchaseController@findPurchases')->name('purchases.findPurchases');
    Route::get('moreInfo/{id1}', 'ProjectController@moreInfoProject')->name('project.moreInfo');
    //UPDATE STATUS
    Route::get('updateStatu/{project}/{id}','ProjectController@updateStatus')->name('project.updateStatu');
    //UPDATE FINISH DATE - PAUSED
    Route::get('updateFinishDate/{idProject}/{endDate}','ProjectController@updateEndDate')->name('project.updateFinishDate');
    //UPDATE FINISH DATE - FINISH STATUS
    Route::get('updateEndDateProject/{idProject}/{endDate}','ProjectController@updateEndDateProject')->name('project.updateEndDateProject');
    //Search Project
    Route::get('searchProjectD/{name}','ProjectController@fetchP')->name('project.searchProjectD');
    Route::get('searchProjectDaily/{name}','ProjectController@fetchProjectDaily')->name('project.searchProjectDaily');
    //Show Permits
    Route::get('showPermitDashboard/{idProject}','ProjectController@showPermit')->name('showPermitDashboard');
    //Comment Project
    Route::get('commentsProject/{project}','ProjectController@commentsProject')->name('commentsProject');
    Route::get('updateCommentsProject/{idComment}','ProjectController@updateCommentsProject')->name('updateCommentsProject');
    Route::get('deleteCommentsProject/{idComment}','ProjectController@deleteCommentsProject')->name('deleteCommentsProject'); 
    //Document Projects
    Route::get('uploadFileDocumentProject/{project}','ProjectController@uploadFileDocument')->name('uploadFileDocument');
    Route::post('dropzoneFileDocument/{project}','ProjectController@dropzoneFileDocument')->name('dropzoneFileDocument');
    Route::get('dropzoneFileDocumentDelete/{name}','ProjectController@dropzoneFileDocumentDelete')->name('dropzoneFileDocumentDelete');
    Route::get('deleteFileDocumentProject/{idFile}','ProjectController@deleteFileDocumentProject')->name('deleteFileDocumentProject');
    //Get Images
    Route::get('getImagesProject/{project}','CategoryController@getGallery')->name('getGallery');
    Route::get('getImagesDalilyReport/{dailyReport}','CategoryController@getDailyReportGallery')->name('getDailyReportGallery');
    Route::get('getPaymentsGallery/{project}','CategoryController@getPaymentsGallery')->name('getPaymentsGallery');
    
    //Timeline
    Route::get('addImageTimeLine/{idPro}/{idTimeLine}','TimeLineProjectWorkController@addMoreImageTimeLine')->name('addMoreImageTimeLine');
    Route::get('addTimelineProject/{project}','TimeLineProjectWorkController@addTimelineProject')->name('addTimelineProject');
    Route::get('updateTimeLineProject/{idTimeLine}','TimeLineProjectWorkController@updateTimeLine')->name('updateTimeLineProject');
    Route::get('deleteTimeLineProject/{idTimeLine}','TimeLineProjectWorkController@deleteTimeLine')->name('deleteTimeLineProject');
    Route::post('dropzoneFileDocumentToDo/{idTimeLine}','ToDoListImageController@dropzoneUploadToDoImage')->name('dropzoneUploadToDoImage');
    Route::get('dropzoneFileDocumentDeleteToDo/{name}','ToDoListImageController@dropzoneUploadToDoImageDelete')->name('dropzoneUploadToDoImageDelete');
    Route::get('deleteFileDocumentProjectToDo/{idImageToDo}','ToDoListImageController@deleteUploadToDoImage')->name('deleteUploadToDoImage');

    //DASHBOARD PROJECT
    Route::get('/dashboardProject',function(){
        return view('Project.dashboardProject');
    });
    //PROJECT TRACKER
    /* Route::get('/projectTracker',function(){
        return view('Project.projectTracker');
    }); */
    Route::get('addHomeDepotLocation/{project}','ProjectController@addHomeDepotLocation')->name('addHomeDepotLocation');

    //RUTAS CRUD DE FASES
    Route::get('showphases/{project}','ProjectPhaseController@index')->name('phase.index');
    Route::get('showphase/{project}/{phase}','ProjectPhaseController@show')->name('phase.show');
    Route::get('newPhase/{project}', 'ProjectPhaseController@create')->name('phase.create');
    Route::get('savePhase/{project}', 'ProjectPhaseController@store')->name('phase.store');
    Route::get('editPhase/{project}/{phase}','ProjectPhaseController@edit')->name('phase.edit');
    Route::get('updatePhase/{phase}','ProjectPhaseController@update')->name('phase.update');
    Route::get('confirmPhase/{project}/{phase}','ProjectPhaseController@confirm')->name('phase.confirm');
    Route::get('deletePhase/{phase}','ProjectPhaseController@destroy')->name('phase.destroy');
    Route::get('getPhasesAjax/{id}','ProjectPhaseController@addMorePhasesAjax')->name('phase.addAjax');

    //RUTAS DEL MODULO DE PURCHASES
    Route::get('showPurchases','PurchaseController@index')->name('purchase.index');
    Route::get('showPurchases/{id}/{flag}','PurchaseController@show')->name('purchase.show');
    Route::get('allPurchases','PurchaseController@allPurchases')->name('allPurchases');
    Route::get('newPurchase', 'PurchaseController@create')->name('purchase.create');
    //Route::post('autocomplete/fetch', 'PurchaseController@fetch')->name('purchase.getProjects');
    Route::get('autocomplete/fetch/{name}', 'PurchaseController@fetch')->name('purchase.getProjects');
    //Route::post('getphases', 'PurchaseController@getPhases')->name('purchase.getPhases');
    Route::get('getphases/{id}', 'PurchaseController@getPhases')->name('purchase.getPhases');
    //Route::post('getcategories', 'PurchaseController@getcategories')->name('purchase.getcategories');
    Route::get('getcategories', 'PurchaseController@getcategories')->name('purchase.getcategories');
    Route::post('savePurchase', 'PurchaseController@store')->name('purchase.store');
    Route::get('editPurchases/{purchase}/{flag}','PurchaseController@edit')->name('purchase.edit');
    Route::patch('updatePurchases/{purchase}/{flag}','PurchaseController@update')->name('purchase.update');
    Route::get('confirmPurchase/{purchase}/{flag}','PurchaseController@confirm')->name('purchase.confirm');
    Route::delete('deletePurchase/{purchase}/{flag}','PurchaseController@destroy')->name('purchase.destroy');
    //Add purchase from projects
    Route::get('morePurchase/{project}', 'PurchaseController@createPurchase')->name('purchase.morePurchase');
    Route::post('saveMorePurchase', 'PurchaseController@storePurchase')->name('purchase.storePurchase');

    //Filter Purchases x Project
    Route::get('filterPurchase','PurchaseController@filterPurchases')->name('purchase.filter');
    Route::get('purchasesXProject/{id}','PurchaseController@purchaseXProject')->name('purchase.purchaseXProject');

    //Reports
    //Route::get('reports/{first_date}/{end_date}','ReportController@showReport')->name('reports');
    Route::get('dates','ReportController@sendDates')->name('sendDates');
    Route::get('reports','ReportController@showReport')->name('reports');
    Route::get('reportsThisMonth/{sDate}/{eDate}/{flag}','ReportMonthController@showReportMonth')->name('reportsThisMonth');
    Route::get('reportsLastMonth/{sDate}/{eDate}/{flag}','ReportMonthController@showReportMonth')->name('reportsLastMonth');
    Route::get('reportsThisWeek/{sDate}/{eDate}/{flag}','ReportWeekController@showWeek')->name('reportsSameWeek');
    Route::get('reportsLastWeek/{sDate}/{eDate}/{flag}','ReportWeekController@showWeek')->name('reportsLastWeek');
    Route::get('reportsDays/{sDate}/{eDate}/{flag}','ReportWeekController@showWeek')->name('reportsDays');
    Route::get('reportsToday/{day}/{flag}','ReportTodayController@showDay')->name('reportsToday');
    Route::get('reportsOneDay/{day}/{flag}','ReportTodayController@showDay')->name('reportsOneDay');

    //Reports Payroll
    Route::get('payrollToday/{sDate}/{eDate}/{flag}','PayrollReportDatesController@payrollDates')->name('payrollToday');
    Route::get('payrollThisWeek/{sDate}/{eDate}/{flag}','PayrollReportDatesController@payrollDates')->name('payrollThisWeek');
    Route::get('payrollLastWeek/{sDate}/{eDate}/{flag}','PayrollReportDatesController@payrollDates')->name('payrollLastWeek');
    Route::get('payrollOneDay/{sDate}/{eDate}/{flag}','PayrollReportDatesController@payrollDates')->name('payrollOneDay');
    Route::get('payrollDays/{sDate}/{eDate}/{flag}','PayrollReportDatesController@payrollDates')->name('payrollDays');

    Route::get('payrollThisMonth/{sDate}/{eDate}/{flag}','PayrollReportMonthController@payrollWeeks')->name('payrollThisMonth');
    Route::get('payrollLastMonth/{sDate}/{eDate}/{flag}','PayrollReportMonthController@payrollWeeks')->name('payrollLastMonth');

    //Reportes de proyectos
    Route::get('/reportProjects/{flag}','ReportProjects@report')->name('reportProjects');

    //Dropzone Image Daily Report
    /* Route::get('payrollFiles','PayrollReportDatesController@showPayrollFiles')->name('payrollFiles');
    Route::post('payrollFilesPost','PayrollReportDatesController@postPayrollFiles')->name('payrollFilesPost');
    Route::get('payrollStoreImage','PayrollReportDatesController@postPayrollImages')->name('payrollStoreImage'); */

    //ClientWeb - CRUD
    route::get('clientsWeb','ClientwebController@index')->name('clientsweb'); 
    route::get('newClientweb', 'ClientwebController@create')->name('clientswebCreate'); 
    route::post('storeClientwebERP','ClientwebController@storeERP')->name('clientswebStoreERP'); 
    route::get('editClientweb/{client}','ClientwebController@edit')->name('clientwebEdit');
    route::get('updateClientweb/{client}','ClientwebController@update')->name('clientwebUpdate'); 
    route::get('deleteClientweb/{client}','ClientwebController@delete')->name('clientwebDelete');
    route::get('destroyClientweb/{client}','ClientwebController@destroy')->name('clientwebDestroy');
    route::get('serviceLanding/{id}','ClientwebController@servicesLanding')->name('servicesLanding'); 
    route::get('searchClient/{name}','ClientwebController@searchClient')->name('searchClient');
    route::get('searchClientFromProject/{name}','ClientwebController@searchClientFromProject')->name('searchClientFromProject');
    route::get('showClient/{id}','ClientwebController@showClient')->name('showClient');
    Route::get('showFormClient','ClientwebController@showFormClient')->name('showFormClient');

    //PERMITS
    Route::get('getProject/{name}','PermitTicketController@fetch')->name('ticketgetProjects');
    Route::get('getClient/{name}','PermitTicketController@fetchClient')->name('ticketgetClients');
    Route::get('getInfoClient/{id}','PermitTicketController@clients')->name('ticketgetClients');
    Route::get('getServices/{id}','PermitTicketController@services')->name('getServices');
    Route::get('newPermit', 'PermitTicketController@create')->name('newPermit'); 
    Route::post('storePermit','PermitTicketController@store')->name('ticketStore');
    Route::get('permits','PermitTicketController@index')->name('showPermits');
    Route::get('updateStage/{idPermitTicket}/{id}','PermitTicketController@updateStage')->name('updateStage'); 
    Route::get('infoPermit/{idPermitTicket}', 'PermitTicketController@show')->name('infoPermit');
    Route::patch('updateComments/{permitTicket}','PermitTicketController@updateComents')->name('updateComments');
    Route::get('updateCheckBox/{idDocument}/{val}','PermitTicketController@updateCheckBoxDocument')->name('updateCheckBox');
    Route::get('allPermits','PermitTicketController@allPermits')->name('allPermits'); 
    Route::get('editPermit/{permitTicket}/{flag}', 'PermitTicketController@edit')->name('editPermit');
    Route::patch('updatePermit/{permitTicket}/{flag}','PermitTicketController@update')->name('updatePermit'); 
    Route::get('deletePermit/{permitTicket}','PermitTicketController@delete')->name('deletePermit'); 
    Route::delete('destroyPermit/{permitTicket}','PermitTicketController@destroy')->name('destroyPermit'); 
    Route::get('dropzonePermit/{permitTicket}', 'PermitTicketController@dropzonePermit')->name('dropzonePermit'); 
    Route::post('dropzonePermitStore/{permitTicket}', 'PermitTicketController@dropzoneStore')->name('dropzonePermitStore'); 
    Route::get('dropzonePermitDelete/{name}','PermitTicketController@destroyDropzone')->name('dropzoneDestroy');
    Route::get('deleteDocumenhtPermit/{permitTicket}/{name}','PermitTicketController@destroyDocument')->name('destroyDocument');
    Route::get('deleteDocumenhtPermitBack/{permitTicket}/{name}','PermitTicketController@destroyDocumentBack')->name('destroyDocumentBack');
    Route::get('updateTicket/{permitTicket}','PermitTicketController@updateTicket')->name('updateTicket'); 
    //Create ticket from project
    Route::get('createTicketProject/{project}','PermitTicketController@createTicketProject')->name('createTicketProject'); 
    //Show permits with Ajax
    Route::get('getPermitsAjax/{name}','PermitTicketController@showPermitInfo')->name('getPermitsAjax');
    Route::get('getIdProject/{idProject}','PermitTicketController@getIdProject')->name('getIdProject'); 
    //Update and Delete comments ticket in timeline
    Route::get('editTimeLine/{idComment}','PermitTicketController@editTimeLine')->name('editTimeLine');
    Route::patch('updateTimeLine/{idComment}','PermitTicketController@updateTimeLine')->name('updateTimeLine');
    Route::get('destroyTimeLine/{idComment}','PermitTicketController@destroyTimeLine')->name('destroyTimeLine');
    //First Comment
    Route::get('firstComment/{permitTicket}','PermitTicketController@firstComment')->name('firstComment');
    //Last Comment
    Route::get('lastComment/{permitTicket}','PermitTicketController@lastComment')->name('lastComment');

    /******* START UPLOAD DOCUMENTS ***********************/
    Route::get('docDropzoneQuoteInformation/{permitTicket}/{value}', 'PermitTicketController@dropzonePermitQuoteInformation')->name('docDropzoneQuoteInformation'); 
    Route::post('docDropzoneQuoteInformationStore/{permitTicket}/{value}', 'PermitTicketController@dropzoneStoreQuoteInformation')->name('docDropzoneQuoteInformationStore'); 
    Route::get('docDropzoneQuoteInformationDelete/{name}','PermitTicketController@destroyDropzoneQuoteInformation')->name('docDropzoneQuoteInformationDelete');
    /******* END UPLOAD DOCUMENTS ********************/

    //Mail Center
    Route::get('createDocumentMail/{idDocument}/{permitId}','MailController@create')->name('createDocumentMail');
    Route::post('storeDocumentMail/{idDocument}/{permitId}','MailController@store')->name('storeDocumentMail');
    Route::get('editDocumentMail/{idDocument}/{permitId}/{idMail}','MailController@edit')->name('editDocumentMail'); 
    Route::patch('updateDocumentMail/{permitId}/{idMail}','MailController@update')->name('updateDocumentMail');
    Route::get('deleteDocumentMail/{idDocument}/{permitId}/{idMail}','MailController@delete')->name('deleteDocumentMail');
    Route::delete('destroyDocumentMail/{permitId}/{idMail}','MailController@destroy')->name('destroyDocumentMail');
    Route::get('dropzoneDocumentMail/{idDocument}/{permitId}/{idMail}','MailController@dropzone')->name('dropzoneDocumentMail');
    Route::post('dropzoneStoreDocumentMail/{idMail}', 'MailController@dropzoneStore')->name('dropzoneStoreDocumentMail');
    Route::get('dropzoneDeleteDocumentMail/{name}','MailController@dropzoneDestroy')->name('dropzoneDeleteDocumentMail');
    Route::get('documentMailDelete/{permitId}/{id}','MailController@documentMailDestroy')->name('documentMailDelete');

    //Contacts
    Route::get('allContacts','ContactProjectController@index')->name('allContacts'); 
    Route::get('searchBarContact/{name}','ContactProjectController@searchClient')->name('searchBarContact');
    Route::get('editContactweb/{client}','ContactProjectController@edit')->name('contactWebEdit');
    Route::get('updateContactweb/{client}','ContactProjectController@update')->name('contactWebUpdate'); 
    Route::get('deleteContactweb/{client}','ContactProjectController@delete')->name('contactWebDelete');
    Route::get('destroyContactweb/{client}','ContactProjectController@destroy')->name('contactWebDestroy');

    //AdminExpenses
    Route::get('dashboardAdminExpenses','AdminExpensesController@dashboard')->name('dashboardAdminExpenses');
    Route::get('showAdminExpenses','AdminExpensesController@index')->name('showAdminExpenses');
    Route::get('createAdminExpenses','AdminExpensesController@create')->name('createAdminExpenses');
    Route::post('storeAdminExpenses','AdminExpensesController@store')->name('storeAdminExpenses');
    Route::get('getCategoriesExpenses/{id}','AdminExpensesController@getcategories')->name('getCategoriesExpenses');
    Route::get('getCate','AdminExpensesController@getcate')->name('getCate');
    Route::get('editAdminExpenses/{adminExpenses}','AdminExpensesController@edit')->name('editAdminExpenses');
    Route::patch('updateAdminExpenses/{adminExpenses}','AdminExpensesController@update')->name('updateAdminExpenses'); 
    Route::get('destroyAdminExpenses/{adminExpense}','AdminExpensesController@destroy')->name('destroyAdminExpenses');

    Route::get('dropzoneAdminExpenses/{idAdminExpense}','AdminExpensesImageController@dropzone')->name('dropzoneAdminExpenses');
    Route::post('dropzoneStoreAdminExpenses/{idAdminExpense}', 'AdminExpensesImageController@dropzoneStore')->name('dropzoneStoreAdminExpenses');
    Route::get('dropzoneDeleteAdminExpenses/{name}','AdminExpensesImageController@dropzoneDestroy')->name('dropzoneDeleteAdminExpenses');
    Route::get('deleteAdminImage/{id}','AdminExpensesImageController@adminImageDestroy')->name('deleteAdminImage');

    //TypeAdminExpenses
    Route::get('showTypeAdminExpenses','TypeAdminExpensesController@index')->name('showTypeAdminExpenses');
    Route::get('changeStatusAdmin/{idType}/{value}','TypeAdminExpensesController@changeStatus')->name('changeStatusAdmin');
    Route::post('updateTypeAdminExpenses','TypeAdminExpensesController@update')->name('updateTypeAdminExpenses');
    Route::post('storeTypeAdminExpenses','TypeAdminExpensesController@store')->name('storeTypeAdminExpenses');
    Route::get('destroyTypeAdminExpenses/{idType}','TypeAdminExpensesController@destroy')->name('destroyTypeAdminExpenses');

    //To Do List
    Route::get('storeToDoProject/{idProject}','TodolistController@store')->name('storeToDoProject');
    Route::get('deleteToDoProject/{idToDoProject}','TodolistController@destroy')->name('deleteToDoProject'); 
    Route::get('changeStatusToDoProject/{idToDoProject}/{value}','TodolistController@changeStatusToDo')->name('changeStatusToDo');
    Route::get('updateToDoProject/{idToDo}','TodolistController@update')->name('updateToDoProject');

    //SMS
    Route::get('smsDashboard','ClientwebController@smsDashboard')->name('smsDashboard');
    Route::get('sendSmsPoolDemoLead/{flag}/{numberPhone}','PermitTicketController@sendSmsPoolDemoLead')->name('sendSmsPoolDemoLead');
    Route::get('sendSmsEquipmentRental/{flag}/{numberPhone}','PermitTicketController@sendSmsEquipmentRental')->name('sendSmsEquipmentRental');
    Route::get('sendSmsEstimateRequest/{flag}/{numberPhone}','PermitTicketController@sendSmsEstimateRequest')->name('sendSmsEstimateRequest');

    //Daily Report
    Route::get('dailyReport','ProjectContactController@index')->name('dailyReport');
    Route::post('postDailyReport','ProjectContactController@postDaily')->name('postDailyReport');
    Route::get('activeDailyReport','ProjectContactController@activeDailyReport')->name('activeDailyReport'); 
    Route::get('allDailyReport','ProjectContactController@allDailyReport')->name('allDailyReport'); 
    Route::get('statusDailyReport/{dailyReport}','ProjectContactController@statusDailyReport')->name('statusDailyReport');
    Route::get('editDailyReport/{dailyReport}','ProjectContactController@editDailyReport')->name('editDailyReport');
    Route::post('updateDailyReport/{dailyReport}','ProjectContactController@updateDaily')->name('updateDailyReport');
    Route::get('deleteDailyReport/{dailyReport}','ProjectContactController@deleteDailyReport')->name('deleteDailyReport');
    Route::get('showPhasesListAjax/{projectId}','ProjectContactController@showPhasesList')->name('showPhasesListAjax');
    Route::get('showPhasesListEditAjax/{projectId}/{dailyReportId}','ProjectContactController@showPhasesListEdit')->name('showPhasesListEditAjax');

    Route::post('postImageDailyReport/{dailyReport}','ProjectContactController@dropzoneDailyImage')->name('postImageDailyReport');
    Route::delete('dropzoneImageDailyReportDelete/{name}','ProjectContactController@dropzoneFileDocumentDelete')->name('dropzoneImageDailyReportDelete');
    Route::get('dropzoneImageDailyReportMoreInfo/{name}','ProjectContactController@dropzoneFileDocumentDeleteMoreInfo')->name('dropzoneImageDailyReportDeleteMoreInfo');
    //Route::get('searchBarContact/{name}','ContactProjectController@searchClient')->name('searchBarContact');

    //General Settings
    Route::get('generalSettingsMenu','GeneralSettingsController@menu')->name('menuSettings');

    // CRUD MANAGER
    Route::get('showManagers','GeneralSettingsController@showManager')->name('showManagers');
    Route::get('storeManager','GeneralSettingsController@storeManager')->name('storeManager');
    Route::get('updateManager','GeneralSettingsController@updateManager')->name('updateManager');
    Route::get('changeStatusManager/{idType}/{value}','GeneralSettingsController@changeStatusManager')->name('changeStatusManager');

    // CRUD CATEGORIE
    Route::get('showCategories','GeneralSettingsController@showCategory')->name('showCategories');
    Route::get('storeCategorie','GeneralSettingsController@storeCategorie')->name('storeCategorie');
    Route::get('updateCategorie','GeneralSettingsController@updateCategorie')->name('updateCategorie');
    Route::get('changeStatusCategorie/{idType}/{value}','GeneralSettingsController@changeStatusCategorie')->name('changeStatusCategorie');

    // CRUD PROJECT TYPES
    Route::get('showProjectTypes','GeneralSettingsController@showProjectType')->name('showProjectTypes');
    Route::get('storeProjectType','GeneralSettingsController@storeProjectType')->name('storeProjectType');
    Route::get('updateProjectType','GeneralSettingsController@updateProjectType')->name('updateProjectType');
    Route::get('changeStatusProjectType/{idType}/{value}','GeneralSettingsController@changeStatusProjectType')->name('changeStatusProjectType');

    // CRUD STATUS
    Route::get('showStatus','GeneralSettingsController@showStatus')->name('showStatus');
    Route::get('storeStatus','GeneralSettingsController@storeStatus')->name('storeStatus');
    Route::get('updateStatus','GeneralSettingsController@updateStatus')->name('updateStatus');
    Route::get('changeStatusStatus/{idType}/{value}','GeneralSettingsController@changeStatusStatus')->name('changeStatusStatus');
    
    // CRUD SERVICES
    Route::get('showService','GeneralSettingsController@showServices')->name('showServices');
    Route::get('storeService','GeneralSettingsController@storeService')->name('storeService');
    Route::get('updateService','GeneralSettingsController@updateService')->name('updateService');
    Route::get('changeStatusService/{idType}/{value}','GeneralSettingsController@changeStatusService')->name('changeStatusService');

    // CRUD CATEGORY PURCHASE
    Route::get('showCategoryPurchase','GeneralSettingsController@showCategoryPurchases')->name('showCategoryPurchases');
    Route::get('storeCategoryPurchase','GeneralSettingsController@storeCategoryPurchase')->name('storeCategoryPurchase');
    Route::get('updateCategoryPurchase','GeneralSettingsController@updateCategoryPurchase')->name('updateCategoryPurchase');
    Route::get('changeStatusCategoryPurchase/{idType}/{value}','GeneralSettingsController@changeStatusCategoryPurchase')->name('changeStatusCategoryPurchase');

    // CRUD LABOR
    Route::get('showLaborCrud','GeneralSettingsController@showLaborCruds')->name('showLaborCruds');
    Route::get('storeLaborCrud','GeneralSettingsController@storeLaborCrud')->name('storeLaborCrud');
    Route::get('changeStatusDalilyLabor/{idType}/{value}','GeneralSettingsController@changeStatusDalilyLabor')->name('changeStatusDalilyLabor');

    //PAYMENTS
    Route::get('postPayments/{projectId}','PaymentController@store')->name('paymentStore');
    Route::get('updatePayments/{paymentId}','PaymentController@update')->name('paymentUpdate');
    Route::get('deletePayments/{paymentId}','PaymentController@destroy')->name('paymentDestroy');
    Route::get('uploadImagePayment/{paymentId}','PaymentController@uploadImagePayment')->name('uploadImagePayment');
    Route::post('dropzonePaymentImage/{paymentId}','PaymentController@dropzonePaymentImage')->name('dropzonePaymentImage');
    Route::get('dropzonePaymentImageDelete/{name}','PaymentController@dropzonePaymentImageDelete')->name('dropzonePaymentImageDelete');


    //RUTA DE LA CALCULADORA
    Route::get('calculator',function(){
        return view('calculator');
    })->name('calculator.index');

    //Route::get('dashboard', function(){
    //    return view('DispachCenter/daily_delivery_dashboard');
    //});

    // START - RUTAS DEL DISPATCH VICTOR  -------------------------------------------------------

    Route::get('/dispatchcenter', 'Calendar_Controller@index')->name('dispatchcenter');
    Route::get('/getClientRental/{name}','RentRequestController@getClientRental')->name('getClientRental');
    Route::get('/infoClientRental/{id}','RentRequestController@infoClientRental')->name('infoClientRental'); 
    Route::get('/new_dispatch', 'RentRequestController@index')->name('new_dispatch');
    Route::post('/save', 'RentRequestController@store')->name('saveDispatch');
    Route::get('/updatePaymentRental/{idRenta}/{status}','RentRequestController@paymentStatus')->name('paymentStatus');
    Route::get('/allRentals','RentRequestController@allRentals')->name('allRentals');
    Route::get('showAllRentalForms','RentRequestController@showAllRentalForms')->name('showAllRentalForms');
    Route::get('editRentalForm/{rental}','RentRequestController@editRentalForm')->name('editRentalForm');
    Route::get('updateRentalForm/{rental}','RentRequestController@updateRentalForm')->name('updateRentalForm');
    Route::get('deleteRentalForm/{rental}','RentRequestController@deleteRentalForm')->name('deleteRentalForm');
    Route::get('printPDF/{rental}','RentRequestController@showPDF')->name('printPDF');
    Route::get('/recordingPickup','RentRequestController@recordingPickup')->name('recordingPickup');
    //DELIVER
    Route::get('/updatedelivered/{id}','Calendar_Controller@updatedelivered')->name('updateDelivered');
    Route::get('/updatePending/{id}','Calendar_Controller@updatePending')->name('udpatePending');

    // END -  RUTAS DEL DISPATCH VICTOR  --------------------------------------------------------

    //REDIRECCIONES

    Route::get('delivery_data', function(){
        return view('DispachCenter/data_machinery_input');
    });

    Route::get('contract', function(){
        return view('DispachCenter/document_contract');
    });

        Route::get('deliver2',function (){ 
        return view('DispachCenter/pickup_machinery');
    });

    Route::get('index1',function (){
        return view('DispachCenter/test_toggle');
    });

    //Route::get('/new_dispatch', function(){
    //    return view('DispachCenter/rent_requets');
    //});

    Route::get('form', function(){
        return view('DispachCenter/form_beta');
    });

    Route::get('/calendar', function(){
        return view('EquipmentCalendar/equipment_calendar');
    });

    //Route::get('table', function(){
    //    return view('dataTable');
    //});
    //POST
    Route::post('/store_delivery','delivery_driver@store');

    Route::post('/updated','Update_Dispatch@update_rental');
    //INDEX

    Route::get('/update/{id}', 'Update_Dispatch@index');// localhost:8000/

    //Route::get('/', 'RentRequestController@index'); // localhost:8000/

    Route::resource('renta', 'RentRequestController');

    Route::get('/table','delivery_driver@index');

    //ROUTES WITH AJAX
    Route::get('/date_confirm/{date}','Calendar_Controller@getAjax');

    Route::get('/delete_dispatch/{id}/{flag}','Calendar_Controller@destroy');
    //  PICKUP
    Route::get('/update_pickup/{id}','Calendar_Controller@updatePickup');
    Route::get('/pending_pickup/{id}','Calendar_Controller@updatePending_pickup');

    Route::get('/agreement','Rental_Agreement_Controller@rental_customer_data');

    //DOCUMENT SIGNATURE
    Route::get('/sign/{id}','Rental_Agreement_Controller@signature');
    Route::match(['get', 'post'], '/save/signature', 'Rental_Agreement_Controller@save_signature');
});




