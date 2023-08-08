@extends('master')
@section('title')
    <title>Dropzone</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Dropzone -->
    {{HTML::script('js/dropzone-5.7.0/dist/dropzone.js')}}
    {{HTML::style('css/dropzone.css')}}

    {{HTML::script('js/payroll/payrollDropzone.js')}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
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
                        <h5 class="card-title text-center">Upload Files</h5>
                        <h5 class="card-title text-center"></h5>
                        <form action="{{route('payrollFilesPost')}}" name="demoform" id="demoform" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label style="margin-bottom: 0px;">Project Start Date</label>
                                        <input type="text" id="datepicker" width="100%" name="start_date" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group date2">
                                        <label style="margin-bottom: 0px;">Project End Date</label>
                                        <input type="text" id="datepicker2" width="100%" name="end_date" required autocomplete="off">
                                    </div>
                                    <div class="form-group hideMobile date3">
                                        <label style="margin-bottom: 0px;">Project End Date</label>
                                        <input type="text" id="datepicker3" width="100%" name="end_dateF"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="dropzoneDragArea" class="dz-default dz-message dropzone dropzoneDragArea">
                                </div>
                                <div class="dropzone-previews"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-primary">Create</button>
                            </div>
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
</script>

@stop
