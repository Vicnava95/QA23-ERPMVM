@extends('master')
@section('title')
    <title>Delete Client</title>
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
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col text-right">
                <a href="{{route('clientsweb')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
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
                        <h5 class="card-title text-center">Delete Client</h5>
                        <form action="{{ route ('clientwebDestroy',$client) }}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf @method('DELETE')
                            <fieldset>
                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Client Name*</label>
                                            <input type="text" class="form-control form-control-sm" id="nameClient" name="nameClient" value="{{old('nameClient',$client->nameClient)}}" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Email</label>
                                            <input type="email" class="form-control form-control-sm" id="emailClient" name="emailClient" value="{{old('emailClient',$client->emailClient)}}" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Address</label>
                                            <div id="locationField" >
                                                <input type="text" class="form-control form-control-sm" id="autocomplete" onFocus="geolocate()" name="addressClient" value="{{old('addressClient',$client->addressClient)}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Phone</label> 
                                            <input type="text" class="form-control form-control-sm" id="phoneClient" name="phoneClient" value="{{old('phoneClient',$client->phoneClient)}}" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Delete Client</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
    <script>
        $('input[name="phoneClient"]').mask('+1 (000) 000-0000');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
