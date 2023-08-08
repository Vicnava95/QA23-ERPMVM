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

    <script src="js/projects/dropzone.js"></script>
 
    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}

@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{route('project.moreInfo',$project)}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
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
                        <h5 class="card-title text-center">{{$project->name_project}}</h5>
                        <form action="{{route('project.storeDrop',$project)}}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                        <input hidden type="text" value="{{$project->id}}" name="idProject" id="idProject">

                        <div class="text-center">
                            <a href="{{route('project.moreInfo',$project)}}"><div class="btn btn-secondary btn-sm drop" >Save Changes</div></a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
