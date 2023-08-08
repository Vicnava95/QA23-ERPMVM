var contador = 0;

var selectedPhases = "";
var selectedCategories = "";


function countFields(){
    var c = ++contador;
    console.log(c);
    return c
}

function deletePurchases(id){
    $('#containerF-'+id).remove();
    var c = --contador;
    console.log(c);
    return c
}

/****************** Show Phases *********************** */
//search Phase with POST
/* function searchPhase(id){
var query = id;
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            method:'POST',
            //url:'https://mvm-machinery.com/dashboard/public/getphases',
            url:'getphases',
            data:{query:query,_token:_token},
            success:function(response){
                $('#phasesList').text(response.succes);//cambiar luego 
            }
        }).done(function(res){
            //alert(res);
            var arreglo = JSON.parse(res);
            for (var x=0;x<arreglo.length;x++){
                var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].name_phase+'</option>';
            }
            $('.phasesList').html(todo);
            selectedPhases = todo;
        });
    }
} */


function searchPhase(id){
        if(id != '')
        {
            $.ajax({
                method:'GET',
                url:'https://mvm-machinery.com/dashboard/public/getphases/'+id,
                //url:'getphases/'+id,
                success:function(response){
                    $('#phasesList').text(response.succes);//cambiar luego 
                }
            }).done(function(res){
                //alert(res);
                var arreglo = JSON.parse(res);
                for (var x=0;x<arreglo.length;x++){
                    var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].name_phase+'</option>';
                }
                $('.phasesList').html(todo);
                selectedPhases = todo;
            });
        }
    }
/****************** End Show Phases *********************** */


/****************** Show Categories *********************** */
//Show Categories with POST
/* function showCategories(){
    var _token = $('input[name="_token"]').val();
    $.ajax({
        method:'POST',
        //url:'https://mvm-machinery.com/dashboard/public/getcategories',
        url:'getcategories',
        data:{_token:_token},
        success:function(response){
            $('.categoriesList').text(response.succes);//cambiar luego 
        }
    }).done(function(res){
        //alert(res);
        var arreglo = JSON.parse(res);
        for (var x=0;x<arreglo.length;x++){
            var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].name_category+'</option>';
        }
        $('.categoriesList').html(todo);
        selectedCategories = todo;
    });
} */

function showCategories(){
    $.ajax({
        method:'GET',
        url:'https://mvm-machinery.com/dashboard/public/getcategories',
        //url:'getcategories',
        success:function(response){
            
        }
    }).done(function(res){
        //alert(res);
        //console.log("Imrepsion");
       // console.log(res);
        var arreglo = JSON.parse(res);
        for (var x=0;x<arreglo.length;x++){
            var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].name_category+'</option>';
        }
        //console.log(todo);
        $('.categoriesList').html(todo);
        selectedCategories = todo;
    });
    
}
/****************** End Show Categories *********************** */
/* function ValidateMoney()
{
    var amount = document.getElementById(amountPurchase).value;
    console.log(amount);
           //d+ permite caracteres enteros
           //si hay un caracter que no es dígito entonces evalua lo que está en paréntesis (?) significa opcional
    var patron = /^(\d+(.{1}\d{2})?)$/;     		    
            if (!patron.test(amount))
    {
        window.alert('cantidad ingresada incorrectamente');
        document.getElementById('amount').focus();
        return false;
}
    else
        return true;
} */

function newAmountDirtExport(){
    var de = $('#dirtExport').val();
    $('#amountPurchase').val( de * 300.0);
    $('#descriptionPurchase').val(" "+de+" truck of dirt export (Provider)");
}

function newAmountConcreteExport(){
    var ce = $('#concreteExport').val();
    $('#amountPurchase').val( ce * 500.0);
    $('#descriptionPurchase').val(" "+ce+" truck of concret export (Provider)");
}

function newAmountTrashExport(){
    var te = $('#trashExport').val();
    $('#amountPurchase').val( te * 500.0);
    $('#descriptionPurchase').val(" "+te+" truck of trash export (Provider)");
}

function newAmountMixedExport(){
    var me = $('#mixedExport').val();
    $('#amountPurchase').val( me * 550.0);
    $('#descriptionPurchase').val(" "+me+" truck of mixed export (Provider)");
}


