@extends('master')
@section('title')
    <title></title>
@stop
@section('extra_links')
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>

    {{-- Report CSS --}}
    {{ HTML::style('css/report/report.css') }}
    {{-- <link rel="stylesheet" href="report/report.css"> --}}

    <!-- DataTable JS-->
    <script src="js/projects/dashboardProject.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

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
          <length class="m-0 font-weight-bold text-dark">Report of{{$startDate}} - {{$endDate}}</length>
      </blockquote>
  </figure>
  <!-- START - Secciones por fecha -->
  <div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="true" href="#"><b>Today</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="true" href="#"><b>This Week</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="true" href="#"><b>Last Week</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="true" href="#" id="navLinkDate"><b>Dates</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="true" href="#"><b>This Month</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="true" href="#"><b>Last Month</b></a>
        </li>
        
      </ul>
    </div>
    <!-- END - Secciones por fecha --> 

{{--     <div class="card-body">
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
          <div class="col-sm-3">
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
          </div>
          </div>
          <br>
          <!-- END - Muestra la cantidad de proyectos empezados y finalizados-->
          <hr>
      </div> --}}
<br>
      <!-- START - Muestra el detalle de los proyectos que iniciaron en la fecha consultada -->
      <h3 class="text-center">Projects Overview</h3>
      <div class="container-fluid-a" style="overflow-x:auto;">
        <table class="table table-striped" border="1" >
          <tbody>
            @foreach ($profitArray as $pfitArray )
            <tr>
                <td style="border-color: black; " width="450">
                  <strong>{{$pfitArray['nameProject']}}</strong>  
                </td>
                <td style="border-color: black;"  width="450">
                  <strong>Sold:</strong> <em>${{number_format($pfitArray['soldProject'],2)}}</em> 
                </td>
                <td style="border-color: black;" width="450">
                  <strong>Expenses:</strong> <em>${{number_format($pfitArray['Spent'],2)}}</em> 
                </td>
                <td style="border-color: black;" width="450">
                  <strong>Profit:</strong> <em>${{number_format($pfitArray['profit'],2)}}</em> 
                </td>
            </tr>
            @endforeach
            <tr>
              <td style="border-color: black;" width="450">
                <strong>Total</strong>  
              </td>
              <td style="border-color: black;" width="450">
                <strong>${{number_format($totalesProjects[0]['totalSold'],2)}}</strong>  
              </td>
              <td style="border-color: black;" width="450">
                <strong>${{number_format($totalesProjects[0]['totalSpent'],2)}}</strong> 
              </td>
              <td style="border-color: black;" width="450">
                <strong>${{number_format($totalesProjects[0]['totalProfit'],2)}}</strong>
              </td>
          </tr>
          </tbody>
        </table>
      </div>
      <br>
      <!-- END - Muestra el detalle de los proyectos que iniciaron en la fecha consultada -->


      <!-- START - Muestra el Current Spent por semana y el detalle por proyecto -->
      <h3 class="text-center">Total Current Spent x Week</h3>
      <h3 class="text-center">${{number_format(,2)$totalXQuery}}</h3>
      <div class="container-fluid-a" style="overflow-x:auto;">
      <table class="table table-striped" border="1">
        <tbody>
          @foreach ($fechasXsemana as $fechaXsemana )
          <tr>
              <td style="border-color:black; vertical-align:middle" width="450" align="center">
                @if ($fechaXsemana['week'] == $fechaXsemana['inicio'])
                  <strong>{{$fechaXsemana['startDateQuery']}} - {{$fechaXsemana['week_end']}}</strong>
                @else
                  @if ($fechaXsemana['week'] == $fechaXsemana['final'])
                    <strong>{{$fechaXsemana['week_start']}} - {{$fechaXsemana['endDateQuery']}}</strong>
                  @else
                    <strong>{{$fechaXsemana['week_start']}} - {{$fechaXsemana['week_end']}}</strong>
                  @endif
                @endif
              </td>
              <td style="border-color: black; vertical-align:middle" width="450" align="center">
                @foreach ($totalXWeek as $tXWeek )
                  @if ($tXWeek['week'] == $fechaXsemana['week'])
                    <strong>Total:</strong> <em>${{number_format($tXWeek['total'],2)}}</em> 
                  @endif
                @endforeach
              </td>
              <td style="border-color: black;" width="450">
                {{-- Obtengo el arreglo que contiene el total de compras de proyecto por semana --}}
                @foreach ($totakCurrentSpentxWeek as $tCurrentSpentxWeek )
                  {{-- Muestro las compras del arreglo que pertenecen a esa semana --}}
                  @if($tCurrentSpentxWeek['week'] == $fechaXsemana['week'])
                    {{-- Verifico que solo se muestren los valores diferentes de cero --}}
                    @if ($tCurrentSpentxWeek['acumulador'] != 0)
                      {{-- Obtengo todos los proyectos --}}
                      @foreach ($allProjects as $allP )
                        {{-- Verifico que el id del proyecto sea el mismo que viene del arreglo --}}
                        @if ($allP->id == $tCurrentSpentxWeek['Project'])
                          <div class="row-sm">
                            {{-- Muesto el nombre del proyecto y su total --}}
                            
                              <strong> - {{$allP->name_project}}:</strong> <em>${{number_format($tCurrentSpentxWeek['acumulador'],2)}}</em> 
                            
                          </div>
                        @endif
                      @endforeach
                    @endif
                  @endif
                @endforeach
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      <br>
      <!-- END - Muestra el Current Spent por semana y el detalle por proyecto -->

      <!-- START - Muestra el Payroll de los proyectos por categorias -->
      <h3 class="text-center">Total Payroll</h3>
      <h3 class="text-center">${{$totalOperatorLabor}}</h3>
      <div class="container-fluid-a" style="overflow-x:auto;">
      <table class="table table-striped" border="1">
        <tbody>
          @foreach ($fechasXsemana as $fechaXsemana )
          <tr>
            <td style="border-color: black; vertical-align:middle"  rowspan="2" width="450" align="center" >
              @if ($fechaXsemana['week'] == $fechaXsemana['inicio'])
                  <strong>{{$fechaXsemana['startDateQuery']}} - {{$fechaXsemana['week_end']}}</strong>
                @else
                  @if ($fechaXsemana['week'] == $fechaXsemana['final'])
                    <strong>{{$fechaXsemana['week_start']}} - {{$fechaXsemana['endDateQuery']}}</strong>
                  @else
                    <strong>{{$fechaXsemana['week_start']}} - {{$fechaXsemana['week_end']}}</strong>
                  @endif
                @endif  
            </td>
            <td style="border-color: black; vertical-align:middle" width="450" align="center">
                @foreach ($arrayTotalOperator as $TotalOperator)
                  @if($TotalOperator['week'] == $fechaXsemana['week'])
                    <strong>Operator:</strong> <em>${{number_format($TotalOperator['total'],2)}}</em> 
                  @endif
                @endforeach
              </td>
              <td style="border-color: black;" width="450">
                @foreach ($totalOperatorPayRollxWeek as $tOperatorPayRollxWeek)
                  @if ($tOperatorPayRollxWeek['week'] == $fechaXsemana['week'] )
                    @if ($tOperatorPayRollxWeek['acumulador'] != 0)
                      @foreach ($allProjects as $allP )
                        @if ($allP->id == $tOperatorPayRollxWeek['Project'])
                          <div class="row-sm">
                              <strong>-{{$allP->name_project}}:</strong> <em>${{number_format($tOperatorPayRollxWeek['acumulador'],2)}}</em> </li>
                          </div>
                        @endif
                      @endforeach
                    @endif
                  @endif
                @endforeach
              </td>
          </tr>
          <tr>
            <td style="border-color: black; vertical-align:middle" width="450"align="center">
              @foreach ($arrayTotalLabor as $TotalLabor)
                  @if($TotalLabor['week'] == $fechaXsemana['week'])
                    <strong>Labor:</strong> <em>${{number_format($TotalLabor['total'],2)}}</em> 
                  @endif
                @endforeach
            </td>
            <td style="border-color: black;" width="450">
              @foreach ($totalLaborPayRollxWeek as $tLaborPayRollxWeek)
                @if ($tLaborPayRollxWeek['week'] == $fechaXsemana['week'] )
                  @if ($tLaborPayRollxWeek['acumulador'] != 0)
                    @foreach ($allProjects as $allP )
                      @if ($allP->id == $tLaborPayRollxWeek['Project'])
                        <div class="row-sm">
                          <strong>-{{$allP->name_project}}:</strong> <em>${{number_format($tLaborPayRollxWeek['acumulador'],2)}}</em></li>
                        </div>
                      @endif
                    @endforeach
                  @endif
                @endif
              @endforeach
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      <br>
      <!-- END - Muestra el Payroll de los proyectos por categorias -->


      <!-- START - Muestra el Total Truck por proyecto -->
      <h3 class="text-center">Trucking Summary</h3>
      <h3 class="text-center">${{number_format($totalCurrentTrucking,2)}}</h3>
      <div class="container-fluid-a" style="overflow-x:auto;">
      <table class="table table-striped" border="1">
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
                </td>
            </tr>
            @endif
          @endforeach
          
        </tbody>
      </table>
      </div>
      <br>
      <!-- END - Muestra el Total Truck por proyecto -->

      <!-- START - Muestra el Total de otras compras -->
      <h3 class="text-center">Other Expenses Summary</h3>
      <h3 class="text-center">${{$totalCurrentOther}}</h3>
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
                @if ($project['tCSubcontra'] !=0 )
                  <div class="row-sm">
                    <strong>Subcontractor:</strong> <em>${{number_format($project['tCSubcontra'],2)}}</em> 
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
      <br>
      <!-- END - Muestra el Total de otras compras -->
    </div>       
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
