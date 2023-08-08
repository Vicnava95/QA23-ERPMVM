@extends('master')
@section('title')
    <title>General Settings</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>

    <link href="css/dashboard-style.css" rel="stylesheet" type="text/css" />

    <script src="js/dashboard/dashboard.js"></script>

    <!-- Favicon (Icono Pequeño) -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    

@stop
@section('content')

<section class="container">

    <a href="{{route('showStatus')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/status.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Status</strong></p>
        </span>
    </a>
    <a href="{{route('showManagers')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/manager.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Manager</strong></p>
        </span>
    </a>
    <a href="{{route('showProjectTypes')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/projectType.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Project Type</strong></p>
        </span>
    </a>
    <a href="{{route('showCategories')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/category.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Category</strong></p>
        </span>
    </a>
    <a href="{{route('showServices')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/construction.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Services</strong></p>
        </span>
    </a>
    <a href="{{route('showLaborCruds')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/workers.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Labors</strong></p>
        </span>
    </a>
    <a href="{{route('showCategoryPurchases')}}">
        <span>
            <div class="card" style="background-color: black; color:black;">
                <img src="{{ asset('images/icons/expenses.png') }}">
            </div>
            <p class="text-center" style="margin-top: 0px;"><strong>Purchases Category</strong></p>
        </span>
    </a>
    


</section> 

<style>
a {
    text-decoration:none !important; 
    color:black;
}
a:hover{
    color:black;
}
:root {
  --cardWidth: 80px;
  --cardHeight: 80px;
  --cardMargin: 16px;
}
.container{
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.card {
  width: var(--cardWidth);
  height: var(--cardHeight);
  margin: var(--cardMargin);
  border: 1px solid white;
  border-radius: 8px;
  background: #fff;
  box-sizing: border-box;
}

/* Desktop */
@media screen and (min-width: 1024px){

}

/* Tablet */
@media screen and (min-width: 768px) and (max-width: 1023px){
    
}

/* Mobil */
@media screen and (max-width: 767px){
    .container{
        align-items: center;
        justify-content: flex-start;
    }
}
</style>




@stop
