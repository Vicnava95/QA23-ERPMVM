@extends('master')

@section('title')
<title>Daily Report</title>
@stop
@section('extra_links')


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<!-- Date Picker -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<!-- Script Font Awesome-->
<script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

<!-- Fields - Style CSS -->
<link href="css/fields-style.css" rel="stylesheet" type="text/css" />
{{HTML::style('css/dailyReport/dailyReport.css')}}

<!-- Fields - JS -->
{{HTML::script('js/dailyReport/dailyReport.js')}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

{{HTML::style('css/gmap.css')}}
{{HTML::script('js/gmap.js')}}


@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            @if ($user != 'report')
                <h4 style="font-size: 130%;"><a href="{{route('project.active')}}">
                    <div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></div>
                </a></h4>
            @endif
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            @if (Auth::user()->id == 1 || Auth::user()->id == 5 || Auth::user()->id == 10 || Auth::user()->id == 11 || Auth::user()->id == 12 || Auth::user()->id == 13)
                <h4 style="font-size: 130%;"><a href="{{route('activeDailyReport')}}"><div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Pending Report">Pending Report</div></a></h4>
            @endif
        </div>
    </div>
</div>

<div class="container" style="max-width: 450px;">
    <div class="row">
        <div class=""></div>
        <div class="card col" style="margin: 10px;">
            <div class="row">
                <div id="form1" class="card-body">
                    <h5 class="card-title text-center">Daily Report</h5>
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button id="2" type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                <span aria-hidden="true" >&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route ('postDailyReport') }}" method="POST" class="well form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="row" style="margin-bottom: 8px;">
                                <div class="col-9" style="padding: 0px 5px 0px 15px;">
                                    <input type="text" class="datepick" id="datepicker" width="100%" name="dailyDate" autocomplete="off" required>
                                </div>
                                <div class="col-3 text-center" style="padding: 0px 15px 0px 0px;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" style="width: 100%;" onclick="getCurrentDay()">Today</button>
                                </div>
                            </div>
                            <h5>Active Projects  <i class="fas fa-search fa-1x" onclick="test()"></i> </h5>
                            @foreach ($projects as $project)
                            <div class="form-check">
                                <input class="form-check-input-project" type="radio" name="flexRadioDefault" id="radioProjects{{$project->id}}" value="{{$project->id}}">
                                <label class="form-check-label" for="radioProjects{{$project->id}}">
                                  {{$project->name_project}}
                                </label>
                            </div>
                            @endforeach

                            <input type="text-center" class="form-control form-control-sm" name="dailyProject"  id="searchProject" placeholder="Search Project" autocomplete="off" style="margin-top: 8px;">
                            <input type="text" id="projectId" name="dailyProjectId" hidden required >
                            <div id="projectList" style="margin-bottom: 5px;">
                            </div>
                            <h5>Phase</h5>
                            <div id="projectPhaseList" style="margin-bottom: 5px;">
                            </div>
                        
                            <h5>Labor <!--  <i class="fas fa-plus-circle fa-1x" onclick="moreLabor()"></i> <i class="fas fa-minus-circle fa-1x" onclick="lessLabor()" id="btnLabMinus"></i> --></h5>
                            <div class="row" style="margin: 0px 0px 5px 0px;">
                                @foreach($labors as $labor)
                                <div class="d-flex">
                                    <div class="col" style="padding-left: 5px; padding-right:5px;" >
                                        <i class="far fa-plus-square fa-1x" onclick="showModalLabor({{$labor->id}})"></i> {{$labor->name_category}}<br>
                                    </div>
                                </div>
                                    
                                @endforeach
                            </div> 

                            <div id="rowmoreLabor">
                                <div class="addMoreLabor">
                                </div>
                            </div>
                    
                            <h5>Subcontractor <i class="fas fa-plus-circle fa-1x" onclick="moreSubcontractor()"></i>  <i class="fas fa-minus-circle fa-1x" onclick="lessSub()" id="btnSubMinus"></i></h5>

                            <div id="rowmoreSubContractor">
                                <div class="addMoreSubContractor">
                                </div>
                            </div>
                            
                            <h5>Import</h5>
                            <div class="row">
                                <div class="col">
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(1,'Dirt Import')"></i> Dirt<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(9,'Gravel Import')"></i> Gravel<br>
                                </div>
                                <div class="col">
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(10,'Base Import')"></i> Base<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(11,'DG Import')"></i> DG<br>
                                </div>
                            </div>
                            
                            <h5>Export</h5>
                            <div class="row">
                                <div class="col">
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(2,'Dirt Export')"></i> Dirt<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(3,'Concrete Export')"></i> Concrete<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(4,'Mixed Export')"></i> Mixed<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(5,'Trash Export')"></i> Trash<br>
                                </div>
                                <div class="col" style="padding-left: 0px; padding-right: 0px;">
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(6,'Asphalt Export')"></i> Asphalt<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(7,'Dirt + Rocks Export')"></i> Dirt + Rocks<br>
                                    <i class="far fa-plus-square fa-1x" onclick="showModalTruck(8,'Demoltion Debris Export')"></i> Demolition Debris<br>
                                </div>
                            </div>

                            <div class="listTruckResumen">

                            </div>

                            <div class="listLaborResumen">

                            </div>
                            <input type="number" value="0" name="countTrucks" id="countTrucks" hidden>
                            <input type="number" value="0" name="countLabor" id="countLabor" hidden>

                            <div class="card" id="cardList1">
                                <div class="card-body cardExportDirt">
                                    <h5 id="titleInfoCardImport" style="margin-left: 5px; margin-bottom: 0px; font-size: 1rem;">Dirt Import</h5>
                                    <div class="row cardRow1">
                                        <div class="col-3 fila1Card">
                                            <h6>Quantity</h6>
                                        </div>
                                        <div class="col-3 fila1Card">
                                            <h6>Price</h6>
                                        </div>
                                        <div class="col-6 fila1Card">
                                            <h6>Provideer</h6>
                                        </div>
                                    </div>
                                    <div class="row cardRow1">
                                        <div class="col-3 fila2Card">
                                            <h6 id="qualityInfoCard1"></h6>
                                        </div>
                                        <div class="col-3 fila2Card">
                                            <h6 id="priceInfoCard1"></h6>
                                        </div>
                                        <div class="col-6 fila2Card">
                                            <h6 id="providerInfoCard1">Zepeda</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @for($i=2 ; $i <= 11 ; $i++)
                                <div class="card" id="cardList{{$i}}">
                                    <div class="card-body cardExportDirt">
                                        <h5 id="titleInfoCard{{$i}}" style="margin-left: 5px; margin-bottom: 0px; font-size: 1rem;">title</h5>
                                        <div class="row cardRow1">
                                            <div class="col-3 fila1Card">
                                                <h6>Quantity</h6>
                                            </div>
                                            <div class="col-3 fila1Card">
                                                <h6>Price</h6>
                                            </div>
                                            <div class="col-6 fila1Card">
                                                <h6>Provideer</h6>
                                            </div>
                                        </div>
                                        <div class="row cardRow1">
                                            <div class="col-3 fila2Card">
                                                <h6 id="qualityInfoCard{{$i}}"></h6>
                                            </div>
                                            <div class="col-3 fila2Card">
                                                <h6 id="priceInfoCard{{$i}}"></h6>
                                            </div>
                                            <div class="col-6 fila2Card">
                                                <h6 id="providerInfoCard{{$i}}">Zepeda</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            @for($i=1 ; $i <= 11 ; $i++)
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle{{$i}}"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6" style="margin-bottom: 8px;">
                                                <input class="inputNumber2" type="number" id="inputListModalQuantity{{$i}}" name="modalQuantity[]" step="1" value=""> Quantity
                                            </div>
                                            <div class="col-6">
                                                <input class="inputNumber2" type="number" id="inputListModalPrice{{$i}}" name="modalPrice[]" step="1" value=""> Price
                                            </div>
                                            <div class="col-12" style="margin-bottom: 10px;">
                                                <label for="" style="margin-bottom: 0px;">Comments:</label>
                                                <textarea class="form-control" name="modalCommentTruck[]" id="inputListModalComment{{$i}}" rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="selectModalProvider{{$i}}" name="modalProvider[]">
                                                <option selected> Select provider</option>
                                                <option>Zepeda Trucking</option>
                                                <option>Etzatlan Trucking</option>
                                                <option>Eddie Trucking</option>
                                                <option>Santiago Hauling</option>
                                                <option>Fullsand Trucking</option>
                                                <option>JC Muro</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="getInfoModal({{$i}})" aria-label="Close">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endfor

                            @foreach($labors as $labor)
                            <!-- Modal for labors -->
                            <div class="modal fade" id="modalAddLabor{{$labor->id}}" tabindex="-1" role="dialog" aria-labelledby="modalAddLaborTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$labor->name_category}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6 hideReport">
                                                Amount: $<input class="inputNumber2 hideReport" type="number" id="modalAmountLabor{{$labor->id}}" name="modalAmountLabor[]" step="0.01" > 
                                            </div>
                                            <div class="col-12" style="margin-bottom: 10px;">
                                                <label for="" style="margin-bottom: 0px;">Comments:</label>
                                                <textarea class="form-control" name="modalCommentLabor[]" id="inputListmodalCommentLabor{{$labor->id}}" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="getInfoModalLabor({{$labor->id}},'{{$labor->name_category}}')" aria-label="Close">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <h5>Comments</h5>
                            <textarea class="form-control" name="comments" id="" cols="30" rows="3"></textarea>

                            <div class="form-check form-check-inline" hidden>
                                <input class="form-check-input" type="radio" value="complete" name="dailyStatus" id="dailyStatus1">
                                <label class="form-check-label" for="dailyStatus1">
                                  Complete
                                </label>
                            </div>
                            <div class="form-check form-check-inline" hidden>
                                <input class="form-check-input" type="radio" value="incomplete" name="dailyStatus" id="dailyStatus2" checked>
                                <label class="form-check-label" for="dailyStatus2">
                                  Incomplete
                                </label>
                            </div>

                            <input type="text" id="flagSubmit" name="flagSubmit" hidden>

                            <div class="row text-center" style="margin-top: 8px;">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-outline-secondary" onclick="onlyData()" >Submit</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-outline-secondary" onclick="addImage()" >Add Images</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- End Col 4 -->
    </div> <!-- End Row -->
</div>
<input type="text" value="{{$user}}" id="rolType" hidden>
@if ($user == 'labor' || $user == 'report')
    <script type="text/javascript">
        $('.hideReport').hide();
    </script>
@endif

<script type="text/javascript">
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
    var amount68 = parseFloat(303.50);
    var amount69 = parseFloat(258.80);
    $('#modalAmountLabor28').val(180);
    $('#modalAmountLabor67').val(150);
    $('#modalAmountLabor46').val(205);
    $('#modalAmountLabor68').val(amount68);
    $('#modalAmountLabor69').val(amount69);
</script>
@stop
