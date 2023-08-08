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
              <a href="#"><div class="btn btn-outline-primary btn-sm" >Update Project</div></a>
            </div>
            <div class="col text-center">
              <a href="#"><div class="btn btn-outline-danger btn-sm" >Delete Project</div></a>
            </div>
            <div class="col text-center">
              <a href="{{route('dashboard')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
            </div>
        </div>
    </div>

<div class="container-fluid-a" >
        <figure class="text-center">
            <blockquote class="blockquote" style="padding:15px;">
                <h3 class="m-0 font-weight-bold text-dark">Project Name</h3>
            </blockquote>
        </figure>

<div class="row" style="margin: 5px;">

<!-- Project Sold -->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card border-success mb-3 shadow h-100 py-2">
    <div class="card-body">
    <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Project Sold</div>
              <div class="h5 mb-0 font-weight-bold">$675.00</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x" style="color:#28a745;"></i>
            </div>
          </div>
    </div>
  </div>
</div> 

<!-- Total Purchases -->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card border-danger mb-3 shadow h-100 py-2">
    <div class="card-body">
    <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> <span class="badge rounded-pill bg-danger" style="color:white;">4</span> Total Purchases </div>
              <div class="h5 mb-0 font-weight-bold">$150.00</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x" style="color:#e74a3b;"></i>
            </div>
          </div>
    </div>
  </div>
</div>




<!-- Total Phases -->
<div class="col-xl-4 col-md-6 mb-4">
  <div class="card border-success mb-3 shadow h-100 py-2">
    <div class="card-body">
    <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">New Total Profit </div>
              <div class="h5 mb-0 font-weight-bold">$550.00</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x" style="color:#28a745;"></i>
            </div>
          </div>
    </div>
  </div>
</div>

</div>



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
        <h4><span class="badge rounded-pill bg-success" style="color:white;">Success</span></h4>
    </div>
        <dl class="dl-horizontal row">
            <dt class="col-sm-3" style="color:#858796;"><i class="fas fa-user-tie" style="color:#858796;" ></i> Manager:</dt>
            <dd class="col-sm-9">Marvin Vigil.</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-calendar-check" style="color:#28a745;"></i> Start Date:</dt>
            <dd class="col-sm-9">22/03/2021.</dd>
            <dt class="col-sm-3" style="color:#e74a3b;"><i class="fas fa-calendar-times" style="color:#e74a3b;"></i> End Date:</dt>
            <dd class="col-sm-9">25/06/2021.</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-map-marker-alt" style="color:#007bff;"></i> Address:</dt>
            <dd class="col-sm-9">Urbanizacion La Cima II, San Salvador, El Salvador.</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="far fa-comment" style="color:#007bff;"></i> Scope:</dt>
            <dd class="col-sm-9">Pool Remodel</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-hammer" style="color:#007bff;"></i> Services:</dt>
            <ul>
                <li>Swimming Pool Excavation </li>
                <li>Concrete Demolition and Removal </li>
                <!-- <li>uno </li> -->
            </ul>
        </dl> 
             
    </div>
  </div>



    <!-- Project Card Example -->
    <div class="card shadow mb-4" >
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Phases <a href="#" class="badge badge-light text-center"><i class="fas fa-plus-circle fa-2x"></i></a></h6>
    </div>
    
    <div class="card-body">      
          <div id="accordion">
              <div class="card" style="margin:5px;">
                  <div class="card-header" id="headingThree" style="padding:1px; cursor:pointer" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapseThree">
                      <h5 class="mb-0" >
                          <label style="font-size: 18px; text-align:center; padding-top:5px; padding-left:5px;">Phase of Concrete Demolition</label>
                      </h5>
                  </div>
                  <div id="collapse1" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body" style="padding:5px 5px 5px 20px;">
                          <label style="font-size: 14px;"><b>Description</b></label>
                          <span style="font-size: 14px;">the demolition of the house in los angeles will be carried out, then ask the client the design of the new house </span>
                          <br>
                          <label style="font-size: 14px;"><b>Budget:</b>  </label>
                          <span style="font-size: 14px;">$500.00</span>
                          <br>
                          <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                          <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                      </div>
                  </div>
              </div>
              <div class="card" style="margin:5px;">
                  <div class="card-header" id="headingThree" style="padding:1px; cursor:pointer" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapseThree">
                      <h5 class="mb-0" >
                        <label style="font-size: 18px; text-align:center; padding-top:5px; padding-left:5px;">Phase of Swimming Pool Demolition</label>
                      </h5>
                  </div>
                  <div id="collapse2" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body" style="padding:5px 5px 5px 20px;">
                          <label style="font-size: 14px;"><b>Description</b></label>
                          <span style="font-size: 14px;">the demolition of the swimming pool in los California </span>
                          <br>
                          <label style="font-size: 14px;"><b>Budget:</b></label>
                          <span style="font-size: 14px;">$650.00</span>
                          <br>
                          <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                          <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                      </div>
                  </div>
              </div>
          
          </div> 
        
             
    </div>
  </div>

    <!-- Project Card Example -->
    <div class="card shadow mb-4" >
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Contacts <a href="#" class="badge badge-light text-center"><i class="fas fa-plus-circle fa-2x"></i></a></h6>
      </div>
      
      <div class="card-body">      
            <div id="accordion">
                <div class="card" style="margin:5px;">
                    <div class="card-header" id="headingThree" style="padding:1px; cursor:pointer" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0" >
                            <label style="font-size: 18px; text-align:center; padding-top:5px; padding-left:5px;">Maria  Tel:7789-6398</label>
                        </h5>
                    </div>
                    <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body" style="padding:5px 5px 5px 20px;">
                            <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                            <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin:5px;">
                    <div class="card-header" id="headingThree" style="padding:1px; cursor:pointer" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0" >
                          <label style="font-size: 18px; text-align:center; padding-top:5px; padding-left:5px;">Andrea Tel:7369-2365</label>
                        </h5>
                    </div>
                    <div id="collapse4" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body" style="padding:5px 5px 5px 20px;">
                            <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                            <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            
            </div>    
      </div>
    </div>

