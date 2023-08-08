@extends('master')
@section('title')
    <title>Rental Forms</title>
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
    <!-- CSS -->
    {{HTML::style('css/clientForm/allRentalForm.css')}}

    <!-- DataTable JS-->
    <script src="js/clientForm/allRentalForm.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('dispatchcenter')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            <h4><a href="{{route('rentalClientForm')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Rental"><i class="uil uil-file-plus-alt"></i></a></h4>
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container" style="margin-top: 15px;max-width: 1340px;">
    @if(session()->has('updateMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('updateMessage') }}</strong>
            <button id="2" type="button" class="close" data-dismiss="alert" aria-label="Close" >
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
    @endif
    <div class="card text-center">
        <div class="card-header " style="font-size: 20px;">
            Rental Forms
        </div>
        <div class="card-body">
            <table id="example" class="display nowrap" style="width:100%; padding-top:10px">
                <thead>
                    <tr>
                        <th style="text-align:center;">Client Name</th>
                        <th style="text-align:center;">Client Phone</th>
                        <th>Delivery Date</th>
                        <th>Estimated Return</th>
                        <th style="text-align:center;">Delivery</th>
                        <th style="text-align:center;">Machineries</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
            <!-- style="white-space: pre-wrap;" -->
                <tbody>
                @foreach($allRental as $rental)
                    <tr>
                        <td style="text-align:center;">{{ $rental->nameFormRental }}</td>
                        <td style="text-align:center;"><a class="linkhref" href="tel:{{ $rental->phoneFormRental }}">{{ $rental->phoneFormRental }}</a></td>
                        <td class="text-center" >{{ $rental->deliveryDateFormRental }}</td>
                        <td class="text-center">{{ $rental->estimatedDateFormRental }}</td>
                        <td style="text-align:center; white-space: pre-wrap;"><a class="linkhref" href="http://maps.apple.com/?q={{ $rental->deliveryAddressFormRental }}" target="blanck">{{ $rental->deliveryAddressFormRental }}</a></td>
                        <td style="text-align:center;">
                            @foreach ($allRentaMachinery as $rentaMachinery)
                                @if ($rentaMachinery->rentalForm_fk == $rental->id)
                                    {{$rentaMachinery->machinery_fk}},
                                @endif
                            @endforeach
                        </td>
                        <td style="text-align:center;">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettings{{$rental->id}}">
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- SHOW INFO RENTAL -->
                    <div class="modal fade" id="modalSettings{{$rental->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalCenterTitle">{{$rental->nameFormRental}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <b>Client Name:</b> <br>{{$rental->nameFormRental}}
                                    </div>
                                    <div class="col-6 text-left">
                                        <b>Client Phone: </b> <br><a class="linkhref" href="tel:{{$rental->phoneFormRental}}" >{{ $rental->phoneFormRental }}</a> 
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-6 text-left">
                                        <b>Delivery Date:</b> <br>{{$rental->deliveryDateFormRental}}
                                    </div>
                                    <div class="col-6 text-left">
                                        <b>Estimated Return: </b> <br>{{ $rental->estimatedDateFormRental }}
                                    </div>
                                </div>
                                
                                <div class="row text-left" style="margin-top: 5px;">
                                    <div class="col-6">
                                        <b>Machineries:</b> <br>
                                        @foreach ($allRentaMachinery as $rentaMachinery)
                                            @if ($rentaMachinery->rentalForm_fk == $rental->id)
                                                {{$rentaMachinery->machinery_fk}},
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-6">
                                        <b>Delivery Address:</b> <br> <a class="linkhref" href="http://maps.apple.com/?q={{$rental->deliveryAddressFormRental}}">{{$rental->deliveryAddressFormRental}}</a>
                                    </div>
                                </div>
                                @if ($rental->deliveryNote != null)
                                    <div class="row text-left">
                                        <div class="col-12">
                                            <b>Notes: </b> <br>
                                            {{ $rental->deliveryNote}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer" style="justify-content: center !important;">
                                <div class="row">
                                    <div class="col-4"><a style="padding: 5px;" href="{{route('editRentalForm',$rental->id)}}" class="badge badge-light"><i class="fas fa-edit"></i> Edit</a></div>
                                    <div class="col-4 "><a style="padding: 5px;" href="" data-toggle="modal" data-dismiss="modal" aria-label="Close" data-target="#modalDelete{{$rental->id}}" class="badge badge-light"><i class="fas fa-trash-alt"></i> Delete</a></div>
                                    <div class="col-4"><a style="padding: 5px;" href="{{route('printPDF',$rental)}}" class="badge badge-light"><i class="fas fa-file-contract"></i> Contract</a></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Delivery Date</th>
                        <th>Estimated Return</th>
                        <th style="text-align:center;">Client Name</th>
                        <th style="text-align:center;">Delivery</th>
                        <th style="text-align:center;">Machinerys</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @foreach ($allRental as $rental)
        <!-- DELETE INFO RENTAL -->
        <div class="modal fade" id="modalDelete{{$rental->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">Delete Rental Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 text-left">
                            <b>Client Name:</b> <br>{{$rental->nameFormRental}}
                        </div>
                        <div class="col-6 text-left">
                            <b>Client Phone: </b> <br><a class="linkhref" href="tel:{{$rental->phoneFormRental}}" >{{ $rental->phoneFormRental }}</a> 
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-6 text-left">
                            <b>Delivery Date:</b> <br>{{$rental->deliveryDateFormRental}}
                        </div>
                        <div class="col-6 text-left">
                            <b>Estimated Return: </b> <br>{{ $rental->estimatedDateFormRental }}
                        </div>
                    </div>
                    
                    <div class="row text-left" style="margin-top: 5px;">
                        <div class="col-6">
                            <b>Machineries:</b> <br>
                            @foreach ($allRentaMachinery as $rentaMachinery)
                                @if ($rentaMachinery->rentalForm_fk == $rental->id)
                                    {{$rentaMachinery->machinery_fk}},
                                @endif
                            @endforeach
                        </div>
                        <div class="col-6">
                            <b>Delivery Address:</b> <br> <a class="linkhref" href="http://maps.apple.com/?q={{$rental->deliveryAddressFormRental}}">{{$rental->deliveryAddressFormRental}}</a>
                        </div>
                    </div>
                    @if ($rental->deliveryNote != null)
                        <div class="row text-left">
                            <div class="col-12">
                                <b>Notes: </b> <br>
                                {{ $rental->deliveryNote}}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer" style="justify-content: center !important;">
                    <div class="row">
                        <a href="{{route('deleteRentalForm',$rental)}}" class="btn btn-outline-danger btn-sm" role="button">Delete</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endforeach
    
    
</div>
<style>
.example_wrapper{
    padding-top: 10px;
}
.linkhref{
    color: black;
    text-decoration: underline;
}
</style>

@stop


