    function showData(value){
        if (value == 1) {
            const data = $('.dataFinance');
            const dataX = $('.dataFinanceX');
            const dataExpense = $('.expenseList');
            const dataExpenseX = $('.expenseListX');
            $('#example_wrapper').hide();
            $('#exampleX_wrapper').show();
            data.hide();
            dataX.show();
            dataExpense.hide();
            dataExpenseX.show();

        } else {
            const data = $('.dataFinance');
            const dataX = $('.dataFinanceX');
            const dataExpense = $('.expenseList');
            const dataExpenseX = $('.expenseListX');
            $('#example_wrapper').show();
            $('#exampleX_wrapper').hide();
            data.show();
            dataX.hide();
            dataExpense.show();
            dataExpenseX.hide();
        }
    }
    var contadorToDo = 0; 
    var contadorPhase = 0;

    /** Contador de to-do */
    function countToDo(){
        var count = ++contadorToDo;
        console.log(count);
        return count
    }

    /** Contador de phase */
    function countPhase(){
        var count = ++contadorPhase;
        console.log(count);
        return count
    }

    /** Funciones para eliminar la sección que se muestra */
    function deleteInputToDo(id){
        $('#container-'+id).remove();
    }

    function changeStatusToDo(id){
        var value;
        if (document.getElementById('defaultCheck'+id+'').checked) {
            value = 1;
        } else {
            value = 0; 
        }
        $.ajax({
            url:'https://mvm-machinery.com/dashboard/public/changeStatusToDoProject/'+id+'/'+value,
            //url:'/changeStatusToDoProject/'+id+'/'+value,
                method:'GET'
            }).done(function(data){ //funcion que verifica si hay registros
                console.log("callback");
            });
    }


    function getAllImagesProjects(id){
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/getImagesProject/'+id,
            //url:'/getImagesProject/'+ id,
            success:function(data){
                $('#allImagesProjects').html(data);
            }
        });
    }

    function dailyReportImages(id){
        
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/getImagesDalilyReport/'+id,
            //url:'/getImagesDalilyReport/'+ id,
            success:function(data){
                console.log(id);
                $('#dailyImageReport-'+id+'').html(data);
            }
        });
    }

    function paymentsImage(id){
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/getPaymentsGallery/'+id,
            //url:'/getPaymentsGallery/'+ id,
            success:function(data){
                console.log(id);
                $('#paymentImage-'+id+'').html(data);
                /* $('#paymentImage').html(data); */
            }
        });
    }
    