</div> 

<div class="col-lg-6 mb-4">
  <!-- Approach -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Sold & Budget</h6>
    </div>
    <div class="card-body">
    <dl class="dl-horizontal row">
            <dt class="col-sm-3" style="color:#e74a3b;"><i class="fas fa-dollar-sign" style="color:#e74a3b;" ></i> Project Budget:</dt>
            <dd class="col-sm-9">$450.00</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> Project Sold:</dt>
            <dd class="col-sm-9">$675.00</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-percentage" style="color:#007bff;"></i> Profit Margin:</dt>
            <dd class="col-sm-9">33.33%</dd>
            <dt class="col-sm-3" style="color:#007bff;"><i class="fas fa-dollar-sign" style="color:#007bff;"></i> Total Profit:</dt>
            <dd class="col-sm-9">$225.00</dd>
            <hr>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> New Profit Margin:</dt>
            <dd class="col-sm-9">25%</dd>
            <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> New Total Profit:</dt>
            <dd class="col-sm-9">$450.00</dd>

        </dl> 
    </div>
  </div>

  <!-- Illustrations -->
  <div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Quick Report </h6>
    </div>
    <div class="card-body">
      <h6>Current Spending</h6>
    <dl class="dl-horizontal row">
      <dt class="col-sm-3" style="color:#858796;"><span class="badge rounded-pill bg-secondary" style="color:white">2</span> Category 1:</dt>
      <dd class="col-sm-9">$300.00</dd>
      <dt class="col-sm-3" style="color:#858796;"><span class="badge rounded-pill bg-secondary" style="color:white">5</span> Category 2:</dt>
      <dd class="col-sm-9">$350.00</dd>
      <dt class="col-sm-3" style="color:#858796;"><span class="badge rounded-pill bg-secondary" style="color:white">1</span> Category 3:</dt>
      <dd class="col-sm-9">$650.00</dd>
      <dt class="col-sm-3" style="color:#858796;"><span class="badge rounded-pill bg-secondary" style="color:white">4</span> Category 4:</dt>
      <dd class="col-sm-9">$450.00</dd>
      <dt class="col-sm-3" style="color:#858796;"><span class="badge rounded-pill bg-secondary" style="color:white">3</span> Category 5:</dt>
      <dd class="col-sm-9">$123.00</dd>
      
      <dt class="col-sm-3" style="color:#28a745;"><i class="fas fa-dollar-sign" style="color:#28a745;"></i> Total Purchases:</dt>
      <dd class="col-sm-9">$150.00</dd>
    </dl> 
      <h6>Most Expensive Purchase</h6>
            <div class="card" style="margin:5px;">
                <div class="card-header" id="headingThree" style="padding:1px; cursor:pointer" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                    <h5 class="mb-0" >
                      <label style="font-size: 18px; text-align:center; padding-top:5px; padding-left:5px;">10 CY Dirt Truck</label>
                    </h5>
                </div>
                <div id="collapse6" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body" style="padding:5px 5px 5px 20px;">
                          <label style="font-size: 14px;"><b>Category:</b></label>
                          <span style="font-size: 14px;">the demolition of the swimming pool in los California </span>
                          <br>
                          <label style="font-size: 14px;"><b>Phase:</b></label>
                          <span style="font-size: 14px;">Excavation</span>
                          <br>
                          <label style="font-size: 14px;"><b>Date:</b></label>
                          <span style="font-size: 14px;">03/25/2021 </span>
                          <br>
                          <label style="font-size: 14px;"><b>Amount:</b></label>
                          <span style="font-size: 14px;">$8500.00</span>
                          <br>
                    </div>
                </div>
            </div>      
    </div>
  </div>



</div>

</div>
<div class="card shadow mb-4" style="margin:5px;">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">Purchases <a href="#" class="badge badge-light text-center"><i class="fas fa-plus-circle fa-2x"></i></a> </h6>
    </div>
    <div class="card-body">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Category</th>
                <th>Phase</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Subcontractor</td>
                <td>Phase one</td>
                <td>Phase of swimming pool</td>
                <td>$500.00</td>
                <td>22/03/2021</td>
                <td style="text-align:center;">
                    <a href="#" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                </td>
            </tr>
            <tr>
                <td>Material Export</td>
                <td>Phase two</td>
                <td>Phase of concrete</td>
                <td>$650.00</td>
                <td>21/03/2021</td>
                <td style="text-align:center;">
                    <a href="#" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                </td>
            </tr>
            <tr>
                <td>Tools & Materials</td>
                <td>Phase three</td>
                <td>Phase of swimming pool</td>
                <td>$300.00</td>
                <td>22/03/2021</td>
                <td style="text-align:center;">
                    <a href="#" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                </td>
            </tr>
            <tr>
                <td>Aggregates Import</td>
                <td>Phase four</td>
                <td>Phase of concrete</td>
                <td>$750.00</td>
                <td>21/03/2021</td>
                <td style="text-align:center;">
                    <a href="#" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                    <a href="#" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a>
                </td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <th>Category</th>
                <th>Phase</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>
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
