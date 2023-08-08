function searchClient(name){
    if(name != '')
    {
        $.ajax({
            method:'GET',
            url:'https://mvm-machinery.com/dashboard/public/getClient/'+name,
            //url:'http://127.0.0.1:8000/getClient/'+ name,
            //url:'getClient/'+ name,
            success:function(data){
                $('#clientList').fadeIn();  
                $('#clientList').html(data);
            }
        });
    }
}

function getInfoClient(id){
    $.ajax({
        method: 'GET',
        //url:'getInfoClient/'+id,
        //url:'http://127.0.0.1:8000/getInfoClient/'+id,
        url:'https://mvm-machinery.com/dashboard/public/getInfoClient/'+id,
        success:function(response){
        }
    }).done(function(res){
        //console.log(res);
        var arreglo = JSON.parse(res);
        console.log(arreglo); 
        var todo = 
        '<div class="card border-light mb-12">'+
            '<div class="card-body text-dark">'+
                '<h5 class="card-title">'+arreglo.nameClient+'</h5>'+
                '<h6>Email: '+arreglo.emailClient+'</h6>'+
                '<h6>Phone: '+arreglo.phoneClient+'</h6>'+
            '</div>'+
        '</div>';
        $('#showInfo').html(todo);
        //selectedCategories = todo;
    });

}


$(document).ready(function(){
    $('#searchClient').keyup(function(){
        var clientName = $('#searchClient').val();
            console.log(clientName); 
            searchClient(clientName);
    });

    $(document).on('click', 'li.listaClientes', function(){  
        $('#searchClient').val($(this).text());  
        $('#idClient').val($(this).val()); 
        $('#clientList').fadeOut();
        getInfoClient($(this).val()); 
    });
}); 
