<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dispatch Center</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


{{--    <script src="https://kit.fontawesome.com/8640e74f92.js" crossorigin="anonymous"></script>--}}
    {{HTML::style('css/gijgo.css')}}
    {{HTML::script('js/gijgo.js')}}

    {{--material design components--}}
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    {{--material design icons--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>

<div class="card col-md-12 col-sm-12" >
{{--    <div class="card-body">--}}

        <div class="card-header col-sm-12" >
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <a href="/dashboard/public/"><div class="btn btn-danger" ><span class="glyphicon glyphicon-chevron-left"></span>Back</div></a>
                </div>
                <div class="col-md-6 col-sm-6 text-center">
                    <div class="col-md-12 col-sm-12">
{{--                        <div class="row">--}}
                        <div class="row">
                            <div class="col" style="margin: auto">
                                <a href="/dashboard/public/date_confirm/+{{$previous}}"><svg id="i-chevron-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M20 30 L8 16 20 2" />
                                    </svg></a>
{{--                                <a href="/"><i class="fas fa-chevron-left fa-2x"></i></a>--}}
                            </div>
                            <div class="col-10">
                                <a><h2 ><strong> {{$today_f}} </strong></h2></a>
                            </div>
                            <div class="col" style="margin: auto">
                                <a href="/dashboard/public/date_confirm/+{{$next}}"><svg id="i-chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M12 30 L24 16 12 2" />
                                    </svg></a>
{{--                                <a href="/"><i class="fas fa-chevron-right fa-2x"></i></a>--}}
{{--                                {{ HTML::image('images/chevron_right.svg', 'right') }}--}}
                            </div>
                        </div>
{{--                            --}}
{{--                           --}}
{{--                           --}}
                            </div>
{{--                        </div>--}}

                </div>
                <div class="col-md-3 col-sm-3 text-right">
                    <a href="/dashboard/public/new_dispatch"><div class="btn btn-danger" ><span class="glyphicon glyphicon-chevron-left"></span>New Dispatch</div></a>
                </div>
            </div>
        </div>

{{--   DATA  PICKER  SCRIPTS TO DISPLAY CALENDAR    --}}

    <div class="text-center">

            <Button id="datepicker" class="btn btn-primary">Calendar click here</Button>

    </div>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
{{--    END DATA PICKER JAVASCRIPTS--}}

    <script>
        $(function(){
            $('#button').click(function() {
                var date= $("#datetimepicker1").data("datetimepicker").getDate();
                $.ajax({
                    url: 'date_confirm/{date}',
                    type: 'GET',
                    // data: { id: 1 },

                });
            });
        });
    </script>

        <div class="card-body">

            <hr>
            <div class="container">
                <div class="row no-gutters">

                    <div class="col-md-6 col-sm-6 col-12" >
                        <h2 class="text-center ">
                            OUT ON FIELD
                        </h2>
                        <div class="container text-center">
                            <div class="row text-center">
                                <div class="container">

                                    @foreach($out as $equip)
                                        <h3><span class="badge badge-danger"> {{$equip}}</span></h3>
                                    @endforeach
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="col-md-6 col-sm-6 col-12"  >
                        <h2 class="text-center">
                            IN YARD
                        </h2>
                        <div class="container text-center">
                            <div class="row text-center">
                                <div class="container">

                                    @foreach($inyard as $yard)
                                        <h3><span class="badge badge-secondary"> {{$yard}}</span></h3>
                                    @endforeach

                            </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-md-4 col-sm-4 col-12" >--}}
{{--                        <h2 class="text-center">--}}
{{--                            AVAILABLE--}}
{{--                        </h2>--}}
{{--                        <div class="container text-center">--}}
{{--                            <div class="row text-center">--}}
{{--                                <div class="container">--}}
{{--                                    @foreach($machin as $mach)--}}
{{--                                        @if($mach->place==3)--}}
{{--                                            <h3><span class="badge badge-success"> {{$mach->id_machinery}}</span></h3>--}}
{{--                                        @endif--}}

{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
            <br>
            <div class="container" >
                <h2 class="text-center"> EQUIPMENT TO DELIVER:</h2>
                @foreach($rentas as $renta)
                <div class="row no-gutters" >
                    @if($renta->date==$today)
                    <div class="col-sm-3">
                        {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}
                    </div>
                    <div class="col-sm-9" style="margin: auto">
                        <h3>{{$renta->maquina}}</h3>
                        <div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-12">Addres: {{$renta->delivery_site}}</div>
                                    <div class="col-md-6 col-12">Equipment: {{$renta->machinery->name}} </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6 col-12">Contact: {{$renta->clientes->Full_name}}</div>
                                    @if($renta->clientes->id_comp == null)
                                        <div class="col-md-6 col-12">Business: </div>
                                        @else
                                        <div class="col-md-6 col-12">Business: {{$renta->clientes->compañia->Name}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <br>
            <br>
            <div class="container" >

                <h2 class="text-center"> EQUIPMENT TO PICK UP:</h2>
                @foreach($rentas as $renta)
                <div class="row no-gutters" style="background-color: #dc3545;">
                    @if($renta->pick_up_date==$today)
                    <div class="col-sm-3">
                        {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}
                    </div>
                    <div class="col-sm-9" style="margin: auto">
                        <h3>{{$renta->maquina}}</h3>
                        <div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-12">Address: {{$renta->delivery_site}}</div>
                                    <div class="col-md-6 col-12">Equipment: {{$renta->machinery->name}} </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6 col-12">Contact: {{$renta->clientes->Full_name}}</div>
                                    @if($renta->clientes->id_comp == null)
                                        <div class="col">Business: </div>
                                    @else
                                    <div class="col-md-6 col-12">Business: {{$renta->clientes->compañia->Name}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                </div>
                @endforeach


            </div>

        </div>

{{--    </div>--}}

</div>
</body>
</html>
