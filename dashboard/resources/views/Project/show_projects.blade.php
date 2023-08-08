@extends('master')

@section('title')
    <title>Projects</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"/>
    <!-- CSS -->
    {{HTML::style('css/project/activeProject.css')}}

    <!-- DataTable JS-->
    <script src="js/projects/showProjects.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                <h4><a href="{{route('project.active')}}"><div class="badge badgeERP" >BACK</div></a></h4>
            @else
                <h4><a href="{{route('project.active')}}"><div class="badge badgeERP" >BACK</div></a></h4>
            @endif
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                <h4><a href="{{route('project.create')}}" class="badge badgeERP" role="button" aria-pressed="true">NEW PROJECT</a></h4>
            @endif
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container" style="margin-top: 15px;max-width: 1340px;">
    <div class="card text-center">
            <div class="card-header " style="font-size: 20px;">
                Projects
            </div>
    <div class="card-body">
        <table id="example" class="display nowrap" style="width:100%; padding-top:10px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Address</th>
                    <th>Services</th>
                    <th style="text-align:center;">Budget</th>
                    <th style="text-align:center;">Project Sold</th>
                    @if (Auth::user()->rol != 'secretary')
                    <th style="text-align:center;">Total Profit</th>
                    <th style="text-align:center;">Profit Margin</th>
                    @endif
                    
                    <th>Status</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
        <!-- style="white-space: pre-wrap;" -->
            <tbody>
            @foreach($infoProject as $project)
                <tr>
                    <td>{{ $project['pId']}}</td>
                    <td style="white-space: pre-wrap;">{{ $project['pName']}}</td>
                    <td style="white-space: pre-wrap;">{{ $project['startDate']}}</td>
                    <td style="white-space: pre-wrap;">{{ $project['endDate']}}</td>
                    <td style="white-space: pre-wrap;">{{ $project['pAddress']}}</td>
                    <td style="white-space: pre-wrap;">{{ $project['services'] }}</td>
                    <td style="text-align:center;">${{ $project['pBudget']}}</td>
                    @if (Auth::user()->rol != 'secretary')
                    <td style="text-align:center;">${{ $project['pSold']}}</td>
                    <td style="text-align:center;">${{ $project['pProfit']}}</td>
                    @endif
                    <td style="text-align:center;">{{ $project['pProfitMargin']}}%</td>
                    <td>{{$project['pStatus']}}</td>
                    <td style="text-align:center;">
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle badgeERP" data-toggle="modal" data-target="#modalSettings{{$project['pId']}}">
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Settings -->
                <div class="modal fade" id="modalSettings{{$project['pId']}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalCenterTitle">{{$project['pName']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">Select a change</h6>
                            <div class="list-group" style="text-align: center;">
                                <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.moreInfo',$project['pId'])}}" class="badge badge-light"><i class="fas fa-eye fa-1x"></i> View Project</a>
                                <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route('project.edit',$project['pId'])}}" class="badge badge-light"><i class="fas fa-edit fa-1x"></i> Edit Project</a>
                                <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route ('project.confirm',$project['pId'])}}" class="badge badge-light"><i class="fas fa-trash-alt fa-1x"></i> Delete Project</a>
                                <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route ('phase.index',$project['pId'])}}" class="badge badge-light"><i class="fas fa-clipboard-list fa-1x"></i> Show Phases</a>
                                <a style="padding: 5px;" class="list-group-item list-group-item-action" href="{{route ('purchase.morePurchase',$project['pId'])}}" class="badge badge-light"><i class="fas fa-cart-plus fa-1x"></i> Add Purchase</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Address</th>
                    <th>Services</th>
                    <th style="text-align:center;">Budget</th>
                    <th style="text-align:center;">Project Sold</th>
                    @if (Auth::user()->rol != 'secretary')
                    <th style="text-align:center;">Total Profit</th>
                    <th style="text-align:center;">Profit Margin</th>
                    @endif
                    <th>Status</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    
</div>
<style>
.example_wrapper{
    padding-top: 10px;
}
</style>
@stop


