$(document).ready(function() {
    var table = $('#example').DataTable( {
        "scrollX": true,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    /* table .order([0,'asc'],[4,'desc']).draw(); */
});