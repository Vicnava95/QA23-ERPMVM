var contador = 0;

function countFields(){
    var c = ++contador;
    console.log(c);
    return c
}

function deletePurchases(id){
    $('#containerF-'+id).remove();
    var c = --contador;
    console.log(c);
    return c
}

function showCategories(){
    $.ajax({
        method:'GET',
        //url:'http://127.0.0.1:8000/getMachinerysRental',
        url:'getMachinerysRental',
        success:function(response){
            
        }
    }).done(function(res){
        var arreglo = JSON.parse(res);
        for (var x=0;x<arreglo.length;x++){
            var todo = todo+ '<option class="textColor" value="'+arreglo[x].model+'">'+arreglo[x].name+'</option>';
        }
        console.log(todo);
        $('.categoriesList').html(todo);
        selectedCategories = todo;
    });
}

function addRowField(idn){
    var cuenta = idn +1;
    var bt = 
    '<div id="containerF-'+idn+'" style="margin-top:15px;" >'+
        '<div class="row">'+
            '<div class="col-11">'+
                '<select class="form-control form-control-sm border textColor categoriesList-'+cuenta+'"  id="categoryPurchase-'+cuenta+'" style="font-size: 12px;" name="inputMachinerys[]" required>'+
                '</select>'+
            '</div>'+
            '<div class="col-1" style="padding-left:0px;">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="deletePurchases('+idn+')">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'+
        '</div>'+
    '</div>';
    $('.addMoreMachinerys').append(bt);
    $('.categoriesList-'+cuenta).append(selectedCategories);
} 

function showName(){
    $('.rowClientName').show();
    $('.rowClientNotes').hide();
}

function showPhone(){
    if($("#nameClient").val().length > 0){
        $('.rowClientPhone').show();
        $('.rowClientName').hide();
        $('.rowClientEquipment').hide();
        $('.rowClientDelivery').hide();
        $('.rowClientDates').hide();
        $('.rowClientNotes').hide();
    }else{
        $('.alertName').show();
    }
}

function showEquipment(){
        $('.rowClientEquipment').show();
        $('.rowClientName').hide();
        $('.rowClientPhone').hide();
        $('.rowClientDelivery').hide();
        $('.rowClientDates').hide();
        $('.rowClientNotes').hide();
}

function showDelivery(){
    //alert(document.getElementById('maquina232D').checked);
    if(!(document.getElementById('maquina232D').checked || document.getElementById('maquina262D').checked || 
         document.getElementById('maquina259D').checked || document.getElementById('maquina303E').checked || 
         document.getElementById('maquina304E').checked || document.getElementById('BREAKER').checked)){
        $('.alertEquipment').show();
    }else{
        $('.rowClientDelivery').show();
        $('.rowClientName').hide();
        $('.rowClientPhone').hide();
        $('.rowClientEquipment').hide();
        $('.rowClientDates').hide();
        $('.rowClientNotes').hide();
    }
}

function showDate(){
    if($("#autocomplete").val().length > 0){
        $('.rowClientDates').show();
        $('.rowClientName').hide();
        $('.rowClientPhone').hide();
        $('.rowClientEquipment').hide();
        $('.rowClientDelivery').hide();
        $('.rowClientNotes').hide();
    }else{
        $('.alertAddress').show();
    }
}

function showNotes(){
    if($("#datepicker").val() != "" && $("#datepicker2").val() != ""){
        $('.rowClientNotes').show();
        $('.rowClientName').hide();
        $('.rowClientPhone').hide();
        $('.rowClientEquipment').hide();
        $('.rowClientDelivery').hide();
        $('.rowClientDates').hide();
    }else if($("#datepicker").val() == ""){
        $('.alertStartDate').show();
    }else if($("#datepicker2").val() == ""){
        $('.alertEndDate').show();
    }
}

function doneSubmit(){
    if($("#phoneClient").val().length > 16){
        document.getElementById("formRentalPost").submit();
    }else if($("#phoneClient").val().length == 0){
        $('.alertPhone').show();
    }else{
        $('.alertDigits').show();
    }
}

function hideNameAlert(){
    $('.alertName').hide();
}

function hidePhoneAlert(){
    $('.alertPhone').hide();
}

function hideDigitsAlert(){
    $('.alertDigits').hide();
}

function hideEquipmentAlert(){
    $('.alertEquipment').hide();
}

function hideAddressAlert(){
    $('.alertAddress').hide();
}

function hideStartDateAlert(){
    $('.alertStartDate').hide();
}

function hideEndDateAlert(){
    $('.alertEndDate').hide();
}

function hideDeliveryAlert(){
    $('.alertDelivery').hide();
}

$(document).ready(function(){
    showCategories();
    $('.addRowFields').on('click',function(){
        showCategories();
        addRowField(countFields());
    });
    $('.rowClientName').hide();
    $('.rowClientPhone').hide();
    $('.rowClientDelivery').hide();
    $('.rowClientDates').hide();
    $('.rowClientNotes').hide();

    //Alerts
    $('.alertName').hide();
    $('.alertPhone').hide();
    $('.alertDigits').hide();
    $('.alertEquipment').hide();
    $('.alertAddress').hide();
    $('.alertStartDate').hide();
    $('.alertEndDate').hide();
    $('.alertDelivery').hide();

    $('#datepicker').on('change',function(){
        $('#datepicker2').datepicker("destroy");
        $('#datepicker2').addClass("form-control-sm border");
        var stringdia = $('#datepicker').val();
        $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        minDate: stringdia
        }).val(stringdia);
    });
});
