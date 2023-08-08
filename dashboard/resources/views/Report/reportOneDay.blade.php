@extends('master')
@section('title')
    <title>Day</title>
@stop
@section('extra_links')
    
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>

    {{-- Report CSS --}}
    {{ HTML::style('css/report/report.css') }}
    {{-- <link rel="stylesheet" href="report/report.css"> --}}
    {{ HTML::script('js/reports/reports.js') }}

    


@stop
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-center">
                <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col text-center">
                
            </div>
            <div class="col text-center">
                <a href="#"><div class="btn btn-outline-danger btn-sm ocultar" >Print PDF</div></a>
            </div>
        </div>
    </div>

    <div class="container-fluid" > 
        <figure class="text-center">
            <blockquote class="blockquote">
                <length id="showDate" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Dates">Report of {{$date}}</length>
            </blockquote>
        </figure>
        <figure class="text-center">
            <div class="dropdown" id="hideDropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Day
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#"  onclick="location.href='/dashboard/public/reportsToday/'+today+'/'+1;return false;">Today</a>
                  <a class="dropdown-item" href="#" onclick="location.href='/dashboard/public/reportsThisWeek/'+startDate+'/'+endDate+'/'+2;return false;">This Week</a>
                  <a class="dropdown-item" href="#" onclick="location.href='/dashboard/public/reportsLastWeek/'+lastWeekStart+'/'+lastWeekEnd+'/'+3;return false;">Last Week</a>
                  <a class="dropdown-item" href="#" onclick="location.href='/dashboard/public/reportsThisMonth/'+startMonth+'/'+endtMonth+'/'+6;return false;">This Month</a>
                  <a class="dropdown-item" href="#" onclick="location.href='/dashboard/public/reportsLastMonth/'+startLastMonth+'/'+endLastMonth+'/'+7;return false;">Last Month</a>
                </div>
              </div>
          </figure>
        <!-- START - Datepicker -->
        <div class="container" id="calendar" style="display: none">
            <div class="row">
                <div class="col-4"></div>
                <div class="card bg-light col-md-4" style="margin: 10px;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title text-center">Dates</h5>
                            <div  style="font-size: 12px;">
                                <div class="row">
                                    <div class="col">
                                        <label style="font-size: 12px;">Start Date</label>
                                        <input style="align: center;" type="text" id="datepicker" width="120" name="start_date" autocomplete="off" required>
                                    </div>
                                    <div class="col date2">
                                        <label style="font-size: 12px;">End Date</label>
                                        <input type="text" id="datepicker2" width="120" name="end_date" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a type="nav-link" href="#" id="twoDays" class="btn btn-secondary btn-sm">Send</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Col 4 -->
            </div> <!-- End Row -->
        </div>
        <!-- END - Datepicker -->
        <!-- START - Secciones por fecha -->
        <div class="card text-center">
        <!-- START - Secciones por fecha -->
            <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="hideNav">
                
                <li class="nav-item">
                    {{-- <a class="nav-link" aria-current="true" href="#"  onclick="location.href='/reportsToday/'+today+'/'+1;return false;"><b>Today</b></a> --}}
                    <a class="nav-link" aria-current="true" href="#"  onclick="location.href='/dashboard/public/reportsToday/'+today+'/'+1;return false;"><b>Today</b></a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/reportsThisWeek/'+startDate+'/'+endDate+'/'+2;return false;"><b>This Week</b></a> --}}
                    <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/reportsThisWeek/'+startDate+'/'+endDate+'/'+2;return false;"><b>This Week</b></a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/reportsLastWeek/'+lastWeekStart+'/'+lastWeekEnd+'/'+3;return false;"><b>Last Week</b></a> --}}
                    <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/reportsLastWeek/'+lastWeekStart+'/'+lastWeekEnd+'/'+3;return false;"><b>Last Week</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#" id="navLinkDate"><b>Dates</b></a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/reportsThisMonth/'+startMonth+'/'+endtMonth+'/'+6;return false;"><b>This Month</b></a> --}}
                    <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/reportsThisMonth/'+startMonth+'/'+endtMonth+'/'+6;return false;"><b>This Month</b></a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/reportsLastMonth/'+startLastMonth+'/'+endLastMonth+'/'+7;return false;"><b>Last Month</b></a> --}}
                    <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/reportsLastMonth/'+startLastMonth+'/'+endLastMonth+'/'+7;return false;"><b>Last Month</b></a>
                </li>
                
            </ul>
            </div>
            <!-- END - Secciones por fecha --> 

