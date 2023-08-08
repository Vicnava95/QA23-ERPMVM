$(document).ready(function() {
    var table = $('#example').DataTable( {
        //"searching": false,
        //"info":false,
        //"paginate":false,
        "scrollX": true,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    table .order([0,'desc'],[3,'desc']).draw();
} );