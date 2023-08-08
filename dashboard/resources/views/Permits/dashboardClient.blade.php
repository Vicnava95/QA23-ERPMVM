<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Carga los elementos de bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Permits MVM</title>
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/app.css')}}
    
    <!-- Carga las imágenes -->
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
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <!-- Se muestra la imagen y tiene la clase responsive, abajo se definie el media query -->
            <div class="text-center">
                <a href="https://mvm-machinery.com/"><img src="{{ asset('images/logo-MVM.png') }}"  class="responsive"></a>
            </div>
            <!-- Fin de mostrar la imagen -->
            <div class="card bg-white col" style="margin: 10px; padding-top:0px; border-color:white; margin:0px;">
                    <div id="form1" class="card-body" style="padding-top:0px;"> 
                        <p class="info">We try and update as soon as we have any update with the city and/or inspectors, this is your best site to be updated with your permit. If you have multiple projects with us only initiated permits will show. Finished permits will be archived and not visible.</p>
                        <form action="#" name="form1" method="POST" class="well form-horizontal">
                            @csrf
                            <fieldset>
                                @foreach ($permits as $permit )
                                {{-- @if ($permit->projects->status_fk != 2 && $permit->projects->status_fk != 4 ) --}}
                                    <div class="card">
                                        <div class="box" style="margin-bottom: 15px;">
                                            <div style="margin-right: 8px;">
                                                <i class="fas fa-map-marked-alt"></i>
                                            </div>
                                            <div >
                                                <h5 class="card-title text-center" style="font-family: unset;margin-bottom:2px;">
                                                    @foreach ($address as $a)
                                                        @if ($a['idPermit'] == $permit->id)
                                                            {{$a['addressPermit']}}
                                                        @endif
                                                    @endforeach
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10 offset-md-1">
                                                    <h5 class="card-title text-center" style="font-family: unset;margin-bottom:2px;">
                                                       <b>Status</b>
                                                    </h5>
                                                    <h5 class="card-title text-center" style="font-family: unset;margin-bottom:12px;">
                                                        <span class="badge badge-success">{{$permit->permitStage->namePermitStage}}</span>
                                                    </h5>
                                                    {{-- <div class="progress" style="height: 2rem;">
                                                        @if ($permit->permitStage_fk == 1)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:16.67%; padding-top:7px;">
                                                                <h5><b>15%</b></h5> 
                                                            </div>
                                                        @endif
                                                
                                                        @if ($permit->permitStage_fk == 2)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:33.34%; padding-top:7px;">
                                                                <h5><b>35%</b></h5> 
                                                            </div>
                                                        @endif

                                                        @if ($permit->permitStage_fk == 3)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:50%; padding-top:7px;">
                                                                <h5><b>50%</b></h5> 
                                                            </div>
                                                        @endif
                                                        
                                                        @if ($permit->permitStage_fk == 4)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:66.68%; padding-top:7px;">
                                                                <h5><b>65%</b></h5>
                                                            </div>
                                                        @endif

                                                        @if ($permit->permitStage_fk == 5)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:83.35%; padding-top:7px;">
                                                                <h5><b>85%</b></h5> 
                                                            </div>
                                                        @endif

                                                        @if ($permit->permitStage_fk == 6)
                                                            <div class="progress-bar progress-bar-striped bg-success" style="width:100%; padding-top:7px;">
                                                                <h5><b>100%</b></h5> 
                                                            </div>
                                                        @endif
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <h5 class="card-title text-center"><b>Last Permit Update {{$stringDate}} </b></h5>
                                            
                                            {{-- Timeline Updates --}}
                                            <div class="text-center">
                                                <h5 class="card-title text-center" style="font-family: unset; margin-bottom:2px;"><b>Latest Updates</b> </h5>
                                            </div>
                                            <div class="col-md-6 offset-md-3">
                                                <ul class="timeline">
                                                    @foreach ($arrayTimes as $aTimes)
                                                        @if ($aTimes['ticket_fk'] == $permit->id)
                                                            <li>
                                                                <label><b>{{$aTimes['user']}}</b></label>
                                                                <p style="margin-bottom: 5px;">{{$aTimes['descripcion']}}</p>
                                                                <span style="font-style: italic">{{$aTimes['date']}} {{$aTimes['time']}}</span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                {{-- @endif --}}
                                @endforeach
                            {{-- <div class="text-center">
                                <button id="sendForm" class="btn btn-sm">Submit</button>
                            </div> --}}
                            <!-- Inicio de footer para el Dashboard de Cliente -->
                            <div class="text-center" style="margin-top: 30px;">
                                <h6 class="card-title text-center" style="font-family: unset;"><b>MVM Machinery</b> </h6>
                                <h6 class="card-title info" style="font-family: unset;margin-bottom:2px;">If you have any question, please contact us!</h6>
                                <h6 class="secondText text-center">
                                    <b><a href="https://mail.google.com/mail/?view=cm&fs=1&to=permits@mvm-machinery.com" style="color: #000000;">permits@mvm-machinery.com</a></b>
                                </h6> 
                                {{-- <h6 class="card-title text-center" style="font-family: unset;margin-bottom:2px;">
                                    <b><a href="https://mail.google.com/mail/?view=cm&fs=1&to=bids@mvm-machinery.com" style="color: #e4a627;">
                                        <i class="fas fa-envelope"></i> bids@mvm-machinery.com</a></b>
                                </h6> --}}
                                {{-- <h6 class="card-title text-center" style="font-family: unset;margin-bottom:2px;"> 
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
                            <!-- Fin de footer para el Dashboard de Cliente -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
</body>
<style>
    .card{
        padding: 5px;
        border: 1.5px solid #ffffff;
    }
    .box{
            display: flex;
            justify-content: center;
        }
    .btn{
        font-size: 18px;
        background-color: black;
        color:#e4a627;
    }
    .btn:hover{
        font-size: 18px;
        background-color: #e4a627;
        color:black;
        border-color: black;
    }
    .form-control:focus{
        border-color: #e4a627;
        box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px #e4a627;
        outline: 0 none;
    }
    /* Desktop */
    @media screen and (min-width: 1024px){
        .responsive {
            width: 23%;
            height: auto;
        }
        .info{
            text-align: center;
        }
    }

    /* Tablet */
    @media screen and (min-width: 768px) and (max-width: 1023px){
        .responsive {
            width: 25%;
            height: auto;
        }
        .info{
            text-align: center;
        }
    }

    #service option:hover{
        background-color: red !important;
    }

    /* Mobil */
    @media screen and (max-width: 767px){
        .responsive {
            width: 40%;
            height: auto;
        }
        .info{
            text-align: justify;
        }
    }

    .col-md-6.offset-md-3{
        padding: 0px;
    }
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #6c757d;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
</style>

</html>
