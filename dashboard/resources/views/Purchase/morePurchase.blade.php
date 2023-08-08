@extends('master')
@section('title')
    <title>New Purchase</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}


    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Fields - Style CSS -->
    {{HTML::style('css/fields-style.css')}}

    <!-- Fields - JS -->
    {{HTML::script('js/purchases/morePurchase.js')}} 

    
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}


@stop
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col">
                <h4><a href="{{url()->previous()}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right" >
                
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class=""></div>
            <div class="card bg-light col" style="margin: 10px;">
                <div class="row">
                    <div id="form1" class="card-body">
                        <h5 class="card-title text-center">New Purchase Form</h5>
                        <form  action="{{ route ('purchase.storePurchase') }}" method="POST" class="well form-horizontal">
                            @csrf
                            <fieldset>
                               <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Project Name</label> <span class="badge badge-secondary addRowFields" onclick="countFields()" style="font-size: 10px;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample" hidden >Add Another</span>
                                            <input class="form-control" type="text" autocomplete="off" value="{{$project->name_project}}" placeholder="Search Project" id="searchProjectHi" name="searchProject" readonly>
                                            <input class="form-control" type="text" autocomplete="off" value="{{$project->id}}" placeholder="Search Project" id="searchProject" name="searchProjectHi" hidden>
                                            <div id="projectList">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label style="font-size: 12px;">Quick Add</label>
                                            <select class="form-control quickAdd" id="quickAdd" style="font-size: 12px;" required>
                                                <option value="0"> Select Category</option>
                                                <option value="1"> Operator</option>
                                                <option value="2"> Labor</option>
                                                <option value="3"> Dirt Export</option>
                                                <option value="8"> Asphalt Export</option>
                                                <option value="9"> Dirt + Rocks Export</option>
                                                <option value="4"> Concrete Export</option>
                                                <option value="5"> Trash Export</option>
                                                <option value="10"> Trash 40CY Export</option>
                                                <option value="6"> Mixed Export</option>
                                                <option value="11"> Dirt Import</option>
                                                <option value="12"> Asphalt Import</option>
                                                <option value="14"> Aggregates Import</option>
                                                <option value="15"> Base Import</option>
                                                <option value="16"> Gravell Import</option>
                                                <option value="18"> Sand Import</option>
                                                <option value="19"> Soil Import</option>
                                                <option value="7"> Alberto</option>
                                                {{-- <option value="13"> Angel </option> --}}
                                                {{-- <option value="17"> Efren </option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group dirtExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="dirtExport" name="dirtExport[]" value="1" min="1" onchange="newAmountDirtExport()"/>
                                        </div>

                                        <div class="form-group concreteExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="concreteExport" name="concreteExport[]" value="1"  min="1" onchange="newAmountConcreteExport()"/>
                                        </div>

                                        <div class="form-group trashExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="trashExport" name="trashExport[]" value="1" min="1" onchange="newAmountTrashExport()"/>
                                        </div>

                                        <div class="form-group mixedExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="mixedExport" name="mixedExport[]" value="1" min="1" onchange="newAmountMixedExport()"/>
                                        </div>
                                        <div class="form-group asphaltExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="asphaltExport" name="asphaltExport[]" value="1" min="1" onchange="newAmountAsphaltExport()"/>
                                        </div>
                                        <div class="form-group dirtRockExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="dirtRockExport" name="dirtRockExport[]" value="1" min="1" onchange="newAmountDirtRockExport()"/>
                                        </div>
                                        <div class="form-group trash40CYExport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="trash40CYExport" name="trash40CYExport[]" value="1" min="1" onchange="newAmountTrash40CYExport()"/>
                                        </div>
                                        <div class="form-group dirtImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="dirtImport" name="dirtImport[]" value="1" min="1" onchange="newAmountDirtImport()"/>
                                        </div>
                                        <div class="form-group asphaltImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="asphaltImport" name="asphaltImport[]" value="1" min="1" onchange="newAmountAsphaltImport()"/>
                                        </div>
                                        <div class="form-group aggregatesImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="aggregatesImport" name="aggregatesImport[]" value="1" min="1" onchange="newAmountAggregatesImport()"/>
                                        </div>
                                        <div class="form-group baseImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="baseImport" name="baseImport[]" value="1" min="1" onchange="newAmountBaseImport()"/>
                                        </div>
                                        <div class="form-group gravellImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="gravellImport" name="gravellImport[]" value="1" min="1" onchange="newAmountGravellImport()"/>
                                        </div>
                                        <div class="form-group sandImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="sandImport" name="sandImport[]" value="1" min="1" onchange="newAmountSandImport()"/>
                                        </div>
                                        <div class="form-group soilImport">
                                            <label style="font-size: 12px;">How many trucks?</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="soilImport" name="soilImport[]" value="1" min="1" onchange="newAmountSoilImport()"/>
                                        </div>
                                        <!-- Payroll -->
                                        <div class="form-group alberto">
                                            <label style="font-size: 12px;">Overtime</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="alberto" value="0" step="0.01" min="0" onchange="newAmountAlberto()" />
                                        </div>
                                        <div class="form-group angel">
                                            <label style="font-size: 12px;">Overtime</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="angel" value="0" step="0.01" min="0" onchange="newAmountAngel()" />
                                        </div>
                                        <div class="form-group efren">
                                            <label style="font-size: 12px;">Overtime</label>
                                            <br>
                                            <input type="number" class="form-control form-control-sm" id="efren" value="0" step="0.01"
                                                min="0" onchange="newAmountEfren()" />
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Category</label> 
                                        <select class="form-control" id="categoryPurchase" style="font-size: 12px;" name="categoryPurchase[]" required>
                                                @foreach($purchaseCategories as $purchaseCategorie)
                                                <option value="{{ $purchaseCategorie->id}}"> {{ $purchaseCategorie->name_category }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Phase</label> 
                                        <select class="form-control phasesList" id="phasePurchase" style="font-size: 12px;" name="phasePurchase[]"> 
                                            @foreach($phases as $phase)
                                            <option value="{{ $phase->id}}"> {{ $phase->name_phase}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="descriptionPurchase" rows="3" name="descriptionPurchase[]" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Amount</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="amountPurchase" name="amountPurchase[]" placeholder="$0.00" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" style="font-size: 12px;">
                                        <div class="row">
                                            <div class="col">
                                                <label style="font-size: 12px;">Purchase Date</label>
                                                <input type="text" class="datepick" id="datepicker" width="200" name="datePurchase[]" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--- More purchases -->
                            <div class="rowFields">
                            </div>
                            <!--- End More purchases -->

                            <div class="form-group" hidden>
                            <label style="font-size: 12px;">Picture</label><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btnfile">Upload a file</button>
                                    <input type="file" name="myfile" />
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" id="anotherPurchase" class="btn btn-outline-secondary btn-sm addRowFields">Add Another Purchase</button>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit Purchase</button>
                                </div>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- End Col 4 -->
        </div> <!-- End Row -->
    </div>
    <script type="text/javascript">
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
