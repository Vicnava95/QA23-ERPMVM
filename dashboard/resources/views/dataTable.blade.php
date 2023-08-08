@extends('master')
@section('title')
    <title>Rent list table</title>
@stop
@section('extra_links')


{{--    {{HTML::style('css/bootstrap.css')}}--}}

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    {{--    {{HTML::asset('images/icons/favicon.ico')}}--}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    {{--    {{HTML::asset('images/icons/favicon.ico')}}--}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">




@stop
@section('content')
<div class="container">

<table id="myTable" class="display" >
    <br>
    <thead>
    <tr>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Full Name</th>
        <th>Equipment</th>
        <th>Start</th>

    </tr>
    </thead>
    <tbody>
    @foreach($rentas as $renta)

    <tr data-toggle="tooltip" title="Show Document!" class="pointer" onclick="signdocument{{$renta->id}}({{$renta->id}})">


{{--        address row--}}
        <td>{{$renta->delivery_site}}</td>
        <td>{{$renta->clientes->phone_num}}</td>
        <td>{{$renta->clientes->full_name}}</td>
        <td> {{$renta->machine}}</td>
        <td> {{$renta->date}}</td>

    </tr>
    <script>
        var all = document.getElementsByClassName('pointer');
for (var i = 0; i < all.length; i++) {
  all[i].style.cursor = 'pointer';
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

    function signdocument{{$renta->id}}(id){
        location.href='/dashboard/public/sign/'+id;
    }
    </script>

    @endforeach
    </tbody>
</table>

</div>

<script >


    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>

@stop
