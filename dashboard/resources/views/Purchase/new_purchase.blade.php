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
<link href="css/fields-style.css" rel="stylesheet" type="text/css" />



<!-- Fields - JS -->
<script src="js/purchases/newPurchase.js"></script>




<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

{{HTML::style('css/gmap.css')}}
{{HTML::script('js/gmap.js')}}


@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col text-left">
            <a href="{{route('purchase.filter')}}">
                <div class="btn btn-outline-secondary btn-sm">Go Back</div>
            </a>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            
            <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button>
            <!-- Hidden -->
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
                    <form action="{{ route ('purchase.store') }}" method="POST" class="well form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Project Name</label> <span
                                            class="badge badge-secondary addRowFields" onclick="countFields()"
                                            style="font-size: 10px;" href="#addPhase" role="button"
                                            aria-expanded="false" aria-controls="collapseExample" hidden>Add
                                            Another</span>
                                        <input class="form-control" type="text" autocomplete="off"
                                            placeholder="Search Project" id="searchProject" name="searchProject"
                                            required>
                                        <div id="projectList">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Quick Add</label>
                                        <select class="form-control quickAdd" id="quickAdd" style="font-size: 12px;"
                                            required>
                                            <option value="0"> Select Category</option>
                                            <option value="1"> Operator</option>
                                            <option value="2"> Labor</option>
                                            <option value="3"> Dirt Export</option>
                                            <option value="4"> Concrete Export</option>
                                            <option value="5"> Trash Export</option>
                                            <option value="6"> Mixed Export</option>
                                            <option value="7"> Alberto</option>
                                            {{-- <option value="8"> Manuel</option>
                                            <option value="9"> Thomas</option>
                                            <option value="10"> Jorge  </option>
                                            <option value="11"> Delfino </option>
                                            <option value="12"> Gustavo </option> --}}
                                            <option value="13"> Angel </option>
                                            {{-- <option value="14"> León </option>
                                            <option value="15"> Julio </option> --}}
                                            {{-- <option value="16"> Humberto </option> --}}
                                            <option value="17"> Efren </option>
                                            {{-- <option value="18"> Juan </option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group dirtExport">
                                        <label style="font-size: 12px;">How many trucks?</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="dirtExport"
                                            value="1" min="1" onchange="newAmountDirtExport()" />
                                    </div>

                                    <div class="form-group concreteExport">
                                        <label style="font-size: 12px;">How many trucks?</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="concreteExport"
                                            value="1" min="1" onchange="newAmountConcreteExport()" />
                                    </div>

                                    <div class="form-group trashExport">
                                        <label style="font-size: 12px;">How many trucks?</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="trashExport"
                                            value="1" min="1" onchange="newAmountTrashExport()" />
                                    </div>

                                    <div class="form-group mixedExport">
                                        <label style="font-size: 12px;">How many trucks?</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="mixedExport"
                                            value="1" min="1" onchange="newAmountMixedExport()" />
                                    </div>
                                    <!-- Payroll -->
                                    <div class="form-group alberto">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="alberto" value="0" step="0.01"
                                            min="0" onchange="newAmountAlberto()" />
                                    </div>
                                    <div class="form-group manuel">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="manuel" value="0" step="0.01"
                                            min="0" onchange="newAmountManuel()" />
                                    </div>
                                    <div class="form-group thomas">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="thomas" value="0" step="0.01"
                                            min="0" onchange="newAmountThomas()" />
                                    </div>
                                    <div class="form-group jorgeHD">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="jorgeHD" value="0" step="0.01"
                                            min="0" onchange="newAmountJorgeHD()" />
                                    </div>
                                    <div class="form-group delfino">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="delfino" value="0" step="0.01"
                                            min="0" onchange="newAmountDelfino()" />
                                    </div>
                                    <div class="form-group gustavo">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="gustavo" value="0" step="0.01"
                                            min="0" onchange="newAmountGustavo()" />
                                    </div>
                                    <div class="form-group angel">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="angel" value="0" step="0.01"
                                            min="0" onchange="newAmountAngel()" />
                                    </div>
                                    <div class="form-group leon">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="leon" value="0" step="0.01"
                                            min="0" onchange="newAmountLeon()" />
                                    </div>
                                    <div class="form-group julio">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="julio" value="0" step="0.01"
                                            min="0" onchange="newAmountJulio()" />
                                    </div>
                                    <div class="form-group unberto">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="unberto" value="0" step="0.01"
                                            min="0" onchange="newAmountUnberto()" />
                                    </div>
                                    <div class="form-group efren">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="efren" value="0" step="0.01"
                                            min="0" onchange="newAmountEfren()" />
                                    </div>
                                    <div class="form-group juan">
                                        <label style="font-size: 12px;">Overtime</label>
                                        <br>
                                        <input type="number" class="form-control form-control-sm" id="juan" value="0" step="0.01"
                                            min="0" onchange="newAmountJuan()" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group ca">
                                        <label style="font-size: 12px;">Category</label>
                                        <select class="form-control" id="categoryPurchase" style="font-size: 12px;"
                                            name="categoryPurchase[]" required>
                                            @foreach($purchaseCategories as $purchaseCategorie)
                                            <option value="{{ $purchaseCategorie->id}}">
                                                {{ $purchaseCategorie->name_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Phase</label>
                                        <select class="form-control phasesList" id="phasePurchase"
                                            style="font-size: 12px;" name="phasePurchase[]">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-size: 12px;">Description</label>
                                <textarea class="form-control" id="descriptionPurchase" rows="3"
                                    name="descriptionPurchase[]" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label style="font-size: 12px;">Amount</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-sm"
                                            id="amountPurchase" name="amountPurchase[]" placeholder="$0.00"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" style="font-size: 12px;">
                                        <div class="row">
                                            <div class="col">
                                                <label style="font-size: 12px;">Purchase Date</label>
                                                <input type="text" class="datepick" id="datepicker" width="200"
                                                    name="datePurchase[]" autocomplete="off" required>
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
                                <label style="font-size: 12px;">Files</label><br>
                                <div class="file-select" id="src-file1" >
                                    <input type="file" aria-label="Archivo" name="myfile[]">
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" id="anotherPurchase"
                                        class="btn btn-outline-secondary btn-sm addRowFields">Add Another
                                        Purchase</button>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" id="sub_butt" class="btn btn-secondary btn-sm">Submit
                                        Purchase</button>
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







@stop