$(document).ready(function() {
    const dataX = $('.dataFinanceX');
    const dataExpenseX = $('.expenseListX');
    dataX.hide();
    dataExpenseX.hide();

    $('#quoteInformationOpen').hide();
    $('#projectSitePlanOpen').hide();
    $('#projectSiteListOpen').hide();
    $('#permitsReceiptsOpen').hide();
    $('#permitsAplicationOpen').hide();
    $('#bussinesLicenseOpen').hide();
    $('#cityInspectionOpen').hide();
    $('#jobberQuoteOpen').hide();
    $('#sitePlanOpen').hide();
    $('#othersOpen').hide();
    $('#covenantAOpen').hide();
    $('#othersDocumentOpen').hide();

    var table = $('#example').DataTable( {
        //"searching": false,
        //"info":false,
        //"paginate":false,
        "scrollX": true,
        "scrollCollapse": true,
        "scrollY": "300px",
        "columnDefs" : [{"targets":0, "type":"date"}],
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    table .order([0,'desc'],[3,'desc']).draw();

    var tableX = $('#exampleX').DataTable( {
        "searching": false,
        "info":false,
        "paginate":false,
        "scrollX": true,
        "scrollCollapse": true,
        "scrollY": "300px",
        "columnDefs" : [{"targets":0, "type":"date"}],
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    tableX .order([0,'desc'],[3,'desc']).draw();

    /**Function to add and delete more FileUpload Buttons */
    $('.addInputs').on('click',function(){
        addMoreInputs(countToDo());
        console.log("hola");
    });

    function addMoreInputs(id){
        var bt = 
        '<div class="row" id="container-'+id+'">'+
            '<div class="col-11" style="padding-right:5px;">'+
                '<div class="form-group text-center">'+
                    '<input class="form-control form-control-sm formModalToDo" type="text" id="inputToDo" name="inputToDo[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>'+
                    '<textarea class="form-control form-control-sm formModalToDo" name="inputToDoComment[]" id="inputToDoComment[]" rows="3" placeholder="Description"></textarea>'+
                    '<div id="datepicker-container">'+
                        '<div id="datepicker-center">'+
                            '<input type="text" class="datepick formModalToDo" id="datepicker'+id+'" width="135" name="dateToDo[]" autocomplete="off" style="height: 32px; font-size: 13px;">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="col-1" style="padding-left: 0px;">'+
                '<span class="badge badge-outline-danger" onclick="deleteInputToDo('+id+')" style="cursor: pointer; border-color: white;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample"><i style="color:red" class="fas fa-times"></i></span>'+
            '</div>'+
        '</div>';
        $('.allInputsToDo').append(bt);
        $('.datepick').each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap4',
            });
        });
    }

    /**Function to add and delete more FileUpload Buttons */
    $('.addPhases').on('click',function(){
        addMorePhases(countPhase());
        console.log("hola");
    });

    /* function addMorePhases(id){
        var bt = 
        '<div class="row" id="container-'+id+'">'+
            '<div class="col-11" style="padding-right:5px;">'+
            '<div class="form-group text-center">'+
                '<input class="form-control form-control-sm formModalToDo" type="text" id="inputPhase" name="inputPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>'+
                '<textarea class="form-control form-control-sm formModalToDo" name="inputPhaseComment[]" id="inputPhaseComment[]" rows="3" placeholder="Description"></textarea>'+
                '<input class="form-control form-control-sm formModalToDo" type="number" id="budgetPhase" name="budgetPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Budget"  min="0" step="0.01" required>'+
            '</div>'+
            '</div>'+
            '<div class="col-1" style="padding-left: 0px;">'+
                '<span class="badge badge-outline-danger" onclick="deleteInputToDo('+id+')" style="cursor: pointer; border-color: white;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample"><i style="color:red" class="fas fa-times"></i></span>'+
            '</div>'+
        '</div>';
        $('.allInputsPhase').append(bt);
    } */

    $('#quoteInformation').on('hidden.bs.collapse', function () {
        $('#quoteInformationOpen').hide();
        $('#quoteInformationClose').show();
    });
    $('#quoteInformation').on('shown.bs.collapse', function () {
        $('#quoteInformationOpen').show();
        $('#quoteInformationClose').hide();
    });

    $('#projectSitePlan').on('hidden.bs.collapse', function () {
        $('#projectSitePlanOpen').hide();
        $('#projectSitePlanClose').show();
    });
    $('#projectSitePlan').on('shown.bs.collapse', function () {
        $('#projectSitePlanOpen').show();
        $('#projectSitePlanClose').hide();
    });

    $('#projectSiteList').on('hidden.bs.collapse', function () {
        $('#projectSiteListOpen').hide();
        $('#projectSiteListClose').show();
    });
    $('#projectSiteList').on('shown.bs.collapse', function () {
        $('#projectSiteListOpen').show();
        $('#projectSiteListClose').hide();
    });

    $('#permitsReceipts').on('hidden.bs.collapse', function () {
        $('#permitsReceiptsOpen').hide();
        $('#permitsReceiptsClose').show();
    });
    $('#permitsReceipts').on('shown.bs.collapse', function () {
        $('#permitsReceiptsOpen').show();
        $('#permitsReceiptsClose').hide();
    });

    $('#permitsAplication').on('hidden.bs.collapse', function () {
        $('#permitsAplicationOpen').hide();
        $('#permitsAplicationClose').show();
    });
    $('#permitsAplication').on('shown.bs.collapse', function () {
        $('#permitsAplicationOpen').show();
        $('#permitsAplicationClose').hide();
    });

    $('#bussinesLicense').on('hidden.bs.collapse', function () {
        $('#bussinesLicenseOpen').hide();
        $('#bussinesLicenseClose').show();
    });
    $('#bussinesLicense').on('shown.bs.collapse', function () {
        $('#bussinesLicenseOpen').show();
        $('#bussinesLicenseClose').hide();
    });

    $('#cityInspection').on('hidden.bs.collapse', function () {
        $('#cityInspectionOpen').hide();
        $('#cityInspectionClose').show();
    });
    $('#cityInspection').on('shown.bs.collapse', function () {
        $('#cityInspectionOpen').show();
        $('#cityInspectionClose').hide();
    });

    $('#jobberQuote').on('hidden.bs.collapse', function () {
        $('#jobberQuoteOpen').hide();
        $('#jobberQuoteClose').show();
    });
    $('#jobberQuote').on('shown.bs.collapse', function () {
        $('#jobberQuoteOpen').show();
        $('#jobberQuoteClose').hide();
    });

    $('#sitePlan').on('hidden.bs.collapse', function () {
        $('#sitePlanOpen').hide();
        $('#sitePlanClose').show();
    });
    $('#sitePlan').on('shown.bs.collapse', function () {
        $('#sitePlanOpen').show();
        $('#sitePlanClose').hide();
    });

    $('#others').on('hidden.bs.collapse', function () {
        $('#othersOpen').hide();
        $('#othersClose').show();
    });
    $('#others').on('shown.bs.collapse', function () {
        $('#othersOpen').show();
        $('#othersClose').hide();
    });

    $('#covenantA').on('hidden.bs.collapse', function () {
        $('#covenantAOpen').hide();
        $('#covenantAClose').show();
    });
    $('#covenantA').on('shown.bs.collapse', function () {
        $('#covenantAOpen').show();
        $('#covenantAClose').hide();
    });

    $('#othersDocument').on('hidden.bs.collapse', function () {
        $('#othersDocumentOpen').hide();
        $('#othersDocumentClose').show();
    });
    $('#othersDocument').on('shown.bs.collapse', function () {
        $('#othersDocumentOpen').show();
        $('#othersDocumentClose').hide();
    });

    function addMorePhases(id){
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/getPhasesAjax/'+id,
            //url:'/getPhasesAjax/'+ id,
            success:function(data){
                console.log(id);
                /* $('#paymentImage-'+id+'').html(data); */
                $('.allInputsPhase').html(data);
                /* $('#paymentImage').html(data); */
            }
        });
    }
    
});
