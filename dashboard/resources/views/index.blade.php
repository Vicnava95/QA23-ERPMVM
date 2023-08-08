@extends('master')
    @section('title')
        <title>Dashboard</title>
    @stop



    @section('content')
<br>
<br>




{{--    <div class="col-sm-3">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title text-center">Project Management</h5>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    
{{--    <div class="col-sm-3">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title text-center">Square Invoicing</h5>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{----------------------------------------------------------------------------------ROW 2---------------------------------------------------------------}}

{{--<div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title text-center">Truck Management</h5>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title text-center">Contracts</h5>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title text-center">Fleet Management</h5>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    {{ HTML::image('images/bob_cat.png', 'bob_cat', array('class' => 'card-img')) }}--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title text-center">Customers</h5>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- Calculator code -->
<div class="row" style="width: 100vw;">
    <div class="col-md-6"></div>
    <div class="col-md-6 calc">
        <div class="card-view">
            <div class="top-card">
                <h5 id="value">Enter the values</h5>
            </div>
            <br />
            <label style="margin-top:10px;">Length</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control numeric" placeholder="Enter length" id="length">
                </div>
                <div class="col-md-6">
                    <select id="selectLength" class="form-control">
                        <option value="">Feets</option>
                        <option value="">Inches</option>
                    </select>
                </div>
            </div>
            <br />
            <label>Width</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control numeric" placeholder="Enter width" id="width">
                </div>
                <div class="col-md-6">
                    <select id="selectWidth" class="form-control">
                        <option value="">Feets</option>
                        <option value="">Inches</option>
                    </select>
                </div>
            </div>
            <br />
            <label>Height</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control numeric" placeholder="Enter height" id="height">
                </div>
                <div class="col-md-6">
                    <select id="selectHeight" class="form-control">
                        <option value="">Feets</option>
                        <option value="">Inches</option>
                    </select>
                </div>
            </div>

            <br />
            <label>Percent</label>
            <input type="text" class="form-control numeric" placeholder="Enter percent" id="percent">
            <br>
            <input type="button" class="btn btn-dark form-control" value="Calculate" id="calculate">
        </div>
    </div>
</div>

<style>
    .calc {
        display: flex;
        align-items: center;
        justify-items: center;
        flex-direction: column;
    }

    .card-view {
        margin: auto;
        padding: 30px;
        width: 80vw;
        max-width: 400px;
        min-width: 280px;

        border-radius: 10px;

        box-shadow: 0px 0px 1rem rgba(0, 0, 0, 0.3);
    }

    .card-view input[type=text],
    #selectWidth,
    #selectHeight,
    #selectLength {
        border-radius: 3px;
        height: 40px;

        font-size: 13px;
        font-family: sans-serif;

        background-color: white;
        border-color: gray;
    }

    .card-view input[type=text]:focus {
        outline: none;
        border: 2px solid goldenrod;
        box-shadow: 0px 0px 5px rgba(178, 139, 55, 0.5);
    }

    .top-card {
        position: absolute;
        width: 80vw;
        max-width: 400px;
        min-width: 280px;
        height: 60px;

        margin-left: -30px;
        top: -10px;

        background: -webkit-linear-gradient(0deg, #545E75, #444E64, #393F4B);
        background: -o-linear-gradient(0deg, #545E75, #444E64, #393F4B);
        background: -moz-linear-gradient(0deg, #545E75, #444E64, #393F4B);
        background: linear-gradient(0deg, #545E75, #444E64, #393F4B);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

        display: flex;
        align-items: center;
        justify-items: center;
        flex-direction: column;
    }

    .top-card h5 {
        width: 70vw;
        max-width: 400px;
        min-width: 260px;

        color: white;
        padding-top: 20px;

        font-size: 14px;
        font-weight: 500;
        font-family: sans-serif;
        text-align: center;
    }
</style>
<script>
    $(document).ready(function() {
        $('#calculate').click(function() {
            //- Needed vars
            var length = $('#length').val();
            var width = $('#width').val();
            var height = $('#height').val();
            var percent = $('#percent').val();
            var truckNumber         = 0;
            var percentValue        = 0.0;
            var volumeWithPercent   = 0.0;


            if (valuesValidation(length, width, height, percent)) {
                //- Validating the magnitude of the measurements
                //- Length select
                if ($("#selectLength").prop('selectedIndex') == 1) {
                    length = convertToFeets(length);
                }

                //- Width select
                if ($("#selectWidth").prop('selectedIndex') == 1) {
                    width = convertToFeets(width);
                }

                //- Height select
                if ($("#selectHeight").prop('selectedIndex') == 1) {
                    height = convertToFeets(height);
                }

                //- Converting to yards the feets values
                lengthYds = convertFtToYds(length);
                widthYds = convertFtToYds(width);
                heightYds = convertFtToYds(height);

                //- Calculating the volume
                volume = getCubicYds(lengthYds, widthYds, heightYds);

                //- Calculating the percent
                percentValue = getPercent(volume, percent);

                //- Calculating volume + percent margin
                volumeWithPercent = getPercent(volume, percent);
                
                //- Calculating the truckNumber
                truckNumber = getTruckNumber(volumeWithPercent);

                //- Formating the response
                response = '<strong>'+ volume.toFixed(2) + '</strong> cu yds, ';
                response += ' with '+ percent +'%: <strong>'+ volumeWithPercent + '</strong> , <strong>';
                response += truckNumber + '</strong> trucks.';

                //- Show the response
                $('#value').html(response);
            } else {
                $('#value').text('Check the entered values');
            }

        });
    });

    let inchToFeetVal = 0.0833333;
    let feetToYds = 0.333333;

    //- Convert inches to feets
    let convertToFeets = (inches) => {
        return inches * inchToFeetVal;
    }

    //- Convert feets to yards
    let convertFtToYds = (feets) => {
        return feets * feetToYds;
    }

    //- Volume function
    let getCubicYds = (length, width, height) => {
        return (length * (width * height));
    }

    //- TruckNumber function
    let getTruckNumber = (volume) => {
        //- Needed var
        var decimalNumber = volume / 10;
        var intNumber = parseInt(decimalNumber.toFixed());
        var truckNumber;

        //- Calculating the truck number
        if (decimalNumber > intNumber && decimalNumber < (intNumber + 1)) {
            truckNumber = intNumber + 1;
        } else {
            truckNumber = intNumber;
        }

        return truckNumber;
    }

    //- Percent calc function
    let getPercent = (volume, percent) => {
        return (volume * (1 + (percent / 100))).toFixed(2);
    }

    let valuesValidation = (length, width, height, percent) => {
        var validation = true;

        //- Numeric values
        if (isNaN(length) || isNaN(width) || isNaN(height) || isNaN(percent)) {
            validation = false;
        } else if (length <= 0 || width <= 0 || height <= 0 || percent<0) { //- >= 0
            validation = false;
        }

        return validation;
    }
</script>
@stop

