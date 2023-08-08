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

    <title>Quote Request</title>
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

    {{HTML::style('css/quoteRequest/quoteRequest.css')}}
    {{HTML::script('js/quoteRequest/quoteRequest.js')}}

    <!-- START Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=TitiliumWeb">
    {{-- <style>
        .firstText{
            font-family: 'TitiliumWeb', sans-serif;
            font-size: 38px;
            font-weight: 700;
        }
        .secondText {
            font-family: 'Nunito', sans-serif;
            font-size: 18px;
            font-weight: 400;
        }
    </style> --}}
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
                @if ($message == 'message')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>The quote has been sent!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMessage()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div id="form1" class="card-body" style="padding-top:0px;"> 
                        <div class="firstText text-center"><b>ESTIMATE REQUEST</b></div>
                        <div class="secondText info">Please fill out this form, we will get back to you if we need more information. {{-- If you have Soil Reports or Plans please email them here: --}}</div>
                        {{-- <h6 class="secondText text-center">
                           <b><a href="https://mail.google.com/mail/?view=cm&fs=1&to=bids@mvm-machinery.com" style="color: #e4a627;">bids@mvm-machinery.com</a></b>
                        </h6> --}} 
                        <br>
                        <form action="{{route('postQuoteRequest')}}" name="form1" method="POST" class="well form-horizontal">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <div class="row clientName">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">1. Enter your name.</label>
                                            <input type="text" class="form-control form-control-sm border" id="nameClient" maxlength="100" name="nameClient" placeholder="Name" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6 offset-md-3 text-center">
                                            <a class="btn btn-sm" href="#" role="button" id="btnNameNext" onclick="showPhone()">Next</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row clientPhone">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">2. Enter your phone.</label>
                                            <input type="text" class="form-control form-control-sm border" id="phoneClient" name="phoneClient" placeholder="Phone" autocomplete="off" required>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm" href="#" role="button" id="btnPhonePrevious" onclick="hidePhone()">Previous</a>
                                        </div>
                                        <div class="col-6 text-left">
                                            <a class="btn btn-sm" href="#" role="button" id="btnPhoneNext" onclick="showEmail()" >Next</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row clientEmail">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">3. Enter your Email.</label>
                                            <input type="email" class="form-control form-control-sm border"  id="emailContact" maxlength="100" name="emailContact" placeholder="Email" autocomplete="off" required>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm" href="#" role="button" id="btnEmailPrevious" onclick="hideEmail()">Previous</a>
                                        </div>
                                        <div class="col-6 text-left">
                                            <a class="btn btn-sm" href="#" role="button" id="btnEmailNext" onclick="showService()">Next</a>
                                        </div>
                                    </div>

                                    <div class="row clientService">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">4. Select service.</label>
                                            <div class="btn-group-toggle text-center" data-toggle="buttons">
                                                <label class="btn btnSecondary selectStyle" id="label1" onclick="getService1()">
                                                    <input class="serviceSelect" type="radio" id="1" name="service" value="1">Grading
                                                </label>
                                             
                                                <label class="btn btnSecondary selectStyle" id="label2" onclick="getService2()">
                                                    <input class="serviceSelect" type="radio" id="2" name="service" value="2" >Pool Excavation
                                                </label>
                                             
                                                <label class="btn btnSecondary selectStyle" id="label3" onclick="getService3()">
                                                    <input class="serviceSelect" type="radio" id="3" name="service" value="3" >House Demolition
                                                </label>

                                                <label class="btn btnSecondary selectStyle"  id="label4" onclick="getService4()">
                                                    <input class="serviceSelect" type="radio" id="4" name="service" value="4" >Pool Demolition
                                                </label>

                                                <label class="btn btnSecondary selectStyle" id="label5" onclick="getService5()">
                                                    <input class="serviceSelect" type="radio" id="5" name="service" value="5" >Concrete Services
                                                </label>
                                                
                                                <label class="btn btnSecondary selectStyle" id="label6" onclick="getService6()">
                                                    <input class="serviceSelect" type="radio" id="6" name="service" value="6" >Excavation Services
                                                </label>

                                                <label class="btn btnSecondary selectStyle" id="label7" onclick="getService7()">
                                                    <input class="serviceSelect" type="radio" id="7" name="service" value="7" >Concrete/Asphalt
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm" href="#" role="button" id="btnServicePrevious" onclick="hideService()">Previous</a>
                                        </div>
                                        <div class="col-6 text-left">
                                            <a class="btn btn-sm" href="#" role="button" id="btnServiceNext" onclick="showAddress()">Next</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row clientAddress">
                                        <div class="col-md-6 offset-md-3" style="margin-bottom: 15px;">
                                            <label class="secondText">5. Jobsite address.</label>
                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                                            <div id="locationField" >
                                                <input type="text" class="form-control form-control-sm border" id="autocomplete" onFocus="geolocate()" name="project_address" required>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn btn-sm" href="#" role="button" id="btnAddressPrevious" onclick="hideAddress()">Previous</a>
                                        </div>
                                        <div class="col-6 text-left">
                                            <button id="sendForm" class="btn btn-sm">Submit</button>
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
    $('.clientPhone').hide();
    $('.clientEmail').hide();
    $('.clientService').hide();
    $('.clientAddress').hide();
</script>

</html>