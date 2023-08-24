function showData(value){
    if (value == 1) {
        const data = $('.numeros');
        const dataX = $('.numerosX');
        data.hide();
        dataX.show();

    } else {
        const data = $('.numeros');
        const dataX = $('.numerosX');
        data.show();
        dataX.hide();
    }
}
function getValues(id){
    var endDate = $("#datepicker"+id).val();
    console.log(endDate); 
    var d = new Date($("#datepicker"+id).val()); 
    console.log(d); 

    var month = d .getMonth() + 1;
    var day = d .getDate();
    var year = d .getFullYear();
    var newDate1 = month + "-" + day + "-" + year;
    console.log(newDate1); 
    var idProjecto = $("#idProjecto"+id).val();
    console.log(idProjecto); 
    $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/updateFinishDate/'+idProjecto+'/'+newDate1
        url:'http://127.0.0.1:8000/updateFinishDate/'+idProjecto+'/'+newDate1
    }).done(function(data){
        console.log('ready2');
        window.location = "http://127.0.0.1:8000/activeProjects";
    });
} 

function changeEndDateProject(id){
    var endDate = $("#datepickerF"+id).val();
    console.log(endDate); 
    var d = new Date($("#datepickerF"+id).val()); 
    console.log(d); 

    var month = d .getMonth() + 1;
    var day = d .getDate();
    var year = d .getFullYear();
    var newDate1 = month + "-" + day + "-" + year;
    console.log(newDate1); 
    var idProjecto = $("#idProjectoF"+id).val();
    console.log(idProjecto); 
    $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/updateEndDateProject/'+idProjecto+'/'+newDate1
        url:'http://127.0.0.1:8000/updateEndDateProject/'+idProjecto+'/'+newDate1
    }).done(function(data){
        console.log('ready2');
        window.location = "http://127.0.0.1:8000/activeProjects";
    });
} 

function pickupNotification(){
    $.ajax({
        method:'GET',
        url:'http://127.0.0.1:8000/recordingPickup',
        //url:'/recordingPickup',
        success:function(){
        }
    });
}

$( document ).ready(function() {
    const dataX = $('.numerosX');
    dataX.hide();
    /* Searchbar Desktop */
    $('body').on("keydown", function(e) { 
        if (e.ctrlKey && e.which === 66) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            $('#searchProject').select();
        }
    });

    function searchProject(name){
        $.ajax({
            method:'GET',
            url:'http://127.0.0.1:8000/searchProjectD/'+name,
            //url:'searchProjectD/'+ name,
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
        $('#projectList').fadeOut();
        $('#dashboardProjects').hide(); 
    });
    
    /* Searchbar Mobile */
    $('body').on("keydown", function(e) { 
        if (e.ctrlKey && e.which === 66) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            $('#searchProject1').select();
        }
    });

    function searchProject1(name){
        $.ajax({
            method:'GET',
            url:'http://127.0.0.1:8000/searchProjectD/'+name,
            //url:'searchProjectD/'+ name,
            success:function(data){
                $('#projectList1').fadeIn();  
                $('#projectList1').html(data);
                $('#dashboardProjects').hide(); 
            }
        });
    }

    $('#searchProject1').keyup(function(){
        var projectName = $('#searchProject1').val();
        console.log(projectName);
        searchProject1(projectName);
    });
    
    $(document).on('click', 'li', function(){  
        $('#searchProject1').val($(this).text());   
        $('#projectList1').fadeOut();
        $('#dashboardProjects').hide(); 
    });

    pickupNotification();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
});
