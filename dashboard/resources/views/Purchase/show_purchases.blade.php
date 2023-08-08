@extends('master')
@section('title')
    <title>Purchases</title>
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
    <script src="js/purchases/showPurchases.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            <a href="{{route('project.active')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
            <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
        </div>
    </div>
</div>
    <!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container" style="margin-top: 30px;max-width: 1800px;">
        <div class="card text-center">
            <div class="card-header " style="font-size: 20px; max-width: 2040px;">
                Purchases
                <div class="col text-right">
                    <a href="{{route('purchase.create')}}"><div class="btn btn-outline-secondary btn-sm" >New Purchase</div></a>
                </div>
            </div>
        <div class="card-body">
        <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Phase</th>                
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>

            </tr>
        </thead>
        <tbody>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->projects->id}}</td>
                <td>{{ $purchase->projects->name_project}}</td>
                <td>{{ $purchase->purchaseCategories->name_category}}</td>
                <td>{{ $purchase->description_purchase}}</td>
                <td>{{ $purchase->phases->name_phase}}</td>
                <td>${{$purchase->amount}}</td>
                <td>{{$purchase->date_purchase}}</td>
                <td style="text-align:center;">
                    <div class="dropdown" id="dropdown{{$purchase->id}}">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{$purchase->id}}" data-toggle="dropdown" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" id="dropper{{$purchase->id}}" style="width: 5px;">
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('purchase.show',$purchase)}}" class="badge badge-light"><i class="fas fa-eye fa-1x"></i></a>
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.edit',$purchase)}}" class="badge badge-light"><i class="fas fa-edit fa-1x"></i></i></a>
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.confirm',$purchase)}}" class="badge badge-light"><i class="fas fa-trash-alt fa-1x"></i></a>
                        </div>
                    </div>
{{--                     <a href="{{route('purchase.show',$purchase)}}" class="badge badge-light"><i class="fas fa-eye fa-2x"></i></a>
                    <a href="{{route ('purchase.edit',$purchase)}}" class="badge badge-light"><i class="fas fa-edit fa-2x"></i></i></a>
                    <a href="{{route ('purchase.confirm',$purchase)}}" class="badge badge-light"><i class="fas fa-trash-alt fa-2x"></i></a> --}}

                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Phase</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </tfoot>
    </table>
                
            </div>
        </div>
    
    </div>

@stop


