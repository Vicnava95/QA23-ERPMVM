$(document).ready(function() {
    var table = $('#example').DataTable( {
        "scrollX": true,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    table .order([0,'desc'],[2,'asc'],[6,'desc']).draw();
} );