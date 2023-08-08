@extends('master')
@section('title')
<title>Edit Daily Report</title>
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
{{HTML::style('css/dailyReport/dailyReportEdit.css')}}

<!-- Fields - JS -->
{{HTML::script('js/dailyReport/dailyReportEdit.js')}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />

{{HTML::style('css/gmap.css')}}
{{HTML::script('js/gmap.js')}}


@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('activeDailyReport')}}"><div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></div></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            @if (Auth::user()->id == 1 || Auth::user()->id == 5)
                <h4><a href="{{route('allDailyReport')}}"><div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="All Reports"><i class="uil uil-file-bookmark-alt"></i></div></a></h4>
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
                    <h5 class="card-title text-center">Edit Daily Report</h5>
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button id="2" type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                <span aria-hidden="true" >&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route ('updateDailyReport',$dailyReport) }}" method="POST" class="well form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="row" style="margin-bottom: 8px;">
                                <div class="col-9" style="padding: 0px 5px 0px 15px;">
                                    <input type="text" class="datepick" id="datepicker" width="100%" name="dailyDate" autocomplete="off" value="{{$dailyReport->dateDailyReport}}" required>
                                </div>
                                <div class="col-3 text-center" style="padding: 0px 15px 0px 0px;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" style="width: 100%;" onclick="getCurrentDay()">Today</button>
                                </div>
                            </div>
                            <h5><b>Project:</b> {{$project->name_project}}</h5>
                            <input type="text" id="projectId" name="dailyProjectId" value="{{$dailyReport->projects_fk}}" required hidden>
                            <input type="text" id="dailyReportId" name="dailyReportId" value="{{$dailyReport->id}}" required hidden>

                            <h5>Phase</h5>
                            @foreach ($phases as $phase)
                                <div class="form-check">
                                    @if ($phase->id == $dailyReport->projectPhase)
                                        <input class="form-check-input-project" type="radio" name="phaseId" id="radioProjects{{$phase->id}}" value="{{$phase->id}}" checked>
                                        <label class="form-check-label" for="radioProjects{{$phase->id}}">
                                        {{$phase->name_phase}}
                                        </label>
                                    @else
                                        <input class="form-check-input-project" type="radio" name="phaseId" id="radioProjects{{$phase->id}}" value="{{$phase->id}}">
                                        <label class="form-check-label" for="radioProjects{{$phase->id}}">
                                        {{$phase->name_phase}}
                                        </label>
                                    @endif
                                </div>
                            @endforeach

                            {{-- @foreach ($reportLabor as $reLabor)
                                <input class="inputNumber" type="number" id="inputReportAmountLabor{{$reLabor->dailyLabor_fk}}" step="1" value="{{$reLabor->amount}}"  style="margin-left:14px;">
                                <textarea class="form-control" name="modalCommentLabor[]" id="inputReportCommentLabor{{$reLabor->dailyLabor_fk}}" rows="2">{{$reLabor->comments}}</textarea>
                            @endforeach --}}
                        
                            <h5>Labor <i class="fas fa-plus-circle fa-1x" onclick="moreLabor()"></i> <i class="fas fa-minus-circle fa-1x" onclick="lessLabor()" id="btnLabMinus"></i> </h5>
                            <div class="row" style="margin: 0px 0px 5px 0px;">
                                @foreach($arrayLaborsData as $labor)
                                    <input class="inputNumber" type="number" id="inputListLabor{{$labor['id']}}" name="" step="1" value="{{$labor['amount']}}"  style="margin-left:14px;" onclick="showModalLabor({{$labor['id']}})">{{$labor['name']}}<br>  
                                @endforeach
                            </div> 

                            @foreach ($extraLabor as $eLabor)
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size: 12px; margin:0px;">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="nameLabor'+id+'" name="nameLabor[]" autocomplete="off" value="{{$eLabor->nameMoreReport}}">
                                    </div>
                                    <div class="col">
                                        <label style="font-size: 12px; margin:0px;">Payment</label>
                                        <input type="number" class="form-control form-control-sm" id="paymentLabor'+id+'" name="paymentLabor[]" min="0" step="0.01" autocomplete="off" value="{{$eLabor->amountMoreReport}}">
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            

                            <div id="rowmoreLabor">
                                <div class="addMoreLabor">
                                </div>
                            </div>
                    
                            <h5>Subcontractor <i class="fas fa-plus-circle fa-1x" onclick="moreSubcontractor()"></i>  <i class="fas fa-minus-circle fa-1x" onclick="lessSub()" id="btnSubMinus"></i></h5>

                            @foreach ($subcontractor as $scontractor)
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size: 12px; margin:0px;">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="nameSub'+id+'" name="nameSub[]" autocomplete="off" value="{{$scontractor->nameMoreReport}}">
                                    </div>
                                    <div class="col">
                                        <label style="font-size: 12px; margin:0px;">Payment</label>
                                        <input type="number" class="form-control form-control-sm" id="paymentSub'+id+'" name="paymentSub[]" min="0" step="0.01" autocomplete="off" value="{{$scontractor->amountMoreReport}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size: 12px; margin:0px;">Description</label>
                                        <textarea class="form-control form-control-sm" name="descriptionSub[]" id="descriptionSub'+id+'" cols="5" rows="2">{{$scontractor->descriptionMoreReport}}</textarea>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            <div id="rowmoreSubContractor">
                                <div class="addMoreSubContractor">
                                </div>
                            </div>
                            
                            <h5>Import</h5>
                            <div class="row">
                                <div class="col">
                                    <input class="inputNumber" type="number" id="inputList1" name="" step="1" value="" onclick="showModalAndCard(1,'Dirt')"> Dirt<br>
                                    <input class="inputNumber" type="number" id="inputList9" name="" step="1" value="" onclick="showModalAndCard(9,'Gravel')"> Gravel<br> 
                                </div>
                                <div class="col">
                                    <input class="inputNumber" type="number" id="inputList10" name="" step="1" value="" onclick="showModalAndCard(10,'Base')"> Base<br>
                                    <input class="inputNumber" type="number" id="inputList11" name="" step="1" value="" onclick="showModalAndCard(11,'DG')"> DG<br>
                                </div>
                            </div>
                            
                            <h5>Export</h5>
                            <div class="row">
                                <div class="col">
                                    <input class="inputNumber" type="number" id="inputList2" name="" step="1" value="" onclick="showModalAndCard(2,'Dirt')"> Dirt<br>  
                                    <input class="inputNumber" type="number" id="inputList3" name="" step="1" value="" onclick="showModalAndCard(3,'Concrete')"> Concrete<br>  
                                    <input class="inputNumber" type="number" id="inputList4" name="" step="1" value="" onclick="showModalAndCard(4,'Mixed')"> Mixed<br>
                                    <input class="inputNumber" type="number" id="inputList5" name="" step="1" value="" onclick="showModalAndCard(5,'Trash')"> Trash<br>
                                </div>
                                <div class="col" style="padding-left: 0px; padding-right: 0px;">
                                    <input class="inputNumber" type="number" id="inputList6" name="" step="1" value="" onclick="showModalAndCard(6,'Asphalt')"> Asphalt<br>
                                    <input class="inputNumber" type="number" id="inputList7" name="" step="1" value="" onclick="showModalAndCard(7,'Dirt + Rocks')"> Dirt + Rocks<br>
                                    <input class="inputNumber" type="number" id="inputList8" name="" step="1" value="" onclick="showModalAndCard(8,'Demoltion Debris')"> Demolition Debris<br>
                                </div>
                            </div>

                            <div class="listLaborResumen">

                            </div>
                            <input type="number" value="0"  id="countLabor" hidden>
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
                                <script type="text/javascript">
                                    $('#cardList'+{{$i}}+'').show();
                                </script>
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
                                                        <input class="inputNumber2" type="number" id="inputListModalQuantity{{$i}}" name="modalQuantity[]" step="1" 
                                                        @foreach ($reportTruck as $rTruck)
                                                        @if ($rTruck->dailyTruck_fk == $i) value="{{$rTruck->quantityDailyTruck}}"
                                                        @endif
                                                        @endforeach> Quantity
                                                    </div>
                                                    <div class="col-6">
                                                        <input class="inputNumber2" type="number" id="inputListModalPrice{{$i}}" name="modalPrice[]" step="1" 
                                                        @foreach ($reportTruck as $rTruck)
                                                        @if ($rTruck->dailyTruck_fk == $i) value="{{floatval($rTruck->priceDailyTruck)}}"
                                                        @endif
                                                        @endforeach> Price
                                                    </div>
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="" style="margin-bottom: 0px;">Comments:</label>
                                                        <textarea class="form-control" name="modalCommentTruck[]" id="inputListModalComment{{$i}}" rows="2">@foreach ($reportTruck as $rTruck)@if ($rTruck->dailyTruck_fk == $i){{$rTruck->commentsDailyTruck}}@endif @endforeach
                                                        </textarea>
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
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endfor

                            @foreach($arrayLaborsData as $labor)
                            <!-- Modal for labors -->
                            <div class="modal fade" id="modalAddLabor{{$labor['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalAddLaborTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$labor['name']}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                @if ($labor['amount'] != 0)
                                                    <input class="inputNumber2" type="number" id="modalIdLabor{{$labor['id']}}" value="{{$labor['id']}}" name="modalIdLabor[]" step="1" hidden> 
                                                    Amount: $<input class="inputNumber2" type="number" id="modalAmountLabor{{$labor['id']}}" value="{{$labor['amount']}}" name="modalAmountLabor[]" step="1" > 
                                                @else
                                                    <input class="inputNumber2" type="number" id="modalIdLabor{{$labor['id']}}" value="" name="modalIdLabor[]" step="1" hidden>
                                                    Amount: $<input class="inputNumber2" type="number" id="modalAmountLabor{{$labor['id']}}" value="" name="modalAmountLabor[]" step="1" >
                                                @endif
                                                
                                            </div>
                                            <div class="col-12" style="margin-bottom: 10px;">
                                                <label for="" style="margin-bottom: 0px;">Comments:</label>
                                                <textarea class="form-control" name="modalCommentLabor[]" id="inputListmodalCommentLabor{{$labor['id']}}" rows="2">{{$labor['comments']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="getInfoModalLabor({{$labor['id']}},'{{$labor['name']}}')" aria-label="Close">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <h5>Comments</h5>
                            <textarea class="form-control" name="comments" id="" cols="30" rows="3">{{$dailyReport->comments}}</textarea>

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
@foreach ($reportTruck as $rTruck)
    <script>
        $('#inputList{{$rTruck->dailyTruck_fk}}').val({{$rTruck->quantityDailyTruck}})
    </script>
@endforeach

<script type="text/javascript">
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
</script>

{{-- @foreach ($reportLabor as $reLabor)
    <script>
        $('#modalAmountLabor{{$reLabor->dailyLabor_fk}}') = $('#inputReportAmountLabor{{$reLabor->dailyLabor_fk}}').val();
        $('#inputListmodalCommentLabor{{$reLabor->dailyLabor_fk}}') = $('#inputReportCommentLabor{{$reLabor->dailyLabor_fk}}').val();
        $('#inputListLabor{{$reLabor->dailyLabor_fk}}') = $('#inputReportAmountLabor{{$reLabor->dailyLabor_fk}}').val();
    </script>
@endforeach --}}
inputReportCommentLabor
@stop
