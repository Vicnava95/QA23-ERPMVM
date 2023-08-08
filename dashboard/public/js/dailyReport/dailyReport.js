
function onlyData(){
    $('#flagSubmit').val(0);
}

function addImage(){
    $('#flagSubmit').val(1);
}

function getCurrentDay(){
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    }).value(new Date());
}

function test(){
    if($("#searchProject").is(":visible")){
        $('#searchProject').hide();
    } else{
        $('#searchProject').show();
    }
}

function addRowLabor(id){
    var tr =   '<div id="container-'+id+'">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label style="font-size: 12px; margin:0px;">Name</label>'+
                            '<input type="text" class="form-control form-control-sm" id="nameLabor'+id+'" name="nameLabor[]" autocomplete="off">'+
                        '</div>'+
                        '<div class="col">'+
                            '<label style="font-size: 12px; margin:0px;">Payment</label>'+
                            '<input type="number" class="form-control form-control-sm" id="paymentLabor'+id+'" name="paymentLabor[]" min="0" step="0.01" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<hr>'+
                '</div>';
            $('.addMoreLabor').append(tr);
  } 

  function addRowSub(id){
    var tr =   '<div id="containerSub-'+id+'">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label style="font-size: 12px; margin:0px;">Name</label>'+
                            '<input type="text" class="form-control form-control-sm" id="nameSub'+id+'" name="nameSub[]" autocomplete="off">'+
                        '</div>'+
                        '<div class="col">'+
                            '<label style="font-size: 12px; margin:0px;">Payment</label>'+
                            '<input type="number" class="form-control form-control-sm" id="paymentSub'+id+'" name="paymentSub[]" min="0" step="0.01" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label style="font-size: 12px; margin:0px;">Description</label>'+
                            '<textarea class="form-control form-control-sm" name="descriptionSub[]" id="descriptionSub'+id+'" cols="5" rows="2"></textarea>'+
                        '</div>'+
                    '</div>'+
                    '<hr>'+
                '</div>';
            $('.addMoreSubContractor').append(tr);
  }


var countGlobalLabor = 0;
var countGlobalSubcontractor = 0;
function contadorInternoLabor(flag){
    //Flag = 1 es sumar
    //Flag = 0 es restar
    if(flag == 1){
        countGlobalLabor += 1;
    }else{
        countGlobalLabor -= 1;
    }
}
function contadorInternoSubcontractor(flag){
    //Flag = 1 es sumar
    //Flag = 0 es restar
    if(flag == 1){
        countGlobalSubcontractor += 1;
    }else{
        countGlobalSubcontractor -= 1;
    }
}

function moreLabor(){
    flag = 1;
    contadorInternoLabor(flag);
    if(countGlobalLabor != 0){
        $('#rowmoreLabor').show();
        addRowLabor(countGlobalLabor);
    } else{
        $('#rowmoreLabor').hide();
    }
    if(countGlobalLabor != 0){
        $('#btnLabMinus').show();
    }

}
function moreSubcontractor(){
    flag = 1;
    contadorInternoSubcontractor(flag);
    if(countGlobalSubcontractor != 0){
        $('#rowmoreSubContractor').show();
        addRowSub(countGlobalSubcontractor);
    } else{
        $('#rowmoreSubContractor').hide();
    }
    if(countGlobalSubcontractor != 0){
        $('#btnSubMinus').show();
    }

}

function deleteLabor(id){
    $('#container-'+id).remove();
  } 
function deleteSub(id){
    $('#containerSub-'+id).remove();
  } 

function lessLabor(){
    flag = 0;
    deleteLabor(countGlobalLabor);
    contadorInternoLabor(flag)
    if(countGlobalLabor != 0){
        $('#rowmoreLabor').show();
    } else{
        $('#rowmoreLabor').hide();
    }
    if(countGlobalLabor == 0){
        $('#btnLabMinus').hide();
    }

}
function lessSub(){
    flag = 0;
    deleteSub(countGlobalSubcontractor);
    contadorInternoSubcontractor(flag)
    if(countGlobalSubcontractor != 0){
        $('#rowmoreSubContractor').show();
    } else{
        $('#rowmoreSubContractor').hide();
    }
    if(countGlobalSubcontractor == 0){
        $('#btnSubMinus').hide();
    }
}

