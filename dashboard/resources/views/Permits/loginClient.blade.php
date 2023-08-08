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

    <title>Permits MVM</title>
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
    {{-- <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black !important;">
        <div class="col-2">
            <a class="navbar-brand" href="#">
                {{ HTML::image('images/logo.png', 'dispatch', array('class' => 'd-inline-block align-top', 'width' => '40', 'height'=>'40')) }}
            </a>
        </div>
        <div class="col-10" style="text-align: right;">
            <a class="text-left " href="tel:+13106224135" target="_blank" style="color: #e4a627;">
                <b class="secondText">
                    <i class="fas fa-phone-volume"></i>
                    (310) 622 4135
                </b>
            </a>
        </div>
    </nav> --}}
    <br>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <a href="https://mvm-machinery.com/"><img src="{{ asset('images/logo-MVM.png') }}"  class="responsive"></a>
                
            </div>
            <div class="card bg-white col" style="margin: 10px; padding-top:0px; border-color:white; margin:0px;">
                @if ($message == 'message')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>The quote has been send!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMessage()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div id="form1" class="card-body" style="padding-top:0px;"> 
                        <div class="firstText text-center"><b>Login</b></div>
                        <br>
                        <b><h5 class="text-center">To check your permit status please enter your email</h5></b>
                        <p class="info">We try and update as soon as we have any update with the city and/or inspectors, this is your best site to be updated with your permit. If you have multiple projects with us only initiated permits will show. Finished permits will be archived and not visible.</p>
                        <br>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <label class="secondText">Enter your email.</label>
                                        <input id="email" type="email" class="form-control form-control-sm border"  maxlength="100" name="email" placeholder="Email" autocomplete="email" required>
                                    </div>
                                </div>
                                @if ($message == 'Error')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Your email is wrong or is not registered!</strong>
                                    </div>
                                @endif
                                <br>
                                <div class="col text-center">
                                    <a class="btn btn-sm" href="#" onclick="gotoDashboard()" role="button" >Login</a>
                                </div>
                            </form>
                            
                            <div class="text-center" style="margin-top: 30px;">
                                <h6 class="card-title text-center" style="font-family: unset;"><b>MVM Machinery</b> </h6>
                                <h6 class="card-title info" style="font-family: unset;margin-bottom:2px;">If you have any question, please contact us!</h6>
                                <h6 class="secondText text-center">
                                    <b><a href="https://mail.google.com/mail/?view=cm&fs=1&to=permits@mvm-machinery.com" style="color: #000000;">permits@mvm-machinery.com</a></b>
                                </h6> 
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
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
</body>
</html>

<script>
    function gotoDashboard(){
        var email = $('#email').val();
        //window.location = "/Permitupdates/"+email+"/";
        window.location = "/dashboard/public/Permitupdates/"+email+"/";
        console.log(email); 
    }
</script>
