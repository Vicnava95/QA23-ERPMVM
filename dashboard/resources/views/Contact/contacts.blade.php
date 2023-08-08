@extends('master')
@section('title')
    <title>Clients</title>
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
            Contacts
        </div>

        <div class="card-body" style="padding: 5px;">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        @if (Auth::user()->rol != 'labor')
                            <th style="text-align:center;">Projects</th>
                            <th style="text-align:center;">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalEditCheck" style="margin-right: 3px;" name="bulk_edit" id="bulk_edit">
                                    <i class="fas fa-edit fa-1x"></i>
                                </button>
                            </th>
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientInfo as $cInfo)
                        <tr> 
                            <td>{{$cInfo['nameClient']}}</td> 
                            <td>{{$cInfo['phoneClient']}}</td> 
                            <td><a href="https://mail.google.com/mail/?view=cm&fs=1&to={{$cInfo['emailClient']}}" target="_blank">{{$cInfo['emailClient']}}</a></td>
                            {{-- @foreach ($profitArray as $profitA)
                                @if ($cInfo['idClient'] == $profitA['idClient'])
                                    <td style="text-align:center;">${{number_format($profitA['totalProfit'],2)}}</td>
                                @endif
                            @endforeach --}}
                            @if (Auth::user()->rol != 'labor')
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$cInfo['idClient']}}">
                                    <i class="fas fa-clipboard-check"></i>
                                </button>
                            </td>
                            <td style="text-align: center; width:12%">
                                <input type="checkbox" name="client_checkbox[]" class="client_checkbox" value="{{$cInfo['idClient']}}">
                            </td> 
                            @endif
                        </tr>
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        @if (Auth::user()->rol != 'labor')
                            <th style="text-align:center;">Projects</th>
                            <th style="align-content: center">Actions</th>
                        @endif
                    </tr>
                </tfoot>
            </table>
        </div>

        @foreach ($clientInfo as $cInfo)
            <div class="modal fade" id="exampleModal{{$cInfo['idClient']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$cInfo['nameClient']}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Project</th>
                                <th scope="col">Address</th>
                                {{-- <th scope="col">Profit</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    @if ($cInfo['idClient'] == $project['idClient'])
                                        <tr>
                                            <td>{{$project['nameProject']}}</td>
                                            <td>{{$project['address']}}</td>
                                            {{-- <td>${{number_format($project['profit'],2)}}</td> --}}
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card-body" style="padding:8px;">
            {{-- Mobile --}}
            <div class="list-group mobile" id="accordion" >
                <div class="input-group rounded">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Search Client" 
                    id="searchClient" name="searchClient" style="margin-bottom: 10px;" required>
                </div>

                @foreach ($clientInfo as $cInfo )
                    <div href="#" class="list-group-item list-group-item-action flex-column align-items-start" data-toggle="collapse" data-target="#collapse{{$cInfo['idClient']}}" aria-expanded="false" aria-controls="collapse{{$cInfo['idClient']}}">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$cInfo['nameClient']}}</h5>
                            <a class="mb-1 text-left noprop" href="tel:+1{{$cInfo['phoneClient']}}" target="_blank">{{$cInfo['phoneClient']}}</a>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <a class="mb-1 text-left noprop" href="mailto:{{$cInfo['emailClient']}}" target="_blank">{{$cInfo['emailClient']}}</a>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            @foreach ($profitArray as $profitA)
                                @if ($cInfo['idClient'] == $profitA['idClient'])
                                    {{-- <p class="mb-1 text-left">Total Profit: ${{number_format($profitA['totalProfit'],2)}}</p> --}}
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if (Auth::user()->rol != 'labor')
                        <div id="collapse{{$cInfo['idClient']}}" class="collapse" aria-labelledby="heading{{$cInfo['idClient']}}" data-parent="#accordion">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Project</th>
                                        <th scope="col">Address</th>
                                        {{-- <th scope="col">Profit</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            @if ($cInfo['idClient'] == $project['idClient'])
                                                <tr>
                                                    <td>{{$project['nameProject']}}</td>
                                                    <td>{{$project['address']}}</td>
                                                    {{-- <td>${{number_format($project['profit'],2)}}</td> --}}
                                                    
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <button type="button" class="dropdown-item text-center" id="editClientMobile-{{$cInfo['idClient']}}" onclick="showModalMobile({{$cInfo['idClient']}})"class="badge badge-light">
                                <i class="fas fa-edit fa-1x"></i>
                            </button> --}}
                            <br>
                        </div>
                    @endif                    
                @endforeach
            </div>
            <br>
        </div>

        <!-- MODAL EDIT DATA -->
        <div class="modal fade" id="modalEditCheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title TEST </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body modalEditBody">
                </div>

            </div>
            </div>
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

@media only screen and (min-width: 600px) {
    div.mobile{
        display: none;
    }
    
}

@media only screen and (max-width: 600px) {
    table.desktop{
        display: none;
    }
    div.desktop{
        display:none; 
    }
    div.dataTables_wrapper{
        display: none;
    }
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


