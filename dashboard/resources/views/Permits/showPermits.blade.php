@extends('master')
@section('title')
    <title>Tickets</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>


    <!-- DataTable JS-->
    <script src="js/permit/allPermit.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('showPermits')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            <h4><a href="{{route('newPermit')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Permit"><i class="uil uil-file-plus-alt"></i></a></h4>
            <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container" style="margin-top: 30px;max-width: 1340px;">
    <div class="card text-center">
            <div class="card-header " style="font-size: 20px;">
                Permits
            </div>
    <div class="card-body">
        <table id="example" class="display nowrap" style="width:100%; padding-top:10px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Address</th>
                    <th style="text-align:center;">Stage</th>
                    <th style="text-align:center;">Contact Name</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
        <!-- style="white-space: pre-wrap;" -->
            <tbody>
            @foreach($permits as $permit)
                <tr>
                    <td>{{ $permit->id}}</td>
                    <td style="white-space: pre-wrap;">{{$permit->projects->address_project}}</td>
                    <td style="text-align:center;">{{$permit->permitStage->namePermitStage}}</td>
                    <td style="text-align:center;">{{$permit->client->nameClient}}</td>
                    <td style="text-align:center;">
                        <div class="dropdown " id="dropdown{{$permit->id}}">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{$permit->id}}" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropper{{$permit->id}}" style="width: 5px;">
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('infoPermit',$permit)}}" class="badge badge-light"><i class="fas fa-eye fa-1x"></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{ route ('editPermit', [$permit,2])}}" class="badge badge-light"><i class="fas fa-edit fa-1x"></i></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('deletePermit',$permit)}}" class="badge badge-light"><i class="fas fa-trash-alt fa-1x"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Address</th>
                    <th style="text-align:center;">Stage</th>
                    <th style="text-align:center;">Contact Name</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    
</div>
<style>
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
@stop