/**************** START SHOW MODAL LABOR *******************************/
    function showModalLabor(idLabor){
        $('#modalAddLabor'+idLabor+'').modal('show');
    }

    function deleteInfoLabor(numResumenLabor){
        $('#cardListLabor'+numResumenLabor).remove();
        var getContadorLabor = $('#countLabor').val();
        $('#countLabor').val(parseInt(getContadorLabor) - 1);
    } 

    var numResumenLabor = 0;

    function getInfoModalLabor(id,nameLabor){
        numResumenLabor += 1;
        var getContadorLabor = $('#countLabor').val();
        $('#countLabor').val(parseInt(getContadorLabor) + 1);
        /* var nameTruck = 'Dirt Import'; */

        var newLabor = '<div class="card" id="cardListLabor'+numResumenLabor+'">'+
                            '<div class="card-body cardExportDirt">'+
                                '<div class="row">'+
                                    '<div class="col-9">'+
                                        '<h5 id="titleInfoCardImport" style="margin-left: 5px; margin-bottom: 0px; font-size: 1rem;">'+nameLabor+'</h5>'+
                                    '</div>'+
                                    '<div class="col-3" style="text-align: right;">'+
                                        '<i class="fas fa-times" onclick="deleteInfoLabor('+numResumenLabor+')" style="color:red;"></i>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row cardRow1">'+
                                '<div class="col-3 fila1Card">'+
                                        /* '<h6>Comments:</h6>'+ */
                                        '<h6 class="hideReport" id="amountLabor'+numResumenLabor+'" style="padding-right: 11px;"></h6>'+
                                        '<input hidden name="amountLabor[]" type="text" id="inputPriceCard'+numResumenLabor+'">'+
                                        '<input hidden name="idLaborList[]" value="'+id+'" type="text" id="idLaborList'+numResumenLabor+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row cardRow1">'+
                                '<div class="col-12 fila1Card">'+
                                        '<h6 id="commentsLabor'+numResumenLabor+'" style="padding-right: 11px;"></h6>'+
                                        '<textarea hidden name="commentsLabor[]" id="inputCommitCard'+numResumenLabor+'" rows="2"></textarea>'
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
        $('.listLaborResumen').append(newLabor);
        var price = $('#modalAmountLabor'+id+'').val();
        var comments = $('#inputListmodalCommentLabor'+id+'').val();
        var rol = $('#rolType').val();
        if(rol == 'labor' || rol == 'report'){
            $('.hideReport').hide();
        }
        
        var dollar = "$";
        var concatPrice = dollar.concat(price);
        console.log(concatPrice);
        $('#amountLabor'+numResumenLabor+'').html(concatPrice);
        $('#commentsLabor'+numResumenLabor+'').html(comments);

        $('#inputPriceCard'+numResumenLabor+'').val(price);
        $('#inputCommitCard'+numResumenLabor+'').val(comments);

        /* $('#inputListModalPrice'+id+'').val("");
        $('#inputListModalComment'+id+'').val(""); */

    }
/**************** END SHOW MODAL LABOR *******************************/

