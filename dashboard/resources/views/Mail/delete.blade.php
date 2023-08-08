@extends('master')
@section('title')
    <title>Delete Mail</title>
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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script> --}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <a href="{{route('infoPermit',$permitId)}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
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
                        <h5 class="card-title text-center">Delete Mail Form</h5>
                        <h6 class="card-title text-center" style="font-size: 12px;">{{$document->referenceDocumentPermit}}</h6>
                        <form action="{{route('destroyDocumentMail',[$permitId,$mail->id])}}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            @method('DELETE')
                            <fieldset>
                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Courier</label>
                                            <input type="text" class="form-control form-control-sm" id="courier" name="courier" value="{{$mail->courier}}" autocomplete="off" disabled>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Recipient's Name</label>
                                            <input type="text" class="form-control form-control-sm" id="recipientName" name="recipientName" value="{{$mail->recipientsName}}" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;"># Tracking</label>
                                            <input type="text" class="form-control form-control-sm" id="tracking" name="tracking" value="{{$mail->tracking}}" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Permit Document</label> 
                                            <input type="text" class="form-control form-control-sm" id="permitDocument" name="permitDocument" value="{{$mail->permitDocument}}" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Date Send</label> 
                                            <input type="text" id="datepicker" width="180" class="form-control form-control-sm" id="dateSend" value="{{$mail->dateSend}}" name="dateSend" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Date Received</label> 
                                            <input type="text" id="datepicker2" width="180" class="form-control form-control-sm date2" id="dateReceived" name="dateReceived" value="{{$mail->dateReceived}}" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Certified Mail</label>
                                            <div class="form-check">
                                                @if ($mail->certifiedMail == 1)
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Yes
                                                    </label>
                                                @endif 
                                            </div>
                                            <div class="form-check">
                                                @if ($mail->certifiedMail == 2)
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        No
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Certification Number</label> 
                                            <input type="text" class="form-control form-control-sm" id="certficationNumber" value="{{$mail->certificationNumber}}" name="certficationNumber" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
    <script>
        $('document').ready(function(){
            $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            });  
            $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            });
        });   
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
