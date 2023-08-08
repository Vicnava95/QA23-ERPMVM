@extends('master')
@section('title')
    <title>Active Projects</title>
@stop
@section('extra_links')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    
    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <!-- DataTable JS-->
    {{-- {{HTML::script('js/projects/purchasesXproject.js')}} --}}
    {{HTML::script('js/projects/activeProject.js')}}

    <!-- CSS --> 
    {{HTML::style('css/project/activeProject.css')}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}
@stop
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-left">
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    <span style="font-size: 130%;"><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></span>
                @else
                    <span style="font-size: 130%;"><a href="{{route('dashboard2')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></span>
                @endif

                @if (Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 8 || Auth::user()->id == 5)
                    <span style="font-size: 130%;" class="searchbardesktop"><a href="{{route('dailyReport')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Add Daily Report">+ Report</a></span>
                @else
                    <span style="font-size: 130%;" class="searchbardesktop"><a href="{{route('activeDailyReport')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Daily Reports">Reports</a></span>
                @endif

                @if (Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 8 || Auth::user()->id == 5)
                    <span style="font-size: 130%;" class="searchbarmobile"><a href="{{route('dailyReport')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Report">+ Report</a></span>
                @else
                    <span style="font-size: 130%;" class="searchbarmobile"><a href="{{route('activeDailyReport')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Report">+ Report</a></span>
                @endif
            </div>
            <div class="col searchbardesktop" style="text-align: left; padding-left:0px;">
                @if (Auth::user()->rol != 'labor')
                    <div class="text-center" style="margin: auto; display: block; max-width: 500;">
                        <input type="text-center" class="form-control form-control-sm"  id="searchProject" placeholder="Search Project" autocomplete="off">
                        <div id="projectList">

                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col text-right">
                <span style="font-size: 130%;" class="searchbardesktop"><a href="{{route('project.create')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Add Project">+ Project</a></span>
                <span style="font-size: 130%;" class="searchbarmobile"><a href="{{route('project.create')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Project">+ Project</a></span>
                @if (Auth::user()->rol != 'labor')
                    <label class="check-text">
                        <input type='checkbox' id="dataFinance" checked/>
                        <span class="checked" style="font-size: 130%;"><span class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Hide"><i class="uil uil-eye" onclick="showData(1)"></i></span></span>
                        <span class="unchecked" style="font-size: 130%;"><span class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Show"><i class="uil uil-eye-slash" onclick="showData(0)"></i></span></span>
                    </label>
                @endif
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                <span><a href="" type="button" style="font-size: 100%;" data-toggle="modal" data-target="#modalMoreAction" class="badge badgeERPButton"><i class="uil uil-ellipsis-h"></i></a></span>
                
                <!-- Modal Settings -->
                <div class="modal fade" id="modalMoreAction" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalCenterTitle">MORE ACTIONS </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="text-center">
                                <h6 ><a href="{{route('project.create')}}" style="color:black;" class="searchbardesktop">ADD PROJECT</a></h6>
                                {{-- @if (Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 8 || Auth::user()->id == 5)
                                    <h6 ><a href="{{route('dailyReport')}}" style="color:black;" class="searchbardesktop">ADD REPORT</a></h6>
                                @else
                                    <h6 ><a href="{{route('activeDailyReport')}}" style="color:black;" class="dropdownMobile">REPORT</a></h6>
                                @endif --}}
                                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                                    <h6 ><a href="{{route('project.index')}}" style="color:black;" class="dropdownMobile">ALL PROJECTS</a></h6>
                                    <h6 ><a href="{{route('allPurchases')}}" style="color:black;" class="dropdownMobile">ALL PURCHASES</a></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
        </div>
    </div>

