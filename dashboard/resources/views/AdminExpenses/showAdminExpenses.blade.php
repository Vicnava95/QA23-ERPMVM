@extends('master')
@section('title')
    <title>Admin Expenses</title>
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

    <!-- DataTable JS-->
    <script src="js/AdminExpenses/showAdminExpenses.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <h4><a href="{{route('dashboard')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>

        <div class="col text-right">
            <h4><a href="{{route('createAdminExpenses')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="New Expenses"><i class="uil uil-bill"></i></a></h4>
            <h4><a href="{{route('showTypeAdminExpenses')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Settings"><i class="uil uil-setting"></i></a></h4>
        </div>
    </div>
</div>

<!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="container" style="margin-top: 30px;max-width: 1340px;">
    <div class="card text-center">
            <div class="card-header " style="font-size: 20px;">
                Expenses List
            </div>
        <div class="card-body">
            <table id="example" class="display nowrap" style="width:100%; padding-top:10px">
                <thead>
                    <tr>
                        <th class="text-center">Expense Date</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Amount</th>
                        <th>Description</th>
                        <th class="text-center">Images</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            <!-- style="white-space: pre-wrap;" -->
                <tbody>
                @foreach($allAdminExpenses as $adminExpense)
                    <tr>
                        <td class="text-center">{{$adminExpense->dateAdminExpenses}}</td>
                        <td class="text-center">{{$adminExpense->status->categoryExpense->nameCategory}}</td>
                        <td class="text-center">{{$adminExpense->status->nameTypeAdminExpenses}}</td>
                        <td class="text-center">${{$adminExpense->amountDecimalExpenses}}</td>
                        <td>{{$adminExpense->commentAdminExpenses}}</td>
                        <td class="text-center"><a class="btn btn-secondary-outline" style="color: #6c757d;" href="#" data-toggle="modal" data-target="#viewImages{{$adminExpense->id}}"><i class="far fa-images"></i></a></td>
                        <td class="text-center">{{$adminExpense->users->name}}</td>
                        <td class="text-center">
                            <div class="dropdown " id="dropdown{{$adminExpense->id}}">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="modal" data-target="#editMenu{{$adminExpense->id}}">
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editMenu{{$adminExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Actions</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('editAdminExpenses', $adminExpense)}}" class="badge badge-light"><i class="fas fa-edit fa-1x"></i> Edit</a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="#" class="badge badge-light" data-toggle="modal" data-target="#exampleModalCenter{{$adminExpense->id}}"><i class="fas fa-trash-alt fa-1x"></i> Delete</a>
                                                <a style="padding: 5px;" class="dropdown-item text-center" href="{{route('dropzoneAdminExpenses', $adminExpense)}}" class="badge badge-light"><i class="far fa-images"></i> Image</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">Expense Date</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Amount</th>
                        <th>Description</th>
                        <th class="text-center">Images</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- START MODAL -->
    @foreach ($allAdminExpenses as $adminExpense)
    <div class="modal fade" id="exampleModalCenter{{$adminExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this expense?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 5px;"><b>Expense Date:</b> {{$adminExpense->dateAdminExpenses}}</p>
                <p style="margin-bottom: 5px;"><b>Category:</b> {{$adminExpense->status->categoryExpense->nameCategory}}</p>
                <p style="margin-bottom: 5px;"><b>Type:</b> {{$adminExpense->status->nameTypeAdminExpenses}}</p>
                <p style="margin-bottom: 5px;"><b>Amount:</b> ${{$adminExpense->amountDecimalExpenses}}</p>
                <p style="margin-bottom: 5px;"><b>Description:</b> {{$adminExpense->commentAdminExpenses}}</p>
                <p style="margin-bottom: 5px;"><b>User:</b> {{$adminExpense->users->name}}</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('destroyAdminExpenses',$adminExpense)}}"><div class="btn btn-danger" >Delete</div></a>
            </div>
        </div>
        </div>
    </div>
    @endforeach
    <!-- END MODAL -->

    <!-- START MODAL -->
    @foreach ($allAdminExpenses as $adminExpense)
    <div class="modal fade" id="viewImages{{$adminExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Images</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @foreach ($imagesAdmin as $imageA)
                    @if ($adminExpense->id == $imageA->adminExpenses_fk)
                    <a href="{{ URL::asset('adminExpensesImage/'.$imageA->imageName) }}" target="_blank">{{str_replace(array('.pdf','.png','.jpeg','.jpg'),'',$imageA->imageName)}}</a>
                    <a class="btn btn-outline-danger" data-toggle="modal" href="" data-target="#modalDeletToDo{{$imageA->id}}" style="padding: 3px; border-color: white;"><i class="far fa-trash-alt"></i></a>
                    <br>
                    @endif
                @endforeach
            </div>
        </div>
        </div>
    </div>
    @endforeach

    @foreach ($imagesAdmin as $imageA)
    <!-- Delete ToDo -->
    <div class="modal fade" id="modalDeletToDo{{$imageA->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete this image? </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                {{$imageA->imageName}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a role="button" href="{{route('deleteAdminImage',$imageA->id)}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
        </div>
    </div>
    <!-- END MODAL -->
    @endforeach
</div>
<style>
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
</style>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@stop


