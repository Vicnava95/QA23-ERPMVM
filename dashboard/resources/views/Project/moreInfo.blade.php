@extends('master')

@section('title')
    <title>{{$project->name_project}}</title>
@stop
@section('extra_links')

{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- Script Font Awesome-->
<script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

<!-- Chart JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.js" integrity="sha512-a+uzkcbI/MyXYDayp12Y28mqzeAlzdKZRaJfhpyU8326w+oGqfqA3B73CMNl77D0N11FLOe8ZeHURAf6mnO8Jg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.min.js" integrity="sha512-x5/OWp6+ZmVcHgn9/8L9ts51vU4pEA1JN3FpFbKKn5uMwVF25lM3NhbXlC62Aw0KZEiKNEWrcGnwrOb7QPHuEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.js" integrity="sha512-lUsN5TEogpe12qeV8NF4cxlJJatTZ12jnx9WXkFXOy7yFbuHwYRTjmctvwbRIuZPhv+lpvy7Cm9o8T9e+9pTrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.js" integrity="sha512-sLvQol0YcXzV+X/MY/VOWx4jw6AUrnTCTRgJaJFsNjdVfM3roYU9duIUPTlNR8lQjjH2phaQCU5/Yekar1M8Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.min.js" integrity="sha512-m4VsSgMQ0Mw2iOS3ysNMINQNje3Q5c4AXeZXCVv60HjGMXy2iqZFo9c64itcXZ3ndsPOn5sOk4RgYWC1mBeEmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>

<!-- DataTable JS-->
{{HTML::script('js/projects/moreInfo.js')}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<!-- Date Picker -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<!-- Lazy Load -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{HTML::style('css/project/project.css')}}

{{HTML::style('css/gmap.css')}}
{{HTML::script('js/gmap.js')}}

@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                @if (Auth::user()->rol == 'admin'|| Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                    <h4><a href="{{route('project.active')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
                @else
                    <h4><a href="{{route('project.active2')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
                @endif
            </div>
            <div class="col" style="text-align: right; max-width:450px; padding-right:0px;">
                @if (Auth::user()->rol != 'labor')
                    <label class="check-text">
                        <input type='checkbox' id="dataFinance" checked/>
                        <h4 class="checked"><span class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Hide"><i class="uil uil-eye" onclick="showData(1)"></i></span></h4>
                        <h4 class="unchecked"><span class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Show"><i class="uil uil-eye-slash" onclick="showData(0)"></i></span></h4>
                    </label>
                @endif
                
            </div>
            <div class="col desktop" style="text-align: right">
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    {{-- <h4><a href="{{route('project.dropzone',$project)}}"  class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Add Image"><i class="uil uil-image-plus"></i></a></h4> --}}
                    <h4><a href="{{route('project.edit',$project)}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Edit Project">Edit Project</a></h4>
                    <h4><a href="#" class="badge badgeERPButton" data-toggle="modal" data-target="#modalNewPayment">+ Payment</a></h4>
                    @if ($permitInfo['id'] != 0)
                        <h4 data-toggle="tooltip" data-placement="bottom" title="New Comment"><a role="button" href="" class="badge badgeERPButton" data-toggle="modal" data-target="#exampleModalCenter"><i class="uil uil-comment-plus"></i></a></h4>
                    @endif
                    <h4><a href="{{route('purchase.morePurchase',$project)}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Add Expense"><i class="uil uil-bill"></i></a></h4>
                    @if ($permitInfo['id'] != 0)
                        <h4 data-toggle="tooltip" data-placement="bottom" title="Permit Information"><a href="{{route('infoPermit',$permitInfo['id'])}}" class="badge badgeERPButton"><i class="uil uil-folder-exclamation"></i></a></h4>
                    @endif
                    <div class="btn-group">
                        {{-- <button type="button" class="badge badgeERPButton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h6>STATUS</h6>
                        </button> --}}
                        <h4 data-toggle="tooltip" data-placement="bottom" title="Edit Status"><a role="button" href="" class="badge badgeERPButton" data-toggle="modal" data-target="#modalSelectStatus"><i class="uil uil-file-bookmark-alt"></i></a></h4>
                        <!-- Modal -->
                        <div class="modal fade" id="modalSelectStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Change Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="list-group" style="text-align: left;">
                                        @if ($project->status_fk != 1)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,1])}}">Active</a>
                                        @endif
                                        @if ($project->status_fk != 2)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,2])}}">Finished</a>
                                        @endif
                                        @if ($project->status_fk != 3)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,3])}}">Schedule</a>
                                        @endif
                                        @if ($project->status_fk != 4)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,4])}}">Archived</a>
                                        @endif
                                        @if ($project->status_fk != 5)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,5])}}">Paused</a>
                                        @endif
                                        @if ($project->status_fk != 6)
                                            <a class="list-group-item list-group-item-action" href="{{route('project.updateStatu',[$project,6])}}">Permit</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                        </div>
                    </div>
                @endif
            </div>
            @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                <div class="col mobile" style="text-align: right">
                    {{-- <div class="btn-group">
                        <button type="button" class="badge badgeERP dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h6>STATUS</h6>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('project.updateStatu',[$project,4])}}" class="badge badge-light">Archived</a>
                        </div>
                    </div> --}}
                    <div class="btn-group">
                        <h4><a href="" type="button" data-toggle="modal" data-target="#modalMoreAction" class="badge badgeERPButton"><i class="uil uil-ellipsis-h"></i></a></h4>
                        {{-- <button type="button" class="btn badgeERP" data-toggle="modal" data-target="#modalMoreAction">
                            <h6>MORE ACTIONS</h6>
                        </button> --}}
                        {{-- <button type="button" class="badge badgeERP dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        </button> --}}
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
                                        <h6 ><a href="{{route('project.edit',$project)}}" class="dropdownMobile">EDIT PROJECT</a></h6>
                                        <h6><a href="#" class="dropdownMobile" data-toggle="modal" data-target="#modalNewPayment">ADD PAYMENT</a></h6>
                                        {{-- @if ($permitInfo['id'] != 0)
                                        <h6><a role="button" href="" class="dropdownMobile" data-toggle="modal" data-target="#exampleModalCenter">ADD COMMENT</a></h6>
                                        @endif --}}
                                        <h6 ><a href="{{route('purchase.morePurchase',$project)}}" class="dropdownMobile">ADD EXPENSE</a></h6>
                                        {{-- <h6 ><a href="{{route('project.dropzone',$project)}}" class="dropdownMobile">ADD TO GALLERY</a></h6> --}}
                                        @if ($permitInfo['id'] != 0)
                                            <h6 ><a href="{{route('infoPermit',$permitInfo['id'])}}" class="dropdownMobile">PERMIT STATUS</a></h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="dropdown-menu dropdown-menu-right">
                            @if ($permitInfo['id'] != 0)
                                <h6><a role="button" href="" class="dropdownMobile" data-toggle="modal" data-target="#exampleModalCenter">ADD COMMENT</a></h6>
                            @endif
                            <h6 ><a href="{{route('purchase.morePurchase',$project)}}" class="dropdownMobile">ADD EXPENSE</a></h6>
                            <h6 ><a href="{{route('project.edit',$project)}}" class="dropdownMobile">EDIT PROJECT</a></h6>
                            @if ($permitInfo['id'] != 0)
                                <h6 ><a href="{{route('infoPermit',$permitInfo['id'])}}" class="dropdownMobile">PERMIT STATUS</a></h6>
                            @endif
                        </div> --}}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4">
                @if ($diferenceBudget != 0 && $project->status_fk != 2 && floatval($project->budget_project) != 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Expenses are <strong>${{$diferenceBudget}} ({{number_format($percentDiference,2)}}%)</strong> over the budget.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <h5>GENERAL INFORMATION
                    @if ($project->status_fk == 2)
                        <span class="badge badge-danger badgeStatus" style="font-size: 0.7rem;">Finished</span>
                    @endif
                    @if ($project->status_fk == 1)
                        <span class="badge badge-success badgeStatus" style="font-size: 0.7rem;">Activate</span>
                    @endif
                    @if ($project->status_fk == 3)
                        <span class="badge badge-warning badgeStatus" style="font-size: 0.7rem;">Starting Soon</span>
                    @endif
                    @if ($project->status_fk == 5)
                        <span class="badge badge-secondary badgeStatus" style="font-size: 0.7rem;">Paused</span>
                    @endif
                    @if ($project->status_fk == 6)
                        <span class="badge badge-primary badgeStatus" style="font-size: 0.7rem;">Permit Processing</span>
                    @endif
                </h5>

                <div class="row">
                    <div class="col-9">
                        <h6><b>Project ID:</b> {{$project->id}}</h6>
                    </div>
                    <div class="col-3" style="padding-left: 0px;">
                        <a role="button" href="" class="badge badgeERP" data-toggle="modal" data-target="#showInfoClientModal">Client Info</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6><b>Project Name:</b> {{$project->name_project}}</h6>
                    </div>
                </div>

                <!-- Modal Client Information-->
                <div class="modal fade" id="showInfoClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Client Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    @if ($client != null)
                                        <h6><b>Name:</b> {{$client->nameClient}}</h6>
                                        <h6><b>Phone:</b> {{$client->phoneClient}}</h6>
                                    @else
                                        <h6><b>Name:</b> null</h6>
                                        <h6><b>Phone:</b> null</h6>
                                    @endif
                                    <h6><b>Source:</b> {{$project->clients->nameClientSource}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6 colDate1">
                    <h6><b>Start Date:</b></h6>
                    <h6>{{$project->start_date_project}}</h6>
                    </div>
                    <div class="col-6 colDate2">
                    <h6><b>End Date:</b></h6>
                    <h6>{{$project->end_date_project}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6><b>Worked Days:</b> {{$daysWorked}}</h6>
                    </div>
                </div>
                <h6><b>Address</b>  
                    <a href="#" class="badge badgeERP" data-toggle="tooltip"  data-placement="top" title="Copied" onclick="getAddress('{{$project->address_project}}')" id="buttonbadge">Copy</a>
                </h6>
                <a id="textCopy" href="http://maps.apple.com/?q={{$project->address_project}}" target="blank"><h6>{{$projectAddress}}</h6></a>
                <h6><b>Services:</b>
                    @if (Auth::user()->rol != 'labor')
                        <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#choosePrincipalService" aria-expanded="false" aria-controls="coments">
                            Main
                        </a>
                    @endif 

                    <!-- Modal New HomeDepotLocation-->
                    <div class="modal fade" id="choosePrincipalService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Choose Main Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div id="formHomeDepot" class="form-area">
                                <form action="{{route('chooseMainService',$project)}}">
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    @foreach($services as $service)
                                                        <div class="form-check form-check-inline radios" id="radioService{{$service->id}}">
                                                            <input class="form-check-input" type="radio" name="principal" id="inlineRadio{{ $service->id}}" value="{{ $service->id}}" @if ($service->id == $principalService)
                                                                checked
                                                            @endif >
                                                            <label class="form-check-label" for="inlineRadio{{ $service->id}}" style="font-size: 14px;">{{ $service->name_service}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </h6>
                @foreach ($services as $service)
                    @if ($service->id == $principalService)
                        <h6 style="color:#e4a627;"><b><li>{{$service->name_service}}</li></b></h6>
                    @else
                        <h6><li>{{$service->name_service}}</li></h6> 
                    @endif
                        
                @endforeach
                <h6 style="margin-bottom: 0px;"><b>Home Depot Location</b>  
                    @if (Auth::user()->rol != 'labor')
                        <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#addHomeDepotLocation" aria-expanded="false" aria-controls="coments">
                            Add
                        </a>
                    @endif
                    
                </h6>
                <a style="text-decoration: underline; color: black" target="blank" href="http://maps.apple.com/?q={{$project->homeDepotLocation}}"><h6>{{$project->homeDepotLocation}}</h6></a>

                <!-- Modal New HomeDepotLocation-->
                <div class="modal fade" id="addHomeDepotLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Homedepot Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div id="formHomeDepot" class="form-area">
                            <form action="{{route('addHomeDepotLocation',$project)}}">
                                @method('POST')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" width="100%" name="inputHomedepot" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                <h5>SCOPE OF WORK</h5>
                <textarea class="form-control"  rows="7" readonly> {{$project->scope_project}}</textarea>
                <br>

                <h5>
                    PHASES 
                    @if (Auth::user()->rol != 'labor')
                        <button type="button" class=" btn badge badgePlus" id="addMorePhase" data-toggle="modal" data-target="#modalAddMorePhase"><i class="fas fa-plus"></i></button>
                    @endif
                </h5>
                <!-- MODAL TO ADD MORE PHASES -->
                <div class="modal fade" id="modalAddMorePhase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add a phase </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDo" class="form-area">
                                <form action="{{route('phase.store',$project)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="form-group text-center">
                                                <input class="form-control form-control-sm formModalToDo" type="text" id="inputPhase" name="inputPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>
                                                <textarea class="form-control form-control-sm formModalToDo" name="inputPhaseComment[]" id="inputPhaseComment[]" rows="3" placeholder="Description"></textarea>
                                                <input class="form-control form-control-sm formModalToDo" type="number" id="budgetPhase" name="budgetPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Budget"  min="0" step="0.01" required>
                                                <input class="form-control form-control-sm formModalToDo" type="number" id="soldPhase" name="soldPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Sold"  min="0" step="0.01">
                                                <select class="form-control form-control-sm formModalToDo" id="inputService" style="margin-bottom: 5px;" name="inputService[]">
                                                    <option>Choose a service</option>
                                                    @foreach ($allServices as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name_service }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="allInputsPhase">
                                            
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn badgeERP btn-sm addPhases"><h6 style="margin-bottom: 0px;">Add new</h6></button>
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div id="accordion">
                    @foreach ($phases as $phase)
                        @if ($phase->name_phase != 'Empty')
                        <div class="card cardStyle">
                            <div class="card-header" id="heading{{$phase->id}}">
                              <h5 class="mb-0">
                                  <div class="row">
                                      <div class="col-9">
                                          <button class="btn btn-link collapsed collapseTitle" style="padding-bottom: 0px; color:#000000; text-decoration:underline;" data-toggle="collapse" data-target="#collapse{{$phase->id}}" aria-expanded="false" aria-controls="collapse{{$phase->id}}">
                                              <b>{{$phase->name_phase}}</b> 
                                          </button>
                                      </div>
                                      <div class="col-3 text-right" style="padding-left: 0px;">
                                        @if (Auth::user()->rol != 'labor')
                                            <a style="margin: 7px 0px 0px 0px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalEditPhase{{$phase->id}}"><i class="fas fa-edit"></i></i></a>
                                            <a style="margin: 5px 5px 5px 0px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalDeletePhase{{$phase->id}}"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                      </div>
                                  </div>
                                  @foreach ($infoPhasePercent as $iPhasePercent)
                                    @if ($iPhasePercent['idPhase'] == $phase->id)
                                        @switch($iPhasePercent['percent'])
                                            @case(-1)
                                                <h6 style="padding-left: 14px;">The budget is $0.00</h6>
                                            @break
                                            @case(-2)
                                                <h6 style="padding-left: 14px;">Has no expense</h6>
                                            @break
                                            @case(100)
                                                <h6 style="padding-left: 14px;">Check the expenses</h6>
                                                <div class="progress" style="margin-left:15px; margin-right:15px; margin-bottom:5px; background-color:#000000; color: #ffffff;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color:#e4a627; color: #000000;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b>100%</b></div>
                                                </div>
                                            @break
                                            @default
                                                <div class="progress" style="margin-left:15px; margin-right:15px; margin-bottom:5px; background-color:#000000; color: #ffffff;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{$iPhasePercent['percent']}}%; background-color:#e4a627; color: #000000;" aria-valuenow="{{$iPhasePercent['percent']}}" aria-valuemin="0" aria-valuemax="100">{{$iPhasePercent['percent']}}%</div>
                                                </div>
                                        @endswitch
                                    @endif
                                  @endforeach
                                  
                              </h5>
                            </div>
                        
                            <div id="collapse{{$phase->id}}" class="collapse" aria-labelledby="heading{{$phase->id}}" data-parent="#accordion">
                              <div class="card-body">
                                @foreach ($infoPhasePercent as $iPhasePercent)
                                    @if ($iPhasePercent['idPhase'] == $phase->id)
                                        @if ($iPhasePercent['service'] != 'null')
                                            <pre style="margin-bottom: 0px;"><b>Service: {{$iPhasePercent['service']}}</b></pre>
                                        @endif
                                    @endif
                                @endforeach
                                <pre style="margin-bottom: 0px;"><b>Budget:${{$phase->budget_phase}}</b></pre>
                                @if ($phase->budget_phase != null)
                                    <pre style="margin-bottom: 0px;"><b>Sold:${{$phase->sold_phase}}</b></pre>
                                @endif
                                @foreach ($amountPhases as $aPhases)
                                    @if ($phase->id == $aPhases['idPhase'])
                                        <pre style="margin-bottom: 0px;"><b>Expenses:${{$aPhases['amountPhase']}}</b></pre>
                                    @endif
                                @endforeach
                                @foreach ($infoPhasePercent as $iPhasePercent)
                                    @if ($iPhasePercent['idPhase'] == $phase->id)
                                        @if ($iPhasePercent['lose'] > 0)
                                            <pre style="margin-bottom: 0px; color:red;"><b>Over Budget:${{$iPhasePercent['lose']}}</b></pre>
                                        @endif

                                        @if ($iPhasePercent['profit'] > 0)
                                            <pre style="margin-bottom: 0px; color:green;"><b>Remaind Budget:${{$iPhasePercent['profit']}}</b></pre>
                                        @endif

                                        @if ($iPhasePercent['profitSold'] > 0)
                                            <pre style="margin-bottom: 0px; color:green;"><b>Profit:${{$iPhasePercent['profitSold']}}</b></pre>
                                        @endif
                                        @if ($iPhasePercent['profitSold'] < 0)
                                        <pre style="margin-bottom: 0px; color:red;"><b>Profit:${{abs($iPhasePercent['profitSold'])}}</b></pre>
                                        @endif
                                        @if ($iPhasePercent['profitSold'] != 0)
                                        <pre style="margin-bottom: 0px;"><b>Worked Days:{{abs($iPhasePercent['days'])}}</b></pre>
                                        @endif
                                    @endif
                                @endforeach
                                <pre style="margin-bottom: 5px;"><b>Description:</b></pre>
                                <pre>{{$phase->text_phase}}</pre>
                                  {{-- @if (Auth::user()->rol != 'labor')
                                    <br>
                                    <b>Budget: </b>${{$phase->budget_phase}}
                                  @endif --}}
                              </div>
                            </div>
                          </div>
                        @endif
                    @endforeach
                </div>

                @foreach ($phases as $phase)
                <!-- MODAL TO EDIT PHASES -->
                <div class="modal fade" id="modalEditPhase{{$phase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit phase </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDo" class="form-area">
                                <form action="{{route('phase.update',$phase)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group">
                                            <label for="" style="margin-bottom: 0px;">Title</label>
                                            <input class="form-control form-control-sm formModalToDo" type="text" id="inputPhase" name="inputPhase" autocomplete="off" style="margin-bottom: 5px;" value="{{$phase->name_phase}}" required>
                                            <label for="" style="margin-bottom: 0px;">Description</label>
                                            <textarea class="form-control form-control-sm formModalToDo" name="inputPhaseComment" id="inputPhaseComment" rows="3" >{{$phase->text_phase}}</textarea>
                                            <label for="" style="margin-bottom: 0px;">Budget</label>
                                            <input class="form-control form-control-sm formModalToDo" type="number" id="budgetPhase" name="budgetPhase" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" value="{{$phase->budget_phase}}" required>
                                            <label for="" style="margin-bottom: 0px;">Sold</label>
                                            <input class="form-control form-control-sm formModalToDo" type="number" id="soldPhase" name="soldPhase" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" value="{{$phase->sold_phase}}">
                                            <label for="" style="margin-bottom: 0px;">Service</label>
                                            <select class="form-control form-control-sm formModalToDo" id="inputService" style="margin-bottom: 5px;" name="inputServiceEdit">
                                                <option>Choose a service</option>
                                                @foreach ($allServices as $service)
                                                <option value="{{ $service->id }}" 
                                                    @foreach ($phaseService as $pService)
                                                        @if ($pService->phase_id == $phase->id)
                                                            @if($pService->service_id == $service->id)
                                                                selected="selected"
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                     >{{ $service->name_service }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- MODAL TO DELETE PHASES -->
                <div class="modal fade" id="modalDeletePhase{{$phase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete phase </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDo" class="form-area">
                                <form action="{{route('phase.destroy',$phase)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <label for=""><b>Title: </b>{{$phase->name_phase}}</label><br>
                                            <label for=""><b>Description: </b>{{$phase->text_phase}}</label><br>
                                            <label for=""><b>Budget: </b>${{$phase->budget_phase}}</label>
                                            <label for=""><b>Sold: </b>${{$phase->sold_phase}}</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Delete</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach

                {{-- <h5>SCHEDULING 
                    @if (Auth::user()->rol != 'labor')
                        <button type="button" class=" btn badge badgePlus" id="addToDo" data-toggle="modal" data-target="#modalToAddTodo"><i class="fas fa-plus"></i></button>
                    @endif
                </h5> --}}
                @if(session()->has('deleteMessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('deleteMessage') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- MODAL TO ADD MORE TODO´S -->
                <div class="modal fade" id="modalToAddTodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add a task </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDo" class="form-area">
                                <form action="{{route('storeToDoProject',$project->id)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="form-group text-center">
                                                <input class="form-control form-control-sm formModalToDo" type="text" id="inputToDo" name="inputToDo[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>
                                                <textarea class="form-control form-control-sm formModalToDo" name="inputToDoComment[]" id="inputToDoComment[]" rows="3" placeholder="Description"></textarea>
                                                <div id="datepicker-container">
                                                    <div id="datepicker-center">
                                                        <input class="formModalToDo" type="text" id="datepicker" width="135" name="dateToDo[]" autocomplete="off" style="height: 32px; font-size: 13px;">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="allInputsToDo">
                                            
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn badgeERP btn-sm addInputs"><h6 style="margin-bottom: 0px;">Add new</h6></button>
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                @foreach ($toDos as $toDo)
                <div class="row">
                    <div class="col-11" style="padding-right:5px;">
                        <div class="checkbox">
                            <input class="form-check-input" type="checkbox" 
                                @if ($toDo->generalStatus_fk == 1)
                                    checked
                                @endif 
                            value="" id="defaultCheck{{$toDo->id}}" onclick="changeStatusToDo({{$toDo->id}})">
                            <label class="form-check-label" for="defaultCheck{{$toDo->id}}">
                                @if ($toDo->todoDate != null) 
                                    <b>{{$toDo->todoDate}}</b> 
                                    -
                                    @if ($toDo->todoTitle != null) 
                                    <b>{{$toDo->todoTitle}}</b> 
                                    <br>
                                    @endif
                                @else
                                    @if ($toDo->todoTitle != null) 
                                    <b>{{$toDo->todoTitle}}</b> 
                                    <br>
                                    @endif
                                @endif
                                {{$toDo->todoComment}}
                            </label>
                            
                            {{-- <div style="text-align: left">
                                <span style="padding-left: 25px; font-size:12px;"></span>
                            </div> --}}
                            
                            
                        </div>
                    </div>
                    <div class="col-1" style="padding-right:0px; padding-left:0px;">
                        <div class="btn-group">
                            @if (Auth::user()->rol != 'labor')
                            <button type="button" class="btn btn-secondary dropdown-toggle badgeERP" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right text-center">
                                <a class="btn btn-outline-danger dropdown-item" data-toggle="modal" href="" data-target="#modalDeletToDo{{$toDo->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i> Delete</a>
                                <a class="btn btn-outline-primary dropdown-item" data-toggle="modal" href="" data-target="#modalUpdateToDo{{$toDo->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-edit"></i> Edit</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Delete ToDo -->
                <div class="modal fade" id="modalDeletToDo{{$toDo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this task? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            {{$toDo->todoComment}}
                            {{-- <br>
                            <span style="font-size:12px;">This task was made for {{$toDo->users->name}}</span> --}}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a role="button" href="{{route('deleteToDoProject',$toDo->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Update ToDo -->
                <div class="modal fade" id="modalUpdateToDo{{$toDo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to update this task? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDoUpdate" class="form-area">
                                <form action="{{route('updateToDoProject',$toDo->id)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="form-group text-center">
                                                <input class="form-control form-control-sm formModalToDo" type="text" id="inputToDoUpdate" name="inputToDoUpdate" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" value="{{$toDo->todoTitle}}" required>
                                                <textarea class="form-control form-control-sm formModalToDo" name="inputToDoCommentUpdate" id="inputToDoCommentUpdate" rows="3" placeholder="Description">{{$toDo->todoComment}}</textarea>
                                                <div id="datepicker-container">
                                                    <div id="datepicker-center">
                                                        <input class="formModalToDo" type="text" id="datepickerUpdate{{$toDo->id}}" width="135" name="dateToDoUpdate" autocomplete="off" style="height: 32px; font-size: 13px;" value="{{$toDo->todoDate}}">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <script>
                    $('#datepickerUpdate{{$toDo->id}}').datepicker({
                        uiLibrary: 'bootstrap4',
                    });
                </script>
                @endforeach

                {{-- <h5>TIMELINE PROJECT
                    @if (Auth::user()->rol != 'labor')
                        <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#modalAddTimelineProject" aria-expanded="false" aria-controls="coments">
                            New
                        </a>
                        <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#modalTimeline" aria-expanded="false" aria-controls="coments">
                            All
                        </a>
                    @endif
                </h5> --}}
                
                @if(session()->has('deleteMessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('deleteMessage') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Modal New Comment-->
                <div class="modal fade" id="modalAddTimelineProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Timeline</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="form-ToDo" class="form-area">
                                <form action="{{route('addTimelineProject',$project)}}">
                                    @method('POST')
                                    <div class="modal-body" style="padding-bottom: 0px;">
                                        <div class="form-group text-center">
                                            <input class="form-control form-control-sm formModalToDo" type="text" id="inputTitleTimeline" name="inputTitleTimeline" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>
                                            <textarea class="form-control form-control-sm formModalToDo" name="inputCommentTimeline" id="inputCommentTimeline" rows="3" placeholder="Description"></textarea>
                                            <div id="datepicker-container">
                                                <div id="datepicker-center">
                                                    <input class="formModalToDo" type="text" id="datepicker3" width="135" name="dateTimeline" autocomplete="off" style="height: 32px; font-size: 13px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                @if (!$timeline->isEmpty())
                    <ul class="timeline">
                        <li>
                            <div class="row">
                                <div class="col-6">
                                    <h6 style="margin-bottom: 0px;"><b>{{$timeline[0]->timeLineDate}}</b></h6>
                                    <h6 style="margin-bottom: 0px;"><b>{{$timeline[0]->timeLineTitle}}</b></h6>
                                </div>
                                <div class="col-6" style="text-align: right;">
                                    @if (Auth::user()->rol != 'labor')
                                        <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#updateTimeLine{{$timeline[0]->id}}"><i class="fas fa-edit"></i></a>
                                        <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#deleteTimeLine{{$timeline[0]->id}}"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                </div>
                            </div>
                            <p style="margin-bottom: 0px;">{{$timeline[0]->timeLineComment}}</p>
                            <!-- Button trigger modal -->
                            @if (Auth::user()->rol != 'labor')
                                <h6>
                                    <a href="" class="badge badgeERP permitLog" style="margin-top: 0px;" role="button" data-toggle="modal" data-target="#viewImage" aria-expanded="false" aria-controls="coments">
                                        Images
                                    </a>
                                    <a href="{{route('addMoreImageTimeLine',[$project->id,$timeline[0]->id])}}" class="badge badgeERP permitLog" style="margin-top: 0px;" role="button">
                                        Add Image
                                    </a>
                                </h6>
                            @endif
                            
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$timeline[0]->timeLineDate}} {{$timeline[0]->timeLineTitle}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($timeLineImage as $tLineImage)
                                                    @if ($tLineImage['timeLineWork_fk'] == $timeline[0]->id )
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100" src="{{ URL::asset('timeLine/'.$tLineImage['nameFileDocument']) }}" alt="First slide">
                                                        </div>
                                                    @break
                                                    @endif
                                                @endforeach
                                                @foreach ($timeLineImage as $index => $tLineImage)
                                                    @if ($tLineImage['timeLineWork_fk'] == $timeline[0]->id && $index !== array_key_first($timeLineImage))
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="{{ URL::asset('timeLine/'.$tLineImage['nameFileDocument']) }}" alt="First slide">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                              <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        {{-- @foreach ($timeLineImage as $tLineImage)
                                            <img class="zoom" src="{{ URL::asset('timeLine/'.$tLineImage->nameFileDocument) }}" alt="" style="width:50px; height:50px;">
                                        @endforeach --}}
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                        </li>
                        <!-- START Modal Update Comments -->
                        
                        <!-- MODAL UPDATE TIMELINE -->
                        <div class="modal fade" id="updateTimeLine{{$timeline[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Timeline </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div id="form-ToDo" class="form-area">
                                        <form action="{{route('updateTimeLineProject',$timeline[0]->id)}}">
                                            @method('POST')
                                            <div class="modal-body" style="padding-bottom: 0px;">
                                                <div class="form-group text-center">
                                                    <input class="form-control form-control-sm formModalToDo" type="text" id="inputTitleTimelineUpdate" name="inputTitleTimelineUpdate" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required value="{{$timeline[0]->timeLineTitle}}">
                                                    <textarea class="form-control form-control-sm formModalToDo" name="inputCommentTimelineUpdate" id="inputCommentTimelineUpdate" rows="3" placeholder="Description">{{$timeline[0]->timeLineComment}}</textarea>
                                                    <div id="datepicker-container">
                                                        <div id="datepicker-center">
                                                            <input class="formModalToDo" type="text" id="datepicker4" width="135" name="dateTimelineUpdate" autocomplete="off" style="height: 32px; font-size: 13px;" value="{{$timeline[0]->timeLineDate}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- MODAL DELETE TIMELINE -->
                        <div class="modal fade" id="deleteTimeLine{{$timeline[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    Title: {{$timeline[0]->timeLineTitle}}
                                    <br>
                                    Comment: {{$timeline[0]->timeLineComment}}
                                    <br>
                                    Date: {{$timeline[0]->timeLineDate}}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a role="button" href="{{route('deleteTimeLineProject',$timeline[0]->id)}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </ul>
                @endif

                <!-- Modal Timelines-->
                <div class="modal fade bd-example-modal-lg" id="modalTimeline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Timeline Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <ul class="timeline">
                                    @foreach ($timeline as $tLine)
                                        <li>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6 style="margin-bottom: 0px;"><b>{{$tLine->timeLineDate}}</b></h6>
                                                    <h6><b>{{$tLine->timeLineTitle}}</b></h6>
                                                </div>
                                                <div class="col-6" style="text-align: right;">
                                                    @if (Auth::user()->rol != 'labor')
                                                        <a hidden style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#updateTimeLineInsideModal{{$tLine->id}}"><i class="fas fa-edit"></i></a>
                                                        <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#deleteTimeLineInsideModal{{$tLine->id}}"><i class="fas fa-trash-alt"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                            <p style="margin-bottom: 5px;">{{$tLine->timeLineComment}}</p>
                                            <h6>
                                                <a class="badge badgeERP permitLog" style="margin-top: 0px;" role="button" data-toggle="collapse" href="#collapseExample{{$tLine->id}}" aria-expanded="false" aria-controls="seeImages">
                                                    See Images
                                                </a>
                                            </h6>
                                                <div class="collapse" id="collapseExample{{$tLine->id}}">
                                                <div class="card card-body" style="padding: 0px; border: 0px;">
                                                    <div id="carouselExampleControls{{$tLine->id}}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach ($timeLineImage as $tLineImage)
                                                                @if ($tLineImage['timeLineWork_fk'] == $tLine->id )
                                                                    <div class="carousel-item active">
                                                                        <img class="d-block w-100" src="{{ URL::asset('timeLine/'.$tLineImage['nameFileDocument']) }}" alt="First slide">
                                                                    </div>
                                                                @break
                                                                @endif
                                                            @endforeach
                                                            @foreach ($timeLineImage as $index => $tLineImage)
                                                                @if ($tLineImage['timeLineWork_fk'] == $tLine->id && $index !== array_key_first($timeLineImage))
                                                                    <div class="carousel-item">
                                                                        <img class="d-block w-100" src="{{ URL::asset('timeLine/'.$tLineImage['nameFileDocument']) }}" alt="First slide">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleControls{{$tLine->id}}" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls{{$tLine->id}}" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                </div>
                                        </li>
                                        <!-- MODAL DELETE TIMELINE -->
                                        <div class="modal fade" id="deleteTimeLineInsideModal{{$tLine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Title: {{$tLine->timeLineTitle}}
                                                    <br>
                                                    Comment: {{$tLine->timeLineComment}}
                                                    <br>
                                                    Date: {{$tLine->timeLineDate}}
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a role="button" href="{{route('deleteTimeLineProject',$tLine->id)}}" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>    
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn badgeERP btn-sm" data-dismiss="modal">Close</button>
                            {{-- <button type="button" href="" class="btn badgeERP btn-sm" role="button" data-toggle="modal" data-dismiss="modal" 
                                    data-target="#exampleModalCenter" aria-expanded="false" aria-controls="coments">
                                New
                            </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            @if (Auth::user()->rol != 'labor')
                <div class="col-12 col-sm-12 col-md-4" >
                    <h5>FINANCE DASHBOARD</h5>
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <div class="row rowFinance" style="display:flex; justify-content:center; align-items:center;">
                            <div class="col-md-2 col-4 text-center" style="padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($project->sold_project,2)}}</h6>
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Sold</h6>
                            </div>
                            <div class="col-md-2 col-4 text-center" style="padding-left: 5px; padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($project->budget_project,2)}}</h6>
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Budget</h6>
                            </div>
                            <div class="col-md-2 col-4 text-center" style="padding-left: 5px; padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($suma,2)}}</h6> 
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Expenses</h6>
                            </div>
                            <div class="col-md-2 col-4 text-center" style="padding-left: 5px; padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($incomes,2)}}</h6> 
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Incomes</h6>
                            </div>
                            @if (Auth::user()->rol != 'secretary')
                            <div class="col-md-2 col-4 text-center" style="padding-left: 5px;">
                                <h6 class="dataFinance">${{number_format($newMargin,2)}}</h6>
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Profit</h6>
                            </div>
                            @endif

                        </div>
                            @if (Auth::user()->rol != 'secretary')
                                <div class="row rowFinance" hidden>
                                    <div class="col-6 text-center">
                                        <h6 class="dataFinance">${{number_format($newMargin,2)}}</h6>
                                        <h6 class="dataFinanceX">$XXXX.XX</h6>
                                        <h6>Profit</h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h6 class="dataFinance">{{$newProfit}}%</h6>
                                        <h6 class="dataFinanceX">$XXXX.XX</h6>
                                        <h6>Profit Margin</h6>
                                    </div>
                                </div>
                        <h5>PAYMENTS</h5>
                        <div class="row rowFinance">
                            <div class="col-4 text-center" style="padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($project->sold_project,2)}}</h6>
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Sold</h6>
                            </div>
                            <div class="col-4 text-center" style="padding-left: 5px; padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($incomes,2)}}</h6> 
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Incomes</h6>
                            </div>
                            <div class="col-4 text-center" style="padding-left: 5px; padding-right: 5px;">
                                <h6 class="dataFinance">${{number_format($paymentPending,2)}}</h6> 
                                <h6 class="dataFinanceX">$XXXX.XX</h6>
                                <h6>Pending Balance</h6>
                            </div>
                        </div>
                        {{-- <div class="text-center">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th scope="row">Sold</th>
                                    <td class="dataFinance">${{number_format($project->sold_project,2)}}</td>
                                    <td class="dataFinanceX">$XXXX.XX</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Incomes</th>
                                    <td class="dataFinance">${{number_format($incomes,2)}}</td>
                                    <td class="dataFinanceX">$XXXX.XX</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Pending Balance</th>
                                    <td class="dataFinance">${{number_format($paymentPending,2)}}</td>
                                    <td class="dataFinanceX">$XXXX.XX</td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div> --}}
                        <div class="text-center">
                            <button type="button" class="btn badge badgeERP" data-toggle="modal" data-target="#modalNewPayment">
                                ADD NEW PAYMENT
                            </button>
                            <button type="button" class="btn badge badgeERP" data-toggle="collapse" data-target="#allpayments">
                                ALL PAYMENTS
                            </button>
                        </div>
                        <br>

                        <!-- Modal Payments-->
                        <div class="modal fade" id="modalNewPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">New Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div id="form-two" class="form-area">
                                    <form action="{{route('paymentStore',$project)}}">
                                        @method('POST')
                                        <div class="modal-body" style="padding-bottom: 0px;">
                                            <div class="form-group text-center">
                                                <div class="row">
                                                    <div class="col-4 text-right">Method*</div>
                                                    <div class="col-8">
                                                        <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                            @foreach ($paymentMethod as $payments)
                                                                <option value="{{$payments->id}}">{{$payments->namePaymentMethod}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4 text-right">Amount*</div>
                                                    <div class="col-8"><input class="form-control form-control-sm formModalToDo" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                    <div class="col-4 text-right">Transaction Date*</div>
                                                    <div class="col-8" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" type="text" id="datepicker4" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                    <div class="col-4 text-right">Order/Transaction</div>
                                                    <div class="col-8"><input class="form-control form-control-sm formModalToDo" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                    <div class="col-4 text-right">Description</div>
                                                    <div class="col-8"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3"></textarea></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Save</h6></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Collapse Payments-->
                        <div class="collapse" id="allpayments" style="margin-top: 8px;">
                            <ul class="timeline">
                                @foreach ($paymentsProject as $paymentsP)
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <h6><b>{{date('m/d/Y',strtotime($paymentsP->transactionDate))}}</b></h6>
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                @if (Auth::user()->rol != 'labor')
                                                    <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalUpdatePayments{{$paymentsP->id}}"><i class="fas fa-edit"></i></i></a>
                                                    <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalDeleteComments{{$paymentsP->id}}"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <p style="margin-bottom: 0px;"><b>Method:</b> {{$paymentsP->paymentMethod->namePaymentMethod}}</p>
                                        <p style="margin-bottom: 0px;"><b>Amount:</b> ${{number_format($paymentsP->amountPayment,2)}}</p>
                                        @if ($paymentsP->transaction != "")
                                            <p style="margin-bottom: 0px;"><b>Transaction:</b> {{$paymentsP->transaction}}</p>    
                                        @endif
                                        @if ($paymentsP->details != "")
                                            <p style="margin-bottom: 0px;"><b>Description:</b> {{$paymentsP->details}}</p>    
                                        @endif

                                        @foreach ( $paymentsImage as $paymentImage )
                                            @if ($paymentImage->payment_fk == $paymentsP->id)
                                                <p style="margin-bottom: 0px; padding:0px;" class="btn btn-link" data-toggle="collapse" data-target="#collapsePaymentsImage-{{$paymentsP->id}}" onclick="paymentsImage({{$paymentsP->id}})"><b>Images</b></p>    
                                                @break
                                            @endif
                                        
                                        @endforeach 
                                        <div id="accordion">
                                            <div id="collapsePaymentsImage-{{$paymentsP->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div id="paymentImage-{{$paymentsP->id}}">
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </li>
                                    
                                        <!-- START Modal Update Payments -->
                                        <div class="modal fade" id="modalUpdatePayments{{$paymentsP->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to edit this payment? </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div id="form-trhee" class="form-area">
                                                    <form action="{{route('paymentUpdate',$paymentsP->id)}}">
                                                        @method('POST')
                                                        <div class="modal-body" style="padding-bottom: 0px;">
                                                            <div class="form-group text-center">
                                                                <div class="row">
                                                                    <div class="col-4 text-right">Method*</div>
                                                                    <div class="col-8">
                                                                        <select class="form-control form-control-sm formModalToDo" id="methodPayment" name="methodPayment">
                                                                            @foreach ($paymentMethod as $payments)
                                                                                <option value="{{$payments->id}}" @if ($paymentsP->paymentMethod_fk == $payments->id)
                                                                                    selected
                                                                                @endif >{{$payments->namePaymentMethod}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4 text-right">Amount*</div>
                                                                    <div class="col-8"><input class="form-control form-control-sm formModalToDo" value="{{$paymentsP->amountPayment}}" type="number" name="amountPayment" autocomplete="off" style="margin-bottom: 5px;" min="0" step="0.01" required></div>
                                                                    <div class="col-4 text-right">Transaction Date*</div>
                                                                    <div class="col-8" style="margin-bottom: 5px;"><input class="form-control form-control-sm formModalToDo" value="{{date('m/d/Y',strtotime($paymentsP->transactionDate))}}" type="text" id="datepicker4-{{$paymentsP->id}}" width="100%" name="paymentDate" autocomplete="off" style="height: 32px; font-size: 13px;"></div>
                                                                    <script>
                                                                        $('#datepicker4-{{$paymentsP->id}}').datepicker({
                                                                            uiLibrary: 'bootstrap4',
                                                                        });
                                                                    </script>
                                                                    <div class="col-4 text-right">Order/Transaction</div>
                                                                    <div class="col-8"><input class="form-control form-control-sm formModalToDo" value="{{$paymentsP->transaction}}" type="text" name="orderPayment" autocomplete="off" style="margin-bottom: 5px;"></div>
                                                                    <div class="col-4 text-right">Description</div>
                                                                    <div class="col-8"><textarea class="form-control form-control-sm formModalToDo" name="orderDescription" rows="3">{{$paymentsP->details}}</textarea></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                                                            <a href="{{route('uploadImagePayment',$paymentsP->id)}}" type="button" class="btn badgeERP btn-sm"><h6 style="margin-bottom: 0px;">Add Image</h6></a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Update Comments -->

                                        <!-- START Modal Delete Comments -->
                                        <div class="modal fade" id="modalDeleteComments{{$paymentsP->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this payment?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="margin-bottom: 0px;"><b>Date:</b> {{date('m/d/Y',strtotime($paymentsP->transactionDate))}}</p>
                                                    <p style="margin-bottom: 0px;"><b>Method:</b> {{$paymentsP->paymentMethod->namePaymentMethod}}</p>
                                                    <p style="margin-bottom: 0px;"><b>Amount:</b> ${{number_format($paymentsP->amountPayment,2)}}</p>
                                                    @if ($paymentsP->transaction != "")
                                                        <p style="margin-bottom: 0px;"><b>Transaction:</b> {{$paymentsP->transaction}}</p>    
                                                    @endif
                                                    @if ($paymentsP->details != "")
                                                        <p style="margin-bottom: 0px;"><b>Description:</b> {{$paymentsP->details}}</p>    
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                <a role="button" href="{{route('paymentDestroy',$paymentsP->id)}}" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Delete Comments-->
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        {{-- <div class="row rowFinance">
                            <div class="col-6 text-center">
                                <h6 class="dataFinance">{{$daysWorked}}</h6>
                                <h6>Days Worked</h6>
                            </div>
                            @if (Auth::user()->rol != 'secretary')
                            <div class="col-6 text-center">
                                <h6 class="dataFinance">${{number_format($average,2)}}</h6>
                                <h6>Daily Avg Profit</h6>
                            </div>
                            @endif
                        </div> --}}
                    @endif
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <h5>EXPENSES LIST</h5>
                        @if ($truckSummary != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px; margin-bottom: 0px; border-bottom-width: 0px; padding-bottom: 0px;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"  aria-controls="collapseOne"><b>Truck Summary:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$truckSummary}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div>
                        @endif
                        <div id="accordion">
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @if ($sumaDirtExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Dirt Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaDirtExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div>
                                @endif

                                @if ($sumaAsphaltExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Asphalt Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaAsphaltExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div>
                                @endif

                                @if ($sumaDirtRockExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Dirt + Rock Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaDirtRockExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div>
                                @endif

                                @if ($sumaConcreteExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Concrete Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaConcreteExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif
                        
                                @if ($sumaMixedExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Mixed Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaMixedExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif

                                @if ($sumaTrushExport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Trash Export:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaTrushExport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif
                        
                                @if ($sumaDirtImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Dirt Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaDirtImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif

                                @if ($sumaAsphaltImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Asphalt Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaAsphaltImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif

                                @if ($sumaSandImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Sand Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaSandImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif
                    
                                @if ($sumaBaseImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Base Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaBaseImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif
                    
                                @if ($sumaGravelImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Gravel Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaGravelImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif

                                @if ($sumaSoilImport != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Soil Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaSoilImport}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                @endif

                                @if ($sumaImportAggregates != 0)
                                    <div class="row">
                                        <div class="col-9 col-md-8">
                                            <h6 style="padding-left: 15px;"><b>Aggregates Import:</b></h6>
                                        </div>
                                        <div class="col-3 col-md-4 expenseList">
                                            ${{$sumaImportAggregates}}
                                        </div>
                                        <div class="col-3 col-md-4 expenseListX">
                                            $XXXX.XX
                                        </div>
                                    </div> 
                                    <h6 style="padding-left: 15px;"><b></b> </h6>
                                @endif
                            </div>
                            </div>
                        </div>

                        @if ($sumaTrash40CYExport != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Trash 40CY Export:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaTrash40CYExport}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                            
                        @if ($laborSummary != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px; margin-bottom: 0px; border-bottom-width: 0px; padding-bottom: 0px;" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"  aria-controls="collapseTwo"><b>Total Labor:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$laborSummary}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div>
                        @endif
                        <div id="accordion2">
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                @foreach($arrayLaborsPurchasePayroll as $arrayLabPur)
                                    @if($arrayLabPur['total'] != 0)
                                        <div class="row">
                                            <div class="col-9 col-md-8">
                                                <h6 style="padding-left: 15px;"><b>{{$arrayLabPur['name']}}:</b></h6>
                                            </div>
                                            <div class="col-3 col-md-4 expenseList">
                                                ${{$arrayLabPur['total']}}
                                            </div>
                                            <div class="col-3 col-md-4 expenseListX">
                                                $XXXX.XX
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            </div>
                        </div>

                        @if ($sumaToolsMaterial != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Tools & Materials:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaToolsMaterial}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div>
                        @endif
                            
                        @if ($sumaSubcontractor != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Subcontractor:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaSubcontractor}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div>
                        @endif
                        
                        @if ($sumaMaterialExport != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Material Export:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaMaterialExport}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div>                           
                        @endif
                                           
                        @if ($sumaHomedepotLowes != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Homedepot/Lowes:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaHomedepotLowes}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaMaterials != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Materials:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaMaterials}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaRepairsTow != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Repairs / Tow:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaRepairsTow}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaEquipmentRental != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Equipment Rental:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaEquipmentRental}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaBrokenConcreteTruck != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Broken Concrete Truck Hauling:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaBrokenConcreteTruck}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaDirtTruckHauling != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Dirt Truck Hauling:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaDirtTruckHauling}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaMixedTruckHauling != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Mixed Truck Hauling:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaMixedTruckHauling}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                    
                        @if ($sumaOfficeAdmin != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Office / Admin:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaOfficeAdmin}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaToolPurchase != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Tool Purchase:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaToolPurchase}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaToolsRental != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Tools Rental:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaToolsRental}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        @if ($sumaMiscellaneous != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Miscellaneous:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaMiscellaneous}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif

                        @if ($sumaConcreteMix != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Concrete Mix:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaConcreteMix}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif

                        @if ($sumaPump != 0)
                            <div class="row">
                                <div class="col-9 col-md-8">
                                    <h6 style="padding-left: 15px;"><b>Pump:</b></h6>
                                </div>
                                <div class="col-3 col-md-4 expenseList">
                                    ${{$sumaPump}}
                                </div>
                                <div class="col-3 col-md-4 expenseListX">
                                    $XXXX.XX
                                </div>
                            </div> 
                        @endif
                        
                        

                        <div class="card">
                            <div class="card-header" style="padding-bottom: 11px;" >
                            <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist" style="padding-left:10px;">
                                <li class="nav-item" hidden>
                                <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Finance</a>
                                </li>
                                <li class="nav-item" hidden>
                                <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Category</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Daily</a>
                                </li>
                            </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content mt-3">
                                    <div class="tab-pane" id="description" role="tabpanel" hidden>
                                        <h5 class="card-title">Finance</h5>
                                        @if ($suma != 0)
                                            <div class="container">
                                                <canvas id="myDonutChart"></canvas>
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="tab-pane" id="history" role="tabpanel" hidden>  
                                        <h5 class="card-title">Category Expenses</h5>
                                        @if ($suma != 0)
                                            <div class="container">
                                                <canvas id="myPieChart"></canvas>
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="tab-pane active" id="deals" role="tabpanel">
                                        <h5 class="card-title">Daily Expenses</h5>
                                        @if ($cantDailyPurchase != 0)
                                            {{-- <div class="container">
                                                <canvas id="myBarChart"></canvas>
                                            </div> --}}
                                            <div class="chartWrapper">
                                                <div class="chartContainer">
                                                    <canvas id="myBarChart"></canvas>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <h5>EXPENSES DETAILS <span><a href="{{route('purchase.morePurchase',$project)}}"><div class="badge badgeERP" >ADD EXPENSE</div></a></span></h5>
                        <table id="example" class="display nowrap dataFinance" style="width:100%; padding-top:10px">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Phase</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchasesAll as $p)
                                <tr>
                                    <td>{{$p->date_purchase}}</td>
                                    <td style="white-space: pre-wrap;">{{ $p->description_purchase}}</td>
                                    <td>${{number_format($p->amount,2)}}</td>
                                    <td>{{ $p->purchaseCategories->name_category}}</td>
                                    <td style="white-space: pre-wrap;">{{ $p->phases->name_phase}}</td>
                                    <td style="text-align:center;">
                                        <div class="dropdown " id="dropdown{{$p->id}}">
                                            <button class="btn btn-secondary dropdown-toggle badgeERP" type="button" id="dropdown{{$p->id}}" data-toggle="dropdown" aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" id="dropper{{$p->id}}" style="width: 5px;">
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('purchase.show',[$p,1])}}" class="badge badge-light"><i class="fas fa-eye fa-1xx"></i></a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.edit',[$p,1])}}" class="badge badge-light"><i class="fas fa-edit 1x"></i></i></a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.confirm',[$p,1])}}" class="badge badge-light"><i class="fas fa-trash-alt 1x"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    $('#dropdown{{$p->id}}').click(function(){
                                        $('#dropper{{$p->id}}').toggleClass('show');
                                    });
                                </script>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Phase</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <table id="exampleX" class="display nowrap dataFinanceX" style="width:100%; padding-top:10px">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Phase</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $p)
                                <tr>
                                    <td>{{$p->date_purchase}}</td>
                                    <td style="white-space: pre-wrap;">{{ $p->description_purchase}}</td>
                                    <td>$XXXX.XX</td>
                                    <td>{{ $p->purchaseCategories->name_category}}</td>
                                    <td style="white-space: pre-wrap;">{{ $p->phases->name_phase}}</td>
                                    <td style="text-align:center;">
                                        <div class="dropdown " id="dropdown{{$p->id}}">
                                            <button class="btn btn-secondary dropdown-toggle badgeERP" type="button" id="dropdown{{$p->id}}" data-toggle="dropdown" aria-expanded="false">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" id="dropper{{$p->id}}" style="width: 5px;">
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('purchase.show',[$p,1])}}" class="badge badge-light"><i class="fas fa-eye fa-1xx"></i></a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.edit',[$p,1])}}" class="badge badge-light"><i class="fas fa-edit 1x"></i></i></a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.confirm',[$p,1])}}" class="badge badge-light"><i class="fas fa-trash-alt 1x"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    $('#dropdown{{$p->id}}').click(function(){
                                        $('#dropper{{$p->id}}').toggleClass('show');
                                    });
                                </script>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Phase</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        
                        <div class="row">

                        </div>
                    @endif
                </div>
            @endif
            
            <div class="col-12 col-sm-12 col-md-4">
                {{-- TRUCK MANAGMENT --}}
                <div class="card" style="border-color: white;">
                    @if (!empty($truck))
                        @if ($truck->purchaseImportDirt != null || $truck->purchaseImportAsphalt != null || $truck->purchaseImportAggregates != null || $truck->purchaseImportBase != null || $truck->purchaseImportGravell != null || $truck->purchaseImportSand != null || $truck->purchaseImportSoil != null ||
                            $truck->purchaseExportDirtRock != null || $truck->purchaseExportAsphalt != null || $truck->purchaseExportDirt != null || $truck->purchaseExportConcrete != null || $truck->purchaseExportMixed != null || $truck->purchaseExportTrash != null || $truck->purchaseExportTrash40CY != null ||
                            $truck->importDirt != 0 || $truck->importAsphalt != 0 || $truck->importAggregates != 0 || $truck->importBase != 0 || $truck->importGravell != 0 || $truck->importSand != 0 || $truck->importSoil != 0 ||
                            $truck->exportDirt != 0 || $truck->exportAsphalt != 0 || $truck->exportDirtRock != 0 || $truck->exportConcrete != 0 || $truck->exportMixed != 0 || $truck->exportTrash != 0  || $truck->exportTrash40CY != 0)
                            <div class="form-group">
                                <h5>TRUCK MANAGEMENT</h5>
                                <h6>Yards: {{$truck->yards}} fts</h6>
                                <h6>Description: <p>{{$truck->description}}</p></h6>
                                <!-- START Desktop -->
                                <table class="demo desktop tableLeft" style="width: 50% !important">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Truck Import</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 16.67%">Truck</th>
                                        <th>Estimate</th>
                                        <th>Real</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if ($truck->purchaseImportDirt != null || $truck->importDirt != 0)
                                        <td>Dirt</td>
                                        <td>{{$truck->importDirt}}</td>
                                        <td>{{$truck->purchaseImportDirt}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportAsphalt != null || $truck->importAsphalt != 0)
                                        <td>Asphalt</td>
                                        <td>{{$truck->importAsphalt}}</td>
                                        <td>{{$truck->purchaseImportAsphalt}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportAggregates != null || $truck->importAggregates != 0)
                                        <td>Aggregates</td>
                                        <td>{{$truck->importAggregates}}</td>
                                        <td>{{$truck->purchaseImportAggregates}}</td>  
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportBase != null || $truck->importBase != 0)
                                        <td>Base</td>
                                        <td>{{$truck->importBase}}</td>
                                        <td>{{$truck->purchaseImportBase}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportGravell != null || $truck->importGravell != 0)
                                        <td>Gravell</td>
                                        <td>{{$truck->importGravell}}</td>
                                        <td>{{$truck->purchaseImportGravell}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportSand != null || $truck->importSand != 0)
                                        <td>Sand</td>
                                        <td>{{$truck->importSand}}</td>
                                        <td>{{$truck->purchaseImportSand}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseImportSoil != null || $truck->importSoil != 0)
                                        <td>Soil</td>
                                        <td>{{$truck->importSoil}}</td>
                                        <td>{{$truck->purchaseImportSoil}}</td>
                                        @endif
                                    </tr>
                                    <tbody>
                                </table>
                                <table class="demo desktop tableLeft" style="width: 50% !important;">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Truck Export</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 16.67%">Truck</th>
                                        <th>Estimate</th>
                                        <th>Real</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if ($truck->purchaseExportDirt != null || $truck->exportDirt != 0)
                                        <td>Dirt</td>
                                        <td>{{$truck->exportDirt}}</td>
                                        <td>{{$truck->purchaseExportDirt}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseExportAsphalt != null || $truck->exportAsphalt != 0)
                                        <td>Asphalt</td>
                                        <td>{{$truck->exportAsphalt}}</td>
                                        <td>{{$truck->purchaseExportAsphalt}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseExportDirtRock != null || $truck->exportDirtRock != 0)
                                        <td>Dirt + Rocks</td>
                                        <td>{{$truck->exportDirtRock}}</td>
                                        <td>{{$truck->purchaseExportDirtRock}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseExportConcrete != null || $truck->exportConcrete != 0)
                                        <td>Concrete</td>
                                        <td>{{$truck->exportConcrete}}</td>
                                        <td>{{$truck->purchaseExportConcrete}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseExportMixed != null || $truck->exportMixed != 0)
                                        <td>Mixed</td>
                                        <td>{{$truck->exportMixed}}</td>
                                        <td>{{$truck->purchaseExportMixed}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($truck->purchaseExportTrash != null || $truck->exportTrash != 0)
                                        <td>Trash</td>
                                        <td>{{$truck->exportTrash}}</td>
                                        <td>{{$truck->purchaseExportTrash}}</td>
                                        @endif
                                    </tr>
                                    <tbody>
                                </table>
                                @if ($truck->purchaseExportTrash40CY != null || $truck->exportTrash40CY != 0)
                                <table class="demo desktop tableLeft" style="width: 100% !important;">
                                    <thead>
                                    <tr>
                                        <th colspan="12">Debris Trash Removal</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 16.67%">Truck</th>
                                        <th>Estimate</th>
                                        <th>Real</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if ($truck->purchaseExportTrash40CY != null || $truck->exportTrash40CY != 0)
                                        <td>Trash40CY</td>
                                        <td>{{$truck->exportTrash40CY}}</td>
                                        <td>{{$truck->purchaseExportTrash40CY}}</td>
                                        @endif
                                    </tr>
                                    <tbody>
                                </table>
                                @endif
    
                                <!-- END Desktop -->
    
                                <!-- START Mobile -->
                                @if ($truck->purchaseImportDirt != null || $truck->purchaseImportAsphalt != null || $truck->purchaseImportAggregates != null || $truck->purchaseImportBase != null || $truck->purchaseImportGravell != null || $truck->purchaseImportSand != null || $truck->purchaseImportSoil != null ||
                                $truck->importDirt != 0 || $truck->importAsphalt != 0 || $truck->importAggregates != 0 || $truck->importBase != 0 || $truck->importGravell != 0 || $truck->importSand != 0 || $truck->importSoil != 0)
                                    <table class="demo mobile" style="width: 100% !important">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Truck Import</th>
                                            
                                        </tr>
                                        <tr>
                                            <th style="width: 16.67%">Truck</th>
                                            <th>Estimate</th>
                                            <th>Real</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @if ($truck->purchaseImportDirt != null || $truck->importDirt != 0)
                                            <td>Dirt</td>
                                            <td>{{$truck->importDirt}}</td>
                                            <td>{{$truck->purchaseImportDirt}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportAsphalt != null || $truck->importAsphalt != 0)
                                            <td>Asphalt</td>
                                            <td>{{$truck->importAsphalt}}</td>
                                            <td>{{$truck->purchaseImportAsphalt}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportAggregates != null || $truck->importAggregates != 0)
                                            <td>Aggregates</td>
                                            <td>{{$truck->importAggregates}}</td>
                                            <td>{{$truck->purchaseImportAggregates}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportBase != null || $truck->importBase != 0)
                                            <td>Base</td>
                                            <td>{{$truck->importBase}}</td>
                                            <td>{{$truck->purchaseImportBase}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportGravell != null || $truck->importGravell != 0)
                                            <td>Gravell</td>
                                            <td>{{$truck->importGravell}}</td>
                                            <td>{{$truck->purchaseImportGravell}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportSand != null || $truck->importSand != 0)
                                            <td>Sand</td>
                                            <td>{{$truck->importSand}}</td>
                                            <td>{{$truck->purchaseImportSand}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseImportSoil != null || $truck->importSoil != 0)
                                            <td>Soil</td>
                                            <td>{{$truck->importSoil}}</td>
                                            <td>{{$truck->purchaseImportSoil}}</td>
                                            @endif
                                        </tr>
                                        <tbody>
                                    </table>
                                @endif
                                <br>
                                @if ($truck->purchaseExportDirtRock != null || $truck->purchaseExportAsphalt != null || $truck->purchaseExportDirt != null || $truck->purchaseExportConcrete != null || $truck->purchaseExportMixed != null || $truck->purchaseExportTrash != null ||
                                $truck->exportDirt != 0 || $truck->exportAsphalt != 0 || $truck->exportDirtRock != 0 || $truck->exportConcrete != 0 || $truck->exportMixed != 0 || $truck->exportTrash != 0)
                                    <table class="demo mobile" style="width: 100% !important">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Truck Export</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 16.67%">Truck</th>
                                            <th>Estimate</th>
                                            <th>Real</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @if ($truck->purchaseExportDirt != null || $truck->exportDirt != 0)
                                            <td>Dirt</td>
                                            <td>{{$truck->exportDirt}}</td>
                                            <td>{{$truck->purchaseExportDirt}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseExportAsphalt != null || $truck->exportAsphalt != 0)
                                            <td>Asphalt</td>
                                            <td>{{$truck->exportAsphalt}}</td>
                                            <td>{{$truck->purchaseExportAsphalt}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseExportDirtRock != null || $truck->exportDirtRock != 0)
                                            <td>Dirt + Rocks</td>
                                            <td>{{$truck->exportDirtRock}}</td>
                                            <td>{{$truck->purchaseExportDirtRock}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseExportConcrete != null || $truck->exportConcrete != 0)
                                            <td>Concrete</td>
                                            <td>{{$truck->exportConcrete}}</td>
                                            <td>{{$truck->purchaseExportConcrete}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseExportMixed != null || $truck->exportMixed != 0)
                                            <td>Mixed</td>
                                            <td>{{$truck->exportMixed}}</td>
                                            <td>{{$truck->purchaseExportMixed}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($truck->purchaseExportTrash != null || $truck->exportTrash != 0)
                                            <td>Trash</td>
                                            <td>{{$truck->exportTrash}}</td>
                                            <td>{{$truck->purchaseExportTrash}}</td>
                                            @endif
                                        </tr>
                                        <tbody>
                                    </table>
                                @endif
                                <br>
                                @if ($truck->purchaseExportTrash40CY != null || $truck->exportTrash40CY != 0)
                                    <table class="demo mobile" style="width: 100% !important;">
                                        <thead>
                                        <tr>
                                            <th colspan="12">Debris Trash Removal</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 16.67%">Truck</th>
                                            <th>Estimate</th>
                                            <th>Real</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @if ($truck->purchaseExportTrash40CY != null || $truck->exportTrash40CY != 0)
                                            <td>Trash40CY</td>
                                            <td>{{$truck->exportTrash40CY}}</td>
                                            <td>{{$truck->purchaseExportTrash40CY}}</td>
                                            @endif
                                        </tr>
                                        <tbody>
                                    </table>
                                @endif
                                <!-- END Mobile -->
                            </div>
                        @endif
                    @endif
                </div>

                @if (Auth::user()->rol != 'labor')
                    <h5>DAILY PROJECT </h5>
                    @if (Auth::user()->rol != 'labor')
                        <div class="text-center">
                            <a class="btn badge badgeERP" href="" data-toggle="collapse" data-target="#dailyProjectCollapse">ALL REPORTS</a>
                        </div>
                        <br>
                    @endif

                    <!-- Modal Timelines-->
                    <div class="modal fade" id="modalAllDailyReports" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">All Daily Report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($allDailyReports as $dailyReport)
                                        <div class="card cardStyle">
                                            <div class="card-header" id="heading{{$dailyReport->id}}">
                                            <h5 class="mb-0">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <button class="btn btn-link collapsed collapseTitle" style="padding-bottom: 0px; color:#000000; text-decoration:underline;" data-toggle="collapse" data-target="#collapse{{$dailyReport->id}}" aria-expanded="false" aria-controls="collapse{{$dailyReport->id}}">
                                                            <b>{{$dailyReport->dateDailyReport}}</b> 
                                                        </button>
                                                    </div>
                                                    <div class="col-3 text-right" style="padding-left: 0px;">
                                                        @if (Auth::user()->rol != 'labor')
                                                            {{-- <a style="margin: 7px 0px 0px 0px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalEditPhase{{$dailyReport->id}}"><i class="fas fa-edit"></i></i></a>
                                                            <a style="margin: 5px 5px 5px 0px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalDeletePhase{{$dailyReport->id}}"><i class="fas fa-trash-alt"></i></a> --}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </h5>
                                            </div>
                                        
                                            <div id="collapse{{$dailyReport->id}}" class="collapse" aria-labelledby="heading{{$dailyReport->id}}" data-parent="#accordion">
                                            <div class="card-body">
                                                @foreach ($reportTruck as $rtTruck)
                                                    @foreach ($allDailyTrucks as $dailyTrucks)
                                                        @if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id)
                                                        <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                            <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                                <h5 id="titleInfoCard" style="font-size: 1rem; text-align:center;">{{$dailyTrucks->categoryTypeTruck}} - {{$dailyTrucks->nameTypeTruck}}</h5>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;">Quantity</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;">Price</h6>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 style="margin-bottom: 0px;">Provideer</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;" id="qualityInfoCard">{{$rtTruck->quantityDailyTruck}}</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;" id="priceInfoCard">
                                                                            @if ($rtTruck->priceDailyTruck != null)
                                                                                ${{$rtTruck->priceDailyTruck}}
                                                                            @endif
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 style="margin-bottom: 0px;" id="providerInfoCard">{{$rtTruck->nameProviderTruck}}</h6>
                                                                    </div>
                                                                </div>
                                                                @if ($rtTruck->commentsDailyTruck != null)
                                                                    <div class="row" style="text-align: left;">
                                                                        <div class="col-12">
                                                                            <h6 style="margin-bottom: 0px;">Comments: </h6>
                                                                            <h6 style="margin-bottom: 0px;" id="providerInfoCard">{{$rtTruck->commentsDailyTruck}}</h6>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        @endif
                                                    @endforeach
                                                @endforeach

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Labor</h5>
                                                        <div class="row">
                                                            <ul>
                                                                @foreach ($reportLabor as $rtLabor)
                                                                    @foreach ($allDailyLabor as $dailyLabor)
                                                                        @if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                                                        <li>
                                                                            {{$dailyLabor->nameDailyLabor}}
                                                                        </li>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach ($laborsReport as $labor)
                                                                        @if ($rtLabor->dailyLabor_fk == $labor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                                                        <li>
                                                                            {{$labor->name_category}} -- ${{$rtLabor->amount}}
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Extra Labor</h5>
                                                        <div class="row">
                                                            @foreach ($reportExtralabor as $rExtralabor)
                                                                @if ($rExtralabor->dailyReport_fk == $dailyReport->id)
                                                                    <div class="col-6">
                                                                        <b>Name:</b> {{$rExtralabor->nameMoreReport}} 
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <b>Payment:</b> ${{$rExtralabor->amountMoreReport}}   
                                                                    </div>
                                                                    <hr>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Subcontractor</h5>
                                                        <div class="row">
                                                            @foreach ($reportSubcontractor as $rSContractor)
                                                                @if ($rSContractor->dailyReport_fk == $dailyReport->id)
                                                                    <div class="col-6">
                                                                        <b>Name:</b> {{$rSContractor->nameMoreReport}} 
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <b>Payment:</b> ${{$rSContractor->amountMoreReport}}   
                                                                    </div>
                                                                    @if ($rSContractor->descriptionMoreReport != null)
                                                                        <div class="col-12">
                                                                            <b>Description:</b> {{$rSContractor->descriptionMoreReport}}   
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div> 
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Comments</h5>
                                                        <div class="row">
                                                            <div class="col-12" style="text-align: left;">
                                                                {{$dailyReport->comments}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Images</h5>
                                                        <div class="row text-left">
                                                            <ul>
                                                                @foreach ($images as $image)
                                                                    @if ($image->dailyReport_fk == $dailyReport->id)
                                                                    <li><a href="{{ URL::asset('imageDailyReport/'.$image->nameImageDailyReport) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$image->nameImageDailyReport)}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn badgeERP btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="dailyProjectCollapse" style="margin-top: 8px;">
                        <ul class="timeline">
                            @foreach ($allDailyReports as $dailyReport)
                                <li>
                                    <div class="row">
                                        {{-- <div class="col-6">
                                            <h6><b>{{$dailyReport->id}}</b></h6>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            @if (Auth::user()->rol != 'labor')
                                                <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalUpdateComments{{$dailyReport->id}}"><i class="fas fa-edit"></i></i></a>
                                                <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalDeleteComments{{$dailyReport->id}}"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div> --}}
                                        <div class="col-12 card cardStyle" style="padding-left: 0px;" >
                                            <div class="" id="heading{{$dailyReport->id}}">
                                            <h5 class="mb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-link collapsed collapseTitle" style="padding-bottom: 0px; color:#000000; text-decoration:underline;" data-toggle="collapse" data-target="#collapse{{$dailyReport->id}}" aria-expanded="false" aria-controls="collapse{{$dailyReport->id}}" onclick="dailyReportImages({{$dailyReport->id}})">
                                                            <b>{{$dailyReport->dateDailyReport}}</b> 
                                                        </button>
                                                    </div>
                                                </div>
                                            </h5>
                                            </div>
                                        
                                            <div id="collapse{{$dailyReport->id}}" class="collapse" aria-labelledby="heading{{$dailyReport->id}}" data-parent="#accordion">
                                            <div class="card-body">
                                                @foreach ($reportTruck as $rtTruck)
                                                    @foreach ($allDailyTrucks as $dailyTrucks)
                                                        @if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id)
                                                        <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                            <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                                <h5 id="titleInfoCard" style="font-size: 1rem; text-align:center;">{{$dailyTrucks->categoryTypeTruck}} - {{$dailyTrucks->nameTypeTruck}}</h5>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;">Quantity</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;">Price</h6>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 style="margin-bottom: 0px;">Provideer</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;" id="qualityInfoCard">{{$rtTruck->quantityDailyTruck}}</h6>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h6 style="margin-bottom: 0px;" id="priceInfoCard">
                                                                            @if ($rtTruck->priceDailyTruck != null)
                                                                                ${{$rtTruck->priceDailyTruck}}
                                                                            @endif
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 style="margin-bottom: 0px;" id="providerInfoCard">{{$rtTruck->nameProviderTruck}}</h6>
                                                                    </div>
                                                                </div>
                                                                @if ($rtTruck->commentsDailyTruck != null)
                                                                    <div class="row" style="text-align: left;">
                                                                        <div class="col-12">
                                                                            <h6 style="margin-bottom: 0px;">Comments: </h6>
                                                                            <h6 style="margin-bottom: 0px;" id="providerInfoCard">{{$rtTruck->commentsDailyTruck}}</h6>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        @endif
                                                    @endforeach
                                                @endforeach

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Labor</h5>
                                                        <div class="row">
                                                            <ul>
                                                                @foreach ($reportLabor as $rtLabor)
                                                                    @foreach ($allDailyLabor as $dailyLabor)
                                                                        @if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                                                        <li>
                                                                            {{$dailyLabor->nameDailyLabor}}
                                                                        </li>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach ($laborsReport as $labor)
                                                                        @if ($rtLabor->dailyLabor_fk == $labor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                                                        <li>
                                                                            {{$labor->name_category}} -- ${{$rtLabor->amount}}
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Extra Labor</h5>
                                                        <div class="row">
                                                            @foreach ($reportExtralabor as $rExtralabor)
                                                                @if ($rExtralabor->dailyReport_fk == $dailyReport->id)
                                                                    <div class="col-6">
                                                                        <b>Name:</b> {{$rExtralabor->nameMoreReport}} 
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <b>Payment:</b> ${{$rExtralabor->amountMoreReport}}   
                                                                    </div>
                                                                    <hr>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Subcontractor</h5>
                                                        <div class="row">
                                                            @foreach ($reportSubcontractor as $rSContractor)
                                                                @if ($rSContractor->dailyReport_fk == $dailyReport->id)
                                                                    <div class="col-6">
                                                                        <b>Name:</b> {{$rSContractor->nameMoreReport}} 
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <b>Payment:</b> ${{$rSContractor->amountMoreReport}}   
                                                                    </div>
                                                                    @if ($rSContractor->descriptionMoreReport != null)
                                                                        <div class="col-12">
                                                                            <b>Description:</b> {{$rSContractor->descriptionMoreReport}}   
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div> 
                                                <hr>

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Comments</h5>
                                                        <div class="row">
                                                            <div class="col-12" style="text-align: left;">
                                                                {{$dailyReport->comments}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                

                                                <div class="card" id="cardList" style="margin-bottom: 5px; border-color:#ffffff;">
                                                    <div class="card-body" style="padding: 5px;  background-color: #ffffff;">
                                                        <h5 id="titleInfoCard" style="font-size: 1rem; margin-bottom:0px;">Images</h5>
                                                        <div id="dailyImageReport-{{$dailyReport->id}}">
                        
                                                        </div>
                                                        {{-- <div class="row text-left">
                                                            <ul>
                                                                @foreach ($images as $image)
                                                                    @if ($image->dailyReport_fk == $dailyReport->id)
                                                                    <li><a href="{{ URL::asset('imageDailyReport/'.$image->nameImageDailyReport) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$image->nameImageDailyReport)}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($permitInfo['id'] != 0)
                    <h5>PERMITS INFORMATION</h5>
                    @switch($permitInfo['idPermitStage'])
                        @case(1)
                        <div> 
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: #000080; color: #fff; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break

                        @case(2)
                        <div>
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: rgb(0, 123, 255); color: #fff; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break

                        @case(3)
                        <div>
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: #ffc107; color: #000000; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break

                        @case(4)
                        <div>
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: #e74a3b; color: #fff; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break

                        @case(5)
                        <div>
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: #28a745; color: #fff; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break

                        @case(6)
                        <div>
                            <h6 hidden class="badge badge-pill badgeStatus" style="background-color: #17a2b8; color: #fff; padding: 6px;">{{$permitInfo['namePermit']}}</h6>
                            <h6><b>Status:</b> {{$permitInfo['namePermit']}}</h6>
                        </div>
                        @break
                    
                        @default
                            
                    @endswitch
                    
                    @if ($permitInfo['permitCity'] != null)
                    <h6><b>City:</b> {{$permitInfo['permitCity']}}</h6>
                    @else
                    <h6><b>City:</b> </h6>
                    @endif
                    @if ($permitInfo['permitDropoff'] != null)
                    <h6><b>Document Dropoff:</b> {{$permitInfo['permitDropoff']}}</h6>
                    @else
                    <h6><b>Document Dropoff:</b> </h6>
                    @endif
                    @if ($permitInfo['permitNumber1'] != null)
                    <h6><b>Permit Number:</b> {{$permitInfo['permitNumber1']}}</h6>
                    @endif
                    <h6><b>Permit Name:</b> {{$permitInfo['permitName']}}</h6>
                    @if ($permitInfo['permitNumber2'] != null)
                        <h6><b>Second Permit Number:</b> {{$permitInfo['permitNumber2']}}</h6>
                        <h6><b>Second Permit Name:</b> {{$permitInfo['permitName2']}}</h6>
                    @endif
                    <h6><b>Inspector/Contact:</b> {{$permitInfo['contact']}}</h6>
                    <h6><b>Email:</b> {{$permitInfo['email']}}</h6>
                    <h6><b>Phone:</b> {{$permitInfo['phone']}}</h6>
                    <div class="row">
                        <div class="col-xs-12 col-md-12" style="margin-bottom: 10px;">
                            <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseInspector" role="button" aria-expanded="false" aria-controls="collapseInspector">
                                Inspector Information
                            </a>
                            <div class="collapse" id="collapseInspector">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Name:</b> {{$permitInfo['inspectorName']}}</h6>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Company: </b>{{$permitInfo['inspectorCompany']}}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Phone: </b><a href="tel:{{$permitInfo['inspectorTel']}}">{{$permitInfo['inspectorTel']}}</a></h6>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Email: </b><a href="mailto:{{$permitInfo['inspectorEmail']}}">{{$permitInfo['inspectorEmail']}}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseSubcontractor" role="button" aria-expanded="false" aria-controls="collapseSubcontractor">
                                Subcontractor Information
                            </a>
                            <div class="collapse" id="collapseSubcontractor">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Name: </b>{{$permitInfo['subcontractorName']}}</h6>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Company: </b>{{$permitInfo['subcontractorCompany']}}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Phone: </b><a href="tel:{{$permitInfo['subcontractorTel']}}">{{$permitInfo['subcontractorTel']}}</a></h6>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <h6><b>Email: </b><a href="mailto:{{$permitInfo['subcontractorEmail']}}">{{$permitInfo['subcontractorEmail']}}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 15px;">
                        <h6><b>Last Update </b> 
                            @if (Auth::user()->rol != 'labor')
                                <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#exampleModalCenter" aria-expanded="false" aria-controls="coments">
                                    New
                                </a>
                            @endif
                                <a href="" class="badge badgeERP permitLog" role="button" data-toggle="modal" data-target="#modalAllUpdateds" aria-expanded="false" aria-controls="3">
                                    All
                                </a>
                            
                        </h6>
                    </div>
                    
                    {{-- <a role="button" href="" class="badge badgeERP permitLog mobile" data-toggle="modal" data-target="#exampleModalCenter">Add Comment</a></h4> --}}
                    {{-- <a href="" class="badge badgeERP permitLog" role="button" data-toggle="collapse" data-target="#coments" aria-expanded="false" aria-controls="coments">
                        Permit Log Collapse
                    </a> --}}
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (!$coments->isEmpty())
                    <ul class="timeline">
                            <li>
                                <div class="row">
                                    <div class="col-6">
                                        <h6><b>{{$coments[0]->users->name}}</b></h6>
                                    </div>
                                    <div class="col-6" style="text-align: right;">
                                        @if (Auth::user()->rol != 'labor')
                                            <a style="padding: 5px;"  href="{{route('editTimeLine',$coments[0]->id)}}" class="badge badge-light"><i class="fas fa-edit"></i></i></a>
                                            <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalCenter{{$coments[0]->id}}"><i class="fas fa-trash-alt"></i></a>    
                                        @endif
                                    </div>
                                </div>
                                
                                <p style="margin-bottom: 5px;">{{$coments[0]->description}}</p>
                                @foreach ($arrayTimes as $aTimes)
                                    @if ($aTimes['idComment'] == $coments[0]->id)
                                        <span style="font-style: italic">{{$aTimes['date']}} {{$aTimes['time']}}</span>
                                    @endif
                                @endforeach
                            </li>
                            <!-- START Modal Update Comments -->
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter{{$coments[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment? </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            {{$coments[0]->description}}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a role="button" href="{{route('destroyTimeLine',$coments[0]->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            
                            <!-- END Modal Update Comments-->

                            <!-- START Modal Delete Comments -->
                            <!-- END Modal Update Comments -->
                    </ul>
                    @endif
                    <!-- Modal New Comment-->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">New Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route ('updateComments',$permitInfo['id']) }}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                                    @csrf @method('PATCH')
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <textarea class="form-control form-control-sm" id="comments" rows="5" name="comments" maxlength="2000"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Add New Comment</h6></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal Timelines-->
                    <div class="modal fade" id="modalAllUpdateds" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">All Updates</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="timeline">
                                        @foreach ($coments as $c)
                                            <li>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6><b>{{$c->users->name}}</b></h6>
                                                    </div>
                                                    <div class="col-6" style="text-align: right;">
                                                        @if (Auth::user()->rol != 'labor')
                                                            <a style="padding: 5px;"  href="{{route('editTimeLine',$c->id)}}" class="badge badge-light"><i class="fas fa-edit"></i></i></a>
                                                            <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalCenter{{$c->id}}"><i class="fas fa-trash-alt"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <p style="margin-bottom: 5px;">{{$c->description}}</p>
                                                @foreach ($arrayTimes as $aTimes)
                                                    @if ($aTimes['idComment'] == $c->id)
                                                        <span style="font-style: italic">{{$aTimes['date']}} {{$aTimes['time']}}</span>
                                                    @endif
                                                @endforeach
                                            </li>
                                            <!-- START Modal Update Comments -->
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalCenter{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment? </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{$c->description}}
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a role="button" href="{{route('destroyTimeLine',$c->id)}}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- END Modal Update Comments-->
            
                                            <!-- START Modal Delete Comments -->
                                            <!-- END Modal Update Comments -->
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn badgeERP btn-sm" data-dismiss="modal">Close</button>
                                @if (Auth::user()->rol != 'labor')
                                <button type="button" href="" class="btn badgeERP btn-sm" role="button" data-toggle="modal" data-dismiss="modal" 
                                        data-target="#exampleModalCenter" aria-expanded="false" aria-controls="coments">
                                    New
                                </button>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="collapse" id="coments" style="margin-top: 8px;">
                        <h6 class="text-center"><b>Last Permit Update {{$stringDate}}</b></h6>
                        <h6 class="text-center" style="margin-bottom: 0px;"><b>Latest Comments</b></h6>
                        <ul class="timeline">
                            @foreach ($coments as $c)
                                <li>
                                    <div class="row">
                                        <div class="col-6">
                                            <h6><b>{{$c->users->name}}</b></h6>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <a style="padding: 5px;"  href="{{route('editTimeLine',$c->id)}}" class="badge badge-light"><i class="fas fa-edit"></i></i></a>
                                            <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalCenter{{$c->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    
                                    <p style="margin-bottom: 5px;">{{$c->description}}</p>
                                    @foreach ($arrayTimes as $aTimes)
                                        @if ($aTimes['idComment'] == $c->id)
                                            <span style="font-style: italic">{{$aTimes['date']}} {{$aTimes['time']}}</span>
                                        @endif
                                    @endforeach
                                </li>
                                <!-- START Modal Update Comments -->
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment? </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {{$c->description}}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a role="button" href="{{route('destroyTimeLine',$c->id)}}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <!-- END Modal Update Comments-->

                                <!-- START Modal Delete Comments -->
                                <!-- END Modal Update Comments -->
                            @endforeach
                        </ul>
                    </div> --}}
                    <br>
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    
                        <h5 class="text-center" hidden>UPLOAD IMAGES <span><a href="{{route('project.editDropzone',$project)}}"><div class="badge badgeERP" >UPLOAD IMAGES</div></a></span></h5>
                    @else
                        <h5 class="text-center" hidden>UPLOAD IMAGES <span><a href="{{route('project.editDropzone2',$project)}}"><div class="badge badgeERP" >UPLOAD IMAGES</div></a></span></h5>
                    @endif
                    
                    
                    <h5>DOCUMENTS</h5>
                    <div class="text-center">
                        @if (Auth::user()->rol != 'labor')
                            <h6><a role="button" href="" class="badge badgeERP" data-toggle="modal" data-target="#modalSelectDocument">ADD DOCUMENTS</a></h6>    
                        @endif
                        {{-- <a class="btn" data-toggle="modalSelectDocument" href="" data-target="#modal" role="button"><div class="badge badgeERP" >UPLOAD FILES</div></a> --}}
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalSelectDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Select Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="list-group">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],2])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Field Documents</a>
                                            {{-- <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],7])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> City Inspections</a> --}}
                                            <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],5])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Permits/Inspections</a>
                                            <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],1])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Estimation/Jobber</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],4])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Receipts </a>
                                            <a href="{{route('docDropzoneQuoteInformation',[$permitInfo['id'],10])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Others</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6>Field</h6>
                    <hr>
                    @if (Auth::user()->rol == 'labor')
                        @if ($countFieldDocuments != 0)
                            <span class="badge badgeERPCount">{{$countFieldDocuments}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#projectSitePlan" role="button" aria-expanded="false" aria-controls="projectSitePlan">
                            <i class="far fa-folder-open" id="projectSitePlanOpen"></i>
                            <i class="far fa-folder" id="projectSitePlanClose"></i> 
                            Field Documents</a> 
                            <div class="row">
                                <div class="collapse" id="projectSitePlan">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsProjectsSitePlan) != 0)
                                            @foreach ($documentsProjectsSitePlan as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('projectSitePlansDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsProjectsSiteList) != 0)
                                            @foreach ($documentsProjectsSiteList as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('projectSiteListDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if ($countFieldDocuments != 0)
                            <span class="badge badgeERPCount">{{$countFieldDocuments}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#projectSitePlan" role="button" aria-expanded="false" aria-controls="projectSitePlan">
                            <i class="far fa-folder-open" id="projectSitePlanOpen"></i>
                            <i class="far fa-folder" id="projectSitePlanClose"></i> 
                            Field Documents</a> 
                            <div class="row">
                                <div class="collapse" id="projectSitePlan">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsProjectsSitePlan) != 0)
                                            @foreach ($documentsProjectsSitePlan as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('projectSitePlansDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsProjectsSiteList) != 0)
                                            @foreach ($documentsProjectsSiteList as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('projectSiteListDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- @if (count($documentsCityInspection) != 0)
                            <span class="badge badgeERPCount">{{count($documentsCityInspection)}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#cityInspection" role="button" aria-expanded="false" aria-controls="cityInspection">
                            <i class="far fa-folder-open" id="cityInspectionOpen"></i>
                            <i class="far fa-folder" id="cityInspectionClose"></i> 
                            City Inspections</a> 
                            <div class="row">
                                <div class="collapse" id="cityInspection">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsCityInspection) != 0)
                                            @foreach ($documentsCityInspection as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('cityInspectionsDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                    @endif

                    @if (Auth::user()->rol != 'labor')
                        <h6 style="margin-top: 10px;">Office</h6>
                        <hr>
                        @if ($countEstimationJobber != 0)
                            <span class="badge badgeERPCount">{{$countEstimationJobber}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#quoteInformation" role="button" aria-expanded="false" aria-controls="quoteInformation">
                            <i class="far fa-folder-open" id="quoteInformationOpen"></i>
                            <i class="far fa-folder" id="quoteInformationClose"></i> 
                            Estimation/Jobber</a> 
                            <div class="row">
                                <div class="collapse" id="quoteInformation">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsQuoteInformation) != 0)
                                            @foreach ($documentsQuoteInformation as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('quoteInformationDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}} </a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsJobberQuote) != 0)
                                            @foreach ($documentsJobberQuote as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('jobberQuotesDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if ($countAnotherPermits != 0)
                            <span class="badge badgeERPCount">{{$countAnotherPermits}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#permitsAplication" role="button" aria-expanded="false" aria-controls="permitsAplication">
                            <i class="far fa-folder-open" id="permitsAplicationOpen"></i>
                            <i class="far fa-folder" id="permitsAplicationClose"></i> 
                            Permits/Inspections</a> 
                            <div class="row">
                                <div class="collapse" id="permitsAplication">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsPermitsApplications) != 0)
                                            @foreach ($documentsPermitsApplications as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('permitsApplicationsDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsBussinesLicense) != 0)
                                            @foreach ($documentsBussinesLicense as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('bussinesLicenseDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsCovenantAgreements) != 0)
                                            @foreach ($documentsCovenantAgreements as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('covenantAgreementDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsSitePlan) != 0)
                                            @foreach ($documentsSitePlan as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('sitePlansDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (count($documentsCityInspection) != 0)
                                            @foreach ($documentsCityInspection as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('cityInspectionsDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if (count($documentsPermitsReceipts) != 0)
                            <span class="badge badgeERPCount">{{count($documentsPermitsReceipts)}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#permitsReceipts" role="button" aria-expanded="false" aria-controls="permitsReceipts">
                            <i class="far fa-folder-open" id="permitsReceiptsOpen"></i>
                            <i class="far fa-folder" id="permitsReceiptsClose"></i> 
                            Receipts</a> 
                            <div class="row">
                                <div class="collapse" id="permitsReceipts">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsPermitsReceipts) != 0)
                                            @foreach ($documentsPermitsReceipts as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('permitReceiptsDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (count($documentsOthers) != 0)
                            <span class="badge badgeERPCount">{{count($documentsOthers)}}</span>
                            <a class="btn-light" data-toggle="collapse" href="#others" role="button" aria-expanded="false" aria-controls="others">
                            <i class="far fa-folder-open" id="othersOpen"></i>
                            <i class="far fa-folder" id="othersClose"></i> 
                            Others</a> 
                            <div class="row">
                                <div class="collapse" id="others">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentsOthers) != 0)
                                            @foreach ($documentsOthers as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('othersDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->referenceDocumentPermit}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <br>
                        @if (count($documents) != 0)
                            @foreach ($documents as $doc)
                                <p>
                                    <a href="{{ URL::asset('documentPermits/'.$doc->referenceDocumentPermit) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                    <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this document?
                                                    {{$doc->referenceDocumentPermit}}
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitInfo['id'],$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            @endforeach
                        @endif

                        @if ($infoMail[0]['id'] != 0)
                            <h5 class="text-center">MAIL CENTER</h5>
                            <div id="accordion">
                                @foreach ($infoMail as $iMail)
                                    @if ($iMail['id'] >= 1)
                                        <div class="card">
                                            <div class="card-header" id="heading{{$iMail['id']}}">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$iMail['id']}}" aria-controls="collapse{{$iMail['id']}}" style="white-space: normal;">
                                                <label for="" style="margin-bottom: 0px;">{{$iMail['nameDocument']}}</label>
                                                </button>
                                            </div>
                                        
                                            <div id="collapse{{$iMail['id']}}" class="collapse" aria-labelledby="heading{{$iMail['id']}}" data-parent="#accordion">
                                            <div class="card-body">
                                                <h6><b>Courier:</b> {{$iMail['courier']}}</h6>
                                                <h6><b>Recipient's Name:</b> {{$iMail['recipientName']}}</h6>
                                                <h6><b>Tracking:</b> {{$iMail['tracking']}}</h6>
                                                <h6><b>Permit Document:</b> {{$iMail['permitDocument']}}</h6>
                                                <h6><b>Date Send:</b> {{$iMail['dateSend']}}</h6>
                                                <h6><b>Date Received:</b> {{$iMail['dateReceived']}}</h6>
                                                <h6><b>Cerified Mail:</b> @if ($iMail['certifiedMail'] == 1)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </h6>
                                                <h6><b>Certification Number:</b> {{$iMail['certificationNumber']}}</h6>
                                                <h6 class="text-center"><b>Images</b></h6>
                                                @foreach ($infoMailDocuments as $iMailDocuments)
                                                    @if ($iMailDocuments['idD'] != -1)
                                                        @if ($iMail['id'] == $iMailDocuments['idMail'] )
                                                            <a href="{{ URL::asset('documentMails/'.$iMailDocuments['reference']) }}" target="_blank">{{$iMailDocuments['reference']}}</a>
                                                            <a class="btn btn-outline-danger" href="{{route('documentMailDelete',[$permitInfo['id'],$iMailDocuments['idD']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                            <br>
                                                        @endif
                                                    @endif
                                                @endforeach

                                                <div class="text-center">
                                                    <a style="padding: 5px;"  href="{{route('editDocumentMail',[$iMail['idDocument'],$permitInfo['id'],$iMail['id']])}}" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                                                    <a style="padding: 5px;" href="{{route('deleteDocumentMail',[$iMail['idDocument'],$permitInfo['id'],$iMail['id']])}}" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                                                    <a style="padding: 5px;" href="{{route('dropzoneDocumentMail',[$iMail['idDocument'],$permitInfo['id'],$iMail['id']])}}" class="badge badge-light"><i class="far fa-images fa-2x"></i></a>
                                                </div>

                                            </div>
                                            </div>
                                        </div>  
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <hr>
                    @endif
                    
                @endif
                
                @if (Auth::user()->rol != 'labor')

                    <h5>PROJECT COMMENTS </h5>
                    @if (Auth::user()->rol != 'labor')
                        <div class="text-center">
                            <a class="btn badge badgeERP" href="{{route('uploadFileDocument',$project)}}" role="button">ADD FILES</a>
                            <button type="button" class="btn badge badgeERP" data-toggle="modal" data-target="#modalNewComment">
                                ADD NEW COMMENT
                            </button>
                        </div>
                    @endif
                
                    @if ($commentProjects->isNotEmpty())
                        <a href="{{route('dropzoneFileDocument',$project)}}" class="badge badgeERP permitLog" role="button" data-toggle="collapse" data-target="#projectComents" aria-expanded="false" aria-controls="coments">
                            Project Comment Collapse
                        </a>
                        <div class="collapse" id="projectComents" style="margin-top: 8px;">
                            <ul class="timeline">
                                @foreach ($commentProjects as $c)
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <h6><b>{{$c->users->name}}</b></h6>
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                @if (Auth::user()->rol != 'labor')
                                                    <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalUpdateComments{{$c->id}}"><i class="fas fa-edit"></i></i></a>
                                                    <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalDeleteComments{{$c->id}}"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <p style="margin-bottom: 5px;">{{$c->commentProject}}</p>
                                        @foreach ($arrayTimesComments as $aTimes)
                                            @if ($aTimes['idComment'] == $c->id)
                                                <span style="font-style: italic">{{$aTimes['date']}} {{$aTimes['time']}}</span>
                                            @endif
                                        @endforeach
                                    </li>
                                    
                                        <!-- START Modal Update Comments -->
                                        <div class="modal fade" id="modalUpdateComments{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment? </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div id="form-trhee" class="form-area">
                                                    <form action="{{route('updateCommentsProject',$c->id)}}">
                                                        @method('POST')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control form-control-sm" id="commentsProject" rows="5" name="commentsProject" maxlength="2000">{{$c->commentProject}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Update</h6></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Update Comments -->

                                        <!-- START Modal Delete Comments -->
                                        <div class="modal fade" id="modalDeleteComments{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this comment?vevevwe </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$c->commentProject}}
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a role="button" href="{{route('deleteCommentsProject',$c->id)}}" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END Modal Delete Comments-->
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <br>
                    @if ($documentProjects->isNotEmpty())
                        {{-- <h6 class="text-center"><b>Documents</b></h6>
                        @foreach ($documentProjects as $file)
                            <p>
                                <a href="{{ URL::asset('documentProjects/'.$file->nameFileDocument) }}" target="_blank">{{$file->nameFileDocument}} -- {{$file->created_at}} </a>
                                <a class="btn btn-outline-danger" href="{{route('deleteFileDocumentProject', $file->id)}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                            </p>
                        @endforeach --}}
                        <span class="badge badgeERPCount">{{count($documentProjects)}}</span>
                        <a class="btn-light" data-toggle="collapse" href="#othersDocument" role="button" aria-expanded="false" aria-controls="othersDocument">
                            <i class="far fa-folder-open" id="othersDocumentOpen"></i>
                            <i class="far fa-folder" id="othersDocumentClose"></i> 
                            Documents</a> 
                            <div class="row">
                                <div class="collapse" id="othersDocument">
                                    <div class="card card-body cardBodyDocuments">
                                        @if (count($documentProjects) != 0)
                                            @foreach ($documentProjects as $doc)
                                                <div class="lineDocuments">
                                                    *
                                                    <a href="{{ URL::asset('documentProjects/'.$doc->nameFileDocument) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->nameFileDocument)}}</a>
                                                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                                    {{-- <a class="btn btn-outline-primary" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-envelope"></i></a> --}}
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete document</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this document?
                                                                    {{$doc->nameFileDocument}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a class="btn btn-danger" href="{{route('deleteFileDocumentProject', $doc->id)}}" role="button">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                    @endif
                    
                @endif

                <br>
                <h5>GALLERY </h5>
                <div class="text-center">
                    <a class="btn badge badgeERP" href="{{route('project.dropzone',$project)}}" role="button">ADD TO GALLERY</a>
                    <button class="btn badge badgeERP" onclick="getAllImagesProjects({{$project->id}})" role="button">SHOW GALLERY</button>
                </div>

                <div id="allImagesProjects">
                    
                </div>
                {{-- INICIO - AGREGAR EL CÓDIGO DE LAS IMÁGENES --}}
                {{-- está en el archivo baldetest.blade.php --}}
                {{-- FIN - AGREGAR EL CÓDIGO DE LAS IMÁGENES --}}
                    
            </div>
    
            <!-- Modal Comment Project-->
            <div class="modal fade" id="modalNewComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Project Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div id="form-two" class="form-area">
                        <form action="{{route('commentsProject',$project)}}">
                            @method('POST')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <textarea class="form-control form-control-sm" id="commentsProject" rows="5" name="commentsProject" maxlength="2000"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Add New Comment</h6></button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <br>
        {{-- Lista de imágenes --}}
        <div class="row" hidden>
            <div class=""></div>
            <div class="card col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body" style="width: 250px; padding: 10px; " >
                        <h1>cd</h1>
                            @if (count($files) != 0)
                                @foreach ($files as $file)
                                    <p>
                                        <a href="{{ URL::asset('uploads/'.$file->reference_file_project) }}" target="_blank">{{$file->reference_file_project}} -- {{$file->created_at}} </a>
                                        <a class="btn btn-outline-danger" href="{{route('project.deleteDropMoreInfo2', [$project,$file->reference_file_project])}}" role="button" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                                    </p>
                                @endforeach
                            @endif 
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
    </div>
    <script>
        $('#bologna-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
        });
        $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
        });
        $('#datepicker4').datepicker({
            uiLibrary: 'bootstrap4',
        });
        $('#datepicker5').datepicker({
            uiLibrary: 'bootstrap4',
        });
        Chart.register(ChartDataLabels);    
        //DOUGHNUT CHART
        var spentP = @json($suma);
        var sold = @json($project->sold_project);
        var profit = @json($newMargin);
        var myChart = document.getElementById('myDonutChart');
        var labelsChart = ['Project Sold','Current Spending','Total Profit'];
        var chart = new Chart(myDonutChart,{
            type:'doughnut',
            data:{
                labels:['Project Sold','Current Spending','Total Profit'],
                datasets:[{
                    label: 'Spent',
                    data:[sold,spentP,profit],
                    borderWidth: 1, 
                    borderColor: 'black',
                    hoverBorderWidth: 3, 
                    hoverBorderColor: 'black',
                    backgroundColor : ['#04A2DB','#DB5754','#4FDB78']
                }],
                parsing: false,
                normalized: true,
            },
            options:{ 
                plugins:{
                    datalabels:{
                        labels:{
                            value:{
                                color:'black'
                            }
                        },
                        font:{
                            size:15,
                            weight: 'bold',
                            backgroundColor:'black'
                        },
                        formatter: function(labelsChart, myChart){
                            return '$'+labelsChart; 
                        }
                    }
                },
                
                maintainAspectRatio: false,
            }
        });

        // BAR CHART FOR DAILY EXPENSES 
        /* var labs = @json($SpentxDate[0]['date']); */
        var labs = @json($SpentxDate);
        var xAxisLabelMinWidth = 15;
        //console.log(labs); 
        const fechas = [];
        const spent = [];
        labs.forEach(element => fechas.push(element.date));
        labs.forEach(element => spent.push(element.total));

        var myChart = document.getElementById('myBarChart');
        var chart = new Chart(myChart,{
            type:'bar',
            data:{
                labels:fechas,
                datasets:[{
                    label: 'Expenses',
                    data:spent,
                    borderWidth: 1, 
                    borderColor: 'black',
                    hoverBorderWidth: 2, 
                    hoverBorderColor: 'red'
                }],
            },
            options:{ 
                plugins:{
                    datalabels:{
                        labels:{
                            value:{
                                color:'black',
                            }
                            
                        },
                        font:{
                            size:15,
                            weight: 'bold',
                            backgroundColor:'black'
                        },
                        formatter: function(fechas, myChart){
                            return '$'+fechas; 
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        function fitChart(){
            var chartCanvas = document.getElementById('myBarChart');
            var maxWidth = chartCanvas.parentElement.parentElement.clientWidth;
            var width = Math.max(mayChart.data.labels.length * xAxisLabelMinWidth, maxWidth);

            chartCanvas.parentElement.style.width = width +'px';
        }


        // PIE CHART FOR CATEGORIES 
        const categories = [];
        const spentCategory = []; 
        const pieColor = [];

        const varTruck = @json($truckSummary); //Truck Summary
        if(varTruck != 0){
            categories.push('Truck Summary');
            spentCategory.push(varTruck); 
            pieColor.push('#d43f3f');
        }
        const varlaborSummary = @json($laborSummary); //Total Labor
        if(varlaborSummary != 0){
            categories.push('Total Labor');
            spentCategory.push(varlaborSummary); 
            pieColor.push('#3f6cd4');
        }
        const varsumaToolsMaterial = @json($sumaToolsMaterial); //Tools & Materials
        if(varsumaToolsMaterial != 0){
            categories.push('Tools & Materials');
            spentCategory.push(varsumaToolsMaterial); 
            pieColor.push('#c2763c');
        }
        const varsumaSubcontractor = @json($sumaSubcontractor);//Subcontractor
        if(varsumaSubcontractor != 0){
            categories.push('Subcontractor');
            spentCategory.push(varsumaSubcontractor); 
            pieColor.push('#c23c62');
        }
        const varsumaHomedepotLowes = @json($sumaHomedepotLowes);//Homedepot/Lowes
        if(varsumaHomedepotLowes != 0){
            categories.push('Homedepot/Lowes');
            spentCategory.push(varsumaHomedepotLowes); 
            pieColor.push('#d43fc7');
        }
        const varsumaMaterials = @json($sumaMaterials);//Materials
        if(varsumaMaterials != 0){
            categories.push('Materials');
            spentCategory.push(varsumaMaterials); 
            pieColor.push('#ff0000');
        }
        const varsumaRepairsTow = @json($sumaRepairsTow);//Repairs/Tow
        if(varsumaRepairsTow != 0){
            categories.push('Repairs/Tow');
            spentCategory.push(varsumaRepairsTow); 
            pieColor.push('#ff8000');
        }
        const varsumaEquipmentRental = @json($sumaEquipmentRental);//Equipment Rental
        if(varsumaEquipmentRental != 0){
            categories.push('Equipment Rental');
            spentCategory.push(varsumaEquipmentRental); 
            pieColor.push('#3fd471');
        }
        const varsumaBrokenConcreteTruck = @json($sumaBrokenConcreteTruck);//Broken Concrete Truck Hauling
        if(varsumaBrokenConcreteTruck != 0){
            categories.push('Broken Concrete Truck Hauling');
            spentCategory.push(varsumaBrokenConcreteTruck); 
            pieColor.push('#ffea00');
        }
        const varsumaDirtTruckHauling = @json($sumaDirtTruckHauling);//Dirt Truck Hauling
        if(varsumaDirtTruckHauling != 0){
            categories.push('Dirt Truck Hauling');
            spentCategory.push(varsumaDirtTruckHauling); 
            pieColor.push('#33ff00');
        }
        const varsumaMixedTruckHauling = @json($sumaMixedTruckHauling);//Mixed Truck Hauling
        if(varsumaMixedTruckHauling != 0){
            categories.push('Mixed Truck Hauling');
            spentCategory.push(varsumaMixedTruckHauling); 
            pieColor.push('#00ffbf');
        }
        const varsumaOfficeAdmin = @json($sumaOfficeAdmin);//Office / Admin
        if(varsumaOfficeAdmin != 0){
            categories.push('Office / Admin');
            spentCategory.push(varsumaOfficeAdmin); 
            pieColor.push('#a200ff');
        }
        const varsumaToolPurchase = @json($sumaToolPurchase);//Tool Purchase
        if(varsumaToolPurchase != 0){
            categories.push('Tool Purchase');
            spentCategory.push(varsumaToolPurchase); 
            pieColor.push('#ff00d0');
        }
        const varsumaToolsRental = @json($sumaToolsRental);//Tools Rental
        if(varsumaToolsRental != 0){
            categories.push('Tools Rental');
            spentCategory.push(varsumaToolsRental); 
            pieColor.push('#434d0f');
        }
        const varsumaMiscellaneous = @json($sumaMiscellaneous);//Miscellaneous
        if(varsumaMiscellaneous != 0){
            categories.push('Miscellaneous');
            spentCategory.push(varsumaMiscellaneous); 
            pieColor.push('#0f4d39');
        }

        var myChart = document.getElementById('myPieChart');
        var chart = new Chart(myChart,{
            type:'doughnut',
            data:{
                labels:categories,
                datasets:[{
                    label: categories,
                    data:spentCategory,
                    borderWidth: 1, 
                    borderColor: 'black',
                    hoverBorderWidth: 3, 
                    hoverBorderColor: 'black',
                    backgroundColor : pieColor
                }],
            },
            options:{ 
                plugins:{
                    datalabels:{
                        labels:{
                            value:{
                                color:'black'
                            }
                        },
                        font:{
                            size:13,
                            weight: 'bold',
                            backgroundColor:'black'
                        },
                        /* formatter: function(categories, myChart){
                            return myChart.chart.data.labels[myChart.dataIndex]+'\n'+'$'+categories; 
                        } */
                        formatter: function(categories, myChart){
                            return '$'+categories; 
                        }
                    }
                },
                
                maintainAspectRatio: false,
            }
        });

        function getAddress(value) {
            /* var codigoACopiar = $('#textCopy').text();
            var seleccion = document.createRange();
            seleccion.selectNodeContents(codigoACopiar);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(seleccion);
            var res = document.execCommand('copy');
            window.getSelection().removeRange(seleccion); */

            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        }

       /*  var myChart = document.getElementById('myPieChart').getContext('2d');
        var chart = new Chart(myPieChart,{
            type:'pie',
            data:{
                labels:categories,
                datasets:[{
                    label: 'Spent',
                    data:spentCategory,
                    borderWidth: 1, 
                    borderColor: 'black',
                    hoverBorderWidth: 3, 
                    hoverBorderColor: 'black',
                    backgroundColor : pieColor
                }],
            },
            options:{ 
                plugins:{
                    datalabels:{
                        labels:{
                            value:{
                                color:'white'
                            },
                            precision: 2
                        },
                        font:{
                            size:15,
                            weight: 'bold',
                            backgroundColor:'white'
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            },
        }); */

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <style>
    div.chartWrapper {
        position: relative;
        overflow: auto;
        width: 100%;
    }

    div.chartContainer {
        position: relative;
        height: 300px;
    }
    </style>
@stop
