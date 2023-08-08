/**Function to calculate profif and total sold */
function cal() {
  try {
    var budget = $('#budgetProject').val();
    var sold = $('#soldProject').val();
    
    var a = parseFloat(budget),
        b = parseFloat(sold); 
        if (b==0){
          
          var total = "$" + 0.00.toFixed(2);
          var profit = 0.00.toFixed(2) + "%";
          $('#totalProject').val(total);
          $('#profitProject').val(profit);
        }else{
          var total =  b - a;
          var percent =  ((b - a)*100)/b;
          var total = "$" + total.toFixed(2);
          var profit = percent.toFixed(2) + "%";
          $('#totalProject').val(total);
          $('#profitProject').val(profit);
        }
  } catch (e) {
  }
}

/** Los contadores sirven para crear o eliminar las filas que se insertan en el formulario */
var contadorC = 0;
var contadorP = 0;
var contadorF = 0;

/** Contador contactos  */
function countContacts(){
  var c = ++contadorC;
  console.log(c);
  return c
} 
/** Contador de Phases */
function countPhases(){
  var p = ++contadorP;
  console.log(p);
  return p
}
/** Contador de files */
function countFiles(){
  var f = ++contadorF;
  console.log(f);
  return f
}

/** Funciones para eliminar la sección que se muestra */
function deleteContact(id){
  $('#container-'+id).remove();
}

function deletePhase(id){
  $('#containerP-'+id).remove();
}

function deleteFile(id){
  $('#containerF-'+id).remove();
}

/** Función ajax para buscar un cliente, se activa pulsando el input con id="clientName" y 
 * esta relacionado con el siguiente controlador ClientwebController y su función searchClientFromProject
 */
function searchClient(name){
  $.ajax({
    method:'GET',
    url:'https://mvm-machinery.com/dashboard/public/searchClientFromProject/'+name,
    //url:'searchClientFromProject/' + name,
    success:function(data){
        $('#showClient').fadeIn();  
        $('#showClient').html(data);
    }
  });
}
/** Se muestra la información del cliente */
function getInfoClient(id){
  $.ajax({
      method: 'GET',
      //url:'infoClientNewProject/'+id,
      url:'https://mvm-machinery.com/dashboard/public/infoClientNewProject/'+id,
      success:function(data){
        $('#showInfo').html(data);
    }
  });
}

/** Manda a llamar el contenido del modal al controlador ClientwebController y la función showFormClient */
function newForm(){
  $.ajax({
    method:'GET',
    url:'https://mvm-machinery.com/dashboard/public/showFormClient',
    //url:'showFormClient/',
    success:function(data){ 
        $('#modalPost').html(data);
    }
  });
}

function newSubmitClient(){
  var name = $('#nameClient').val();
  var email = $('#emailClient').val();
  var address = $('#autocomplete2').val();
  var phone = $('#phoneClient').val();
  var service = $('#selectService').val();
  var idlanding = $('#selectClientSource').val();

  if(email.length === 0){
    email = name + 'emptyemail@empty.com';
  }

  if(phone.length === 0){
    phone = '+1 (000) 000-0000';
  }

  $.ajax({
    url:'https://mvm-machinery.com/dashboard/public/createClientWeb/'+name+'/'+email+'/'+phone+'/'+address+'/'+service+'/'+idlanding,
    //url:'/createClientWeb/'+name+'/'+email+'/'+phone+'/'+address+'/'+service+'/'+idlanding,
        method:'GET'
    }).done(function(data){ //funcion que verifica si hay registros
        console.log("callback");
        
    });
}

function showRadioButtonService(id){
  const cb = document.querySelector('#vehicle'+id+'');
  if(cb.checked){
    $('#radioService'+id+'').show();
  }else{
    $('#radioService'+id+'').hide();
  }
  console.log(cb.checked);
}

function showRadioButtonServiceMobile(id){
  const cb1 = document.querySelector('#vehicle1'+id+'');
  if(cb1.checked){
    $('#radioService'+id+'').show();
  }else{
    $('#radioService'+id+'').hide();
  }
  console.log(cb1.checked);
}

// MOSTAR MODAL
$(document).on('click', '#mediumButton', function(event) {
  newForm();
});

//Function to post
$(document).on('click', '#submitClient', function(event) {
  newSubmitClient();
});

/** END Botón new POST */

$(document).on('click', 'li', function(){  
  $('#clientName').val($(this).text());
  $('#idClientName').val($(this).val());    
  $('#showClient').fadeOut();
});

/********************************************************************* */

