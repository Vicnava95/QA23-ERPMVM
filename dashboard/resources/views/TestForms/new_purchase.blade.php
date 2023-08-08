@extends('master')
@section('title')
    <title>New Purchase</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

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
                <a href="/dashboard"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="card bg-light col-md-4" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">New Purchase Form</h5>
                        <form action='/dashboard/public/save' method="post" class="well form-horizontal" onsubmit="sub_butt.disabled = true; return true;" >
                            @csrf
                            <fieldset>
                            <div class="form-group">
                                <label style="font-size: 12px;">Project Name</label><br>
                                <input class="form-control form-control-sm" type="searchP"  placeholder="&#xf002 Search Project" id="searchProject" >
                            </div>

                            

                            <div class="form-group">
                                <label style="font-size: 12px;">Category</label> 
                                <select class="form-control" id="categoryPurchase" style="font-size: 12px;" name="categoryPurchase">
                                        <option value="volvo">Tools & Materials</option>
                                        <option value="saab"> Subcontractor</option>
                                        <option value="mercedes"> Aggregates Import</option>
                                        <option value="audi">Material Export</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12px;">Phase</label> 
                                <select class="form-control" id="phasePurchase" style="font-size: 12px;" name="phasePurchase">
                                        <option value="volvo">Phase 1</option>
                                        <option value="saab"> Phase 2</option>
                                        <option value="mercedes"> Phase 3</option>
                                        <option value="audi">Phase 4</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="descriptionPurchase" rows="3" name="descriptionPurchase"></textarea>
                            </div>


                            <div class="form-group">
                                <label style="font-size: 12px;">Amount</label>
                                <input type="text" class="form-control form-control-sm" id="amountPurchase" name="amountPurchase" placeholder="$0.00">
                            </div>

                            <div class="form-group">
                            <label style="font-size: 12px;">Picture</label><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btnfile">Upload a file</button>
                                    <input type="file" name="myfile" />
                                </div>
                            </div>
                            <hr>

                            <div class="text-center">
                                <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit Dispatch</button>
                            </div>
                            </fieldset>

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
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',

        });
    </script>

    <script>

        $('input[name="phone"]').mask('+1 (000) 000-0000');
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
