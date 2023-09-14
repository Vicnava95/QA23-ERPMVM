@extends('master')
@section('title')
    <title>Permit ID: {{$permitTicket->id}}</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> --}}
    
    <!-- JS FILE -->
    {{HTML::script('js/permit/infoPermit.js')}}

    {{HTML::style('css/permit/permit.css')}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{route('showPermits')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col text-right">
                @if (Auth::user()->rol != 'labor')
                    <h4><a role="button" href="" class="badge badgeERPButton" data-toggle="modal" data-target="#modalSelectStatus"><i class="uil uil-ellipsis-h" data-toggle="tooltip" data-placement="bottom" title="More Actions"></i></a></h4>
                    <!-- Modal -->
                    <div class="modal fade" id="modalSelectStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">More Actions</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="list-group" style="text-align: center;">
                                    <a class="list-group-item list-group-item-action" href="{{route('editPermit',[$permitTicket,1])}}">Edit</a>
                                    <a class="list-group-item list-group-item-action" href="{{route('deletePermit',$permitTicket)}}">Delete</a>
                                    <a class="list-group-item list-group-item-action" href="{{route('dropzonePermit',$permitTicket)}}">Upload Documents</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class=""></div>
                <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center"><b>{{$project->name_project}}</b></h5>
                        <div class="text-center">
                            <a href="http://maps.apple.com/?q={{$project->address_project}}" style="color: black; font-weight: bold; text-decoration: none;"><h6><b>{{$project->address_project}}</b></h6></a>
                        </div>
                        <h5 class="card-title text-center">
                            <!-- START Se muestra el estado del permiso y la cantidad de días que ha estado ese permiso en ese estado-->
                            @switch($permitStage->id)
                                @case(1)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: #000080; color: #fff; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: #000080; color: #fff; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @case(2)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: rgb(0, 123, 255); color: #fff; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: rgb(0, 123, 255); color: #fff; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @case(3)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: #ffc107; color: #000000; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: #ffc107; color: #000000; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @case(4)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: #e74a3b; color: #fff; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: #e74a3b; color: #fff; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @case(5)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: #28a745; color: #fff; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: #28a745; color: #fff; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @case(6)
                                    @if ($diferenciaDias != 0)
                                        <span class="badge badge-pill" style="background-color: #17a2b8; color: #fff; padding: 6px;">{{$diferenciaDias}}d | {{$permitStage->namePermitStage}}</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color: #17a2b8; color: #fff; padding: 6px;">{{$permitStage->namePermitStage}}</span>
                                    @endif
                                @break
                                @default
                            @endswitch
                            <!-- END Estado del permiso y la cantidad de días que ha estado ese permiso en ese estado-->
                            
                        </h5>
                        
                        <h5 class="card-title text-center"><b>Last Permit Update {{$stringDate}}</b></h5>
                            <fieldset>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <h6><b>Services</b></h6> 
                                            @foreach ($services as $service )
                                                <h6>{{$service->name_service}}</h6>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row"> 
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <h5 style="text-align: center;"><b>Client Info</b>
                                                @if (Auth::user()->rol != 'labor')
                                                    <a style="padding: 5px;" href="" id="bulk_edit" class="badge badge-light" data-toggle="modal" data-target="#editModalClient"><i class="fas fa-edit fa-1x"></i></a>    
                                                @endif
                                                
                                            </h5>
                                            <div class="card border-light mb-12">
                                                <div class="card-body text-dark">
                                                    @if ($client != null)
                                                        <h6 class="card-title">{{$client->nameClient}}</h6>
                                                        <h6>Email: {{$client->emailClient}}</h6>
                                                        <h6>Phone:{{$client->phoneClient}}</h6>
                                                        <input type="text" id="clientID" value="{{$client->id}}" hidden>
                                                    @else
                                                        <h6 class="card-title">Null</h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="editModalClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body modalEditBody">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Permit Name</b></h6> 
                                            @if ($permitTicket->nameTicket == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->nameTicket}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Permit Number</b></h6> 
                                            @if ($permitTicket->numberPermit1 == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->numberPermit1}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <h6><b>City</b></h6> 
                                            @if ($permitTicket->cityPermit == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->cityPermit}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Document Dropoff</b></h6> 
                                            @if ($permitTicket->documentDropoff == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->documentDropoff}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                @if ($permitTicket->namePermit2 != null)
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Second Permit Name</b></h6> 
                                            <h6>{{$permitTicket->namePermit2}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Second Permit Number</b></h6> 
                                            @if ($permitTicket->numberPermit2 == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->numberPermit2}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <h6><b>Contact Inspector / Technician</b></h6> 
                                            @if ($permitTicket->contactNameTicket == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->contactNameTicket}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <h6><b>Conctact Phone</b></h6> 
                                            @if ($permitTicket->contactPhoneTicket == null)
                                                <h6>Null</h6>
                                            @else
                                                <h6>{{$permitTicket->contactPhoneTicket}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <h6><b>Contact Email</b></h6> 
                                            @if ($permitTicket->contactEmailTicket == null)
                                            <h6>Null</h6>
                                            @else
                                            <h6>{{$permitTicket->contactEmailTicket}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6" style="margin-bottom: 10px;">
                                        <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseInspector" role="button" aria-expanded="false" aria-controls="collapseInspector">
                                            Show Inspector Information
                                        </a>
                                        <div class="collapse" id="collapseInspector">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Name</b></h6>
                                                    <h6>{{$permitTicket->inspectorName}}</h6>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Company</b></h6>
                                                    <h6>{{$permitTicket->inspectorCompany}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Phone</b></h6>
                                                    <h6><a href="tel:{{$permitTicket->inspectorTel}}">{{$permitTicket->inspectorTel}}</a></h6>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Email</b></h6>
                                                    <h6><a href="mailto:{{$permitTicket->inspectorEmail}}">{{$permitTicket->inspectorEmail}}</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseSubcontractor" role="button" aria-expanded="false" aria-controls="collapseSubcontractor">
                                            Show Subcontractor Information
                                        </a>
                                        <div class="collapse" id="collapseSubcontractor">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Name</b></h6>
                                                    <h6>{{$permitTicket->subcontractorName}}</h6>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Company</b></h6>
                                                    <h6>{{$permitTicket->subcontractorCompany}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Phone</b></h6>
                                                    <h6><a href="tel:{{$permitTicket->subcontractorTel}}">{{$permitTicket->subcontractorTel}}</a></h6>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-4">
                                                    <h6><b>Email</b></h6>
                                                    <h6><a href="mailto:{{$permitTicket->subcontractorEmail}}">{{$permitTicket->subcontractorEmail}}</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if (Auth::user()->rol != 'labor')
                                    @if (count($coments) == 0)
                                        <div class="text-center">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFirstComment">
                                                Send Welcome
                                            </button>
                                        </div>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalFirstComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">This is the correct information?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            @if ($client != null)
                                                <h6 class="card-title">Name: {{$client->nameClient}}</h6>
                                                <h6>Email: {{$client->emailClient}}</h6>
                                                <h6>Phone:{{$client->phoneClient}}</h6>
                                                <input type="text" id="clientID" value="{{$client->id}}" hidden>
                                            @else
                                                <h6 class="card-title">Null</h6>
                                            @endif
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            <a rol="button" href="{{route('firstComment',$permitTicket)}}" class="btn btn-success">Yes</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- @if ($coments->isNotEmpty()) --}}
                                
                                    @if (Auth::user()->rol != 'labor')
                                        
                                        <form action="{{ route ('updateComments',$permitTicket) }}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                                            @csrf @method('PATCH')
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <h6><b>Comments </b><a href="#" class="badge badge-danger" data-toggle="modal" data-target="#finishComment">Finalized Permit </a></h6>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="finishComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to finalized this permits?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                                <a rol="button" href="{{route('lastComment',$permitTicket)}}" class="btn btn-success">Yes</a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>

                                                        <textarea class="form-control form-control-sm" id="comments" rows="5" name="comments" maxlength="2000" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(session()->has('message'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ session()->get('message') }}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <button class="badge badgeERP" type="submit">ADD NEW UPDATE</button>
                                                <br>
                                            </div>
                                        </form>
                                    @endif
                                    
                                    {{-- Timeline Updates --}}
                                    <hr>
                                    <div class="text-center">
                                        <h4 style="font-size: 25px;">Last Comment</h4>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <ul class="timeline">
                                            @if (!$coments->isEmpty())
                                            <li>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label style="font-size: 25px;"><b>{{$coments[0]->users->name}}</b> </label>
                                                    </div>
                                                    <div class="col-6" style="text-align: right;">
                                                        @if (Auth::user()->rol != 'labor')
                                                            <a style="padding: 5px;"  href="{{route('editTimeLine',$coments[0]->id)}}" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                                                            <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalOneComment{{$coments[0]->id}}"><i class="fas fa-trash-alt fa-2x"></i></a>
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
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalOneComment{{$coments[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            @endif

                                            <div class="modal fade" id="modalCommentsUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">All Comments</h5>
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
                                                                                <label style="font-size: 25px;"><b>{{$c->users->name}}</b> </label>
                                                                            </div>
                                                                            <div class="col-6" style="text-align: right;">
                                                                                @if (Auth::user()->rol != 'labor')
                                                                                    <a style="padding: 5px;"  href="{{route('editTimeLine',$c->id)}}" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                                                                                    <a style="padding: 5px;"  href="" class="badge badge-light" data-toggle="modal" data-target="#modalCenter{{$c->id}}"><i class="fas fa-trash-alt fa-2x"></i></a>    
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
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </ul>
                                    </div>  
                                    <div class="text-center">
                                        <h6><a role="button" href="" class="badge badgeERP" data-toggle="modal" data-target="#modalCommentsUpdate">ALL COMMENTS</a></h6>  
                                    </div>
                                    <br>
                                {{-- @endif --}}
                                

                                <hr>
                                <h5 class="card-title text-center" style="margin-bottom: 5px;"><b>Documents</b></h5>
                                {{-- <div class="text-center">
                                    <a class="btn btn-secondary btn-sm" href="{{route('dropzonePermit',$permitTicket)}}" role="button">Upload Documents</a>
                                </div>
                                <br> --}}
                                @if (Auth::user()->rol != 'labor')
                                    <div class="text-center">
                                        <h6><a role="button" href="" class="badge badgeERP" data-toggle="modal" data-target="#modalSelectDocument">ADD DOCUMENTS</a></h6>
                                        {{-- <a class="btn" data-toggle="modalSelectDocument" href="" data-target="#modal" role="button"><div class="badge badgeERP" >UPLOAD FILES</div></a> --}}
                                    </div>
                                @endif
                                
            
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
                                                        <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,2])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Field Documents</a>
                                                        {{-- <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,7])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> City Inspections</a> --}}
                                                        <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,5])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Permits/Inspections</a>
                                                        <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,1])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Estimation/Jobber</a>
                                                    </div>
                                                    <div class="col">
                                                        
                                                        <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,4])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Receipts </a>
                                                        <a href="{{route('docDropzoneQuoteInformation',[$permitTicket->id,10])}}" class="list-group-item list-group-item-action"><i class="far fa-folder"></i> Others</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(session()->has('messageDocuments'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('messageDocuments') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 10px;">
                                        <h6>Field</h6>
                                        <hr>
                                        
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
                                                                    <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                    {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button" ><i class="far fa-envelope"></i></a> --}}
                                                                    
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
                                                                                    {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                    <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                    {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                    
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
                                                                                    {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                    <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                    
                                                                    
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
                                                                                    {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                        

                                    </div>

                                    @if (Auth::user()->rol != 'labor')
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <h6>Office</h6>
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
                                                                        <a href="{{ URL::asset('quoteInformationDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                <a class="btn-light" data-toggle="collapse" href="#sitePlan" role="button" aria-expanded="false" aria-controls="sitePlan">
                                                <i class="far fa-folder-open" id="sitePlanOpen"></i>
                                                <i class="far fa-folder" id="sitePlanClose"></i> 
                                                Permits/Inspection</a> 
                                                <div class="row">
                                                    <div class="collapse" id="sitePlan">
                                                        <div class="card card-body cardBodyDocuments">
                                                            @if (count($documentsPermitsApplications) != 0)
                                                                @foreach ($documentsPermitsApplications as $doc)
                                                                    <div class="lineDocuments">
                                                                        *
                                                                        <a href="{{ URL::asset('permitsApplicationsDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            @if (count($documentsCovenantAgreement) != 0)
                                                                @foreach ($documentsCovenantAgreement as $doc)
                                                                    <div class="lineDocuments">
                                                                        *
                                                                        <a href="{{ URL::asset('covenantAgreementDocs/'.$doc->referenceDocumentPermit) }}" target="_blank"><i class="arrow right"></i>{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitInfo['id']])}}" role="button"><i class="far fa-envelope"></i></a> --}}
                                                                        
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
                                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <a class="btn btn-danger" href="{{route('destroyDocumentBack', [$permitTicket->id,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
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
                                            
                                        </div>
                                    @endif
                                    
                                </div>
                  
                                @if (Auth::user()->rol != 'labor')
                                    @if (count($documents) != 0)
                                        <hr>
                                        <h6>Others Documents</h6>
                                        <span class="badge badgeERPCount">{{count($documents)}}</span>
                                        <a class="btn-light" data-toggle="collapse" href="#anotherDocu" role="button" aria-expanded="false" aria-controls="anotherDocu">
                                        <i class="far fa-folder-open" id="anotherDocuOpen"></i>
                                        <i class="far fa-folder" id="anotherDocuClose"></i> 
                                        Documents</a> 
                                        <div class="row">
                                            <div class="collapse" id="anotherDocu">
                                                <div class="card card-body cardBodyDocuments">
                                                    @foreach ($documents as $doc)
                                                    <div class="lineDocuments">
                                                        *
                                                        <input type="checkbox" id="checkBox-{{$doc->id}}" name="scales" value="{{$doc->id}}"
                                                        @if ($doc->checkList == 1)
                                                            checked
                                                        @endif
                                                        hidden>
                                                        <a href="{{ URL::asset('documentPermits/'.$doc->referenceDocumentPermit) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}</a>
                                                        <a class="btn btn-outline-danger modalIcon" data-toggle="modal" href="" data-target="#modal{{$doc->id}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                        {{-- <a class="btn btn-outline-primary modalIcon" href="{{route('createDocumentMail', [$doc->id,$permitTicket->id])}}" role="button"><i class="far fa-envelope"></i></a> --}}

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
                                                                        {{str_replace(array('.pdf','.png','.jpeg'),'',$doc->referenceDocumentPermit)}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a class="btn btn-danger" href="{{route('destroyDocument', [$permitTicket,$doc->referenceDocumentPermit])}}" role="button">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            var idDocument = $('#checkBox-{{$doc->id}}').val();
                                                            console.log(idDocument);
                                                            $('#checkBox-{{$doc->id}}').change(function(){
                                                                if(this.checked){
                                                                    alert('check'); 
                                                                    /* window.location.href='/dashboard/public/updateCheckBox/'+idDocument+'/'+1; */
                                                                    window.location.href='/updateCheckBox/'+idDocument+'/'+1;
                                                                }else{
                                                                    window.location.href='/updateCheckBox/'+idDocument+'/'+0;
                                                                    alert('no check')
                                                                }
                                                            })
                                                            
                                                        </script>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    
                                    @endif
                                @endif

                                @if(session()->has('messageDocuments'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('messageDocuments') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- @if (Auth::user()->rol != 'labor')
                                    <hr>
                                    <h5 class="card-title text-center"><b>Mail Center</b></h5>

                                    <div id="accordion">
                                        @foreach ($infoMail as $iMail)
                                            @if ($iMail['id'] >= 1)
                                                <div class="card">
                                                    <div class="card-header" id="heading{{$iMail['id']}}">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$iMail['id']}}" aria-controls="collapse{{$iMail['id']}}" style="white-space: normal;">
                                                        <label class="infoMail" for="">{{$iMail['nameDocument']}}</label>
                                                        </button>
                                                    </div>
                                                
                                                    <div id="collapse{{$iMail['id']}}" class="collapse" aria-labelledby="heading{{$iMail['id']}}" data-parent="#accordion">
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="infoMail" ><b>Courier:</b></label>
                                                                <span for="">{{$iMail['courier']}}</span>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Recipient's Name:</b></label>
                                                                <span for="">{{$iMail['recipientName']}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Tracking:</b></label>
                                                                <span for="">{{$iMail['tracking']}}</span>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Permit Document:</b></label>
                                                                <span for="">{{$iMail['permitDocument']}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Date Send:</b></label>
                                                                <span for="">{{$iMail['dateSend']}}</span>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Date Received:</b></label>
                                                                <span for="">{{$iMail['dateReceived']}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Cerified Mail:</b></label>
                                                                @if ($iMail['certifiedMail'] == 1)
                                                                    <span for="">Yes</span>
                                                                @else
                                                                    <span for="">No</span>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="infoMail"><b>Certification Number:</b></label>
                                                                <span for="">{{$iMail['certificationNumber']}}</span>
                                                            </div>
                                                        </div>

                                                        <label for="" class="infoMail"><b>Images</b></label>
                                                        <br>

                                                        @foreach ($infoMailDocuments as $iMailDocuments)
                                                            @if ($iMailDocuments['idD'] != -1)
                                                                @if ($iMail['id'] == $iMailDocuments['idMail'] )
                                                                    <a href="{{ URL::asset('documentMails/'.$iMailDocuments['reference']) }}" target="_blank">{{$iMailDocuments['reference']}}</a>
                                                                    <a class="btn btn-outline-danger modalIcon" href="{{route('documentMailDelete',[$permitTicket->id,$iMailDocuments['idD']])}}" role="button"><i class="far fa-trash-alt"></i></a>
                                                                    <br>
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        <div class="text-center">
                                                            <a style="padding: 5px;"  href="{{route('editDocumentMail',[$iMail['idDocument'],$permitTicket->id,$iMail['id']])}}" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                                                            <a style="padding: 5px;" href="{{route('deleteDocumentMail',[$iMail['idDocument'],$permitTicket->id,$iMail['id']])}}" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                                                            <a style="padding: 5px;" href="{{route('dropzoneDocumentMail',[$iMail['idDocument'],$permitTicket->id,$iMail['id']])}}" class="badge badge-light"><i class="far fa-images fa-2x"></i></a>
                                                        </div>

                                                    </div>
                                                    </div>
                                                </div>  
                                            @endif
                                        @endforeach
                                    </div>
                                @endif --}}

                                <div class="text-center" hidden>
                                    <a class="btn btn-secondary btn-sm" href="{{route('updateTicket',$permitTicket)}}" role="button">Update Ticket</a>
                                </div>
                            </fieldset>
                        
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@stop
