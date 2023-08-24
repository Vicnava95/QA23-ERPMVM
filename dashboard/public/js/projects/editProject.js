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

  function searchClient(name){
    $.ajax({
      method:'GET',
      url:'http://127.0.0.1:8000/searchClientFromProject/'+name,
      //url:'/searchClientFromProject/' + name,
      success:function(data){
          $('#showClient').fadeIn();  
          $('#showClient').html(data);
      }
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
  
  $(document).on('click', 'li', function(){  
    $('#clientName').val($(this).text());
    $('#idClientName').val($(this).val());    
    $('#showClient').fadeOut();
  });

  $( document ).ready(function() {
    cal();
    $('#clientName').keyup(function(){
      var clientName = $('#clientName').val();
      console.log(clientName); 
      searchClient(clientName);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
  });
  
  
  