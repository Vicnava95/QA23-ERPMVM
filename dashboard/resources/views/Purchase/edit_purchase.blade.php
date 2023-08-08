@extends('master')
@section('title')
    <title>Edit || {{$purchase->projects->name_project}}</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - Style CSS -->
    {{HTML::style('css/fields-style.css')}}


    <!-- Fields - JS -->
    <!-- crear un nuevo json, ya que la petición se realiza desde otra url -->
    {{HTML::script('js/purchases/newPurchase.js')}}
    
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-left">
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
                        <h5 class="card-title text-center">Edit Purchase</h5>
                        <h5 class="card-title text-center">{{$purchase->projects->name_project}}</h5>
                        <form  action="{{ route ('purchase.update',[$purchase,$flag]) }}" method="POST" class="well form-horizontal">
                            @csrf @method('PATCH')
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Name</label> <span class="badge badge-secondary addRowFields" onclick="countFields()" style="font-size: 10px;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample" hidden >Add Another</span>
                                            <input class="form-control" type="text" autocomplete="off" placeholder="Search Project" id="searchProject" name="searchProject" value="{{old('searchProject',$purchase->projects->name_project)}}" readonly>
                                            <div id="projectList">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Category</label> 
                                            <select class="form-control" id="categoryPurchase" style="font-size: 12px;" name="categoryPurchase" required>
                                                @foreach($purchaseCategories as $purchaseCategorie)
                                                <option value="{{ $purchaseCategorie->id}}"
                                                    @if($purchase->purchaseCategories->id == $purchaseCategorie->id) selected="selected" @endif> {{ $purchaseCategorie->name_category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Phase</label> 
                                            <select class="form-control phasesList" id="phasePurchase" style="font-size: 12px;" name="phasePurchase"> 
                                                @foreach($phases as $phase)
                                                <option value="{{$phase->id}}"
                                                    @if($purchase->phase_fk == $phase->id) selected="selected" @endif>{{ $phase->name_phase}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($purchase->purchase_categorie_fk == 19 || $purchase->purchase_categorie_fk == 20 || $purchase->purchase_categorie_fk == 21)
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">  
                                            <label style="font-size: 12px;">Category</label> 
                                            <input class="form-control" type="text" autocomplete="off" placeholder="" id="numberTruck" name="numberTruck" value="{{old('numberTruck',$purchase->numberTruck)}}">
                                        </div>
                                    </div>
                                    @endif
                                </div>


                            <!--- More purchases -->
                            <div class="rowFields">
                            </div>
                            <!--- End More purchases -->

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="descriptionPurchase" rows="3" name="descriptionPurchase" required>{{$purchase->description_purchase}}</textarea>
                            </div>


                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Amount</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="amountPurchase" name="amountPurchase" placeholder="$0.00" value="{{old('amountPurchase',$purchase->amount)}}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" style="font-size: 12px;">
                                        <div class="row">
                                            <div class="col">
                                                <label style="font-size: 12px;">Purchase Date</label>
                                                <input id="datepicker" width="200" name="datePurchase" value="{{old('datePurchase',$purchase->date_purchase)}}" autocomplete="off" required>
                                            </div>
                                            <div class="col">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" hidden>
                            <label style="font-size: 12px;">Picture</label><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btnfile">Upload a file</button>
                                    <input type="file" name="myfile" />
                                </div>
                            </div>
                            <hr>

                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary btn-sm">Update Purchase</button>
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
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',


        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',

        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@stop
