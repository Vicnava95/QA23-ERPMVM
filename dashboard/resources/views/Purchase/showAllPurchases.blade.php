@extends('master')
@section('title')
    <title>All Purchases</title>
@stop
@section('extra_links')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>

    <!-- DataTable JS-->
    <script src="js/contacts/contacts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

    <script src="js/clientsweb/fancyTable.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            {{-- @if (Auth::user()->rol != 'labor')
                <a href=""><div class="btn btn-outline-secondary btn-sm" >New Contact</div></a>
            @endif --}}
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->

<div class="container" style="margin-top: 30px;">  
    <div class="card text-center">
        <div class="card-header " style="font-size: 20px;">
            All Purchases
        </div>

        <div class="card-body" style="padding: 5px;">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Type of Expenses</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allExpenses as $aExpenses)
                        <tr> 
                            <td>{{$aExpenses['date']}}</td>
                            <td>{{$aExpenses['projectID']}}</td>
                            <td><u><a style="color:black;" href="{{route('project.moreInfo',$aExpenses['projectID'])}}">{{$aExpenses['projectName']}}</a></u></td>
                            <td>{{$aExpenses['type']}}</td> 
                            <td>{{$aExpenses['category']}}</td> 
                            <td>{{$aExpenses['description']}}</td> 
                            <td>${{$aExpenses['amount']}}</td> 
                        </tr>
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Type of Expenses</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<style>
.underline{
    text-decoration: underline
}
.example_wrapper{
    padding-top: 10px;
}

.badgeERPButton{
    background-color: rgb(255, 255, 255);
    color: #000000;
    border: 1px solid #000000;
    text-decoration: none;
}

.badgeERPButton:hover{
    background-color: #e4a627;
    color: black;
    text-decoration: none;
}

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".sampleTable").fancyTable({
          /* Column number for initial sorting*/
           /* sortColumn:0, */
           /* Setting pagination or enabling */
           pagination: true,
           /* Rows per page kept for display */
           perPage:15,
           globalSearch:true
           });
           //$("#phoneClient").mask("+1 (000) 000-0000");
                      
    });
    $(".noprop").click(function(event) {
        event.stopPropagation();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
</script>
@stop


