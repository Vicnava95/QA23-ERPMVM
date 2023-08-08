@extends('master')
@section('title')
    <title>Purchases</title>
@stop
@section('extra_links')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>



    <!-- DataTable JS-->
    {{-- {{HTML::script('js/projects/purchasesXproject.js')}} --}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}
@stop
@section('content')

    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-right">
                <a href="{{route('dashboard')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
            <div class="col">
                
            </div>
            <div class="col">

            </div>
            <div class="col">
                <a href="{{route('purchase.create')}}" class="btn btn-outline-secondary btn-sm" role="button" aria-pressed="true">New Purchase</a>
            </div>
            
        </div>
    </div>

<div class="container-fluid-a" >


<!-- Content Row -->
<div class="row" style="padding:5px;">

<!-- Content Column Active Projects-->
<div class="col-lg-6 mb-4" >
    <div class="list-group">
        <div class="text-center">
            <h5 class="mb-1" style="color:#28a745;" > <b> Active Projects</b></h5>
        </div>
        @foreach ($activateProjects as $activateProject )
            <a href="{{route ('purchase.purchaseXProject',$activateProject->id)}}" class="list-group-item list-group-item-action flex-column align-items-start border-success">
                <div class="text-center">
                    <h5 class="mb-1">{{$activateProject->name_project}}</h5>
                </div>
                <dl class="dl-horizontal row">
                    <dt class="col-sm-3" hidden><input type="text" id="{{$activateProject->id}}" value="{{$activateProject->id}}" onclick="findPurchases({{$activateProject->id}})"></dt>
                    <dd class="col-sm-9" hidden>{{$activateProject->id}}</dd>
                    @foreach ($purchasesA as $pur)
                        @if ($pur['id'] == $activateProject->id)
                            <dt class="col-sm-3" style="color:#e74a3b;">Current Spent: <span style="text:inherit; color:#495057">${{$pur['value']}}</span></dt>
                            
                        @endif
                    @endforeach
                </dl> 
            </a>
            <br>
        @endforeach
    </div>
</div>

    <!-- Content Column Completed Projects-->
    <div class="col-lg-6 mb-4" >
        <div class="list-group">
            <div class="text-center">
                <h5 class="mb-1" style="color:#e74a3b;" > <b> Completed Projects</b></h5>
            </div>
            @foreach ($finishProjects as $finishProject )
                <a href="{{route ('purchase.purchaseXProject',$finishProject)}}" class="list-group-item list-group-item-action flex-column align-items-start border-danger">
                    <div class="text-center">
                        <h5 class="mb-1">{{$finishProject->name_project}}</h5>
                    </div>
                    <dl class="dl-horizontal row">
                        <dt class="col-sm-3" hidden><input type="text" id="{{$finishProject->id}}" value="{{$finishProject->id}}" onclick="findPurchases({{$finishProject->id}})"></dt>
                        <dd class="col-sm-9" hidden>{{$finishProject->id}}</dd>
                        @foreach ($purchasesF as $purF)
                            @if ($purF['id'] == $finishProject->id)
                                <dt class="col-sm-3" style="color:#e74a3b;">Current Spent: <span style="text:inherit; color:#495057">${{$purF['value']}}</span></dt>
                            @endif
                        @endforeach
                    </dl> 
                </a>
                <br>
            @endforeach
        </div>
    </div>
  </div>

      <div class="botons text-center" style="padding-bottom: 20px;">
          <a href="{{route('purchase.index')}}" class="btn btn-outline-secondary" role="button" aria-pressed="true">All Purchases</a>
      </div>

</div>
    <style>
    .container-fluid-a{
        border-radius: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        margin: 10px;
    }
    dl {
    margin: 0;
    }

    dt {
        clear: left;
        float: left;
        padding: 0 0 2px;
        font-weight: bold;
    }
    dd {
        float: left;
        margin-left: 10px;
        padding: 0 0 2px;
    }
    </style>

@stop
