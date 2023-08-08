@extends('master')
@section('title')
<title>Edit Rental Form</title>
@stop
@section('extra_links')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<!-- Date Picker -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<!-- Script Font Awesome-->
<script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

<!-- Fields - Style CSS -->
{{HTML::style('css/fields-style.css')}}
{{HTML::style('css/dailyReport/dailyReport.css')}}

<!-- Fields - JS -->
{{HTML::script('js/dailyReport/dailyReport.js')}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

{{HTML::style('css/gmap.css')}}
{{HTML::script('js/gmap.js')}}


@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('showAllRentalForms')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            
        </div>
    </div>
</div>

<div class="container" style="max-width: 450px;">
    <div class="card">
        <div class="card-body">
            <div class="form-area">
                <h5 class="card-titlle text-center">Edit Rental Form</h5>
                <form action="{{route('updateRentalForm',$rental)}}">
                    @method('POST')
                    <div class="row">
                        <div class="col-6 text-left">
                            <b>Client Name:</b> 
                            <input type="text" class="form-control form-control-sm" name="clientName" value="{{$rental->nameFormRental}}">
                        </div>
                        <div class="col-6 text-left">
                            <b>Client Phone: </b> 
                            <input type="text" class="form-control form-control-sm" name="clientPhone" value="{{$rental->phoneFormRental}}">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-6 text-left">
                            <b>Delivery Date:</b> 
                            <input id="datepicker" width="100%" class="form-control form-control-sm" name="clientDeliveryDate" autocomplete="off" value="{{$rental->deliveryDateFormRental}}" required>
                        </div>
                        <div class="col-6 text-left">
                            <b>Estimated Return: </b>
                            <input id="datepicker2" width="100%" class="form-control form-control-sm" name="clientEstimatedReturn" autocomplete="off" value="{{ $rental->estimatedDateFormRental }}" required> 
                        </div>
                    </div>
                
                    <div class="row text-left" style="margin-top: 5px;">
                        <div class="col-12">
                            <b>Delivery Address:</b> 
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete&language=en" async defer></script>
                            <div id="locationField" >
                                <input type="text" class="form-control form-control-sm border" id="autocomplete" onFocus="geolocate()" name="clientDeliveryAddress" value="{{$rental->deliveryAddressFormRental}}" required>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top: 15px;">
                            <b>Machineries:</b> <br>
                            @foreach ($machinerys as $machinery)
                                <div class="form-check" required>
                                    <input class="form-check-input" type="checkbox" name="inputMachinerys[]" value="{{$machinery->model}}" id="flexCheckDefault{{$machinery->model}}" 
                                    @foreach ($allRentaMachinery as $rentaMachinery)
                                        @if ($rentaMachinery->rentalForm_fk == $rental->id)
                                            @if ($rentaMachinery->machinery_fk == $machinery->model)
                                                checked
                                            @endif
                                        @endif
                                    @endforeach >
                                    <label class="form-check-label" for="flexCheckDefault{{$machinery->model}}">
                                        {{$machinery->model}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                        <div class="row text-left">
                            <div class="col-12">
                                <b>Notes: </b> <br>
                                <textarea class="form-control form-control-sm" name="clientDeliveryNote" id="" rows="3">{{ $rental->deliveryNote}}</textarea>
                            </div>
                        </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-outline-secondary btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        min: '{{}}'
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
    });
    $('input[name="clientPhone"]').mask('+1 (000) 000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@stop
