Dropzone.options.dropzone =
    {
        addRemoveLinks: true,//Caracteristica para eliminar un dato del dropzone.
        maxFilesize: 256, // MB
        timeout: null,
        maxFiles: null,
        removedfile: function(file){
            var name = file.upload.filename; 
            console.log(name); 
            //var idProject = getInputValue();
            $.ajax({
                method:'GET',
                url: 'http://127.0.0.1:8000/dropzoneDeleteDocumentMail/'+name+'',
                //url: 'http://127.0.0.1:8000/dropzoneDeleteDocumentMail/'+name+'',
                
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
