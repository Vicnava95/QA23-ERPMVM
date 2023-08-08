@extends('master')
@section('title')
    <title>Permit Dashboard</title>
@stop
@section('extra_links')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <!-- DataTable JS-->
    {{-- {{HTML::script('js/projects/purchasesXproject.js')}} --}}
    {{HTML::script('js/permit/dashboardPermit.js')}}
    {{HTML::style('css/permit/dashboardPermit.css')}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}
@stop
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-right">
                <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">
                
            </div>
            <div class="col">

            </div>
            <div class="col">
                @if (Auth::user()->rol != 'labor')
                    <h4><a href="{{route('newPermit')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Permit">+ Permit</a></h4>
                @endif
            </div>
            
        </div>
    </div>

<div class="container-fluid-a" >
    @if (Auth::user()->rol != 'labor')
        <div class="text-center" style="margin: auto; display: block; max-width: 500;">
            <input type="text-center" class="form-control form-control-sm"  id="searchProject" placeholder="Search Project" autocomplete="off">
            <div id="permitList">

            </div>
        </div>
    @endif
    

    @if(session()->has('message'))
    <br>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- Content Row -->
    <div class="row justify-content-center ocultar" style="padding:5px;">

        <!-- Content Column Applying Permits-->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:#000080; font-weight: bold" > <b> Applying / Pending</b></h5>
                </div>
                @if ($arrayProjectApplying[0]['id'] != '0')
                    @foreach ($arrayProjectApplying as $pApplying)
                    <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: #000080">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-12" style="text-align: left;">
                                @if ($pApplying['numberPermit'] != null)
                                <h6 style="height: 10px;" >N°: {{$pApplying['numberPermit']}}</h6>
                                @endif
                                <h6 style="height: 10px;" ># Comments: {{$pApplying['numComments']}}</h6>
                            </div>
                        </div>
                        
                        <a href="{{route('infoPermit',$pApplying['id'])}}">  
                            <div class="text-center">
                                <label class="mb-1 labelInfo">Last Update</label>
                                <br>
                                <label class="mb-1 labelInfo">{{$pApplying['dateUpdate']}}  {{$pApplying['timeUpdate']}}</label>
                            </div>
                            <div class="text-center">
                                <label class="mb-1 labelAddress">{{$pApplying['address']}}</label>
                            </div>
                            <div class="text-center">
                                @if ($pApplying['client'] != '0')
                                <label class="mb-1 labelClientName">{{$pApplying['client']->nameClient}}</label>
                                @else
                                <label class="mb-1 labelClientName">null</label>
                                @endif
                                
                            </div>
                            <div class="text-center">
                                @foreach ($pApplying['services'] as $servicio)
                                    <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                                @endforeach
                            </div>
                            @if (Auth::user()->rol != 'labor')
                                <div class="w3-bar desktop">
                                    {{-- <a class="w3-button w3-left" href="{{route('clientsweb')}}"><span><i class="fas fa-angle-left"></i></span></a> --}}
                                    <a class="w3-button w3-right" href="{{route('updateStage',[ $pApplying['id'] ,2])}}"><span><i class="fas fa-angle-right"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    {{-- <a class="w3-button w3-left" href="{{route('clientsweb')}}"><span><i class="fas fa-angle-left"></i></span></a> --}}
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pApplying['id'] ,2])}}"><span><i class="fas fa-angle-down"></i></span></a>
                                </div>
                            @endif
                            
                        </a>
                        <div class="dropdown text-right " id="dropdownid" hidden>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                                {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Content Column Covenant Permits-->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:rgb(0, 123, 255);font-weight: bold"><b>Covenant</b></h5>
                </div>
                @if ($arrayProjectCovenant[0]['id'] != 0)
                    @foreach ($arrayProjectCovenant as $pCovenant)
                    <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: rgb(0, 123, 255)">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-12" style="text-align: left;">
                                @if ($pCovenant['numberPermit'] != null)
                                <h6 style="height: 10px;">N°: {{$pCovenant['numberPermit']}}</h6>    
                                @endif
                                <h6 style="height: 10px;"># Comments: {{$pCovenant['numComments']}}</h6>
                            </div>
                        </div>
                        
                        <a href="{{route('infoPermit',$pCovenant['id'])}}">  
                            <div class="text-center">
                                <label class="mb-1 labelInfo">Last Update</label>
                                <br>
                                <label class="mb-1 labelInfo">{{$pCovenant['dateUpdate']}}  {{$pCovenant['timeUpdate']}}</label>
                            </div>
                            <div class="text-center">
                                <label class="mb-1 labelAddress">{{$pCovenant['address']}}</label>
                            </div>
                            <div class="text-center">
                                @if ($pCovenant['client'] != '0')
                                    <label class="mb-1 labelClientName">{{$pCovenant['client']->nameClient}}</label>
                                @else
                                    <label class="mb-1 labelClientName">null</label>
                                @endif
                            </div>
                            <div class="text-center">
                                @foreach ($pCovenant['services'] as $servicio)
                                    <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                                @endforeach
                            </div>
                            @if (Auth::user()->rol != 'labor')
                                <div class="w3-bar desktop">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pCovenant['id'] ,1])}}"><span><i class="fas fa-angle-left"></i></span></a>
                                    <a class="w3-button w3-right" href="{{route('updateStage',[ $pCovenant['id'] ,3])}}"><span><i class="fas fa-angle-right"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pCovenant['id'] ,1])}}"><span><i class="fas fa-angle-up"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pCovenant['id'] ,3])}}"><span><i class="fas fa-angle-down"></i></span></a>
                                </div>
                            @endif
                            
                        </a>
                        <div class="dropdown text-right " id="dropdownid" hidden>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                                {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Content Column Pending Correction Permits-->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:#ffc107;font-weight: bold"><b>Pending Correction</b></h5>
                </div>
                @if ($arrayProjectPending[0]['id'] != 0)
                    @foreach ($arrayProjectPending as $pPending)
                    <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: #ffc107">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-12" style="text-align: left;">
                                @if ($pPending['permitNumber'] != null)
                                <h6 style="height: 10px;" >N°: {{$pPending['permitNumber']}}</h6>
                                @endif
                                <h6 style="height: 10px;" ># Comments: {{$pPending['numComments']}}</h6>
                            </div>
                        </div>
                        
                        <a href="{{route('infoPermit',$pPending['id'])}}">  
                            <div class="text-center">
                                <label class="mb-1 labelInfo">Last Update</label>
                                <br>
                                <label class="mb-1 labelInfo">{{$pPending['dateUpdate']}}  {{$pPending['timeUpdate']}}</label>
                            </div>
                            <div class="text-center">
                                <label class="mb-1 labelAddress">{{$pPending['address']}}</label>
                            </div>
                            <div class="text-center">
                                @if ($pPending['client'] != '0')
                                    <label class="mb-1 labelClientName">{{$pPending['client']->nameClient}}</label>
                                @else
                                    <label class="mb-1 labelClientName">null</label>    
                                @endif
                            </div>
                            <div class="text-center">
                                @foreach ($pPending['services'] as $servicio)
                                    <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                                @endforeach
                            </div>
                            @if (Auth::user()->rol != 'labor')
                                <div class="w3-bar desktop">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pPending['id'] ,2])}}"><span><i class="fas fa-angle-left"></i></span></a>
                                    <a class="w3-button w3-right" href="{{route('updateStage',[ $pPending['id'] ,4])}}"><span><i class="fas fa-angle-right"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pPending['id'] ,2])}}"><span><i class="fas fa-angle-up"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pPending['id'] ,4])}}"><span><i class="fas fa-angle-down"></i></span></a>
                                </div>
                            @endif
                            
                        </a>
                        <div class="dropdown text-right " id="dropdownid" hidden>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                                {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Content Column Waiting Permits -->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:#e74a3b; font-weight: bold"><b>Waiting Submited</b></h5>
                </div>
                @if ($arrayProjectWaiting[0]['id'] != 0)
                    @foreach ($arrayProjectWaiting as $pWaiting)
                    <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: #e74a3b">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-12" style="text-align: left;">
                                @if ($pWaiting['permitNumber'] != null)
                                <h6 style="height: 10px;" >N°: {{$pWaiting['permitNumber']}}</h6>    
                                @endif
                                <h6 style="height: 10px;"># Comments: {{$pWaiting['numComments']}}</h6>
                            </div>
                            
                        </div>
                        
                        <a href="{{route('infoPermit',$pWaiting['id'])}}">  
                            <div class="text-center">
                                <label class="mb-1 labelInfo">Last Update</label>
                                <br>
                                <label class="mb-1 labelInfo">{{$pWaiting['dateUpdate']}}  {{$pWaiting['timeUpdate']}}</label>
                            </div>
                            <div class="text-center">
                                <label class="mb-1 labelAddress">{{$pWaiting['address']}}</label>
                            </div>
                            <div class="text-center">
                                @if ($pWaiting['client'] != '0')
                                    <label class="mb-1 labelClientName">{{$pWaiting['client']->nameClient}}</label>
                                @else
                                    <label class="mb-1 labelClientName">null</label>
                                @endif
                            </div>
                            <div class="text-center">
                                @foreach ($pWaiting['services'] as $servicio)
                                    <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                                @endforeach
                            </div>
                            @if (Auth::user()->rol != 'labor')
                                <div class="w3-bar desktop">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pWaiting['id'] ,3])}}"><span><i class="fas fa-angle-left"></i></span></a>
                                    <a class="w3-button w3-right" href="{{route('updateStage',[ $pWaiting['id'] ,5])}}"><span><i class="fas fa-angle-right"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pWaiting['id'] ,3])}}"><span><i class="fas fa-angle-up"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pWaiting['id'] ,5])}}"><span><i class="fas fa-angle-down"></i></span></a>
                                </div>
                            @endif
                            
                        </a>
                        <div class="dropdown text-right " id="dropdownid" hidden>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                                {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Content Column RTI Permits -->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:#28a745 ; font-weight: bold" > <b>RTI / Issued</b></h5>
                </div>
                @if ($arrayProjectRTI[0]['id'] != 0)
                    @foreach ($arrayProjectRTI as $pRTI)
                    <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: #28a745">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-12" style="text-align: left;">
                                @if ($pRTI['permitNumber'] != null)
                                <h6 style="height: 10px;" >N°: {{$pRTI['permitNumber']}}</h6>    
                                @endif
                                <h6 style="height: 10px;"># Comments: {{$pRTI['numComments']}}</h6>
                            </div>
                        </div>
                        
                        <a href="{{route('infoPermit',$pRTI['id'])}}">  
                            <div class="text-center">
                                <label class="mb-1 labelInfo">Last Update</label>
                                <br>
                                <label class="mb-1 labelInfo">{{$pRTI['dateUpdate']}}  {{$pRTI['timeUpdate']}}</label>
                            </div>
                            <div class="text-center">
                                <label class="mb-1 labelAddress">{{$pRTI['address']}}</label>
                            </div>
                            <div class="text-center">
                                @if ($pRTI['client'] != '0')
                                    <label class="mb-1 labelClientName">{{$pRTI['client']->nameClient}}</label>
                                @else
                                    <label class="mb-1 labelClientName">null</label>    
                                @endif
                            </div>
                            <div class="text-center">
                                @foreach ($pRTI['services'] as $servicio)
                                    <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                                @endforeach
                            </div>
                            @if (Auth::user()->rol != 'labor')
                                <div class="w3-bar desktop">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pRTI['id'] ,4])}}"><span><i class="fas fa-angle-left"></i></span></a>
                                    <a class="w3-button w3-right" href="{{route('updateStage',[ $pRTI['id'] ,6])}}"><span><i class="fas fa-angle-right"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pRTI['id'] ,4])}}"><span><i class="fas fa-angle-up"></i></span></a>
                                </div>
                                <div class="w3-bar mobile">
                                    <a class="w3-button w3-left" href="{{route('updateStage',[ $pRTI['id'] ,6])}}"><span><i class="fas fa-angle-down"></i></span></a>
                                </div>
                            @endif
                            
                        </a>
                        <div class="dropdown text-right " id="dropdownid" hidden>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                                {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                                <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Content Column Completed Projects-->
        <div class="col-lg-2 mb-4" >
            <div class="list-group">
                <div class="text-center" style="margin-bottom: 5px;">
                    <h5 class="mb-1" style="color:#17a2b8; font-weight: bold" > <b> Finalized Process</b></h5>
                </div>  
                @if ($arrayProjectIssued[0]['id'] != 0)
                @foreach ($arrayProjectIssued as $pIssued)
                <div  class="list-group-item list-group-item-action flex-column align-items-start" style="border-color: #17a2b8">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-12" style="text-align: left;">
                            @if ($pIssued['permitNumber'] != null)
                            <h6 style="height: 10px;" >N°: {{$pIssued['permitNumber']}}</h6>    
                            @endif
                            <h6 style="height: 10px;"># Comments: {{$pIssued['numComments']}}</h6>
                        </div>
                    </div>
                    
                    <a href="{{route('infoPermit',$pIssued['id'])}}">  
                        <div class="text-center">
                            <label class="mb-1 labelInfo">Last Update</label>
                            <br>
                            <label class="mb-1 labelInfo">{{$pIssued['dateUpdate']}}  {{$pIssued['timeUpdate']}}</label>
                        </div>
                        <div class="text-center">
                            <label class="mb-1" style="color: #495057; font-size:20px; font-weight: bold">{{$pIssued['address']}}</label>
                        </div>
                        <div class="text-center">
                            @if ($pIssued['client'] != '0')
                                <label class="mb-1 labelClientName">{{$pIssued['client']->nameClient}}</label>
                            @else
                                <label class="mb-1 labelClientName">null</label>
                            @endif
                        </div>
                        <div class="text-center">
                            @foreach ($pIssued['services'] as $servicio)
                                <label class="mb-1 labelInfo">{{$servicio['name_service']}}</label>
                            @endforeach
                        </div>
                        @if (Auth::user()->rol != 'labor')
                            <div class="w3-bar desktop">
                                <a class="w3-button w3-left" href="{{route('updateStage',[ $pIssued['id'] ,5])}}"><span><i class="fas fa-angle-left"></i></span></a>
                                <a class="w3-button w3-right" href="{{route('updateStage',[ $pIssued['id'] ,7])}}"><span><i class="fas fa-inbox"></i></span></a>
                            </div>
                            <div class="w3-bar mobile">
                                <a class="w3-button w3-left" href="{{route('updateStage',[ $pIssued['id'] ,5])}}"><span><i class="fas fa-angle-up"></i></span></a>
                            </div>
                            <div class="w3-bar mobile">
                                <a class="w3-button w3-left" href="{{route('updateStage',[ $pIssued['id'] ,7])}}"><span><i class="fas fa-inbox"></i></span></a>
                            </div>
                        @endif
                        
                    </a>
                    <div class="dropdown text-right " id="dropdownid" hidden >
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownid" data-toggle="dropdown" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" id="dropperid" >
                            <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Pending</a>
                            {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('updateStage', [$apPermits , 6])}}" class="badge badge-light">Stored</a> --}}
                            <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">Edit</a>
                            <a style="padding: 5px;" class="dropdown-item text-center" href="" class="badge badge-light">File Upload</a>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
            @endif
            </div>
        </div>
    </div>
    @if (Auth::user()->rol != 'labor')
        <div class="botons text-center" style="padding-bottom: 20px;">
            <h4><a href="{{route('allPermits')}}"><div class="badge badgeERP" >ALL PERMITS</div></a></h4>
        </div>
    @endif
    

</div>
@stop
