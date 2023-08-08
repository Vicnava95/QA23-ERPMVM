//alert('hola'); 
$(document).ready(function() {
    var table = $('#example').DataTable( {
        /* "order": [[1,'asc']], */
        "scrollX": true,
        "lengthMenu": [ [ 50, 150, 200, -1], [ 50, 150, 200, "All"] ],
        //responsive: true
    }).draw();
    table.order([[1,'asc'],[4,'desc']]).draw();
});
