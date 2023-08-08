//Función para movil 
function showSourceClient(id){
    //console.log(id); 
    $.ajax({
        method:'GET',
        url:'serviceLanding/'+id,
        //url:'https://mvm-machinery.com/dashboard/public/serviceLanding/'+id,
        success:function(response){
        }
    }).done(function(res){
        var arreglo = JSON.parse(res);
        console.log(arreglo); 
        for (var x=0;x<arreglo.length;x++){
            var todo = todo + '<tr ><td><span class="badge badge-secondary">'+arreglo[x].clientSource+'</span></td> <td>'+arreglo[x].Service+'</td> <td>'+arreglo[x].date+'</td></tr >';
        }
        $('.showData').html(todo);
        selectedCategories = todo;
    });
}

//Funcion para desktop
function showSourceClientDesktop(id){

  $.ajax({
      method:'GET',
      url:'serviceLanding/'+id,
      //url:'https://mvm-machinery.com/dashboard/public/serviceLanding/'+id,
      success:function(response){
      }
  }).done(function(res){
      var arreglo = JSON.parse(res);
      console.log(arreglo); 
      for (var x=0;x<arreglo.length;x++){
          var todo = todo + '<tr ><td><span class="badge badge-secondary">'+arreglo[x].clientSource+'</span></td> <td>'+arreglo[x].Service+'</td> <td>'+arreglo[x].date+'</td></tr >';
      }
      $('.showDataDesktop').html(todo);
      selectedCategories = todo;
  });
}

function searchClient(name){
    $.ajax({
        method:'GET',
        url:'searchClient/'+name,
        //url:'https://mvm-machinery.com/dashboard/public/searchClient/'+name,
        success:function(data){
            $('#showListClients').fadeIn();  
            $('#showListClients').html(data);
        }
    });
}

function showClient(id){
    $.ajax({
        method:'GET',
        url: 'showClient/'+id,
        //url:'https://mvm-machinery.com/dashboard/public/showClient/'+id,
        success:function(data){
            $('#showListClients').fadeOut();  
            $('#showClient').fadeIn();  
            $('#showClient').html(data);
        }
    });
}

$(document).ready(function() {
    var table = $('#example').DataTable( {
        "scrollX": true,
        "ordering": false,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
    }).draw();

    //Función para buscar clientes
    $('#searchClient').keyup(function(){
        var clientName = $('#searchClient').val();
        console.log(clientName); 
        searchClient(clientName);
        $('.list-group-item').hide();
    });

    /** DELETE DATA */
    $(document).on('click','#bulk_delete',function(){
        var id = [];
        $('.client_checkbox:checked').each(function(){
            id.push($(this).val());
        });
        if(id.length > 0){
            id.forEach(element => 
                $.ajax({
                method:'GET',
                url:'destroyClientweb/'+ element,
                //url:'https://mvm-machinery.com/dashboard/public/destroyClientweb/'+name,
                success:function(response){
                    console.log('done'); 
                    }
                })
            );
            location.reload();
        }else{
            alert("Please select atleast one checkbox");
        }
    });

    /** EDIT DATA */
    $(document).on('click','#bulk_edit',function(){
        var id = [];
        $('.client_checkbox:checked').each(function(){
            id.push($(this).val());
        });
        if(id.length > 0){
            id.forEach(element => 
                $.ajax({
                    method:'GET',
                    url: 'editClientweb/'+id,
                    //url:'https://mvm-machinery.com/dashboard/public/editClientweb/'+id,
                    success:function(data){ 
                        $('.modalEditBody').html(data);
                    }
                })
            );
        }else{
            alert("Please select atleast one checkbox");
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
} );
