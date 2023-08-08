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

function showCategories(id){
    console.log(id)
    $.ajax({
        method:'GET',
        url:'https://mvm-machinery.com/dashboard/public/getCategoriesExpenses/id',
        //url:'http://127.0.0.1:8000/getCategoriesExpenses/'+id+'',
        success:function(response){
            $('.categoriesList').text(response.succes);//cambiar luego 
        }
    }).done(function(res){
        //alert(res);
        var arreglo = JSON.parse(res);
        for (var x=0;x<arreglo.length;x++){
            var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].nameTypeAdminExpenses+'</option>';
        }
        $('.categoriesList').html(todo);
        selectedCategories = todo;
        console.log(todo); 
    });
}

function showCate(){
    $.ajax({
        method:'GET',
        url:'https://mvm-machinery.com/dashboard/public/getCate',
        //url:'http://127.0.0.1:8000/getCate',
        success:function(response){
            $('.anotherCategory').text(response.succes);//cambiar luego 
        }
    }).done(function(res){
        //alert(res);
        var arreglo = JSON.parse(res);
        for (var x=0;x<arreglo.length;x++){
            var idArray = arreglo[x].id;
            var todo = todo+ '<option value="'+arreglo[x].id+'">'+arreglo[x].nameCategory+'</option>';
        }
        $('.anotherCategory').html(todo);
        anotherCategories = todo;
    });
}

function hideType(idCategory){
    $('.selectOption').hide();
    $('.option'+idCategory+'').show();
    $('#selectTypeExpenses').prop('disabled',false);
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

/************************************************* */
$( document ).ready(function() {
    //showCategories(250);
    showCate();
    $('#selectTypeExpenses').prop('disabled',true);

/****Function to add and delete more Projects Buttons ****/
  $('.addRowFields').on('click',function(){
    //showCategories();
    showCate();
    addRowField(countFields());
    console.log('fila'+ countFields()); 
  });
  
    function addRowField(idn){
        var cuenta = idn +1;
        var bt = 
            '<div id="containerF-'+cuenta+'" >'+
                '<div class="row">'+
                    '<div class="col-xs-12 col-md-3">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 12px;">Category</label>'+
                            '<select class="form-control anotherCategori-'+cuenta+'" onchange="showCategories(value)">'+
                            '</select>'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-xs-12 col-md-3">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 12px;">Expense Type</label>'+
                            '<select class="form-control categoriesList-'+cuenta+'" name="expensesType[]" required>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-xs-12 col-md-3">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 12px;" >Amount</label>'+
                            '<input type="number" step="0.01" class="form-control form-control-sm" style="height: 30px;" name="amount[]" min="0" value="0" placeholder="$0.00" required>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-xs-12 col-md-3">'+
                        '<div class="form-group">'+
                            '<label style="font-size: 12px;">Date Expense</label>'+
                            '<input type="text" class="datepick" id="datepicker'+cuenta+'" width="100%" name="dateExpense[]" required autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="form-group">'+
                    '<label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>'+
                    '<textarea class="form-control" rows="3" name="comment[]"></textarea>'+
                '</div>'+
                '<span class="badge badge-danger" onclick="deletePurchases('+cuenta+')" style="font-size: 10px; margin: 10px 0px 10px 0px; cursor: pointer;"  href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Delete</span>'+
            '</div>';
        $('.rowFields').append(bt);
        $('.datepick').each(function(){
            $(this).datepicker({
                uiLibrary: 'bootstrap4',
            });
        });
        $('.categoriesList-'+cuenta).html(selectedCategories);
        $('.anotherCategori-'+cuenta).html(anotherCategories);
        console.log('Row añadido'+cuenta+'');
    } 
});

 



