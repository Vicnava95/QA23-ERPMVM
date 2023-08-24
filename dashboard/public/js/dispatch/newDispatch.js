function automaticTotalRentalCost(){
    var day = 0;
    var priceday = 0;
    var val1 = parseFloat($('#priceEquip1').val());
    var delivery = parseFloat($('#delivery').val());
    var startDate = new Date($('#datepicker').val());
    var endDate = new Date($('#datepicker2').val());
    var days = parseInt((endDate - startDate)/(1000 * 60 * 60 * 24), 10); 
    if(days != '0'){
        priceday = parseInt(days) * val1;
        day = days;
    }else{
        priceday = val1; 
        day = 1;
    }
    var total = priceday + delivery; 
    $('#rentalCost').val( total ); 
    $('#exampleFormControlTextarea1').val('Daily Rental: $'+val1+' x Days: '+day+' + Delivery: $'+delivery+'\n'+ 'Total: $'+total); 
}

function searchClient(name){
    $.ajax({
      method:'GET',
      url:'http://127.0.0.1:8000/getClientRental/'+name,
      //url:'getClientRental/' + name,
      success:function(data){
          $('#showCustomer').fadeIn();  
          $('#showCustomer').html(data);
      }
    });
  }

function newForm(){
    $.ajax({
      method:'GET',
      url:'http://127.0.0.1:8000/showFormClient',
      //url:'showFormClient/',
      success:function(data){ 
          $('#modalPost').html(data);
      }
    });
  }

  //Function to post
    $(document).on('click', '#submitClient', function(event) {
        newSubmitClient();
    });

  function newSubmitClient(){
    var name = $('#nameClient').val();
    var email = $('#emailClient').val();
    var address = $('#autocomplete2').val();
    var phone = $('#phoneClient').val();
    var service = $('#selectService').val();
    var idlanding = $('#selectClientSource').val();
  
    $.ajax({
      url:'http://127.0.0.1:8000/createClientWeb/'+name+'/'+email+'/'+phone+'/'+address+'/'+service+'/'+idlanding,
      //url:'/createClientWeb/'+name+'/'+email+'/'+phone+'/'+address+'/'+service+'/'+idlanding,
          method:'GET'
      }).done(function(data){ //funcion que verifica si hay registros
          console.log("callback");
          
      });
  }

function getid(id){
    $.ajax({
        url:'http://127.0.0.1:8000/infoClientRental/'+id,
        //url:'/infoClientRental/'+id,
            method:'GET'
        }).done(function(data){ //funcion que verifica si hay registros
            console.log(data);
            var client = JSON.parse(data);
            console.log(client.id); 
            $('#customerphone').val(client.phoneClient);
            $('#customeremail').val(client.emailClient);
        });
    }

    function geClientInformation(){
        clearAnswer(); 
        var divClientName = document.getElementById('labelClientName');
        var divClientPhone = document.getElementById('labelClientPhone');
        var name = $('#customername').val();
        var phone = $('#customerphone').val();
        divClientName.innerHTML += 'Name: '+name;
        divClientPhone.innerHTML += 'Phone: '+phone;
    }

    function clearAnswer()
    {   
        document.getElementById('labelClientName').innerHTML = '';
        document.getElementById('labelClientPhone').innerHTML = '';
    }

  $(document).on('click', 'li', function(){  
    $('#customername').val($(this).text());
    $('#idshowCustomer').val($(this).val());    
    $('#showCustomer').fadeOut();
    console.log($(this)); 
  });

  $(document).on('click', '#mediumButton', function(event) {
    newForm();
  });

$(document).ready(function(){
    $('#delivery').val(250); 
    //Funcción para asignarle el precio a la máquina escogida
    $("select.machinery1").change(function(){
        var idMachinery1 = $(this).children("option:selected").attr("id");
        //alert(idMachinery1)
        switch (idMachinery1){
            case 'ME303_001':
                $('#priceEquip1').val(250);
                break;
            case 'ME304_001':
                $('#priceEquip1').val(300);
                break;
            case 'RTSC2_001':
                $('#priceEquip1').val(180);
                break;
            case 'SSL232_001':
                $('#priceEquip1').val(200);
                break;
            case 'SSL262_001': 
                $('#priceEquip1').val(250);
                break;
            case 'SSTL259_001':
                $('#priceEquip1').val(275);
                break;
            default:
                $('#priceEquip1').val("");
        }
        var val1 = parseFloat($('#priceEquip1').val());
        var delivery = parseFloat($('#delivery').val());
        var total = val1 + delivery; 
        $('#rentalCost').val( total ); 
        $('#exampleFormControlTextarea1').val('Daily Rental: $'+val1+ ' + Delivery: $'+delivery+ ' Total: $'+total); 
    });

    $("input#priceEquip1").change(function(){
        automaticTotalRentalCost();
    });

    $("input#datepicker").change(function(){
        automaticTotalRentalCost();
    });

    $("input#datepicker2").change(function(){
        automaticTotalRentalCost();
    });

    $("input#delivery").change(function(){
        automaticTotalRentalCost();
    });

    $("input#rentalCost").change(function(){
        var day = 0;
        var val1 = parseFloat($('#priceEquip1').val());
        var delivery = parseFloat($('#delivery').val());
        var startDate = new Date($('#datepicker').val());
        var endDate = new Date($('#datepicker2').val());
        var days = parseInt((endDate - startDate)/(1000 * 60 * 60 * 24), 10); 
        if(days != '0'){
            day = days;
        }else{
            day = 1;
        }
        var total = $('#rentalCost').val(); 
        $('#exampleFormControlTextarea1').val('Daily Rental: $'+val1+' x Days: '+day+' + Delivery: $'+delivery+'\n'+ 'Total: $'+total); 
    });

    $('#customername').keyup(function(){
        var clientName = $('#customername').val();
        console.log(clientName); 
        searchClient(clientName);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});