/**************** START SHOW MODAL TRUCK *******************************/
    function showModalTruck(idTruck, nameTruck){
        $('#exampleModalCenter'+idTruck+'').modal('show');
        $('#exampleModalLongTitle'+idTruck+'').html(nameTruck);
    }

    function deleteCardTruck(numResumencard){
        $('#cardList'+numResumencard).remove();
        var getContador = $('#countTrucks').val();
        $('#countTrucks').val(parseInt(getContador) - 1);
    } 

    var numResumencard = 0;

    function getInfoModal(id){
        numResumencard += 1;
        var getContador = $('#countTrucks').val();
        $('#countTrucks').val(parseInt(getContador) + 1);
        switch(id){
            case 1:
                nameTruck = 'Dirt Import';
            break;
            case 9:
                nameTruck = 'Gravel Import';
            break;
            case 10:
                nameTruck = 'Base Import';
            break;
            case 11:
                nameTruck = 'DG Import';
            break;
            case 2:
                nameTruck = 'Dirt Export';
            break;
            case 3:
                nameTruck = 'Concrete Export';
            break;
            case 4:
                nameTruck = 'Mixed Export';
            break;
            case 5:
                nameTruck = 'Trash Export';
            break;
            case 6:
                nameTruck = 'Asphalt Export';
            break;
            case 7:
                nameTruck = 'Dirt + Rocks Export';
            break;
            case 8:
                nameTruck = 'Demolition Debris Export';
            break;
        }
        
        var newTruck = '<div class="card" id="cardList'+numResumencard+'">'+
                            '<div class="card-body cardExportDirt">'+
                                '<div class="row">'+
                                    '<div class="col-9">'+
                                        '<h5 id="titleInfoCardImport" style="margin-left: 5px; margin-bottom: 0px; font-size: 1rem;">'+nameTruck+'</h5>'+
                                    '</div>'+
                                    '<div class="col-3" style="text-align: right;">'+
                                        '<i class="fas fa-times" onclick="deleteCardTruck('+numResumencard+')" style="color:red;"></i>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row cardRow1">'+
                                    '<div class="col-3 fila1Card">'+
                                        '<h6>Quantity</h6>'+
                                    '</div>'+
                                    '<div class="col-3 fila1Card">'+
                                        '<h6>Price</h6>'+
                                    '</div>'+
                                    '<div class="col-6 fila1Card">'+
                                        '<h6>Provideer</h6>'+
                                    '</div>'+
                                '</div>'+
                                '<input hidden name="idTruckInfoCard[]" type="text" value="'+id+'">'+
                                '<div class="row cardRow1">'+
                                    '<div class="col-3 fila2Card">'+
                                        '<h6 id="quantityInfoCard'+numResumencard+'"></h6>'+
                                        '<input hidden name="quantityInfoCard[]" type="text" id="inputQuantityCard'+numResumencard+'">'+
                                    '</div>'+
                                    '<div class="col-3 fila2Card">'+
                                        '<h6 id="priceInfoCard'+numResumencard+'"></h6>'+
                                        '<input hidden name="priceInfoCard[]" type="text" id="inputPriceCard'+numResumencard+'">'+
                                    '</div>'+
                                    '<div class="col-6 fila2Card">'+
                                        '<h6 id="providerInfoCard'+numResumencard+'"></h6>'+
                                        '<input hidden name="providerInfoCard[]" type="text" id="inputProviderCard'+numResumencard+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row cardRow1">'+
                                '<div class="col-3 fila1Card">'+
                                        '<h6>Comments:</h6>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row cardRow1">'+
                                '<div class="col-12 fila1Card">'+
                                        '<h6 id="commentsInfoCard'+numResumencard+'" style="padding-right: 11px;"></h6>'+
                                        '<textarea hidden name="commentsInfoCard[]" id="inputCommitCard'+numResumencard+'" rows="2"></textarea>'
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
        $('.listTruckResumen').append(newTruck);
        var quantity = $('#inputListModalQuantity'+id+'').val();
        var price = $('#inputListModalPrice'+id+'').val();
        var provider = $('#selectModalProvider'+id+'').val();
        var comments = $('#inputListModalComment'+id+'').val();

        var dollar = "$";
        var concatPrice = dollar.concat(price);

        $('#quantityInfoCard'+numResumencard+'').html(quantity);
        $('#priceInfoCard'+numResumencard+'').html(concatPrice);
        $('#providerInfoCard'+numResumencard+'').html(provider);
        $('#commentsInfoCard'+numResumencard+'').html(comments);

        $('#inputQuantityCard'+numResumencard+'').val(quantity);
        $('#inputPriceCard'+numResumencard+'').val(price);
        $('#inputProviderCard'+numResumencard+'').val(provider);
        $('#inputCommitCard'+numResumencard+'').val(comments);

        $('#inputListModalQuantity'+id+'').val("");
        $('#inputListModalPrice'+id+'').val("");
        $('#selectModalProvider'+id+'').val("Select provider");
        $('#inputListModalComment'+id+'').val("");

    }
