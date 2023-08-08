function hideType(idCategory){
    $('.selectOption').hide();
    $('.option'+idCategory+'').show();
    $('#selectTypeExpenses').prop('disabled',false);
}
/************************************************* */
$( document ).ready(function() {
    let vare = $('#categoryType').val();
    $('.selectOption').hide();
    $('.option'+vare+'').show();
    $('#selectTypeExpenses').prop('disabled',false);

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});

 



