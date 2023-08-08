@extends('master')
@section('title')
    <title>Project Report</title>
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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>

    <!-- Chart JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.js" integrity="sha512-a+uzkcbI/MyXYDayp12Y28mqzeAlzdKZRaJfhpyU8326w+oGqfqA3B73CMNl77D0N11FLOe8ZeHURAf6mnO8Jg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.min.js" integrity="sha512-x5/OWp6+ZmVcHgn9/8L9ts51vU4pEA1JN3FpFbKKn5uMwVF25lM3NhbXlC62Aw0KZEiKNEWrcGnwrOb7QPHuEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.js" integrity="sha512-lUsN5TEogpe12qeV8NF4cxlJJatTZ12jnx9WXkFXOy7yFbuHwYRTjmctvwbRIuZPhv+lpvy7Cm9o8T9e+9pTrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.js" integrity="sha512-sLvQol0YcXzV+X/MY/VOWx4jw6AUrnTCTRgJaJFsNjdVfM3roYU9duIUPTlNR8lQjjH2phaQCU5/Yekar1M8Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.min.js" integrity="sha512-m4VsSgMQ0Mw2iOS3ysNMINQNje3Q5c4AXeZXCVv60HjGMXy2iqZFo9c64itcXZ3ndsPOn5sOk4RgYWC1mBeEmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    {{-- Report CSS --}}
    {{ HTML::style('css/report/reportProjects.css') }}

    {{ HTML::script('js/reports/reportProject.js') }}

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
            <h4><a href="#" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Print PDF"><i class="uil uil-print"></i></a></h4>
        </div>
    </div>
</div>

