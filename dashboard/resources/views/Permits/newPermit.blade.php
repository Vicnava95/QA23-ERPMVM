@extends('master')
@section('title')
    <title>New Ticket</title>
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
                        <h5 class="card-title text-center">New Permit Form</h5>
                        <form action="{{ route ('ticketStore') }}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
    
                                            <div class="form-group">
                                                <label class="labelTitle">Project Name*</label>
                                                <input type="text" class="form-control form-control-sm" id="searchProject" name="nameProject" autocomplete="off" required>
                                                <div id="projectList">
                                                </div>
                                                <input type="text" class="form-control form-control-sm" id="idProject" name="idProject" autocomplete="off" required hidden>
                                            </div>
    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Services</label> 
                                            <div class="showServices" id="showServices">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Client Name*</label>
                                            <input type="text" class="form-control form-control-sm" id="searchClient" autocomplete="off" required>
                                            <div id="clientList">
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id="idClient" name="idClient" autocomplete="off" required hidden>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6" style="margin-bottom: 16px;">
                                        <label class="labelTitle">Project Stage*</label> 
                                        <select class="form-control" id="permitStage" name="permitStage" style="height: 37px;">
                                                @foreach($permitStages as $permitStage)
                                                <option value="{{ $permitStage->id}}">{{ $permitStage->namePermitStage}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div id="showInfo"></div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Permit Name <span class="badge badgeERP" id="showCollapsePhases" role="button" style="font-size: 10px; cursor: pointer;" href="#" data-toggle="collapse" data-target="#collapseFields" aria-expanded="false" aria-controls="collapseFields">Add Another</span></label>
                                            <input type="text" class="form-control form-control-sm" id="permitName" name="permitName" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Permit Number</label>
                                            <input type="text" class="form-control form-control-sm" id="permitNumber1" name="permitNumber1" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse" id="collapseFields">
                                    <div class="row"> 
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label class="labelTitle">Second Permit Name</label>
                                                <input type="text" class="form-control form-control-sm" id="permitName2" name="permitName2" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                <label class="labelTitle">Second Permit Number</label>
                                                <input type="text" class="form-control form-control-sm" id="permitNumber2" name="permitNumber2" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Contact Inspector / Technician</label>
                                            <input type="text" class="form-control form-control-sm" id="contactName" name="contactName" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Contact Phone</label>
                                            <input type="text" class="form-control form-control-sm" id="contactPhone" name="contactPhone" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Contact Email</label>
                                            <input type="email" class="form-control form-control-sm" id="contactEmail" name="contactEmail" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">City</label>
                                            <input type="text" class="form-control form-control-sm" id="cityPermit" name="cityPermit" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="labelTitle">Document Dropoff</label>
                                            <input type="text" class="form-control form-control-sm" id="documentDropoff" name="documentDropoff" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6" style="margin-bottom: 10px;">
                                        <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseInspector" role="button" aria-expanded="false" aria-controls="collapseInspector">
                                            Add Inspector Information
                                        </a>
                                        <div class="collapse" id="collapseInspector">
                                            <div class="form-group">
                                                <label class="labelTitle">Inspector Name</label>
                                                <input type="text" class="form-control form-control-sm" id="inspectorName" name="inspectorName" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Inspector Phone</label>
                                                <input type="text" class="form-control form-control-sm" id="inspectorPhone" name="inspectorPhone" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Inspector Company</label>
                                                <input type="text" class="form-control form-control-sm" id="inspectorCompany" name="inspectorCompany" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Inspector Email</label>
                                                <input type="email" class="form-control form-control-sm" id="inspectorEmail" name="inspectorEmail" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <a class="badge badgeERP" style="margin-bottom: 10px;" data-toggle="collapse" href="#collapseSubcontractor" role="button" aria-expanded="false" aria-controls="collapseSubcontractor">
                                            Add Subcontractor Information
                                        </a>
                                        <div class="collapse" id="collapseSubcontractor">
                                            <div class="form-group">
                                                <label class="labelTitle">Subcontractor Name</label>
                                                <input type="text" class="form-control form-control-sm" id="subcontractorName" name="subcontractorName" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Subcontractor Phone</label>
                                                <input type="text" class="form-control form-control-sm" id="subcontractorPhone" name="subcontractorPhone" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Subcontractor Company</label>
                                                <input type="text" class="form-control form-control-sm" id="subcontractorCompany" name="subcontractorCompany" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="labelTitle">Subcontractor Email</label>
                                                <input type="email" class="form-control form-control-sm" id="subcontractorEmail" name="subcontractorEmail" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="labelTitle">Coments</label>
                                            <textarea class="form-control form-control-sm" id="coments" rows="5" name="coments" maxlength="250"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <br>

                            <div class="text-center">
                                <button type="submit" id="sub_butt" class="btn badgeERP btn-sm">Submit Ticket</button>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>

    <style>
    .badgeERP{
        background-color: black;
        color: #e4a627;
        text-decoration: none;
    }
    .badgeERP:hover{
        background-color: #e4a627;
        color: black;
        text-decoration: none;
    }
    .labelTitle{
        font-size: 12px;
    }

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
    $('input[name="inspectorPhone"]').mask('+1 (000) 000-0000');
    $('input[name="subcontractorPhone"]').mask('+1 (000) 000-0000');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
