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
    {{HTML::script('js/purchases/showPurchasesproject.js')}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <a href="{{route('purchase.filter')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col">
            <a href="{{route('purchase.morePurchase',$project)}}"><div class="btn btn-outline-secondary btn-sm" >New Purchase</div></a>
        </div>
        
    </div>
</div>
    <!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container" style="margin-top: 30px;">
        <div class="card text-center">
            <div class="card-header " style="font-size: 20px; max-width: 1340px;">
                Purchases of {{$project->name_project}}
            </div>
            <div class="card-header " style="font-size: 20px; max-width: 1340px;">
                @if ($suma != 0)
                    Current Spent: ${{$suma}}
                    <br>
                @endif
                @if ($truckSummary != 0)
                    Truck Summary: ${{$truckSummary}}
                    <br>
                @endif   
                @if ($totalLabor != 0)
                    Total Labor: ${{$totalLabor}}
                @endif         
            </div>
            <!-- Se muestra las compras por categorias -->
            <div class="card-header " style="font-size: 20px; max-width: 1340px;">
                
                Other Expenses
                <br><br>
                @if ($sumaToolsMaterial != 0)
                <h6>Tools & Materials: ${{$sumaToolsMaterial}}</h6>
                @endif

                @if ($sumaSubcontractor != 0)
                <h6>Subcontractor: ${{$sumaSubcontractor}}</h6>
                @endif

                @if ($sumaAggregatesImport != 0)
                <h6>Aggregates Import: ${{$sumaAggregatesImport}}</h6>
                @endif
                
                @if ($sumaMaterialExport != 0)
                <h6>Material Export: ${{$sumaMaterialExport}}</h6>                                    
                @endif

                @if ($sumaInternalPayroll != 0)
                <h6 hidden>Operator: ${{$sumaInternalPayroll}}</h6>                                   
                @endif

                @if ($sumaHelpersPayroll != 0)
                <h6 hidden>Labor: ${{$sumaHelpersPayroll}}</h6>                                    
                @endif

                @if ($sumaHomedepotLowes != 0)
                <h6>Homedepot/Lowes: ${{$sumaHomedepotLowes}}</h6>
                @endif

                @if ($sumaMaterials != 0)
                <h6>Materials: ${{$sumaMaterials}}</h6>
                @endif

                @if ($sumaRepairsTow != 0)
                <h6>Repairs / Tow: ${{$sumaRepairsTow}}</h6>
                @endif

                @if ($sumaEquipmentRental != 0)
                <h6>Equipment Rental: ${{$sumaEquipmentRental}}</h6>
                @endif

                @if ($sumaBrokenConcreteTruck != 0)
                <h6>Broken Concrete Truck Hauling: ${{$sumaBrokenConcreteTruck}}</h6>
                @endif

                @if ($sumaDirtTruckHauling != 0)
                <h6>Dirt Truck Hauling: ${{$sumaDirtTruckHauling}}</h6>
                @endif

                @if ($sumaMixedTruckHauling != 0)
                <h6>Mixed Truck Hauling: ${{$sumaMixedTruckHauling}}</h6>
                @endif

                @if ($sumaImportAggregates != 0)
                <h6>Import (Aggregates): ${{$sumaImportAggregates}}</h6>
                @endif

                @if ($sumaOfficeAdmin != 0)
                <h6>Office / Admin: ${{$sumaOfficeAdmin}}</h6>
                @endif

                @if ($sumaToolPurchase != 0)
                <h6>Tool Purchase: ${{$sumaToolPurchase}}</h6>
                @endif

                @if ($sumaToolsRental != 0)
                <h6>Tools Rental: ${{$sumaToolsRental}}</h6>
                @endif

                @if ($sumaMiscellaneous != 0)
                <h6>Miscellaneous: ${{$sumaMiscellaneous}}</h6>
                @endif

                @if ($sumaConcreteExport != 0)
                <h6 hidden>Concrete Export: ${{$sumaConcreteExport}}</h6>
                @endif

                @if ($sumaDirtExport != 0)
                <h6 hidden>Dirt Export: ${{$sumaDirtExport}}</h6>
                @endif

                @if ($sumaMixedExport != 0)
                <h6 hidden>Mixed Export: ${{$sumaMixedExport}}</h6>
                @endif

                @if ($sumaTrushExport != 0)
                <h6 hidden>Trash Export: ${{$sumaTrushExport}}</h6>
                @endif

                @if ($sumaSandImport != 0)
                <h6 hidden>Sand Import: ${{$sumaSandImport}}</h6>
                @endif

                @if ($sumaBaseImport != 0)
                <h6 hidden>Base Import: ${{$sumaBaseImport}}</h6>
                @endif

                @if ($sumaGravelImport != 0)
                <h6 hidden>Gravel Import: ${{$sumaGravelImport}}</h6>
                @endif

                @if ($sumaSoilImport != 0)
                <h6 hidden>Soil Import: ${{$sumaSoilImport}}</h6>
                @endif
            
        </div>
        <div class="card-body">
        <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Category</th>
                <th>Description</th>
                <th hidden>Phase</th>                
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->purchaseCategories->name_category}}</td>
                <td>{{ $purchase->description_purchase}}</td>
                <td hidden>{{ $purchase->phases->name_phase}}</td>
                <td>${{$purchase->amount}}</td>
                <td>{{$purchase->date_purchase}}</td>
                <td style="text-align:center;">
                    <div class="dropdown " id="dropdown{{$purchase->id}}">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{$purchase->id}}" data-toggle="dropdown" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" id="dropper{{$purchase->id}}" style="width: 5px;">
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('purchase.show',[$purchase,2])}}" class="badge badge-light"><i class="fas fa-eye fa-1xx"></i></a>
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.edit',[$purchase,2])}}" class="badge badge-light"><i class="fas fa-edit 1x"></i></i></a>
                            <a style="padding: 5px;" class="dropdown-item text-center" href="{{route ('purchase.confirm',[$purchase,2])}}" class="badge badge-light"><i class="fas fa-trash-alt 1x"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
            <script>
                $('#dropdown{{$purchase->id}}').click(function(){
                    $('#dropper{{$purchase->id}}').toggleClass('show');
                });
            </script>


            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Category</th>
                <th>Description</th>
                <th hidden>Phase</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </tfoot>
    </table>
            </div>
            @if ($flag != 0)
                <div class="form-group">
                    <h5 class="text-center"> Pictures</h5> 
                    <br>
                    @foreach ($nombres as $n)
                        @if ($n['name'] != 'null')
                        <img src="{{ URL::asset('filePurchases/'.$n['name']) }}" class="img-fluid" alt="Responsive image">
                        @endif
                    <br>
                    <br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@stop


<style>
    .dropdown-menu{
        min-width: 60px !important;

    }
    @media only screen and (max-width: 600px) {
    .dropdown{
        float: right;
    }
}
</style>

