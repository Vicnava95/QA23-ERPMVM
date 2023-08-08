$(document).ready(function(){
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
    
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
    });

    $('#datepicker').on('change',function(){
        var stringdia = $('#datepicker').val();
        $('#datepicker2').datepicker("destroy");
        $('#datepicker2').datepicker({
          uiLibrary: 'bootstrap4',
          minDate: stringdia
      }).val(stringdia);
    });

    $('#inputDates').click(function(){
        console.log('test');
        $('.dates').toggle();
      });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});
