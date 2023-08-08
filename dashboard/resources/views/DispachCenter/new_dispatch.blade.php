@extends('master')
@section('title')
    <title>New Dispatch</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - JS -->
    <script src="js/dispatch/newDispatch.js"></script>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


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
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
        </div>
    </div>

    <div class="container" style="padding-left: 0px; padding-right: 0px;">
        <div class="card bg-light" style="margin: 10px;">
            <div class="row">
                <div id="form1" class="card-body" style="padding-left: 25px; padding-right: 25px;">
                    <h5 class="card-title text-center">New Dispatch Form</h5>
                    <form action='{{route('saveDispatch')}}' method="post" class="well form-horizontal" onsubmit="sub_butt.disabled = true; return true;" >
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Customer Name*</label> <span><a class="badge badge-secondary" id="mediumButton" data-toggle="modal" data-target="#mediumModal"
                                            data-attr="{{route('clientswebCreate',2)}}" style="font-size: 10px; cursor: pointer;" href="#">Add new</a></span>
                                        <input type="text" class="form-control form-control-sm" id="customername" name="full_name" autocomplete="off" required>
                                        <div class="showCustomer" id="showCustomer">
        
                                        </div>
                                    </div>
                                    <input type="text" id="idshowCustomer" name="idshowCustomer" hidden>
                                    
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Company Name or/Last Name if no Company Name</label>
                                        <input type="text" class="form-control form-control-sm" id="customercompany" name="compa">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Phone Number*</label>
                                        <input type="text" class="form-control form-control-sm" id="customerphone" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="customeremail" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Equipment to Rent</label> {{-- <span class="badge badge-secondary" style="font-size: 10px;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span> --}}
                                        <select class="form-control machinery1" id="exampleFormControlSelect1" style="font-size: 12px;" name="machinery">
                                            <option value="" selected>Select</option>
                                            @foreach($equip as $equipment)
                                                <option id="{{ $equipment -> id_machine }}"> {{ $equipment -> name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Price</label>
                                        <input type="text" class="form-control form-control-sm" id="priceEquip1" onclick="calculateRentalCost()">
                                    </div>
                                </div>
                            </div>

                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                            <div class="form-group" style="margin-bottom: 32px;">
                                <label style="font-size: 12px;">Delivery Address</label>
                                <div id="locationField" >
                                <input type="text" class="form-control form-control-sm" id="autocomplete" onFocus="geolocate()" name="address_1" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12" style="margin-bottom: 16px">
                                    <label style="font-size: 12px;">Delivery Date</label>
                                    <input id="datepicker" width="100%" name="start_date" autocomplete="off" required>
                                </div>
                                <div class="col-md-6 col-12" style="margin-bottom: 16px">
                                    <label style="font-size: 12px;">Estimated Return</label>
                                    <input id="datepicker2" width="100%" name="pick_up_date" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Delivery *</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="delivery" name="delivery" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Total Rental Cost*</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="rentalCost" name="rentalCost" required>
                                    </div>
                                </div>
                            </div>

                        {{-- <div class="collapse" id="collapseExample">
                            <div class="form-group">
                                <select class="form-control machinery2" id="exampleFormControlSelect1" style="font-size: 12px;">
                                    @foreach($equip as $equipment)
                                        <option id="{{ $equipment -> id_machine }}"> {{ $equipment -> name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" hidden>
                                <label style="font-size: 12px;">Price</label>
                                <input type="text" class="form-control form-control-sm" id="priceEquip2">
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" style="font-size: 12px;">Attachments / Delivery Notes</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
                        </div>

                        <div class="text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalFirstComment" onclick="geClientInformation()">
                                Submit Dispatch
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalFirstComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">This is the correct information?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div id="labelClientName">Name: </div>
                                    <div id="labelClientPhone">Phone: </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                                <button type="submit" id="sub_butt" class="btn btn-success btn-sm">Yes</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div><!-- End Col 4 -->
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modalPost" id="modalPost">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
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

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
        });
    </script>

    <script>
        $('input[name="phone"]').mask('+1 (000) 000-0000');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
