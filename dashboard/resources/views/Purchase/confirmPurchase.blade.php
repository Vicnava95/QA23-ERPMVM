@extends('master')
@section('title')
    <title>Delete || {{$purchase->projects->name_project}}</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - Style CSS -->
    {{HTML::style('css/fields-style.css')}}
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                @if ($flag == 1)
                    <h4><a href="{{route('project.moreInfo',$project)}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
                @else
                    <h4><a href="{{route('purchase.purchaseXProject',$id)}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
                @endif
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right" >
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
                        <h5 class="card-title text-center">Are you sure to delete</h5>
                        <h5 class="card-title text-center">{{$purchase->projects->name_project}}?</h5>
                        <form  action="{{ route ('purchase.destroy',[$purchase,$flag]) }}" method="POST" class="well form-horizontal">
                            @csrf @method('DELETE')
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Name</label>
                                            <input class="form-control" type="text" autocomplete="off" value="{{old('searchProject',$purchase->projects->name_project)}}" id="searchProject" name="searchProject" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Category</label> 
                                            <select class="form-control" id="categoryPurchase" style="font-size: 12px;" name="categoryPurchase" readonly>
                                                    <option > {{ $purchase->purchaseCategories->name_category}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Phase</label> 
                                            <select class="form-control phasesList" id="phasePurchase" style="font-size: 12px;" name="phasePurchase" readonly> 
                                            <option > {{ $purchase->phases->name_phase}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <!--- More purchases -->
                            <div class="rowFields">
                            </div>
                            <!--- End More purchases -->

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="descriptionPurchase" rows="3" name="descriptionPurchase"  readonly>{{$purchase->description_purchase}}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Amount</label>
                                        <input type="text" class="form-control form-control-sm" id="amountPurchase" name="amountPurchase" placeholder="$0.00" value="{{old('amountPurchase',$purchase->amount)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" style="font-size: 12px;">
                                        <div class="row">
                                            <div class="col">
                                                <label style="font-size: 12px;">Purchase Date</label>
                                                <input id="text" class="form-control form-control-sm" name="datePurchase" value="{{old('datePurchase',$purchase->date_purchase)}}" readonly>
                                            </div>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary btn-sm">Delete</button>
                            </div>
                            </fieldset>
                        </form>
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
        });
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
