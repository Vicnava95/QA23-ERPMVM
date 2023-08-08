/** Flag = 1 es para texto en inglés
 *  Flag = 2 es para texto en español
 */
function sendPoolDemoSMS(flag){
    let numberPhone = $('#smsPoolDemo').val();
    console.log(numberPhone.length); 
    if (numberPhone.length == 0){
        $('#alertEmptyPoolDemo').show();
    }else if(numberPhone.length <= 16){
        $('#alertDigitPoolDemo').show();
    }else{
        window.location = "/dashboard/public/sendSmsPoolDemoLead/"+flag+"/"+numberPhone;
        //window.location = "/sendSmsPoolDemoLead/"+flag+"/"+numberPhone;
    }
};

function sendEquipmentRentalSMS(flag){
    let numberPhone = $('#smsEquipmentRental').val();
    console.log(numberPhone.length); 
    if (numberPhone.length == 0){
        $('#alertEmptyEquipmentRental').show();
    }else if(numberPhone.length <= 16){
        $('#alertDigitEquipmentRental').show();
    }else{
        window.location = "/dashboard/public/sendSmsEquipmentRental/"+flag+"/"+numberPhone;
        //window.location = "/sendSmsEquipmentRental/"+flag+"/"+numberPhone;
    }
};

function sendEstimateSMS(flag){
    let numberPhone = $('#smsEstimateRequest').val();
    console.log(numberPhone.length); 
    if (numberPhone.length == 0){
        $('#alertEmptyEstimate').show();
    }else if(numberPhone.length <= 16){
        $('#alertDigitEstimate').show();
    }else{
        window.location = "/dashboard/public/sendSmsEstimateRequest/"+flag+"/"+numberPhone;
        //window.location = "/sendSmsEstimateRequest/"+flag+"/"+numberPhone;
    }
};

$(document).ready(function(){
    $('#alertEmptyPoolDemo').hide();
    $('#alertDigitPoolDemo').hide();
    $('#alertEmptyEquipmentRental').hide();
    $('#alertDigitEquipmentRental').hide();
    $('#alertEmptyEstimate').hide();
    $('#alertDigitEstimate').hide();
});
