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

function newAmountDirtExport(){
    var de = $('#dirtExport').val();
    $('#amountPurchase').val( de * 300.0);
    $('#descriptionPurchase').val(" "+de+" truck of dirt export (Provider)");
}

function newAmountConcreteExport(){
    var ce = $('#concreteExport').val();
    $('#amountPurchase').val( ce * 600.0);
    $('#descriptionPurchase').val(" "+ce+" truck of concret export (Provider)");
}

function newAmountTrashExport(){
    var te = $('#trashExport').val();
    $('#amountPurchase').val( te * 600.0);
    $('#descriptionPurchase').val(" "+te+" truck of trash export (Provider)");
}

function newAmountMixedExport(){
    var me = $('#mixedExport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of mixed export (Provider)");
}

function newAmountAsphaltExport(){
    var me = $('#asphaltExport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of asphalt export (Provider)");
}

function newAmountDirtRockExport(){
    var me = $('#dirtRockExport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of dirt + rock export (Provider)");
}

function newAmountTrash40CYExport(){
    var me = $('#trash40CYExport').val();
    $('#amountPurchase').val( me * 700.0);
    $('#descriptionPurchase').val(" "+me+" truck of trash 40CY export (Provider)");
}

function newAmountDirtImport(){
    var me = $('#dirtImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of dirt import (Provider)");
}

function newAmountAsphaltImport(){
    var me = $('#asphaltImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of asphalt import (Provider)");
}

function newAmountAggregatesImport(){
    var me = $('#aggregatesImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of aggregates import (Provider)");
}

function newAmountBaseImport(){
    var me = $('#baseImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of base import (Provider)");
}

function newAmountGravellImport(){
    var me = $('#gravellImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of gravell import (Provider)");
}

function newAmountSandImport(){
    var me = $('#sandImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of sand import (Provider)");
}

function newAmountSoilImport(){
    var me = $('#soilImport').val();
    $('#amountPurchase').val( me * 650.0);
    $('#descriptionPurchase').val(" "+me+" truck of soil import (Provider)");
}
/******PAYROLL ******* */
function newAmountAlberto(){
    console.log('prueba');
    var al = $('#alberto').val();
    sumaAlberto = parseFloat(al) + parseFloat("216.67");
    $('#amountPurchase').val( sumaAlberto.toFixed(2));
    $('#descriptionPurchase').val(" Alberto ($216.67) + $"+al+" = $"+sumaAlberto.toFixed(2)+" ");
}

function newAmountAngel(){
    var ange = $('#angel').val();
    sumaangel = parseFloat(ange) + parseFloat("250");
    $('#amountPurchase').val( sumaangel.toFixed(2));
    $('#descriptionPurchase').val(" Angel ($250) + $"+ange+" = $"+sumaangel.toFixed(2)+" ");
}

function newAmountEfren(){
    var efren = $('#efren').val();
    sumaefren = parseFloat(efren) + parseFloat("150");
    $('#amountPurchase').val( sumaefren.toFixed(2));
    $('#descriptionPurchase').val(" Efren ($150) + $"+efren+" = $"+sumaefren.toFixed(2)+" ");
}

/********************************************************************** */
function newAmountDirtExportJS(cuenta){
    var de = $('#dirtExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( de * 300.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+de+" truck of dirt export (Provider)");
}

function newAmountConcreteExportJS(cuenta){
    var ce = $('#concreteExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( ce * 600.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+ce+" truck of concret export (Provider)");
}

function newAmountTrashExportJS(cuenta){
    var te = $('#trashExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( te * 600.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+te+" truck of trash export (Provider)");
}

function newAmountMixedExportJS(cuenta){
    var me = $('#mixedExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of mixed export (Provider)");
}

function newAmountAsphaltExportJS(){
    var me = $('#asphaltExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of asphalt export (Provider)");
}

function newAmountDirtRockExportJS(){
    var me = $('#dirtRockExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of dirt + rock export (Provider)");
}

function newAmountTrash40CYExportJS(){
    var me = $('#trash40CYExport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 700.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of trash 40CY export (Provider)");
}

function newAmountDirtImportJS(){
    var me = $('#dirtImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of dirt import (Provider)");
}

function newAmountAsphaltImportJS(){
    var me = $('#asphaltImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of asphalt import (Provider)");
}

function newAmountAggregatesImportJS(){
    var me = $('#aggregatesImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of aggregates import (Provider)");
}

function newAmountBaseImportJS(){
    var me = $('#baseImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of base import (Provider)");
}

function newAmountGravellImportJS(){
    var me = $('#gravellImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of gravell import (Provider)");
}

function newAmountSandImportJS(){
    var me = $('#sandImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of sand import (Provider)");
}

function newAmountSoilImportJS(){
    var me = $('#soilImport-'+cuenta+'').val();
    $('#amountPurchase-'+cuenta+'').val( me * 650.0);
    $('#descriptionPurchase-'+cuenta+'').val(" "+me+" truck of soil import (Provider)");
}
/******PAYROLL ******* */
function newAmountAlbertoJS(cuenta){
    var al = $('#alberto-'+cuenta+'').val();
    sumaAlberto = parseFloat(al) + parseFloat("216.67");
    $('#amountPurchase-'+cuenta+'').val( sumaAlberto.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Alberto ($216.67) + $"+al+" = $"+sumaAlberto.toFixed(2)+" ");
}

function newAmountAngelJS(cuenta){
    var ange = $('#angel-'+cuenta+'').val();
    sumaangel = parseFloat(ange) + parseFloat("250");
    $('#amountPurchase-'+cuenta+'').val( sumaangel.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Angel ($250) + $"+ange+" = $"+sumaangel.toFixed(2)+" ");
}

function newAmountEfrenJS(cuenta){
    var efren = $('#efren-'+cuenta+'').val();
    sumaefren = parseFloat(efren) + parseFloat("150");
    $('#amountPurchase-'+cuenta+'').val( sumaefren.toFixed(2));
    $('#descriptionPurchase-'+cuenta+'').val(" Efren ($150) + $"+efren+" = $"+sumaefren.toFixed(2)+" ");
}

/********************************************************************** */

function searchPhase(id){
        if(id != '')
        {
            $.ajax({
                method:'GET',
                url:'https://mvm-machinery.com/dashboard/public/getphases/'+id,
                //url:'http://127.0.0.1:8000/getphases/'+id,
                success:function(response){
                    $('#phasesList').text(response.succes);//cambiar luego 
                }
            }).done(function(res){
                //alert(res);
                var arreglo = JSON.parse(res);
                for (var x=0;x<arreglo.length;x++){
                    var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].name_phase+'</option>';
                }
                $('#phasesList').html(todo);
                selectedPhases = todo;
            });
        }
    }
/****************** End Show Phases *********************** */


function showCategories(){
    $.ajax({
        method:'GET',
        url:'https://mvm-machinery.com/dashboard/public/getcategories',
        //url:'http://127.0.0.1:8000/getcategories',
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
}
/****************** End Show Categories *********************** */



$( document ).ready(function() {
    showCategories();

    $('.dirtExport').hide();
    $('.concreteExport').hide();
    $('.trashExport').hide();
    $('.mixedExport').hide();
    $('.alberto').hide();
    $('.angel').hide();
    $('.efren').hide();
    $('.asphaltExport').hide();
    $('.dirtRockExport').hide();
    $('.trash40CYExport').hide();
    $('.dirtImport').hide();
    $('.asphaltImport').hide();
    $('.aggregatesImport').hide();
    $('.baseImport').hide();
    $('.gravellImport').hide();
    $('.sandImport').hide();
    $('.soilImport').hide();

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
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
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
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
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
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "4": 
            //Concrete Export
                $('#concreteExport').val(1);
                $('#categoryPurchase').val("19");
                $('#descriptionPurchase').val(" 1 truck of concret export (Provider)");
                $('#amountPurchase').val(600.00);
                $('.concreteExport').show();
                $('.dirtExport').hide();
                $('.trashExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "5": 
            //Trash Export
                $('#trashExport').val(1);
                $('#categoryPurchase').val("22");
                $('#descriptionPurchase').val(" 1 truck of trash export (Provider)");
                $('#amountPurchase').val(600.00);
                $('.trashExport').show();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.mixedExport').hide();
                $('.alberto').hide();
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;
                
            case "6": 
            //Mixed Export
                $('#mixedExport').val(1);
                $('#categoryPurchase').val("21");
                $('#descriptionPurchase').val(" 1 truck of mixed export (Provider)");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').show();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.alberto').hide();
                $('.angel').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "8": 
            //Asphalt Export
                $('#asphaltExport').val(1);
                $('#categoryPurchase').val("39");
                $('#descriptionPurchase').val("  1 truck of asphalt export (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').show();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "9": 
            //Dirt Rock Export
                $('#dirtRockExport').val(1);
                $('#categoryPurchase').val("40");
                $('#descriptionPurchase').val("  1 truck of dirt + rock export (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').show();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "10": 
            //Trash 40CY Export
                $('#trash40CYExport').val(1);
                $('#categoryPurchase').val("41");
                $('#descriptionPurchase').val("  1 truck of trash 40CY export (Provider) ");
                $('#amountPurchase').val(700.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').show();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "11": 
            //Dirt Import
                $('#dirtImport').val(1);
                $('#categoryPurchase').val("42");
                $('#descriptionPurchase').val("  1 truck of dirt import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').show();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "12": 
            //Asphalt Import
                $('#asphaltImport').val(1);
                $('#categoryPurchase').val("43");
                $('#descriptionPurchase').val("  1 truck of asphalt import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').show();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "14": 
            //Aggregates Import
                $('#aggregatesImport').val(1);
                $('#categoryPurchase').val("14");
                $('#descriptionPurchase').val("  1 truck of aggregates import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').show();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "15": 
            //Base Import
                $('#baseImport').val(1);
                $('#categoryPurchase').val("24");
                $('#descriptionPurchase').val("  1 truck of base import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').show();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "16": 
            //Gravell Import
                $('#gravellImport').val(1);
                $('#categoryPurchase').val("25");
                $('#descriptionPurchase').val("  1 truck of gravell import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').show();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;

            case "18": 
            //Sand Import
                $('#sandImport').val(1);
                $('#categoryPurchase').val("23");
                $('#descriptionPurchase').val("  1 truck of sand import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').show();
                $('.soilImport').hide();
                break;

            case "19": 
            //Soil Import
                $('#soilImport').val(1);
                $('#categoryPurchase').val("26");
                $('#descriptionPurchase').val("  1 truck of soil import (Provider) ");
                $('#amountPurchase').val(650.00);
                $('.mixedExport').hide();
                $('.dirtExport').hide();
                $('.concreteExport').hide();
                $('.trashExport').hide();
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').show();
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
                $('.angel').hide();
                $('.alberto').show();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
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
                $('.angel').show();
                $('.alberto').hide();
                $('.efren').hide();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
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
                $('.angel').hide();
                $('.alberto').hide();
                $('.efren').show();
                $('.asphaltExport').hide();
                $('.dirtRockExport').hide();
                $('.trash40CYExport').hide();
                $('.dirtImport').hide();
                $('.asphaltImport').hide();
                $('.aggregatesImport').hide();
                $('.baseImport').hide();
                $('.gravellImport').hide();
                $('.sandImport').hide();
                $('.soilImport').hide();
                break;
        }
    });

/******************************************************************************************** */
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
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
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
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
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
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "4": 
            //Concrete Export
                $('#concreteExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("19");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of concret export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(600.00);
                $('.concreteExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "5": 
            //Trash Export
                $('#trashExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("22");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of trash export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(600.00);
                $('.trashExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.mixedExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;
                
            case "6": 
            //Mixed Export
                $('#mixedExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("21");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of mixed export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').show();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "8": 
            //Asphalt Export
                $('#asphaltExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("39");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of asphalt export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').show();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "9": 
            //Dirt + Rock Export
                $('#dirtRockExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("40");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of dirt + rock export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').show();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "10": 
            //Trash 40CY Export
                $('#trash40CYExport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("41");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of trash 40CY export (Provider)");
                $('#amountPurchase-'+cuenta+'').val(700.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').show();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "11": 
            //Dirt Import
                $('#dirtImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("42");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of dirt import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').show();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "12": 
            //Asphalt Import
                $('#asphaltImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("43");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of asphalt import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').show();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "14": 
            //Aggregates Import
                $('#aggregatesImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("14");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of aggregates import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').show();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "15": 
            //Base Import
                $('#baseImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("24");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of base import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').show();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "16": 
            //Gravell Import
                $('#gravellImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("25");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of gravell import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').show();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "18": 
            //Sand Import
                $('#sandImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("23");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of sand import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').show();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "19": 
            //Soil Import
                $('#soilImport-'+cuenta+'').val(1);
                $('#categoryPurchase-'+cuenta+'').val("26");
                $('#descriptionPurchase-'+cuenta+'').val(" 1 truck of soil import (Provider)");
                $('#amountPurchase-'+cuenta+'').val(650.00);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').show();
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
                $('.angel-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').show();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
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
                $('.angel-'+cuenta+'').show();
                $('.alberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').hide();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;

            case "17": 
            //Leon
                $('#categoryPurchase-'+cuenta+'').val("37");
                $('#descriptionPurchase-'+cuenta+'').val(" Efren ($150) ");
                $('#amountPurchase-'+cuenta+'').val(150);
                $('.mixedExport-'+cuenta+'').hide();
                $('.dirtExport-'+cuenta+'').hide();
                $('.concreteExport-'+cuenta+'').hide();
                $('.trashExport-'+cuenta+'').hide();
                $('.angel-'+cuenta+'').hide();
                $('.alberto-'+cuenta+'').hide();
                $('.efren-'+cuenta+'').show();
                $('.asphaltExport-'+cuenta+'').hide();
                $('.dirtRockExport-'+cuenta+'').hide();
                $('.trash40CYExport-'+cuenta+'').hide();
                $('.dirtImport-'+cuenta+'').hide();
                $('.asphaltImport-'+cuenta+'').hide();
                $('.aggregatesImport-'+cuenta+'').hide();
                $('.baseImport-'+cuenta+'').hide();
                $('.gravellImport-'+cuenta+'').hide();
                $('.sandImport-'+cuenta+'').hide();
                $('.soilImport-'+cuenta+'').hide();
                break;
        }
    });

  }
/******************************************************************************************** */


    var idProjectName = $('#searchProject').val();
    searchPhase(idProjectName);
/****Function to add and delete more Projects Buttons ****/
  $('.addRowFields').on('click',function(){
    showCategories();
    //console.log(idProjectName);
    addRowField(countFields());
    
  });
  
    function addRowField(idn){
        var cuenta = idn +1;
        var bt = 
        '<div id="containerF-'+idn+'" >'+
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
                            '<option value="8"> Asphalt Export</option>'+
                            '<option value="9"> Dirt + Rocks Export</option>'+
                            '<option value="4"> Concrete Export</option>'+
                            '<option value="5"> Trash Export</option>'+
                            '<option value="10"> Trash 40CY Export</option>'+
                            '<option value="6"> Mixed Export</option>'+
                            '<option value="11"> Dirt Import</option>'+
                            '<option value="12"> Asphalt Import</option>'+
                            '<option value="14"> Aggregates Import</option>'+
                            '<option value="15"> Base Import</option>'+
                            '<option value="16"> Gravell Import</option>'+
                            '<option value="18"> Sand Import</option>'+
                            '<option value="19"> Soil Import</option>'+
                            '<option value="7"> Alberto</option>'+
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<div class="form-group dirtExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="dirtExport-'+cuenta+'" name="dirtExport[]" value="1" min="1" onchange="newAmountDirtExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group concreteExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="concreteExport-'+cuenta+'" name="concreteExport[]" value="1"  min="1" onchange="newAmountConcreteExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group trashExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="trashExport-'+cuenta+'" name="trashExport[]" value="1" min="1" onchange="newAmountTrashExportJS('+cuenta+')"/>'+
                '</div>'+

                '<div class="form-group mixedExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="mixedExport-'+cuenta+'" name="mixedExport[]" value="1" min="1" onchange="newAmountMixedExportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group asphaltExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="asphaltExport-'+cuenta+'" name="asphaltExport[]" value="1" min="1" onchange="newAmountAsphaltExportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group dirtRockExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="dirtRockExport-'+cuenta+'" name="dirtRockExport[]" value="1" min="1" onchange="newAmountDirtRockExportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group trash40CYExport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="trash40CYExport-'+cuenta+'" name="trash40CYExport[]" value="1" min="1" onchange="newAmountTrash40CYExportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group dirtImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="dirtImport-'+cuenta+'" name="dirtImport[]" value="1" min="1" onchange="newAmountDirtImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group asphaltImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="asphaltImport-'+cuenta+'" name="asphaltImport[]" value="1" min="1" onchange="newAmountAsphaltImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group aggregatesImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="aggregatesImport-'+cuenta+'" name="aggregatesImport[]" value="1" min="1" onchange="newAmountAggregatesImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group baseImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="baseImport-'+cuenta+'" name="baseImport[]" value="1" min="1" onchange="newAmountBaseImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group gravellImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="gravellImport-'+cuenta+'" name="gravellImport[]" value="1" min="1" onchange="newAmountGravellImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group sandImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="sandImport-'+cuenta+'" name="sandImport[]" value="1" min="1" onchange="newAmountSandImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group soilImport-'+cuenta+'">'+
                    '<label style="font-size: 12px;">How many trucks</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="soilImport-'+cuenta+'" name="soilImport[]" value="1" min="1" onchange="newAmountSoilImportJS('+cuenta+')"/>'+
                '</div>'+
                '<div class="form-group alberto-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="alberto-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountAlbertoJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group angel-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="angel-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountAngelJS('+cuenta+')" />'+
                '</div>'+
                '<div class="form-group efren-'+cuenta+'">'+
                    '<label style="font-size: 12px;">Overtime</label>'+
                    '<br>'+
                    '<input type="number" class="form-control form-control-sm" id="efren-'+cuenta+'" value="0" step="0.01" min="0" onchange="newAmountEfrenJS('+cuenta+')" />'+
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
                    '<select class="form-control phasesListName" id="phasePurchase-'+idn+'" style="font-size: 12px;" name="phasePurchase[]">'+
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
        '<span class="badge badge-danger" onclick="deletePurchases('+idn+')" style="font-size: 10px; margin: 10px 0px 10px 0px; cursor: pointer;"  href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
        '</div>';
        $('.rowFields').append(bt);
        $('#phasePurchase-'+idn+'').append(selectedPhases);
        $('.categoriesList-'+cuenta).append(selectedCategories);
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
        $('.angel-'+cuenta+'').hide();
        $('.efren-'+cuenta+'').hide();
        $('.asphaltExport-'+cuenta+'').hide();
        $('.dirtRockExport-'+cuenta+'').hide();
        $('.trash40CYExport-'+cuenta+'').hide();
        $('.dirtImport-'+cuenta+'').hide();
        $('.asphaltImport-'+cuenta+'').hide();
        $('.aggregatesImport-'+cuenta+'').hide();
        $('.baseImport-'+cuenta+'').hide();
        $('.gravellImport-'+cuenta+'').hide();
        $('.sandImport-'+cuenta+'').hide();
        $('.soilImport-'+cuenta+'').hide();
        calcular(cuenta);
    } 
});

 



