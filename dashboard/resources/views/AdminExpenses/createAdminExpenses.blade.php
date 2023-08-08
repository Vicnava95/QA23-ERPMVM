@extends('master')
@section('title')
    <title>New Admin Expense</title>
@stop
@section('extra_links')

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - Style CSS -->
    <link href="css/fields-style.css" rel="stylesheet" type="text/css" />

    <!-- Fields - JS -->
    <script src="js/AdminExpenses/newAdminExpense.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{route('showAdminExpenses')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col text-right">
                
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="row">
            <div class=""></div>
                <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">New Admin Expense</h5>
                        <form action="{{route('storeAdminExpenses')}}" name="form1" method="POST" class="well form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Category</label>
                                            <select class="form-control" id="selectCategory" onchange="hideType(value)">
                                                <option value="0" selected>Select Category</option>
                                                @foreach ($categories as $categori)
                                                    <option value="{{$categori->id}}">{{$categori->nameCategory}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group purchaseSection{{$categori->id}}">
                                            <label style="font-size: 12px;">Expense Type</label>
                                            <select class="form-control" id="selectTypeExpenses" name="expensesType[]" required>
                                                <option value="0" class="selectOption" selected>Select Type</option>
                                                @foreach ($typesAdminExpenses as $tAdminExpenses)
                                                    <option value="{{$tAdminExpenses->id}}" class="selectOption option{{$tAdminExpenses->categoryExpense->id}}">{{$tAdminExpenses->nameTypeAdminExpenses}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label style="font-size: 12px;" >Amount</label>
                                            <input type="number" step="0.01" class="form-control form-control-sm" style="height: 38px;" id="amount" name="amount[]" min="0" value="0" placeholder="$0.00" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Expense Date</label>
                                            <input type="text" id="datepicker" width="100%" style="height: 38px;" name="dateExpense[]" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                    <textarea class="form-control" id="note" rows="3" name="comment[]"></textarea>
                                </div>
                                <hr>
                            <div class="rowFields">

                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit</button>
                                </div>
                                {{-- <div class="col text-center">
                                    <button type="button" id="anotherPurchase"
                                        class="btn btn-outline-secondary btn-sm addRowFields">Add Another
                                        Purchase</button>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit</button>
                                </div> --}}
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
    </script>
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
@stop
