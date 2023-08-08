@extends('master')
@section('title')
    <title>Dropzone</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Dropzone -->
    {{HTML::script('js/dropzone-5.7.0/dist/dropzone.js')}}
    {{HTML::style('css/dropzone.css')}}

    {{HTML::script('js/permit/docQuoteInformation.js')}}

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
                        @switch($value)
                            @case(1)
                                <h5 class="card-title text-center"><b>Estimation/Jobber</b></h5>
                            @break
                            @case(2)
                                <h5 class="card-title text-center"><b>Field Documents</b></h5>
                            @break
                            @case(3)
                                <h5 class="card-title text-center"><b>Project In-Site List</b></h5>
                            @break
                            @case(4)
                                <h5 class="card-title text-center"><b>Receipts</b></h5>
                            @break
                            @case(5)
                                <h5 class="card-title text-center"><b>Permits</b></h5>
                            @break
                            @case(6)
                                <h5 class="card-title text-center"><b>Business License</b></h5>
                            @break
                            @case(7)
                                <h5 class="card-title text-center"><b>City Inspections</b></h5>
                            @break
                            @case(8)
                                <h5 class="card-title text-center"><b>Jobber Quote</b></h5>
                            @break
                            @case(9)
                                <h5 class="card-title text-center"><b>Site Plan</b></h5>
                            @break
                            @case(10)
                                <h5 class="card-title text-center"><b>Others</b></h5>
                            @break
                            @case(11)
                                <h5 class="card-title text-center"><b>Covenant Agreement</b></h5>
                            @break
                        
                            @default
                                
                        @endswitch
                        <h5 class="card-title text-center">{{$project->name_project}}</h5>
                        <form action="{{route('docDropzoneQuoteInformationStore', [$permitTicket,$value])}}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" id="prueba1"/>
                            </div>
                            <input hidden type="text" value="{{$permitTicket->id}}" name="idProject" id="idProject">
                        </form>
                        <div class="text-center">
                            <a href="{{url()->previous()}}"><div class="btn btn-secondary btn-sm drop" >Save Changes</div></a>
                        </div>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@stop
