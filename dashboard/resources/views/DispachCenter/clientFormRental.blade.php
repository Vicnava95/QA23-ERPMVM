<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    {{-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>MVM Rental</title>
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/app.css')}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <!--
        RTL version
    -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

    {{HTML::style('css/clientForm/clientFormrental.css')}}
    {{HTML::script('js/clientForm/clientFormrental.js')}}
    

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- START Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=TitiliumWeb">
    <!-- END Google Fonts -->
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <img src="{{ asset('images/logo-MVM.png') }}"  class="responsive">
            </div>
            <div class="card bg-white col" style="margin: 10px; padding-top:0px; border-color:white; margin:0px;">
                {{-- @if ($message == 'message')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>The quote has been sent!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMessage()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}
                <div class="row">
                    <div id="form1" class="card-body" style="padding-top:0px;"> 
                        <div class="firstText text-center"><b>EQUIPMENT RENTAL</b></div>
                        <div class="secondText info">Please fill out this form, we will get back to you if we need more information.</div>
                        <br>
                        <form action="{{route('storeRentalForm')}}" name="form1" method="POST" id="formRentalPost" class="well form-horizontal">
                            @csrf
                            @method('POST')
                            <fieldset>
                                <div class="form-group">
                                    <div class="row rowClientEquipment">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">1. Select equipment.</label> {{-- <span class="badge badge-secondary addRowFields" onclick="showCategories()" role="button">Add More</span> --}}
                                            <br>
                                            <div class="row filaMachinery">
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="maquina232D" value="232D"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/232D.jpg') }}"/>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="maquina262D" value="262D"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/262D.jpg') }}"/>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="maquina259D" value="259D"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/259D.jpg') }}"/>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="maquina303E" value="303E"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/303E.jpg') }}"/>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="maquina304E" value="304E"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/324E.jpg') }}"/>
                                                    </label>
                                                </div>
                                                <div class="col-md-3 col-xs-6 col-sm-2 estilo">
                                                    <label class="checkeable">
                                                        <input type="checkbox" name="inputMachinerys[]" id="BREAKER" value="BREAKER"/>
                                                        <img style="margin: 10px;" src="{{ asset('images/form/Breaker.jpg') }}"/>
                                                    </label>
                                                </div>
                                                
                                            </div>

                                            {{-- <select class="form-control form-control-sm border textColor" aria-label="Default select example" name="inputMachinerys[]" id="inputMachinerys" required>
                                                <option class="textColor" value="0" selected>Select</option>
                                                @foreach ($machinerys as $machinery )
                                                    <option class="textColor" value="{{$machinery->model}}">{{$machinery->name}}</option>
                                                @endforeach
                                            </select> --}}
                                            
                                            {{-- <div class="addMoreMachinerys" id="addMoreMachinerys">
            
                                            </div> --}}
                                            
                                            <div class="alert alert-danger alertEquipment" id="showAlertEquipment" role="alert" style="margin-top: 0px;">
                                                <strong>Please!</strong> Select a equipment
                                                <button type="button" class="close" onclick="hideEquipmentAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-sm" id="btnEquipmentNext" onclick="showDelivery()" >Next</button>
                                        </div>
                                    </div>
                                    <div class="row rowClientDelivery">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">2. Delivery Address.</label>
                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete&language=en" async defer></script>
                                            <div id="locationField" >
                                                <input type="text" class="form-control form-control-sm border" id="autocomplete" onFocus="geolocate()" name="project_address" required>
                                            </div>

                                            <div class="alert alert-danger alertAddress" id="showAlertAddress" role="alert">
                                                <strong>Please enter a delivery address!</strong> This field can't empty.
                                                <button type="button" class="close" onclick="hideAddressAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-sm" id="btnDeliveryPrevious" onclick="showEquipment()">Previous</button>
                                        </div>
                                        <div class="col-6 text-left">
                                            <button type="button" class="btn btn-sm" id="btnDeliveryNext" onclick="showDate()" >Next</button>
                                        </div>
                                    </div>
                                    <div class="row rowClientDates">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px; margin-top: 15px;">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12" style="margin-bottom: 15px;">
                                                    <label class="secondText" style="margin-bottom: 0px;">3. Delivery Date.</label>
                                                    <input id="datepicker" class="form-control form-control-sm border" width="100%" name="start_date" autocomplete="off" required>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                                                    <label class="secondText" style="margin-bottom: 0px;">4. Estimated Return.</label>
                                                    <input id="datepicker2" class="form-control form-control-sm border" width="100%" name="pick_up_date" autocomplete="off" required>
                                                </div>
                                            </div>
                                            
                                            <div class="alert alert-danger alertStartDate" id="showAlertStartDate" role="alert">
                                                <strong>Please!</strong> Enter a delivery date.
                                                <button type="button" class="close" onclick="hideStartDateAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="alert alert-danger alertEndDate" id="showAlertEndDate" role="alert">
                                                <strong>Please!</strong> Enter a estimated return.
                                                <button type="button" class="close" onclick="hideEndDateAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-sm" id="btnDatesPrevious" onclick="showDelivery()">Previous</button>
                                        </div>
                                        <div class="col-6 text-left">
                                            <button type="button" class="btn btn-sm" id="btnDatesNext" onclick="showNotes()" >Next</button>
                                        </div>
                                    </div>
                                    <div class="row rowClientNotes">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">5. Delivery Notes.</label>
                                            <input type="text" class="form-control form-control-sm border" id="deliveryNotes" maxlength="100" name="deliveryNotes" placeholder="Notes" autocomplete="off" required>
                                            
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-sm" id="btnDeliveryPrevious" onclick="showDate()">Previous</button>
                                        </div>
                                        <div class="col-6 text-left">
                                            <button type="button" class="btn btn-sm" id="btnPhoneNext" onclick="showName()" >Next</button>
                                        </div>
                                        
                                    </div>
                                    <div class="row rowClientName">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">6. Enter your name.</label>
                                            <input type="text" class="form-control form-control-sm border" id="nameClient" maxlength="100" name="nameClient" placeholder="Name" autocomplete="off" required>
                                            
                                            <div class="alert alert-danger alertName" id="showAlertName" role="alert">
                                                <strong>Please enter your name!</strong> This field can't empty.
                                                <button type="button" class="close" onclick="hideNameAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-sm" id="btnEquipmentPrevious" onclick="showNotes()">Previous</button>
                                        </div>
                                        <div class="col-6 text-left">
                                            <button type="button" class="btn btn-sm" id="btnNameNext" onclick="showPhone()">Next</button>
                                        </div>
                                    </div>
                                    <div class="row rowClientPhone">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">7. Enter your phone.</label>
                                            <input type="text" class="form-control form-control-sm border" id="phoneClient" maxlength="100" name="phoneClient" placeholder="Phone" autocomplete="off" required>
                                            
                                            <div class="alert alert-danger alertPhone" id="showAlertPhone" role="alert">
                                                <strong>Please enter your phone!</strong> This field can't empty.
                                                <button type="button" class="close" onclick="hidePhoneAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-danger alertDigits" id="showAlertDigits" role="alert">
                                                <strong>Please enter the 10 digits!</strong>  +1 (xxx) xxx-xxxx.
                                                <button type="button" class="close" onclick="hideDigitsAlert()"  aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-sm" id="btnSubnit" onclick="doneSubmit()" >Submit</button>
                                            {{-- <button id="sendForm" class="btn btn-sm">Submit</button> --}}
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="text-center" style="margin-top: 30px;">
                                    <h6 class="card-title text-center" style="font-family: unset;"><b>MVM Machinery</b> </h6>
                                    {{-- <h6 class="card-title text-center" style="font-family: unset;margin-bottom:12px;">Lic #1082537 | 
                                        <a class="mb-1 text-left noprop" href="tel:+13106224135" target="_blank" style="color: #e4a627;">
                                            <b>
                                                <i class="fas fa-phone-volume"></i>
                                                (310) 622 4135
                                            </b>
                                        </a>
                                    </h6> --}}
                                    
                                    <div>
                                        <a href="https://www.instagram.com/mvmmachinery/"><i class="fab fa-instagram fa-2x" style="color: black; margin-right:8px;"></i></a> 
                                        <a href="https://www.yelp.com/biz/mvm-machinery-los-angeles-2"><i class="fab fa-yelp fa-2x" style="color: black;"></i></a> 
                                        {{-- <i class="fab fa-instagram-square fa-2x"></i>
                                        <i class="fab fa-facebook fa-2x"></i> --}}
                                    </div>
        
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
</body>
<script>
    $('input[name="phoneClient"]').mask('+1 (000) 000-0000');
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
    });
</script>
<style>
.estilo{
        margin: 7px;
        padding-left: 0px;
        padding-right: 0px;
        
        width: 100px;
    }
</style>

</html>