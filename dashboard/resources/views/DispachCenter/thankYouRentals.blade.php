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
        <div class="row" style="margin-top:25%;">
            <div class="col-xs-12 col-md-6 text-center">
                <img src="{{ asset('images/logo-MVM.png') }}" style="width: 250px; height:250px;" >
            </div>
            <div class="col-xs-12 col-md-6 text-center">
                <div class="firstText text-center"><b>THANK YOU</b></div>
                <div class="secondText info"><b>Your information will be reviewed shortly and we will get back to you as soon as possible. </b> </div>
                <br>
                <a class="secondText" style="color: black;" href="https://mvm-machinery.com"><b>mvm-machinery.com</b></a>
                
                <div style="margin-top:10px;">
                    <a href="https://www.instagram.com/mvmmachinery/"><i class="fab fa-instagram fa-2x" style="color: black; margin-right:10px;"></i></a> 
                    <a href="https://www.yelp.com/biz/mvm-machinery-los-angeles-2"><i class="fab fa-yelp fa-2x" style="color: black;"></i></a> 
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    .badge{
        color: #e4a627;
        background-color: black;
    }
    body{
        background-color: #e4a627;
    }
</style>



</html>