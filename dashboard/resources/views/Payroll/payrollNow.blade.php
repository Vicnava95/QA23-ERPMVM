@extends('master')
@section('title')
    <title></title>
@stop
@section('extra_links')
    
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    {{-- Report CSS --}}
    {{ HTML::style('css/report/report.css') }}
    {{-- <link rel="stylesheet" href="report/report.css"> --}}

    {{ HTML::script('js/payroll/payroll.js') }}

@stop
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col text-center">
                <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
            </div>
            <div class="col text-center">
                {{-- <a href="#" onclick="location.href='/reportsToday/'+today+'/'+1;return false;"><div class="btn btn btn-outline-primary btn-sm" >Go to Report</div></a> --}}
                {{-- <h4><a href="#" onclick="location.href='/dashboard/public/reportsToday/'+today+'/'+1;return false;" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Go To Report"><i class="uil uil-file-bookmark-alt"></i></a></h4> --}}
                <h4><a href="#" onclick="location.href='/reportsToday/'+today+'/'+1;return false;" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Go To Report"><i class="uil uil-file-bookmark-alt"></i></a></h4>
            </div>
            {{-- <div class="col text-center" hidden>
                <a href="{{route('payrollFiles')}}"><div class="btn btn-outline-danger btn-sm" >Upload Documents</div></a>
            </div> --}}
            <div class="col text-center">
                <h4 hidden><a href="#" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Print PDF"><i class="uil uil-print"></i></a></h4>
            </div>
        </div>
    </div>

<div class="container-fluid" > 
    <figure class="text-center">
        <blockquote class="blockquote" style="padding:15px;">
            <h3 class="m-0 font-weight-bold text-dark" id="showDate">Report of {{$startDate}} </h3>
        </blockquote>
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
     <div class="card text-center" style="margin: 10px;">
      <!-- START - Secciones por fecha -->
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="#" ><b>Today</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="#" onclick="location.href='/payrollThisWeek/'+startDate+'/'+sundayDate+'/'+2;return false;"><b>This Week</b></a>
                {{-- <a class="nav-link " aria-current="true" href="#" onclick="location.href='/dashboard/public/payrollThisWeek/'+startDate+'/'+sundayDate+'/'+2;return false;"><b>This Week</b></a> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="true" href="#" onclick="location.href='/payrollLastWeek/'+lastWeekStart+'/'+lastWeekEnd+'/'+3;return false;"><b>Last Week</b></a>
                {{-- <a class="nav-link " aria-current="true" href="#" onclick="location.href='/dashboard/public/payrollLastWeek/'+lastWeekStart+'/'+lastWeekEnd+'/'+3;return false;"><b>Last Week</b></a> --}}
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="true" href="#" id="navLinkDate"><b>Dates</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="#" onclick="location.href='/payrollThisMonth/'+startMonth+'/'+endtMonth+'/'+6;return false;"><b>This Month</b></a>
                {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/payrollThisMonth/'+startMonth+'/'+endtMonth+'/'+6;return false;"><b>This Month</b></a> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="#" onclick="location.href='/payrollLastMonth/'+startLastMonth+'/'+endLastMonth+'/'+7;return false;"><b>Last Month</b></a>
                {{-- <a class="nav-link" aria-current="true" href="#" onclick="location.href='/dashboard/public/payrollLastMonth/'+startLastMonth+'/'+endLastMonth+'/'+7;return false;"><b>Last Month</b></a> --}}
            </li>
            
          </ul>
        </div>
        <!-- END - Secciones por fecha --> 

        <div class="card-body">

            <div class="row">
                <div class="col text-center">
                    <!-- START - Muestra el listado de los pagos a realizar a los trabajadores  -->
                    <h3 class="text-center">Payroll</h3>
                    <div class="container-fluid-a" style="overflow-x:auto;">
                        <table class="table table-striped" border="1" > 
                            <thead>
                                <tr>
                                    <th class="text-center"  style="border-color: black;">Name</th>
                                    <th class="text-center"  style="border-color: black;">Worked Days</th>
                                    <th class="text-center"  style="border-color: black;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCategorie as $allCate)
                                    @foreach ($montoCategori as $montoCate)
                                        @if ($allCate->id == $montoCate['categori'])
                                           
                                                <tr>
                                                    <td style="border-color: black; vertical-align:middle"  width="100" align="center">
                                                        <strong>{{$allCate->name_category}}</strong>
                                                    </td>
                                                    <td style="border-color: black; vertical-align:middle"  width="100" align="center">
                                                        <strong> {{$montoCate['workedDays']}}</strong>
                                                    </td>
                                                    <td style="border-color: black; vertical-align:middle"  width="100" align="center">
                                                        <strong> ${{number_format($montoCate['total'],2)}}</strong>
                                                    </td>
                                                </tr> 
                                             
                                        @endif
                                    @endforeach
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <th class="text-center" style="border-color: black;">Total  of {{$startDate}}</th>
                                <th class="text-center" style="border-color: black;"></th>
                                <th class="text-center" style="border-color: black;">${{number_format($totalPayroll,2)}}</th>
                            </tfoot>
                        </table>
                    </div>
                    <br>
                    <!-- END - Muestra el listado de los proyectos -->

                </div>
                <div class="col">
                    <!-- START - Muestra el listado de los proyectos -->
                    <h3 class="text-center">Project List</h3>
                    <div class="container-fluid-a" style="overflow-x:auto;">
                        <table class="table table-striped" border="1""> 
                            <thead>
                                <tr>
                                    <th class="text-center"  style="border-color: black;">ID Project</th>
                                    <th class="text-center"  style="border-color: black;">Name Project</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arrayIdProjects as $idPro)
                                    @foreach ($allProjects as $all)
                                        @if ($idPro == $all->id)
                                        <tr>
                                            <td style="border-color: black; vertical-align:middle"  width="100" align="center">
                                                <strong>{{$all->id}}</strong>
                                            </td>
                                            <td style="border-color: black; vertical-align:middle"  width="100" align="center">
                                                <strong> {{$all->name_project}}</strong>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <!-- END - Muestra el listado de los proyectos -->
                </div>
            </div>

            <!-- START - Muestra el Payroll de los proyectos por categorias -->
            <h3 class="text-center">Total Payroll</h3>
            <h3 class="text-center">${{number_format($totalPayroll,2)}}</h3>
            <div class="container-fluid-a" style="overflow-x:auto;">
            <table class="table table-striped" border="1">
                <thead>
                    <tr>
                        <th class="text-center"  style="border-color: black;">Days</th>
                        <th class="text-center"  style="border-color: black;">Project ID -- Labor</th>
                        <th class="text-center"  style="border-color: black;">Total</th>
                    </tr>
                </thead>
                @if ($totalPayroll != 0)
                <tbody>
                    @foreach ($diasX as $dia)
                    <tr>
                        <td style="border-color: black; vertical-align:middle"  width="450" align="center">
                        <strong>{{$dia['days']}}</strong>
                        </td>
                        <td style="border-color: black; vertical-align:middle"  width="450" align="center">
                            @for ($i = 0; $i < $n; $i++)
                                @foreach ($array[$i] as $a)
                                    @if ($a['day'] == $dia['days'])
                                        <div class="row-sm">
                                            @foreach ($allCategorie as $c)
                                                @if ($a['category'] == $c->id)
                                                    <strong> Project {{$a['idProject']}} -- {{$c->name_category}} ${{number_format($a['amount'],2)}}</strong>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            @endfor
                        </td>
                        <td style="border-color: black; vertical-align:middle" width="450"align="center">
                            @foreach ($totales as $t)
                                @if($t['dia'] == $dia['days'])
                                    <div class="row-sm">
                                        <strong>${{number_format($t['total'],2)}}</strong>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
            </div>
            <br>
            <!-- END - Muestra el Payroll de los proyectos por categorias -->
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
