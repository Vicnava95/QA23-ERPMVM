@extends('master')
@section('title')
    <title>All Rentals</title>
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
    <script src="js/rentals/allRentals.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <a href="{{route('dispatchcenter')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            <a href="{{route('new_dispatch')}}"><div class="btn btn-outline-secondary btn-sm" >New Dispatch</div></a>
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container" style="margin-top: 30px;max-width: 1340px;">
    <div class="card text-center">
            <div class="card-header " style="font-size: 20px;">
                Rentals
            </div>
    <div class="card-body">
        <table id="example" class="display nowrap" style="width:100%; padding-top:10px">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Date Out</th>
                    <th>Date In</th>
                    <th>Customer</th>
                    <th style="text-align:center;">Address</th>
                    <th>Equipment</th>
                    <th>Days Rented</th>
                    <th>Price Day</th>
                    <th>Delivery/Pickup</th>
                    <th>Total</th>
                    <th>Notes</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
        <!-- style="white-space: pre-wrap;" -->
            <tbody>
            @foreach($allRentals as $rental)
                <tr>
                    <td>
                        @if($rental['payStatus'] == 'Pending')
                            <span onclick="changePaymentStatusPay({{$rental['id']}})" id="paymentStatus-{{$rental['id']}}" class="badge badge-secondary">Pending</span>
                        @else
                            <span onclick="changePaymentStatusPending({{$rental['id']}})" id="paymentStatus-{{$rental['id']}}" class="badge badge-success">Pay</span>
                        @endif
                    </td>
                    <td>{{$rental['dateOut']}}</td>
                    <td>{{$rental['dateIn']}}</td>
                    <td style="white-space: pre-wrap;">{{$rental['customer']}}</td>
                    <td style="white-space: pre-wrap;">{{$rental['deliveryAddress']}}</td>
                    <td style="text-align:center;">{{$rental['machinery']}}</td>
                    <td style="text-align:center;">{{$rental['diffDays']}}</td>
                    <td style="text-align:center;">${{$rental['priceDay']}}</td>
                    <td style="text-align:center;">${{$rental['delivery']}}</td>
                    <td style="text-align:center;">${{$rental['totalDelivery']}}</td>
                    <td style="white-space: pre-wrap;">{{$rental['notes']}}</td>
                    {{-- <td style="text-align:center;">
                        <div class="dropdown " id="dropdown{{$rental['id']}}">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{$rental['id']}}" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropper{{$rental['id']}}" style="width: 5px;">
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('project.moreInfo',$project)}}" class="badge badge-light"><i class="fas fa-eye fa-1x"></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('project.edit',$project)}}" class="badge badge-light"><i class="fas fa-edit fa-1x"></i></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('project.confirm',$project)}}" class="badge badge-light"><i class="fas fa-trash-alt fa-1x"></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('phase.index',$project)}}" class="badge badge-light"><i class="fas fa-clipboard-list fa-1x"></i></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.morePurchase',$project)}}" class="badge badge-light"><i class="fas fa-cart-plus fa-1x"></i></a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('project.projectTracker',$project)}}" class="badge badge-light"><i class="fas fa-hand-holding-usd fa-1x"></i></a>
                            </div>
                        </div>
                    </td> --}}
                </tr>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pay" hidden>
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="paymentModalPay-{{$rental['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Do you want to add a comment to the payment?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div id="form-first" class="form-area">
                            <div class="modal-body">
                                    <form id="formComments" action="{{route('paymentStatus',[$rental['id'],1])}}">
                                        @method('POST')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <textarea class="form-control form-control-sm" id="paymentCommentsModalPay" rows="5" name="paymentCommentsModalPay" maxlength="2000">{{$rental['payComments']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="formComments" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    
                    </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="paymentModalPending-{{$rental['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Do you want to add a comment to the pending payment?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div id="form-second" class="form-area">
                            <div class="modal-body">
                                    <form id="formComments2" action="{{route('paymentStatus',[$rental['id'],0])}}">
                                        @method('POST')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <textarea class="form-control form-control-sm" id="paymentCommentsModalPending" rows="5" name="paymentCommentsModalPending" maxlength="2000">{{$rental['payComments']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="formComments2" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Date Out</th>
                    <th>Date In</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Equipment</th>
                    <th>Days Rented</th>
                    <th>Price Day</th>
                    <th>Delivery/Pickup</th>
                    <th>Total</th>
                    <th>Notes</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    
</div>
<script>
    function changePaymentStatusPay(id){                                                                            
        $('#paymentModalPay-'+id+'').modal('show');
    }

    function changePaymentStatusPending(id){                                                                            
        $('#paymentModalPending-'+id+'').modal('show');
    }
</script>
<style>
    .example_wrapper{
        padding-top: 10px;
    }
    span{
        cursor: pointer;
    }
</style>
@stop