/*** */
Dropzone.autoDiscover = false;
$( document ).ready(function() {
  $('.radios').hide();
  $('#hideCollapsePhases').hide();
  $('#hideCollapseEstimation').hide();
  $('#hideCollapseContacts').hide();
  $('.date2').hide();
  $('#budgetProject').val(0);
  $('#soldProject').val(0);
  cal();
  $('#phaseNameProject').val('Empty');
  $('#phaseTextProject').val('Empty');
  $('#phaseBudgetProject').val(0);

  /** Ocultar y mostrar botones para agregar mas Phases, Estimation and Contacts */
  $('#showCollapsePhases').on('click',function(){
    $('#hideCollapsePhases').show();
    $('#showCollapsePhases').hide();
  });

  $('#hideCollapsePhases').on('click',function(){
    $('#hideCollapsePhases').hide();
    $('#showCollapsePhases').show();
  });

  $('#showCollapseEstimation').on('click',function(){
    $('#hideCollapseEstimation').show();
    $('#showCollapseEstimation').hide();
  });

  $('#hideCollapseEstimation').on('click',function(){
    $('#hideCollapseEstimation').hide();
    $('#showCollapseEstimation').show();
  });

  $('#showCollapseContacts').on('click',function(){
    $('#hideCollapseContacts').show();
    $('#showCollapseContacts').hide();
  });

  $('#hideCollapseContacts').on('click',function(){
    $('#hideCollapseContacts').hide();
    $('#showCollapseContacts').show();
  });

  $('#note').val('Empty');

  $('#clientName').keyup(function(){
    var clientName = $('#clientName').val();
    console.log(clientName); 
    searchClient(clientName);
});

/**Function to add and delete more Contacts */
  $('.addRowContact').on('click',function(){
    
    addRowContact(countContacts());
  });

  function addRowContact(id){
    var tr =   '<div id="container-'+id+'">'+
                '<div class="row" id="row">'+
                  '<div class="col">'+
                      '<label style="font-size: 12px;">Name</label>'+
                      '<input type="text" class="form-control form-control-sm" id="nameContact" name="name[]" autocomplete="off">'+
                  '</div>'+
                  '<div class="col">'+
                      '<label style="font-size: 12px;">Phone</label>'+
                      '<input type="text" class="form-control form-control-sm" id="phoneContact" name="phone[]" autocomplete="off">'+
                  '</div>'+
                '</div>'+
                '<span class="badge badge-danger" onclick="deleteContact('+id+')" style="font-size: 10px; margin: 10px 0px 10px 0px; cursor: pointer;"  href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
                '</div>';
            $('.rowcontact').append(tr);
            $('input[name="phone[]"]').mask('+1 (000) 000-0000');
  } 

  /****************************************************************** */

  /**Function to add and delete more Phases */
  $('.addRowPhases').on('click',function(){
    addRowPhases(countPhases());
    //alert("hola");
  });
  
  function addRowPhases(id){
    var ph = '<div id="containerP-'+id+'">'+
            '<div class="row">'+
              '<div class="col-xs-12 col-md-4">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Phase Name</label>'+
                    '<input type="text" class="form-control form-control-sm" maxlength="100" id="phaseNameProject'+id+'" name="phaseNameProject[]" placeholder="" required>'+
                '</div>'+
              '</div>'+
              '<div class="col-xs-12 col-md-4">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Budget</label>'+
                    '<input type="number" min="0" step="0.01" class="form-control form-control-sm" id="phaseBudgetProject'+id+'" name="phaseBudgetProject[]" placeholder="" required>'+
                '</div>'+
              '</div>'+
              '<div class="col-xs-12 col-md-4">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Sold</label>'+
                    '<input type="number" min="0" step="0.01" class="form-control form-control-sm" id="phaseSoldProject'+id+'" name="phaseSoldProject[]" placeholder="" required>'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label style="font-size: 12px;">Text</label>'+
                '<textarea type="text" class="form-control form-control-sm" rows="3" id="phaseTextProject'+id+'" name="phaseTextProject[]" placeholder="" required></textarea>'+
            '</div>'+
            
            /* '<div class="form-group">'+
                '<label style="font-size: 12px;">Dirt Truck Estimate</label>'+
                '<input type="number" class="form-control form-control-sm" id="dirtTruck" name="dirtTruck[]" min="0" value="0" step="0.01" placeholder="" required>'+
            '</div>'+
            '<div class="form-group">'+
                '<label style="font-size: 12px;">Concrete Truck Estimate</label>'+
                '<input type="number" class="form-control form-control-sm" id="concreteTruck" name="concreteTruck[]" min="0" value="0" step="0.01" placeholder="" required>'+
            '</div>'+
            '<div class="form-group">'+
                '<label style="font-size: 12px;">Mixed Truck Estimate</label>'+
                '<input type="number" class="form-control form-control-sm" id="mixedTruck" name="mixedtruck[]" min="0" value="0" step="0.01" placeholder="" required>'+
            '</div>'+ */
            '<span class="badge badge-danger" style="font-size: 10px; cursor: pointer;"  onclick="deletePhase('+id+')" href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
            '<hr>'+
            '</div>';
            $('.rowPhases').append(ph);
            $('#phaseNameProject'+id).val('Empty');
            $('#phaseTextProject'+id).val('Empty');
            $('#phaseBudgetProject'+id).val(0);
            $('#phaseSoldProject'+id).val(0);
            /* $('#dirtTruck').val(0);
            $('#concreteTruckt').val(0);
            $('#mixedTruck').val(0); */
  } 


  /****************************************************************** */

  /**Function to add and delete more FileUpload Buttons */
  $('.addRowButtons').on('click',function(){
    addRowButtons(countFiles());
    console.log("hola");
  });

  function addRowButtons(id){
    var bt = 
    '<div id="containerF-'+id+'" >'+
      '<div class="form-group" style="margin:0px;">'+
      '<div class="file-select" id="src-file1" >'+
        '<input type="file" aria-label="Archivo" name="file[]">'+
      '</div>'+
      '</div>'+
      '<span class="badge badge-danger" onclick="deleteFile('+id+')" style="font-size: 10px; margin: 10px 0px 10px 0px; cursor: pointer;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
    '</div>';
    $('.rowButtons').append(bt);
  } 
});


