@extends('master')
@section('title')
    <title>Edit || {{$phase->name_phase}}</title>
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
    <!-- Solo se ocupa el JS de agregar mas phases -->
    <!-- {{HTML::script('js/projects/newProject.js')}} -->
    
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

            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right">
                <a href="{{route('phase.index',$project)}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
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
                    <h5 class="card-title text-center">Edit Phase</h5>
                    <h5 class="card-title text-center">{{$project->name_project}}</h5>
                        <form action="{{ route ('phase.update',[$project,$phase]) }}" name="form1" method="POST" class="well form-horizontal" onsubmit="sub_butt.disabled = true; return true;" enctype="multipart/form-data" >
                        @csrf @method('PATCH')
                            <fieldset>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Phase Name</label>
                                            <input type="text" class="form-control form-control-sm" maxlength="100" value="{{old('phaseNameProject',$phase->name_phase)}}" id="phaseNameProject" name="phaseNameProject" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Budget</label>
                                            <input type="number" min="0" step="0.01" class="form-control form-control-sm" value="{{old('phaseBudgetProject',$phase->budget_phase)}}" id="phaseBudgetProject" name="phaseBudgetProject" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size: 12px;">Text</label>
                                    <textarea type="text" class="form-control form-control-sm" rows="3" id="phaseTextProject" name="phaseTextProject" placeholder="" required>{{$phase->text_phase}}</textarea>
                                </div>
                                
                            </div>
                            <hr>
                            <!-- Start Add more phases-->
                            <div class="rowPhases">
                            </div>
                            <!-- End Add more phases-->
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

@stop
