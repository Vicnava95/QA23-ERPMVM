function showDates(){
    $('#mobileDates').show();
    $('#mobileActions').hide();
}
    
function showActions(){
    $('#mobileActions').show();
    $('#mobileDates').hide();
}
    
$(document).ready(function(){
    $('#mobileActions').hide();
});