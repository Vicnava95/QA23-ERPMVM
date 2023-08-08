@extends('master')
@section('title')
    <title>Delete Ticket: {{$permitTicket->id}}</title>
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
    <script src="js/permit/newPermit.js"></script>
 
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> --}}

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
                        <h5 class="card-title text-center"><b>Are you sure to delete? <br> {{$permitTicket->nameTicket}}</b></h5>
                        <form action="{{ route ('destroyPermit',$permitTicket) }}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf @method('DELETE')
                            <fieldset>

                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
    
                                            <div class="form-group">
                                                <h6><b>Project Name</b></h6>
                                                <h6>{{$project->name_project}}</h6>
                                            </div>
    
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Services</b></h6> 
                                            @foreach ($services as $service )
                                                <h6>{{$service->name_service}}</h6>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row"> 
                                    <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <h6 style="text-align: center;"><b>Client Info</b></h6>
                                        <div class="card border-light mb-12">
                                            <div class="card-body text-dark">
                                                @if ($client != null)
                                                    <h6 class="card-title">{{$client->nameClient}}</h6>
                                                    <h6>Email: {{$client->emailClient}}</h6>
                                                    <h6>Phone:{{$client->phoneClient}}</h6>
                                                @else
                                                    <h6 class="card-title">Null</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Permit Name</b></h6> 
                                            <h6>{{$permitTicket->nameTicket}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Permit Number</b></h6> 
                                            <h6>{{$permitTicket->numberPermit1}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <h6><b>City</b></h6> 
                                            <h6>{{$permitTicket->cityPermit}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <h6><b>Document Dropoff</b></h6> 
                                            <h6>{{$permitTicket->documentDropoff}}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Contact Name</b></h6> 
                                            <h6>{{$permitTicket->contactNameTicket}}</h6> 
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Conctact Phone</b></h6> 
                                            <h6>{{$permitTicket->contactPhoneTicket}}</h6> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <h6><b>Contact Email</b></h6> 
                                            <h6>{{$permitTicket->contactEmailTicket}}</h6> 
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Delete Permit</button>
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

    $('#datepicker').on('change',function(){
        $('.date2').show();
        //alert("prueba");
        //$('#datepicker2').datepicker('destroy');
        var stringdia = $('#datepicker').val();
        //console.log(stringdia)
        $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        minDate: stringdia
    }).val(stringdia);
    });

    $('input[name="contactPhone"]').mask('+1 (000) 000-0000');
    </script>
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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
