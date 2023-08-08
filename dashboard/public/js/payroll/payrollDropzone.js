$(document).ready(function(){
    $('.date2').hide();
});
Dropzone.autoDiscover = false;
let token = $('meta[name="csrf-token"]').attr('content');
$(function(){
    var myDropzone = new Dropzone("div#dropzoneDragArea",{
        method:'GET',
        paramName: "file",
        url: "/payrollStoreImage",
        previewsContainer: 'div#dropzoneDragArea',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 20,
        addRemoveLinks: true,//Caracteristica para eliminar un dato del dropzone.
        maxFilesize: 256, // MB
        timeout: null,
        maxFiles: null,
        params:{
            _token: token
        },

        init:function(){
            var myDropzone = this;
            $("form[name='demoform']").submit(function(event){
                alert('submit');
                event.preventDefault();
                URL = $("#demoform").attr('action');
                formData = $('#demoform').serialize();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: formData,
                    success: function(result){
                        if(result.status == "success"){
                            myDropzone.processQueue();
                            location.reload();
                        }else{
                            console.log("error");
                        }
                    }
                });
            });
            this.on('sending',function(file, xhr, formData){
                var startDate = $("#datepicker").val();
                var endDate = $("#datepicker3").val();
                formData.append('start_date',startDate);
                formData.append('end_dateF',endDate);
            });
            this.on("success",function(file, response){});
            this.on("queuecomplete",function(){});
            this.on("sendingmultiple",function(){});
            this.on("succesmultiple", function(files, response){});
        }
    });
});



