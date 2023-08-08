var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
endDate = dd + '-' + mm + '-' + yyyy;
today = dd + '-' + mm + '-' + yyyy;

console.log('Today:'+' '+ endDate);

const dias = [
    'domingo',
    'lunes',
    'martes',
    'miércoles',
    'jueves',
    'viernes',
    'sábado',
  ];
  const numeroDia = new Date().getDay();
  const nombreDia = dias[numeroDia];
  console.log("Nombre de día de la semana: ", nombreDia);

//Switch para hacer la consulta para la semana actual
  switch(nombreDia){
    case 'domingo':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 6);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate());
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
    break;
    case 'lunes':
        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 6);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
    break;
    case 'martes':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 1);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 5);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'miércoles':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 2);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 4);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'jueves':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 3);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 3);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'viernes':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 4);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 2);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'sábado':
        var aToday = new Date();
        aToday.setDate(aToday.getDate() - 5);
        var dd = String(aToday.getDate()).padStart(2, '0');
        var mm = String(aToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = aToday.getFullYear();
        startDate = dd + '-' + mm + '-' + yyyy;

        var sunday = new Date();
        sunday.setDate(sunday.getDate() + 1);
        var dd = String(sunday.getDate()).padStart(2, '0');
        var mm = String(sunday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = sunday.getFullYear();
        sundayDate = dd + '-' + mm + '-' + yyyy;
    break;
  }

  console.log('Domingo de la semana:'+' '+ sundayDate);

  //Switch para hacer la consulta para la semana pasada
  switch(nombreDia){
    case 'domingo':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 7);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;
        /*** */
        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 13);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;

    break;
    case 'lunes':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 1);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 7);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
    break;
    case 'martes':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 2);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 8);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
    break;
    case 'miércoles':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 3);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 9);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'jueves':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 4);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 10);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'viernes':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 5);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 11);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
        
    break;
    case 'sábado':
        var weekTodayEnd = new Date();
        weekTodayEnd.setDate(weekTodayEnd.getDate() - 6);
        var dd = String(weekTodayEnd.getDate()).padStart(2, '0');
        var mm = String(weekTodayEnd.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayEnd.getFullYear();
        lastWeekEnd = dd + '-' + mm + '-' + yyyy;

        var weekTodayStart = new Date();
        weekTodayStart.setDate(weekTodayStart.getDate() - 12);
        var dd = String(weekTodayStart.getDate()).padStart(2, '0');
        var mm = String(weekTodayStart.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = weekTodayStart.getFullYear();
        lastWeekStart = dd + '-' + mm + '-' + yyyy;
    break;
  }
  console.log('Start last week:'+' '+ lastWeekStart);
  console.log('End last week:'+' '+ lastWeekEnd);

  /*************************************************************** */
    //Variables para la consulta del mes actual
    var date = new Date(), y = date.getFullYear(), m = date.getMonth();
    var firstDay = new Date(y, m, 1);
    var lastDay = new Date(y, m + 1, 0);

    var ddFM = String(firstDay.getDate()).padStart(2, '0');
    var mmFM = String(firstDay.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyyFM = firstDay.getFullYear();

    startMonth = ddFM + '-' + mmFM + '-' + yyyyFM;
    endtMonth = today;  
/**************************************************************** */
    //Variables para la consulta del mes pasado
    var datel = new Date(), y = datel.getFullYear(), m = datel.getMonth();
    var firstDayL = new Date(y, m -1 , 1);
    var lastDayL = new Date(y, m , 0);

    var ddFLM = String(firstDayL.getDate()).padStart(2, '0');
    var mmFLM = String(firstDayL.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyyFLM = firstDayL.getFullYear();

    var ddELM = String(lastDayL.getDate()).padStart(2, '0');
    var mmELM = String(lastDayL.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyyELM = lastDayL.getFullYear();

    startLastMonth = ddFLM + '-' + mmFLM + '-' + yyyyFLM;
    endLastMonth = ddELM + '-' + mmELM + '-' + yyyyELM;

    console.log('Primer dia mes pasado'+' '+ startLastMonth);
    console.log('Ultimi dia mes pasado'+' '+ endLastMonth);
/**************************************************************** */

  $( document ).ready(function() {
    var today = "1";
    var thisWeek = "2";
    var lastWeek = "3";
    var oneDay = "4";
    var days = "5";
    var thisMonth = "6";
    var lastMonth = "7";

    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
    
    $('.date2').hide();

    $('#datepicker').on('change',function(){
        $('.date2').show();
        var stringdia = $('#datepicker').val();
        $('#datepicker2').datepicker("destroy");
        $('#datepicker2').datepicker({
          uiLibrary: 'bootstrap4',
          minDate: stringdia
      }).val(stringdia);
    });

    $("#showDate").click(function(){
        $("#calendar").slideToggle("slow");
    });

    $("#navLinkDate").click(function(){
        $("#calendar").slideToggle("slow");
    });

    function formatDate(date) {
        var day = date.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        var month = date.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        return day + "-" + month + "-" + year;
    }

    $("#twoDays").click(function(){
        var sDay = $('#datepicker').val();
        var eDay = $('#datepicker2').val();
        var nsDay = new Date(sDay);
        var neDay = new Date(eDay);
        var dateStart = formatDate(nsDay);
        var dateEnd = formatDate(neDay);
        console.log(dateStart);
        console.log(dateEnd);
        if(dateStart == dateEnd ){
            window.location = "/payrollOneDay/"+dateStart+"/"+dateStart+"/"+4;
            /* window.location = "/dashboard/public/payrollOneDay/"+dateStart+"/"+dateStart+"/"+4; */ 
        }else{
            window.location = "/payrollDays/"+dateStart+"/"+dateEnd+"/"+5; 
            /* window.location =  "/dashboard/public/payrollDays/"+dateStart+"/"+dateEnd+"/"+5; */
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});