/**************** END SHOW MODAL TRUCK *******************************/

function showModalAndCard(number,title){
    $('#exampleModalCenter'+number+'').modal('show');
    $('#exampleModalLongTitle'+number+'').html(title);
    $('#inputListModalQuantity'+number+'').keyup(function(){
        var quantityTrucks = $('#inputListModalQuantity'+number+'').val();
        $('#inputList'+number+'').val(quantityTrucks);
        if(quantityTrucks.length == 0){
            $('#cardList'+number+'').hide();
        }else{
            $('#cardList'+number+'').show();
            $('#titleInfoCard'+number+'').html(title);
            $('#qualityInfoCard'+number+'').html(quantityTrucks);
        }
    });
    $('#inputListModalPrice'+number+'').keyup(function(){
        var priceTrucks = $('#inputListModalPrice'+number+'').val();
        var priceWithDollar = '$' + priceTrucks;
        console.log(priceWithDollar); 
        if(priceTrucks.length == 0){
            $('#priceInfoCard'+number+'').html('0');
        }else{
            $('#priceInfoCard'+number+'').html(priceWithDollar);

            /* $('#qualityInfoCard'+number+'').html(title);
            $('#priceInfoCard'+number+'').html(title);
            $('#providerInfoCard'+number+'').html(title); */
        }
    });
    $('#selectModalProvider'+number+'').change(function() {
        $('#providerInfoCard'+number+'').html('');
        var $option = $(this).find('option:selected');
        var text = $option.text();//to get <option>Text</option> content
        console.log(text);
        if(text == ' Select provider'){
            $('#providerInfoCard'+number+'').html('');
        }else{
            $('#providerInfoCard'+number+'').html(text);
        }
    });
}

function findPhases(projectId){
    $.ajax({
        method:'GET',
        url:'https://mvm-machinery.com/dashboard/public/showPhasesListAjax/'+projectId,
        //url:'showPhasesListAjax/'+ projectId,
        success:function(data){  
            $('#projectPhaseList').html(data);
        }
    });
    console.log(projectId);
}


$( document ).ready(function() {
    $('#searchProject').hide();
    $('#rowmoreLabor').hide();
    $('#moreSubcontractor').hide();
    $('#btnSubMinus').hide();
    $('#btnLabMinus').hide();
    for(i=0; i <= 11 ; i++){
        $('#cardList'+i+'').hide();
    }
    const dataX = $('.numerosX');
    dataX.hide();
    $('body').on("keydown", function(e) { 
        if (e.ctrlKey && e.which === 66) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            $('#searchProject').select();
        }
    });

    function searchProject(name){
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/searchProjectDaily/'+name,
            //url:'searchProjectDaily/'+ name,
            success:function(data){
                $('#projectList').fadeIn();  
                $('#projectList').html(data);
                $('#dashboardProjects').hide(); 
            }
        });
    }

    $('#searchProject').keyup(function(){
        var projectName = $('#searchProject').val();
        console.log(projectName);
        searchProject(projectName);
    });
    
    $(document).on('click', 'li', function(){  
        $('#searchProject').val($(this).text());   
        $('#projectId').val($(this).val());
        $('#projectList').fadeOut();
        $('#dashboardProjects').hide(); 
        findPhases($('#projectId').val());
    });

    $("input[class='form-check-input-project']").click(function(){
        var radioValue = $("input[name='flexRadioDefault']:checked").val();
        $('#projectId').val(radioValue);
        findPhases($('#projectId').val());
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });
});