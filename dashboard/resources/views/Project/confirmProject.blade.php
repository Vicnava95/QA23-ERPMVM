@extends('master')
@section('title')
    <title>Delete || {{$project->name_project}}</title>
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
    {{HTML::script('js/projects/newProject.js')}}

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
                        <h5 class="card-title text-center">Are you sure to delete</h5>
                        <h5 class="card-title text-center">{{$project->name_project}}?</h5>
                        <form action="{{ route ('project.destroy',[$project, $truck[0]['id']]) }}" name="form1" method="POST" class="well form-horizontal" onsubmit="sub_butt.disabled = true; return true;" enctype="multipart/form-data" >
                            @csrf @method('DELETE')
                            <fieldset>
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
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Manager</label> 
                                        <input type="text" class="form-control form-control-sm" value="{{$project->manager->name_manager}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Client</label> 
                                        <input type="text" class="form-control form-control-sm" value="{{$clients[0]['name']}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Start Date</label>
                                        <input type="text" class="form-control form-control-sm"  value="{{$project->start_date_project}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project End Date</label>
                                        <input type="text" class="form-control form-control-sm"  value="{{$project->end_date_project}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                            <h5 class="card-title text-center">Trucks & Materials Estimation</h5>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Yards</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" id="yards" name="yards" placeholder="0" value="{{$truck[0]['yards']}}" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <button class="btn btn-secondary" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckImport" aria-expanded="true" aria-controls="truckImport">
                                            Truck Import
                                        </button>
                                    </p>
                                    <div class="collapse" id="truckImport">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="importDirt" name="importDirt" min="0" value="{{$truck[0]['importDirt']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Asphalt</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="importAsphalt" name="importAsphalt" min="0" value="{{$truck[0]['importAsphalt']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Aggregates</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="importAggregates" name="importAggregates" min="0" value="{{$truck[0]['importAggregates']}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Base</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="importBase" name="importBase" min="0" value="{{$truck[0]['importBase']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Gravell</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="importGravell" name="importGravell" min="0" value="{{$truck[0]['importGravell']}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                                <div class="col">
                                    <p>
                                        <button class="btn btn-secondary" style="width: 100%" type="button" data-toggle="collapse" data-target="#truckExport" aria-expanded="true" aria-controls="truckExport">
                                            Truck Export
                                        </button>
                                    </p>
                                    <div class="collapse" id="truckExport">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="exportDirt" name="exportDirt" min="0" value="{{$truck[0]['exportDirt']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Asphalt</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="exportAsphalt" name="exportAsphalt" min="0" value="{{$truck[0]['exportAsphalt']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Dirt + Rocks</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="exportDirtRock" name="exportDirtRock" min="0" value="{{$truck[0]['exportDirtRock']}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Concrete</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="exportConcrete" name="exportConcrete" min="0" value="{{$truck[0]['exportConcrete']}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size: 12px;">Mixed</label>
                                                        <input type="number" step="0.01" class="form-control form-control-sm" id="exportMixed" name="exportMixed" min="0" value="{{$truck[0]['exportMixed']}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <hr>
        
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
                                <button type="submit" class="btn btn-secondary btn-sm">Delete</button>
                            </div>
                            </fieldset>
                        </form>
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
  width: 280px;
  padding: 0 20px;
  margin: 0;
  white-space: pre-wrap;
  text-align: center;
}
</style>

    <script>

        $('input[name="phone"]').mask('+1 (000) 000-0000');
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
