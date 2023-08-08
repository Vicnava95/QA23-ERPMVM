$(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 1, "desc" ]],
        "scrollX": true
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
} );

