@extends('master')

@section('title')
    <title>Pending Reports</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/clientsweb/fancyTable.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4 style="font-size: 130%;"><a href="{{route('dailyReport')}}"><div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></div></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            @if (Auth::user()->id == 1 || Auth::user()->id == 5 || Auth::user()->id == 10 || Auth::user()->id == 11 || Auth::user()->id == 12 || Auth::user()->id == 13)
                <h4 style="font-size: 130%;"><a href="{{route('allDailyReport')}}"><div class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="All Reports">All Reports</div></a></h4>
            @endif
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->

<div class="container" style="margin-top: 30px;">  
    <div class="card text-center">
            <div class="card-header " style="font-size: 20px;">
                Daily Report
            </div>
    <div class="card-body" style="padding:8px;">
    <table id="mytableID" style="width:100%"  class="table table-striped sampleTable desktop"> 
        <thead>
            <tr>
                <th style="text-align:center;" data-sortas="numeric">Date</th>
                <th style="text-align:center;" data-sortas="case-insensitive">Project</th>
                <th style="text-align:center;" data-sortas="case-insensitive">Status</th>
                <th style="text-align:center;">More info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allDailyReports as $dailyReport)
                <tr> 
                    <td style="text-align:center;">{{$dailyReport->dateDailyReport}}</td> 
                    <td style="text-align:center;">{{$dailyReport->project->name_project}}</td> 
                    <td style="text-align:center;">{{$dailyReport->statusDailyReport}}</td>
                    <td style="text-align:center;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$dailyReport->id}}">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> 

    @foreach ($allDailyReports as $dailyReport)
        <div class="modal fade" id="exampleModal{{$dailyReport->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$dailyReport->dateDailyReport}} - {{$dailyReport->project->name_project}} - 
                    @foreach ($phases as $phase)
                        @if ($dailyReport->projectPhase == $phase->id)
                            {{$phase->name_phase}}</h5>
                        @endif
                    @endforeach
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @foreach ($reportTruck as $rtTruck)
                        @foreach ($allDailyTrucks as $dailyTrucks)
                            @if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id)
                            <div class="card" id="cardList" style="margin-bottom: 5px;">
                                <div class="card-body" style="padding: 5px;">
                                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">{{$dailyTrucks->categoryTypeTruck}} - {{$dailyTrucks->nameTypeTruck}}</h5>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6>Quantity</h6>
                                        </div>
                                        <div class="col-3">
                                            <h6>Price</h6>
                                        </div>
                                        <div class="col-6">
                                            <h6>Provideer</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 id="qualityInfoCard">{{$rtTruck->quantityDailyTruck}}</h6>
                                        </div>
                                        <div class="col-3">
                                            <h6 id="priceInfoCard">
                                                @if ($rtTruck->priceDailyTruck != null)
                                                    ${{$rtTruck->priceDailyTruck}}
                                                @endif
                                            </h6>
                                        </div>
                                        <div class="col-6">
                                            <h6 id="providerInfoCard">{{$rtTruck->nameProviderTruck}}</h6>
                                        </div>
                                    </div>
                                    @if ($rtTruck->commentsDailyTruck != null)
                                        <div class="row" style="text-align: left;">
                                            <div class="col-12">
                                                <h6 style="margin-bottom: 0px;">Comments: </h6>
                                                <h6 id="providerInfoCard">{{$rtTruck->commentsDailyTruck}}</h6>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                    
                    <div class="card" id="cardList" style="margin-bottom: 5px;">
                        <div class="card-body" style="padding: 5px;">
                            <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Labor</h5>
                            <div class="row">
                                <ul>
                                    @foreach ($reportLabor as $rtLabor)
                                        @foreach ($allDailyLabor as $dailyLabor)
                                            @if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                            <li>
                                                {{$dailyLabor->nameDailyLabor}}
                                            </li>
                                            @endif
                                        @endforeach

                                        @foreach ($labors as $labor)
                                            @if ($rtLabor->dailyLabor_fk == $labor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                            <li>
                                                {{$labor->name_category}} -- ${{$rtLabor->amount}}
                                            </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="cardList" style="margin-bottom: 5px;">
                        <div class="card-body" style="padding: 5px;">
                            <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Extra Labor</h5>
                            <div class="row">
                                @foreach ($reportExtralabor as $rExtralabor)
                                    @if ($rExtralabor->dailyReport_fk == $dailyReport->id)
                                        <div class="col-6">
                                            <b>Name:</b> {{$rExtralabor->nameMoreReport}} 
                                        </div>
                                        <div class="col-6">
                                            <b>Payment:</b> ${{$rExtralabor->amountMoreReport}}   
                                        </div>
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> 

                    <div class="card" id="cardList" style="margin-bottom: 5px;">
                        <div class="card-body" style="padding: 5px;">
                            <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Subcontractor</h5>
                            <div class="row">
                                @foreach ($reportSubcontractor as $rSContractor)
                                    @if ($rSContractor->dailyReport_fk == $dailyReport->id)
                                        <div class="col-6">
                                            <b>Name:</b> {{$rSContractor->nameMoreReport}} 
                                        </div>
                                        <div class="col-6">
                                            <b>Payment:</b> ${{$rSContractor->amountMoreReport}}   
                                        </div>
                                        @if ($rSContractor->descriptionMoreReport != null)
                                            <div class="col-12">
                                                <b>Description:</b> {{$rSContractor->descriptionMoreReport}}   
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> 

                    <div class="card" id="cardList" style="margin-bottom: 5px;">
                        <div class="card-body" style="padding: 5px;">
                            <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Comments</h5>
                            <div class="row">
                                <div class="col-12" style="text-align: left;">
                                    {{$dailyReport->comments}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="cardList" style="margin-bottom: 5px;">
                        <div class="card-body" style="padding: 5px;">
                            <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Images</h5>
                            <div class="row text-left">
                                <ul>
                                    @foreach ($images as $image)
                                        @if ($image->dailyReport_fk == $dailyReport->id)
                                        <li><a href="{{ URL::asset('imageDailyReport/'.$image->nameImageDailyReport) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$image->nameImageDailyReport)}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Default dropleft button -->
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('editDailyReport', $dailyReport)}}" >Edit</a>
                            <a class="dropdown-item" href="{{route('deleteDailyReport', $dailyReport)}}" >Delete</a>
                        </div>
                    </div>
                <a class="btn btn-success"  href="{{route('statusDailyReport', $dailyReport)}} role="button">Saved</a>
                </div>
            </div>
            </div>
        </div>
    @endforeach

    
    {{-- Mobile --}}
    <div class="list-group mobile" id="accordion" >
        @foreach ($allDailyReports as $dailyReport )
        <div href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#collapse{{$dailyReport->id}}" aria-expanded="false" aria-controls="collapse{{$dailyReport->id}}">
            <div class="row" style="text-align: left;">
                <div class="col-4" style="padding-right: 0px;">
                    Date
                </div>
                <div class="col-8" style="padding-left: 0px;">
                    {{$dailyReport->dateDailyReport}}
                </div>
            </div>
            <div class="row" style="text-align: left;">
                <div class="col-4" style="padding-right: 0px;">
                    Project
                </div>
                <div class="col-8" style="padding-left: 0px;">
                    {{$dailyReport->project->name_project}}
                </div>
            </div>
            <div class="row" style="text-align: left;">
                <div class="col-4" style="padding-right: 0px;">
                    Status
                </div>
                <div class="col-8" style="padding-left: 0px;">
                    {{$dailyReport->statusDailyReport}}
                </div>
            </div>
        </div>

        <div id="collapse{{$dailyReport->id}}" class="collapse" aria-labelledby="heading{{$dailyReport->id}}" data-parent="#accordion" >
            <div class="card" id="cardList" style="background: #f5f5f5;">
                @foreach ($reportTruck as $rtTruck)
                        @foreach ($allDailyTrucks as $dailyTrucks)
                            @if ($rtTruck->dailyTruck_fk == $dailyTrucks->id && $rtTruck->dailyReport_fk == $dailyReport->id)
                                <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">{{$dailyTrucks->categoryTypeTruck}} - {{$dailyTrucks->nameTypeTruck}}</h5>
                                <div class="row" style="text-align: left;">
                                    <div class="col-4" style="padding-left: 30px;">
                                        Quantity:
                                    </div>
                                    <div class="col-8">
                                        {{$rtTruck->quantityDailyTruck}}
                                    </div>
                                </div>
                                <div class="row" style="text-align: left;">
                                    <div class="col-4" style="padding-left: 30px;">
                                        Price:
                                    </div>
                                    <div class="col-8">
                                        @if ($rtTruck->priceDailyTruck != null)
                                            ${{$rtTruck->priceDailyTruck}}
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="text-align: left;">
                                    <div class="col-4" style="padding-left: 30px;">
                                        Provider:
                                    </div>
                                    <div class="col-8">
                                        {{$rtTruck->nameProviderTruck}}
                                    </div>
                                </div>
                                @if ($rtTruck->commentsDailyTruck != null)
                                    <div class="row" style="text-align: left;">
                                        <div class="col-4" style="padding-left: 30px;">
                                            Comments
                                        </div>
                                        <div class="col-8">
                                            {{$rtTruck->commentsDailyTruck}}
                                        </div>
                                    </div>
                                @endif
                                <hr>
                            @endif
                        @endforeach
                    @endforeach
                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Labor</h5>
                    <div class="row">
                        <ul>
                            @foreach ($reportLabor as $rtLabor)
                                @foreach ($allDailyLabor as $dailyLabor)
                                    @if ($rtLabor->dailyLabor_fk == $dailyLabor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                    <li>
                                        {{$dailyLabor->nameDailyLabor}}
                                    </li>
                                    @endif
                                @endforeach

                                @foreach ($labors as $labor)
                                    @if ($rtLabor->dailyLabor_fk == $labor->id && $rtLabor->dailyReport_fk == $dailyReport->id)
                                    <li>
                                        {{$labor->name_category}} -- ${{$rtLabor->amount}}
                                    </li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </div>

                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Extra Labor</h5>
                    @foreach ($reportExtralabor as $rExtralabor)
                        @if ($rExtralabor->dailyReport_fk == $dailyReport->id)
                            <div class="row" style="text-align: left;">
                                <div class="col-4" style="padding-left: 30px;">
                                    Name:
                                </div>
                                <div class="col-8">
                                    {{$rExtralabor->nameMoreReport}}
                                </div>
                            </div>
                            <div class="row" style="text-align: left;">
                                <div class="col-4" style="padding-left: 30px;">
                                    Payment:
                                </div>
                                <div class="col-8">
                                    ${{$rExtralabor->amountMoreReport}}
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Subcontractor</h5>
                    @foreach ($reportSubcontractor as $rSContractor)
                        @if ($rSContractor->dailyReport_fk == $dailyReport->id)
                            <div class="row" style="text-align: left;">
                                <div class="col-4" style="padding-left: 30px;">
                                    Name:
                                </div>
                                <div class="col-8">
                                    {{$rSContractor->nameMoreReport}}
                                </div>
                            </div>
                            <div class="row" style="text-align: left;">
                                <div class="col-4" style="padding-left: 30px;">
                                    Payment:
                                </div>
                                <div class="col-8">
                                    ${{$rSContractor->amountMoreReport}}
                                </div>
                            </div>
                            @if ($rSContractor->descriptionMoreReport != null)
                                <div class="row" style="text-align: left;">
                                    <div class="col-4" style="padding-left: 30px; padding-right:0px;">
                                        Description:
                                    </div>
                                    <div class="col-8">
                                        {{$rSContractor->descriptionMoreReport}}
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                    
                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Comments</h5>
                    <div class="row">
                        <div class="col-12" style="text-align: left;padding-left: 30px;">
                            {{$dailyReport->comments}}
                        </div>
                    </div>

                    <h5 id="titleInfoCard" style="margin-left: 5px; margin-bottom: 3px; font-size: 1rem;">Images</h5>
                    <div class="row text-left">
                        <ul>
                            @foreach ($images as $image)
                                @if ($image->dailyReport_fk == $dailyReport->id)
                                <li><a href="{{ URL::asset('imageDailyReport/'.$image->nameImageDailyReport) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg'),'',$image->nameImageDailyReport)}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div> 
                    
                    <br>
                    <div class="text-center">
                        <a class="btn btn-sm btn-success" href="{{route('statusDailyReport', $dailyReport)}}" role="button" style="margin-bottom: 5px; width: 50%; padding: 0px 8px;">Saved</a>
                    </div>
                    <div class="text-center">
                        <div class="row">
                            <div class="col" style="text-align: right; padding-right: 4px;">
                                <a class="btn btn-sm btn-primary" href="{{route('editDailyReport', $dailyReport)}}" role="button" style="margin-bottom: 5px; width: 50%; padding: 0px 8px;">Edit</a>
                            </div>
                            <div class="col" style="text-align: left; padding-left: 4px;">
                                <a class="btn btn-sm btn-danger" href="{{route('deleteDailyReport', $dailyReport)}}" role="button" style="margin-bottom: 5px; width: 50%; padding: 0px 8px;">Delete</a>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
        @endforeach
        
    </div>
    <br>

    </div>
    </div>
    
</div>
<style>
h6{
    margin-bottom: 0px;
}
.underline{
    text-decoration: underline
}
.example_wrapper{
    padding-top: 10px;
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

@media only screen and (min-width: 600px) {
    div.mobile{
        display: none;
    }
    
}

@media only screen and (max-width: 600px) {
    table.desktop{
        display: none;
    }
    div.desktop{
        display:none; 
    }
    div.dataTables_wrapper{
        display: none;
    }
}

</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".sampleTable").fancyTable({
          /* Column number for initial sorting*/
           /* sortColumn:0, */
           /* Setting pagination or enabling */
           pagination: true,
           /* Rows per page kept for display */
           perPage:15,
           globalSearch:true
           });
                      
    });
    $(".noprop").click(function(event) {
event.stopPropagation();
});

$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>


@stop


