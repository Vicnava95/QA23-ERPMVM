@extends('master')
@section('title')
    <title>Dispatch Center</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
@section('content')
    <!-- Action Buttons (Located on the Right top side of the screen) //////////////////////////////////////////////// -->
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4 style="font-size: 130%;"><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right">
                @if (Auth::user()->rol != 'labor')
                    <h4 style="font-size: 130%;"><a href="{{route('new_dispatch')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Dispatch">+ Dispatch</a></h4> 
                @endif
            </div>
        </div>
    </div>

    <!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container" style="margin-top: 20px; ">
        <div class="row">
            <div class="card-group" style="border:1px !important;margin-right: 10px;">
                <!--<div class="col-12">-->
                <div class="card bg-light col-md-6 col-sm-12 col-xs-12" style="margin: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$size_next}}</h5>
                        <p class="card-text" style="margin-bottom: 0px;">MACHINES GOING OUT TOMORROW</p>
                        {{--                        <span class="badge badge-warning">262D</span>--}}
                        @foreach($next_day_rent as $next_day)
                            <span class="badge badge-warning"> {{$next_day}} </span>
                        @endforeach
                    </div>
                </div>
                <div class="card bg-light col-md-6 col-sm-12 col-xs-12" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">

                        <h5 class="card-title">{{$zise_no_rents}}</h5>
                        <p class="card-text" style="margin-bottom: 0px;">MACHINES CURRENTLY ON YARD</p>

                        @foreach($inyard as $yard)
                            <span class="badge badge-warning"> {{$yard}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card bg-light col-md-6 col-sm-12 col-xs-12" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$size_rent}}</h5>
                        <p class="card-text" style="margin-bottom: 0px; ">MACHINES OUT ON FIELD</p>
                        @foreach($out as $equip)

                            <span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">{{$equip}}</span>
                        @endforeach
                    </div>
                </div>

                <div class="card bg-light col-md-6 col-sm-12 col-xs-12" style="margin: 10px; border-left: 1px solid #d9dadb;">
                    <div class="card-body text-center">
                        <h5 class="card-title">0</h5>
                        <p class="card-text" style="margin-bottom: 0px;">MACHINES DOWN/MAINTENANCE</p>
                    </div>
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>

    <script>
        var mobile = (/iphone|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
        if (mobile) {$('.card-group').hide();}
    </script>



    <!-- Today's Dispatch ////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container"  >
        <div class="row">

            <div class="card bg-light col-sm-12 col-md-12 col-lg-4" style="margin: 10px;">
                <div class="card-body"  style="font-size: 12px;">

                    <h5 class="card-title text-center">Dispatch Center</h5>
                    <div class="container">
                        <div class="row" > <!-- Start Row -->

                            <div class="col-2">
                                <ul class="pagination">
                                    <li class="page-item">
                                        {{-- <a class="page-link" href="/dashboard/public/date_confirm/+{{$previous}}" aria-label="Previous"> --}}
                                        <a class="page-link" href="/date_confirm/+{{$previous}}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-8">
                                <p class="text-center" style="font-weight: 700; line-height: 35px;">{{$today_format}}</p>
                            </div>

                            <div class="col-2">
                                <ul class="pagination">
                                    <li class="page-item">
                                        {{-- <a class="page-link" href="/dashboard/public/date_confirm/+{{$next}}" aria-label="Next"> --}}
                                        <a class="page-link" href="/date_confirm/+{{$next}}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    <hr style="margin-top: 0px; ">

                    @if (Auth::user()->rol != 'labor')
                        <div class="row text-center" style="margin-bottom: 10px;">
                            <div class="col-6">
                                <h5 style="margin-bottom: 0px;"><a href="{{route('allRentals')}}" class="badge badge-dark">All Rentals</a></h5>
                            </div>
                            <div class="col-6">
                                <h5 style="margin-bottom: 0px;"><a href="{{route('showAllRentalForms')}}" class="badge badge-dark">All Forms Submited</a></h5>
                            </div>
                        </div>
                    @endif
                    

                    <h6 class="card-title text-left">Deliveries</h6>

                    <!-- Delivery Example 1 -->
                    @foreach($rentals as $rent)
                        @if($rent->dispatch_date==$today)
                            <div class="accordion" id="accordionExample" >
                                <button class="card"  data-toggle="collapse" data-target="#collapse{{$rent->machinery->model}}" aria-expanded="true" aria-controls="collapse{{$rent->machinery->model}}" style="padding: 0px; border-bottom: 1px solid #d9dadb;">
                                    <div class="card-header" id="heading{{$rent->machinery->model}}" style="padding: 15px !important;">
                                        <dl class="row"  style="margin-bottom: -15px !important;">


                                            @switch($rent->machinery->model)
                                                @case('303E')
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/machines/303E-.jpg', '303', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('259D')
                                                <dd class="col-md-4 " style="margin-right: -20px; "> {{ HTML::image('images/machines/259D.jpg', '259', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('262D')
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/machines/259D.jpg', '262', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('232D')
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/machines/232D.jpg', '232', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('304E')
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/machines/304E.jpg', '232', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('RTSC2')
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/machines/RTSC2.jpg', '232', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @default
                                                <dd class="col-md-4 " style="margin-right: -20px;"> {{ HTML::image('images/bob_cat.png', 'default', array('style' => 'max-width: 100%;')) }}</dd>
                                            @endswitch
                                            <script>

                                                function delete_{{$rent->id}}(id_val){
                                                    var delayInMilliseconds = 1000; //1 second

                                                    var flag =1;
                                                    var id = id_val;

                                                    alertify.confirm('Delete Dispatch', 'Do you want to delete this dispatch?', function(){alertify.success('Ok');
                                                            setTimeout(function() {
                                                                /* window.location.replace('/dashboard/public/delete_dispatch/'+id+'/'+flag); */
                                                                window.location.replace('/delete_dispatch/'+id+'/'+flag);
                                                            }, delayInMilliseconds)
                                                        }
                                                        , function(){ alertify.error('Cancel')});
                                                }

                                            </script>


                                            {{--                                                <dt class="col-sm-4" style="margin-right: -20px;"> {{ HTML::image('images/machines/$rent->machinery->model.jpg', '303', array('style' => 'max-width: 100%;')) }}</dt>--}}

                                            <dd class="col-md-8" style="font-size: 16px !important;"> <a style="font-size: 12px; text-decoration: none; font-color: #000 !important; font-weight: 700;">Machine(s):</a> <span class="badge badge-warning">{{$rent->machinery->model}}</span> </br>
                                                <a style="font-size: 12px; text-decoration: none; font-color: #000 !important; font-weight: 700;">Status:</a>
                                                @if($rent->status_deliver==1)

                                                    <span onclick="changestatus{{$rent->id}}()" id="status2{{$rent->id}}" class="badge badge-success">Delivered</span>

                                                @elseif($rent->status_deliver==0)

                                                    <span onclick="changestatus{{$rent->id}}()" id="status2{{$rent->id}}" class="badge badge-secondary">Pending</span>

                                                @endif
                                            </dd>
                                        </dl>
                                    </div>

                                    <div id="collapse{{$rent->machinery->model}}" class="collapse " aria-labelledby="heading{{$rent->machinery->model}}"  data-parent="#accordionExample">

                                        <!-- Delivery Example 1 Exapanded -->
                                        <div class="container" style="border-bottom: #000000">
                                            <div class="card-body" style="padding: 10px !important;">
                                                <dl class="row" style="margin: auto">
                                                    <!-- <dt class="col-sm-4" style="margin-right: -20px;">Machine(s):</dt>
                                                    <dd class="col-sm-8" style="font-size: 16px !important;"> <span class="badge badge-warning">303E</span> </dd> -->

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Delivery Address</dt>
                                                    <dd class="col-sm-12 col-md-8">{{$rent->delivery_site}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Trip Time</dt>
                                                    <dd class="col-sm-12 col-md-8">38 Minutes from yard leaving now</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Customer</dt>
                                                    <dd class="col-sm-12 col-md-8">{{$rent->clientes->full_name}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Notes</dt>
                                                    <dd class="col-sm-12 col-md-8">{{$rent->delivery_note}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Status</dt>
                                                    <dd class="col-sm-12 col-md-8" style="font-size: 16px !important;">
                                                        @if($rent->status_deliver==1)

                                                            <span class="badge badge-success" id="status{{$rent->id}}" data-toggle="tooltip" data-placement="top" onclick="changestatus{{$rent->id}}()"  title="Click to switch">Delivered</span>

                                                        @elseif($rent->status_deliver==0)

                                                            <span class="badge badge-secondary" id="status{{$rent->id}}" data-toggle="tooltip" data-placement="top" onclick="changestatus{{$rent->id}}()"  title="Click to switch">Pending</span>

                                                        @endif
                                                    </dd>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 offset-sm-3 offset-lg-3 offset-md-3 badge badge-danger" style="font-size: 12px !important;" id={{$rent->id}}  onclick="delete_{{$rent->id}}({{$rent->id}})">Delete</div>
                                                    <br>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 offset-sm-3 offset-lg-3 offset-md-3 badge badge-info" style="font-size: 12px !important; margin-top: 10px !important;" id={{$rent->id}}  onclick="update_{{$rent->id}}({{$rent->id}})">Update Dispatch</div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function changestatus{{$rent->id}}(){
                                            var status = document.getElementById('status{{$rent->id}}');
                                            var status2 = document.getElementById('status2{{$rent->id}}');
                                            var value = status.innerHTML;
                                            var value2 = "Delivered";

                                            if(value.localeCompare(value2)==0){
                                                status.className = "badge badge-secondary";
                                                status.innerHTML="Pending";
                                                status2.className = "badge badge-secondary";
                                                status2.innerHTML="Pending";

                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                                var xhttp = new XMLHttpRequest();

                                                /* var url = "/dashboard/public/updatedelivered/{{$rent->id}}"; */
                                                var url = "/updatedelivered/{{$rent->id}}";
                                                console.log(url);
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                    }
                                                };
                                                /* xhttp.open("GET", "/dashboard/public/updatedelivered/{{$rent->id}}", true); */
                                                xhttp.open("GET", "/updatedelivered/{{$rent->id}}", true);
                                                xhttp.send();
                                                /* FIN AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                            }
                                            else{
                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                                status.className = "badge badge-success";
                                                status.innerHTML="Delivered";
                                                status2.className = "badge badge-success";
                                                status2.innerHTML="Delivered";
                                                var xhttp = new XMLHttpRequest();

                                                /* var url = "/dashboard/public/updatePending/{{$rent->id}}"; */
                                                var url = "/updatePending/{{$rent->id}}";
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {

                                                    }
                                                };
                                                /* xhttp.open("GET", "/dashboard/public/updatePending/{{$rent->id}}", true); */
                                                xhttp.open("GET", "/updatePending/{{$rent->id}}", true);
                                                xhttp.send();
                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                            }
                                        }
                                    </script>
                                </button>
                            </div> <!-- End Acordion -->
                            <script>

                                function delete_{{$rent->id}}(id_val){
                                    var delayInMilliseconds = 1000; //1 second

                                    var flag =0;
                                    var id = id_val;

                                    alertify.confirm('Delete Dispatch', 'Do you want to delete this dispatch?', function(){alertify.success('Deleted');
                                            setTimeout(function() {
                                                /* window.location.replace('/dashboard/public/delete_dispatch/'+id+'/'+flag); */
                                                window.location.replace('/delete_dispatch/'+id+'/'+flag);
                                            })
                                        }
                                        , function(){ alertify.error('Cancel')});
                                }

                            </script>
                            <script>

                                function update_{{$rent->id}}(id_val){
                                    // var delayInMilliseconds = 1000; //1 second

                                    var id = id_val;

                                    alertify.confirm('Edit Dispatch', 'Do you want to edit this dispatch?', function(){
                                            setTimeout(function() {
                                                /* window.location.replace('/dashboard/public/update/'+id); */
                                                window.location.replace('/update/'+id);
                                            })
                                        }
                                        , function(){ alertify.error('Cancel')});
                                }

                            </script>
                        @endif
                    @endforeach

                    <hr> </hr>

                    <h6 class="card-title text-left">Pick-ups</h6>

                    <!-- Pickup Example 1 -->

                    @foreach($rentals as $rent)
                        @if($rent->pick_up_date==$today)
                            <div class="accordion" id="accordionExample">
                                <button class="card"  data-toggle="collapse" data-target="#collapse{{$rent->machinery->model}}P" aria-expanded="true" aria-controls="collapse{{$rent->machinery->model}}P" style="padding: 0px; margin-bottom: 0px; border-bottom: 1px solid #d9dadb; ">
                                    <div class="card-header" id="heading{{$rent->machinery->model}}P" style="padding: 15px !important;">
                                        <dl class="row"  style="margin-bottom: -15px !important;">

                                            @switch($rent->machinery->model)
                                                @case('303E')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/303E-.jpg', '303', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('259D')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/259D.jpg', '259', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('262D')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/262D.jpg', '262', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('232D')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/232D.jpg', '232', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('304E')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/304E.jpg', '304', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @case('RTSC2')
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/machines/RTSC2.jpg', '232', array('style' => 'max-width: 100%;')) }}</dd>
                                                @break

                                                @default
                                                <dd class="col-md-4" style="margin-right: -20px;">{{ HTML::image('images/bob_cat.png', 'default', array('style' => 'max-width: 100%;')) }}</dd>
                                            @endswitch


                                            <dd class="col-sm-8" style="font-size: 16px !important;"> <a style="font-size: 12px; text-decoration: none; font-color: #000 !important; font-weight: 700;">Machine(s):</a> <span class="badge badge-warning">{{$rent->machinery->model}}</span> </br>
                                                <a style="font-size: 12px; text-decoration: none; font-color: #000 !important; font-weight: 700;">Status:</a>
                                                @if($rent->status_pickup==1)

                                                    <span onclick="changestatus_P{{$rent->id}}()" id="status2_P{{$rent->id}}" class="badge badge-success">Picked Up</span>

                                                @elseif($rent->status_pickup==0)

                                                    <span onclick="changestatus_P{{$rent->id}}()" id="status2_P{{$rent->id}}" class="badge badge-secondary">Pending</span>

                                                @endif
                                                <br>
                                                <a style="font-size: 12px; text-decoration: none; font-color: #000 !important; font-weight: 700;">Payment:</a>
                                                @if($rent->paymentStatus==0)
                                                    <span onclick="changePaymentStatusPay({{$rent->id}})" id="paymentStatus-{{$rent->id}}" class="badge badge-secondary">Pending</span>
                                                @else
                                                    <span onclick="changePaymentStatusPending({{$rent->id}})" id="paymentStatus-{{$rent->id}}" class="badge badge-success">Pay</span>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>

                                    <div id="collapse{{$rent->machinery->model}}P" class="collapse " aria-labelledby="heading{{$rent->machinery->model}}P"  data-parent="#accordionExample">

                                        <!-- Delivery Example 1 Exapanded -->
                                        <div class="container" style="border-bottom: #000000">
                                            <div class="card-body" style="padding: 10px !important;">
                                                <dl class="row"  style="margin: auto">
                                                    <!-- <dt class="col-sm-4" style="margin-right: -20px;">Machine(s):</dt>
                                                    <dd class="col-sm-8" style="font-size: 16px !important;"> <span class="badge badge-warning">303E</span> </dd> -->

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Delivery Address</dt>
                                                    <dd class="col-sm-12 col-md-8">{{$rent->delivery_site}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Trip Time</dt>
                                                    <dd class="col-sm-12 col-md-8">38 Minutes from yard leaving now</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Customer</dt>
                                                    <dd class="col-sm-8 col-md-8">{{$rent->clientes->full_name}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Notes</dt>
                                                    <dd class="col-sm-8 col-md-8">{{$rent->delivery_note}}</dd>

                                                    <dt class="col-sm-12 col-md-4" style="margin-right: -20px;">Status</dt>
                                                    <dd class="col-sm-8 col-md-8" style="font-size: 16px !important;">

                                                        @if($rent->status_pickup==1)

                                                            <span class="badge badge-success" id="status_P{{$rent->id}}" data-toggle="tooltip" data-placement="top" onclick="changestatus_P{{$rent->id}}()"  title="Click to switch">Picked Up</span>

                                                        @elseif($rent->status_pickup==0)

                                                            <span class="badge badge-secondary" id="status_P{{$rent->id}}" data-toggle="tooltip" data-placement="top" onclick="changestatus_P{{$rent->id}}()"  title="Click to switch">Pending</span>

                                                        @endif
                                                    </dd>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 offset-sm-3 offset-lg-3 offset-md-3 badge badge-danger" style="font-size: 12px !important;" id={{$rent->id}}  onclick="delete_{{$rent->id}}({{$rent->id}})"> Delete</div>

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pay" hidden>
                                                        Launch demo modal
                                                    </button>
  
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="paymentModalPay-{{$rent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Do you want to add a comment to the payment?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div id="form-first" class="form-area">
                                                                <div class="modal-body">
                                                                        <form id="formComments" action="{{route('paymentStatus',[$rent->id,1])}}">
                                                                            @method('POST')
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control form-control-sm" id="paymentCommentsModalPay" rows="5" name="paymentCommentsModalPay" maxlength="2000">{{$rent->paymentComments}}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" form="formComments" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="paymentModalPending-{{$rent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Do you want to add a comment to the pending payment?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div id="form-second" class="form-area">
                                                                <div class="modal-body">
                                                                        <form id="formComments2" action="{{route('paymentStatus',[$rent->id,0])}}">
                                                                            @method('POST')
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control form-control-sm" id="paymentCommentsModalPending" rows="5" name="paymentCommentsModalPending" maxlength="2000">{{$rent->paymentComments}}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" form="formComments2" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function changestatus_P{{$rent->id}}(){
                                            var status = document.getElementById('status_P{{$rent->id}}');
                                            var status2 = document.getElementById('status2_P{{$rent->id}}');

                                            var value = status.innerHTML;
                                            var value2 = "Pickup";

                                            if(value.localeCompare(value2)==0){
                                                status.className = "badge badge-secondary";
                                                status.innerHTML="Pending";
                                                status2.className = "badge badge-secondary";
                                                status2.innerHTML="Pending";


                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                                var xhttp = new XMLHttpRequest();

                                                /* var url = "/dashboard/public/update_pickup/{{$rent->id}}"; */
                                                var url = "/update_pickup/{{$rent->id}}";
                                                console.log(url);
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                    }
                                                };
                                                /* xhttp.open("GET", "/dashboard/public/update_pickup/{{$rent->id}}", true); */
                                                xhttp.open("GET", "/update_pickup/{{$rent->id}}", true);
                                                xhttp.send();
                                                /* FIN AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                            }
                                            else{
                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                                status.className = "badge badge-success";
                                                status.innerHTML="Pickup";
                                                status2.className = "badge badge-success";
                                                status2.innerHTML="Pickup";

                                                var xhttp = new XMLHttpRequest();

                                                /* var url = "/dashboard/public/pending_pickup/{{$rent->id}}"; */
                                                var url = "/pending_pickup/{{$rent->id}}";
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {

                                                    }
                                                };
                                                /* xhttp.open("GET", "/dashboard/public/pending_pickup/{{$rent->id}}", true); */
                                                xhttp.open("GET", "/pending_pickup/{{$rent->id}}", true);
                                                xhttp.send();
                                                /* INICIO AJAX PARA CAMBIAR ESTADO EN EL BACKEND */
                                            }
                                        }

                                        function changePaymentStatusPay(id){                                                                            
                                            $('#paymentModalPay-'+id+'').modal('show');
                                        }

                                        function changePaymentStatusPending(id){                                                                            
                                            $('#paymentModalPending-'+id+'').modal('show');
                                        }
                                    </script>
                                </button>
                            </div> <!-- End Acordion -->
                            <script>

                                function delete_{{$rent->id}}(id_val){
                                    var delayInMilliseconds = 1000; //1 second

                                    var flag =0;
                                    var id = id_val;

                                    alertify.confirm('Delete Dispatch', 'Do you want to delete this dispatch?', function(){alertify.success('Deleted');
                                            setTimeout(function() {
                                                /* window.location.replace('/dashboard/public/delete_dispatch/'+id+'/'+flag); */
                                                window.location.replace('/delete_dispatch/'+id+'/'+flag);
                                            })
                                        }
                                        , function(){ alertify.error('Cancel')});
                                }

                            </script>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <style>
        span{
            cursor: pointer;
        }
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




@stop