<div class="container-fluid" style="margin-top:8px;"> 
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
      <a class="nav-link 
      @if ($flag == 1)
        activeItem
      @endif" href="{{route('reportProjects',1)}}"><b>Today</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link 
      @if ($flag == 2)
        activeItem
      @endif" href="{{route('reportProjects',2)}}"><b>This Month</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link 
      @if ($flag == 3)
        activeItem
      @endif" href="{{route('reportProjects',3)}}"><b>Last Month</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link 
      @if ($flag == 4)
        activeItem
      @endif" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" id="inputDates"><b>Dates</b></a>
    </li>
  </ul>
  <div class="text-center dates" style="margin-top:8px;">
    @switch($flag)
      @case(1)
        <h3>{{$todayFormat}}</h3>
      @break
        
      @case(2)
        <h3>{{$firstDayThisMonth}} - {{$lastDayThisMonth}}</h3>
      @break

      @case(3)
        <h3>{{$firstDayLastMonth}} - {{$lastDayLastMonth}}</h3>
      @break

      @case(4)
        <h3>{{$inputStartDay}} - {{$inputEndDay}}</h3>
      @break
    
      @default
        
    @endswitch
  </div>

  <div class="collapse" id="collapseExample" style="margin-top:15px;">
    <div class="container-center" style="justify-content: center; text-align:center; display:flex;">
      <form action="{{route('reportProjects',4)}}" style="margin-bottom:0px;">
        <div class="row">
          <div class="col" >
            <h6 style="margin-bottom: 3px;">Start Date</h6>
            <input type="text" id="datepicker" width="150" name="startDate" autocomplete="off" required>
          </div>
          <div class="col" >
            <h6 style="margin-bottom: 3px;">End Date</h6>
            <input type="text" id="datepicker2" width="150" name="endDate" autocomplete="off" required>
          </div>
        </div>
        <br>
        <button class="btn activeItem" type="submit"><b>Submit</b></button>
      </form>
    </div>
  </div>

  <div class="text-center">
    <h4>EXPENSES PER PROJECT</h4>
  </div>

  <div class="text-center barStatus" style="margin-top:8px;">
    <ul class="nav nav-pills justify-content-center">
      <li class="nav-item barStatusItem"><span class="dot-active"></span>Active</li>
      <li class="nav-item barStatusItem"><span class="dot-finish"></span>Finished</li>
      <li class="nav-item barStatusItem"><span class="dot-schedule"></span>Schedule</li>
      <li class="nav-item barStatusItem"><span class="dot-paused"></span>Paused</li>
      <li class="nav-item barStatusItem"><span class="dot-permit"></span>Permit Processing</li>
      <li class="nav-item barStatusItem"><span class="dot-archived"></span>Archived</li>
    </ul>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table id="customers" class="table table-striped">
      <thead>
        <tr>
          <th>Project</th>
          <th>Worked Days</th>
          <th>Trucking</th>
          <th>Labor</th>
          <th>Subcontractor</th>
          <th>Eq. Rental</th>
          <th>Materials & Tools</th>
          <th>Tools Rental</th>
          <th>Misc</th>
          <th>Repairs</th>
          <th>Others</th>
          <th>∑</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projectInfo as $proInfo)
          @if ($proInfo['projectName'] != 'Empty')
            <tr role="row">
              <td>@switch($proInfo['projectStatus'])
                @case(1)
                  <span class="dot-active"></span>
                @break  
                @case(2)
                  <span class="dot-finish"></span>
                @break
                @case(3)
                  <span class="dot-schedule"></span>
                @break
                @case(4)
                  <span class="dot-archived"></span>
                @break
                @case(5)
                  <span class="dot-paused"></span>
                @break
                @case(6)
                  <span class="dot-permit"></span>
                @break
              @endswitch
                <a style="color:black;" href="{{route('project.moreInfo',$proInfo['projectId'])}}" target="_blank">{{$proInfo['projectName']}}</a>
              </td>
              <td>
                @if ($proInfo['workedDays']!=0)
                  {{$proInfo['workedDays']}}
                @else
                  -
                @endif
              </td>
              <td>
                @if ($proInfo['trucking']!=0)
                  ${{number_format($proInfo['trucking'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['labor']!=0)
                  ${{number_format($proInfo['labor'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['subcontractor']!=0)
                  ${{number_format($proInfo['subcontractor'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['equipRental']!=0)
                  ${{number_format($proInfo['equipRental'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['materialTools']!=0)
                  ${{number_format($proInfo['materialTools'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['toolsRental']!=0)
                  ${{number_format($proInfo['toolsRental'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['miscelaneous']!=0)
                  ${{number_format($proInfo['miscelaneous'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['repairs']!=0)
                  ${{number_format($proInfo['repairs'],2,'.',',')}}
                @endif
              </td>
              <td>
                @if ($proInfo['others']!=0)
                  ${{number_format($proInfo['others'],2,'.',',')}}
                @endif
              </td>
              <td>${{number_format($proInfo['total'],2,'.',',')}}</td>
            </tr>
          @endif
        @endforeach
      </tbody>
      <tfoot style="background: #ddd">
        <tr role="row">
          <th class="footerTable">∑</th>
          <th class="footerTable">{{$allTotalArray[0]['tWorkedDays']}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tTruck'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tLabor'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tSubcontractor'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tEquipRental'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tMaterialTools'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tToolsRental'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tMiscelaneous'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tRepairs'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['tOthers'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($allTotalArray[0]['total'],2,'.',',')}}</th>
        </tr>
      </tfoot>
  
    </table>
  </div>

  {{-- GRÁFICOS --}}
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      @if($categoryPieChart[0]['label'] != 'Empty')
        <div class="text-center" style="margin-top:8px;">
          <h5>Expenses Per Category</h5>
        </div>
        <div id="chartCategory" style="height: 370px; width: 100%;"></div>
      @endif
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      @if ($trucksPieChart[0]['label'] != 'Empty')
        <div class="text-center" style="margin-top:8px;">
          <h5>Trucks Category</h5>
        </div>
        <div id="chartTrucks" style="height: 370px; width: 100%;"></div>
      @endif
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      @if ($laborsPieChart[0]['label'] != 'Empty')
        <div class="text-center" style="margin-top:8px;">
          <h5>Labor Category</h5>
        </div>
        <div id="chartLabor" style="height: 370px; width: 100%;"></div>
      @endif
    </div>
  </div>

  <br>

  <div class="text-center">
    <h4>FINISHED PROJETCS OVERVIEW</h4>
  </div>
  <div class="text-center barStatus" style="margin-top:8px;">
    <ul class="nav nav-pills justify-content-center">
      <li class="nav-item barStatusItem"><span class="dot-finish"></span>Finished</li>
    </ul>
  </div>

  <div class="table-responsive text-nowrap">
    <table id="customers" class="table table-striped">
      <thead>
        <tr>
          <th>Project</th>
          <th>Services</th>
          <th>Sold</th>
          <th>Budget</th>
          <th>Expenses</th>
          @switch($flag)
            @case(1)
              <th>Today</th>
            @break
              
            @case(2)
              <th>This Month</th>
            @break

            @case(3)
              <th>Last Month</th>
            @break

            @case(4)
              <th>{{$inputStartDay}} - {{$inputEndDay}}</th>
            @break
          @endswitch
          <th>Profit</th>
          <th>Days</th>
          <th>Profit/Day</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($projectFinishedArray as $proFinished)
          @if ($proFinished['projectName'] != 'Empty')
            <tr role="row">
              <td><span class="dot-finish"></span>    
                <a style="color:black;" href="{{route('project.moreInfo',$proFinished['projectId'])}}" target="_blank">{{$proFinished['projectName']}}</a>
              </td>
              <td style="width:250px;">
                @foreach ($proFinished['projectServices'] as $proService)
                  <div>{{$proService->name_service}}</div>
                @endforeach
              </td>
              <td>
                @if ($proFinished['projectSold'] != 0)
                  ${{number_format($proFinished['projectSold'],2,'.',',')}}  
                @endif
              </td>
              <td>
                @if ($proFinished['projectBudget'] != 0)
                  ${{number_format($proFinished['projectBudget'],2,'.',',')}}  
                @endif
              </td>
              <td>
                @if ($proFinished['expenses'] != 0)
                  ${{number_format($proFinished['expenses'],2,'.',',')}}  
                @endif
              </td>
              <td>
                @if ($proFinished['current'] != 0)
                  ${{number_format($proFinished['current'],2,'.',',')}}  
                @endif
              </td>
              <td>
                @if ($proFinished['profit'] != 0)
                  ${{number_format($proFinished['profit'],2,'.',',')}}  
                @endif
              </td>
              <td>
                {{$proFinished['days']}}
              </td>
              <td>
                @if ($proFinished['profitXday'] != 0)
                  ${{number_format($proFinished['profitXday'],2,'.',',')}}  
                @endif
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
      <tfoot style="background: #ddd">
        <tr role="row">
          <th class="footerTable">∑</th>
          <th class="footerTable"></th>
          <th class="footerTable"></th>
          <th class="footerTable">${{number_format($totalFinishedProjects[0]['totalBudget'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($totalFinishedProjects[0]['totalExpenses'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($totalFinishedProjects[0]['totalCurrent'],2,'.',',')}}</th>
          <th class="footerTable">${{number_format($totalFinishedProjects[0]['totalProfit'],2,'.',',')}}</th>
          <th class="footerTable"></th>
          <th class="footerTable"></th>
        </tr>
      </tfoot>
  
    </table>
  </div>

  <div class="text-center" style="margin-top:8px;">
    <h4>BUDGET VS EXPENSES</h4>
  </div>
  @if ($budgeProjectsChart[0]['label'] != 'Empty')
    <div class="row" style="justify-content:center">
      <div id="chartBudgetExpenses" style="height: 370px; width: 98%;"></div>
    </div>
  @endif

  <br>

  <div class="text-center" style="margin-top:8px;">
    <h4>PROFIT VS EXPENSES</h4>
  </div>
  @if ($profitProjectChart[0]['label'] != 'Empty')
    <div class="row" style="justify-content:center">
      <div id="chartProfitExpenses" style="height: 370px; width: 98%;"></div>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="text-center" style="margin-top:8px;">
        <h4>SERVICES</h4>
      </div>
      <div class="row" style="width: 100%">
        <div class="col-4">
          Service
        </div>
        <div class="col-6">
          
        </div>
        <div class="col-2">
          ${{number_format($totalMargin, 2, '.', ',')}}
        </div>
        <hr>
        @foreach($totalForService as $toForService)
          @if($toForService['total'] != 0)
            <div class="col-4">
              {{$toForService['serviceName']}}
            </div>
            <div class="col-6">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$toForService['percent']}}%;" aria-valuenow="{{$toForService['percent']}}" aria-valuemin="0" aria-valuemax="100">{{$toForService['percent']}}%</div>
              </div>
            </div>
            <div class="col-2">
              ${{$toForService['total']}}
            </div>
            <hr>
          @endif
        @endforeach
      </div>
    </div>
    <div class="col-md-6 col-xs-12"></div>
  </div>
  

  
  
  
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
    window.onload = function() {
    
    var chartCategory = new CanvasJS.Chart("chartCategory", {
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      exportEnabled: true,
      animationEnabled: true,
      data: [{
        type: "pie",
        startAngle: 0,
        toolTipContent: "<b>{label}</b>: ${y} - {a}%",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - ${y} - {a}%",
        dataPoints: @json($categoryPieChart)
        /* [
          { y: 51.08, label: "Chrome", a: 51.08 },
          { y: 27.34, label: "Internet Explorer", a: 51.08 },
          { y: 10.62, label: "Firefox", a: 51.08 },
          { y: 5.02, label: "Microsoft Edge", a: 51.08 },
          { y: 4.07, label: "Safari", a: 51.08 },
          { y: 1.22, label: "Opera", a: 51.08 },
          { y: 0.44, label: "Others", a: 51.08 }
        ] */
      }]
    });

    var chartTrucks = new CanvasJS.Chart("chartTrucks", {
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      exportEnabled: true,
      animationEnabled: true,
      data: [{
        type: "pie",
        startAngle: 0,
        toolTipContent: "<b>{label}</b>: ${y} - {a}%",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - ${y} - {a}%",
        dataPoints: @json($trucksPieChart)
      }]
    });

    var chartLabor = new CanvasJS.Chart("chartLabor", {
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      exportEnabled: true,
      animationEnabled: true,
      data: [{
        type: "pie",
        startAngle: 0,
        toolTipContent: "<b>{label}</b>: ${y} - {a}%",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - ${y} - {a}%",
        dataPoints: @json($laborsPieChart)
      }]
    });

    var chartBudgetExpenses = new CanvasJS.Chart("chartBudgetExpenses", {
      exportEnabled: true,
      animationEnabled: true,
      axisX: {
        title: "Projects"
      },
      axisY: {
        title: "Oil Filter - Units",
        titleFontColor: "black",
        lineColor: "black",
        labelFontColor: "black",
        tickColor: "black",
        labelPlacement: "outside", //Change it to "outside"
        tickPlacement: "outside",
        includeZero: true
      },
      toolTip: {
        shared: true
      },
      legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
      },
      data: [{
        type: "column",
        name: "Budget",
        color: "#6c757d",
        showInLegend: true,      
        yValueFormatString: "$#,##0.#",
        dataPoints: @json($budgeProjectsChart)
      },
      {
        type: "column",
        name: "Expenses",
        color: "#ffc107",
        axisYType: "secondary",
        showInLegend: true,
        yValueFormatString: "$#,##0.#",
        dataPoints: @json($expensesProjectChart)
      }]
    });

    var chartProfitExpenses = new CanvasJS.Chart("chartProfitExpenses", {
      exportEnabled: true,
      animationEnabled: true,
      axisX: {
        title: "Projects"
      },
      axisY: {
        title: "Oil Filter - Units",
        titleFontColor: "black",
        lineColor: "black",
        labelFontColor: "black",
        tickColor: "black",
        labelPlacement: "outside", //Change it to "outside"
        tickPlacement: "outside",
        includeZero: true
      },
      toolTip: {
        shared: true
      },
      legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
      },
      data: [{
        type: "column",
        name: "Profit",
        color: "#28a745",
        showInLegend: true,      
        yValueFormatString: "$#,##0.#",
        dataPoints: @json($profitProjectChart)
      },
      {
        type: "column",
        name: "Expenses",
        color: "#ffc107",
        axisYType: "secondary",
        showInLegend: true,
        yValueFormatString: "$#,##0.#",
        dataPoints: @json($expensesProjectChart)
      }]
    });

    chartCategory.render();
    chartTrucks.render();
    chartLabor.render();
    chartBudgetExpenses.render();
    chartProfitExpenses.render();
  
    function toggleDataSeries(e) {
      if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
      } else {
        e.dataSeries.visible = true;
      }
      e.chartBudgetExpenses.render();
      e.chartProfitExpenses.render();
    }
  }
    </script>
</div>
@stop
