<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Machinery Rent</title>

</head>
<body>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}


{{HTML::style('css/calendar/gijgo.css')}}
{{HTML::script('js/calendar/gijgo.js')}}


{{HTML::style('css/main.css')}}


{{--BOWER CSS--}}
{{HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css')}}
{{HTML::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}

{{--BOWER SCRIPTS--}}
{{HTML::script('bower_components/jquery/dist/jquery.min.js')}}
{{HTML::script('bower_components/moment/min/moment.min.js')}}
{{HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js')}}
{{HTML::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHrRpn0FGYLAZ0bi1UTHPCmGClIZo8diA&libraries=places&callback=initAutocomplete" async defer></script>
<div class="container">

    <form class="well form-horizontal" action='save' method="post"  id="contact_form">
 @csrf
<fieldset>

<!-- Form Name -->
    <a href="/dispatch_center"><div class="btn btn-danger" >Back</div></a>
<center><h2><b>Machinery Rent</b></h2></center><br>
    <br>


<!-- Text input-->
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Full Name</label>
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="full_name"  class="form-control"  type="text" required>
    </div>
  </div>
</div>

<!-- Text input-->


    <div class="form-group">
        <label class="col-md-4 control-label">Company Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                <input  name="compa"  class="form-control"  type="text">
            </div>
        </div>
    </div>

{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label" >ID Number</label>--}}
{{--        <div class="col-md-4 inputGroupContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
{{--                <input name="cli_id" placeholder="Client ID" class="form-control"  type="text"  required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="form-group">
        <label class="col-md-4 control-label">Client Phone Number</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <input  name="phone"  class="form-control"  type="text">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Client Email</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input  name="email"  class="form-control"  type="email" >
            </div>
        </div>
    </div>

{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label" >Client Last Name</label>--}}
{{--        <div class="col-md-4 inputGroupContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>--}}
{{--                <input name="last_name" placeholder="Last Name" class="form-control"  type="text" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--Machinery--}}

  <div class="form-group">
  <label class="col-md-4 control-label">Equipment</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="machinery" class="form-control selectpicker" required>
      <option value="">Select your Equipment</option>
        @foreach($equip as $bobcat)
            <option> {{ $bobcat -> name }} </option>

{{--            <option>Skid Steer Loader 232-D</option>--}}
{{--            <option>Skid Steer Loader 262-D</option>--}}
        @endforeach

    </select>
  </div>
</div>
</div>
{{--Attachment--}}
{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label">Attachment</label>--}}
{{--        <div class="col-md-4 selectContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>--}}
{{--                <select name="attachment" class="form-control selectpicker" required>--}}
{{--                    <option value="">Select your Attachment</option>--}}
{{--                    <option>Pala 1</option>--}}
{{--                    <option>Pala 2</option>--}}
{{--                    <option>Pala 3</option>--}}
{{--                    <option>Pala 4</option>--}}
{{--                    <option>Taladro 1</option>--}}
{{--                    <option>Taladro 2</option>--}}

{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Address</label>
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
{{--  <input  name="address_1" placeholder="Address 1" class="form-control"  type="text" required>--}}
      <div id="locationField">
          <input name="address_1" id="autocomplete"  onFocus="geolocate()" type="text" class="form-control" required/>
      </div>

  </div>
  </div>
</div>

{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label">Address 2</label>--}}
{{--        <div class="col-md-4 inputGroupContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>--}}
{{--                <input  name="address_2" placeholder="Address 2" class="form-control"  type="text" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label">City</label>--}}
{{--        <div class="col-md-4 inputGroupContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>--}}
{{--                <input  name="city" placeholder="City" class="form-control"  type="text" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--Attachment--}}
{{--    <div class="form-group">--}}
{{--        <label class="col-md-4 control-label">State</label>--}}
{{--        <div class="col-md-4 selectContainer">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>--}}
{{--                <select name="state" class="form-control selectpicker" required>--}}
{{--                    <option value="">Select your State</option>--}}
{{--                    <option>State1</option>--}}
{{--                    <option>State2</option>--}}
{{--                    <option>State3</option>--}}
{{--                    <option>State4</option>--}}
{{--                    <option>State5</option>--}}
{{--                    <option>State6</option>--}}

{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<!-- Text input-->


<!-- Text input-->



{{--    <div class="container">--}}
        <div class="form-group">

            <label class="col-md-4 control-label" >Start Date</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <span class="input-group-addon">
                        <span><i class="glyphicon glyphicon-calendar"></i></span>
                        </span>
                        <input type='text' class="form-control input-group-addon" name="start_date" style="background-color: #ffffff"  required>
                    </div>
                </div>

            </div>
        </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });

                    // $("#datetimepicker1").on("dp.change", function (e) {
                    //     $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                    // });

                });

            </script>

        <div class="form-group">
            <label class="col-md-4 control-label" >Pick up Date</label>
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">

                    <div class='input-group date' id='datetimepicker2'>
                        <span class="input-group-addon">
                        <span><i class="glyphicon glyphicon-calendar"></i></span>
                        </span>
                        <input type='text' class="form-control input-group-addon" name="pick_up_date" style="background-color: #ffffff" required>
                    </div>

                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker2').datetimepicker({
                format: 'MM-DD-YYYY'
            });
            // $("#datetimepicker2").on("dp.change", function (e) {
            //     $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
            // });



        });
    </script>

{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            $('#datetimepicker1').datetimepicker();--}}

{{--            $("#datetimepicker1").on("dp.change", function (e) {--}}
{{--                $('#datetimepicker2').data("DateTimePicker").minDate(e.date);--}}
{{--            });--}}
{{--            $("#datetimepicker2").on("dp.change", function (e) {--}}
{{--                $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    </div>--}}

{{--    driver   --}}

{{--        <div class="form-group">--}}
{{--            <label class="col-md-4 control-label">Driver</label>--}}
{{--            <div class="col-md-4 selectContainer">--}}
{{--                <div class="input-group">--}}
{{--                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>--}}
{{--                    <select name="driver" class="form-control selectpicker" required>--}}
{{--                        <option value="">Select your Driver</option>--}}
{{--                        <option>Marvin</option>--}}
{{--                        <option>Driver 1</option>--}}


{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

<!-- Text input-->


<!-- Select Basic -->
{{--            <div class="form-group">--}}
{{--                <label class="col-md-4 control-label">Operator</label>--}}
{{--                <div class="col-md-4 inputGroupContainer">--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="material-switch ">--}}
{{--                            <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"/>--}}
{{--                            <label style="margin-left: 35px; margin-top: 20px;" for="someSwitchOptionPrimary" class="label-primary "></label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--            <div class="form-group">--}}
{{--                <label class="col-md-4 control-label">Rental Cost</label>--}}
{{--                <div class="col-md-4 inputGroupContainer">--}}
{{--                    <div class="input-group">--}}
{{--                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>--}}
{{--                        <input  name="rental_cost"  class="form-control"  type="text" required>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}




{{--        <p>{{$users}}</p>--}}


<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->

    <script>$(document).ready(function() {
        $('#contact_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                            stringLength: {
                            min: 2,
                        },
                            notEmpty: {
                            message: 'Please enter your First Name'
                        }
                    }
                },
                 last_name: {
                    validators: {
                         stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Please enter your Last Name'
                        }
                    }
                },
                 user_name: {
                    validators: {
                         stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Please enter your Username'
                        }
                    }
                },
                 user_password: {
                    validators: {
                         stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Please enter your Password'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                         stringLength: {
                            min: 8,
                        },
                        notEmpty: {
                            message: 'Please confirm your Password'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Email Address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid Email Address'
                        }
                    }
                },
                contact_no: {
                    validators: {
                      stringLength: {
                            min: 12,
                            max: 12,
                        notEmpty: {
                            message: 'Please enter your Contact No.'
                         }
                    }
                },
                 department: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your Department/Office'
                        }
                    }
                },
                    }
                }
            })
            .on('success.form.bv', function(e) {
                $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
    });</script>

    <style>#success_message{ display: none;}</style>
</body>
</html>
