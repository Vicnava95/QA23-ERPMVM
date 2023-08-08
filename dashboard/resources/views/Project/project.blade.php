@extends('master')
@section('title')
    <title>{{$project->name_project}}</title>
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
    

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right">
                <a href="{{route('project.index')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class=""></div>
            <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">Project</h5>
                        <h5 class="card-title text-center">{{$project->name_project}}</h5>
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Status</label> 
                                        <input type="text" class="form-control form-control-sm" value="{{$project->statu->name_status}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Name*</label>
                                        <input type="text" class="form-control form-control-sm" value="{{$project->name_project}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <label style="font-size: 12px;">Address</label>
                                <div id="locationField" >
                                <textarea type="text" class="form-control form-control-sm" readonly>{{$project->address_project}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <br>
                                <label style="font-size: 12px;">Service(s)</label><br>
                                @foreach($services as $service)
                                    <span class="badge badge-secondary" style="margin:5px;">{{ $service->name_service }}</span></br>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Manager</label> 
                                        <input type="text" class="form-control form-control-sm" value="{{$project->manager->name_manager}}" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Start Date</label>
                                        <input type="text" class="form-control form-control-sm"  value="{{$project->start_date_project}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project End Date</label>
                                        <input type="text" class="form-control form-control-sm"  value="{{$project->end_date_project}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label style="font-size: 12px;">Project Phases</label>
                                <div id="accordion">
                                @foreach($phases as $phase)
                                    <div class="card" style="margin:5px;">
                                        <div class="card-header" id="headingThree" style="padding:1px;">
                                            <h5 class="text-center mb-0" >
                                                <div class="text-center">
                                                    <button class="btn btn-link collapsed" style="display: table; margin-left:auto; margin-right:auto;" data-toggle="collapse" data-target="#collapse{{$phase->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                    <div class="res">{{$phase->name_phase}}</div>
                                                    </button>
                                                </div>
                                            </h5>
                                        </div>
                                        <div id="collapse{{$phase->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body" style="padding:5px 5px 5px 20px;">
                                                <label style="font-size: 12px;">Text: </label>
                                                <label style="font-size: 12px;">{{$phase->text_phase}}</label><br>
                                                <label style="font-size: 12px;">Budget: </label>
                                                <label style="font-size: 12px;">${{$phase->budget_phase}}</label>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>                         
                            </div>
                            <hr>
                            <!-- Start Add more phases-->
                            <div class="rowPhases">
                            </div>
                            <!-- End Add more phases-->

                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Budget</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" value="{{$project->budget_project}}" readonly> 
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Sold</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" value="{{$project->sold_project}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Profit Margin</label>
                                        <input type="text" class="form-control form-control-sm" value="{{$project->profit_project}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Total Profit</label>
                                        <input type="text" class="form-control form-control-sm" value="{{$project->total_sold_project}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Scope</label>
                                <textarea class="form-control" id="note" rows="3" readonly> {{$project->scope_project}}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Type</label> 
                                        <input type="text" class="form-control form-control-sm" value="{{$project->projectType->name_project_type}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Category</label>
                                        <input type="text" class="form-control form-control-sm" value="{{$project->categorie->name_category}}" readonly> 
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label style="font-size: 12px;">Contacts</label> 
                                <div id="accordion">
                                @foreach($contacts as $contact)
                                    <div class="card" style="margin:5px;">
                                        <div class="card-header" id="headingThree" style="padding:1px;">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$contact->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                {{$contact->name_contact}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{$contact->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body" style="padding:5px 5px 5px 20px;">
                                                <label style="font-size: 12px;">Name: </label>
                                                <label style="font-size: 12px;">{{$contact->name_contact}}</label><br>
                                                <label style="font-size: 12px;">Phone: </label>
                                                <label style="font-size: 12px;">{{$contact->phone_contact}}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label style="font-size: 12px;">Pictures</label> 
                                <br>
                                @foreach ($files as $file)
                                <img src="{{ URL::asset('uploads/'.$file->reference_file_project) }}" class="img-fluid" alt="Responsive image">
                                {{-- <img src="{{ URL::asset('uploads/'.$file->reference_file_project) }}" alt="Any alt text"/> --}}
                                <br>
                                <br>
                                @endforeach
                            </div>
                            
                            <!-- Start Add more contacts-->
                            <div class="rowcontact" id="rowcontact">
                            </div>
                            <!-- End Add more contacts-->

                            <div class="form-group" hidden>
                            <label style="font-size: 12px;">Files:</label> <span class="badge badge-secondary addRowButtons" style="font-size: 10px;" onclick="countFiles()" href="#addContact" role="button" aria-expanded="false" aria-controls="collapseExample">Add Another</span><br>
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

                            <div class="text-center">
                            <a href="{{route('project.index')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
                            </div>
                            

                       
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',


        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',

        });
    </script>

<style>

      .res {
        display: block;
        width: 260px;
        padding: 0 20px;
        margin: 0;
        white-space: pre-wrap;
        text-align: center;
      }

    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