/******PAYROLL ******* */
function newAmountAlberto(){
    var al = $('#alberto').val();
    sumaAlberto = parseFloat(al) + parseFloat("216.67");
    $('#amountPurchase').val( sumaAlberto.toFixed(2));
    $('#descriptionPurchase').val(" Alberto ($216.67) + $"+al+" = $"+sumaAlberto.toFixed(2)+" ");
}

function newAmountManuel(){
    var ma = $('#manuel').val();
    sumaManuel = parseFloat(ma) + parseFloat("150");
    $('#amountPurchase').val( sumaManuel.toFixed(2));
    $('#descriptionPurchase').val(" Manuel ($150) + $"+ma+" = $"+sumaManuel.toFixed(2)+" ");
}

function newAmountThomas(){
    var tho = $('#thomas').val();
    sumaThomas = parseFloat(tho) + parseFloat("200");
    $('#amountPurchase').val( sumaThomas.toFixed(2));
    $('#descriptionPurchase').val(" Thomas ($200) + $"+tho+" = $"+sumaThomas.toFixed(2)+" ");
}

function newAmountJorgeHD(){
    var jor = $('#jorgeHD').val();
    sumajorgeHD = parseFloat(jor) + parseFloat("150");
    $('#amountPurchase').val( sumajorgeHD.toFixed(2));
    $('#descriptionPurchase').val(" Jorge  ($150) + $"+jor+" = $"+sumajorgeHD.toFixed(2)+" ");
}

function newAmountDelfino(){
    var del = $('#delfino').val();
    sumadelfinoO = parseFloat(del) + parseFloat("200");
    $('#amountPurchase').val( sumadelfinoO.toFixed(2));
    $('#descriptionPurchase').val(" Delfino ($200) + $"+del+" = $"+sumadelfinoO.toFixed(2)+" ");
}

function newAmountGustavo(){
    var gus = $('#gustavo').val();
    sumagustavo = parseFloat(gus) + parseFloat("200");
    $('#amountPurchase').val( sumagustavo.toFixed(2));
    $('#descriptionPurchase').val(" Gustavo ($200) + $"+gus+" = $"+sumagustavo.toFixed(2)+" ");
}

function newAmountAngel(){
    var ange = $('#angel').val();
    sumaangel = parseFloat(ange) + parseFloat("250");
    $('#amountPurchase').val( sumaangel.toFixed(2));
    $('#descriptionPurchase').val(" Angel ($250) + $"+ange+" = $"+sumaangel.toFixed(2)+" ");
}

function newAmountLeon(){
    var leon = $('#leon').val();
    sumaleon = parseFloat(leon) + parseFloat("150");
    $('#amountPurchase').val( sumaleon.toFixed(2));
    $('#descriptionPurchase').val(" Leon ($150) + $"+leon+" = $"+sumaleon.toFixed(2)+" ");
}

function newAmountJulio(){
    var julio = $('#julio').val();
    sumajulio = parseFloat(julio) + parseFloat("150");
    $('#amountPurchase').val( sumajulio.toFixed(2));
    $('#descriptionPurchase').val(" Julio ($150) + $"+julio+" = $"+sumajulio.toFixed(2)+" ");
}

function newAmountUnberto(){
    var unberto = $('#unberto').val();
    sumaunberto = parseFloat(unberto) + parseFloat("150");
    $('#amountPurchase').val( sumaunberto.toFixed(2));
    $('#descriptionPurchase').val(" Humberto ($150) + $"+unberto+" = $"+sumaunberto.toFixed(2)+" ");
}

function newAmountEfren(){
    var efren = $('#efren').val();
    sumaefren = parseFloat(efren) + parseFloat("150");
    $('#amountPurchase').val( sumaefren.toFixed(2));
    $('#descriptionPurchase').val(" Efren ($150) + $"+efren+" = $"+sumaefren.toFixed(2)+" ");
}

function newAmountJuan(){
    var juan = $('#juan').val();
    sumajuan = parseFloat(juan) + parseFloat("150");
    $('#amountPurchase').val( sumajuan.toFixed(2));
    $('#descriptionPurchase').val(" Juan ($150) + $"+juan+" = $"+sumajuan.toFixed(2)+" ");
}

