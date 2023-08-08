@extends('master')
@section('title')
    <title>Leads</title>
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
    <script src="js/clientsweb/clientsweb.js"></script>
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
            @if (Auth::user()->rol != 'labor')
                <h4><a href="{{route('clientswebCreate')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Lead"><i class="uil uil-user-plus"></i></a></h4>
            @endif
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->

<div class="container" style="margin-top: 30px;">  
    <div class="card text-center">
        <div class="card-header " style="font-size: 20px;">
            Leads
        </div>
        <div class="card-body" style="padding: 5px;">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Client Source</th>
                        @if (Auth::user()->rol != 'labor')
                        <th style="align-content: center">
                            <div class="row" style="text-align: center;">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalEditCheck" style="margin-right: 3px;" name="bulk_edit" id="bulk_edit">
                                    <i class="fas fa-edit fa-1x"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDeleteCheck">
                                    <i class="fas fa-trash-alt fa-1x"></i>
                                </button>
                            </div>
                        </th>
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                @foreach ($infoClient as $idClient)
                        @if ($idClient['idClient'] == $client->id)
                            @foreach ($clientSource as $cSource)
                                @if ($cSource->id == $idClient['idLanding'])
                                <tr> 
                                    <td style="width:22%">{{$client->nameClient}}</td> 
                                    <td style="width:22%">{{$client->phoneClient}}</td> 
                                    <td style="width:22%"><a href="http://maps.apple.com/?q={{$client->addressClient}}">{{$client->addressClient}} </a></td>
                                    <td style="width:22%">{{$cSource->nameClientSource}}</td>   
                                    @if (Auth::user()->rol != 'labor')
                                        <td style="text-align: center; width:12%">
                                            <input type="checkbox" name="client_checkbox[]" class="client_checkbox" value="{{$client->id}}">
                                        </td> 
                                    @endif         
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Client Source</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="card-body" style="padding:8px;">
            <div class="list-group mobile" id="accordion" >
                <div class="input-group rounded">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Search Client" 
                    id="searchClient" name="searchClient" style="margin-bottom: 10px;" required>
                </div>
                <div class="showListClients" id="showListClients">

                </div>
                <div class="showClient" id="showClient">

                </div>
                @foreach ($clients as $client )
                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start" data-toggle="collapse" data-target="#collapse{{$client->id}}" aria-expanded="false" aria-controls="collapse{{$client->id}}" onclick="showSourceClient({{$client->id}})">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$client->nameClient}}</h5>
                        <a class="mb-1 text-left noprop" href="tel:+1{{$client->phoneClient}}" target="_blank">{{$client->phoneClient}}</a>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <a class="mb-1 text-left noprop" href="mailto:{{$client->emailClient}}" target="_blank">{{$client->emailClient}}</a>
                    </div>

                    <div class="d-flex w-100 justify-content-between">
                        @foreach ($infoClient as $idClient)
                            @if ($idClient['idClient'] == $client->id)
                                @foreach ($clientSource as $cSource)
                                    @if ($cSource->id == $idClient['idLanding'])
                                    <p class="mb-1 text-left">{{$cSource->nameClientSource}}</p>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <a class="mb-1 text-left noprop" href="http://maps.apple.com/?q={{$client->addressClient}}">{{$client->addressClient}}</a>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        @foreach ($infoClient as $idClient)
                            @if ($idClient['idClient'] == $client->id)
                                <p class="mb-1 text-left">{{$idClient['dateCreate']}}</p>
                                <p class="mb-1 text-left">{{$idClient['timeCreate']}}</p>
                            @endif
                        @endforeach
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

  <!-- MODAL DELETE DATA -->
  <div class="modal fade" id="modalDeleteCheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to Delete this Data?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT DATA -->
  <div class="modal fade" id="modalEditCheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modalEditBody">
        </div>

      </div>
    </div>
  </div>

<style>
    #dataTables_wrapper{
        margin: 5px;
    }
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
                      
    });
    $(".noprop").click(function(event) {
event.stopPropagation();
});
</script>
@stop


