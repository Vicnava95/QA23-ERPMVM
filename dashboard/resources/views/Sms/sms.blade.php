@extends('master')
@section('title')
    <title>SMS</title>
@stop
@section('extra_links')
    <!-- Script Font Awesome-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

    {{HTML::script('js/sms/sms.js')}}
@stop

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-sm-4">
            @if(session()->has('messagePoolDemo'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('messagePoolDemo') }}</strong>
                    <button id="1" type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card" style="margin-bottom: 15px;">
                <div class="card-header text-center">
                    <b>Pool Demo Lead Form</b>
                </div>
                <div class="card-body">
                    <div class="form-area text-center" id="formPoolDemo" style="margin-top:16px;">
                        {{-- <form action="{{route('sendSmsPoolDemoLead')}}">
                            @method('POST') --}}
                            <span>Hello, thanks for your interest in our pool demolition services, please fill in your information here to get a quote in less than 24 hours <a href="https://bit.ly/3mhxhXS">https://bit.ly/3mhxhXS</a>. Do not reply here.</span>
                            <input type="text" class="form-control form-control-sm center-block" style="width: 250px;" id="smsPoolDemo" name="phonePoolDemo" autocomplete="off" required>
                            <button type="button" class="btn btn-success" onclick="sendPoolDemoSMS(1)">English SMS</button>
                            <button type="button" class="btn btn-success" onclick="sendPoolDemoSMS(2)">Español SMS</button>
                        {{-- </form> --}}
                    </div>
                    <br>
                    <div class="alert alert-danger alertPhone" id="alertEmptyPoolDemo" role="alert">
                        <strong>This field can't empty</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alertDigits" id="alertDigitPoolDemo" role="alert">
                        <strong>Please enter the 10 digits!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            @if(session()->has('messageEquipment'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('messageEquipment') }}</strong>
                    <button id="2" type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true" >&times;</span>
                    </button>
                </div>
            @endif
            <div class="card" style="margin-bottom: 15px;">
                <div class="card-header text-center">
                    <b>Equipment Rental Form</b>
                </div>
                <div class="card-body">
                    <div class="form-area text-center" id="formEquipmentRental" style="margin-top:16px;">
                        {{-- <form action="{{route('sendSmsEquipmentRental')}}">
                            @method('POST') --}}
                            <span>Hello, thanks for your interest in renting from us, please fill in your information in the next link to generate a dispatch <a href="https://bit.ly/3xcs7DA">https://bit.ly/3xcs7DA</a>. If you need to change something please call us or just submit another form. Do not reply here.</span>
                            <input type="text" class="form-control form-control-sm center-block" style="width: 250px;" id="smsEquipmentRental" name="phoneEquipmentRental" autocomplete="off" required>
                            <button type="button" class="btn btn-success" onclick="sendEquipmentRentalSMS(1)">English SMS</button>
                            <button type="button" class="btn btn-success" onclick="sendEquipmentRentalSMS(2)">Español SMS</button>
                        {{-- </form> --}}
                    </div>
                    <br>
                    <div class="alert alert-danger alertPhone" id="alertEmptyEquipmentRental" role="alert">
                        <strong>This field can't empty</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alertDigits" id="alertDigitEquipmentRental" role="alert">
                        <strong>Please enter the 10 digits!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            @if(session()->has('messageEstimate'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('messageEstimate') }}</strong>
                    <button id="3" type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card" style="margin-bottom: 15px;">
                <div class="card-header text-center">
                    <b>Estimate Request Form</b>
                </div>
                <div class="card-body">
                    <div class="form-area text-center" id="formEstimateRequest" style="margin-top:16px;">
                        {{-- <form action="{{route('sendSmsEstimateRequest')}}">
                            @method('POST') --}}
                            <span>Hello, for faster service, please fill in your information here <a href="https://bit.ly/3GMPtlO">https://bit.ly/3GMPtlO</a>. Estimate have a 24 hour turn around. Supplemental documents attached to form please or email us: bids@mvm-machinery.com</span>
                            <input type="text" class="form-control form-control-sm center-block" style="width: 250px;" id="smsEstimateRequest" name="phoneEstimate" autocomplete="off" required>
                            <button type="button" class="btn btn-success" onclick="sendEstimateSMS(1)">English SMS</button>
                            <button type="button" class="btn btn-success" onclick="sendEstimateSMS(2)">Español SMS</button>
                        {{-- </form> --}}
                    </div>
                    <br>
                    <div class="alert alert-danger alertPhone" id="alertEmptyEstimate" role="alert">
                        <strong>This field can't empty</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alertDigits" id="alertDigitEstimate" role="alert">
                        <strong>Please enter the 10 digits!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $('#smsPoolDemo').mask('+1 (000) 000-0000');
    $('#smsEquipmentRental').mask('+1 (000) 000-0000');
    $('#smsEstimateRequest').mask('+1 (000) 000-0000');
</script>
<style>
    .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
        margin-bottom: 10px;
    }
    .alert-danger{
        padding-bottom: 5px;
        padding-top: 5px;
    }
</style>

@stop