/*************************************************** */
function newAmountDirtExportJS(cuenta){
    var de = $('#dirtExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( de * 300.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+de+" truck of dirt export (Provider)");
}

function newAmountConcreteExportJS(cuenta){
    var ce = $('#concreteExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( ce * 500.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+ce+" truck of concret export (Provider)");
}

function newAmountTrashExportJS(cuenta){
    var te = $('#trashExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( te * 500.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+te+" truck of trash export (Provider)");
}

function newAmountMixedExportJS(cuenta){
    var me = $('#mixedExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 550.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of mixed export (Provider)");
}

/******PAYROLL ******* */
function newAmountAlbertoJS(cuenta){
    var al = $('#alberto-'+cuenta+'').val();
    sumaAlberto = parseFloat(al) + parseFloat("216.67");
    $('#amountPurchase-'+cuenta+'').val( sumaAlberto.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Alberto ($216.67) + $"+al+" = $"+sumaAlberto.toFixed(2)+" ");
}

function newAmountManuelJS(cuenta){
    var ma = $('#manuel-'+cuenta+'').val();
    sumaManuel = parseFloat(ma) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumaManuel.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Manuel ($150) + $"+ma+" = $"+sumaManuel.toFixed(2)+" ");
}

function newAmountThomasJS(cuenta){
    var tho = $('#thomas-'+cuenta+'').val();
    sumaThomas = parseFloat(tho) + parseFloat("200");
    $('#amountPurchase-'+cuenta+'').val( sumaThomas.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Thomas ($200) + $"+tho+" = $"+sumaThomas.toFixed(2)+" ");
}

function newAmountJorgeHDJS(cuenta){
    var jor = $('#jorgeHD-'+cuenta+'').val();
    sumajorgeHD = parseFloat(jor) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumajorgeHD.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Jorge  ($150) + $"+jor+" = $"+sumajorgeHD.toFixed(2)+" ");
}

function newAmountDelfinoJS(cuenta){
    var del = $('#delfino-'+cuenta+'').val();
    sumadelfinoO = parseFloat(del) + parseFloat("200");
    $('#amountPurchase-'+cuenta+'').val( sumadelfinoO.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Delfino ($200) + $"+del+" = $"+sumadelfinoO.toFixed(2)+" ");
}

function newAmountGustavoJS(cuenta){
    var gus = $('#gustavo-'+cuenta+'').val();
    sumagustavo = parseFloat(gus) + parseFloat("200");
    $('#amountPurchase-'+cuenta+'').val( sumagustavo.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Gustavo ($200) + $"+gus+" = $"+sumagustavo.toFixed(2)+" ");
}

function newAmountAngelJS(cuenta){
    var ange = $('#angel-'+cuenta+'').val();
    sumaangel = parseFloat(ange) + parseFloat("250");
    $('#amountPurchase-'+cuenta+'').val( sumaangel.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Angel ($250) + $"+ange+" = $"+sumaangel.toFixed(2)+" ");
}

function newAmountLeonJS(cuenta){
    var leon = $('#leon-'+cuenta+'').val();
    sumaleon = parseFloat(leon) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumaleon.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Leon ($150) + $"+leon+" = $"+sumaleon.toFixed(2)+" ");
}

function newAmountJulioJS(cuenta){
    var julio = $('#julio-'+cuenta+'').val();
    sumajulio = parseFloat(julio) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumajulio.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Julio ($150) + $"+julio+" = $"+sumajulio.toFixed(2)+" ");
}

function newAmountUnbertoJS(cuenta){
    var unberto = $('#unberto-'+cuenta+'').val();
    sumaunberto = parseFloat(unberto) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumaunberto.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Humberto ($150) + $"+unberto+" = $"+sumaunberto.toFixed(2)+" ");
}

function newAmountEfrenJS(cuenta){
    var efren = $('#efren-'+cuenta+'').val();
    sumaefren = parseFloat(efren) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumaefren.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Efren ($150) + $"+efren+" = $"+sumaefren.toFixed(2)+" ");
}

function newAmountJuanJS(cuenta){
    var juan = $('#juan-'+cuenta+'').val();
    sumajuan = parseFloat(juan) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumajuan.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Juan ($150) + $"+juan+" = $"+sumajuan.toFixed(2)+" ");
}
showCategories();
/************************************************* */
$( document ).ready(function() {
    $('.dirtExport').hide();
    $('.concreteExport').hide();
    $('.trashExport').hide();
    $('.mixedExport').hide();
    $('.alberto').hide();
    $('.manuel').hide();
    $('.thomas').hide();
    $('.jorgeHD').hide();
    $('.delfino').hide();
    $('.gustavo').hide();
    $('.angel').hide();
    $('.leon').hide();
    $('.julio').hide();
    $('.unberto').hide();
    $('.efren').hide();
    $('.juan').hide();

    $("select.quickAdd").change(function(){
        var selectedP = $(this).children("option:selected").val();
        //alert("You have selected the country - " + selectedP);
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        console.log(today);
        $('#datepicker').val(today);

        switch(selectedP){
            case "1": 
            //Internal Payroll
                $('#categoryPurchase').val("5");
                $('#descriptionPurchase').val("Name Payment ($200)");
                $('#amountPurchase').val(200.00);
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break; 

            case "2": 
            //Helpers Payroll
                $('#categoryPurchase').val("6");
                $('#descriptionPurchase').val("Name Payment ($150)");
                $('#amountPurchase').val(150.00);
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "3": 
            //Dirt Export
                //var dirt = 1;
                $('#dirtExport').val(1);
                $('#categoryPurchase').val("20");
                $('#descriptionPurchase').val(" 1 truck of dirt export (Provider)");
                var de = $('#dirtExport').val();
                $('#amountPurchase').val(300.00);
                $('.dirtExport').show();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "4": 
            //Concrete Export
                $('#concreteExport').val(1);
                $('#categoryPurchase').val("19");
                $('#descriptionPurchase').val(" 1 truck of concret export (Provider)");
                $('#amountPurchase').val(500.00);
                $('.concreteExport').show();
                $('.dirtExport').hide();
                $('.trashExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "5": 
            //Trash Export
                $('#trashExport').val(1);
                $('#categoryPurchase').val("22");
                $('#descriptionPurchase').val(" 1 truck of trash export (Provider)");
                $('#amountPurchase').val(500.00);
                $('.trashExport').show();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;
                
            case "6": 
            //Mixed Export
                $('#mixedExport').val(1);
                $('#categoryPurchase').val("21");
                $('#descriptionPurchase').val(" 1 truck of mixed export (Provider)");
                $('#amountPurchase').val(550.00);
                $('.mixedExport').show();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.alberto').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            //***** PAYROLL *******/
            case "7": 
            //Alberto
                $('#categoryPurchase').val("27");
                $('#descriptionPurchase').val(" Alberto ($216.67) ");
                $('#amountPurchase').val(216.67);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').show();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "8": 
            //Manuel
                $('#categoryPurchase').val("28");
                $('#descriptionPurchase').val(" Manuel ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').show();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;
            
            case "9": 
            //Thomas
                $('#categoryPurchase').val("29");
                $('#descriptionPurchase').val(" Thomas ($200) ");
                $('#amountPurchase').val(200);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').show();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "10": 
            //Jorge HD
                $('#categoryPurchase').val("30");
                $('#descriptionPurchase').val(" Jorge ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').show();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "11": 
            //Delfino 
                $('#categoryPurchase').val("31");
                $('#descriptionPurchase').val(" Delfino ($200) ");
                $('#amountPurchase').val(200);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').show();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "12": 
            //Gustavo
                $('#categoryPurchase').val("32");
                $('#descriptionPurchase').val(" Gustavo ($200) ");
                $('#amountPurchase').val(200);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').show();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;
        
            case "13": 
            //Angel
                $('#categoryPurchase').val("33");
                $('#descriptionPurchase').val(" Angel ($250) ");
                $('#amountPurchase').val(250);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').show();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "14": 
            //Leon
                $('#categoryPurchase').val("34");
                $('#descriptionPurchase').val(" León ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').show();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "15": 
            //Leon
                $('#categoryPurchase').val("35");
                $('#descriptionPurchase').val(" Julio ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').show();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "16": 
            //Unberto
                $('#categoryPurchase').val("36");
                $('#descriptionPurchase').val(" Humberto ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').show();
                $('.efren').hide();
                $('.juan').hide();
                break;

            case "17": 
            //Efren
                $('#categoryPurchase').val("37");
                $('#descriptionPurchase').val(" Efren ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').show();
                $('.juan').hide();
                break;

            case "18": 
            //Efren
                $('#categoryPurchase').val("38");
                $('#descriptionPurchase').val(" Juan ($150) ");
                $('#amountPurchase').val(150);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.manuel').hide();
                $('.thomas').hide();
                $('.jorgeHD').hide();
                $('.delfino').hide();
                $('.gustavo').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.leon').hide();
                $('.julio').hide();
                $('.unberto').hide();
                $('.efren').hide();
                $('.juan').show();
                break;
        }
    });


  /********************************************************************** */ 
  function calcular(cuenta){
      
    $("select.quickAdd-"+cuenta+"").change(function(){
        var selectedPcuenta = $(this).children("option:selected").val();
        //alert("You have selected the country - " + selectedPcuenta);
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        console.log(today);
        $('#datepicker-'+cuenta+'').val(today);

        switch(selectedPcuenta){
            case "1": 
            //Internal Payroll
                $('#categoryPurchase-'+cuenta+'').val("5");
                $('#descriptionPurchase-'+cuenta+'').val("Name Payment ($200)");
                $('#amountPurchase-'+cuenta+'').val(200.00);
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                
                break; 

            case "2": 
            //Helpers Payroll
                $('#categoryPurchase-'+cuenta+'').val("6");
                $('#descriptionPurchase-'+cuenta+'').val("Name Payment ($150)");
                $('#amountPurchase-'+cuenta+'').val(150.00);
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

            case "3": 
            //Dirt Export
                //var dirt = 1;
                $('#dirtExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("20");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of dirt export (Provider)");
                var de = $('#dirtExport-'+cuenta+'').val();
                $('#amountPurchase-'+cuenta+'').val(300.00);
                $('.dirtExport-'+cuenta+'').show();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

            case "4": 
            //Concrete Export
                $('#concreteExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("19");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of concret export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(500.00);
                $('.concreteExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

            case "5": 
            //Trash Export
                $('#trashExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("22");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of trash export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(500.00);
                $('.trashExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;
                
            case "6": 
            //Mixed Export
                $('#mixedExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("21");
                $('#descriptionPurchase-'+cuenta+'').val(" 1  truck of mixed export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(550.00);
                $('.mixedExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

            case "7": 
            //Alberto
                $('#categoryPurchase-'+cuenta+'').val("27");
                $('#descriptionPurchase-'+cuenta+'').val(" Alberto ($216.67) ");
                $('#amountPurchase-'+cuenta+'').val(216.67);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').hide();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').show();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

            case "8": 
            //Manuel
                $('#categoryPurchase-'+cuenta+'').val("28");
                $('#descriptionPurchase-'+cuenta+'').val(" Manuel ($150) ");
                $('#amountPurchase-'+cuenta+'').val(150);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.manuel-'+cuenta+'').show();
                $('.thomas-'+cuenta+'').hide();
                $('.jorgeHD-'+cuenta+'').hide();
                $('.delfino-'+cuenta+'').hide();
                $('.gustavo-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.leon-'+cuenta+'').hide();
                $('.julio-'+cuenta+'').hide();
                $('.unberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.juan-'+cuenta+'').hide();
                break;

                case "9": 
                //Thomas
                    $('#categoryPurchase-'+cuenta+'').val("29");
                    $('#descriptionPurchase-'+cuenta+'').val(" Thomas ($200) ");
                    $('#amountPurchase-'+cuenta+'').val(200);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').show();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "10": 
                //Jorge HD
                    $('#categoryPurchase-'+cuenta+'').val("30");
                    $('#descriptionPurchase-'+cuenta+'').val(" Jorge ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').show();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "11": 
                //Delfino 
                    $('#categoryPurchase-'+cuenta+'').val("31");
                    $('#descriptionPurchase-'+cuenta+'').val(" Delfino ($200) ");
                    $('#amountPurchase-'+cuenta+'').val(200);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').show();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;
    
                case "12": 
                //Gustavo
                    $('#categoryPurchase-'+cuenta+'').val("32");
                    $('#descriptionPurchase-'+cuenta+'').val(" Gustavo ($200) ");
                    $('#amountPurchase-'+cuenta+'').val(200);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').show();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;
    
                case "13": 
                //Angel
                    $('#categoryPurchase-'+cuenta+'').val("33");
                    $('#descriptionPurchase-'+cuenta+'').val(" Angel ($250) ");
                    $('#amountPurchase-'+cuenta+'').val(250);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').show();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "14": 
                //Leon
                    $('#categoryPurchase-'+cuenta+'').val("34");
                    $('#descriptionPurchase-'+cuenta+'').val(" León ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').show();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;
    
                case "15": 
                //Leon
                    $('#categoryPurchase-'+cuenta+'').val("35");
                    $('#descriptionPurchase-'+cuenta+'').val(" Julio ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').show();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "16": 
                //Humberto
                    $('#categoryPurchase-'+cuenta+'').val("36");
                    $('#descriptionPurchase-'+cuenta+'').val(" Humberto ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').show();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "17": 
                //Efren
                    $('#categoryPurchase-'+cuenta+'').val("37");
                    $('#descriptionPurchase-'+cuenta+'').val(" Efren ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').show();
                    $('.juan-'+cuenta+'').hide();
                    break;

                case "18": 
                //Juan
                    $('#categoryPurchase-'+cuenta+'').val("38");
                    $('#descriptionPurchase-'+cuenta+'').val(" Juan ($150) ");
                    $('#amountPurchase-'+cuenta+'').val(150);
                    $('.mixedExport-'+cuenta+'').hide();
                    $('.dirtExport-'+cuenta+'').hide();
                    $('.concreteExport-'+cuenta+'').hide();
                    $('.trashExport-'+cuenta+'').hide();
                    $('.manuel-'+cuenta+'').hide();
                    $('.thomas-'+cuenta+'').hide();
                    $('.jorgeHD-'+cuenta+'').hide();
                    $('.delfino-'+cuenta+'').hide();
                    $('.gustavo-'+cuenta+'').hide();
                    $('.angel-'+cuenta+'').hide();
                    $('.alberto-'+cuenta+'').hide();
                    $('.leon-'+cuenta+'').hide();
                    $('.julio-'+cuenta+'').hide();
                    $('.unberto-'+cuenta+'').hide();
                    $('.efren-'+cuenta+'').hide();
                    $('.juan-'+cuenta+'').show();
                    break;
        }
    });

  }
  
  /*************************************************************************** */

    
    //console.log(selectedCategories);
    
    
/****************** Search Bar  *****************************/
    $('#searchProject').keyup(function(){
        var projectName = $('#searchProject').val();
            searchProject(projectName);
    });

//Search project with POST
/*     function searchProject(name){
        var query = name;
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                method:'POST',
                //url:'https://mvm-machinery.com/dashboard/public/autocomplete/fetch',
                url:'autocomplete/fetch',
                data:{query:query,_token:_token},
                success:function(data){
                    $('#projectList').fadeIn();  
                    $('#projectList').html(data);
                    
                }
            });
        }
    } */

    function searchProject(name){
        if(name != '')
        {
            $.ajax({
                method:'GET',
                url:'https://mvm-machinery.com/dashboard/public/autocomplete/fetch/'+name,
                //url:'autocomplete/fetch/' + name,
                success:function(data){
                    $('#projectList').fadeIn();  
                    $('#projectList').html(data);
                }
            });
        }
    }

    $(document).on('click', 'li', function(){  
        $('#searchProject').val($(this).text());   
        $('#projectList').fadeOut();
    });
/******************* End Search bar *********************/


/****Function to add and delete more Projects Buttons ****/
  $('.addRowFields').on('click',function(){
    addRowField(countFields());
    showCategories();
  });
  
    function addRowField(idn){
        var cuenta = idn +1;
        var bt = 
        '<div id="containerF-'+cuenta+'" >'+
        '<hr>'+
        '<div class="text-center"><b>Purchase '+cuenta+'</b></div>'+
        '<div class="row">'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Quick Add</label>'+
                    '<select class="form-control quickAdd-'+cuenta+'" id="quickAdd-'+cuenta+'" style="font-size: 12px;" required>'+
                        '<option value="0"> Select Category</option>'+
                        '<option value="1"> Operator</option>'+
                        '<option value="2"> Labor</option>'+
                        '<option value="3"> Dirt Export</option>'+
                        '<option value="4"> Concrete Export</option>'+
                        '<option value="5"> Trash Export</option>'+
                        '<option value="6"> Mixed Export</option>'+
                        '<option value="7"> Alberto</option>'+
                        /* '<option value="8"> Manuel</option>'+
                        '<option value="9"> Thomas</option>'+
                        '<option value="10"> Jorge </option>'+
                        '<option value="11"> Delfino </option>'+
                        '<option value="12"> Gustavo </option>'+ */
                        '<option value="13"> Angel </option>'+
                        /* '<option value="14"> León </option>'+
                        '<option value="15"> Julio </option>'+ */
                        /* '<option value="16"> Humberto </option>'+ */
                        '<option value="17"> Efren </option>'+
                        /* '<option value="18"> Juan </option>'+ */
                '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group dirtExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks?</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="dirtExport-'+cuenta+'" value="1" min="1" onchange="newAmountDirtExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group concreteExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks?</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="concreteExport-'+cuenta+'" value="1"  min="1" onchange="newAmountConcreteExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group trashExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks?</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="trashExport-'+cuenta+'" value="1" min="1" onchange="newAmountTrashExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group mixedExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks?</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="mixedExport-'+cuenta+'" value="1" min="1" onchange="newAmountMixedExportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group alberto-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="alberto-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountAlbertoJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group manuel-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="manuel-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountManuelJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group thomas-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="thomas-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountThomasJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group jorgeHD-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="jorgeHD-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountJorgeHDJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group delfino-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="delfino-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountDelfinoJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group gustavo-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="gustavo-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountGustavoJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group angel-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="angel-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountAngelJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group leon-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="leon-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountLeonJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group julio-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="julio-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountJulioJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group unberto-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="unberto-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountUnbertoJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group efren-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="efren-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountEfrenJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group juan-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="juan-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountJuanJS('+cuenta+')" />'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="row">'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Category</label> '+
                    '<select class="form-control categoriesList-'+cuenta+'"  id="categoryPurchase-'+cuenta+'" style="font-size: 12px;" name="categoryPurchase[]" required>'+
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Phase</label>'+
                    '<select class="form-control phasesListName" id="phasePurchase-'+cuenta+'" style="font-size: 12px;" name="phasePurchase[]">'+
                    '</select>'+
                '</div>'+
            '</div>'+
        '</div>'+

        '<div class="form-group">'+
            '<label style="font-size: 12px;">Description</label>'+
            '<textarea class="form-control" id="descriptionPurchase-'+cuenta+'" rows="3" name="descriptionPurchase[]" required></textarea>'+
        '</div>'+

        '<div class="row">'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group">'+
                    '<label style="font-size: 12px;">Amount</label>'+
                    '<input type="number" min="0" step="0.01" class="form-control form-control-sm" id="amountPurchase-'+cuenta+'" name="amountPurchase[]" placeholder="$0.00" required>'+
                '</div>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group" style="font-size: 12px;">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<label style="font-size: 12px;">Purchase Date</label>'+
                            '<input type="text" class="datepick" id="datepicker-'+cuenta+'" width="200" name="datePurchase[]" required>'+
                        '</div>'+
                        '<div class="col">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<span class="badge badge-danger" onclick="deletePurchases('+cuenta+')" style="font-size: 10px; margin: 10px 0px 10px 0px; cursor: pointer;"  href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
        '</div>';
        $('.rowFields').append(bt);
        $('#phasePurchase-'+cuenta+'').append(selectedPhases);
        //console.log(datas);            
        $('.categoriesList-'+cuenta).html(selectedCategories);
        $('.datepick').each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap4',
            });
        });

        $('.dirtExport-'+cuenta+'').hide();
        $('.concreteExport-'+cuenta+'').hide();
        $('.trashExport-'+cuenta+'').hide();
        $('.mixedExport-'+cuenta+'').hide();
        $('.alberto-'+cuenta+'').hide();
        $('.manuel-'+cuenta+'').hide();
        $('.thomas-'+cuenta+'').hide();
        $('.jorgeHD-'+cuenta+'').hide();
        $('.delfino-'+cuenta+'').hide();
        $('.gustavo-'+cuenta+'').hide();
        $('.angel-'+cuenta+'').hide();
        $('.leon-'+cuenta+'').hide();
        $('.julio-'+cuenta+'').hide();
        $('.umberto-'+cuenta+'').hide();
        $('.efren-'+cuenta+'').hide();
        $('.juan-'+cuenta+'').hide();
        calcular(cuenta);

    } 
});

 



