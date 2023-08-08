
/* document.querySelector('idProject').value; */
/* document.getElementById("idProject").value; */
function getInputValue() {
    var idProject = document.getElementById("idProject").value;
    return idProject;
    //console.log(idProject);
}

$( document ).ready(function() {
    var id = getInputValue();
    console.log(id); 
});

Dropzone.options.dropzone =
    {
        addRemoveLinks: true,//Caracteristica para eliminar un dato del dropzone.
        maxFilesize: 256, // MB
        timeout: null,
        maxFiles: null,
        removedfile: function(file){
            var name = file.upload.filename; 
            console.log(name); 
            var idProject = getInputValue();
            $.ajax({
                method:'GET',
                url: 'https://mvm-machinery.com/dashboard/public/deleteFile/'+name+'',
                /* url: 'http://127.0.0.1:8000/deleteFile/'+name+'', */
                success: function(response){
                    console.log('File removed!');
                },
                error: function(e){
                    console.log(e);
                }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
        fileRef.parentNode.removeChild(file.previewElement) : void 0;
        }
    };