<div class="container-fluid-a" >
    @if (Auth::user()->rol != 'labor')
        <div class="text-center searchbarmobile" style="margin: auto; display: block; max-width: 500;">
            <input type="text-center" class="form-control form-control-sm"  id="searchProject1" placeholder="Search Project" autocomplete="off">
            <div id="projectList1">

            </div>
        </div>
    @endif
    
    
    <!-- Content Row -->
    <div class="row" id="dashboardProjects" style="padding:5px;">

        <!-- Content Column Active Projects-->
        <div class="flex" >
            <div class="list-group">
                <div class="text-center">
                    <h5 class="mb-1 titulo2" style="color:#28a745; font-weight: bold" > <b> Active Projects</b></h5>
                </div>
                <a class="btn btn-success" id="buttonCollapseActive" data-toggle="collapse" href="#collapseActive" role="button" aria-expanded="false" aria-controls="collapseActive" style="margin-bottom: 5px;">
                    Active Projects <span class="badge badge-pill badge-light">{{count($activateProjects)}}</span> 
                </a>
                
                <div class="collapse" id="collapseActive">
                @foreach ($activateProjects as $activateProject )
                <div  class="list-group-item list-group-item-action flex-column align-items-start border-success">
                    
                        <a  @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                                href="{{route ('project.moreInfo',$activateProject)}}"
                            @else
                                href="{{route ('project.moreInfo2',$activateProject)}}"
                            @endif>
                            <h6 style="height: 10px; text-align:right;" >ID: {{$activateProject->id}}</h6>
                            <div class="text-center">
                                @foreach ($purchasesA as $pur)
                                    @if ($pur['id'] == $activateProject->id)
                                    <label class="labelClientName">{{$pur['nameClient']}}</label>
                                    <br>
                        </a>
                                <a class="mb-1 titulo" href="http://maps.apple.com/?q={{$pur['address']}}" id="label{{$activateProject->id}}" style="color: #495057; font-weight: bold; text-decoration: underline;">{{$pur['address']}}</a>
                                @if (Auth::user()->rol == 'labor')
                                    <div href="{{route ('project.moreInfo',$activateProject)}}"></div>
                                @else
                                    <h4 class="mobile"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$activateProject->id}})"  id="buttonbadge{{$activateProject->id}}" style="color: white; cursor: pointer;">Copy</a></h4>
                                    <h6 class="desktop"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$activateProject->id}})"  id="buttonbadge{{$activateProject->id}}" style="color: white; cursor: pointer;">Copy</a></h6>       
                                @endif
                               
                                <a  @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                                    href="{{route ('project.moreInfo',$activateProject)}}"
                                @else
                                    href="{{route ('project.moreInfo2',$activateProject)}}"
                                @endif>
                                    
                                    @endif
                                @endforeach
                            </div>
                            <div class="row text-center">
                                <div class="col-12">
                                    @foreach ($arrayServicesA as $aServicesA)
                                        @if ($aServicesA['idProject'] == $activateProject->id)
                                            @if ($aServicesA['principal'] == 1)
                                                <label class="labelService" >{{$aServicesA['service']}}</label>
                                                <br>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                                <div class="row text-center">
                                    <div class="col-6">
                                        <label class="numeros">${{number_format($activateProject->sold_project,2) }}</label>
                                        <label class="numerosX">$XXXX.XX</label>
                                        <br>
                                        <label class="labelSold">SOLD</label>
                                    </div>
                                    <div class="col-6">
                                        @foreach($purchasesA as $pur)
                                            @if ($pur['id'] == $activateProject->id)
                                                <label class="numeros">${{number_format($pur['accountReceivables'],2)}}</label>
                                                <label class="numerosX">$XXXX.XX</label>
                                                <br>
                                                <label class="labelBudget">Account Receivables</label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            
                                <div class="row text-center">
                                    @foreach ($purchasesA as $pur)
                                        @if ($pur['id'] == $activateProject->id)
                                        <div class="col-6">
                                                <label class="numeros">${{ number_format($pur['value'],2)}}</label >
                                                <label class="numerosX">$XXXX.XX</label>
                                                <br>
                                                <label class="labelSpent">SPENT</label>
                                        </div>
                                        <div class="col-6">
                                            @if (Auth::user()->rol != 'secretary')
                                                <label class="numeros">${{number_format($pur['newProfitA'],2)}}</label >
                                                <label class="numerosX">$XXXX.XX</label>
                                                <br>
                                                <label class="labelProfit">PROFIT</label>
                                            @endif
                                        </div>
                                        @endif
                                    @endforeach
                                </div>                               
                            @endif
                        </a>
                        @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                            <div class="row">
                                <div class="col">
                                    <div class="dropdown text-left " id="dropdownid" >
                                        <a href="{{route('project.edit',$activateProject)}}"><i class="fas fa-edit" style="color:black;"></i></a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="dropdown text-right " id="dropdownid" >
                                        <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettings{{$activateProject->id}}">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif                    
                </div>
                <br>
                <!-- Modal Settings -->
                <div class="modal fade" id="modalSettings{{$activateProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalCenterTitle">{{$activateProject->name_project}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h6 class="text-center" style="margin-top: 8px;"><b>Select a change</b></h6>
                        <div class="list-group" style="text-align: center;">
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('purchase.morePurchase',$activateProject)}}" class="badge badge-light">New Purchase</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="#" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalPayment{{$activateProject->id}}">New Payment</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateEndDateProject',[$activateProject,2])}}" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalFinish{{$activateProject->id}}">Finished</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$activateProject,5])}}" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModal{{$activateProject->id}}">Paused</a>
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$activateProject,6])}}" class="badge badge-light">Permit</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$activateProject,3])}}" class="badge badge-light">Schedule</a> --}}
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$activateProject)}}" class="badge badge-light">Edit</a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="exampleModal{{$activateProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$activateProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <h6 style="font-size: 12px;">Choose the End Date Project</h6>
                            <input data-provide="datepicker" type="text" id="datepicker{{$activateProject->id}}" class="datepickerInput" width="180" name="start_date" required autocomplete="off" value={{$activateProject->end_date_project}}>
                            <script type="text/javascript">
                                    var stringdia = $('#datepicker'+{{$activateProject->id}}).val();
                                    $('#datepicker'+{{$activateProject->id}}).datepicker({
                                        uiLibrary: 'bootstrap4', 
                                        minDate: stringdia, 
                                })
                            </script>
                            
                            <input type="text" id="idProjecto{{$activateProject->id}}" hidden value="{{$activateProject->id}}">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="getValues({{$activateProject->id}})">Save</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Modal Finish -->
                <div class="modal fade" id="exampleModalFinish{{$activateProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitleF" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitleF">{{$activateProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <h6 style="font-size: 12px;">Choose the End Date Project</h6>
                            <input data-provide="datepicker" type="text" id="datepickerF{{$activateProject->id}}" class="datepickerInput" width="180" name="start_date" required autocomplete="off" value={{$activateProject->end_date_project}}>
                            <script type="text/javascript">
                                    var stringdia = $('#datepickerF'+{{$activateProject->id}}).val();
                                    $('#datepickerF'+{{$activateProject->id}}).datepicker({
                                        uiLibrary: 'bootstrap4', 
                                        minDate: stringdia, 
                                })
                            </script>
                            
                            <input type="text" id="idProjectoF{{$activateProject->id}}" hidden value="{{$activateProject->id}}">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="changeEndDateProject({{$activateProject->id}})">Save</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Payment -->
                <div class="modal fade" id="exampleModalPayment{{$activateProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New Payment - {{$activateProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-two" class="form-area">
                                <form action="{{route('paymentStore',$activateProject)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <div class="row">
                                                <div class="col-6 text-right">Method*</div>
                                                <div class="col-6">
                                                    <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                        @foreach ($paymentMethod as $payments)
                                                            <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-right">Amount*</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                <div class="col-6 text-right">Transaction Date*</div>
                                                <div class="col-6" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4-{{$activateProject->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                <div class="col-6 text-right">Order/Transaction</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                <div class="col-6 text-right">Description</div>
                                                <div class="col-6"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('#datepicker4-{{$activateProject->id}}').datepicker({
                            uiLibrary: 'bootstrap4',
                        });
                    </script>
                </div>
                
                @endforeach
                </div>
                
            </div>
        </div>

        <!-- Content Column Next Projects-->
        <div class="flex" >
            <div class="list-group">
                <div class="text-center">
                    <h5 class="mb-1 titulo2" style="color:#ffc107;font-weight: bold"><b>Ready to Schedule</b></h5>
                </div>
                <a class="btn btn-warning" id="buttonCollapseWont" data-toggle="collapse" href="#collapseWont" role="button" aria-expanded="false" aria-controls="collapseWont" style="margin-bottom: 5px;">
                    Ready to Schedule <span class="badge badge-pill badge-light">{{count($startingProjects)}}</span>
                </a>
                <div class="collapse" id="collapseWont">
                @foreach ($startingProjects as $startingProject)
                <div class="list-group-item list-group-item-action flex-column align-items-start border-warning">
                
                <a 
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        href="{{route ('project.moreInfo',$startingProject)}}"
                    @else
                        href="{{route ('project.moreInfo2',$startingProject)}}"
                    @endif>
                    <div class="text-center">
                        @foreach ($purchasesS as $purS)
                            @if ($purS['id'] == $startingProject->id)
                            <h6 style="height: 10px; text-align:right;" >ID: {{$startingProject->id}}</h6>
                            <label class="labelClientName">{{$purS['nameClient']}}</label>
                </a>
                <br>
                <a class="mb-1 titulo" href="http://maps.apple.com/?q={{$purS['address']}}" id="label{{$startingProject->id}}" style="color: #495057; font-weight: bold; text-decoration: underline;">{{$purS['address']}}</a>
                @if (Auth::user()->rol == 'labor')
                    <div href="{{route ('project.moreInfo',$startingProject)}}"></div>
                @else
                    <h4 class="mobile"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$startingProject->id}})"  id="buttonbadge{{$startingProject->id}}" style="color: white; cursor: pointer;">Copy</a></h4> 
                    <h6 class="desktop"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$startingProject->id}})"  id="buttonbadge{{$startingProject->id}}" style="color: white; cursor: pointer;">Copy</a></h6>
                @endif
                
                <a 
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        href="{{route ('project.moreInfo',$startingProject)}}"
                    @else
                        href="{{route ('project.moreInfo2',$startingProject)}}"
                    @endif>
            </label>
                            @endif
                        @endforeach
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            @foreach ($arrayServicesS as $aServicesS)
                                @if ($aServicesS['idProject'] == $startingProject->id)
                                    @if ($aServicesS['principal'] == 1)
                                        <label class="labelService">{{$aServicesS['service']}}</label>
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <label class="labelService" style="color: red;" >Start Date: {{$startingProject->start_date_project}}</label>
                        </div>
                    </div>
                    
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="row text-center">
                        <div class="col-6">
                            <label class="numeros">${{number_format($startingProject->sold_project,2)}}</label>
                            <label class="numerosX">$XXXX.XX</label>
                            <br>
                            <label class="labelSold">SOLD</label>
                        </div>
                        <div class="col-6">
                            @foreach($purchasesS as $purS)
                                @if ($purS['id'] == $startingProject->id)
                                    <label class="numeros">${{number_format($purS['accountReceivables'],2)}}</label>
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelBudget">Account Receivables</label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                
                    <div class="row text-center">
                        @foreach ($purchasesS as $purS)
                            @if ($purS['id'] == $startingProject->id)
                            <div class="col-6">
                                    <label class="numeros">${{number_format($purS['value'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelSpent">SPENT</label >
                            </div>
                            <div class="col-6">
                                @if (Auth::user()->rol != 'secretary')
                                    <label class="numeros">${{number_format($purS['newProfitSP'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelProfit">PROFIT</label>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    </div>                                
                @endif
                
                </a>
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <div class="row">
                            <div class="col">
                                <div class="dropdown text-left " id="dropdownid" >
                                    <a href="{{route('project.edit',$startingProject)}}"><i class="fas fa-edit" style="color:black;"></i></a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="dropdown text-right " id="dropdownid" >
                                    <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettingsStart{{$startingProject->id}}">
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <br>

                <!-- Modal Settings -->
                <div class="modal fade" id="modalSettingsStart{{$startingProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$startingProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h6 class="text-center" style="margin-top: 8px;"><b>Select a change</b></h6>
                        <div class="list-group" style="text-align: center;">
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="#" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalPayment{{$startingProject->id}}">New Payment</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$startingProject,1])}}" class="badge badge-light">Activate</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$startingProject,4])}}" class="badge badge-light">Archived</a>
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$startingProject,6])}}" class="badge badge-light">Permit</a> --}}
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$startingProject)}}" class="badge badge-light">Edit</a> --}} 
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Payment -->
                <div class="modal fade" id="exampleModalPayment{{$startingProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New Payment - {{$startingProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-two" class="form-area">
                                <form action="{{route('paymentStore',$startingProject)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <div class="row">
                                                <div class="col-6 text-right">Method*</div>
                                                <div class="col-6">
                                                    <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                        @foreach ($paymentMethod as $payments)
                                                            <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-right">Amount*</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                <div class="col-6 text-right">Transaction Date*</div>
                                                <div class="col-6" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4-{{$startingProject->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                <div class="col-6 text-right">Order/Transaction</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                <div class="col-6 text-right">Description</div>
                                                <div class="col-6"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('#datepicker4-{{$startingProject->id}}').datepicker({
                            uiLibrary: 'bootstrap4',
                        });
                    </script>
                </div>

                @endforeach
                </div>
            </div>
        </div>

        <!-- Content Column Permit Processing Projects-->
        <div class="flex" >
            <div class="list-group">
                <div class="text-center">
                    <h5 class="mb-1 titulo2" style="color:#071aff;font-weight: bold"><b>Permit Processing</b></h5>
                </div>
                <a class="btn btn-primary" id="buttonCollapsePermit" data-toggle="collapse" href="#collapsePermit" role="button" aria-expanded="false" aria-controls="collapsePermit" style="margin-bottom: 5px;">
                    Permit Processing <span class="badge badge-pill badge-light">{{count($permitProjects)}}</span>
                </a>
                <div class="collapse" id="collapsePermit">
                    @foreach ($permitProjects as $permitProject)
                <div class="list-group-item list-group-item-action flex-column align-items-start " style="border-color: #071aff">
                
                <a 
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    href="{{route ('project.moreInfo',$permitProject)}}"
                @else
                    href="{{route ('project.moreInfo2',$permitProject)}}"
                @endif>
                    <h6 style="height: 10px; text-align:right;" >ID: {{$permitProject->id}}</h6>
                    <div class="text-center">
                        @foreach ($purchasesPermits as $purS)
                            @if ($purS['id'] == $permitProject->id)
                            <label class="labelClientName">{{$purS['nameClient']}}</label>
                            <br>
                </a>
                <a class="mb-1 titulo" href="http://maps.apple.com/?q={{$purS['address']}}" id="label{{$permitProject->id}}" style="color: #495057; font-weight: bold; text-decoration: underline;">{{$purS['address']}}</a>
                @if (Auth::user()->rol == 'labor')
                    <div href="{{route ('project.moreInfo',$permitProject)}}"></div>
                @else
                    <h4 class="mobile"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$permitProject->id}})"  id="buttonbadge{{$permitProject->id}}" style="color: white; cursor: pointer;">Copy</a></h4> 
                    <h6 class="desktop"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$permitProject->id}})"  id="buttonbadge{{$permitProject->id}}" style="color: white; cursor: pointer;">Copy</a></h6>     
                @endif
                
                <a 
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    href="{{route ('project.moreInfo',$permitProject)}}"
                @else
                    href="{{route ('project.moreInfo2',$permitProject)}}"
                @endif>
            </label>
                            @endif
                        @endforeach
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            @foreach ($arrayServicesPermit as $aServicesS)
                                @if ($aServicesS['idProject'] == $permitProject->id)
                                    @if ($aServicesS['principal'] == 1)
                                        <label class="labelService">{{$aServicesS['service']}}</label>
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="row text-center">
                        <div class="col-6">
                            <label class="numeros">${{number_format($permitProject->sold_project,2)}}</label>
                            <label class="numerosX">$XXXX.XX</label>
                            <br>
                            <label class="labelSold">SOLD</label>
                        </div>
                        <div class="col-6">
                            @foreach($purchasesPermits as $purS)
                                @if ($purS['id'] == $permitProject->id)
                                    <label class="numeros">${{number_format($purS['accountReceivables'],2)}}</label>
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelBudget">Account Receivables</label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                
                    <div class="row text-center">
                        @foreach ($purchasesPermits as $purS)
                            @if ($purS['id'] == $permitProject->id)
                            <div class="col-6">
                                    <label class="numeros">${{number_format($purS['value'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelSpent">SPENT</label >
                            </div>
                            <div class="col-6">
                                @if (Auth::user()->rol != 'secretary')
                                    <label class="numeros">${{number_format($purS['newProfitP'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelProfit">PROFIT</label>
                                @endif
                                
                            </div>
                            @endif
                        @endforeach
                    </div>                                
                @endif
                </a>
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="row">
                        <div class="col">
                            <div class="dropdown text-left " id="dropdownid" >
                                <a href="{{route('project.edit',$permitProject)}}"><i class="fas fa-edit" style="color:black;"></i></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="dropdown text-right " id="dropdownid" >
                                <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettingsPermit{{$permitProject->id}}">
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                </div>
                <br>

                 <!-- Modal Settings -->
                <div class="modal fade" id="modalSettingsPermit{{$permitProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$permitProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h6 class="text-center" style="margin-top: 8px;"><b>Select a change</b></h6>
                        <div class="list-group" style="text-align: center;">
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="#" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalPayment{{$permitProject->id}}">New Payment</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$permitProject,1])}}" class="badge badge-light">Activate</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$permitProject,4])}}" class="badge badge-light">Archived</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$permitProject,5])}}" class="badge badge-light" data-toggle="modal" data-target="#exampleModal{{$permitProject->id}}">Paused</a>
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$permitProject,3])}}" class="badge badge-light">Schedule</a> --}}
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$permitProject)}}" class="badge badge-light">Edit</a> --}}
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$permitProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$permitProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <h6 style="font-size: 12px;">Choose the End Date Project</h6>
                            <input data-provide="datepicker" type="text" id="datepicker{{$permitProject->id}}" class="datepickerInput" width="180" name="start_date" required autocomplete="off" value={{$permitProject->end_date_project}}>
                            <script type="text/javascript">
                                    var stringdia = $('#datepicker'+{{$permitProject->id}}).val();
                                    $('#datepicker'+{{$permitProject->id}}).datepicker({
                                        uiLibrary: 'bootstrap4', 
                                        minDate: stringdia, 
                                })
                            </script>
                            
                            <input type="text" id="idProjecto{{$permitProject->id}}" hidden value="{{$permitProject->id}}">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="getValues({{$permitProject->id}})">Save</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Payment -->
                <div class="modal fade" id="exampleModalPayment{{$permitProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New Payment - {{$permitProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-two" class="form-area">
                                <form action="{{route('paymentStore',$permitProject)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <div class="row">
                                                <div class="col-6 text-right">Method*</div>
                                                <div class="col-6">
                                                    <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                        @foreach ($paymentMethod as $payments)
                                                            <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-right">Amount*</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                <div class="col-6 text-right">Transaction Date*</div>
                                                <div class="col-6" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4-{{$permitProject->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                <div class="col-6 text-right">Order/Transaction</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                <div class="col-6 text-right">Description</div>
                                                <div class="col-6"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('#datepicker4-{{$permitProject->id}}').datepicker({
                            uiLibrary: 'bootstrap4',
                        });
                    </script>
                </div>
                @endforeach
                </div>
            </div>
        </div>

        <!-- Content Column Paused Projects -->
        <div class="flex" >
            <div class="list-group">
                <div class="text-center">
                    <h5 class="mb-1 titulo2" style="color:#6c757d; font-weight: bold"><b>Paused Projects</b></h5>
                </div> 
                <a class="btn btn-secondary" id="buttonCollapsePaused" data-toggle="collapse" href="#collapsePaused" role="button" aria-expanded="false" aria-controls="collapsePaused" style="margin-bottom: 5px;">
                    Paused Projects <span class="badge badge-pill badge-light">{{count($pausedProjects)}}</span>
                </a>
                <div class="collapse" id="collapsePaused">
                    @foreach ($pausedProjects as $pausedPro)
                <div class="list-group-item list-group-item-action flex-column align-items-start border-secondary">
                
                <a 
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    href="{{route ('project.moreInfo',$pausedPro)}}"
                @else
                    href="{{route ('project.moreInfo2',$pausedPro)}}"
                @endif >
                    <h6 style="height: 10px; text-align:right;" >ID: {{$pausedPro->id}}</h6>
                    <div class="text-center">
                        @foreach ($purchasesP as $pursP)
                            @if ($pursP['id'] == $pausedPro->id)
                            <label class="labelClientName">{{$pursP['nameClient']}}</label>
                            <br>
                        </a>
                <a class="mb-1 titulo" href="http://maps.apple.com/?q={{$pursP['address']}}" id="label{{$pausedPro->id}}" style="color: #495057; font-weight: bold; text-decoration: underline;">{{$pursP['address']}}</a>
                @if (Auth::user()->rol == 'labor')
                    <div href="{{route ('project.moreInfo',$pausedPro)}}"></div>
                @else
                    <h4 class="mobile"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$pausedPro->id}})"  id="buttonbadge{{$pausedPro->id}}" style="color: white; cursor: pointer;">Copy</a></h4> 
                    <h6 class="desktop"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$pausedPro->id}})"  id="buttonbadge{{$pausedPro->id}}" style="color: white; cursor: pointer;">Copy</a></h6>     
                @endif
                
                <a 
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    href="{{route ('project.moreInfo',$pausedPro)}}"
                @else
                    href="{{route ('project.moreInfo2',$pausedPro)}}"
                @endif >
            </label>
                            @endif
                        @endforeach
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            @foreach ($arrayServicesP as $aServicesP)
                                @if ($aServicesP['idProject'] == $pausedPro->id)
                                    @if ($aServicesP['principal'] == 1)
                                        <label class="labelService">{{$aServicesP['service']}}</label>
                                        <br>
                                    @endif   
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                @if (Auth::user()->rol == 'admin'|| Auth::user()->rol == 'secretary')
                    <div class="row text-center">
                        <div class="col-6">
                            <label class="numeros">${{number_format($pausedPro->sold_project,2)}}</label>
                            <label class="numerosX">$XXXX.XX</label>
                            <br>
                            <label class="labelSold">SOLD</label>
                        </div>
                        <div class="col-6">
                            @foreach($purchasesP as $pursP)
                                @if ($pursP['id'] == $pausedPro->id)
                                    <label class="numeros">${{number_format($pursP['accountReceivables'],2)}}</label>
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelBudget">Account Receivables</label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                
                    <div class="row text-center">
                        @foreach ($purchasesP as $pursP)
                            @if ($pursP['id'] == $pausedPro->id)
                            <div class="col-6">
                                    <label class="numeros">${{number_format($pursP['value'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelSpent">SPENT</label >
                            </div>
                            <div class="col-6">
                                @if (Auth::user()->rol != 'secretary')
                                    <label class="numeros">${{number_format($pursP['newProfitP'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelProfit">PROFIT</label>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    </div>                              
                @endif
                </a>
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="row">
                        <div class="col">
                            <div class="dropdown text-left " id="dropdownid" >
                                <a href="{{route('project.edit',$pausedPro)}}"><i class="fas fa-edit" style="color:black;"></i></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="dropdown text-right " id="dropdownid" >
                                <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettingsPaused{{$pausedPro->id}}">
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                </div>
                <br>
                <!-- Modal Settings -->
                <div class="modal fade" id="modalSettingsPaused{{$pausedPro->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$pausedPro->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h6 class="text-center" style="margin-top: 8px;"><b>Select a change</b></h6>
                        <div class="list-group" style="text-align: center;">
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('purchase.morePurchase',$pausedPro)}}" class="badge badge-light">New Purchase</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="#" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalPayment{{$pausedPro->id}}">New Payment</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$pausedPro,1])}}" class="badge badge-light">Activate</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateEndDateProject',[$pausedPro,2])}}" class="badge badge-light" data-toggle="modal" data-target="#exampleModalFinish{{$pausedPro->id}}">Finished</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$pausedPro,4])}}" class="badge badge-light">Archived</a>
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$pausedPro,3])}}" class="badge badge-light">Schedule</a> --}}
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$pausedPro)}}" class="badge badge-light">Edit</a> --}}
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Finish -->
                <div class="modal fade" id="exampleModalFinish{{$pausedPro->id}}" role="dialog" aria-labelledby="exampleModalCenterTitleF" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitleF">{{$pausedPro->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <h6 style="font-size: 12px;">Choose the End Date Project</h6>
                            <input data-provide="datepicker" type="text" id="datepickerF{{$pausedPro->id}}" class="datepickerInput" width="180" name="start_date" required autocomplete="off" value={{$pausedPro->end_date_project}}>
                            <script type="text/javascript">
                                    var stringdia = $('#datepickerF'+{{$pausedPro->id}}).val();
                                    $('#datepickerF'+{{$pausedPro->id}}).datepicker({
                                        uiLibrary: 'bootstrap4', 
                                        minDate: stringdia, 
                                })
                            </script>
                            <input type="text" id="idProjectoF{{$pausedPro->id}}" hidden value="{{$pausedPro->id}}">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="changeEndDateProject({{$pausedPro->id}})">Save</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Payment -->
                <div class="modal fade" id="exampleModalPayment{{$pausedPro->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New Payment - {{$pausedPro->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-two" class="form-area">
                                <form action="{{route('paymentStore',$pausedPro)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <div class="row">
                                                <div class="col-6 text-right">Method*</div>
                                                <div class="col-6">
                                                    <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                        @foreach ($paymentMethod as $payments)
                                                            <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-right">Amount*</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                <div class="col-6 text-right">Transaction Date*</div>
                                                <div class="col-6" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4-{{$pausedPro->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                <div class="col-6 text-right">Order/Transaction</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                <div class="col-6 text-right">Description</div>
                                                <div class="col-6"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('#datepicker4-{{$pausedPro->id}}').datepicker({
                            uiLibrary: 'bootstrap4',
                        });
                    </script>
                </div>
                @endforeach
                </div>
                
            </div>
        </div>

        <!-- Content Column Completed Projects-->
        <div class="flex" >
            <div class="list-group">
                <div class="text-center">
                    <h5 class="mb-1 titulo2" style="color:#e74a3b; font-weight: bold" > <b> Completed Projects</b></h5>
                </div>
                <a class="btn btn-danger" id="buttonCollapseComplete" data-toggle="collapse" href="#collapseComplete" role="button" aria-expanded="false" aria-controls="collapseComplete" style="margin-bottom: 5px;">
                    Completed Projects <span class="badge badge-pill badge-light">{{count($finishProjects)}}</span>
                </a>
                <div class="collapse" id="collapseComplete">
                    @foreach ($finishProjects as $finishProject )
                <div class="list-group-item list-group-item-action flex-column align-items-start border-danger">
                    <h6 style="height: 10px; text-align:right;" >ID: {{$finishProject->id}}</h6>
                    <a 
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        href="{{route ('project.moreInfo',$finishProject)}}"
                    @else
                        href="{{route ('project.moreInfo2',$finishProject)}}"
                    @endif>
                        <div class="text-center">
                            @foreach ($purchasesF as $purF)
                                @if ($purF['id'] == $finishProject->id)
                                <label class="labelClientName">{{$purF['nameClient']}}</label>
                                <br>
                                
                                </a>
                                <a class="mb-1 titulo" href="http://maps.apple.com/?q={{$purF['address']}}" id="label{{$finishProject->id}}" style="color: #495057; font-weight: bold; text-decoration: underline;">{{$purF['address']}}</a>
                                @if (Auth::user()->rol == 'labor')
                                    <div href="{{route ('project.moreInfo',$finishProject)}}"></div>
                                @else
                                    <h4 class="mobile"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$finishProject->id}})"  id="buttonbadge{{$finishProject->id}}" style="color: white; cursor: pointer;">Copy</a></h4> 
                                    <h6 class="desktop"><a class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Copied" onclick="getAddress({{$finishProject->id}})"  id="buttonbadge{{$finishProject->id}}" style="color: white; cursor: pointer;">Copy</a></h6>     
                                @endif
                                
                    <a 
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        href="{{route ('project.moreInfo',$finishProject)}}"
                    @else
                        href="{{route ('project.moreInfo2',$finishProject)}}"
                    @endif>
                </label>
                                @endif
                            @endforeach
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                @foreach ($arrayServicesF as $aServicesF)
                                    @if ($aServicesF['idProject'] == $finishProject->id)
                                        @if ($aServicesF['principal'] == 1)
                                            <label class="labelService">{{$aServicesF['service']}}</label>
                                            <br>
                                        @endif   
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        

                    @if (Auth::user()->rol == 'admin'|| Auth::user()->rol == 'secretary')
                        <div class="row text-center">
                            <div class="col-6">
                                <label class="numeros">${{number_format($finishProject->sold_project,2)}}</label>
                                <label class="numerosX">$XXXX.XX</label>
                                <br>
                                <label class="labelSold">SOLD</label>
                            </div>
                            <div class="col-6">
                                @foreach($purchasesF as $purF)
                                    @if ($purF['id'] == $finishProject->id)
                                        <label class="numeros">${{number_format($purF['accountReceivables'],2)}}</label>
                                        <label class="numerosX">$XXXX.XX</label>
                                        <br>
                                        <label class="labelBudget">Account Receivables</label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    
                        <div class="row text-center">
                            @foreach ($purchasesF as $purF)
                                @if ($purF['id'] == $finishProject->id)
                                <div class="col-6">
                                    <label class="numeros">${{number_format($purF['value'],2)}}</label >
                                    <label class="numerosX">$XXXX.XX</label>
                                    <br>
                                    <label class="labelSpent">SPENT</label >
                                </div>
                                <div class="col-6">
                                    @if (Auth::user()->rol != 'secretary')
                                        <label class="numeros">${{number_format($purF['newProfitF'],2)}}</label >
                                        <label class="numerosX">$XXXX.XX</label>
                                        <br>
                                        <label class="labelProfit">PROFIT</label>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>                      
                    @endif
                    </a>
                    @if (Auth::user()->rol == 'admin'|| Auth::user()->rol == 'secretary')
                        <div class="row">
                            <div class="col">
                                <div class="dropdown text-left " id="dropdownid" >
                                    <a href="{{route('project.edit',$finishProject)}}"><i class="fas fa-edit" style="color:black;"></i></a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="dropdown text-right " id="dropdownid" >
                                    <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettingsFinish{{$finishProject->id}}">
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>            
                <br>
                <!-- Modal Settings -->
                <div class="modal fade" id="modalSettingsFinish{{$finishProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{$finishProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <h6 class="text-center" style="margin-top: 8px;"><b>Select a change</b></h6>
                        <div class="list-group" style="text-align: center;">
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('purchase.morePurchase',$finishProject)}}" class="badge badge-light">New Purchase</a>
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="#" data-dismiss="modal" class="badge badge-light" data-toggle="modal" data-target="#exampleModalPayment{{$finishProject->id}}">New Payment</a>
                            {{-- <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$finishProject)}}" class="badge badge-light">Edit</a> --}}
                            <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$finishProject,4])}}" class="badge badge-light">Archived</a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Modal Payment -->
                <div class="modal fade" id="exampleModalPayment{{$finishProject->id}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">New Payment - {{$finishProject->name_project}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-two" class="form-area">
                                <form action="{{route('paymentStore',$finishProject)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <div class="row">
                                                <div class="col-6 text-right">Method*</div>
                                                <div class="col-6">
                                                    <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                        @foreach ($paymentMethod as $payments)
                                                            <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-right">Amount*</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                <div class="col-6 text-right">Transaction Date*</div>
                                                <div class="col-6" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4-{{$finishProject->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                <div class="col-6 text-right">Order/Transaction</div>
                                                <div class="col-6"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                <div class="col-6 text-right">Description</div>
                                                <div class="col-6"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        $('#datepicker4-{{$finishProject->id}}').datepicker({
                            uiLibrary: 'bootstrap4',
                        });
                    </script>
                </div>
                @endforeach
                </div>
                
            </div>
        </div>

    </div>
</div>
    <script>
        function getAddress(id) {
            $('#buttonbadge'+id).tooltip('show');
            var codigoACopiar = document.getElementById('label'+id);
            var seleccion = document.createRange();
            seleccion.selectNodeContents(codigoACopiar);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(seleccion);
            var res = document.execCommand('copy');
            window.getSelection().removeRange(seleccion);
        }

        var mobile = (/iphone|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
        if (!mobile) {
            $('#collapseActive').collapse('show');
            $('#collapseWont').collapse('show');
            $('#collapsePermit').collapse('show');
            $('#collapsePaused').collapse('show');
            $('#collapseComplete').collapse('show');
            $('#buttonCollapseActive').hide();
            $('#buttonCollapseWont').hide();
            $('#buttonCollapsePermit').hide();
            $('#buttonCollapsePaused').hide();
            $('#buttonCollapseComplete').hide();
            $('.searchbarmobile').hide();
            
            }
        else{
            $('.titulo2').hide();
            $('#buttonCollapseActive').show();
            $('#buttonCollapseWont').show();
            $('#buttonCollapsePermit').show();
            $('#buttonCollapsePaused').show();
            $('#buttonCollapseComplete').show();
            $('#collapseActive').collapse('show');
            $('#collapseWont').collapse('hide');
            $('#collapsePermit').collapse('hide');
            $('#collapsePaused').collapse('hide');
            $('#collapseComplete').collapse('hide');
            $('.searchbardesktop').hide();
        }
    </script>
@stop