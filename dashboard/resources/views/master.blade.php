<html lang="en">
<head>
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    @yield('title')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    <meta name="robots" content="noindex, nofollow">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

{{--    {{HTML::style('css/main.css')}}--}}
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/app.css')}}

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    {{--    Alertify --}}

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
{{-- Create Icon --}}

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

    @yield('extra_links')

</head>

<style>
.temporal-hidden{
  display: none !important;
}
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: black !important;">
        <a class="navbar-brand" href="{{route('dashboard')}}">
            {{ HTML::image('images/logo.png', 'dispatch', array('class' => 'd-inline-block align-top', 'width' => '30', 'height'=>'30')) }}
            ERP
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item" hidden>
                    <a class="nav-link" href="{{route('dispatchcenter')}}">Dispatch Center</a>
                </li>
                <li class="nav-item" hidden>
                    <a class="nav-link" href="#">Projects</a>
                </li>
                <li class="nav-item" hidden>
                    <a class="nav-link" href="{{route('new_dispatch')}}">New Dispatch</a>
                </li>
                <li class="nav-item" hidden>
                    <a class="nav-link" href="#">New Invoice</a>
                </li>                
            </ul>

            <ul class="navbar-nav ml-auto">
           @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                {{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                <li><a class="nav-link temporal-hidden" href="{{ route('register') }}">{{ __('Register') }}</a></li> --}}
            @else
                <i class="fas fa-user-tie fa-2x" style="color:#858796; margin:5px;" ></i>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{route('menuSettings')}}">Settings</a>
                </div>
                </li>
            @endguest  
            </ul>
        </div>
    </nav>
{{--@show--}}

@yield('content')

</body>
</html>
