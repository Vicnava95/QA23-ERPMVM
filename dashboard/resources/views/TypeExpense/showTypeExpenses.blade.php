@extends('master')
@section('title')
    <title>Type Admin Expenses</title>
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
    <script src="js/projects/showProjects.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

    {{HTML::style('css/typeExpenses/typeExpenses.css')}}

@stop
@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
          <h4><a href="{{route('showAdminExpenses')}}" class="badge badgeERPButton" data-toggle="tooltip" data-placement="bottom" title="Back"><i class="uil uil-arrow-left"></i></a></h4>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
          <h4 data-toggle="tooltip" data-placement="bottom" title="Add New"><a href="{{route('showAdminExpenses')}}" data-toggle="modal" data-target="#createType" class="badge badgeERPButton"><i class="uil uil-plus-circle"></i></a></h4>
            <button type="button" class="btn btn-outline-secondary btn-sm" hidden>Dispatch Calendar</button> <!-- Hidden -->
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class=""></div>
            <div class="card bg-light col" style="margin: 10px;">
            <div class="row">
                <div id="form1" class="card-body">
                    <h5 class="card-title text-center">New Type Admin Expense</h5>
                    <br> 
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($typesExpenses as $typeExpense)
                                <tr>
                                  <td>{{$typeExpense->nameTypeAdminExpenses}}</td>
                                  <td>{{$typeExpense->categoryExpense->nameCategory}}</td>
                                  <td>  
                                    <label> {{-- <span id="active-{{$typeExpense->id}}">Active</span> 
                                            <span id="disabled-{{$typeExpense->id}}">Disabled</span> --}}
                                      <input type="checkbox" class="ios-switch green" id="check-{{$typeExpense->id}}" />
                                      <div style="margin-top: 5px;">
                                          <div>
                                            
                                          </div>
                                      </div>
                                    </label>
                                  </td>
                                  <td>
                                    <div class="dropdown">
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="modal" data-target="#editMenu{{$typeExpense->id}}">
                                      </button>
      
                                      <!-- Modal -->
                                      <div class="modal fade" id="editMenu{{$typeExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">Actions</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <a style="padding: 5px;" class="dropdown-item text-center"  href="#" class="badge badge-light" data-toggle="modal" data-target="#modalEdit{{$typeExpense->id}}"><i class="fas fa-edit fa-1x"></i>Edit</a>
                                                    <a style="padding: 5px;" class="dropdown-item text-center" href="#" class="badge badge-light" data-toggle="modal" data-target="#modalDelete-{{$typeExpense->id}}" ><i class="fas fa-trash-alt fa-1x"></i>Delete</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>        
            </div>
        </div><!-- End Col 4 -->
    </div> <!-- End Row -->
</div>

<!-- START MODAL PARA CREAR -->
<div class="modal fade" id="createType" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create New Type Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @include('TypeExpense.createForm')
    </div>
  </div>
</div>
<!-- END MODAL PARA CREAR -->

@foreach ($typesExpenses as $typeExpense)

<!--  START MODAL PARA EDITAR -->
<div class="modal fade" id="modalEdit{{$typeExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Expense Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @include('TypeExpense.editForm', array('idType1' => $typeExpense->id, 'nameType1' => $typeExpense->nameTypeAdminExpenses,'categoryType' => $typeExpense->categoryExpense->id))
    </div>
  </div>
</div>
<!-- END MODAL PARA EDITAR -->

<!-- START MODAL PARA ELIMINAR -->
<div class="modal fade" id="modalDelete-{{$typeExpense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete {{$typeExpense->nameTypeAdminExpenses}}? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{route('destroyTypeAdminExpenses', $typeExpense->id)}}"><div class="btn btn-danger" >Delete</div></a>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL PARA ELIMINAR -->
@endforeach

@foreach ($typesExpenses as $typeExpense)
<script>
  $('document').ready( function(){
    if({{$typeExpense->generalStatus_fk}} == 1){
      $('#active-'+{{$typeExpense->id}}+'').show();
      $('#disabled-'+{{$typeExpense->id}}+'').hide();
      $('#check-'+{{$typeExpense->id}}+'').prop('checked',true);
    }else{
      $('#active-'+{{$typeExpense->id}}+'').hide();
      $('#disabled-'+{{$typeExpense->id}}+'').show();
    }
  })

  $('#check-'+{{$typeExpense->id}}+'').on('click', function(){
    if ($('#check-'+{{$typeExpense->id}}+'').prop('checked')) {
      $('#active-'+{{$typeExpense->id}}+'').show();
      $('#disabled-'+{{$typeExpense->id}}+'').hide();
      /* AJAX*/
      var value = 1;
      $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/changeStatusAdmin/'+{{$typeExpense->id}}+'/'+value
        url:'http://127.0.0.1:8000/changeStatusAdmin/'+{{$typeExpense->id}}+'/'+value
    }).done(function(data){
        console.log('active');
    });
      
    }else{
      $('#active-'+{{$typeExpense->id}}+'').hide();
      $('#disabled-'+{{$typeExpense->id}}+'').show();
       /* AJAX*/
       var value = 2;
      $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/changeStatusAdmin/'+{{$typeExpense->id}}+'/'+value
        url:'http://127.0.0.1:8000/changeStatusAdmin/'+{{$typeExpense->id}}+'/'+value
    }).done(function(data){
        console.log('active');
    });
    }
  });

  
</script>
@endforeach

@stop


