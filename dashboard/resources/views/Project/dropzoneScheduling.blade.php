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

    {{HTML::script('js/projects/dropzoneToDo.js')}}

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <a href="{{route('project.moreInfo',$idProject)}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
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
                        <h5 class="card-title text-center">{{$timeLine->timeLineTitle}}</h5>
                        <h6 class="card-title text-center">{{$timeLine->timeLineComment}}</h6>
                        <form action="{{route('dropzoneUploadToDoImage', $timeLine)}}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" id="prueba1"/>
                            </div>
                            <input hidden type="text" value="{{$timeLine->id}}" name="idProject" id="idProject">
                        </form>
                        <div class="text-center">
                            <a href="{{route('project.moreInfo',$idProject)}}"><div class="btn btn-secondary btn-sm drop" >Save Changes</div></a>
                        </div>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>

@stop
