@extends('master')
@section('title')
    <title>Edit || {{$project->name_project}}</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <!-- Fields - Style CSS -->
    {{HTML::style('css/fields-style.css')}}


    <!-- Fields - JS -->
    <!-- crear un nuevo json, ya que la petición se realiza desde otra url -->
    {{HTML::script('js/projects/editProject.js')}}

<!-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> -->

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{url()->previous()}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right">
                
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class=""></div>
            <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">Edit Project</h5>
                        <h5 class="card-title text-center">{{$project->name_project}}</h5>
                        <form action="{{ route ('project.update',$project) }}" name="form1" method="POST" class="well form-horizontal" onsubmit="sub_butt.disabled = true; return true;" enctype="multipart/form-data" >
                        @csrf @method('PATCH')
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Status</label> 
                                            <select class="form-control" id="statusProject" style="height: 30px; font-size: 13px;" name="statusProject">
                                                    @foreach($status as $statu)
                                                    <option value="{{ $statu->id}}"
                                                    @if($project->statu->id == $statu->id) selected="selected" @endif>{{ $statu->name_status}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Name*</label>
                                            <input type="text" class="form-control form-control-sm" value="{{old('nameProject',$project->name_project)}}" id="nameProject" name="nameProject" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>

                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                            <div class="form-group" >
                                <label style="font-size: 12px;">Address</label>
                                <div id="locationField" >
                                <input type="text" class="form-control form-control-sm" value="{{old('project_address',$project->address_project)}}" id="autocomplete" onFocus="geolocate()" name="project_address" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <br>
                                <label style="font-size: 12px;">Service(s)</label><br>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            @foreach($servicios as $service)
                                                @if ($service->id < 16)
                                                <input type="checkbox" id="vehicle{{$service->id}}" name="service[]" value="{{ $service->id}}" onclick="showRadioButtonService({{ $service->id}})"
                                                @foreach($servicesP as $s)
                                                    @if($s->id == $service->id)
                                                    checked
                                                    @endif
                                                @endforeach>
                                                <label style="font-size: 14px;" for="vehicle{{$service->id}}"> {{ $service->name_service }} </label><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            @foreach($servicios as $service)
                                                @if ($service->id >= 16)
                                                    <input type="checkbox" id="vehicle{{$service->id}}" name="service[]" value="{{ $service->id}}" onclick="showRadioButtonService({{ $service->id}})"
                                                    @foreach($servicesP as $s)
                                                        @if($s->id == $service->id)
                                                        checked
                                                        @endif
                                                    @endforeach>
                                                    <label style="font-size: 14px;" for="vehicle{{$service->id}}"> {{ $service->name_service }} </label><br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- Radio Buttons --}}
                                    <div class="col-12">
                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <label style="font-size: 12px;">Main Service</label> <br>
                                            @foreach($servicios as $service)
                                                <div class="form-check form-check-inline radios" id="radioService{{$service->id}}">
                                                    <input class="form-check-input" type="radio" name="principal" id="inlineRadio{{ $service->id}}" value="{{ $service->id}}" 
                                                    @if($principalService == $service->id)
                                                        checked
                                                    @endif>
                                                    <label class="form-check-label" for="inlineRadio{{ $service->id}}" style="font-size: 14px;">{{ $service->name_service}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Manager</label> 
                                        <select class="form-control" id="selectManager" style="font-size: 12px;" name="selectManager">
                                                @foreach ($managers as $manager)
                                                <option value="{{ $manager->id }}"
                                                @if($project->manager->id == $manager->id) selected="selected" @endif>{{ $manager->name_manager }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Client Source</label> 
                                        <select class="form-control" id="selectClientSource" style="font-size: 12px;" name="selectClientSource">
                                                @foreach ($clientSource as $clientSource)
                                                <option value="{{ $clientSource->id }}"
                                                @if ($project->clients->id == $clientSource->id) selected="selected" @endif>{{ $clientSource->nameClientSource }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Client Name</label>
                                            <input type="text" class="form-control form-control-sm" maxlength="100" id="clientName" name="clientName" placeholder="Search Client" autocomplete="off" value="{{old('clientName',$clients[0]['name'])}}">
                                            <input type="text" class="form-control form-control-sm" maxlength="100" id="idClientName" name="idClientName" autocomplete="off" value="{{old('idClientName',$clients[0]['id'])}}" hidden>
                                            <div class="showClient" id="showClient">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6" style="margin-bottom: 10px; padding-top:15px; ">
                                    <a class="btn btn-outline-secondary" href="{{route('clientswebCreate',1)}}" target="_blank" role="button" style="width:100%;">Create Client</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <label style="font-size: 12px;">Project Start Date</label>
                                    <input type="text" id="datepicker" value="{{old('start_date',$project->start_date_project)}}" width="180" name="start_date" autocomplete="off" required>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label style="font-size: 12px;">Project End Date</label>
                                    <input type="text" id="datepicker2" value="{{old('start_date',$project->end_date_project)}}" width="180" name="end_date" autocomplete="off" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Budget</label>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm" value="{{old('budgetProyect',$project->budget_project)}}" onchange="cal()" id="budgetProject" name="budgetProyect" placeholder="$0.00" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Sold</label>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm" value="{{old('budgetProyect',$project->sold_project)}}" onchange="cal()" id="soldProject" name="soldProject" placeholder="$0.00" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Profit Margin</label>
                                        <input type="text" class="form-control form-control-sm" value="{{old('budgetProyect',$project->profit_project)}}" id="profitProject" name="profitProject" placeholder="0%" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Total Profit</label>
                                        <input type="text" class="form-control form-control-sm" value="{{old('budgetProyect',$project->total_sold_project)}}" id="totalProject" name="totalProject" placeholder="$0.00" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Scope</label>
                                <textarea class="form-control" id="note" rows="3" name="note" required>{{$project->scope_project}}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Type</label> 
                                        <select class="form-control" id="projectType" style="font-size: 12px;" name="projectType">
                                                @foreach($projectTypes as $projects)
                                                <option value="{{ $projects->id}}"
                                                @if($project->projectType->id == $projects->id) selected="selected" @endif>{{ $projects->name_project_type }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Category</label> 
                                        <select class="form-control" id="category" style="font-size: 12px;" name="category">
                                                @foreach($categoris as $categori)
                                                <option value="{{ $categori->id }}"
                                                @if($project->categorie->id == $categori->id) selected="selected" @endif>{{ $categori->name_category }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr hidden>

                            <div class="form-group" hidden>
                                <label style="font-size: 12px;">Contacts</label> <span class="badge badge-secondary addRowContact" style="font-size: 10px;cursor: pointer;" id="contadorButton" href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span><br>
                                @foreach ($contacts as $contact)
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size: 12px;">Name</label>
                                        <input type="text" class="form-control form-control-sm" value="{{old('name',$contact->name_contact)}}" id="nameContact" name="name[]" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <label style="font-size: 12px;">Phone</label>
                                        <input type="number" class="form-control form-control-sm" value="{{old('phone',$contact->phone_contact)}}" id="phoneContact" name="phone[]">
                                        
                                    </div>
                                </div>
                                @endforeach
                
                            </div>
                            <!-- Start Add more contacts-->
                            <div class="rowcontact" id="rowcontact">
                            </div>
                            <!-- End Add more contacts-->

                            <div class="form-group" hidden>
                            <label style="font-size: 12px;">Files:</label> <span class="badge badge-secondary addRowButtons" style="font-size: 10px; cursor: pointer;" onclick="countFiles()" href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btnfile">Upload a file</button>
                                    <input type="file" name="myfile[]"/>
                                </div>                               
                            </div>
                                <!-- Start Add more Files-->
                            <div class="upload-btn-wrapper rowButtons">
                            </div>
                                <!-- End Add more -->
                            <hr>
                            <h5 class="card-title text-center">Trucks & Materials Estimation</h5>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Yards</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" id="yards" name="yards" placeholder="0" value="{{old('phone',$truck->yards)}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="note" rows="3" name="descriptionMaterial">{{old('descriptionMaterial',$truck->description)}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <button class="btn btn-secondary" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckImport" aria-expanded="false" aria-controls="truckImport">
                                            Truck Import
                                        </button>
                                    </p>
                                    <div class="collapse" id="truckImport">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importDirt" name="importDirt" min="0" value="{{old('phone',$truck->importDirt)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Asphalt</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importAsphalt" name="importAsphalt" min="0" value="{{old('phone',$truck->importAsphalt)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Aggregates</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importAggregates" name="importAggregates" min="0" value="{{old('phone',$truck->importAggregates)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Soil</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importSoil" name="importSoil" min="0" value="{{old('phone',$truck->importSoil)}}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Base</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importBase" name="importBase" min="0" value="{{old('phone',$truck->importBase)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Gravell</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importGravell" name="importGravell" min="0" value="{{old('phone',$truck->importGravell)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Sand</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="importSand" name="importSand" min="0" value="{{old('phone',$truck->importSand)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                                <div class="col">
                                    <p>
                                        <button class="btn btn-secondary" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckExport" aria-expanded="false" aria-controls="truckExport">
                                            Truck Export
                                        </button>
                                    </p>
                                    <div class="collapse" id="truckExport">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportDirt" name="exportDirt" min="0" value="{{old('phone',$truck->exportDirt)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Asphalt</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportAsphalt" name="exportAsphalt" min="0" value="{{old('phone',$truck->exportAsphalt)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt + Rocks</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportDirtRock" name="exportDirtRock" min="0" value="{{old('phone',$truck->exportDirtRock)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Trash 40CY</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportTrash40CY" name="exportTrash40CY" min="0" value="{{old('phone',$truck->exportTrash40CY)}}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Concrete</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportConcrete" name="exportConcrete" min="0" value="{{old('phone',$truck->exportConcrete)}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Mixed</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportMixed" name="exportMixed" min="0" value="{{old('phone',$truck->exportMixed)}}">
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Trash</label>
                                                        <input type="number" step="1" class="form-control form-control-sm" id="exportTrash" name="exportTrash" min="0" value="{{old('phone',$truck->exportTrash)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <hr>


                            <div class="text-center">
                                <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Update</button>
                            </div>
                            </fieldset>

                        </form>
                        
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>

    <script>
        $('.radios').hide();
    </script>

    @foreach($servicesP as $s)
    <script>
        $('#radioService'+{{$s->id}}+'').show();
    </script>
    @endforeach

    <script>
  $('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
  });
  $('#datepicker2').datepicker({
    uiLibrary: 'bootstrap4',
  });

  $('#datepicker').on('change',function(){
    //alert("prueba");
    $('#datepicker2').datepicker('destroy');
    var stringdia = $('#datepicker').val();
    //console.log(stringdia)
     $('#datepicker2').datepicker({
      uiLibrary: 'bootstrap4',
      minDate: stringdia
  }); 
  });
    </script>

    <script>

        $('input[name="phone"]').mask('+1 (000) 000-0000');

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

        @media (max-width:600px){
            .datepicker{
                width: 120px;
            }
            .datepicker2{
                width: 120px;
            }
        }
    </style>
@stop
