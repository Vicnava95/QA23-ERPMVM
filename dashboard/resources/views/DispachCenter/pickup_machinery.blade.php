<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    {{--    {{HTML::asset('images/icons/favicon.ico')}}--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    {{HTML::style('vendor/bootstrap/css/bootstrap.min.css')}}
    {{HTML::style('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}
    {{HTML::style('vendor/animate/animate.css')}}
    {{HTML::style('vendor/select2/select2.min.css')}}
    {{HTML::style('vendor/perfect-scrollbar/perfect-scrollbar.css')}}
    {{HTML::style('css/util.css')}}
    {{HTML::style('css/main.css')}}
    {{HTML::style('css/main.css')}}




</head>
<body>
<div class="container mt-3">
    <h2>Dynamic Tabs</h2>
    <br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#home">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#menu1">Menu 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#menu2">Menu 2</a>
        </li>
    </ul>
{{--  ****************************************************************************  PRIMER TAB ***************************************************************    --}}
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table">

                        <div class="row header">
                            <div class="cell">
                                Maquina
                            </div>
                            <div class="cell" style="text: center">
                                Cliente
                            </div>
                            <div class="cell">
                                Email
                            </div>
                            <div class="cell" style="text: center">
                                Phone Number
                            </div>
                            <div class="cell" style="text: center">
                                Email
                            </div>

                        </div>


                        <div id="accordion">
{{--                            <div class="row">--}}
                                <div class="row " >
                                    <div class="col-md-12">
                                        <div class="card">
                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">

                                <div class="cell" data-title="Maquina" >
                                    Bobcat 202
                                </div>

                                <div class="cell" data-title="Cliente">
                                    lol
                                </div>
                                <div class="cell" data-title="Job Title">
                                    lol
                                </div>
                                <div class="cell" data-title="Location">
                                    lol
                                </div>
                                <div class="cell" data-title="Location">
                                    lol
                                </div>
                                    </a>
                                    </div>


                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>
                                </div>
                                    </div>
                                </div>
{{--                            </div>--}}
                        </div>
                            {{--                        @foreach($rents as $renta)--}}
                        </div>
                    </div>
                </div>
{{--                        @endforeach--}}

                    </div>
{{--  ****************************************************************************  SEGUNDO TAB ***************************************************************    --}}
        <div id="menu1" class="container tab-pane fade"><br>
            <h3>Menu 1</h3>
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table">

                        <div class="row header">
                            <div class="cell">
                                Maquina
                            </div>
                            <div class="cell" style="text: center">
                                Cliente
                            </div>
                            <div class="cell">
                                Email
                            </div>
                            <div class="cell" style="text: center">
                                Phone Number
                            </div>
                            <div class="cell" style="text: center">
                                Email
                            </div>

                        </div>
                        @foreach($deliver as $deliv)
                        <div class="row btn btn-primary clickable" data-toggle="modal" data-target="#staticBackdrop" >
                            <div class="cell" data-title="Maquina" >

                                {{$deliv->Pick_up_time}}
                            </div>

                            <div class="cell" data-title="Cliente">
                                {{$deliv->Machine_time}}
                            </div>
                            <div class="cell" data-title="Job Title">
                                {{$deliv->rentas->driver}}
                            </div>
                            <div class="cell" data-title="Location">
                                {{$deliv->id_Entrega}}
                            </div>
                            <div class="cell" data-title="Location">
                                lol
                            </div>

                        </div>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>
        <div id="menu2" class="container tab-pane fade"><br>
            <div>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pick-up Machinery</h5>

                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Horas maquina:</label>
                                        <input type="text" class="form-control" id="machinery_time_pickup" name="machinery_time_pickup" style="border-bottom-color: #1b1818">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Combustible:</label>
                                        <input class="form-control" id="gas_pickup" name="gas_pickup" style="border-bottom-color: #1b1818"></input>
                                    </div>
                                    <div class="form-group">

                                        <button class="btn btn-primary clickable" type="submit">Entregar</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{--                            <h5>Popover in a modal</h5>--}}
                            <button class="btn btn-primary clickable"  >Notificar entrega</button>
                            <button class="btn btn-primary clickable">Entregar</button>
                            <hr>
                            <h5>Tooltips in a modal</h5>
                            <p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="Tooltip">that link</a> have tooltips on hover.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div>

<script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });
</script>

            <!--===============================================================================================-->
            <script src="C:/Users/josep/php_proyect/mvmplatform/MVM/resources/vendor/jquery/jquery-3.2.1.min.js"></script>
            <!--===============================================================================================-->
            <script src="C:/Users/josep/php_proyect/mvmplatform/MVM/resources/vendor/bootstrap/js/popper.js"></script>
            <script src="C:/Users/josep/php_proyect/mvmplatform/MVM/resources/vendor/bootstrap/js/bootstrap.min.js"></script>
            <!--===============================================================================================-->
            <script src="C:/Users/josep/php_proyect/mvmplatform/MVM/resources/vendor/select2/select2.min.js"></script>
            <!--===============================================================================================-->
            <script src="C:/Users/josep/php_proyect/mvmplatform/MVM/resources/js/main.js"></script>

            <script>
                // register modal component
                Vue.component('modal', {
                    template: '#modal-template'
                })

                // start app
                new Vue({
                    el: '#app',
                    data: {
                        showModal: false
                    }
                })
            </script>



            <style>
                .modal-mask {
                    position: fixed;
                    z-index: 9998;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, .5);
                    display: table;
                    transition: opacity .3s ease;
                }

                .modal-wrapper {
                    display: table-cell;
                    vertical-align: middle;
                }

                .modal-container {
                    width: 300px;
                    margin: 0px auto;
                    padding: 20px 30px;
                    background-color: #fff;
                    border-radius: 2px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
                    transition: all .3s ease;
                    font-family: Helvetica, Arial, sans-serif;
                }

                .modal-header h3 {
                    margin-top: 0;
                    color: #42b983;
                }

                .modal-body {
                    margin: 20px 0;
                }

                .modal-default-button {
                    float: right;
                }

                /*
                 * The following styles are auto-applied to elements with
                 * transition="modal" when their visibility is toggled
                 * by Vue.js.
                 *
                 * You can easily play with the modal transition by editing
                 * these styles.
                 */

                .modal-enter {
                    opacity: 0;
                }

                .modal-leave-active {
                    opacity: 0;
                }

                .modal-enter .modal-container,
                .modal-leave-active .modal-container {
                    -webkit-transform: scale(1.1);
                    transform: scale(1.1);
                }

            </style>
</body>
</html>