{{--             <div class="card-body">
                <!-- START - Muestra la cantidad de proyectos empezados y finalizados-->
                <h3 class="text-center">Jobs Started and Finished</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-3" >
                    <div class="card-projects" style="border-color: white;">
                        <div class="card-body" >
                        <h4 class="card-title"><span class="badge bg-success" style="color: white;">{{$nPStarts}}</span> Started</h4>
                        <div id="accordion" role="tablist">
                            @foreach ( $projectsStarts as $projectStart )
                            <div class="card">
                            <div class="card-header" id="headingOne" style="padding: 0px;">
                                <h5 class="mb-0">
                                <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#Scollapse{{$projectStart->id}}" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="res">{{$projectStart->name_project}}</div>
                                    <div class="text-center"> 
                                    {{$projectStart->start_date_project}} - {{$projectStart->end_date_project}}
                                    </div>
                                </button>
                                </h5>
                            </div>
                            <div id="Scollapse{{$projectStart->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                                @switch($projectStart->status_fk)
                                    @case(1)
                                        <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$projectStart->statu->name_status}}</span></div>
                                        @break
                                    @case(2)
                                        <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$projectStart->statu->name_status}}</span></div>
                                        @break
                                    @case(3)
                                        <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$projectStart->statu->name_status}}</span></div>
                                        @break
                                    @case(4)
                                        <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$projectStart->statu->name_status}}</span></div>
                                        @break
                                    @case(5)
                                        <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$projectStart->statu->name_status}}</span></div>
                                        @break
                                    @default 
                                @endswitch
                                <label style="font-size: 14px;">Project Sold: </label>
                                <label style="font-size: 14px;">${{$projectStart->sold_project}}</label><br> 
                                <label style="font-size: 14px;">Budget Project: </label>
                                <label style="font-size: 14px;">${{$projectStart->budget_project}}</label><br>
                                @foreach ($purProStarts as $purProStart )
                                    @if($purProStart['id'] == $projectStart->id )
                                    <label style="font-size: 14px;">Current Spent: </label>
                                    <label style="font-size: 14px;">${{$purProStart['value']}}</label><br>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-3">
                    <div class="card-projects">
                        <div class="card-body">
                        <h4 class="card-title"><span class="badge bg-danger" style="color: white;">{{$nPFinished}}</span> Finished </h4>
                        <div id="accordion" role="tablist">
                            @foreach ( $projectsFinished as $projectFinished )
                            <div class="card">
                            <div class="card-header" id="headingOne" style="padding: 0px;">
                                <h5 class="mb-0">
                                <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#Fcollapse{{$projectFinished->id}}" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="res">{{$projectFinished->name_project}}</div>
                                    <div class="text-center"> 
                                    {{$projectFinished->start_date_project}} - {{$projectFinished->end_date_project}}
                                    </div>
                                </button>
                                </h5>
                            </div>
                            <div id="Fcollapse{{$projectFinished->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                                @switch($projectFinished->status_fk)
                                    @case(1)
                                        <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$projectFinished->statu->name_status}}</span></div>
                                        @break
                                    @case(2)
                                        <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$projectFinished->statu->name_status}}</span></div>
                                        @break
                                    @case(3)
                                        <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$projectFinished->statu->name_status}}</span></div>
                                        @break
                                    @case(4)
                                        <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$projectFinished->statu->name_status}}</span></div>
                                        @break
                                    @case(5)
                                        <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$projectFinished->statu->name_status}}</span></div>
                                        @break
                                    @default 
                                @endswitch
                                <label style="font-size: 14px;">Project Sold: </label>
                                <label style="font-size: 14px;">${{$projectFinished->sold_project}}</label><br> 
                                <label style="font-size: 14px;">Budget Project: </label>
                                <label style="font-size: 14px;">${{$projectFinished->budget_project}}</label><br>
                                @foreach ($purProFinish as $purPFinish )
                                    @if($purPFinish['id'] == $projectFinished->id )
                                    <label style="font-size: 14px;">Current Spent: </label>
                                    <label style="font-size: 14px;">${{$purPFinish['value']}}</label><br>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    </div> 
                    <div class="col-sm-3">
                        <div class="card-projects">
                        <div class="card-body">
                            <h4 class="card-title"><span class="badge bg-warning" style="color: white;">{{$nPActivates}}</span> Ongoing</h4>
                            <div id="accordion">
                            @foreach ( $projectsActivates as $projectActivate )
                            <div class="card">
                                <div class="card-header" id="headingOne" style="padding: 0px;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#Acollapse{{$projectActivate->id}}" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="res">{{$projectActivate->name_project}}</div>
                                    <div class="text-center"> 
                                        {{$projectActivate->start_date_project}} - {{$projectActivate->end_date_project}}
                                    </div>
                                    </button>
                                </h5>
                                </div>
                                <div id="Acollapse{{$projectActivate->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                                    @switch($projectActivate->status_fk)
                                        @case(1)
                                            <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$projectActivate->statu->name_status}}</span></div>
                                            @break
                                        @case(2)
                                            <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$projectActivate->statu->name_status}}</span></div>
                                            @break
                                        @case(3)
                                            <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$projectActivate->statu->name_status}}</span></div>
                                            @break
                                        @case(4)
                                            <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$projectActivate->statu->name_status}}</span></div>
                                            @break
                                        @case(5)
                                            <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$projectActivate->statu->name_status}}</span></div>
                                            @break
                                        @default 
                                    @endswitch
                                    <label style="font-size: 14px;">Project Sold: </label>
                                    <label style="font-size: 14px;">${{$projectActivate->sold_project}}</label><br> 
                                    <label style="font-size: 14px;">Budget Project: </label>
                                    <label style="font-size: 14px;">${{$projectActivate->budget_project}}</label><br>
                                    @foreach ($purProActivate as $purPActivate )
                                    @if($purPActivate['id'] == $projectActivate->id )
                                        <label style="font-size: 14px;">Current Spent: </label>
                                        <label style="font-size: 14px;">${{$purPActivate['value']}}</label><br>
                                    @endif
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            @endforeach
                            </div>
                        </div>
                        </div>
                    </div>

                    @if ($nPPaused != 0)
                <div class="col-sm-3">
                  <div class="card-projects">
                    <div class="card-body">
                      <h4 class="card-title"><span class="badge bg-secondary" style="color: white;">{{$nPPaused}}</span> Paused</h4>
                      <div id="accordion">
                        @foreach ( $projectsPaused as $pPaused )
                        <div class="card">
                          <div class="card-header" id="headingOne" style="padding: 0px;">
                            <h5 class="mb-0">
                              <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#Acollapse{{$pPaused->id}}" aria-expanded="false" aria-controls="collapseOne">
                                <div class="res">{{$pPaused->name_project}}</div>
                                <div class="text-center"> 
                                  {{$pPaused->start_date_project}} - {{$pPaused->end_date_project}}
                                </div>
                              </button>
                            </h5>
                          </div>
                          <div id="Acollapse{{$pPaused->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                              @switch($pPaused->status_fk)
                                  @case(1)
                                      <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$pPaused->statu->name_status}}</span></div>
                                      @break
                                  @case(2)
                                      <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$pPaused->statu->name_status}}</span></div>
                                      @break
                                  @case(3)
                                      <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$pPaused->statu->name_status}}</span></div>
                                      @break
                                  @case(4)
                                      <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$pPaused->statu->name_status}}</span></div>
                                      @break
                                  @case(5)
                                      <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$pPaused->statu->name_status}}</span></div>
                                      @break
                                  @default 
                              @endswitch
                              <label style="font-size: 14px;">Project Sold: </label>
                              <label style="font-size: 14px;">${{$pPaused->sold_project}}</label><br> 
                              <label style="font-size: 14px;">Budget Project: </label>
                              <label style="font-size: 14px;">${{$pPaused->budget_project}}</label><br>
                                @foreach ($purProPaused as $purPPaused )
                                    @if($purPPaused['id'] == $pPaused->id )
                                        <label style="font-size: 14px;">Current Spent: </label>
                                        <label style="font-size: 14px;">${{$purPPaused['value']}}</label><br>
                                    @endif
                                @endforeach
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                
                    {{-- <div class="col-sm-3">
                        <div class="card-projects">
                            <div class="card-body">
                            <h4 class="card-title"><span class="badge bg-info" style="color: white;">{{$nPNext}}</span> Next Projects</h4>
                            <div id="accordion">
                                @foreach ( $projectsNext as $projectNext )
                                <div class="card">
                                <div class="card-header" id="headingOne" style="padding: 0px;">
                                    <h5 class="mb-0">
                                    <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#NPcollapse{{$projectNext->id}}" aria-expanded="false" aria-controls="collapseOne">
                                        <div class="res">{{$projectNext->name_project}}</div>
                                        <div class="text-center"> 
                                        {{$projectNext->start_date_project}} - {{$projectNext->end_date_project}}
                                        </div>
                                    </button>
                                    </h5>
                                </div>
                                <div id="NPcollapse{{$projectNext->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                                    @switch($projectNext->status_fk)
                                        @case(1)
                                            <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$projectNext->statu->name_status}}</span></div>
                                            @break
                                        @case(2)
                                            <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$projectNext->statu->name_status}}</span></div>
                                            @break
                                        @case(3)
                                            <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$projectNext->statu->name_status}}</span></div>
                                            @break
                                        @case(4)
                                            <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$projectNext->statu->name_status}}</span></div>
                                            @break
                                        @case(5)
                                            <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$projectNext->statu->name_status}}</span></div>
                                            @break
                                        @default 
                                    @endswitch
                                    <label style="font-size: 14px;">Project Sold: </label>
                                    <label style="font-size: 14px;">${{$projectNext->sold_project}}</label><br> 
                                    <label style="font-size: 14px;">Budget Project: </label>
                                    <label style="font-size: 14px;">${{$projectNext->budget_project}}</label><br>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div> --}}
                    
                    {{--@if ($nPArchived != 0)
                    <div class="col-sm-3">
                        <div class="card-projects">
                          <div class="card-body">
                            <h4 class="card-title"><span class="badge bg-secondary" style="color: white;">{{$nPArchived}}</span> Archived</h4>
                            <div id="accordion">
                              @foreach ( $projectsArchiveds as $pArchived )
                              <div class="card">
                                <div class="card-header" id="headingOne" style="padding: 0px;">
                                  <h5 class="mb-0">
                                    <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#Acollapse{{$pArchived->id}}" aria-expanded="false" aria-controls="collapseOne">
                                      <div class="res">{{$pArchived->name_project}}</div>
                                      <div class="text-center"> 
                                        {{$pArchived->start_date_project}} - {{$pArchived->end_date_project}}
                                      </div>
                                    </button>
                                  </h5>
                                </div>
                                <div id="Acollapse{{$pArchived->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body text-left" style="padding: 0px 0px 0px 5px;" >
                                    @switch($pArchived->status_fk)
                                        @case(1)
                                            <div class="text-center"><span class="badge bg-success" style="color: white; margin-top: 5px;">{{$pArchived->statu->name_status}}</span></div>
                                            @break
                                        @case(2)
                                            <div class="text-center"><span class="badge bg-danger" style="color: white; margin-top: 5px;">{{$pArchived->statu->name_status}}</span></div>
                                            @break
                                        @case(3)
                                            <div class="text-center"><span class="badge bg-warning" style="color: white; margin-top: 5px;">{{$pArchived->statu->name_status}}</span></div>
                                            @break
                                        @case(4)
                                            <div class="text-center"><span class="badge bg-secondary" style="color: white; margin-top: 5px;">{{$pArchived->statu->name_status}}</span></div>
                                            @break
                                        @case(5)
                                            <div class="text-center"><span class="badge bg-dark" style="color: white; margin-top: 5px;">{{$pArchived->statu->name_status}}</span></div>
                                            @break
                                        @default 
                                    @endswitch
                                    <label style="font-size: 14px;">Project Sold: </label>
                                    <label style="font-size: 14px;">${{$pArchived->sold_project}}</label><br> 
                                    <label style="font-size: 14px;">Budget Project: </label>
                                    <label style="font-size: 14px;">${{$pArchived->budget_project}}</label><br>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                    </div>
                        
                    @endif
                    
                    </div>
                    <br>
                    <!-- END - Muestra la cantidad de proyectos empezados y finalizados-->
                    <hr>
                </div> --}}

                <br>
                <!-- START - Muestra el Payroll de los proyectos por categorias -->
                <length class="text-center" id="titulosResponsive"><a href="{{route('payrollOneDay',[$day,$day,4])}}">Total Payroll</a></length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalPayroll,2)}}</length>
                @if ($totalPayroll != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                    <table class="table table-striped" border="1">
                        <tbody>
                            <tr>
                                <td style="border-color: black; vertical-align:middle" width="450" align="center">
                                <strong>{{$date}}</strong>
                                </td>
                                <td style="border-color: black; vertical-align:middle" width="450">
                                    @foreach ($totalXProjectDay as $total)
                                        @if ($total['total'] != 0)
                                            @foreach ($allProjects as $allP )
                                                @if ($total['idPro'] == $allP->id)
                                                <strong>*{{$allP->name_project}}: ${{number_format($total['total'],2)}}</strong>
                                                <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td style="border-color: black; vertical-align:middle" width="450" align="center">
                                    <strong>${{number_format($totalPayroll,2)}}</strong>   
                                </td>
                            </tr> 
                        </tbody>
                        </table>
                </div>
                @endif
                <!-- END - Muestra el Payroll de los proyectos por categorias -->

                <!-- START - Muestra el Total Truck por proyecto -->
                <length class="text-center" id="titulosResponsive">Trucking Summary</length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalCurrentTrucking,2)}}</length>
                @if ($totalCurrentTrucking != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                <table class="table table-striped" border="1" >
                <tbody>
                    @foreach ($totalComprasTruck as $project)
                    @if ($project['total'] != 0)
                    <tr>
                        <td style="border-color: black; vertical-align:middle" width="450">
                            <strong>{{$project['projectName']}}</strong> 
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450" align="center">
                            <strong>Total:</strong> <em>${{number_format($project['total'],2)}}</em> 
                        </td>
                        <td style="border-color: black;" width="450">
                        @if ($project['tCMaterialE'] !=0 )
                            <div class="row-sm">
                            <strong>Material Export:</strong> <em>${{number_format($project['tCMaterialE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCExportE'] !=0 )
                            <div class="row-sm">
                            <strong>Concrete Truck Export:</strong> <em>${{number_format($project['tCExportE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCDirtE'] !=0 )
                            <div class="row-sm">
                            <strong>Dirt Truck Export:</strong> <em>${{number_format($project['tCDirtE'],2)}}</em>
                            </div>
                        @endif
                        @if ($project['tCMixedE'] !=0 )
                            <div class="row-sm">
                            <strong>Mixed Truck Export:</strong> <em>${{number_format($project['tCMixedE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCTrashE'] !=0 )
                            <div class="row-sm">
                            <strong>Trash Truck Export:</strong> <em>${{number_format($project['tCTrashE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCAsphaltE'] !=0 )
                            <div class="row-sm">
                            <strong>Asphalt Truck Export:</strong> <em>${{number_format($project['tCAsphaltE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCDirtRockE'] !=0 )
                            <div class="row-sm">
                            <strong>Dirt + Rock Truck Export:</strong> <em>${{number_format($project['tCDirtRockE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCTrash40CYE'] !=0 )
                            <div class="row-sm">
                            <strong>Trash 40CY Truck Export:</strong> <em>${{number_format($project['tCTrash40CYE'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCSandI'] !=0 )
                            <div class="row-sm">
                            <strong>Sand Truck Import:</strong> <em>${{number_format($project['tCSandI'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCBaseI'] !=0 )
                            <div class="row-sm">
                            <strong>Base Truck Import:</strong> <em>${{number_format($project['tCBaseI'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCGravelI'] !=0 )
                        <div class="row-sm">
                            <strong>Gravel Truck Import:</strong> <em>${{number_format($project['tCGravelI'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCSoilI'] !=0 )
                        <div class="row-sm">
                            <strong>Soil Truck Import:</strong> <em>${{number_format($project['tCSoilI'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCDirtI'] !=0 )
                        <div class="row-sm">
                            <strong>Dirt Truck Import:</strong> <em>${{number_format($project['tCDirtI'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCAsphaltI'] !=0 )
                        <div class="row-sm">
                            <strong>Asphalt Truck Import:</strong> <em>${{number_format($project['tCAsphaltI'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCAggregatesI'] !=0 )
                        <div class="row-sm">
                            <strong>Aggregates Truck Import:</strong> <em>${{number_format($project['tCAggregatesI'],2)}}</em> 
                        </div>
                        @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>
                </div>
                @endif
                <!-- END - Muestra el Total Truck por proyecto -->

                <!-- START - Muestra el Total Truck por categoria -->
                <length class="text-center" id="titulosResponsive">Truck Category</length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalCurrentTrucking,2)}}</length>
                @if ($totalCurrentTrucking != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                <table class="table table-striped" border="1">
                <tbody>
                    <tr>
                        <td style="border-color: black; vertical-align:middle" width="450">
                            <strong>Export</strong> 
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450" align="center">
                            <strong>Total:</strong> <em>${{number_format($arrayTotalExport[0]['total'],2)}}</em> 
                        </td>
                        <td style="border-color: black;" width="450">
                            @if ($arrayTotalExport[0]['Material'] !=0 )
                            <div class="row-sm">
                            <strong>Material</strong> <em>${{number_format($arrayTotalExport[0]['Material'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Export'] !=0 )
                            <div class="row-sm">
                            <strong>Concrete Truck</strong> <em>${{number_format($arrayTotalExport[0]['Export'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Dirt'] !=0 )
                            <div class="row-sm">
                            <strong>Dirt Truck</strong> <em>${{number_format($arrayTotalExport[0]['Dirt'],2)}}</em>
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Mixed'] !=0 )
                            <div class="row-sm">
                            <strong>Mixed Truck</strong> <em>${{number_format($arrayTotalExport[0]['Mixed'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Trash'] !=0 )
                            <div class="row-sm">
                            <strong>Trash Truck</strong> <em>${{number_format($arrayTotalExport[0]['Trash'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Asphalt'] !=0 )
                            <div class="row-sm">
                            <strong>Asphalt Truck</strong> <em>${{number_format($arrayTotalExport[0]['Asphalt'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['DirtRock'] !=0 )
                            <div class="row-sm">
                            <strong>Dirt + Rock Truck</strong> <em>${{number_format($arrayTotalExport[0]['DirtRock'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalExport[0]['Trash40CY'] !=0 )
                            <div class="row-sm">
                            <strong>Trash 40CY Truck</strong> <em>${{number_format($arrayTotalExport[0]['Trash40CY'],2)}}</em> 
                            </div>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border-color: black; vertical-align:middle" width="450">
                        <strong>Imports</strong> 
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450" align="center">
                        <strong>Total:</strong> <em>${{number_format($arrayTotalImport[0]['total'],2)}}</em> 
                        </td>
                        <td style="border-color: black;" width="450">
                        @if ($arrayTotalImport[0]['Sand'] !=0 )
                            <div class="row-sm">
                            <strong>Sand Truck</strong> <em>${{number_format($arrayTotalImport[0]['Sand'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalImport[0]['Base'] !=0 )
                            <div class="row-sm">
                            <strong>Base Truck</strong> <em>${{number_format($arrayTotalImport[0]['Base'],2)}}</em> 
                            </div>
                        @endif
                        @if ($arrayTotalImport[0]['Gravel'] !=0 )
                        <div class="row-sm">
                            <strong>Gravel Truck</strong> <em>${{number_format($arrayTotalImport[0]['Gravel'],2)}}</em> 
                        </div>
                        @endif
                        @if ($arrayTotalImport[0]['Soil'] !=0 )
                        <div class="row-sm">
                            <strong>Soil Truck</strong> <em>${{number_format($arrayTotalImport[0]['Soil'],2)}}</em> 
                        </div>
                        @endif
                        @if ($arrayTotalImport[0]['Dirt'] !=0 )
                        <div class="row-sm">
                            <strong>Dirt Truck</strong> <em>${{number_format($arrayTotalImport[0]['Dirt'],2)}}</em> 
                        </div>
                        @endif
                        @if ($arrayTotalImport[0]['Asphalt'] !=0 )
                        <div class="row-sm">
                            <strong>Asphalt Truck</strong> <em>${{number_format($arrayTotalImport[0]['Asphalt'],2)}}</em> 
                        </div>
                        @endif
                        @if ($arrayTotalImport[0]['Aggregates'] !=0 )
                        <div class="row-sm">
                            <strong>Aggregates Truck</strong> <em>${{number_format($arrayTotalImport[0]['Aggregates'],2)}}</em> 
                        </div>
                        @endif

                        </td>

                    </tr>
                </tbody>
                </table>
                </div>
                @endif
                <!-- END - Muestra el Total Truck por categoria -->

                <!-- START - Muestra el Total de Concrete Mix & Pump -->
                <length class="text-center" id="titulosResponsive">Concrete Mix & Pump</length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalCurrentMixPump,2)}}</length>
                @if ($totalCurrentMixPump != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                    <table class="table table-striped" border="1">
                    <tbody>
                        @foreach ($totalConcreteMix_pump as $project)
                        @if ($project['total'] != 0)
                        <tr>
                            <td style="border-color: black; vertical-align:middle" width="450">
                            <strong>{{$project['projectName']}}</strong> 
                            </td>
                            <td style="border-color: black; vertical-align:middle" width="450" align="center">
                            <strong>Total:</strong> <em>${{number_format($project['total'],2)}}</em> 
                            </td>
                            <td style="border-color: black;" width="450">
                            @if ($project['tCConcreteMix'] !=0 )
                            <div class="row-sm">
                                <strong>Concrete Mix:</strong> <em>${{number_format($project['tCConcreteMix'],2)}}</em> 
                            </div>
                            @endif
                            @if ($project['tCPump'] !=0 )
                            <div class="row-sm">
                                <strong>Pump:</strong> <em>${{number_format($project['tCPump'],2)}}</em> 
                            </div>
                            @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </table>
                </div>
                @endif
                <!-- END - Muestra el Total de Concrete Mix & Pump -->

                <!-- START - Muestra el Total de Subcontractor -->
                <length class="text-center" id="titulosResponsive">Subcontractor</length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalCurrentSubcontractor,2)}}</length>
                @if ($totalCurrentSubcontractor != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                <table class="table table-striped" border="1">
                    <tbody>
                    @foreach ($totalSubcontractor as $project)
                        @if ($project['tCSubcontra'] != 0)
                        <tr>
                        <td style="border-color: black; vertical-align:middle" width="450">
                            <strong>{{$project['projectName']}}</strong> 
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450" align="center">
                            <strong>Total:</strong> <em>${{number_format($project['tCSubcontra'],2)}}</em> 
                        </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                </div>
                @endif
                <!-- END - Muestra el Total de Subcontractor -->

                <!-- START - Muestra el Total de otras compras -->
                <length class="text-center" id="titulosResponsive">Other Expenses Summary</length>
                <length class="text-center" id="titulosResponsive">${{number_format($totalCurrentOther,2)}}</length>
                @if ($totalCurrentOther != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                <table class="table table-striped" border="1">
                <tbody>
                    @foreach ($totalComprasOther as $project)
                    @if ($project['total'] != 0)
                    <tr>
                        <td style="border-color: black; vertical-align:middle" width="450">
                            <strong>{{$project['projectName']}}</strong> 
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450" align="center">
                            <strong>Total:</strong> <em>${{number_format($project['total'],2)}}</em> 
                        </td>
                        <td style="border-color: black;" width="450">
                        @if ($project['tCToolMa'] !=0 )
                            <div class="row-sm">
                            <strong>Tools & Materials:</strong> <em>${{number_format($project['tCToolMa'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCAggre'] !=0 )
                            <div class="row-sm">
                            <strong>Aggregates Import:</strong> <em>${{number_format($project['tCAggre'],2)}}</em>
                            </div>
                        @endif
                        @if ($project['tCHome'] !=0 )
                            <div class="row-sm">
                            <strong>Homedepot:</strong> <em>${{number_format($project['tCHome'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCMateria'] !=0 )
                            <div class="row-sm">
                            <strong>Materials:</strong> <em>${{number_format($project['tCMateria'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCRepair'] !=0 )
                            <div class="row-sm">
                            <strong>Repairs/Tow:</strong> <em>${{number_format($project['tCRepair'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCEquipmentRental'] !=0 )
                            <div class="row-sm">
                            <strong>Equipment Rental:</strong> <em>${{number_format($project['tCEquipmentRental'],2)}}</em> 
                            </div>
                        @endif
                        @if ($project['tCImport'] !=0 )
                        <div class="row-sm">
                            <strong>Import (Aggregates):</strong> <em>${{number_format($project['tCImport'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCOffice'] !=0 )
                        <div class="row-sm">
                            <strong>Office/Admin:</strong> <em>${{number_format($project['tCOffice'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCToolPurchase'] !=0 )
                        <div class="row-sm">
                            <strong>Tool Purchase:</strong> <em>${{number_format($project['tCToolPurchase'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCToolRental'] !=0 )
                        <div class="row-sm">
                            <strong>Tools Rental:</strong> <em>${{number_format($project['tCToolRental'],2)}}</em> 
                        </div>
                        @endif
                        @if ($project['tCMiscellaneus'] !=0 )
                        <div class="row-sm">
                            <strong>Miscellaneus:</strong> <em>${{number_format($project['tCMiscellaneus'],2)}}</em> 
                        </div>
                        @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    
                </tbody>
                </table>
                </div>
                @endif
                <!-- END - Muestra el Total de otras compras -->

                <!-- START - Muestra el Current Spent por semana y el detalle por proyecto -->
                <length class="text-center" id="titulosResponsive">Total Current Spent x Day</length>
                <length class="text-center" id="titulosResponsive">${{number_format($sumaXTotalCurrentSpent,2)}}</length>
                @if ($sumaXTotalCurrentSpent != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                    <table class="table table-striped" border="1">
                        <tbody>
                            <tr>
                            <td style="border-color: black; vertical-align:middle" width="450" align="center">
                                <strong>{{$date}}</strong>
                            </td>
                            <td style="border-color: black; vertical-align:middle" width="450" align="center">
                                <strong>Total:</strong> <em>${{number_format($sumaXTotalCurrentSpent,2)}}</em>
                            </td>
                            <td style="border-color: black;" width="450">
                                @foreach ($arrayProjectsXDay as $aProjectsXDay)
                                    @if ($aProjectsXDay['total'] != 0)
                                    @foreach ($allProjects as $allP)
                                        @if ($allP->id == $aProjectsXDay['idPro'])
                                        <div class="row-sm">
                                            <strong> - {{$allP->name_project}}:</strong> <em>${{number_format($aProjectsXDay['total'],2)}}</em> 
                                        </div>
                                        @endif
                                    @endforeach
                                    @endif
                                @endforeach
                            </td>
                            </tr>
                        </tbody>
                        </table>
                </div>
                @endif
                <!-- END - Muestra el Current Spent por semana y el detalle por proyecto -->

                <!-- START - Muestra el detalle de los proyectos que iniciaron en la fecha consultada -->
                <length class="text-center" id="titulosResponsive">Ongoing Projects Overview</length>
                @if ($totalesProjects[0]['totalSpent'] != 0)
                <div class="container-fluid-a" style="overflow-x:auto;">
                    <table class="table table-striped" border="1">
                        <tbody>
                            @foreach ($arrayProfit as $aProfit )
                            <tr>
                                <td style="border-color: black; " width="450">
                                <strong>{{$aProfit['name']}}</strong>
                                <br>
                                    @if ($aProfit['red'] != 0)
                                        <span class="badge badge-danger" style="margin-bottom: 3px;">Finished</span>
                                        {{-- <div class="circulo-red" style="float: right; margin-right: 2px;"></div> --}}
                                    @endif
                                    @if ($aProfit['green'] != 0)
                                        <span class="badge badge-success" style="margin-bottom: 3px;">Started</span>
                                        {{-- <div class="circulo-green" style="float: right; margin-right: 2px;"></div> --}}
                                    @endif
                                    @if ($aProfit['yellow'] != 0)
                                        <span class="badge badge-warning" style="margin-bottom: 3px;">On going</span>
                                        {{-- <div class="circulo-yellow" style="float: right; margin-right: 2px;"></div> --}}
                                    @endif                                     
                                    @if ($aProfit['gray'] != 0)
                                        <span class="badge badge-secondary" style="margin-bottom: 3px;">Paused</span>
                                        {{-- <div class="circulo-gray" style="float: right; margin-right: 2px;"></div> --}}
                                    @endif
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>Budget:</strong> <em>${{number_format($aProfit['budget'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>Sold:</strong> <em>${{number_format($aProfit['sold'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>Expenses unti {{$date}}:</strong> <em>${{number_format($aProfit['expenses'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                    <strong>Current Expenses:</strong> <em>${{number_format($aProfit['totalCurrent'],2)}}</em> 
                                </td>
                                {{-- <td style="border-color: black;" width="450">
                                <strong>Profit:</strong> <em>${{$aProfit['profit']}}</em> 
                                </td> --}}
                            </tr>
                            @endforeach
                            <tr>
                            <td style="border-color: black;" width="450">
                                <strong>Total</strong>  
                            </td>
                            <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjects[0]['budget'],2)}}</strong>
                            </td>
                            <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjects[0]['totalSold'],2)}}</strong>  
                            </td>
                            <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjects[0]['totalSpent'],2)}}</strong> 
                            </td>
                            <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjects[0]['totalCurrent'],2)}}</strong> 
                            </td>
                            {{-- <td style="border-color: black;" width="450">
                                <strong>${{$totalesProjects[0]['totalProfit']}}</strong>
                            </td> --}}
                            </tr> 
                        </tbody>
                        </table>
                </div>
                @else
                    <h5>No project is ongoing</h5>
                @endif
                <!-- END - Muestra el detalle de los proyectos que iniciaron en la fecha consultada -->

                <!-- START - Muestra el detalle de los proyectos finalizados -->
                    <length class="text-center" id="titulosResponsive">Projects Finished Overview</length>
                    @if ($totalesProjectsFinished[0]['tExpensesFinish'] != 0)
                    <div class="container-fluid-a" style="overflow-x:auto;">
                        <table class="table table-striped" border="1" >
                            <tbody>
                            @foreach ($infoProFinish as $infoPFinish )
                            <tr>
                                <td style="border-color: black; " width="450">
                                    <strong>{{$infoPFinish['namePro']}} </strong> 
                                    <br>
                                    <span class="badge badge-danger" style="margin-bottom: 3px;">Finished</span>
                                    {{-- <div class="circulo-red" style="float: right; margin-right: 2px;"></div>  --}}
                                </td>
                                <td style="border-color: black;"  width="450">
                                    <strong>Sold:</strong> <em>${{number_format($infoPFinish['proSold'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                    <strong>Expenses:</strong> <em>${{number_format($infoPFinish['proExpen'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                    <strong>Profit:</strong> <em>${{number_format($infoPFinish['profit'],2)}}</em> 
                                </td>
                                <td style="border-color: black;" width="450">
                                    <strong>Finish Date:</strong> <em>{{$infoPFinish['dateProFinish']}}</em> 
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td style="border-color: black;" width="450">
                                <strong>Total</strong>  
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjectsFinished[0]['tSoldFinish'],2)}}</strong>  
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjectsFinished[0]['tExpensesFinish'],2)}}</strong> 
                                </td>
                                <td style="border-color: black;" width="450">
                                <strong>${{number_format($totalesProjectsFinished[0]['tProfitFinish'],2)}}</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h5>No project has finished</h5>
                    @endif
                <!-- END - Muestra el detalle de los proyectos finalizados -->
        </div>  
        <br>     
    </div>

    <style>
/*     .container-fluid-a{
        border: 1px solid black;
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        margin: 10px;

    }
 */
    .res {
    display: block;
    width: 250px;
    padding: 0 20px;
    margin: 0;
    white-space: pre-wrap;
    text-align: center;
  }

    </style>
@stop
