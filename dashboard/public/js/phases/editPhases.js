/**Function to calculate profid and total sold */
function cal() {
    try {
      var a = parseFloat(document.form1.budgetProject.value),
          b = parseFloat(document.form1.soldProject.value); 
          if (b==0){
            document.form1.totalProject.value = "$" + 0.00.toFixed(2);
            document.form1.profitProject.value = 0.00.toFixed(2) + "%";
          }else{
            var total =  b - a;
            var percent =  ((b - a)*100)/b;
            document.form1.totalProject.value = "$" + total.toFixed(2);
            document.form1.profitProject.value = percent.toFixed(2) + "%";
          }
    } catch (e) {
    }
  }
  
  /* function addValorBudget(a){
    if(a==''){
      $('#budgetProject').val(0);
    }
  }
  
  function addValorSold(b){
    if(b==''){
      $('#soldProject').val(0);
    }
  } */
   
  
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
  
  function deleteContact(id){
    $('#container-'+id).remove();
  }
  
  function deletePhase(id){
    $('#containerP-'+id).remove();
  }
  
  function deleteFile(id){
    $('#containerF-'+id).remove();
  }
  /********************************************************************* */
  
  $( document ).ready(function() {


  
  

  
    /****************************************************************** */
  
    /**Function to add and delete more Phases */
    $('.addRowPhases').on('click',function(){
      addRowPhases(countPhases());
      //alert("hola");
    });
    function addRowPhases(id){
      var ph = '<div id="containerP-'+id+'">'+
              '<div class="form-group">'+
                  '<label style="font-size: 12px;">Phase Name</label>'+
                  '<input type="text" class="form-control form-control-sm" maxlength="100" id="phaseNameProject'+id+'" name="phaseNameProject[]" placeholder="" required>'+
              '</div>'+
              '<div class="form-group">'+
                  '<label style="font-size: 12px;">Text</label>'+
                  '<textarea type="text" class="form-control form-control-sm" rows="3" id="phaseTextProject'+id+'" name="phaseTextProject[]" placeholder="" required></textarea>'+
              '</div>'+
              '<div class="form-group">'+
                  '<label style="font-size: 12px;">Budget</label>'+
                  '<input type="number" class="form-control form-control-sm" id="phaseBudgetProject'+id+'" name="phaseBudgetProject[]" placeholder="" required>'+
              '</div>'+
              '<span class="badge badge-danger" style="font-size: 10px; cursor: pointer;"  onclick="deletePhase('+id+')" href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
              '<hr>'+
              '</div>';
              $('.rowPhases').append(ph);
              $('#phaseNameProject'+id).val('Empty');
              $('#phaseTextProject'+id).val('Empty');
              $('#phaseBudgetProject'+id).val(0);
    } 
  
  });
  
  
  