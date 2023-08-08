<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    {{--    {{HTML::asset('images/icons/favicon.ico')}}--}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>

            </div>
            <div class="modal-body">
                <form action="store_delivery" method="post">
                    @csrf
                    <fieldset>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Horas maquina:</label>
                        <input type="text" class="form-control" id="machinery_time" name="machinery_time" style="border-bottom-color: #1b1818">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Combustible:</label>
                        <input class="form-control" id="gas" name="gas" style="border-bottom-color: #1b1818"></input>
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



</body>
</html>
