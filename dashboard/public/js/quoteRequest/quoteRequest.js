
    function showPhone(){
        if (document.forms['form1'].nameClient.value === "") {
            alert("The name is empty");
        }else{
            $('.clientName').hide();
            $('.clientPhone').show();
        }
    }

    function hidePhone(){
        $('.clientName').show();
        $('.clientPhone').hide();
    }

    function showEmail(){
        if (document.forms['form1'].phoneClient.value === "") {
            alert("The phone is empty");
        }else{
            $('.clientPhone').hide();
            $('.clientEmail').show();
        }
    }

    function hideEmail(){
        $('.clientPhone').show();
        $('.clientEmail').hide();
    }
    
    function showService(){
        if (document.forms['form1'].emailContact.value === "") {
            alert("The email is empty");
        }else{
            $('.clientEmail').hide();
            $('.clientService').show();
        }
    }

    function hideService(){
        $('.clientEmail').show();
        $('.clientService').hide();
    }

    function showAddress(){

        $('.clientService').hide();
        $('.clientAddress').show();
    }

    function hideAddress(){
        $('.clientService').show();
        $('.clientAddress').hide();
    }

    function asignar(ser){
        window.service = ser;
        console.log(service);
    }

    function getService1(){
        var ser = $('#1').val();
        $('#label1').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService2(){
        var ser = $('#2').val();
        $('#label2').css({"color": "#e4a627","background-color": "black"});

        $('#label1').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService3(){
        var ser = $('#3').val();
        $('#label3').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label1').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService4(){
        var ser = $('#4').val();
        $('#label4').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label1').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService5(){
        var ser = $('#5').val();
        $('#label5').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label1').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService6(){
        var ser = $('#6').val();
        $('#label6').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label1').css({"color": "black","background-color": "white"});
        $('#label7').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    function getService7(){
        var ser = $('#7').val();
        $('#label7').css({"color": "#e4a627","background-color": "black"});

        $('#label2').css({"color": "black","background-color": "white"});
        $('#label3').css({"color": "black","background-color": "white"});
        $('#label4').css({"color": "black","background-color": "white"});
        $('#label5').css({"color": "black","background-color": "white"});
        $('#label6').css({"color": "black","background-color": "white"});
        $('#label1').css({"color": "black","background-color": "white"});
        asignar(ser);
    }

    window.addEventListener('load', function () {
    $("#sendForm").click(function(){
        var nameForm = $('#nameClient').val();
        var phoneForm = $('#phoneClient').val();
        var locationForm = $('#autocomplete').val();
        var emailForm = $('#emailContact').val();
        /* var service = $('service').val(); */
        /** service es una variable global */
        console.log(service);
        
        switch(service){
            case '1':
                //Grading
                selectForm = "Manual%20Grading";
            break;
            case '2':
                //Pool Excavation
                selectForm = "Manual%20Pool%20Excavation";
            break;
            case '3':
                //House Demolition
                selectForm = "Manual%20House%20Demolition";
            break;
            case '4':
                //Pool Demolition
                selectForm = "Manual%20Pool%20Demolition";
            break;
            case '5':
                //Concrete Services
                selectForm = "Manual%20Concrete%20Services";
            break;
            case '6':
                //Excavation Services
                selectForm = "Manual%20Excavation%20Services";
            break;
            case '7':
                //Excavation Services
                selectForm = "Manual%20Concrete%20and%20Asphalt%20Demo";
            break;
        };
            console.log(nameForm);
            console.log(phoneForm);
            console.log(locationForm);
            console.log(emailForm);
            console.log(selectForm);
            
            if (!nameForm.trim()){
            console.log("Empty name");
            }else if (!phoneForm.trim()){
            console.log("Empty phone");
            }else if (!locationForm.trim()) {
            console.log("Empty Job Site Address");
            }else{
            $.ajax({
                    url:'https://mvm-machinery.com/PipeDrive/V1/PipeDrive.php?name='+nameForm+'&email='+emailForm+'&phone='+phoneForm+'&select='+selectForm+'&job='+locationForm,
                    method:'get'
                }).done(function(data){ //funcion que verifica si hay registros
                    console.log("callback");
                    alert('Your message has been send');
                    window.location.href = "https://mvm-machinery.com/thank-you-bobcat-services/";
                });
            }
        //END ELSE
      });
              console.log("ready!");
    });