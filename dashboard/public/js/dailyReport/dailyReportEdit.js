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

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

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
function showModalLabor(number){
    $('#modalAddLabor'+number+'').modal('show');
}

/**************** END SHOW MODAL LABOR *******************************/


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

function findPhases(projectId,dailyReportId){
    $.ajax({
        method:'GET',
        url:'http://127.0.0.1:8000/showPhasesListEditAjax/'+ projectId+'/'+dailyReportId,
        //url:'http://127.0.0.1:8000/showPhasesListEditAjax/'+ projectId+'/'+dailyReportId,
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
            url:'http://127.0.0.1:8000/searchProjectDaily/'+name,
            //url:'http://127.0.0.1:8000/searchProjectDaily/'+ name,
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
        findPhases($('#projectId').val(),$('#dailyReportId').val());
    });

    $("input[class='form-check-input']").click(function(){
        var radioValue = $("input[name='flexRadioDefault']:checked").val();
        $('#projectId').val(radioValue);
        findPhases($('#projectId').val(),$('#dailyReportId').val());
    });
    
});