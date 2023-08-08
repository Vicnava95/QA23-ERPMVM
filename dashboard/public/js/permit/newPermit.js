function searchProject(name){
    if(name != '')
    {
        $.ajax({
            method:'GET',
            //url:'https://mvm-machinery.com/dashboard/public/getProject/'+name,
            url:'getProject/'+ name,
            success:function(data){
                $('#projectList').fadeIn();  
                $('#projectList').html(data);
            }
        });
    }
}

function searchClient(name){
    if(name != '')
    {
        $.ajax({
            method:'GET',
            //url:'https://mvm-machinery.com/dashboard/public/getClient/'+name,
            url:'getClient/'+ name,
            success:function(data){
                $('#clientList').fadeIn();  
                $('#clientList').html(data);
            }
        });
    }
}

function searchServices(id){
    $.ajax({
        method: 'GET',
        url:'getServices/'+id,
        //url:'https://mvm-machinery.com/dashboard/public/getServices/'+id,
        success:function(response){
        }
    }).done(function(res){
        //console.log(res);
        var arreglo = JSON.parse(res);
        console.log(arreglo); 
        /* CAMBIAR TODO ESTO */
        var todo = '';
        for (var x=0;x<arreglo.length;x++){
            todo = todo + '<label style="margin: 0px;">'+arreglo[x].name_service+'</label><br>';
        }
        //console.log(todo);
        $('#showServices').html(todo);
        //selectedCategories = todo;
    });
}

function getInfoClient(id){
    $.ajax({
        method: 'GET',
        url:'getInfoClient/'+id,
        //url:'https://mvm-machinery.com/dashboard/public/getInfoClient/'+id,
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

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function(){
    $('#searchProject').keyup(function(){
        var projectName = $('#searchProject').val();
            console.log(projectName); 
            searchProject(projectName);
    });

    $(document).on('click', 'li.listaProyectos', function(){  
        $('#searchProject').val($(this).text());  
        $('#idProject').val($(this).val()); 
        $('#projectList').fadeOut();
        searchServices($(this).val());
    });

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