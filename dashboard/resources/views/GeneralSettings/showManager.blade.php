@extends('master')
@section('title')
    <title>Managers</title>
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
          <a href="{{route('menuSettings')}}"><div class="btn btn-outline-secondary btn-sm" >Go Back</div></a>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
        <div class="col text-right">
            <a href="#"><div class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#createType" >Add New</div></a>
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
                    <h5 class="card-title text-center">Project Managers</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Statu</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($managers as $manager)
                                <tr>
                                <td>{{$manager->name_manager}}</td>
                                <td>  
                                    <label> 
                                    <input type="checkbox" class="ios-switch green" id="check-{{$manager->id}}" />
                                    <div style="margin-top: 5px;">
                                        <div>
                                            
                                        </div>
                                    </div>
                                    </label>
                                </td>
                                <td>
                                    <div class="dropdown">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="modal" data-target="#editMenu{{$manager->id}}">
                                    </button>
    
                                    <!-- Modal -->
                                    <div class="modal fade" id="editMenu{{$manager->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Actions</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <a style="padding: 5px;" class="dropdown-item text-center"  href="#" class="badge badge-light" data-toggle="modal" class="close" data-dismiss="modal" aria-label="Close" data-target="#modalEdit{{$manager->id}}"><i class="fas fa-edit fa-1x"></i>Edit</a>
                                                    {{-- <a style="padding: 5px;" class="dropdown-item text-center" href="#" class="badge badge-light" data-toggle="modal" class="close" data-dismiss="modal" aria-label="Close" data-target="#modalDelete-{{$manager->id}}" ><i class="fas fa-trash-alt fa-1x"></i>Delete</a> --}}
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
                <h5 class="modal-title" id="exampleModalLongTitle">Create New Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form-create-manager" class="form-area">
                <form action="{{route('storeManager')}}">
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" id="nameManager" name="nameManager">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Add New Manager</h6></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL PARA CREAR -->

@foreach ($managers as $manager)

<!--  START MODAL PARA EDITAR -->
<div class="modal fade" id="modalEdit{{$manager->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form-edit-manager" class="form-area">
                <form action="{{route('updateManager')}}">
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" name="idManager" id="idManager" value="{{$manager->id}}" hidden>
                                    <input class="form-control form-control-sm" type="text" name="editManager" id="editManager" value="{{$manager->name_manager}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn badgeERP btn-sm" type="submit"><h6 style="margin-bottom: 0px;">Edit Manager</h6></button>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
</div>
<!-- END MODAL PARA EDITAR -->

<!-- START MODAL PARA ELIMINAR -->
<div class="modal fade" id="modalDelete-{{$manager->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete {{$manager->name_manager}}? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{route('destroyTypeAdminExpenses', $manager->id)}}"><div class="btn btn-danger" >Delete</div></a>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL PARA ELIMINAR -->
@endforeach

@foreach ($managers as $manager)
<script>
  $('document').ready( function(){
    if({{$manager->generalStatus}} == 1){
      $('#active-'+{{$manager->id}}+'').show();
      $('#disabled-'+{{$manager->id}}+'').hide();
      $('#check-'+{{$manager->id}}+'').prop('checked',true);
    }else{
      $('#active-'+{{$manager->id}}+'').hide();
      $('#disabled-'+{{$manager->id}}+'').show();
    }
  })

  $('#check-'+{{$manager->id}}+'').on('click', function(){
    if ($('#check-'+{{$manager->id}}+'').prop('checked')) {
      $('#active-'+{{$manager->id}}+'').show();
      $('#disabled-'+{{$manager->id}}+'').hide();
      /* AJAX*/
      var value = 1;
      $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/changeStatusManager/'+{{$manager->id}}+'/'+value
        url:'https://mvm-machinery.com/dashboard/public/changeStatusManager/'+{{$manager->id}}+'/'+value
    }).done(function(data){
        console.log('active');
    });
      
    }else{
      $('#active-'+{{$manager->id}}+'').hide();
      $('#disabled-'+{{$manager->id}}+'').show();
       /* AJAX*/
       var value = 2;
      $.ajax({
        method:'GET',
        headers: { 'Content-Type': 'application/json'},
        //url:'http://127.0.0.1:8000/changeStatusManager/'+{{$manager->id}}+'/'+value
        url:'https://mvm-machinery.com/dashboard/public/changeStatusManager/'+{{$manager->id}}+'/'+value
    }).done(function(data){
        console.log('active');
    });
    }
  });

  
</script>
@endforeach
<style>

</style>

@stop


