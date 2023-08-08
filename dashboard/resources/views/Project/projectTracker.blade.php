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

    <!-- DataTable JS-->
    {{HTML::script('js/projects/projectTracker.js')}}
<!--     <script src="js/projects/dashboardProject.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    {{HTML::style('css/gmap.css')}}
    {{HTML::script('js/gmap.js')}}
@stop
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-right">
                <a href="{{route('project.index')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
                <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
            </div>
        </div>
    </div>

    <div class="container-fluid-a" >
        <figure class="text-center">
            <blockquote class="blockquote" style="padding:15px;">
                <h3 class="m-0 font-weight-bold text-dark">{{$project->name_project}}</h3>
            </blockquote>
        </figure>

<!-- Content Row -->
<div class="row" style="padding:5px;">

<!-- Content Column -->
<div class="col-lg-6 mb-4" >

  <!-- Project Card Example -->
  <div class="card shadow mb-4" >
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Project Information </h6>
      
    </div>
    
    <div class="card-body">
    <div class="status text-center" >
        <h4>Status: {{$project->statu->name_status}}</h4>
    </div>
        <dl class="dl-horizontal row">
            <dt class="col-sm-3" style="color:#858796;"><i class="fas fa-user-tie" style="color:#858796;" ></i> Manager:</dt>
            <dd class="col-sm-9">{{$project->manager->name_manager}}</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-calendar-check" style="color:#28a745;"></i> Start Date:</dt>
            <dd class="col-sm-9">{{$project->start_date_project}}</dd>
            <dt class="col-sm-3" style="color:#e74a3b;"><i class="fas fa-calendar-times" style="color:#e74a3b;"></i> End Date:</dt>
            <dd class="col-sm-9">{{$project->end_date_project}}</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-map-marker-alt" style="color:#007bff;"></i> Address:</dt>
            <dd class="col-sm-9">{{$project->address_project}}</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-dollar-sign" style="color:#007bff;"></i> Budget:</dt>
            <dd class="col-sm-9">${{$project->budget_project}}</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-dollar-sign" style="color:#007bff;"></i> Project Sold:</dt>
            <dd class="col-sm-9">${{$project->sold_project}}</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-percentage" style="color:#28a745;"></i> Profit Margin:</dt>
            <dd class="col-sm-9">{{$project->profit_project}}</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> Total Profit:</dt>
            <dd class="col-sm-9">{{$project->total_sold_project}}</dd>
            <dt class="col-sm-3" style="color:#e74a3b;"><span class="badge badge-danger">{{$contador}}</span> Current Spent:</dt>
            <dd class="col-sm-9">${{$suma}}</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-percentage" style="color:#28a745;"></i> New Profit Margin:</dt>
            <dd class="col-sm-9"> {{$newProfit}}% </dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> New Total Profit:</dt>
            <dd class="col-sm-9">${{$newMargin}}</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-hammer" style="color:#007bff;"></i> Services:</dt>
            <ul>
              @foreach ($services as $service )
                <li>{{$service->name_service}}</li>
              @endforeach
            </ul>
        </dl> 
             
    </div>
  </div>
  </div>
  </div>


<div class="card shadow mb-4" style="margin:5px;">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Purchases <a href="#" class="badge badge-light text-center" hidden><i class="fas fa-plus-circle fa-2x"></i></a> </h6>
    </div>
    <div class="card-body">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Phase</th>
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <!-- <th style="text-align:center;">Actions</th> -->

            </tr>
        </thead>
        <tbody>
        @foreach ($purchases as $purchase)
              <tr>
                  <td >{{$purchase->phases->name_phase}}</td>
                  <td >{{$purchase->purchaseCategories->name_category}}</td>
                  <td >{{ $purchase->description_purchase}}</td>
                  <td>${{$purchase->amount}}</td>
                  <td>{{$purchase->date_purchase}}</td>
                  <!-- <td style="text-align:center;">
                      <a href="#" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                      <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                      <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                  </td> -->
                  </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Phase</th>
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <!-- <th style="text-align:center;">Actions</th> -->
            </tr>
        </tfoot>
    </table>
    </div>
</div>

        
    </div>
   
    <style>
    .container-fluid-a{
        border: 2px solid black;
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        margin: 10px;
    }

    </style>

@stop
