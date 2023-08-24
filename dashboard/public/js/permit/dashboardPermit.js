
$( document ).ready(function() {
    $('body').on("keydown", function(e) { 
        if (e.ctrlKey && e.which === 66) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            $('#searchProject').select();
        }
    });

    function searchProject(name){
        $.ajax({
            method:'GET',
            url:'http://127.0.0.1:8000/getPermitsAjax/'+name,
            //url:'getPermitsAjax/'+ name,
            success:function(data){
                $('#permitList').fadeIn();  
                $('#permitList').html(data);
                $('.ocultar').hide(); 
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
        $('#permitList').fadeOut();
        $('#dashboardProjects').hide(); 
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});
