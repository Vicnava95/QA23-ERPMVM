@extends('master')
@section('title')
    <title>New Proyect</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - Style CSS -->
    <link href="css/fields-style.css" rel="stylesheet" type="text/css" />

    <!-- Dropzone -->
    <script src="js/dropzone-5.7.0/dist/dropzone.js"></script>
    <link href="css/dropzone.css" rel="stylesheet" type="text/css" />

    <!-- Fields - JS -->
    <script src="js/projects/newProject.js"></script>
 
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> --}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-left">
                <h4><a href="{{route('project.active')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col text-right">
                
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="">

            </div>
            <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">New Project Form</h5>
                        <form action="{{ route ('project.store') }}" id="formProyect" method="post" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4 ">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Status</label> 
                                            <select class="form-control" id="statusProject" style="height: 32px; font-size: 13px;" name="statusProject">
                                                    @foreach($status as $statu)
                                                    <option value="{{ $statu->id}}">{{ $statu->name_status}}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Name*</label>
                                            <input type="text" class="form-control form-control-sm" id="nameProject" name="nameProject" autocomplete="off" required>
                                        </div>

                                        <div class="form-group" >
                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete&language=en" async defer></script>
                                            <label style="font-size: 12px;">Address</label>
                                            <div id="locationField" style="margin-bottom: 28px;">
                                            <input type="text" class="form-control form-control-sm" id="autocomplete" width="100%" onFocus="geolocate()" name="project_address" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Manager</label> 
                                            <select class="form-control" id="selectManager" style="height: 32px; font-size: 13px;" name="selectManager">
                                                    @foreach ($managers as $manager)
                                                    <option value="{{ $manager->id }}">{{ $manager->name_manager }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Type</label> 
                                            <select class="form-control" id="projectType" style="height: 32px; font-size: 13px;" name="projectType">
                                                    @foreach($projectTypes as $projects)
                                                    <option value="{{ $projects->id}}">{{ $projects->name_project_type }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Category</label> 
                                        <select class="form-control" id="category" style="height: 32px; font-size: 13px;" name="category">
                                                @foreach($categoris as $categori)
                                                <option value="{{ $categori->id }}">{{ $categori->name_category }}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Start Date</label>
                                            <input type="text" id="datepicker" width="100%" name="start_date" required autocomplete="off" style="height: 32px; font-size: 13px;">
                                        </div>
                                        <div class="form-group date2">
                                            <label style="font-size: 12px;">Project End Date</label>
                                            <input type="text" id="datepicker2" width="100%" name="end_date" required autocomplete="off" style="height: 32px; font-size: 13px;">
                                        </div>
                                        <div class="form-group hideMobile date3">
                                            <label style="font-size: 12px;">Project End Date</label>
                                            <input type="text" id="datepicker3" width="100%" name="end_dateF"  autocomplete="off" style="height: 32px; font-size: 13px;">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Budget</label>
                                            <input type="number" step="0.01" class="form-control form-control-sm" onkeyup="cal()" id="budgetProject" name="budgetProyect" min="0" value="0" step="0.01" placeholder="$0.00" required>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Sold</label>
                                            <input type="number" step="0.01" class="form-control form-control-sm" onkeyup="cal()" id="soldProject" name="soldProject" min="0" value="0" step="0.01" placeholder="$0.00" required>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Profit Margin</label>
                                            <input type="text" class="form-control form-control-sm" id="profitProject" name="profitProject" placeholder="0%" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Total Profit</label>
                                            <input type="text" class="form-control form-control-sm" id="totalProject" name="totalProject" placeholder="$0.00" readonly>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Client Name</label> <span><a class="badge badge-secondary" id="mediumButton" data-toggle="modal" data-target="#mediumModal"
                                                data-attr="{{route('clientswebCreate',2)}}" style="font-size: 10px; cursor: pointer;" href="#">Add new</a>
                                            <input type="text" class="form-control form-control-sm" maxlength="100" id="clientName" name="clientName" placeholder="Search Client" autocomplete="off">
                                            <input type="text" class="form-control form-control-sm" maxlength="100" id="idClientName" name="idClientName" autocomplete="off" hidden>
                                            <div class="showClient" id="showClient">
                                            </div>
                                        </div>
                                        {{-- Se despliga la información del cliente --}}
                                        <div id="showInfo">
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Client Source</label> 
                                            <select class="form-control" id="selectClientSource" style="height: 32px; font-size: 13px;" name="selectClientSource" required>
                                                    <option value="0">Open this select menu</option>
                                                    @foreach ($clientSource as $clientSource)
                                                    <option value="{{ $clientSource->id }}">{{ $clientSource->nameClientSource }}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" style="font-size: 12px;">Scope</label>
                                            <textarea class="form-control" id="note" rows="3" name="note" required></textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 hideMobile">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Service(s)</label><br>
                                            @foreach($services as $service)
                                                @if ($service->id < 16)
                                                <input type="checkbox" id="vehicle{{$service->id}}" name="service[]" value="{{ $service->id}}" onclick="showRadioButtonService({{ $service->id}})">
                                                <label style="font-size: 14px;" for="vehicle{{$service->id}}"> {{ $service->name_service }} </label><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-12 col-md-4 hideMobile">
                                        <br>
                                        <div class="form-group">
                                            @foreach($services as $service)
                                                @if ($service->id >= 16)
                                                    <input type="checkbox" id="vehicle{{$service->id}}" name="service[]" value="{{ $service->id}}" onclick="showRadioButtonService({{ $service->id}})">
                                                    <label style="font-size: 14px;" for="vehicle{{$service->id}}"> {{ $service->name_service }} </label><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4 hideDesktopTablet">
                                        <label style="font-size: 12px;">Service(s)</label><br>
                                        <div class="form-group">
                                            @foreach($services as $service)
                                                <input type="checkbox" id="vehicle1{{$service->id}}" name="service[]" value="{{ $service->id}}" onclick="showRadioButtonServiceMobile({{ $service->id}})">
                                                <label style="font-size: 14px;" for="vehicle{{$service->id}}"> {{ $service->name_service }} </label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- Radio Buttons --}}
                                    <div class="col-12">
                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <label style="font-size: 12px;">Main Service</label> <br>
                                            @foreach($services as $service)
                                                <div class="form-check form-check-inline radios" id="radioService{{$service->id}}">
                                                    <input class="form-check-input" type="radio" name="principal" id="inlineRadio{{ $service->id}}" value="{{ $service->id}}">
                                                    <label class="form-check-label" for="inlineRadio{{ $service->id}}" style="font-size: 14px;">{{ $service->name_service}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <h5 class="card-title text-center" style="margin-bottom: 5px;">Phases</h5>
                                <div class="text-center" style="margin-bottom: 5px;" >
                                    <span class="badge badge-secondary" id="showCollapsePhases" role="button" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapsePhases" aria-expanded="false" aria-controls="collapsePhases">Add Phases</span>
                                </div>
                                <div class="text-center" style="margin-bottom: 5px;" >
                                    <span class="badge badge-secondary" id="hideCollapsePhases" role="button" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapsePhases" aria-expanded="false" aria-controls="collapsePhases">Show less</span>
                                </div>
                            
                                <div class="collapse" id="collapsePhases">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Phases</label> <span class="badge badge-secondary addRowPhases" onclick="countPhases()" style="font-size: 10px; cursor: pointer;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label style="font-size: 12px;">Phase Name</label>
                                                    <input type="text" class="form-control form-control-sm" maxlength="100" id="phaseNameProject" name="phaseNameProject[]" placeholder="" autocomplete="off" required>
                                                </div>
                                            </div> 
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label style="font-size: 12px;">Budget</label>
                                                    <input type="number" class="form-control form-control-sm" id="phaseBudgetProject" name="phaseBudgetProject[]" min="0" value="0" step="0.01" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label style="font-size: 12px;">Sold</label>
                                                    <input type="number" class="form-control form-control-sm" id="phaseSoldProject" name="phaseSoldProject[]" min="0" value="0" step="0.01" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label style="font-size: 12px;">Service</label>
                                                    <select class="form-control form-control-sm formModalToDo" id="inputService[]" style="margin-bottom: 5px;" name="inputService[]">
                                                        @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name_service }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Text</label>
                                            <textarea type="text" class="form-control form-control-sm" rows="3" id="phaseTextProject" name="phaseTextProject[]" placeholder="" required></textarea>
                                        </div>
                                    </div>
                    
                                    <!-- Start Add more phases-->
                                    <div class="rowPhases">
                                    </div>
                                    <!-- End Add more phases-->
                                </div>
                                <hr>

                                <h5 class="card-title text-center" style="margin-bottom: 5px;">Trucks & Materials Estimation</h5>
                                <div class="text-center" style="margin-bottom: 5px;">
                                    <span class="badge badge-secondary" id="showCollapseEstimation" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapseEstimation" aria-expanded="false" aria-controls="collapseEstimation">Add Estimation</span>
                                </div>

                                <div class="text-center" style="margin-bottom: 5px;">
                                    <span class="badge badge-secondary" id="hideCollapseEstimation" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapseEstimation" aria-expanded="false" aria-controls="collapseEstimation">Show less</span>
                                </div>


                                <div class="collapse" id="collapseEstimation">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 12px;">Yards</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm" id="yards" name="yards" placeholder="0" value="0" min="0">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                        <textarea class="form-control" id="note" rows="3" name="descriptionMaterial"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>
                                                <button class="btn btn-secondary btn-sm" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckImport" aria-expanded="false" aria-controls="truckImport">
                                                    Truck Import
                                                </button>
                                            </p>
                                            <div class="collapse" id="truckImport">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Dirt</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importDirt" name="importDirt" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Asphalt</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importAsphalt" name="importAsphalt" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Aggregates</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importAggregates" name="importAggregates" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Soil</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importSoil" name="importSoil" min="0" value="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Base</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importBase" name="importBase" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Gravell</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importGravell" name="importGravell" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Sand</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="importSand" name="importSand" min="0" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
        
                                        </div>
                                        <div class="col">
                                            <p>
                                                <button class="btn btn-secondary btn-sm" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckExport" aria-expanded="false" aria-controls="truckExport">
                                                    Truck Export
                                                </button>
                                            </p>
                                            <div class="collapse" id="truckExport">
                                                <div class="card card-body">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Dirt</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportDirt" name="exportDirt" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Asphalt</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportAsphalt" name="exportAsphalt" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Dirt + Rocks</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportDirtRock" name="exportDirtRock" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Trash 40CY</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportTrash40CY" name="exportTrash40CY" min="0" value="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Concrete</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportConcrete" name="exportConcrete" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Mixed</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportMixed" name="exportMixed" min="0" value="0">
                                                            </div>
                                                            <div class="form-group">
                                                                <label style="font-size: 12px;">Trash</label>
                                                                <input type="number" step="1" class="form-control form-control-sm" id="exportTrash" name="exportTrash" min="0" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="form-group">
                                    <h5 class="card-title text-center" style="margin-bottom: 5px;">Contacts</h5>
                                    
                                    <div class="text-center" style="margin-bottom: 5px;">
                                        <span class="badge badge-secondary" id="showCollapseContacts" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapseContacts" aria-expanded="false" aria-controls="collapseContacts">Add Contacts</span>
                                    </div>

                                    <div class="text-center" style="margin-bottom: 5px;">
                                        <span class="badge badge-secondary" id="hideCollapseContacts" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapseContacts" aria-expanded="false" aria-controls="collapseContacts">Show less</span>
                                    </div>

                                    <div class="collapse" id="collapseContacts">
                                        <label style="font-size: 12px;">Contacts</label> <span class="badge badge-secondary addRowContact" style="font-size: 10px;cursor: pointer;" id="contadorButton" href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span><br>
                                    <div class="row">
                                        <div class="col">
                                            <label style="font-size: 12px;">Name</label>
                                            <input type="text" class="form-control form-control-sm" id="nameContact" name="name[]" autocomplete="off">
                                        </div>
                                        <div class="col">
                                            <label style="font-size: 12px;">Phone</label>
                                            <input type="text" class="form-control form-control-sm" id="phoneContact" name="phone[]" autocomplete="off">
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Add more contacts-->
                                <div class="rowcontact" id="rowcontact">
                                </div>
                                <!-- End Add more contacts-->
                                </div>
                                <div class="form-group" hidden>
                                    <label style="font-size: 12px;">Files:</label> <span class="badge badge-secondary addRowButtons" style="font-size: 10px; cursor: pointer;" onclick="countFiles()" href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span><br>
                                    <div class="file-select" id="src-file1" >
                                        <input type="file" aria-label="Archivo" name="file[]">
                                    </div>                              
                                </div>

                                <!-- Start Add more Files-->
                                <div class="upload-btn-wrapper rowButtons">
                                </div>
                                <!-- End Add more -->
                                <hr>
                                <div class="text-center">
                                    <button type="submit" form="formProyect"  class="btn btn-secondary btn-sm">Submit Project</button>
                                </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->

        <!-- Modal -->
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modalPost" id="modalPost">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    }); 
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4',
    }); 

    $('#datepicker').on('change',function(){
        $('.date2').show();
        $('.date3').hide();
        //alert("prueba");
        //$('#datepicker2').datepicker('destroy');
        var stringdia = $('#datepicker').val();
        //console.log(stringdia)
        $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        minDate: stringdia
    }).val(stringdia);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('input[name="phone[]"]').mask('+1 (000) 000-0000');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style>
    .badgeERPButton{
        background-color: rgb(255, 255, 255);
        color: #000000;
        border: 1px solid #000000;
        text-decoration: none;
    }

    .badgeERPButton:hover{
        background-color: #e4a627;
        color: black;
        text-decoration: none;
    }
    /* Desktop */
    @media screen and (min-width: 1024px){
        .hideDesktopTablet{
            display: none;
        }
    }

    /* Tablet */
    @media screen and (min-width: 768px) and (max-width: 1023px){
        .hideDesktopTablet{
            display: none;
        }
    }

    /* Mobil */
    @media screen and (max-width: 767px){
        .hideMobile{
            display: none;
        }

    }
</style>
@stop
