$(document).ready(function() {
    var table = $('#example').DataTable( {
        "order": [['7','asc']],
        "scrollX": true,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
    }).draw();
    table.order([0,'desc'],[7,'desc']).draw();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
} );